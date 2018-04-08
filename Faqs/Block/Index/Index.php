<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Block\Index;

use Solutionexcel\Faqs\Api\Data\FaqsInterface;
use Solutionexcel\Faqs\Model\ResourceModel\Faqs\Collection as FaqsCollection;

class Index extends \Magento\Framework\View\Element\Template
{
	/**
     * @var \Solutionexcel\Faqs\Model\ResourceModel\Faqs\CollectionFactory
     */
    protected $_faqsCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Solutionexcel\Faqs\Model\ResourceModel\Faqs\CollectionFactory $faqsCollectionFactory,
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Solutionexcel\Faqs\Model\ResourceModel\Faqs\CollectionFactory $faqsCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_faqsCollectionFactory = $faqsCollectionFactory;
    }

    /**
     * @return \Solutionexcel\Faqs\Model\ResourceModel\Faqs\Collection
     */
    public function getFaqs()
    {
		/**
         * @todo check sort order is doing as it should
         * May need to be FaqsInterface::SORT_ORDER_DESC
         */
        $faqColletion = $this->_faqsCollectionFactory->create();
		$faqColletion->addFieldToFilter('status', 1);
		
        return $faqColletion;
    }
	
	public function qSubmitUrs()
    {
		return $this->getUrl('faqs/question/submit', ['_secure' => true]);
    }
}
