<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 
class Block_Core_Layout_Header_Message extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/header/message.php');
	}

	public function getMessage()
	{
		$message = Ccc::getModel('Admin_Message');
		return $message;
	}	

}