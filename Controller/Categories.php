<?php date_default_timezone_set("Asia/Kolkata");?>

<?php 

class Controller_Categories{

	public function gridAction()			
	{
		require_once 'view\categories_grid.php';
	}

	public function addAction()
	{
		require_once 'view\categories_add.php';
	}

	public function editAction()
	{
		require_once 'view\categories_edit.php';
	}

	public function saveAction()
	{
		try {
				global $adapter;
				
				$row=$_POST['category'];
				$hiddenId=$row['hiddenId'];
			 	$name=$row['name'];
			 	$status=$row['status'];
			 	$date = date('Y-m-d H:i:s');

			 
			 	if(array_key_exists('hiddenId', $row)){
			 		if(!(int)$hiddenId){
			 			throw new Exception("Invalid Request.", 1);
			 			
			 		}		
			 			$query="UPDATE categories 
        						SET name='$name',
        							status=$status,
        							updatedDate='$date'
        						WHERE categoryId='$hiddenId'";
        					$result=$adapter->update($query);
        					if(!$result){
        						throw new Exception("System is unable to update.", 1);
        					}
			 	}
			 	else{
			 			$query="INSERT INTO 
				 				categories(`name`,
				 							`status`,
				 							`createdDate`) 
				 				VALUES('$name',
				 						'$status',
				 						'$date')";			 	
				 			$result=$adapter->insert($query);
				 			if(!$result){
				 				throw new Exception("System is unable to insert", 1);
				 			}
			 		}
			 		$adapter->redirect('index.php?a=grid&c=categories');
			
		} catch (Exception $e) {
			 	$adapter->redirect('index.php?a=grid&c=categories');
		}
	}

	public function deleteAction()
	{
		try {
			global $adapter;
			$id=$_GET['id'];
			$query="delete 
					from categories 
					where categoryId=$id";
			$result=$adapter->delete($query);
			if (!$result) {
				throw new Exception("system is unable to delete", 1);
			}

			$adapter->redirect('index.php?a=grid&c=categories');
			
		} catch (Exception $e) {
			$adapter->redirect('index.php?a=grid&c=categories');
		}
	}


	public function errorAction()
	{
		echo "error";		
	}
}

//$action=($_GET['a'] )? $_GET['a'] : 'errorAction';

//$categories = new Categories();
//$categories->$action();

?>