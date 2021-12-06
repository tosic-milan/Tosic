<?php

namespace Tosic\PremiumVendors\Block\Vendors;

use Magento\Framework\View\Element\Template;
use Tosic\PremiumVendors\Model\VendorFactory;

class VendorsLocationBlock  extends \Magento\Framework\View\Element\Template
{
    protected VendorFactory $_vendorsFactory;

    public function __construct(Template\Context $context,VendorFactory $_vendorsFactory, array $data = [])
    {
        $this->_vendorsFactory = $_vendorsFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get list of vendors to been displayed on map
    */
    public function getVendorsJSON(): string
    {
        $vendors = $this->_vendorsFactory->create();
        $collection = $vendors->getCollection();
        return  json_encode($collection->toArray());
    }
}
