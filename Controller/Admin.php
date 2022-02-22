<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
class Controller_Admin extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Admin_Grid')->toHtml();
	}	

	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id = $request->getRequest('id');

		$adminTable = Ccc::getModel('admin');
		$result=$adminTable->fetchRow("SELECT * FROM admin WHERE adminId = {$id}");
		Ccc::getBlock('Admin_Edit')->addData('adminEdit', $result)->toHtml();		
	}

	public function saveAction()
	{	
		try {
			 $adminTable = Ccc::getModel('admin');
			 $request = $this->getRequest();
			 $row = $request->getPost('admin');
			if(!isset($row))
			{
				throw new Exception("Missing admin data in request.", 1);
			}
			
			if(array_key_exists('hiddenId', $row)){
				if(!(int)$row['hiddenId']){
					throw new Exception("Invalid Request", 1);
				}

				$adminId = $row['hiddenId'];

				$row['updatedDate'] = date('Y-m-d H:i:s');
				unset($row['hiddenId']);
				$result = $adminTable->update($row, ['adminId' => $adminId]);

			  		if(!$result){
			  			throw new Exception("system is unable to update.", 1);
			  		}
			  	$this->redirect($this->getView()->getUrl('admin', 'grid'));	
				 	
			}
			else{
			 		$row['createdDate'] = date('Y-m-d H:i:s');
			 		$adminId = $adminTable->insert($row);	
			 		if (!$adminId) {
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 		$this->redirect($this->getView()->getUrl('admin', 'grid'));
			 	}
			 } catch (Exception $e) {
			 	$this->redirect($this->getView()->getUrl('admin', 'grid'));
			 }	 
	}

	public function deleteAction()
	{
		try {
			$adminTable = Ccc::getModel('admin');
 			$request = $this->getRequest();
			$id = $request->getRequest('id');
		
			$result = $adminTable->delete(['adminId' => $id]);
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