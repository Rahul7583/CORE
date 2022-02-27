<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Product_Media_Resource extends Model_Core_Row_Resource
{
	protected $tableName = null;
	protected $primaryKey = null;
	
	public function __construct()
	{
		$this->setTableName('image');
		$this->setPrimaryKey('imageId');
	}
}