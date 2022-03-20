<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Page_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Page/grid.php');
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