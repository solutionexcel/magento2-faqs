<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Model;

use Solutionexcel\Faqs\Api\Data\FaqsInterface;

class Faqs extends \Magento\Framework\Model\AbstractModel implements FaqsInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Solutionexcel\Faqs\Model\ResourceModel\Faqs');
    }

    /**
     * Get faqs_id
     * @return string
     */
    public function getFaqsId()
    {
        return $this->getData(self::FAQS_ID);
    }

    /**
     * Set faqs_id
     * @param string $faqsId
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setFaqsId($faqsId)
    {
        return $this->setData(self::FAQS_ID, $faqsId);
    }

    /**
     * Get questions
     * @return string
     */
    public function getQuestions()
    {
        return $this->getData(self::QUESTIONS);
    }

    /**
     * Set questions
     * @param string $questions
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setQuestions($questions)
    {
        return $this->setData(self::QUESTIONS, $questions);
    }

    /**
     * Get answers
     * @return string
     */
    public function getAnswers()
    {
        return $this->getData(self::ANSWERS);
    }

    /**
     * Set answers
     * @param string $answers
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setAnswers($answers)
    {
        return $this->setData(self::ANSWERS, $answers);
    }

    /**
     * Get status
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get order
     * @return string
     */
    public function getOrder()
    {
        return $this->getData(self::ORDER);
    }

    /**
     * Set order
     * @param string $order
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setOrder($order)
    {
        return $this->setData(self::ORDER, $order);
    }

    /**
     * Get customer_name
     * @return string
     */
    public function getCustomerName()
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    /**
     * Set customer_name
     * @param string $customer_name
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setCustomerName($customer_name)
    {
        return $this->setData(self::CUSTOMER_NAME, $customer_name);
    }

    /**
     * Get customer_email
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    /**
     * Set customer_email
     * @param string $customer_email
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setCustomerEmail($customer_email)
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customer_email);
    }

    /**
     * Get created_at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $created_at
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }
}
