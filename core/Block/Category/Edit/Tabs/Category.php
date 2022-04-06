<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 
class Block_Category_Edit_Tabs_Category extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/edit/tabs/category.php');
	}

	public function getCategory()
	{
		return Ccc::getRegistry('category');
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

	public function setEdit($edit)
    {
        $this->edit = $edit;
        return $this;
    }

    public function getEdit()
    {
        return $this->edit;
    }

    public function getSaveUrl()
	{
		return $this->getUrl('save','categories');
	}
} 