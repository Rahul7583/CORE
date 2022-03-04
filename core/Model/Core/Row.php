<?php
class Model_Core_Row
{
	protected $data = [];
	protected $tableClassName = null;

	public function setData(array $data)
	 {
	 	$this->data = $data;
	 	return $this;
	 } 

	 public function getData()
	 {
	 	return $this->data;
	 }

	 public function resetData()
	 {
	 	$this->data = [];
	 	return $this;
	 }

	 public function setTableClassName($tableClassName)
	 {
	 	$this->tableClassName = $tableClassName;
	 	return $this;
	 }

	 public function getTableClassName()
	 {
	 	return $this->tableClassName;
	 }

	 public function __set($key, $value)
	 {
	 	$this->data[$key] = $value;
	 	return $this;
	 }

	 public function __get($key)
	 {
	 		if(!array_key_exists($key, $this->data))
	 		{
	 			return null;
	 		}
	 		return $this->data[$key];
	 }

	 public function __unset($key)
	 {
	 	if(array_key_exists($key, $this->data))
	 	unset($this->data[$key]);
	 }

	 public function getTable()
	 {
	 	return Ccc::getModel($this->getTableClassName());
	 }

	public function fetchAll($query)
	{
		$data = $this->getTable()->fetchAll($query);
		if (!$data) {
			return false;
		}
		foreach ($data as &$row) {
			$row = (new $this())->setData($row);

		}
		return $data;		
	} 

	public function fetchRow($query)
	{
		$data = $this->getTable()->fetchRow($query);
		if (!$data) {
			return false;
		}
		$data = (new $this())->setData($data);
		return $data;
	}

	public function delete($id)
	{
		return $this->getTable()->delete($id);	
	}


	 public function save()
	 {
	 	if(array_key_exists($this->getTable()->getPrimaryKey(), $this->data))
	 	{
	 		$id = $this->data[$this->getTable()->getPrimaryKey()];
	 		$this->getTable()->update($this->data, $id);
	 	}
	 	else
	 	{
	 		$id = $this->getTable()->insert($this->data);
	 	}
	 	return $id;
	 }

	 public function load($id, $column=null)
	{
		if($column == null)
		{
			 $column = $this->getTable()->getPrimaryKey();
		}
		$rowData = $this->fetchRow("SELECT * FROM {$this->getTable()->getTableName()}
									WHERE {$column} = {$id}");
		if(!$rowData)
		{
			return false;
		}
		
		return $rowData;
	}

		public function getPath($path)
		{
			return $this->getTable()->path($path);
		}
	
}