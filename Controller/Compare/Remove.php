<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Controller\Compare;

class Remove extends \Magento\Catalog\Controller\Product\Compare\Remove
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
