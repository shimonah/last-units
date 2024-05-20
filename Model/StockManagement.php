<?php
declare(strict_types=1);

namespace Os\LastUnits\Model;

use Magento\CatalogInventory\Api\Data\StockItemInterface;
use Magento\CatalogInventory\Api\StockItemRepositoryInterface;
use Magento\CatalogInventory\Api\StockItemCriteriaInterfaceFactory;

class StockManagement
{
    /**
     * @var StockItemRepositoryInterface
     */
    private $stockItemRepository;

    /**
     * @var StockItemCriteriaInterfaceFactory
     */
    private $stockItemCriteriaFactory;

    /**
     * @param StockItemRepositoryInterface $stockItemRepository
     * @param StockItemCriteriaInterfaceFactory $stockItemCriteriaFactory
     */
    public function __construct(
        StockItemRepositoryInterface $stockItemRepository,
        StockItemCriteriaInterfaceFactory $stockItemCriteriaFactory

    ) {
        $this->stockItemRepository = $stockItemRepository;
        $this->stockItemCriteriaFactory = $stockItemCriteriaFactory;
    }

    /**
     * Default Stock implementation is used
     * Use Multi Source Inventory if it's enabled
     *
     * @param $productIds
     * @return StockItemInterface[]
     */
    public function getStockItems($productIds): array
    {
        $criteria = $this->stockItemCriteriaFactory->create();
        $criteria->setProductsFilter($productIds);
        $collection = $this->stockItemRepository->getList($criteria);

        return $collection->getItems();
    }
}
