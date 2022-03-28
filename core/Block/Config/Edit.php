<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Config_Edit extends Block_Core_Template
{
	protected $config = null;

	public function __construct()
	{
		$this->setTemplate('view/config/edit.php');
	}

	public function setConfig($config)
	{
		$this->config = $config;
		return $this;
	}

	public function getConfig()
	{
		return $this->config;
	}
}