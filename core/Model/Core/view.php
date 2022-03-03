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
		return null;
	}
	
	public function getUrl($action = null, $controller = null,  array $id = null, bool $reset = TRUE)
	{
		$parameter = $_GET;
		$newParameter = [];
		if($controller)
		{
			$newParameter['c'] = $controller;
		}

		if($action)
		{
			$newParameter['a'] = $action;
		}

		if(is_array($id))
		{
			foreach ($id as $key => $value)
			 {
				if($value)
				{
					$newParameter[$key] = $value;
				}
			 }
		}
		else
		{
			foreach ($parameter as $key => $value)
			 {
				if ($key != 'c' && $key != 'a' )
				{
					unset($parameter[$key]);
				}
			}
		}

		$url = array_merge($parameter, $newParameter);

		$finalUrl = 'index.php?'. http_build_query($url);
		return $finalUrl;

	}
}

?>