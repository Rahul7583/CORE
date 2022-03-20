f<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Vendor_Address extends Model_Core_Row
{
	protected $vendor = null;

	public function __construct()
	{
		$this->setResourceClassName('Vendor_Address_Resource');			
	}

	public function setVendor(Model_Vendor $vendor)
	{
		$this->vendor = $vendor;
		return $this;
	}

	public function getVendor($reload = false)
	{
		$vendorModel = Ccc::getModel('Vendor');
		if (!$this->vendorId) 
		{
			return $vendorModel;
		}
		if ($this->vendor && !$reload) 
		{
			return $this->vendor;
		}
		$vendor = $vendorModel->fetchRow("SELECT * FROM `vendor` 
											WHERE `vendorId` = {$this->vendorId}");
		if (!$vendor) 
		{
			return $vendorModel;
		}
		$this->setVendor($vendor);
		return $vendor;
	}

}



