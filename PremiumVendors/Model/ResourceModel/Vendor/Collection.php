<?php

namespace Tosic\PremiumVendors\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'tosic_premiumvendors_vendor_collection';
    protected $_eventObject = 'vendor_collection';

    protected function _construct()
    {
        $this->_init('Tosic\PremiumVendors\Model\Vendor','Tosic\PremiumVendors\Model\ResourceModel\Vendor');
    }
}
