<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Admin_Edit extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate('view/Admin/edit.php');
	}

	public function getAdminData()
	{
		return $this->getData('adminEdit');
	}
}