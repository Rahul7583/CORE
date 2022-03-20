<?php
class Model_Core_Row
{
	protected $data = [];
	protected $resourceClassName = null;

	public function setData(array $data)
	{
	 	$this->data = array_merge($this->data,$data);
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

	 public function setResourceClassName($resourceClassName)
	 {
	 	$this->resourceClassName = $resourceClassName;
	 	return $this;
	 }

	 public function getResourceClassName()
	 {
	 	return $this->resourceClassName;
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

	 public function getResource()
	 {
	 	return Ccc::getModel($this->getResourceClassName());
	 }

	public function fetchAll($query)
	{
		$data = $this->getResource()->fetchAll($query);
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
		$data = $this->getResource()->fetchRow($query);
		if (!$data) {
			return false;
		}
		$data = (new $this())->setData($data);
		return $data;
	}

	public function delete($id)
	{
		return $this->getResource()->delete($id);	
	}


	 public function save()
	 {
	 	if(array_key_exists($this->getResource()->getPrimaryKey(), $this->data))
	 	{
	 		$id = $this->data[$this->getResource()->getPrimaryKey()];
	 		$this->getResource()->update($this->data, $id);
	 	}
	 	else
	 	{	
	 		$id = $this->getResource()->insert($this->data);
	 	}
	 	return $this->load($id);
	 }

	 public function load($id, $column=null)
	 {
		if($column == null)
		{
			 $column = $this->getResource()->getPrimaryKey();
		}
		$rowData = $this->fetchRow("SELECT * FROM {$this->getResource()->getResourceName()}
									WHERE {$column} = {$id}");
		if(!$rowData)
		{
			return false;
		}		
		return $rowData;
	 }

		public function getPath()
		{
			return $this->getResource()->getPath();
		}
	
}