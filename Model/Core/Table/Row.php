<?php
class Model_Core_Table_Row
{
	protected $data = [];
	protected $tableClassName;

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
}