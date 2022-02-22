<?php Ccc::loadClass('Model_Core_Table'); ?>
<?php
class Model_Admin extends Model_Core_Table{

	public function __construct()
	{
		$this->setTableName('admin')->setPrimaryKey('adminId');		
	}

	public function load($id)
	{
		$rowData = $this->fetchRow("SELECT * FROM {$this->getTableName()}
									WHERE {$this->getPrimaryKey()} = {$id}");
		if(!$rowData)
		{
			return false;
		}
		$row = $this->getRow();
		$row->setData($rowData);
		return $row;
	}


}



