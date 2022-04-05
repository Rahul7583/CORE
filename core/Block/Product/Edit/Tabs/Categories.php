<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 
class Block_Product_Edit_Tabs_Categories extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/categories.php');
	}

	public function getProduct()
	{
		return Ccc::getRegistry('product');
	}

	public function getCategory()
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel->fetchAll("SELECT * FROM categories where status = 1");
		return $category;
	}

	public function getCategoryProduct()
	{
		$categoryProductModel = Ccc::getModel('Category_Product');
		$categoryProduct = $categoryProductModel->fetchAll("SELECT categoryId,productId FROM category_product");
		return $categoryProduct;	
	}

	public function path($path)
	{
		global $adapter;
		$value = explode('/',$path); 
		foreach ($value as $path1) {
			$query = $adapter->fetchRow("SELECT  `name` FROM `categories` WHERE categoryId = {$path1}");
			$parentName[] = $query['name'];

			$temp = [];
			$temp = implode("=>", $parentName);
		}
		return $temp;
	}
}