<?php Ccc::loadClass('Block_Core_Template');?>
<?php 
class Block_Core_Layout extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Core/layout.php');
	}

	public function getHeader()
	{
		$child = $this->getChild('header');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Header');
			$this->addChild($child, 'header');
		}
		return $child;
	}

	public function getFooter()
	{
		$child = $this->getChild('footer');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Footer');
			$this->addChild($child, 'footer');
		}
		return $child;
	}

	public function getContent()
	{
		$child = $this->getChild('content');
		if (!$child) {
			$child = Ccc::getBlock('Core_Layout_Content');
			$this->addChild($child, 'content');
		}
		return $child;
	}
}

?>