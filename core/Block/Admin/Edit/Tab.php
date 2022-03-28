<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>
<?php
class Block_Admin_Edit_Tab extends Block_Core_Edit_Tab
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
			'block' =>	'Admin_Edit_Tabs_Personal',
			'url' =>	$this->getUrl(null,null,['tab'=>'personal'])
		],'personal');
		/*$this->addTab([
			'title' => 'Address Information',
			'block' =>	'Admin_Edit_Tabs_Address',
			'url' =>	$this->getUrl(null,null,['tab'=>'address'])
		],'address');
		$this->addTab([
			'title' => 'Address2 Information',
			'block' =>	'Admin_Edit_Tabs_Address',
			'url' =>	$this->getUrl(null,null,['tab'=>'address2'])
		],'address2');*/
		//return $this;
		//$this->setCurrentTab('personal');

	}
}	
