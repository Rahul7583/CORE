<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Admin_Login extends Block_Core_Template
{
	
	public function __construct()
	{
		$this->setTemplate('view/Admin/login.php');
	}
}