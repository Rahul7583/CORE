<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Config_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
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