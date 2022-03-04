<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Category extends Model_Core_Row{

	public function __construct()
	{
		$this->setTableClassName('Category_Resource');	
	}
}



