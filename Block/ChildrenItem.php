<?php
namespace Luxinten\ChildProductReport\Block;

use Exception;
use Psr\Log\LoggerInterface;
use Magento\Bundle\Api\Data\LinkInterface;
use Magento\Bundle\Api\ProductLinkManagementInterface;

class ChildrenItem extends Magento\Backend\Block\Widget\Grid\Column
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ProductLinkManagementInterface
     */
    private $productLinkManagement;

    public function __construct(
        LoggerInterface $logger,
        ProductLinkManagementInterface $productLinkManagement
    ) {
        $this->logger = $logger;
        $this->productLinkManagement = $productLinkManagement;
    }

    /**
     * Get all children items of bundle product
     *
     * @return LinkInterface[]
     */
    public function getChildrenItems()
    {

        try {
            $items = $this->productLinkManagement->getChildren($sku);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return $items;
    }
}
