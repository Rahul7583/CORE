<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Admin extends Controller_Core_Action{

	public function gridAction()			
	{
		
		Ccc::getBlock('Admin_Grid')->toHtml();
	}	

	public function addAction()
	{
		$adminModel = Ccc::getModel('admin');
		Ccc::getBlock('Admin_Edit')->setData(['adminEdit'=> $adminModel])->toHtml();
		
	}

	public function editAction()
	{
		$id = (int)$this->getRequest()->getRequest('id');
		$adminModel = Ccc::getModel('admin')->load($id);
		Ccc::getBlock('Admin_Edit')->setData(['adminEdit'=> $adminModel])->toHtml();
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
			  		$this->redirect($this->getView()->getUrl('admin', 'grid'));	
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
			 		$this->redirect($this->getView()->getUrl('admin', 'grid'));
			 	}
			 } catch (Exception $e) 
			 {
			 	$this->redirect($this->getView()->getUrl('admin', 'grid'));
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
				$this->redirect($this->getView()->getUrl('admin', 'grid'));
		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('admin', 'grid'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}

?>