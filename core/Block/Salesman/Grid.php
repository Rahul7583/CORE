<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php
class Block_Salesman_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($salesman)
	{
		return $this->getUrl('edit', 'salesman', ['id' => $salesman->salesmanId]);
	}

	public function getDeleteUrl($salesman)
	{
		return $this->getUrl('delete', 'salesman', ['id' => $salesman->salesmanId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getSalesmanData());
	}
	
	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'SalesmanId',
			'type' => 'int'
		],'salesmanId');
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
			'title' => 'Mobile',
			'type' => 'int'
		],'mobile');
		$this->addColumn([
			'title' => 'Discount',
			'type' => 'float'
		],'discount');
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


	public function getSalesmanData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);
		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('salesmanId') as totalCount FROM salesman;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		
		$salesmenModel = Ccc::getModel('Salesman');
		$salesmen = $salesmenModel->fetchAll("SELECT * FROM salesman Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $salesmen;
	}
}