<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php Ccc::loadClass('Block_Admin_Grid_Collection'); ?>
<?php
class Block_Admin_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		//$this->setTemplate('view/admin/grid.php');
		parent::__construct();
	}

	/*public function getAdminData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('adminId') as totalCount FROM admin;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		$adminModel = Ccc::getModel('Admin'); 
		$admin = $adminModel->fetchAll("SELECT * FROM admin Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $admin;
	}*/
}


