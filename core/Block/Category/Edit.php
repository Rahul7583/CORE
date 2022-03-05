<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Category_Edit extends Block_Core_Template
{
	protected $category = null;

	public function __construct()
	{
		$this->setTemplate('view/Category/edit.php');
	}

	public function setCategory($category)
	{
		$this->category = $category;
		return $this;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function getCategoriesEdit()
   	{
   		$categoryModel = Ccc::getModel('category');
        $categories = $categoryModel->fetchAll("SELECT * FROM `categories` ORDER BY `path`");
        return $categories;
   	}

	public function getSubPath($categoryId)
    {
	    $categoryModel = Ccc::getModel('Category');
	    $category = $categoryModel->fetchAll("SELECT * FROM categories WHERE path NOT LIKE '%$categoryId%' order by `path`");
	    return $category;
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

	public function getpath($path)
	{
		$categoryModel = Ccc::getModel('Category');
		$value = explode('=>',$path); 
		foreach ($value as $pa) {
			$query = $categoryModel->fetchAll("SELECT  * FROM `categories` WHERE name = `$pa`");
		}
		return $temp;
	}
} 