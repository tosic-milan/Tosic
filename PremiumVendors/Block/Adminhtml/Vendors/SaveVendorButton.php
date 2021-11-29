<?php

namespace Tosic\PremiumVendors\Block\Adminhtml\Vendors;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveVendorButton extends GenericButton implements ButtonProviderInterface
{
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    )
    {
        parent::__construct($context, $registry);
    }

    public function getButtonData()
    {
        $data = [];
        $data = [
            'label' => __('Save Vendor'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
        return $data;
    }

}
