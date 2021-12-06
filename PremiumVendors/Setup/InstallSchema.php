<?php

namespace Tosic\PremiumVendors\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Create PremiumVendor module DB Schema
 */
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * {@inheritDoc}
    */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
            if(!$installer->tableExists('tosic_premiumvendors_vendor')){
                /**
                 * Create table `tosic_premiumvendors_vendor`
                */
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('tosic_premiumvendors_vendor')
                )
                    ->addColumn(
                        'id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'Vendor id'
                    )
                    ->addColumn(
                        'name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    )
                    ->addColumn(
                        'address',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    )
                    ->addColumn(
                        'lat',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    )
                    ->addColumn(
                        'long',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    )
                    ->addColumn(
                        'premium',
                        \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                        null
                    )
                    ->addColumn(
                        'street',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    )
                    ->addColumn(
                        'postal_code',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    )
                    ->addColumn(
                        'city',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    )
                    ->addColumn(
                        'country',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255
                    );
                $installer->getConnection()->createTable($table);
            }

        $installer->endSetup();
    }
}
