<?php Ccc::loadClass('Block_Core_Grid');?>
<?php
class Block_Config_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($config)
	{
		return $this->getUrl('edit', null, ['id' => $config->configId]);
	}

	public function getDeleteUrl($config)
	{
		return $this->getUrl('delete', null, ['id' => $config->configId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getConfigData());
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'ConfigId',
			'type' => 'int'
		],'configId');
		$this->addColumn([
			'title' => 'Name',
			'type' => 'varchar'
		],'name');
		$this->addColumn([
			'title' => 'Code',
			'type' => 'varchar'
		],'code');
		$this->addColumn([
			'title' => 'Value',
			'type' => 'varchar'
		],'value');
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

	
	public function getConfigData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('configId') as totalCount FROM config;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		
		$configModel = Ccc::getModel('Config');
		$config = $configModel->fetchAll("SELECT * FROM config Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $config;
	}
}