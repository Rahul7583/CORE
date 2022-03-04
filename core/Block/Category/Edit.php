<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Category_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Category/edit.php');
	}

	public function getCategoryData()
	{
		return $this->getData('categoryEdit');
	}
} 