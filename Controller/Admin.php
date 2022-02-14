<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 

Ccc::loadClass('Controller_Core_Action');
class Controller_Admin extends Controller_Core_Action{

	public function gridAction()			
	{
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
	}

	public function editAction()
	{
		$id = $_GET['id'];
		global $adapter;
		$result=$adapter->fetchRow("select * from admin where adminId='$id'");

		$view=$this->getView();
		$view->setTemplate('view\admin_edit.php');
		$view->addData('adminEdit',$result);
		$view->toHtml();
		//require 'view\admin_edit.php';
	}

	public function saveAction()
	{	
		try {
			 global $adapter;
			if(!isset($_POST['admin'])){
				throw new Exception("Missing admin data in request.", 1);
			}

			$row=$_POST['admin'];

			print_r($row);

			$firstName=$row['firstName'];
			$lastName=$row['lastName'];
			$email=$row['email'];
			$password=$row['password'];
			$status=$row['status'];
			$date = date('Y-m-d H:i:s');

			if(array_key_exists('hiddenId', $row)){
				if(!(int)$row['hiddenId']){
					throw new Exception("Invalid Request", 1);
				}

				$adminId=$row['hiddenId'];

				$query = "UPDATE admin 
							SET firstName ='$firstName',
					 			lastName ='$lastName', 
					 			email ='$email', 
					 			password ='$password', 
					 			status ='$status',
					 			updatedDate ='$date'
				 			WHERE
				 				adminId = '$adminId'";			
			
				$result=$adapter->update($query);
			  		if(!$result){
			  			throw new Exception("system is unable to update.", 1);
			  		}
			  	$adapter->redirect('index.php?a=grid&c=admin');	
				 	
			}
			else{
						
					$query = "INSERT INTO 
			 				admin(`firstName`,
			 						 `lastName`,
			 						 `email`,
			 						 `password`,
			 						 `status`,
			 						 `createdDate`) 
			 				VALUES('$firstName',
			 						'$lastName',
			 						'$email',
			 						'$password',
			 						'$status',
			 						'$date')";
		
			 		$adminId = $adapter->insert($query);
			 		

			 		if (!$adminId) {
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 		$adapter->redirect('index.php?a=grid&c=admin');
			 	}
			 } catch (Exception $e) {
			 	$adapter->redirect('index.php?a=grid&c=admin');
			 }	 
	}

	public function deleteAction()
	{
		try {
			global $adapter;
			$id=$_GET['id'];
			$query="delete 
					from admin
					where adminId=$id";

			$result=$adapter->delete($query);
			if(!$result){
				throw new Exception("system is unable to delete", 1);
			}
			$adapter->redirect('index.php?a=grid&c=admin');
		} catch (Exception $e) {
			$adapter->redirect('index.php?a=grid&c=admin');
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}



?>