<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Core_Layout_Head extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/head.php');
	}

	public function setTitle($title)
	{
		$this->title = $title;
		return $this->title;
	}

	public function getTitle()
	{
		
		return $this->title;
	}

	
}