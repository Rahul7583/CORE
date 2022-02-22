<?php Ccc::loadClass('Model_Core_Table'); ?>
<?php
class Model_Product extends Model_Core_Table{

	public function __construct()
	{
		$this->setTableName('product')->setPrimaryKey('productId');		
	}
}



