<?php Ccc::loadClass('Model_Core_Table'); ?>
<?php
class Model_Category extends Model_Core_Table{

	public function __construct()
	{
		$this->setTableName('categories')->setPrimaryKey('categoryId');		
	}
}



