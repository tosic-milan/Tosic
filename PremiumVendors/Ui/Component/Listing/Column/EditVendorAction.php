<?php

namespace Tosic\PremiumVendors\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class EditVendorAction extends Column
{
    private $urlBuilder;
    const URL_PATH_EDIT = 'premiumvendors/vendors/editvendor/';
    private $viewUrl;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $viewUrl = self::URL_PATH_EDIT
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->viewUrl = $viewUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);

    }


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['view'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_EDIT, ['id' => $item['id']]),
                        'label' => __('Edit')
                    ];
                }
            }
        }
        return $dataSource;
    }
}
