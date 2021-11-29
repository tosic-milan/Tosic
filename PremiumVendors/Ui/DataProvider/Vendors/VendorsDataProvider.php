<?php

namespace Tosic\PremiumVendors\Ui\DataProvider\Vendors;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

class VendorsDataProvider extends DataProvider
{
    public function __construct( \Tosic\PremiumVendors\Model\VendorFactory $myCollectionFactory
        ,$name, $primaryFieldName, $requestFieldName, ReportingInterface $reporting, SearchCriteriaBuilder $searchCriteriaBuilder, RequestInterface $request, FilterBuilder $filterBuilder, array $meta = [], array $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request, $filterBuilder, $meta, $data);
        $this->collection = $myCollectionFactory->create();
    }

    public function getData()
    {
        return $this->collection->getCollection();
    }
}
