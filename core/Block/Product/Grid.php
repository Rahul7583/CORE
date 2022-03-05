<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Product_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Product/grid.php');
	}

	public function getProductData()
		{
		$productModel = Ccc::getModel('Product');
		$product = $productModel->fetchAll("SELECT p.*,
														 base.name as base,
														 thumbnail.name as thumbnail,
														 small.name as small
												FROM product p 
												LEFT JOIN image base
												ON p.productId = base.productId AND (base.base = 1)
												LEFT JOIN image thumbnail 
												ON p.productId = thumbnail.productId AND (thumbnail.thumbnail = 1)
												LEFT JOIN image small
												ON p.productId = small.productId AND (small.small = 1)");
	
		return $product;
	}

}