<?php

namespace Astrio\PluginModule\Api;

/**
 * Interface ModifierInterface
 * @package Astrio\PluginModule\Api
 */
interface ModifierInterface
{
    /**
     * @param string $value
     * @return string
     */
    public function modify(string $value);
}
