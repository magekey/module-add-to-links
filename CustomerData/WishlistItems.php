<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\AddToLinks\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;

class WishlistItems implements SectionSourceInterface
{
    /**
     * @var \Magento\Wishlist\Helper\Data
     */
    protected $wishlistHelper;

    /**
     * @param \Magento\Wishlist\Helper\Data $wishlistHelper
     */
    public function __construct(
        \Magento\Wishlist\Helper\Data $wishlistHelper
    ) {
        $this->wishlistHelper = $wishlistHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getSectionData()
    {
        return [
            'items' => $this->getItems()
        ];
    }

    /**
     * Get wishlist items
     *
     * @return array
     */
    public function getItems()
    {
        $collection = $this->wishlistHelper->getWishlistItemCollection();
        $items = [];
        foreach ($collection as $wishlistItem) {
            $items[] = $this->getItemData($wishlistItem);
        }
        return $items;
    }

    /**
     * Retrieve wishlist item data
     *
     * @param \Magento\Wishlist\Model\Item $wishlistItem
     * @return array
     */
    public function getItemData(\Magento\Wishlist\Model\Item $wishlistItem)
    {
        return [
            'item_id' => $wishlistItem->getId(),
            'product_id' => $wishlistItem->getProduct()->getId()
        ];
    }
}
