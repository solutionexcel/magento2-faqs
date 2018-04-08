<?php
/**
 * @package     Solutionexcel_Faqs
 * @author      SolutionExcel - https://www.solutionexcel.com/ - info@solutionexcel.com
 * @copyright   Copyright © 2018 SolutionExcel. All rights reserved.
 * @license     https://opensource.org/licenses/AFL-3.0  Academic Free License 3.0 | Open Source Initiative
**/

namespace Solutionexcel\Faqs\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_solutionexcel_faqs_faqs = $setup->getConnection()->newTable($setup->getTable('solutionexcel_faqs_faqs'));

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'faqs_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'questions',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'questions'
        );
        

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'answers',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'answers'
        );
        

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'status'
        );
        

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'order',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'order'
        );
        

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'customer_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'customer_name'
        );
        

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'customer_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'customer_email'
        );
        

        
        $table_solutionexcel_faqs_faqs->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'created_at'
        );
        

        $setup->getConnection()->createTable($table_solutionexcel_faqs_faqs);

        $setup->endSetup();
    }
}
