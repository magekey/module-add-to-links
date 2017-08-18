<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\AddToLinks\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\DB\Select;

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
        $items = $this->getItems();
        return [
            'count' => count($items),
            'items' => $items
        ];
    }

    /**
     * Get wishlist items
     *
     * @return array
     */
    public function getItems()
    {
        $wishlistCollection = $this->wishlistHelper->getWishlistItemCollection();
        $collection = clone $wishlistCollection;
        $collection->clear()
            ->setPageSize(null)
            ->getSelect()
            ->reset(Select::LIMIT_COUNT)
            ->reset(Select::LIMIT_OFFSET);
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
