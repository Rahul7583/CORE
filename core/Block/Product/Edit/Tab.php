<?php Ccc::loadClass('Block_Core_Edit_Tab'); ?>
<?php 
class Block_Product_Edit_Tab extends Block_Core_Edit_Tab
{
	public function __construct()
	{
		parent::__construct();
		$this->setCurrentTab('product');
	}

	public function prepareTabs()
	{
		$this->addTab([
			'title' => 'Product Information',
			'block' => 'Product_Edit_Tabs_Product',
			'url' => $this->getUrl(null,null,['tab' => 'product'])
		], 'product');

		$this->addTab([
			'title' => 'Select Category',
			'block' => 'Product_Edit_Tabs_Categories',
			'url' => $this->getUrl(null,null,['tab' => 'category'])
		], 'category');
	}
}

