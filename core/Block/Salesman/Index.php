<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 
class Block_Salesman_Index extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/index.php');
	}
}