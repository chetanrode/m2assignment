<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\LocalPostcode;

use MM\Postcodes\Controller\Adminhtml\LocalPostcode;
use Magento\Backend\Model\Session;

class Edit extends LocalPostcode
{
    public function execute()
    {
        $dataId = $this->getRequest()->getParam('id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MM_Postcodes::localpostcode_manage')
            ->addBreadcrumb(__('Data'), __('Data'))
            ->addBreadcrumb(__('Manage Data'), __('Manage Data'));
        if ($dataId === null) {
            $resultPage->addBreadcrumb(__('New Data'), __('New Data'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Data'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Data'), __('Edit Data'));
            $resultPage->getConfig()->getTitle()->prepend(
                $this->localPostcodeRepositoryInterface->getById($dataId)->getLocalPostcode()
            );
        }
        return $resultPage;
    }
}
