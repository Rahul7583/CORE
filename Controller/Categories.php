<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Categories extends Controller_Core_Action{

	public function gridAction()			
	{
<<<<<<< HEAD
		Ccc::getBlock('Category_Grid')->toHtml();
=======
		global $adapter;
		$categories=$adapter->fetchAll('select * from categories');

		$view=$this->getView();
		$view->setTemplate('view\categories_grid.php');
		$view->addData('categoryGrid',$categories);
		$view->toHtml();
		//require_once 'view\categories_grid.php';
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function addAction()
	{
<<<<<<< HEAD
		Ccc::getBlock('Category_Add')->toHtml();
=======
		$view=$this->getView();
		$view->setTemplate('view\categories_add.php');
		$view->toHtml();
		//require_once 'view\categories_add.php';
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function editAction()
	{
<<<<<<< HEAD
		$request = $this->getRequest();
		$id = $request->getRequest('id');
		global $adapter;
		$result = $adapter->fetchRow("SELECT * FROM categories WHERE categoryId = {$id}");
		Ccc::getBlock('Category_Edit')->addData('categoryEdit', $result)->toHtml();
=======
		
		require_once 'view\categories_edit.php';
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function saveAction()
	{
		global $adapter;
<<<<<<< HEAD
		$row = $_POST['category'];
		$parentName = $row['parentName'];
		$name = $row['name'];
		$status = $row['status'];
		$date = date('y-m-d h:m:s');	
		$parentPath = NULL;
=======
		$row=$_POST['category'];
		$parentName = $row['parentName'];
		$name=$row['name'];
		$status=$row['status'];
		$date=date('y-m-d h:m:s');	
		$parentPath=NULL;
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	
						
		if($parentName == '0')
		{
<<<<<<< HEAD
			$insert="INSERT INTO `categories` (`parentId`,`name`, `status`, `createdDate`) 
					VALUES ('$parentName','$name' , '$status', '$date' )";
			
			$insertId = $adapter->insert($insert);
=======
			$insert="INSERT INTO `categories` (`parentId`,`name`, `status`, `createdDate`) VALUES ('$parentName','$name' , '$status', '$date' )";
			
			$insertId=$adapter->insert($insert);
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
				if(!$insertId){
					throw new Exception("System is unable to insert.", 1);
				}
			$parentPath = $insertId;

<<<<<<< HEAD
			$updateQuery = "UPDATE `categories` 
							SET `path` = '$parentPath' 
							WHERE `categories`.`categoryId` = '$insertId'";
			$result = $adapter->update($updateQuery);
=======
			$updateQuery="UPDATE `categories` SET `path` = '$parentPath' WHERE `categories`.`categoryId` = '$insertId'";
			$result=$adapter->update($updateQuery);
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6

				if(!$result){
					throw new Exception("System is unable to update.", 1);
				}
			$this->redirect("index.php?a=grid&c=categories");
		}
		else
		{

<<<<<<< HEAD
			$insert = "INSERT INTO `categories` (`name`, `status`,`createdDate`,`path`)
					  VALUES ('$name' , $status, '$date','$parentName' )";

			$insertId = $adapter->insert($insert);
			
			$path = $adapter->fetchRow("SELECT * FROM `categories` 
										WHERE `name` = '$parentName' ");
=======
			$insert="INSERT INTO `categories` (`name`, `status`,`createdDate`,`path`) VALUES ('$name' , $status, '$date','$parentName' )";

			$insertId=$adapter->insert($insert);
			
			$path = $adapter->fetchRow("SELECT * FROM `categories` WHERE `name` = '$parentName' ");
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
			$parentPath = $path['path']."/".$insertId;//45/20			
			$path1 = explode("/", $path['path']);
			$parentId = array_pop($path1);

<<<<<<< HEAD
			$updateQuery = "UPDATE `categories` 
							SET `path` = '$parentPath', `parentId` = '$parentId' 
							WHERE `categories`.`categoryId` = '$insertId'";			
=======
			$updateQuery="UPDATE `categories` SET `path` = '$parentPath', `parentId` = '$parentId' WHERE `categories`.`categoryId` = '$insertId'";			
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
			$newPath = $adapter->update($updateQuery);

				if(!$newPath){
					throw new Exception("System is unable to Update.", 1);
<<<<<<< HEAD
=======
					
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
				}
				$this->redirect("index.php?a=grid&c=categories");	
		}	
	}

	public function deleteAction()
	{
		try {

			global $adapter;
<<<<<<< HEAD
			$id = "%".$_GET['id']."%"; 
			$query="DELETE FROM categories 
					WHERE path LIKE '$id'";	

			$result = $adapter->delete($query);
			if (!$result)
			{
=======
			$id=$_GET['id']."%";
			$query="DELETE 
					FROM categories 
					WHERE path LIKE '$id'";

			$result=$adapter->delete($query);
			if (!$result) {
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
				throw new Exception("system is unable to delete", 1);
			}

			$this->redirect('index.php?a=grid&c=categories');
			
		} catch (Exception $e) {
			$this->redirect('index.php?a=grid&c=categories');
		}
	}
<<<<<<< HEAD
	public function testAction()
	{
		
=======

	public function testAction()
	{
		
	
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}	

	public function errorAction()
	{
		echo "error";		
	}
}

?>