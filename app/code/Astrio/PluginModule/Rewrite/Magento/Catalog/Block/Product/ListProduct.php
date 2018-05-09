<?php

namespace Astrio\PluginModule\Rewrite\Magento\Catalog\Block\Product;

use Magento\Catalog\Block\Product\ListProduct as BaseListProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Url\Helper\Data as UrlDataHelper;
use Astrio\PluginModule\Helper\Config as ConfigHelper;

/**
 * Class ListProduct
 * @package Astrio\PluginModule\Rewrite\Magento\Catalog\Block\Product
 */
class ListProduct extends BaseListProduct
{
    /** @var ConfigHelper */
    protected $configHelper;

    /**
     * ListProduct constructor
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param UrlDataHelper $urlHelper
     * @param ConfigHelper $configHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        UrlDataHelper $urlHelper,
        ConfigHelper $configHelper,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data
        );
        $this->configHelper = $configHelper;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getProductPrice(\Magento\Catalog\Model\Product $product)
    {
        $priceRender = $this->getPriceRender();

        $price = '';
        if ($priceRender) {
            $price = $priceRender->render(
                \Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE,
                $product,
                [
                    'include_container' => true,
                    'display_minimal_price' => true,
                    'zone' => \Magento\Framework\Pricing\Render::ZONE_ITEM_LIST,
                    'list_category_page' => true
                ]
            );
        }

        if ($this->configHelper->getModuleConfig(ConfigHelper::XML_PATH_INCREMENT_PRICE_ENABLED)) {
            $price .= '<div class="price-box"><span class="price">' . __('Increased Price') . '</span></div>';
        }

        return $price;
    }
}
