<?php
/**
 * Copyright © MageKey. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageKey\AddToLinks\Helper;

use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Configs
     */
    const XML_PATH_ENABLED = 'catalog/mgk_addtolinks/enabled';

    const XML_PATH_TEMPLATE = 'catalog/mgk_addtolinks/template';

    /**
     * Check if module enabled
     *
     * @param mixed $scopeCode
     * @return bool
     */
    public function isEnabled($scopeCode = null)
    {
        return $this->scopeConfig->isSetFlag(
            static::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Retrieve template
     *
     * @param mixed $scopeCode
     * @return string
     */
    public function getTemplate($scopeCode = null)
    {
        return $this->scopeConfig->getValue(
            static::XML_PATH_TEMPLATE,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }
}
