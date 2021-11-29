<?php

namespace Tosic\PremiumVendors\Block\Adminhtml\Vendors;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
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
        if($this->getId()){
            $data = [
                'label' => __('Delete Vendor'),
                'class' => 'scalable delete',
                'on_click' => sprintf("location.href = '%s';", $this->getDeleteUrl()),
//                'data_attribute' => [
//                    'url' => $this->getDeleteUrl()
//                ],
                'sort_order' => 90,
            ];
        }
        return $data;
    }

    private function getVendorId() : string
    {
        return $this->getId();
    }

    private function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getVendorId()] );
    }


}
