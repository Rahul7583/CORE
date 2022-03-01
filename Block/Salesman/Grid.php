<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Salesman/grid.php');
	}

	public function getSalesmanData()
	{
		$salesmenModel = Ccc::getModel('Salesman');
		$salesmen = $salesmenModel->fetchAll("SELECT * FROM salesman");
		return $salesmen;
	}
}