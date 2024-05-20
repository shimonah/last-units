<?php
declare(strict_types=1);

namespace Os\LastUnits\Plugin\Block\Product\View;

use Os\LastUnits\Block\Tag;
use Os\LastUnits\Helper\Config;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Exception\LocalizedException;
use Magento\Catalog\Block\Product\View\Gallery as MagentoGallery;

class Gallery
{
    private const NAME_IN_LAYOUT = 'product.info.media.image';

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * dd tag label block
     *
     * @param MagentoGallery $subject
     * @param string $result
     * @return string
     * @throws LocalizedException
     */
    public function afterToHtml(MagentoGallery $subject, string $result)
    {
        if ($subject->getNameInLayout() === self::NAME_IN_LAYOUT && $this->config->isEnabled()) {
            $layout = $subject->getLayout();
            $product = $subject->getProduct();

            if ($product && $product->getExtensionAttributes()
                && $product->getExtensionAttributes()->getStockItem()) {
                $stockItem = $product->getExtensionAttributes()->getStockItem();
                $qty = $stockItem->getQty();
                $threshold = $this->config->getThreshold();

                if ($qty < $threshold) {
                    $result = $this->renderTag($layout) . $result;
                }
            }
        }

        return $result;
    }

    /**
     * Renders tag block
     *
     * @param LayoutInterface $layout
     * @return null|string
     */
    private function renderTag(LayoutInterface $layout): ?string
    {
        return $layout->createBlock(Tag::class)
            ->setTemplate('Os_LastUnits::tag.phtml')
            ->toHtml();
    }
}
