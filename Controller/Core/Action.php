<?php 

Ccc::loadClass('Model_Core_View');

class Controller_Core_Action 
{
	public $view = NULL;

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if(!$this->view){
			$this->setView(new Model_Core_View());
		}
		return $this->view;
	}

	public function redirect($url)				
	{
		header("location:$url");
		exit();
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	
}

?>