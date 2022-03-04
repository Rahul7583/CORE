<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Config_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Config/edit.php');
	}

	public function getProductData()
	{
		return $this->getData('configEdit');
	}
}