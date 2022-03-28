<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}

	public function getCustomerData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('customerId') as totalCount FROM customer;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		
		$customerModel = Ccc::getModel('Customer');
		$customer = $customerModel->fetchAll("SELECT * FROM customer 
							Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $customer;
	}
}