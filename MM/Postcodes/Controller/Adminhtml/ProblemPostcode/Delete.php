<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\ProblemPostcode;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Backend\Model\Session;
use MM\Postcodes\Controller\Adminhtml\ProblemPostcode;

class Delete extends ProblemPostcode
{
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $dataId = $this->getRequest()->getParam('id');
        if ($dataId) {
            try {
                $this->problemPostcodeRepositoryInterface->deleteById($dataId);
                $this->messageManager->addSuccessMessage(__('The data has been deleted.'));
                $resultRedirect->setPath('postcode/problempostcode/problempostcode');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The data no longer exists.'));
                return $resultRedirect->setPath('postcode/problempostcode/problempostcode');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('postcode/problempostcode/problempostcode', ['id' => $dataId]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the data'));
                return $resultRedirect->setPath('postcode/problempostcode/edit', ['id' => $dataId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find the data to delete.'));
        $resultRedirect->setPath('postcode/problempostcode/problempostcode');
        return $resultRedirect;
    }
}
