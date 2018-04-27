<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Model\Config\Source;

class Templates implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Keys
     */
    const TEMPLATE_DEFAULT = 'default';

    const TEMPLATE_CHECKBOX = 'checkbox';

    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => static::TEMPLATE_DEFAULT, 'label' => __('Default Template')],
            ['value' => static::TEMPLATE_CHECKBOX, 'label' => __('Checkbox Template')],
        ];
    }
}
