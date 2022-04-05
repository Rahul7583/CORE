<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php
class Block_Page_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($page)
	{
		return $this->getUrl('edit', null, ['id' => $page->pageId, 'tab' => 'personal']);
	}

	public function getDeleteUrl($page)
	{
		return $this->getUrl('delete', null, ['id' => $page->pageId]);
	}

	public function prepareCollections()
	{
		$this->setCollection($this->getPageData());
	}

	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'PageId',
			'type' => 'int'
		],'pageId');
		$this->addColumn([
			'title' => 'Name',
			'type' => 'varchar'
		],'name');
		$this->addColumn([
			'title' => 'Code',
			'type' => 'varchar'
		],'code');
		$this->addColumn([
			'title' => 'Content',
			'type' => 'varchar'
		],'content');
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

	
	public function getPageData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('pageId') as totalCount FROM page;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		
		$pageModel = Ccc::getModel('page');
		$page = $pageModel->fetchAll("SELECT * FROM page Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $page;
	}
}