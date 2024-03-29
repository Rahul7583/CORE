<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>
<?php 
class Block_Category_Edit_Tab extends Block_Core_Edit_Tab
{
	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('category');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title' => 'Category Information',
			'block' => 'Category_Edit_Tabs_Category',
			'url' => $this->getUrl(null,null,['tab' => 'category'])
		], 'category');
	}
}
