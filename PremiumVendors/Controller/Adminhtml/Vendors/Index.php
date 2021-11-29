<?php

namespace Tosic\PremiumVendors\Controller\Adminhtml\Vendors;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use \Magento\Framework\View\Result\PageFactory;
use \Tosic\PremiumVendors\Model\VendorFactory;

class Index extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_vendorFactory;

    public function __construct(Context $context, PageFactory $pageFactory, VendorFactory $vendorFactory)
    {
        parent::__construct($context);

        $this->_vendorFactory = $vendorFactory;
        $this->_resultPageFactory = $pageFactory;
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Tosic_PremiumVendors::second_level_demo');
        $resultPage->getConfig()->getTitle()->prepend(__('Premium vendors admin'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}
