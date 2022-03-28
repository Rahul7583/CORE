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


	public function getUrl($actionName = null, $controllerName = null, array $array = null, $reset = false)
	{
		
		$defaultUrl = Ccc::getFront()->getRequest()->getRequest();	
		$url =[];

		if ($reset == true) 
		{
			if ($actionName) {
				$url['a'] = $actionName;
			}
			else{
				$url['a'] = 'grid';
			}

			if ($controllerName) {
				$url['c'] = $controllerName;
			}
			else{
				$url['c'] = $defaultUrl['c'];
			}

			foreach ($defaultUrl as $key => $value) {
				if ($key != 'c' && $key != 'a' ) {
					unset($defaultUrl[$key]);
				}
			}
			if (is_array($array)) {
				foreach ($array as $key => $value) {
					$url[$key] = $value;
				
				}
			}
			
			
		}
		else
		{
			if ($actionName) {
				$url['a'] = $actionName;
			}
			else{
				$url['a'] = $defaultUrl['a'];
			}

			if ($controllerName) {
				$url['c'] = $controllerName;
			}
			else{
				$url['c'] = $defaultUrl['c'];
			}

			foreach ($defaultUrl as $key => $value) {
				if ($key != 'c' && $key != 'a' ) {
					$url[$key] = $defaultUrl[$key];
							
				}				
			}

			if (is_array($array)) {
				foreach ($array as $key => $value) {
	
					$url[$key] = $value;
				
				}
			}

			
		}

		$finalElements = array_merge($defaultUrl, $url);
		$finalUrl = 'index.php?'. http_build_query($finalElements);
		return $finalUrl;
		
	}
}











?>