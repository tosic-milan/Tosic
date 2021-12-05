<?php

namespace Tosic\PremiumVendors\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        var_dump("Heloo world");
        if(version_compare($context->getVersion(), '2.0.0', '<')) {
            var_dump("Heloo world");
            $this->removeAddress($installer);
        }

        $installer->endSetup();
    }

    protected function removeAddress(SchemaSetupInterface $installer){
        $installer->getConnection()->dropColumn(
            $installer->getTable('tosic_premiumvendors_vendor'),
            'address'
        );
    }
}
