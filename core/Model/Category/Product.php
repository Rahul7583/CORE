<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Category_Product extends Model_Core_Row{

	public function __construct()
	{
		$this->setResourceClassName('Category_Product_Resource');
			
	}
}

