<?php Ccc::loadClass('Block_Core_Template');?>
<?php 
class Block_Core_Layout extends Block_Core_Template
{
	protected $children = [];

	public function __construct()
	{
		$this->setTemplate('view/Core/Layout.php');
	}

	public function setChild(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChild($key)
	{
		if(array_key_exists($key, $this->children))
		{
			return $this->children[$key];
		}
		return null;
	}

	public function addChild($key, $object)
	{
		if(!$key)
		{
			$key = get_Class($object);
		}
		$this->children[$key] = $object;
		return $this;
	}
	
	public function removeChild($key)
	{
		if(array_key_exists($key, $this->children))
		{
			unset($this->children[$key]);
		}
		return $this;
	}

	public function getHeader()
	{
		//return (new Block_Core_Layout_Header);
		$child = $this->getChild('header');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Header');
			$this->addChild('header', $child);
		}
		return $child;
	}

	public function getFooter()
	{
		//return (new Block_Core_Layout_Footer);
		$child = $this->getChild('footer');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Footer');
			$this->addChild('footer', $child);
		}
		return $child;
	}

	public function getContent()
	{
		// return (new Block_Core_Layout_Content);
		$child = $this->getChild('content');
		if (!$child) {
			$child = Ccc::getBlock('Core_Layout_Content');
			$this->addChild('content', $child);
		}
		return $child;
	}
}

?>