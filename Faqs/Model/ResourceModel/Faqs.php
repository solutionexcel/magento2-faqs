<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Model\ResourceModel;

class Faqs extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('solutionexcel_faqs_faqs', 'faqs_id');
    }
}
