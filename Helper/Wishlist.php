<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\AddToLinks\Helper;

class Wishlist extends \Magento\Wishlist\Helper\Data
{
    /**
     * {@inheritdoc}
     */
    public function getRemoveParams($item, $addReferer = false)
    {
        $url = $this->_getUrl('mgk_addtolinks/wishlist_index/remove');
        $params = ['item' => $item->getWishlistItemId()];
        if ($addReferer) {
            $params = $this->addRefererToParams($params);
        }
        return $this->_postDataHelper->getPostData($url, $params);
    }

    /**
     * {@inheritdoc}
     */
    public function getAddParams($item, array $params = [])
    {
        $productId = null;
        if ($item instanceof \Magento\Catalog\Model\Product) {
            $productId = $item->getEntityId();
        }
        if ($item instanceof \Magento\Wishlist\Model\Item) {
            $productId = $item->getProductId();
        }

        $url = $this->_getUrlStore($item)->getUrl('mgk_addtolinks/wishlist_index/add');
        if ($productId) {
            $params['product'] = $productId;
        }

        return $this->_postDataHelper->getPostData($url, $params);
    }
}
