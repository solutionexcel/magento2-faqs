<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Captcha\Observer\CaptchaStringResolver;

class CheckFaqFormObserver implements ObserverInterface
{
    protected $_helper;
	protected $_faqhelper;
    protected $_actionFlag;
    protected $messageManager;
    protected $_session;
    protected $_urlManager;
    protected $captchaStringResolver;
	protected $redirect;
	

    public function __construct(\Magento\Captcha\Helper\Data $helper,
			\Solutionexcel\Faqs\Helper\Data $faqhelper,
			\Magento\Framework\App\ActionFlag $actionFlag,
            \Magento\Framework\Message\ManagerInterface $messageManager,
            \Magento\Framework\Session\SessionManagerInterface $session,
            \Magento\Framework\UrlInterface $urlManager,
            \Magento\Framework\App\Response\RedirectInterface $redirect,
            \Magento\Captcha\Observer\CaptchaStringResolver $captchaStringResolver
    ) {
        $this->_helper = $helper;
		$this->_faqhelper = $faqhelper;
		$this->_actionFlag = $actionFlag;
        $this->messageManager = $messageManager;
        $this->_session = $session;
        $this->_urlManager = $urlManager;
        $this->redirect = $redirect;
        $this->captchaStringResolver = $captchaStringResolver;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
		if($this->_faqhelper->allowCaptcha()){
			$formId = 'se_faq_form'; 
			$captchaModel = $this->_helper->getCaptcha($formId);

			$controller = $observer->getControllerAction();
			if (!$captchaModel->isCorrect($this->captchaStringResolver->resolve($controller->getRequest(), $formId))) {
				$this->messageManager->addError(__('Incorrect CAPTCHA'));
				$this->_actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
				$this->_session->setCustomerFormData($controller->getRequest()->getPostValue());
				$url = $this->_urlManager->getUrl('faqs/question/submit/', ['_secure' => true]);
				$controller->getResponse()->setRedirect($this->redirect->error($url));
			}

			return $this;
		}
    }
}