<?php
namespace Tosic\PremiumVendors\Controller\Adminhtml\Vendors;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Tosic\PremiumVendors\Model\VendorFactory;
use Magento\Framework\App\Request\Http;



class Delete extends Action
{
    protected $_resultPageFactory;
    protected $_vendorFactory;
    protected $_request;

    /**
     * @param \Magento\Backend\App\Action\Context
     * @param Magento\Framework\View\Result\PageFactory
     * @param \Magento\Framework\App\Request\Http
     */
    public function __construct(Context $context, PageFactory $pageFactory, VendorFactory $vendorFactory, Http $request)
    {
        parent::__construct($context);

        $this->_vendorFactory = $vendorFactory;
        $this->_resultPageFactory = $pageFactory;
        $this->_request = $request;
    }


    /**
     * Delete Vendor action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->_request->getParam('id');

        $model = $this->_vendorFactory->create();
        $model->load($id);
        $model->delete();

        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
