<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\ProblemPostcode;

class ProblemPostcode extends \MM\Postcodes\Controller\Adminhtml\ProblemPostcode
{
    public function execute()
    {
        // Call page factory to render layout and page content
        $resultPage = $this->resultPageFactory->create();
        // Set the menu which will be active for this page
        $resultPage->setActiveMenu('MM_Postcodes::postcode');
        // Set the header title of grid
        $resultPage->getConfig()->getTitle()->prepend(__('Problem Postcode'));
        // Add Breadcrumb
        $resultPage->addBreadcrumb(__('Problem Postcode'), __('Problem Postcode'));
        $resultPage->addBreadcrumb(__('Manage Problem Postcode'), __('Manage Problem Postcode'));
        return $resultPage;
    }
}
