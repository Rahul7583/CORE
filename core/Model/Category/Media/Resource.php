<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Category_Media_Resource extends Model_Core_Row_Resource
{
		protected $tableName = null;
		protected $primaryKey = null;
	public function __construct()
	{
		$this->setTableName('category_image');
		$this->setPrimaryKey('imageId');
	}
}
