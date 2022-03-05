<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Admin extends Controller_Core_Action{

	public function gridAction()			
	{
		$content = $this->getLayout()->getContent();
		$adimnGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adimnGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Admin_Grid');
		$this->renderLayout();
	}	

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$id = (int)$this->getRequest()->getRequest('id');
			$adminModel = Ccc::getModel('admin')->load($id);
		}
		else
		{
			$adminModel = Ccc::getModel('admin');				
		}
		$adminEdit = Ccc::getBlock('Admin_Edit')->setAdmin($adminModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($adminEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Admin_Edit');
		$this->renderLayout();
	}

	public function saveAction()
	{	
		$message = Ccc::getModel('Core_Message');
		try {
			 $adminModel = Ccc::getModel('Admin');
			 $request = $this->getRequest();
			 $admin = $request->getPost('admin');

			if(!isset($admin))
			{
				throw new Exception("Missing admin data in request.", 1);
			}

			if($admin['adminId'] != null)
			{
					$row = $adminModel->load($admin['adminId']);
					$row->setData($admin);	
					$row->updatedDate = date('Y-m-d H:i:s');
					$result = $row->save();
			  		if(!$result)
			  		{

			  			throw new Exception("system is unable to update.", 1);
			  		}
			  		$message->addMessage('Data Updated', Model_Core_Message::SUCCESS);
			  		$this->redirect($this->getLayout()->getUrl('grid'));	
			}
			else{
					unset($admin['adminId']);
			 		$setData = $adminModel->setData($admin);
			 		$setData->createdDate = date('Y-m-d H:i:s');
					$adminId = $adminModel->save();
			 		if (!$adminId) 
			 		{
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 		
			 		$message->addMessage('Data Saved', Model_Core_Message::SUCCESS);
			 		$this->redirect($this->getLayout()->getUrl('grid'));
			 	}
			 } catch (Exception $e) 
			 {
			 	$message->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
			 	$this->redirect($this->getLayout()->getUrl('grid'));
			 }	 
	}

	public function deleteAction()
	{	$message = Ccc::getModel('Core_Message');
		try {
				$adminTable = Ccc::getModel('admin');
	 			$request = $this->getRequest();
				$id = $request->getRequest('id');
			
				$result = $adminTable->delete($id);
				if(!$result)
				{
					throw new Exception("system is unable to delete.", 1);
				}
				$message->addMessage('Data Deleted', Model_Core_Message::SUCCESS);
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
				$message->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}

?>