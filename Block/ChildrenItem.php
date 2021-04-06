<?php
namespace Luxinten\ChildProductReport\Block;

use Exception;
use Psr\Log\LoggerInterface;
use Magento\Bundle\Api\Data\LinkInterface;
use Magento\Bundle\Api\ProductLinkManagementInterface;
use Magento\Backend\Block\Widget\Grid\Column;

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
    protected $product;
    protected $column;

    public function __construct(
        LoggerInterface $logger,
        ProductLinkManagementInterface $productLinkManagement,
        \Magento\Catalog\Model\Product $product,
        \Magento\Backend\Block\Widget\Grid\Column $column
    ) {
        $this->logger = $logger;
        $this->productLinkManagement = $productLinkManagement;
        $this->_product = $product;
        $this->_column = $column;
    }

    public function getSkuProduct() {
        // получить  $renderedValue с Magento\Backend\Block\Widget\Grid\Column.php
        // льтровать только  sku
        // $sku = $this->_column->getRowField();
        $sku = "BAB";
        if($this->_product->getIdBySku($sku)) {
            return $sku;
        }
    }


    public function getChildrenItems()
    {
        echo '<pre>';
        print_r("TYT");
        echo '</pre>';
        exit();
        $sku = $this->getSkuProduct();
        try {
            $items = $this->productLinkManagement->getChildren($sku);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        foreach ($items as $item) {
            $res = $item->getData();
        }
        return $res;
    }
}
