<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Category_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/category/media/grid.php');
	}

	public function getCategoryMediaData()
	{
		$categoryMediaModel = Ccc::getModel('Category_Media');
		$categoryMedia = $categoryMediaModel->fetchAll("SELECT * FROM category_image");
		return $categoryMedia;
	}
}