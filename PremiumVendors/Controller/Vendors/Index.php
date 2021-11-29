<?php

namespace Tosic\PremiumVendors\Controller\Vendors;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Tosic\PremiumVendors\Model\VendorFactory;
use Magento\Framework\App\Action\Context;



class Index extends  \Magento\Framework\App\Action\Action
{

    protected $_resultPageFactory;
    protected $_vendorFactory;

    public function __construct(Context $context, PageFactory $pageFactory, VendorFactory $vendorFactory
    )
    {
        parent::__construct($context);

        $this->_vendorFactory = $vendorFactory;
        $this->_resultPageFactory = $pageFactory;
    }

    public function execute()
    {
        $vendors = $this->_vendorFactory->create();
        $vendorsCollection = $vendors->getCollection();
        return $this->_resultPageFactory->create();
    }

}
