<?php

namespace Tosic\PremiumVendors\Controller\Adminhtml\Vendors;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Tosic\PremiumVendors\Model\VendorFactory;

class NewVendor extends Action
{
    protected $_resultPageFactory;
    protected $_vendorFactory;
    protected $_request;
    protected $_registry;


    public function __construct(Context $context, PageFactory $pageFactory, VendorFactory $vendorFactory
        ,Http $request, Registry $registry
    )
    {
        parent::__construct($context);

        $this->_vendorFactory = $vendorFactory;
        $this->_resultPageFactory = $pageFactory;
        $this->_request = $request;
        $this->_registry = $registry;
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Vendors add'));
        return $resultPage;
    }
}
