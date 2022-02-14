<?php date_default_timezone_set("Asia/Kolkata");?>

<?php
Ccc::loadClass('Controller_Core_Action'); 
class Controller_Product extends Controller_Core_Action{

	public function gridAction()			
	{
		global $adapter;
		$products=$adapter->fetchAll('select * from product');
		
		$view=$this->getView();
		$view->setTemplate('view\product_grid.php');
		$view->addData('productGrid',$products);
		$view->toHtml();

		//require_once 'view\product_grid.php';
	}

	public function addAction()
	{
		$view=$this->getView();
		$view->setTemplate('view\product_add.php');
		$view->toHtml();
		//require_once 'view\product_add.php';
	}

	public function editAction()
	{
		global $adapter;
		$id = $_GET['id'];
		$result=$adapter->fetchRow("select * from product where productId='$id'");
		
		$view=$this->getView();
		$view->setTemplate('view\product_edit.php');
		$view->addData('productEdit',$result);
		$view->toHtml();
		//require 'view\product_edit.php';
	}

	public function saveAction()
	{	
		try {
			global $adapter;
			//$hid=$_POST['hid'];

			$row=$_POST['product'];
			
			$hiddenId=$row['hiddenId'];
			 $name=$row['name'];
			 $price=$row['price'];
			 $quantity=$row['quantity'];
			 $status=$row['status'];		 
			 $date = date('Y-m-d H:i:s');

			 if(array_key_exists('hiddenId', $row)){

			 	if(!(int)$hiddenId){
			 		throw new Exception("Invalid Request.", 1);
			 	}
			 		$query="UPDATE product 
							SET name='$name',
				 				price='$price',
				 				quantity='$quantity',
				 				status='$status',
				 				updatedDate='$date' 
				 			WHERE productId='$hiddenId'";

			  		$result=$adapter->update($query);
			  		if(!$result){
			  			throw new Exception("System is unable to update. ", 1);
			  		}
				 	
			}
			else{
					$query="INSERT INTO product(`name`,
			 						 			`price`,
			 						 			`quantity`,
			 						 			`status`,
			 						 			`createdDate`) 
			 							VALUES('$name',
			 									'$price',
			 									'$quantity',
			 									'$status',
			 									'$date')";
			 		$result = $adapter->insert($query);
			 		if(!$result){
			 			throw new Exception("System is unable to insert.", 1);
			 			
			 		}			
				}
					$adapter->redirect('index.php?a=grid&c=product');
			
		} catch (Exception $e) {
			$adapter->redirect('index.php?a=grid&c=product');
		}
	}

	public function deleteAction()
	{
		try {
			global $adapter;
		
			$id=$_GET['id'];
			$query="delete 
					from product 
					where productId=$id";

			$result=$adapter->delete($query);
				if (!$result) {
						throw new Exception("system is unable to delete.", 1);
				}

			$adapter->redirect("index.php?a=grid&c=product");
	
		} catch (Exception $e) {
			//$adapter->redirect("index.php?a=grid&c=product");			
		}	
	}
	public function errorAction()
	{
		echo "Error.";
	}
}

//$action=($_GET['a'] )? $_GET['a'] : 'errorAction';

//$product = new Product();
//$product->$action();

?>