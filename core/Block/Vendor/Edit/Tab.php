<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>
<?php
class Block_Vendor_Edit_Tab extends Block_Core_Edit_Tab
{	
	function __construct()
	{
		parent::__construct();
		$this->setcurrentTab('personal');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title' => 'Personal Information',
			'block' =>	'Vendor_Edit_Tabs_Personal',
			'url' =>	$this->getUrl(null,null,['tab'=>'personal'])
		],'personal');
		$this->addTab([
			'title' => 'Address Information',
			'block' =>	'Vendor_Edit_Tabs_Address',
			'url' =>	$this->getUrl(null,null,['tab'=>'address'])
		],'address');
	}
}	
