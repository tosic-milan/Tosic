<?php

namespace Tosic\PremiumVendors\Model;

class Vendor extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'tosic_premiumvendors_vendor';
    protected $_cacheTag = 'tosic_premiumvendors_vendor';
    protected $_eventPrefix = 'tosic_premiumvendors_vendor';

    public function __construct(\Magento\Framework\Model\Context $context,
                                \Magento\Framework\Registry $registry)
    {
        parent::__construct($context, $registry);
        $this->_init('Tosic\PremiumVendors\Model\ResourceModel\Vendor');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

}
