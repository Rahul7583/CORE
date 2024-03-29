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
		if(!$this->message)
		{
			$this->setMessage(Ccc::getModel('Admin_Message'));
		}
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
		echo $this->getResponse()->setHeader('Content-type','text/html')->render($this->getLayout()->toHtml());
	}

	public function renderJson($content)
	{
		
		$this->getResponse()->setHeader('Content-Type', 'application/json')->render(json_encode($content));
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

	public function getResponse()
	{
		return Ccc::getFront()->getResponse();
	}

	public function setTitle($title)
	{
		$this->getLayout()->getHead()->setTitle($title);
	}
}

?>