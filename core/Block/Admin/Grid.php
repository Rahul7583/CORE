<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php 
class Block_Admin_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($admin)
	{
		return $this->getUrl('edit', null, ['id' => $admin->adminId]);
	}

	public function getDeleteUrl($admin)
	{
		return $this->getUrl('delete', null, ['id' => $admin->adminId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getAdminData());
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'First Name',
			'type' => 'varchar'
		],'firstName');
		$this->addColumn([
			'title' => 'Last Name',
			'type' => 'varchar'
		],'lastName');
		$this->addColumn([
			'title' => 'Email',
			'type' => 'varchar'
		],'email');
		$this->addColumn([
			'title' => 'Password',
			'type' => 'varchar'
		],'password');
		$this->addColumn([
			'title' => 'Status',
			'type' => 'tinyint'
		],'status');
		$this->addColumn([
			'title' => 'Created Date',
			'type' => 'datetime'
		],'createdDate');
		$this->addColumn([
			'title' => 'Updated Date',
			'type' => 'datetime'
		],'updatedDate');

		return $this;
	}

	public function prepareActions()
	{
		$this->addAction([
			'title' => 'edit',
			'method' => 'getEditUrl'
		], 'edit');
		$this->addAction([
			'title' => 'delete',
			'method' => 'getDeleteUrl'
		], 'delete');
		return $this;
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


