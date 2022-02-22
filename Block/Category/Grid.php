<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Category_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Category/grid.php');
	}

	public function getCategoryData()
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel->fetchAll("SELECT * FROM categories");
		return $category;
	}
}