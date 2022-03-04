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
		$product = $productModel->fetchAll("SELECT * FROM product");
		return $product;
	}

}