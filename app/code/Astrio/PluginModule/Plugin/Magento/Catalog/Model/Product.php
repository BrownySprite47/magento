<?php

namespace Astrio\PluginModule\Plugin\Magento\Catalog\Model;

use Magento\Catalog\Model\Product as BaseProduct;
use Astrio\PluginModule\Helper\Config as ConfigHelper;
use Astrio\PluginModule\Api\ModifierInterface;

/**
 * Class Product
 * @package Astrio\PluginModule\Plugin\Magento\Catalog\Model
 */
class Product
{
    /** @var ConfigHelper */
    protected $configHelper;

    /** @var ModifierInterface */
    protected $nameModifier;

    /** @var ModifierInterface */
    protected $skuModifier;

    /**
     * Product constructor
     * @param ConfigHelper $configHelper
     * @param ModifierInterface $nameModifier
     * @param ModifierInterface $skuModifier
     */
    public function __construct(
        ConfigHelper $configHelper,
        ModifierInterface $nameModifier,
        ModifierInterface $skuModifier
    ) {
        $this->configHelper = $configHelper;
        $this->nameModifier = $nameModifier;
        $this->skuModifier = $skuModifier;
    }

    /**
     * @param BaseProduct $subject
     * @param float $result
     * @return string
     */
    public function afterGetPrice(BaseProduct $subject, $result)
    {
        if ($this->configHelper->getModuleConfig(ConfigHelper::XML_PATH_INCREMENT_PRICE_ENABLED)) {
            $result += $this->configHelper->getModuleConfig(ConfigHelper::XML_PATH_INCREMENT_PRICE_VALUE);
        }

        return $result;
    }

    /**
     * @param BaseProduct $subject
     * @param string $result
     * @return string
     */
    public function afterGetName(BaseProduct $subject, $result)
    {
        if ($this->configHelper->getModuleConfig(ConfigHelper::XML_PATH_MOD_INFO_ENABLED) &&
            $this->configHelper->getModuleConfig(ConfigHelper::XML_PATH_MOD_INFO_NAME_ENABLED)
        ) {
            $result = $this->nameModifier->modify($result);
        }

        return $result;
    }

    /**
     * @param BaseProduct $subject
     * @param string $result
     * @return string
     */
    public function afterGetSku(BaseProduct $subject, $result)
    {
        if ($this->configHelper->getModuleConfig(ConfigHelper::XML_PATH_MOD_INFO_ENABLED) &&
            $this->configHelper->getModuleConfig(ConfigHelper::XML_PATH_MOD_INFO_SKU_ENABLED)
        ) {
            $result = $this->skuModifier->modify($result);
        }

        return $result;
    }
}
