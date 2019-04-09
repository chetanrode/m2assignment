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
use MM\Postcodes\Api\ProblemPostcodeRepositoryInterface;
use MM\Postcodes\Api\Data\ProblemPostcodeInterface;
use MM\Postcodes\Api\Data\ProblemPostcodeInterfaceFactory;
use MM\Postcodes\Model\ResourceModel\ProblemPostcode as ResourceData;
use MM\Postcodes\Model\ResourceModel\ProblemPostcode\CollectionFactory as ProblemPostcodeCollectionFactory;
use Magento\Framework\Message\Manager;

class ProblemPostcodeRepository implements ProblemPostcodeRepositoryInterface
{
    protected $_instances = [];
    protected $_resource;
    protected $problemPostcodeCollectionFactory;
    protected $_problemPostcodeInterfaceFactory;
    protected $_dataObjectHelper;
    protected $quoteRepository;
    protected $_productCollectionFactory;
    protected $cart;
    protected $messageManager;
    protected $errors = [];

    /**
     * ProblemPostcodeRepository constructor.
     * @param ResourceData $resource
     * @param ProblemPostcodeCollectionFactory $problemPostcodeCollectionFactory
     * @param ProblemPostcodeInterfaceFactory $problemPostcodeInterfaceFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Quote\Model\Quote\Item $itemModel
     * @param \Magento\Checkout\Model\Cart $cart
     * @param Manager $messageManager
     */
    public function __construct(
        ResourceData $resource,
        ProblemPostcodeCollectionFactory $problemPostcodeCollectionFactory,
        ProblemPostcodeInterfaceFactory $problemPostcodeInterfaceFactory,
        DataObjectHelper $dataObjectHelper,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Quote\Model\Quote\Item $itemModel,
        \Magento\Checkout\Model\Cart $cart,
        Manager $messageManager

    ) {
        $this->_resource = $resource;
        $this->problemPostcodeCollectionFactory = $problemPostcodeCollectionFactory;
        $this->_problemPostcodeInterfaceFactory = $problemPostcodeInterfaceFactory;
        $this->_dataObjectHelper = $dataObjectHelper;
        $this->quoteRepository = $quoteRepository;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->itemModel = $itemModel;
        $this->cart = $cart;
        $this->messageManager = $messageManager;

    }

    /**
     * @param ProblemPostcodeInterface $data
     * @return ProblemPostcodeInterface
     */
    public function save(ProblemPostcodeInterface $data)
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
            $data = $this->_problemPostcodeInterfaceFactory->create();
            $this->_resource->load($data, $dataId);
            if (!$data->getId()) {
                throw new NoSuchEntityException(__('Requested data doesn\'t exist'));
            }
            $this->_instances[$dataId] = $data;
        }
        return $this->_instances[$dataId];
    }

    /**
     * @param ProblemPostcodeInterface $data
     * @return bool
     */
    public function delete(ProblemPostcodeInterface $data)
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

    /**
     * function to remove cart product if product with local delivery and problem postcode
     * @param $cartId
     * @param $postcode
     */
    public function filterQuoteProducts($cartId,$postcode)
    {
        $problemPostcode =  $this->isProblemPostcode($postcode);
        $messageFlag = 0;
        $quote = $this->quoteRepository->getActive($cartId);
        if (($postcode!='') && (!empty($problemPostcode))) {
            $this->cart->truncate()->save();
            $message = __(
                'Sorry, we don\'t deliver to that postcode - please call us for a quote.'
            );
            $this->messageManager->addErrorMessage($message);
//            foreach ($quote->getItems() as $item) {
//                $messageFlag = 1;
//                $itemId = $item->getItemId();
//                $this->cart->removeItem($itemId)->save();
//            }
//            if($messageFlag == 1){
//                $message = __(
//                    'Sorry, we don\'t deliver to that postcode - please call us for a quote.'
//                );
//                $this->messageManager->addErrorMessage($message);
//            }

        }
    }

    /**
     * function to check isProblemPostcode
     * @param $postcode
     * @return mixed
     */
    public function isProblemPostcode($postcode)
    {
        $problemPostcodeCollection = $this->problemPostcodeCollectionFactory->create()
            ->addFieldToFilter('problem_postcode', $postcode)->getData();
        return $problemPostcodeCollection;
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
