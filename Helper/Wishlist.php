<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Helper;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Wishlist\Helper\Data as WishlistHelper;
use Magento\Customer\Model\Url as CustomerUrl;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Data\Helper\PostHelper;

class Wishlist extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Route for wishlist add
     */
    const ROUTE_WISHLIST_ADD = 'mgk-addtolinks/wishlist/add';

    /**
     * Route for wishlist remove
     */
    const ROUTE_WISHLIST_REMOVE = 'mgk-addtolinks/wishlist/remove';

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var WishlistHelper
     */
    protected $_wishlistHelper;

    /**
     * @var CustomerUrl
     */
    protected $_customerUrl;

    /**
     * @var PostHelper
     */
    protected $_postDataHelper;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param StoreManagerInterface $storeManager
     * @param WishlistHelper $wishlistHelper
     * @param CustomerUrl $customerUrl
     * @param PostHelper $postDataHelper
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        StoreManagerInterface $storeManager,
        WishlistHelper $wishlistHelper,
        CustomerUrl $customerUrl,
        PostHelper $postDataHelper
    ) {
        $this->_storeManager = $storeManager;
        $this->_wishlistHelper = $wishlistHelper;
        $this->_customerUrl = $customerUrl;
        $this->_postDataHelper = $postDataHelper;
        parent::__construct($context);
    }

    /**
     * Check is allow wishlist module
     *
     * @return bool
     */
    public function isAllow()
    {
        return $this->_wishlistHelper->isAllow();
    }

    /**
     * Retrieve add params
     *
     * @param ProductInterface $product
     * @param array $params
     * @return string
     */
    public function getAddParams(ProductInterface $product, array $params = [])
    {
        $productId = $product->getEntityId();
        $url = $this->_getUrlStore($product)->getUrl(self::ROUTE_WISHLIST_ADD);
        $params['product'] = $productId;

        return $this->_postDataHelper->getPostData($url, $params);
    }

    /**
     * Retrieve remove params
     *
     * @param bool $addReferer
     * @return string
     */
    public function getRemoveParams($addReferer = false)
    {
        $url = $this->_getUrl(self::ROUTE_WISHLIST_REMOVE);
        $params = [];
        if ($addReferer) {
            $params = $this->addRefererToParams($params);
        }
        return $this->_postDataHelper->getPostData($url, $params);
    }

    /**
     * Retrieve Item Store for URL
     *
     * @param ProductInterface $product
     * @return \Magento\Store\Model\Store
     */
    protected function _getUrlStore(ProductInterface $product)
    {
        $storeId = null;
        if ($product->isVisibleInSiteVisibility()) {
            $storeId = $product->getStoreId();
        } else {
            if ($product->hasUrlDataObject()) {
                $storeId = $product->getUrlDataObject()->getStoreId();
            }
        }
        return $this->_storeManager->getStore($storeId);
    }

    /**
     * Get customer login url
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->_customerUrl->getLoginUrl();
    }
}
