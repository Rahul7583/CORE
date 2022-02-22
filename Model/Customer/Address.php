<?php Ccc::loadClass('Model_Core_Table'); ?>
<?php
class Model_Customer_Address extends Model_Core_Table{

	public function __construct()
	{
		$this->setTableName('address')->setPrimaryKey('addressId');		
	}
}



