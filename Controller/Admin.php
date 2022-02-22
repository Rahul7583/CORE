<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
<<<<<<< HEAD
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');
=======

Ccc::loadClass('Controller_Core_Action');
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
class Controller_Admin extends Controller_Core_Action{

	public function gridAction()			
	{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
		Ccc::getBlock('Admin_Grid')->toHtml();
	}	

	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();
=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		global $adapter;
		$admin=$adapter->fetchAll('select * from admin');
		
		$view=$this->getView();
		$view->setTemplate('view\admin_grid.php');
		$view->addData('adminGrid',$admin);
		$view->toHtml();
		//require_once 'view\admin_grid.php';
	}

	public function addAction()
	{
		$view=$this->getView();
		$view->setTemplate('view\admin_add.php');
		$view->toHtml();
		//require_once 'view\admin_add.php';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function editAction()
	{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
		$request = $this->getRequest();
		$id = $request->getRequest('id');

		$adminTable = Ccc::getModel('admin');
		$result=$adminTable->fetchRow("SELECT * FROM admin WHERE adminId = {$id}");
		Ccc::getBlock('Admin_Edit')->addData('adminEdit', $result)->toHtml();		
=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		$id = $_GET['id'];
		global $adapter;
		$result=$adapter->fetchRow("select * from admin where adminId='$id'");

		$view=$this->getView();
		$view->setTemplate('view\admin_edit.php');
		$view->addData('adminEdit',$result);
		$view->toHtml();
		//require 'view\admin_edit.php';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
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