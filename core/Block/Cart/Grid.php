<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Cart_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/Cart/grid.php');
	}
	
}