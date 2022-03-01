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
		//$path = $categoryModel->getPath($category->path);

			/*print_r($category);
		foreach ($category as $key => $value) {
			if(array_key_exists($value->categoryId, $path))
			{
				$category[$key]->path = $path[$value->categoryId];
			}
		}

		echo "<pre>";
		print_r($category);
		exit();*/
		return $category;
	}

	public function path($path)
	{
		global $adapter;
		$value = explode('/',$path); 
		foreach ($value as $path1) {
			$query = $adapter->fetchRow("SELECT  `name` FROM `categories` WHERE categoryId='$path1';");
			$parentName[] = $query['name'];

			$temp = [];
			$temp = implode("=>", $parentName);
		}
		echo $temp;
		return $temp;
	}
}