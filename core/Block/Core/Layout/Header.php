<?php Ccc::loadClass('Block_Core_Template');?>
<?php 
class Block_Core_Layout_Header extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/header.php');
	}

	public function getMenu()
	{
		$child = $this->getChild('menu');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Header_Menu');
			$this->addChild($child, 'menu');
			$child->toHtml();
		}
		return $child;
	}

	public function getMessage()
	{
		$child = $this->getChild('message');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Header_Message');
			$this->addChild($child, 'message');
			$child->toHtml();
		}
		return $child;
	}
	
}

?>














