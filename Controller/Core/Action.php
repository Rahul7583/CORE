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
<<<<<<< HEAD

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
}

?>