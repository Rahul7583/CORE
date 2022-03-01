<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Vendor_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Vendor/edit.php');
	}

	public function getVendorData()
	{
		return $this->getData('vendorEdit');
	}
}