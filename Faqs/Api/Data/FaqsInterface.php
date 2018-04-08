<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Api\Data;

interface FaqsInterface
{

    const FAQS_ID = 'faqs_id';
    const CREATED_AT = 'created_at';
    const ANSWERS = 'answers';
    const CUSTOMER_NAME = 'customer_name';
    const CUSTOMER_EMAIL = 'customer_email';
    const QUESTIONS = 'questions';
    const STATUS = 'status';
    const ORDER = 'order';


    /**
     * Get faqs_id
     * @return string|null
     */
    public function getFaqsId();

    /**
     * Set faqs_id
     * @param string $faqs_id
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setFaqsId($faqsId);

    /**
     * Get questions
     * @return string|null
     */
    public function getQuestions();

    /**
     * Set questions
     * @param string $questions
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setQuestions($questions);

    /**
     * Get answers
     * @return string|null
     */
    public function getAnswers();

    /**
     * Set answers
     * @param string $answers
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setAnswers($answers);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setStatus($status);

    /**
     * Get order
     * @return string|null
     */
    public function getOrder();

    /**
     * Set order
     * @param string $order
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setOrder($order);

    /**
     * Get customer_name
     * @return string|null
     */
    public function getCustomerName();

    /**
     * Set customer_name
     * @param string $customer_name
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setCustomerName($customer_name);

    /**
     * Get customer_email
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * Set customer_email
     * @param string $customer_email
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setCustomerEmail($customer_email);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $created_at
     * @return \Solutionexcel\Faqs\Api\Data\FaqsInterface
     */
    public function setCreatedAt($created_at);
}
