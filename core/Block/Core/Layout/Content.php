<?php Ccc::loadClass('Block_Core_Template');?>
<?php 
class Block_Core_Layout_Content extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Core/Layout/content.php');
	}

	public function getMessage()
	{
		$child = $this->getChild('Message');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Header_Message');
			$this->addChild($child, 'Message');
		}
		return $child;
	}	
	
}