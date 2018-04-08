<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/
 
namespace Solutionexcel\Faqs\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Catalog data helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * ScopeConfigInterface scopeConfig
     *
     * @var scopeConfig
     */
    protected $scopeConfig;
	
    /**
     * @param CustomerSession $customerSession
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }
	
    public function allowExtension(){
		return  $this->scopeConfig->getValue('solutionexcel_faqs/general/is_enabled', ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }  
	
	public function allowCaptcha(){
		return  $this->scopeConfig->getValue('solutionexcel_faqs/general/is_enabled_captcha', ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
    }
}
