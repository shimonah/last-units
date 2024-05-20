<?php
declare(strict_types=1);

namespace Os\LastUnits\ViewModel;

use Os\LastUnits\Helper\Config;
use Os\LastUnits\Model\StockManagement;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;

class ProductList implements ArgumentInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var StockManagement
     */
    private $stockManagement;

    /**
     * @param Config $config
     * @param StockManagement $stockManagement
     */
    public function __construct(
        Config $config,
        StockManagement $stockManagement
    ) {
        $this->config = $config;
        $this->stockManagement = $stockManagement;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->config->isEnabled();
    }

    /**
     * @param ProductInterface $product
     * @return bool
     */
    public function isTagVisible(ProductInterface $product): bool
    {
        $stockItem = $product->getData('stock_item');
        if ($stockItem) {
            $qty = $stockItem->getQty();
            $threshold = $this->config->getThreshold();

            if ($qty < $threshold) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param AbstractCollection $productCollection
     * @return AbstractCollection
     */
    public function addStockData(AbstractCollection $productCollection)
    {
        $stockItems = $this->stockManagement->getStockItems($productCollection->getAllIds());

        array_map(function($product) use ($stockItems) {
            $productId = $product->getId();
            if (isset($stockItems[$productId])) {
                $product->setData('stock_item', $stockItems[$productId]);
            }
        }, $productCollection->getItems());

        return $productCollection;
    }


}
