<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Controller\Adminhtml\Faqs;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('faqs_id');
			$_scopeConfig = $this->_objectManager->create('Magento\Framework\App\Config\ScopeConfigInterface');
			$_storeManager = $this->_objectManager->create('Magento\Store\Model\StoreManagerInterface');
			$storeId = $_storeManager->getStore()->getId();
			
			$magentoDateObject = $this->_objectManager->create('Magento\Framework\Stdlib\DateTime\DateTime');
			$datetime = $magentoDateObject->gmtDate();
        
            $model = $this->_objectManager->create('Solutionexcel\Faqs\Model\Faqs')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Faqs no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
			
			$model->setCreatedAt($datetime);
            $model->setData($data);
			
			try {
                $model->save();
				
				if (($model->getCustomerEmail() && $model->getCustomerEmail()!="") && ($data['answers']!="") && ($data['status']=='1')) {
					/*Code block for email sending*/
					$configEeneralEmail = $_scopeConfig->getValue('trans_email/ident_support/email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
					$configEeneralName  = $_scopeConfig->getValue('trans_email/ident_support/name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
					
					$toName = $model->getCustomerName();
					$toEmail = $model->getCustomerEmail();
					$sender = ['name' => 'FromBangla', 'email' => $configEeneralEmail];
					
					$transportBuilder = $this->_objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');
					$transport = $transportBuilder->setTemplateIdentifier('faqs_answer_confirm_email_template')
						->setTemplateOptions(['area' => 'frontend', 'store' => $storeId])
						->setTemplateVars(
							[
								'store' => $_storeManager->getStore(),
								'name' => $toName,
								'email' => $toEmail,
								'questions' => $data['questions'],
								'answers' => $data['answers']
							]
						)
						->setFrom($sender)
						->addTo($toEmail, $toName)
						->getTransport();
					$transport->sendMessage();
				}
				
                $this->messageManager->addSuccessMessage(__('You saved the Faqs.'));
                $this->dataPersistor->clear('solutionexcel_faqs_faqs');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['faqs_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Faqs.'));
            }
        
            $this->dataPersistor->set('solutionexcel_faqs_faqs', $data);
            return $resultRedirect->setPath('*/*/edit', ['faqs_id' => $this->getRequest()->getParam('faqs_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
