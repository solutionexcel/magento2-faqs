<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Controller\Question;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;

class Post extends \Magento\Framework\App\Action\Action
{
	protected $_messageManager;
    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;
	protected $_session;
	
    /**
     * Initialize dependencies.
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
		\Magento\Framework\Message\ManagerInterface $messageManager,
		\Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
		\Magento\Framework\Session\SessionManagerInterface $session
    ) {
		$this->formKeyValidator = $formKeyValidator;
		$this->_messageManager = $messageManager;
		$this->_session = $session;
		parent::__construct($context);
    }
	
	protected function validateCustomerName($name)
    {
        if (!\Zend_Validate::is($name, 'NotEmpty')) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Name is a required field.'));
        }
    }
	
	protected function validateEmailFormat($email)
    {
        if (!\Zend_Validate::is($email, 'EmailAddress')) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Please enter a valid email address.'));
        }
    }
	
	protected function validateQuestion($uestion)
    {
        if (!\Zend_Validate::is($uestion, 'NotEmpty')) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Question is a required field.'));
        }
    }
	
	
	
    /**
     * Save newsletter subscription preference action
     *
     * @return void|null
     */
    public function execute()
    {
		
		if (!$this->formKeyValidator->validate($this->getRequest())) {
			exit;
            return $this->_redirect('faqs/question/submit/');
        }
		
		$_scopeConfig = $this->_objectManager->create('Magento\Framework\App\Config\ScopeConfigInterface');
		$_storeManager = $this->_objectManager->create('Magento\Store\Model\StoreManagerInterface');
		$storeId = $_storeManager->getStore()->getId();
		$isEnabled = $_scopeConfig->getValue('solutionexcel_faqs/general/is_enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		
		
		if (($isEnabled==1) && $this->getRequest()->isPost() && $this->getRequest()->getPost('customer_email')) {
			$data = $this->getRequest()->getPost();
			$magentoDateObject = $this->_objectManager->create('Magento\Framework\Stdlib\DateTime\DateTime');
			$datetime = $magentoDateObject->gmtDate();
			
			try {
				$this->validateCustomerName($data['customer_name']);
				$this->validateEmailFormat($data['customer_email']);
				$this->validateQuestion($data['questions']);
                
				$model = $this->_objectManager->create('Solutionexcel\Faqs\Model\Faqs');	
				$model->setCustomerName($data['customer_name']);
				$model->setCustomerEmail($data['customer_email']);
				$model->setQuestions($data['questions']);
				$model->setStatus(0);
				$model->setCreatedAt($datetime);
				$model->save();
				
				
				/*Code block for email sending*/
				$configEeneralEmail = $_scopeConfig->getValue('trans_email/ident_support/email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
				$configEeneralName  = $_scopeConfig->getValue('trans_email/ident_support/name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
				$emailCopyToEmail  = $_scopeConfig->getValue('solutionexcel_faqs/general/sendemailto', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
				
				$toName = $data['customer_name'];
				$toEmail = $data['customer_email'];
				$sender = ['name' => 'FromBangla', 'email' => $configEeneralEmail];
				
				$transportBuilder = $this->_objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');
				$transport = $transportBuilder->setTemplateIdentifier('faqs_submit_question_confirm_email_template')
					->setTemplateOptions(['area' => 'frontend', 'store' => $storeId])
					->setTemplateVars(
						[
							'store' => $_storeManager->getStore(),
							'name' => $toName,
							'email' => $data['customer_email'],
							'questions' => $data['questions']
						]
					)
				->setFrom($sender)
				->addTo($toEmail, $toName)
				->getTransport();
				$transport->sendMessage();
				
				if($emailCopyToEmail && ($emailCopyToEmail!="")){
					$transport = $transportBuilder->setTemplateIdentifier('faqs_submit_question_admin_email_template')
						->setTemplateOptions(['area' => 'frontend', 'store' => $storeId])
						->setTemplateVars(
							[
								'store' => $_storeManager->getStore(),
								'name' => $toName,
								'email' => $data['customer_email'],
								'questions' => $data['questions']
							]
						)
					->setFrom($sender)
					->addTo($emailCopyToEmail, $configEeneralName)
					->getTransport();
					$transport->sendMessage();
				}
				
				$this->_session->setCustomerFormData("");
				$this->_messageManager->addSuccess(__('Thank you for your submit question.'));
				
			} catch (\Magento\Framework\Exception\LocalizedException $e) {
				$this->_messageManager->addError(__('There was a problem with submit question: %1', $e->getMessage()));
            } catch (\Exception $e) {
				$this->_messageManager->addError(__('Something went wrong with submit your question. ' . $e->getMessage()));
            }
			
		}
       
	   $this->_redirect('faqs/question/submit/');
    }
}
