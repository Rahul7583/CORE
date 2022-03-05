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
	{	$message = Ccc::getModel('Core_Message');
		try {
			 $configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			$config = $request->getPost('config');
	
			 	if($config['configId'] != null)
			 	{
					$row = $configModel->load($config['configId']);
					$row->setData($config);  	
					$row->updatedDate = date('Y-m-d H:i:s');
					$result = $row->save();
			  		if(!$result)
			  		{
			  			throw new Exception("System is unable to update. ", 1);
			  		} 
			  		$message->addMessage('Data Updated', Model_Core_Message::SUCCESS);
			  		$this->redirect($this->getLayout()->getUrl('grid', 'config'));
			  	}			
				else{	
						unset($config['configId']);
						$setData = $configModel->setData($config);
						$setData->createdDate = date('Y-m-d H:i:s');
						$insertId = $configModel->save();
				 		if(!$insertId)
				 		{
				 			throw new Exception("System is unable to insert.", 1);	
				 		}			
					}
					$message->addMessage('Data Saved', Model_Core_Message::SUCCESS);
					$this->redirect($this->getLayout()->getUrl('grid','config'));
			}
		 catch (Exception $e) {
		 	$message->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid','config'));
		}
	}

	public function deleteAction()
	{
		$message = Ccc::getModel('Core_Message');
		try {
			$configModel = Ccc::getModel('config');
			$id = $this->getRequest()->getRequest('id');
			$result = $configModel->delete($id);
			if (!$result)
			{
				throw new Exception("system is unable to delete.", 1);
			}
			$message->addMessage('Data Deleted', Model_Core_Message::SUCCESS);
			$this->redirect($this->getLayout()->getUrl('grid','config'));
	
			} 
		catch (Exception $e)
		{
			$message->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid','config'));			
		}	
	}
	public function errorAction()
	{
		echo "Error.";
	}
}

?>