<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Category_Media extends Model_Core_Row{

	public function __construct()
	{
		$this->setTableClassName('Category_Media_Resource');
			
	}
}
