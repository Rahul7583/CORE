<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Customer_Price_Resource extends Model_Core_Row_Resource
{
	protected $tableName = null;
	protected $primaryKey = null;
	
	public function __construct()
	{
		$this->setTableName('customer_price');
		$this->setPrimaryKey('entityId');

	}
}