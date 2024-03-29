<?php 
class Controller_Core_Front
{
	protected $request = null;
	protected $response = null;

	public function setRequest($request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if(!$this->request)
		{
			Ccc::loadClass('Model_Core_Request');
			$request = new Model_Core_Request();
			$this->setRequest($request);
		}
		return $this->request;
	}

	public function setResponse($response)
	{
		$this->response = $response;
		return $this;
	}

	public function getResponse()
	{
		if(!$this->response)
		{
			Ccc::loadClass('Model_Core_Response');
			$response = new Model_Core_Response();
			$this->setResponse($response);
		}
		return $this->response;
	}

	public function init()
	{
			$actionName=(isset($_GET['a'])) ? $_GET['a'].'Action' : 'error'; 
			
			$controllerName=$_GET['c'];
			$controllerName = 'Controller_'.$controllerName;
			$controllerClassName=$this->prepareClassName($controllerName); 

			Ccc::loadClass($controllerClassName);
			$controller = new $controllerClassName();
			$controller->$actionName();
	}

	public function prepareClassName($name)
	{
		$name=ucwords($name,"_");
		return $name;
	}
}

?>