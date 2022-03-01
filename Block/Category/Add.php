
<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Category_Add extends Block_Core_Template
{

  public function __construct()
  {
    $this->setTemplate('view/Category/add.php');
  }

  public function getCategoryData()
  {
  	$categoryModel = Ccc::getModel('Category');
  	$category = $categoryModel->fetchAll("SELECT name, path FROM categories ORDER BY path");
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