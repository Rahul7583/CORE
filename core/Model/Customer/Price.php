<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Customer_Price extends Model_Core_Row{

	public function __construct()
	{
		$this->setTableClassName('Customer_Price_Resource');
			
	}
}



