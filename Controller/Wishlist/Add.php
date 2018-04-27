<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Controller\Wishlist;

class Add extends \Magento\Wishlist\Controller\Index\Add
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
