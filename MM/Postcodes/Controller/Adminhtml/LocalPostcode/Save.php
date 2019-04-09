<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\LocalPostcode;

use Magento\Backend\Model\Session;
use MM\Postcodes\Api\Data\LocalPostcodeInterface;
use MM\Postcodes\Controller\Adminhtml\LocalPostcode;

class Save extends LocalPostcode
{
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $model = $this->localPostcodeInterfaceFactory->create();
            try {
                $this->dataObjectHelper->populateWithArray($model, $data, LocalPostcodeInterface::class);
                $this->localPostcodeRepositoryInterface->save($model);

                $this->messageManager->addSuccessMessage(__('You saved this data.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/localpostcode');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/localpostcode');
    }
}
