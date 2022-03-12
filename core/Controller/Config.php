<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php
class Controller_Config extends Controller_Core_Action{

	public function gridAction()			
	{
		$content = $this->getLayout()->getContent();
		$configGrid = Ccc::getBlock('Config_Grid');
		$content->addChild($configGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Config_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{
		if($this->getRequest()->getRequest('id'))
		{
			$id = $this->getRequest()->getRequest('id');
			$configModel = Ccc::getModel('Config')->load($id);
		}
		else
		{
			$configModel = Ccc::getModel('Config');
		}
		$configEdit= Ccc::getBlock('Config_Edit')->setConfig($configModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($configEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Config_Edit');
		$this->renderLayout();
	}

	public function saveAction()
	{
		try 
		{
			$request = $this->getRequest();
			$config = $request->getPost('config');
			$id = (int)$request->getRequest('id');

			if(!$config)
			{
				throw new Exception("Missing admin data in request.", 1);
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
			$this->redirect($this->getLayout()->getUrl('grid','config'));
		}
		catch (Exception $e)
		{
		 	$this->getMessage()->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid','config'));
		}
	}

	public function deleteAction()
	{
		try 
		{
			$configModel = Ccc::getModel('config');
			$id = $this->getRequest()->getRequest('id');
			$result = $configModel->delete($id);
			if (!$result)
			{
				throw new Exception("system is unable to delete.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted');
			$this->redirect($this->getLayout()->getUrl('grid','config'));
	
		} 
		catch (Exception $e)
		{
			$this->getMessage()->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid','config'));			
		}	
	}
}
