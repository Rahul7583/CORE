<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Admin_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Admin/grid.php');
	}

	public function getAdminData()
	{
		$adminModel = Ccc::getModel('Admin'); 
		$admin = $adminModel->fetchAll("SELECT * FROM admin ");
		return $admin;
	}
}