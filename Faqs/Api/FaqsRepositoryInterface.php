<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqsRepositoryInterface
{


    /**
     * Save Faqs
     * @param \Solutionexcel\Faqs\Api\Data\FaqsInterface $faqs
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Solutionexcel\Faqs\Api\Data\FaqsInterface $faqs
    );

    /**
     * Retrieve Faqs
     * @param string $faqsId
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($faqsId);

    /**
     * Retrieve Faqs matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Solutionexcel\Faqs\Api\Data\FaqsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Faqs
     * @param \Solutionexcel\Faqs\Api\Data\FaqsInterface $faqs
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Solutionexcel\Faqs\Api\Data\FaqsInterface $faqs
    );

    /**
     * Delete Faqs by ID
     * @param string $faqsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqsId);
}
