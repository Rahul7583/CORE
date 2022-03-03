<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Page_Edit extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Page/edit.php');
	}

	public function getPageData()
	{
		return $this->getData('pageEdit');
	}
}