<?php

namespace Astrio\PluginModule\Modifier;

use Astrio\PluginModule\Api\ModifierInterface;
use Astrio\PluginModule\Helper\Config as ConfigHelper;

/**
 * Class ModifierProduct
 * @package Astrio\PluginModule\Modifier
 */
class ModifierProduct implements ModifierInterface
{
    /** @var ConfigHelper */
    protected $configHelper;

    /** @var string */
    protected $xmlPathPrefix;

    /** @var string */
    protected $xmlPathPostfix;

    /**
     * ModifierProductInfo constructor
     * @param ConfigHelper $configHelper
     * @param string $xmlPathPrefix
     * @param string $xmlPathPostfix
     */
    public function __construct(
        ConfigHelper $configHelper,
        string $xmlPathPrefix,
        string $xmlPathPostfix
    ) {
        $this->configHelper = $configHelper;
        $this->xmlPathPrefix = $xmlPathPrefix;
        $this->xmlPathPostfix = $xmlPathPostfix;
    }

    /**
     * @param string $value
     * @return string
     */
    public function modify(string $value)
    {
        $prefix = $this->configHelper->getModuleConfig($this->xmlPathPrefix);
        $postfix = $this->configHelper->getModuleConfig($this->xmlPathPostfix);

        return $prefix . $value . $postfix;
    }
}
