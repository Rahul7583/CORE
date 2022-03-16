<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Vendor_Grid extends Block_Core_Template
{
	public $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/Vendor/grid.php');
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

	public function getVendorData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('vendorId') as totalCount FROM vendor;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		
		$vendorModel = Ccc::getModel('Vendor');
		$vendor = $vendorModel->fetchAll("SELECT *
										FROM vendor 
										Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $vendor;
	}
}