<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Vendor/grid.php');
	}

	public function getVendorData()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendor = $vendorModel->fetchAll("SELECT v.*,v_a.*
							FROM vendor v
							JOIN vendor_address v_a
							ON v_a.vendorId = v.vendorId");
		return $vendor;
	}
}