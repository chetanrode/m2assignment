<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\ProblemPostcode;

use MM\Postcodes\Controller\Adminhtml\ProblemPostcode;
use Magento\Backend\Model\Session;

class Edit extends ProblemPostcode
{
    public function execute()
    {
        $dataId = $this->getRequest()->getParam('id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MM_Postcodes::problempostcode_manage')
            ->addBreadcrumb(__('Data'), __('Data'))
            ->addBreadcrumb(__('Manage Data'), __('Manage Data'));
        if ($dataId === null) {
            $resultPage->addBreadcrumb(__('New Data'), __('New Data'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Data'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Data'), __('Edit Data'));
            $resultPage->getConfig()->getTitle()->prepend(
                $this->problemPostcodeRepositoryInterface->getById($dataId)->getProblemPostcode()
            );
        }
        return $resultPage;
    }
}
