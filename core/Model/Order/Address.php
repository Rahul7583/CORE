<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Order_Address extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Order_Address_Resource');
	}
}



