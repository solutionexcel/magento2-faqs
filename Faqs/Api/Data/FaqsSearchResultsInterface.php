<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Api\Data;

interface FaqsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Faqs list.
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface[]
     */
    public function getItems();

    /**
     * Set questions list.
     * @param \Solutionexcel\Faqs\Api\Data\FaqsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
