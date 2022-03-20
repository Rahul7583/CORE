<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Salesman extends Model_Core_Row
{
	protected $customer = null;

	public function __construct()
	{
		$this->setResourceClassName('Salesman_Resource');		
	}

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DISABLED_DEFALUT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function getStatus($key = null)
	{
		$status = [
					self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
					self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
			];

		if(!$key)
		{
			return $status;
		}
		if(array_key_exists($key, $status))
		{
			return $status[$key];
		}
		return self::STATUS_DISABLED_DEFALUT;
	}

	public function setCustomers($customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomers($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if (!$this->customerId) 
		{
			return $customerModel;
		}
		if ($this->customer && !$reload) 
		{
			return $this->customer;
		}
		$customer = $customerModel->fetchRow("SELECT * FROM `customer` 
											WHERE `customerId` = {$this->customerId}");
		if (!$customer) 
		{
			return $customerModel;
		}
		$this->setCustomers($customer);
		return $customer;
	}
}



