<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\AddToLinks\Controller\Compare;

class Remove extends \Magento\Catalog\Controller\Product\Compare\Remove
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
