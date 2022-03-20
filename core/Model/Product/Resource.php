<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Product_Resource extends Model_Core_Row_Resource
{
	protected $resourceName = null;
	protected $primaryKey = null;
	public function __construct()
	{
		$this->setResourceName('product');
		$this->setPrimaryKey('productId');

	}
}

