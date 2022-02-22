<?php
class Model_Core_Table{
	protected $tableName = null;
	protected $primaryKey = null;

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
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

		foreach ($data as $key => $value) {
		 	$columnName[] = $key;
		 	$columnValue[] = $value;
		 } 
		 $columnName = implode(",", $columnName);
		 $columnValue = implode("','", $columnValue);
		 $columnValue = "'".$columnValue."'";
		 $tableName = $this->getTableName();
		 $query = "INSERT INTO `$tableName` ($columnName) VALUES ($columnValue)";
		 global $adapter;
		 $insertId = $adapter->insert($query);
		 return $insertId;

	}

	public function update(array $data, array $hiddenId)
	{
		foreach ($hiddenId as $key => $value)
		{
			$id = $key;
			$idValue = $value;		
		}
		foreach ($data as $columnName => $columnValue)
		 {
			$values[] = "$columnName = '$columnValue'";
		}

		$values = implode(",", $values);
		$tableName = $this->getTableName();
		$query = "UPDATE `$tableName` SET $values WHERE $id = $idValue";
		global $adapter;
		$result = $adapter->update($query);
		return $result;
	}

	public function delete(array $data)
	{
		foreach ($data as $key => $value) {
			$id = $key;
			$idValue = $value;
		}
		$tableName = $this->getTableName();
		$query = "DELETE FROM `$tableName` WHERE $id = $idValue";
		global $adapter;
		$result = $adapter->delete($query);
		return $result;
	}

	public function fetchRow($query)
	{
		global $adapter;
		$result = $adapter->fetchRow($query);
		return $result;
	}

	public function fetchAll($query)
	{
		global $adapter;
		$result = $adapter->fetchAll($query);
		return $result;	
	}

	public function getRow()
	{
		return new Model_Core_Table_Row();
	}
}