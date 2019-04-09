<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\ProblemPostcode;

use Magento\Framework\Controller\ResultFactory;

class Add extends \MM\Postcodes\Controller\Adminhtml\ProblemPostcode
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
