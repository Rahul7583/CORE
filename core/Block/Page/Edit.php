<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Page_Edit extends Block_Core_Template
{
	protected $page = null;

	public function __construct()
	{
		$this->setTemplate('view/Page/edit.php');
	}

	public function setPage($page)
	{
		$this->page = $page;
		return $this;
	}

	public function getPage()
	{
		return $this->page;
	}
}