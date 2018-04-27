<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Controller\Wishlist;

class Remove extends \Magento\Wishlist\Controller\Index\Remove
{
    use \MageKey\AddToLinks\Controller\ResponseTrait;

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        return $this->executeParent();
    }
}
