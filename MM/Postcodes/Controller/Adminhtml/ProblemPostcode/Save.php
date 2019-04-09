<?php
/*
* @author      MM Team
* @category    MM
* @package     MM_Postcodes
*/
namespace MM\Postcodes\Controller\Adminhtml\ProblemPostcode;

use Magento\Backend\Model\Session;
use MM\Postcodes\Api\Data\ProblemPostcodeInterface;
use MM\Postcodes\Controller\Adminhtml\ProblemPostcode;

class Save extends ProblemPostcode
{
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $model = $this->problemPostcodeInterfaceFactory->create();
            try {
                $this->dataObjectHelper->populateWithArray($model, $data, ProblemPostcodeInterface::class);
                $this->problemPostcodeRepositoryInterface->save($model);

                $this->messageManager->addSuccessMessage(__('You saved this data.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/problempostcode');
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
        return $resultRedirect->setPath('*/*/problempostcode');
    }
}
