<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Vendor extends Model_Core_Row
{
	protected $address = null;

	public function __construct()
	{
		$this->setTableClassName('Vendor_Resource');		
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

	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}

	public function getAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Vendor_Address');
		if (!$this->vendorId) 
		{
			return $addressModel;
		}
		if ($this->address && !$reload) 
		{
			return $this->address;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `vendor_address` 
											WHERE `vendorId` = {$this->vendorId}");
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setAddress($address);
		return $address;
	}
}



