<?php 
Ccc::loadClass('Model_Core_View');
Ccc::loadClass('Block_Core_Layout');

class Controller_Core_Action 
{
	public $layout = NULL;
	protected $message = null;


	public function setMessage($message)
	{
		$this->message = $message;
		return $this;
	}

	public function getMessage()
	{
		return $this->message;
	}
	
	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if(!$this->layout){
			$this->setLayout(new Block_Core_Layout());
		}
		return $this->layout;
	}

	public function renderLayout()
	{
		$this->getLayout()->toHtml();
		return $this;
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