<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Block\Question;

class Index extends \Magento\Framework\View\Element\Template
{
	/**
     * Request instance
     *
     * @var \Magento\Framework\App\RequestInterface
     */
	private $_objectManager;
    protected $_faqhelper;
	protected $_session;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param array $data
     */
    public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\ObjectManagerInterface $objectmanager,
		\Solutionexcel\Faqs\Helper\Data $faqhelper,
        \Magento\Framework\Session\SessionManagerInterface $session,
        array $data = []
    ) {
		$this->_objectManager = $objectmanager;
		parent::__construct($context, $data);
		$this->_session = $session;
		$this->_faqhelper = $faqhelper;	
    }

    public function _prepareLayout()
    {

        return parent::_prepareLayout();
    }
	
	public function getFaqPostParams()
    {
		return $this->_session->getCustomerFormData();
    }
	
	public function getPostActionUrl()
    {
		return $this->getUrl('faqs/question/post', ['_secure' => true]);
    }
	
	public function getCustomerName()
    {
		$customerSession = $this->_objectManager->create('Magento\Customer\Model\Session');
		if ($customerSession->isLoggedIn()) {
			return $customerSession->getCustomer()->getName();
		} else {
			$data = $this->getFaqPostParams();
			if($data && ($data['customer_name']!="")){
				return $data['customer_name'];
			} else {
				return "";
			} 
		}
    }
	
	public function getCustomerEmail()
    {
		$customerSession = $this->_objectManager->create('Magento\Customer\Model\Session');
		if ($customerSession->isLoggedIn()) {
			return $customerSession->getCustomer()->getEmail();
		} else {
			$data = $this->getFaqPostParams();
			if($data && ($data['customer_email']!="")){
				return $data['customer_email'];
			} else {
				return "";
			} 
		}
    }
	
	public function getQuestions()
    {
		$data = $this->getFaqPostParams();
		if($data && ($data['questions']!="")){
			return $data['questions'];
		} else {
			return "";
		} 
    }
	
}

