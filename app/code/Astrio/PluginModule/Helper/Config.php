<?php

namespace Astrio\PluginModule\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Astrio\PluginModule\Helper
 */
class Config extends AbstractHelper
{
    const XML_PATH_INCREMENT_PRICE_ENABLED = 'astrio_increment_price/general/enabled';
    const XML_PATH_INCREMENT_PRICE_VALUE = 'astrio_increment_price/general/increment';

    const XML_PATH_MOD_INFO_ENABLED = 'astrio_mod_info/general/enabled';

    const XML_PATH_MOD_INFO_NAME_ENABLED = 'astrio_mod_info/name/enabled';
    const XML_PATH_MOD_INFO_NAME_PREFIX = 'astrio_mod_info/name/prefix';
    const XML_PATH_MOD_INFO_NAME_POSTFIX = 'astrio_mod_info/name/postfix';

    const XML_PATH_MOD_INFO_SKU_ENABLED = 'astrio_mod_info/sku/enabled';
    const XML_PATH_MOD_INFO_SKU_PREFIX = 'astrio_mod_info/sku/prefix';
    const XML_PATH_MOD_INFO_SKU_POSTFIX = 'astrio_mod_info/sku/postfix';

    /**
     * @param string $path
     * @return mixed
     */
    public function getModuleConfig(string $path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }
}
