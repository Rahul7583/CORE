<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Product_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Product/edit.php');
	}

	public function getProductData()
	{
		return $this->getData('productEdit');
	}
}