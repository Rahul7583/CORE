<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php
class Controller_Config extends Controller_Admin_Login
{	
	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()			
	{
		$this->setTitle('Config Grid');
		$configGrid = Ccc::getBlock('Config_Grid');
		$content = $this->getLayout()->getContent()->addChild($configGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Config Edit');	
			$id = $this->getRequest()->getRequest('id');
			$configModel = Ccc::getModel('Config')->load($id);
		}
		else
		{
			$this->setTitle('Config Add');	
			$configModel = Ccc::getModel('Config');
		}
		$configEdit= Ccc::getBlock('Config_Edit')->setConfig($configModel);
		$content = $this->getLayout()->getContent()->addChild($configEdit);
		$this->renderLayout();
	}

	public function saveAction()
	{
		try 
		{
			$config = $request->getPost('config');
			$id = (int)$this->getRequest()->getRequest('id');
			if(!$config)
			{
				throw new Exception("Missing config data in request.", 1);
			}

			$configModel = Ccc::getModel('Config');
			$configModel->setData($config);
		 	if($id)
		 	{
				$configModel->configId = $id;  	  	
				$configModel->updatedDate = date('Y-m-d H:m:s');
		  	}			
			else
			{	
					$configModel->createdDate = date('Y-m-d H:m:s');
			}
			$insertId = $configModel->save();
	 		if(!$insertId)
	 		{
	 			throw new Exception("System is unable to insert.", 1);	
	 		}
		 	$this->getMessage()->addMessage('Data Saved');			
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
		catch (Exception $e)
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function deleteAction()
	{
		try 
		{
			$configModel = Ccc::getModel('config');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $configModel->delete($id);
			if (!$result)
			{
				throw new Exception("system is unable to delete.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.');
			$this->redirect($this->getLayout()->getUrl('grid'));
		} 
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));			
		}	
	}
}
