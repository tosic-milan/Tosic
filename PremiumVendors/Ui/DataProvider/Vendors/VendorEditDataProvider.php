<?php

/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Tosic\PremiumVendors\Ui\DataProvider\Vendors;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
/**
 * Class DataProvider
 */
class VendorEditDataProvider extends DataProvider
{
    protected $_loadedData;


    public function __construct( \Tosic\PremiumVendors\Model\VendorFactory $myCollectionFactory
        ,$name, $primaryFieldName, $requestFieldName, ReportingInterface $reporting, SearchCriteriaBuilder $searchCriteriaBuilder, RequestInterface $request, FilterBuilder $filterBuilder, array $meta = [], array $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request, $filterBuilder, $meta, $data);
        $this->collection = $myCollectionFactory->create();
    }
    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getCollection();
        foreach ($items as $vendor) {
            $this->_loadedData[$vendor->getId()] = ['sample_fieldset' => $vendor->getData()];
        }
        return $this->_loadedData;

    }
}
