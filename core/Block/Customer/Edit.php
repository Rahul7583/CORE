<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Customer_Edit extends Block_Core_Template
{
	protected $customer = null;

	public function __construct()
	{
		$this->setTemplate('view/Customer/edit.php');
	}

	public function setCustomer($customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer()
	{
		return $this->customer;
	}
}