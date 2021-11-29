<?php
namespace Tosic\PremiumVendors\Block\Adminhtml\Vendors;

use Magento\Search\Controller\RegistryConstants;

class GenericButton
{
    protected $urlBuilder;
    protected $registry;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    public function getId()
    {
        $id = $this->registry->registry('current-vendor-id');
        return $id ? $id : null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

}
