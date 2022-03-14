<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Salesman_Grid extends Block_Core_Template
{
	public $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/Salesman/grid.php');
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