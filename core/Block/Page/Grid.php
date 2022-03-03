<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Page_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Page/grid.php');
	}

	public function getPageData()
	{
		$pageModel = Ccc::getModel('page');
		$page = $pageModel->fetchAll("SELECT * FROM page");
		return $page;
	}
}