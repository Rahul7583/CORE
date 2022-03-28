<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
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