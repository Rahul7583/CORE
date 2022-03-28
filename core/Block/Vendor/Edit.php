<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Vendor_Edit extends Block_Core_Template
{
	protected $vendor = null;

	public function __construct()
	{
		$this->setTemplate('view/vendor/edit.php');
	}

	public function setVendor($vendor)
	{
		$this->vendor = $vendor;
		return $this;
	}

	public function getVendor()
	{
		return $this->vendor;
	}
}