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

	public function getPath()
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel->fetchAll("SELECT * FROM categories ORDER BY path");
		$path = $categoryModel->getPath();
		if($category){
			foreach ($category as $key => $value) 
			{
				if(array_key_exists($value->categoryId, $path))
				{
					 $category[$key]->path = $path[$value->categoryId];  
				}	
			}
		}
		return $category;
	}
} 