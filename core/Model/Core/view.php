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
		ob_start();
		require($this->getTemplate());
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
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
			return $this;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		if(!array_key_exists($key, $this->data))
		{
			return $this;
		}
		unset($this->data[$key]);
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