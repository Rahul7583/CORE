<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Product_Media extends Model_Core_Row
{
	protected $product = null;

	public function __construct()
	{
		$this->setResourceClassName('Product_Media_Resource');			
	}

	public function setProduct(Model_Product $product)
	{
		$this->product = $product;
		return $this;
	}

	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product'); 
		
		if(!$this->productId)
		{
			return $productModel;
		}
		if($this->product && !$reload)
		{
			return $this->product;
		}
		$product = $productModel->fetchRow("SELECT * FROM `product` WHERE `productId` = {$this->productId}");
		if(!$product)
		{
			return null;
		}
		$this->setProduct($product);

		return $this->product;
	}

}



