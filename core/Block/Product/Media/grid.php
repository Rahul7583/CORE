<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Product_Media_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/media/grid.php');
	}

	public function getMediaData()
	{
		$productMediaModel = Ccc::getModel('Product_Media');
		$productMedia = $productMediaModel->fetchAll("SELECT * FROM image");
		return $productMedia;
	}
}