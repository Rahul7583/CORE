<?php 

class Model_Core_View
{
	public $template=NULL;
	public $data = [];

	public function setTemplate($template)
	{
		$this->template = $template;
		return $this;
	}

	public function getTemplate()
	{		
		return $this->template;
	}

	public function toHtml()
	{
		require($this->getTemplate());
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function getData($key = null)
	{
		if(!$key){
			return $this->data;
		}
		if(array_key_exists($key, $this->data)){
			return $this->data[$key];
		}
		return null;
	}

	public function addData($key, $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key)
	{
		if(array_key_exists($key, $this->data)){
			unset($this->data[$key]);
		}
		return $this;
	}

	public function path($path)
	{
		global $adapter;	
		$value=explode('/',$path); 
		foreach ($value as $path1) {
			$query=$adapter->fetchRow("SELECT  `name` FROM `categories` WHERE categoryId='$path1';");
			$parentName[]=$query['name'];

			$temp=[];
			$temp=implode("=>", $parentName);
		}

		$finalPath=$temp;
		echo $finalPath;
		return $finalPath;
	}
}

?>