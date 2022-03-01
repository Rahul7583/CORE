<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Categories extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Category_Add')->toHtml();
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id = $request->getRequest('id');
		global $adapter;
		$result = $adapter->fetchRow("SELECT * FROM categories WHERE categoryId = {$id}");
		Ccc::getBlock('Category_Edit')->addData('categoryEdit', $result)->toHtml();
	}

	public function saveAction()
	{
		global $adapter;
		$row = $_POST['category'];
		$parentName = $row['parentName'];
		$name = $row['name'];
		$status = $row['status'];
		$date = date('y-m-d h:m:s');	
		$parentPath = NULL;
	
						
		if($parentName == '0')
		{
			$insert="INSERT INTO `categories` (`parentId`,`name`, `status`, `createdDate`) 
					VALUES ('$parentName','$name' , '$status', '$date' )";
			
			$insertId = $adapter->insert($insert);
				if(!$insertId){
					throw new Exception("System is unable to insert.", 1);
				}
			$parentPath = $insertId;

			$updateQuery = "UPDATE `categories` 
							SET `path` = '$parentPath' 
							WHERE `categories`.`categoryId` = '$insertId'";
			$result = $adapter->update($updateQuery);

				if(!$result){
					throw new Exception("System is unable to update.", 1);
				}
			$this->redirect("index.php?a=grid&c=categories");
		}
		else
		{

			$insert = "INSERT INTO `categories` (`name`, `status`,`createdDate`,`path`)
					  VALUES ('$name' , $status, '$date','$parentName' )";

			$insertId = $adapter->insert($insert);
			
			$path = $adapter->fetchRow("SELECT * FROM `categories` 
										WHERE `name` = '$parentName' ");
			$parentPath = $path['path']."/".$insertId;//45/20			
			$path1 = explode("/", $path['path']);
			$parentId = array_pop($path1);

			$updateQuery = "UPDATE `categories` 
							SET `path` = '$parentPath', `parentId` = '$parentId' 
							WHERE `categories`.`categoryId` = '$insertId'";			
			$newPath = $adapter->update($updateQuery);

				if(!$newPath){
					throw new Exception("System is unable to Update.", 1);
				}
				$this->redirect("index.php?a=grid&c=categories");	
		}	
	}

	public function deleteAction()
	{
		try {

			global $adapter;
			$id = "%".$_GET['id']."%"; 
			$query="DELETE FROM categories 
					WHERE path LIKE '$id'";	

			$result = $adapter->delete($query);
			if (!$result)
			{
				throw new Exception("system is unable to delete", 1);
			}

			$this->redirect('index.php?a=grid&c=categories');
			
		} catch (Exception $e) {
			$this->redirect('index.php?a=grid&c=categories');
		}
	}	

	public function errorAction()
	{
		echo "error";		
	}
}

?>