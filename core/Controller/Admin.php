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
		$adminMessage = Ccc::getModel('Admin_Message');
		try {
			 $adminModel = Ccc::getModel('Admin');
			 $request = $this->getRequest();
			 $admin = $request->getPost('admin');

			if(!$admin)
			{
				throw new Exception("Missing admin data in request.", 1);
			}

			if($admin['adminId'] != null)
			{
					$row = $adminModel->load($admin['adminId']);
					$row->setData($admin);	
					$row->updatedDate = date('Y-m-d H:m:s');
					$result = $row->save();
			  		if(!$result)
			  		{
			  			throw new Exception("system is unable to update.", 1);
			  		}
			  		$adminMessage->addMessage('Data Updated');
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
			 		
			 		$adminMessage->addMessage('Data Saved');
			 		$this->redirect($this->getLayout()->getUrl('grid'));
			 	}
			 } catch (Exception $e) 
			 {
			 	$adminMessage->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
			 	$this->redirect($this->getLayout()->getUrl('grid'));
			 }	 
	}

	public function deleteAction()
	{	$adminMessage = Ccc::getModel('Admin_Message');
		try {
				$adminModel = Ccc::getModel('admin');
	 			$id = $this->getRequest()->getRequest('id');
				$result = $adminModel->delete($id);
				if(!$result)
				{
					throw new Exception("system is unable to delete.", 1);
				}
				$adminMessage->addMessage('Data Deleted');
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
				$adminMessage->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
