<?php
class Model_Core_Row_Resource
{
	protected $resourceName = null;
	protected $primaryKey = null;
	protected $rowClassName = null;

	public function getRow()
	{
		$rowObj = Ccc::getModel($this->getRowClassName()); 
		return $rowObj;
	}

	public function setResourceName($resourceName)
	{
		$this->resourceName = $resourceName;
		return $this;
	}

	public function getResourceName()
	{
		return $this->resourceName;
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
		 $resourceName = $this->getResourceName();
		 $query = "INSERT INTO `$resourceName` ($columnName) VALUES ($columnValue)";
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
		$resourceName = $this->getResourceName();
		$query = "UPDATE `$resourceName` SET $values WHERE $primaryKey = {$Id}";
		$result = $this->getAdapter()->update($query);
		return $result;
	}

	public function delete($id)
	{
		$resourceName = $this->getResourceName();
		$key = $this->getPrimaryKey();
		$query = "DELETE FROM {$resourceName} WHERE {$key} = {$id}";
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

	public function getPath()
 	{
	  $category = [];
	  $idName = $this->getAdapter()->fetchPairs("SELECT categoryId, name FROM categories");
	  $idPath = $this->getAdapter()->fetchPairs("SELECT categoryId, path FROM categories");
 
	  foreach ($idPath as $categoryId => $path) {
	   $id_array = explode("/", $path);
	   $temp = [];
	   foreach ($id_array as $key => $pathId)
	    {
		    if(array_key_exists($pathId, $idName))
		    {
		     array_push($temp, $idName[$pathId]);
		    }
	   }
	   $path_array = implode(" / ", $temp);
	   $category[$categoryId] = $path_array;
	  }
	  return $category;
 }

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}
}


