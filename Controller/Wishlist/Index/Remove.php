<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\AddToLinks\Controller\Wishlist\Index;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Remove extends \Magento\Wishlist\Controller\Index\Remove
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        try {
            parent::execute();
        } catch (\Exception $e) {
            return;
        }
    }
}