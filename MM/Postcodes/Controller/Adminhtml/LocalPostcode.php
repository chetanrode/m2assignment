<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Message\Manager;
use Magento\Backend\Model\View\Result\ForwardFactory;
use MM\Postcodes\Api\LocalPostcodeRepositoryInterface;
use MM\Postcodes\Api\Data\LocalPostcodeInterface;
use MM\Postcodes\Api\Data\LocalPostcodeInterfaceFactory;

abstract class LocalPostcode extends Action
{
    /**
     * @var string
     */
    const ACTION_RESOURCE = 'MM_Postcodes::postcode';
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * date filter
     *
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var Manager
     */
    protected $messageManager;
    /**
     * Result Forward Factory
     *
     * @var ForwardFactory
     */
    protected $resultForwardFactory;
    /**
     * @var CustomerServiceClaimFormTypeRepositoryInterface
     */
    protected $localPostcodeRepositoryInterface;

    protected $localPostcodeInterfaceFactory;

    /**
     * LocalPostcode constructor.
     * @param Registry $registry
     * @param PageFactory $resultPageFactory
     * @param LocalPostcodeRepositoryInterface $localPostcodeRepositoryInterface
     * @param LocalPostcodeInterfaceFactory $localPostcodeInterfaceFactory
     * @param Date $dateFilter
     * @param DataObjectHelper $dataObjectHelper
     * @param Manager $messageManager
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     */

    public function __construct(
        Registry $registry,
        PageFactory $resultPageFactory,
        LocalPostcodeRepositoryInterface $localPostcodeRepositoryInterface,
        LocalPostcodeInterfaceFactory $localPostcodeInterfaceFactory,
        Date $dateFilter,
        DataObjectHelper $dataObjectHelper,
        Manager $messageManager,
        ForwardFactory $resultForwardFactory,
        Context $context
    ) {
        $this->coreRegistry      = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->dateFilter        = $dateFilter;
        $this->dataObjectHelper  = $dataObjectHelper;
        $this->messageManager = $messageManager;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->localPostcodeRepositoryInterface = $localPostcodeRepositoryInterface;
        $this->localPostcodeInterfaceFactory = $localPostcodeInterfaceFactory;
        parent::__construct($context);
    }
}
