<?php Ccc::loadClass('Model_Core_Table'); ?>
<?php
class Model_Customer extends Model_Core_Table{

	public function __construct()
	{
		$this->setTableName('customer')->setPrimaryKey('customerId');		
	}

	
}



