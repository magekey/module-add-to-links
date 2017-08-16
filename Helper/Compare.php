<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\AddToLinks\Helper;

class Compare extends \Magento\Catalog\Helper\Product\Compare
{
    /**
     * {@inheritdoc}
     */
    public function getAddUrl()
    {
        return $this->_getUrl('mgk_addtolinks/compare/add');
    }

    /**
     * Get parameters to remove products from compare list
     *
     * @param Product $product
     * @return string
     */
    public function getRemoveUrl()
    {
        return $this->_getUrl('mgk_addtolinks/compare/remove');
    }
}
