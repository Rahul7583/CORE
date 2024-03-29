<?php Ccc::loadClass('Model_Core_View'); ?>
<?php
class Block_Core_Template extends Model_Core_View
{
	
	protected $children = [];
	public $pager = null;
	protected $layout = null; 

	public function __construct()
	{
		$this->setTemplate('view/core/layout.php');
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function setChildren(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function getChild($key)
	{
		if(array_key_exists($key, $this->children))
		{
			return $this->children[$key];
		}
		return null;
	}

	public function addChild($object, $key = null)
	{
		if(!$key)
		{
			$key = get_Class($object);
		}
		$object->setLayout($this->getLayout());
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

	public function getBlock($key)
	{
		$block = $this->getChild($key);
		if($block)
		{
			return $block;
		}
		$block = Ccc::getBlock($key);
		if($block)
		{
			$this->setLayout($this->getLayout());
			return $block;
		}
		return null;
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}


}