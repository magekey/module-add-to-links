<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Helper;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Data\Helper\PostHelper;

class Compare extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Route for compare add
     */
    const ROUTE_COMPARE_ADD = 'mgk-addtolinks/compare/add';

    /**
     * Route for compare remove
     */
    const ROUTE_COMPARE_REMOVE = 'mgk-addtolinks/compare/remove';

    /**
     * @var PostHelper
     */
    protected $_postHelper;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param PostHelper $postHelper
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        PostHelper $postHelper
    ) {
        $this->_postHelper = $postHelper;
        parent::__construct($context);
    }

    /**
     * Retrieve add params
     *
     * @param ProductInterface $product
     * @return string
     */
    public function getAddParams(ProductInterface $product)
    {
        return $this->_postHelper->getPostData(
            $this->_getUrl(self::ROUTE_COMPARE_ADD),
            ['product' => $product->getId()]
        );
    }

    /**
     * Retrieve remove params
     *
     * @param ProductInterface $product
     * @return string
     */
    public function getRemoveParams(ProductInterface $product)
    {
        $data = [
            \Magento\Framework\App\ActionInterface::PARAM_NAME_URL_ENCODED => '',
            'product' => $product->getId(),
        ];
        return $this->_postHelper->getPostData(
            $this->_getUrl(self::ROUTE_COMPARE_REMOVE),
            $data
        );
    }
}
