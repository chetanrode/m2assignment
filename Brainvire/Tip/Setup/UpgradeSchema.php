<?php

namespace Brainvire\Tip\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $quoteAddressTable = 'quote_address';
        $quoteTable = 'quote';
        $orderTable = 'sales_order';
        $invoiceTable = 'sales_invoice';
        $creditmemoTable = 'sales_creditmemo';

        //Setup two columns for quote, quote_address and order
        //Quote address tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'tip',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length' =>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'tip'
                ]
            );
       
        //Quote tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'tip',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'tip'

                ]
            );

        //Order tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'tip',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'tip'

                ]
            );

        //Invoice tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($invoiceTable),
                'tip',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'tip'

                ]
            );
        //Credit memo tables
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($creditmemoTable),
                'tip',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'length'=>'10,2',
                    'default' => 0.00,
                    'nullable' => true,
                    'comment' =>'tip'

                ]
            );
        $setup->endSetup();
    }
}
