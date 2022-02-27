<?php
class Model_Core_Row_Resource{
	protected $tableName = null;
	protected $primaryKey = null;
	protected $rowClassName = null;
	

	public function getRow()
	{
		$rowObj = Ccc::getModel($this->getRowClassName()); //Model_address
		return $rowObj;
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setRowClassName($rowClassName)
	{
		$this->rowClassName = $rowClassName;
		return $this;
	}

	public function getRowClassName()
	{
		return $this->rowClassName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function insert(array $data)
	{
		$columnName = [];
		$columnValue = [];

		foreach ($data as $key => $value) 
		{
		 	$columnName[] = $key;
		 	$columnValue[] = $value;
		} 
		 $columnName = implode(",", $columnName);
		 $columnValue = implode("','", $columnValue);
		 $columnValue = "'".$columnValue."'";
		 $tableName = $this->getTableName();
		 $query = "INSERT INTO `$tableName` ($columnName) VALUES ($columnValue)";
		 $insertId = $this->getAdapter()->insert($query);
		 return $insertId;

	}

	public function update( $data,   $hiddenId )
	{
		$primaryKey = $this->getPrimaryKey();
		$values = '';
		foreach ($data as $columnName => $columnValue)
		{
			$values .= $columnName .'='."'".$columnValue."'".",";
		}

		$values = substr($values, 0,-1); 
		$Id = (is_array($hiddenId)) ? implode(",", $hiddenId) : $hiddenId;
		$tableName = $this->getTableName();
		$query = "UPDATE `$tableName` SET $values WHERE $primaryKey = {$Id}";
		$result = $this->getAdapter()->update($query);
		return $result;
	}

	public function delete($id)
	{
		$tableName = $this->getTableName();
		$key = $this->getPrimaryKey();
		$query = "DELETE FROM `$tableName` WHERE $key = $id";
		$result = $this->getAdapter()->delete($query);
		return $result;
	}

	public function fetchRow($query)
	{
		$result = $this->getAdapter()->fetchRow($query);
		return $result;
	}

	public function fetchAll($query)
	{
		$result = $this->getAdapter()->fetchAll($query);
		return $result;	
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}
	
}


