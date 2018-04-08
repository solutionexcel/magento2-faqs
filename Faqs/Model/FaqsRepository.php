<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Model;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Solutionexcel\Faqs\Api\Data\FaqsSearchResultsInterfaceFactory;
use Solutionexcel\Faqs\Model\ResourceModel\Faqs\CollectionFactory as FaqsCollectionFactory;
use Solutionexcel\Faqs\Model\ResourceModel\Faqs as ResourceFaqs;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\DataObjectHelper;
use Solutionexcel\Faqs\Api\FaqsRepositoryInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Reflection\DataObjectProcessor;
use Solutionexcel\Faqs\Api\Data\FaqsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;

class FaqsRepository implements faqsRepositoryInterface
{

    protected $faqsFactory;

    protected $dataObjectProcessor;

    protected $dataFaqsFactory;

    private $storeManager;

    protected $dataObjectHelper;

    protected $faqsCollectionFactory;

    protected $resource;

    protected $searchResultsFactory;


    /**
     * @param ResourceFaqs $resource
     * @param FaqsFactory $faqsFactory
     * @param FaqsInterfaceFactory $dataFaqsFactory
     * @param FaqsCollectionFactory $faqsCollectionFactory
     * @param FaqsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceFaqs $resource,
        FaqsFactory $faqsFactory,
        FaqsInterfaceFactory $dataFaqsFactory,
        FaqsCollectionFactory $faqsCollectionFactory,
        FaqsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->faqsFactory = $faqsFactory;
        $this->faqsCollectionFactory = $faqsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataFaqsFactory = $dataFaqsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Solutionexcel\Faqs\Api\Data\FaqsInterface $faqs
    ) {
        /* if (empty($faqs->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $faqs->setStoreId($storeId);
        } */
        try {
            $faqs->getResource()->save($faqs);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the faqs: %1',
                $exception->getMessage()
            ));
        }
        return $faqs;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($faqsId)
    {
        $faqs = $this->faqsFactory->create();
        $faqs->getResource()->load($faqs, $faqsId);
        if (!$faqs->getId()) {
            throw new NoSuchEntityException(__('Faqs with id "%1" does not exist.', $faqsId));
        }
        return $faqs;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->faqsCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Solutionexcel\Faqs\Api\Data\FaqsInterface $faqs
    ) {
        try {
            $faqs->getResource()->delete($faqs);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Faqs: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($faqsId)
    {
        return $this->delete($this->getById($faqsId));
    }
}
