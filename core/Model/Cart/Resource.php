<?php  Ccc::loadClass('Model_Core_Row_Resource');?>
<?php
class Model_Cart_Resource extends Model_Core_Row_Resource
{
		protected $resourceName = null;
		protected $primaryKey = null;
		
	public function __construct()
	{
		$this->setResourceName('cart');
		$this->setPrimaryKey('cartId');
	}
}