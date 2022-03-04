<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Customer_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Customer/edit.php');
	}

	public function getCustomerData()
	{
		return $this->getData('customerEdit');
	}
}