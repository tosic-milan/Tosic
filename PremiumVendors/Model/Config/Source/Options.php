<?php
namespace Tosic\PremiumVendors\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Options implements ArrayInterface
{
    /**
    * @return array
    */
    public function toOptionArray()
    {
        $options = [
            0 => [
            'label' => 'No',
            'value' => 0
            ],
            1 => [
            'label' => 'Yes',
            'value' => 1
            ],
        ];

        return $options;
    }
}
