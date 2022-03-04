<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Customer_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Customer/grid.php');
	}

	public function getCustomerData()
	{
		$customerModel = Ccc::getModel('Customer');
		$customer = $customerModel->fetchAll("SELECT c.*,a.*
							FROM customer c
							JOIN address a
							ON a.customerId = c.customerId");
		return $customer;
	}
}