<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Admin_Resource extends Model_Core_Row_Resource
{
		protected $resourceName = null;
		protected $primaryKey = null;
		
	public function __construct()
	{
		$this->setResourceName('admin');
		$this->setPrimaryKey('adminId');
	}
}