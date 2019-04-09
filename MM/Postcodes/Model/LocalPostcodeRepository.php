<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\NoSuchEntityException;
use MM\Postcodes\Api\LocalPostcodeRepositoryInterface;
use MM\Postcodes\Api\Data\LocalPostcodeInterface;
use MM\Postcodes\Api\Data\LocalPostcodeInterfaceFactory;
use MM\Postcodes\Model\ResourceModel\LocalPostcode as ResourceData;
use MM\Postcodes\Model\ResourceModel\LocalPostcode\CollectionFactory as LocalPostcodeCollectionFactory;
use Magento\Framework\Message\Manager;

class LocalPostcodeRepository implements LocalPostcodeRepositoryInterface
{
    protected $_instances = [];
    protected $_resource;
    protected $localPostcodeCollectionFactory;
    protected $_localPostcodeInterfaceFactory;
    protected $_dataObjectHelper;
    protected $quoteRepository;
    protected $_productCollectionFactory;
    protected $cart;
    protected $messageManager;
    protected $errors = [];

    /**
     * LocalPostcodeRepository constructor.
     * @param ResourceData $resource
     * @param LocalPostcodeCollectionFactory $localPostcodeCollectionFactory
     * @param LocalPostcodeInterfaceFactory $localPostcodeInterfaceFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Quote\Model\Quote\Item $itemModel
     * @param \Magento\Checkout\Model\Cart $cart
     * @param Manager $messageManager
     */
    public function __construct(
        ResourceData $resource,
        LocalPostcodeCollectionFactory $localPostcodeCollectionFactory,
        LocalPostcodeInterfaceFactory $localPostcodeInterfaceFactory,
        DataObjectHelper $dataObjectHelper,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Quote\Model\Quote\Item $itemModel,
        \Magento\Checkout\Model\Cart $cart,
        Manager $messageManager
    ) {
        $this->_resource = $resource;
        $this->localPostcodeCollectionFactory = $localPostcodeCollectionFactory;
        $this->_localPostcodeInterfaceFactory = $localPostcodeInterfaceFactory;
        $this->_dataObjectHelper = $dataObjectHelper;
        $this->quoteRepository = $quoteRepository;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->itemModel = $itemModel;
        $this->cart = $cart;
        $this->messageManager = $messageManager;
    }

    /**
     * @param LocalPostcodeInterface $data
     * @return LocalPostcodeInterface
     */
    public function save(LocalPostcodeInterface $data)
    {
        try {
            $this->_resource->save($data);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the data: %1',
                $exception->getMessage()
            ));
        }
        return $data;
    }

    /**
     * @param $dataId
     * @return mixed
     */
    public function getById($dataId)
    {
        if (!isset($this->_instances[$dataId])) {
            $data = $this->_localPostcodeInterfaceFactory->create();
            $this->_resource->load($data, $dataId);
            if (!$data->getId()) {
                throw new NoSuchEntityException(__('Requested data doesn\'t exist'));
            }
            $this->_instances[$dataId] = $data;
        }
        return $this->_instances[$dataId];
    }

    /**
     * @param LocalPostcodeInterface $data
     * @return bool
     */
    public function delete(LocalPostcodeInterface $data)
    {
        $id = $data->getId();
        try {
            unset($this->_instances[$id]);
            $this->_resource->delete($data);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove data %1', $id)
            );
        }
        unset($this->_instances[$id]);
        return true;
    }

    /**
     * @param $dataId
     * @return bool
     */
    public function deleteById($dataId)
    {
        $data = $this->getById($dataId);
        return $this->delete($data);
    }

    public function filterQuoteProducts($cartId,$postcode)
    {
        $quote = $this->quoteRepository->getActive($cartId);
        foreach ($quote->getItems() as $item) {
            $flag = 0;
            $localDelivery = $this->_productCollectionFactory->create()
                ->addAttributeToFilter('sku',$item->getSku())
                ->addAttributeToFilter('local_delivery', 1)->getData();
            $localPostcode =  $this->isLocalPostcode($postcode);
            //if ((!empty($localDelivery)) && ($postcode!='') && (empty($localPostcode))) {
            if ((!empty($localDelivery)) && ($postcode!='')) {
                $flag = 1;
                $itemId = $item->getItemId();
                $this->cart->removeItem($itemId)->save();
                $message = __(
                    'Sorry, we can only deliver '.$item->getName().' locally. Please call us for a quote.'
                );
                $this->messageManager->addErrorMessage($message);
                //$this->errors[] = $item;
            }
        }
    }

    /**
     * function to check isProblemPostcode
     * @param $postcode
     * @return mixed
     */
    public function isLocalPostcode($postcode)
    {
        $localPostcodeCollection = $this->localPostcodeCollectionFactory->create()
            ->addFieldToFilter('local_postcode', $postcode);
        return $localPostcodeCollection;
    }
    public function hasErrors() {

        if( !empty( $this->errors ) )
            return true;

        return false;

    }

    public function getErrors() {

        return $this->errors;

    }
}
