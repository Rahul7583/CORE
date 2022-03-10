<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer_Price extends Controller_Core_Action{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
		$content->addChild($customerPriceGrid,'grid');
		$this->renderLayout();
	}

	public function saveAction()
	{
		
	}
}
