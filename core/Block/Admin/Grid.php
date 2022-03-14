<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Admin_Grid extends Block_Core_Template
{
	public $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/Admin/grid.php');
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}

	public function getAdminData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('adminId') as totalCount FROM admin;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		$adminModel = Ccc::getModel('Admin'); 
		$admin = $adminModel->fetchAll("SELECT * FROM admin Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $admin;
	}
}