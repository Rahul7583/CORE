<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Admin extends Controller_Core_Action{

	public function gridAction()			
	{//Core_Layout_Header_Message
		// Ccc::getModel('Core_Session');
		$m = Ccc::getModel('Core_Message');
		$m->unsetMessage();
		$_SESSION["message"] = "rahul";
		print_r($_SESSION);
		// session_destroy();/**/
		// session_unset();
		$m->addMessages('Error in Print','success');
		echo "<pre>";
		print_r($m);
		exit();
		// $content = $this->getLayout()->getContent();
		// $adimnGrid = Ccc::getBlock('Admin_Grid');
		// $content->addChild($adimnGrid);
		// $this->getLayout()->getChild('content')->getChild('Block_Admin_Grid');
		// $this->renderLayout();
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
		//$adminEdit = Ccc::getBlock('Admin_Edit')->setData(['adminEdit'=> $adminModel]);
		$adminEdit = Ccc::getBlock('Admin_Edit')->setAdmin($adminModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($adminEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Admin_Edit');
		$this->renderLayout();
	}

	public function saveAction()
	{	
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
			  		$this->redirect($this->getLayout()->getUrl('grid', 'admin'));	
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
			 		$this->redirect($this->getLayout()->getUrl('grid', 'admin'));
			 	}
			 } catch (Exception $e) 
			 {/*
			 	get model.
			 	add message.
			 	template ma getmessage aavse.
			 	haa template banao.*/
			 	$this->redirect($this->getLayout()->getUrl('grid', 'admin'));
			 }	 
	}

	public function deleteAction()
	{
		try {
				$adminTable = Ccc::getModel('admin');
	 			$request = $this->getRequest();
				$id = $request->getRequest('id');
			
				$result = $adminTable->delete($id);
				if(!$result)
				{
					throw new Exception("system is unable to delete.", 1);
				}
				$this->redirect($this->getLayout()->getUrl('grid', 'admin'));
		} catch (Exception $e) {
				$this->redirect($this->getLayout()->getUrl('grid', 'admin'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}

?>