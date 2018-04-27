<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Controller;

use Magento\Framework\Controller\ResultFactory;

trait ResponseTrait
{
    /**
     * {@inheritdoc}
     */
    protected function executeParent()
    {
        $response = ['success' => true];
        try {
            $result = parent::execute();
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $this->resultFactory
            ->create(ResultFactory::TYPE_JSON)
            ->setData($response);
    }
}
