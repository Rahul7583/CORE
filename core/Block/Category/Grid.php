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
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('categoryId') as totalCount FROM categories;");
		$this->getPager()->execute($totalRecord, $current,$ppr);

		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel->fetchAll("SELECT * FROM categories
												Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");

		$path = $categoryModel->getPath();
		foreach ($category as $key => $value) 
		{
			if(array_key_exists($value->categoryId, $path))
			{
				 $category[$key]->path = $path[$value->categoryId];  
			}	
		}
		return $category;
	}
}