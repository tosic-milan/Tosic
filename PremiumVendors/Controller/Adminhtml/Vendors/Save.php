<?php

namespace Tosic\PremiumVendors\Controller\Adminhtml\Vendors;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Tosic\PremiumVendors\Model\VendorFactory;

class Save extends Action
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
        $data = $this->getRequest()->getPostValue();
        $values = $data['sample_fieldset'];
        $model = $this->_vendorFactory->create();

        $url = 'http://nominatim.openstreetmap.org/search?format=json&q='. urlencode($values['address']) .'&addressdetails=1';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                "header"  => "User-Agent: Nominatim-Test",
                'method'  => 'GET'
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        $decoded = json_decode($result, true);
        $lat = $decoded[0]["lat"];
        $lng = $decoded[0]["lon"];
        $values['lat'] = $lat;
        $values['long'] = $lng;
        $model->setData($values);
        $model->save();
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
