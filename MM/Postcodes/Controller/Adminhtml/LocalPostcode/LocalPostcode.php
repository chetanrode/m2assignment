<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\LocalPostcode;

class LocalPostcode extends \MM\Postcodes\Controller\Adminhtml\LocalPostcode
{
    public function execute()
    {
        // Call page factory to render layout and page content
        $resultPage = $this->resultPageFactory->create();
        // Set the menu which will be active for this page
        $resultPage->setActiveMenu('MM_Postcodes::postcode');
        // Set the header title of grid
        $resultPage->getConfig()->getTitle()->prepend(__('Local Postcode'));
        // Add Breadcrumb
        $resultPage->addBreadcrumb(__('Local Postcode'), __('Local Postcode'));
        $resultPage->addBreadcrumb(__('Manage Local Postcode'), __('Manage Local Postcode'));
        return $resultPage;
    }
}
