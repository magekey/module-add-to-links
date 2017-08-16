<?php
/**
 * Copyright © MageKey. All rights reserved.
 */
namespace MageKey\AddToLinks\Controller\Compare;

class Add extends \Magento\Catalog\Controller\Product\Compare\Add
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
