<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 

class Controller_Customer{

	public function gridAction()			
	{
		require_once 'view\customer_grid.php';
	}

	public function addAction()
	{
		require_once 'view\customer_add.php';
	}

	public function editAction()
	{
		require 'view\customer_edit.php';
	}

	public function saveCustomer()
	{	
		//customer array
		//$adapter = new Model_Customer();
		global $adapter;
			

			if(!isset($_POST['customer'])){
				throw new Exception("Missing Customer data in request.", 1);
			}

			$row=$_POST['customer'];

			$firstName=$row['firstName'];
			$lastName=$row['lastName'];
			$email=$row['email'];
			$mobile=$row['mobile'];
			$status=$row['status'];
			$date = date('Y-m-d H:i:s');

			if(array_key_exists('hid', $row)){
				if(!(int)$row['hid']){
					throw new Exception("Invalid Request", 1);
				}

				$customerId=$row['hid'];

				$query = "UPDATE customer 
										SET firstName ='$firstName',
								 			lastName ='$lastName', 
								 			email ='$email', 
								 			mobile ='$mobile', 
								 			status ='$status',
								 			updatedDate ='$date'
							 			WHERE
							 				customerId = '$customerId'";			
			
				$result=$adapter->update($query);
			  		if(!$result){
			  			throw new Exception("system is unable to update.", 1);
			  		}
				 	
			}
			else{
						
					$query = "INSERT INTO 
			 				customer(`firstName`,
			 						 `lastName`,
			 						 `email`,
			 						 `mobile`,
			 						 `status`,
			 						 `createdDate`) 
			 				VALUES('$firstName',
			 						'$lastName',
			 						'$email',
			 						'$mobile',
			 						'$status',
			 						'$date')";
		
			 		$customerId = $adapter->insert($query);
			 		

			 		if (!$customerId) {
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 	}
			 	return $customerId;
			 	
	}

	public function saveAddress($customerId)
	{
		//address Array
		global $adapter;
		// echo $customerId;

			if(!isset($_POST['address'])){
				throw new Exception("Missing Address data in Request ", 1);	
			}
			
			$row=$_POST['address'];


			$address=$row['address'];
			$postalCode=$row['postalCode'];
			$city=$row['city'];
			$state=$row['state'];
			$country=$row['country'];
			$date = date('Y-m-d H:i:s');

			$billing = 0;
			if(array_key_exists('billing',$row) && $row["billing"] == 1){
				$billing = 1;
			}
			$shipping = 0;
			if(array_key_exists('shipping',$row) && $row["shipping"] == 1){
					$shipping = 1;
			}

				
			$addressData=$adapter->fetchAll("SELECT * FROM address WHERE customerId = $customerId");
			
				if($addressData){
					
					$query = "UPDATE address 
							SET address='$address',
							    postalCode='$postalCode',
							    city='$city',
							    state='$state',
							    country='$country',
							    billing='$billing',
							    shipping='$shipping'
							WHERE customerId= '$customerId'";

					$result=$adapter->update($query);
					if(!$result){
						throw new Exception("system is unable to update.", 1);	
					}
					//$adapter->redirect('customer.php?a=gridAction');
				}
				else{
					
					$query="INSERT INTO 
			 				address (`customerId`,
			 						 `address`,
			 						 `postalCode`,
			 						 `city`,
			 						 `state`,
			 						 `country`,
			 						 `billing`,
			 						 `shipping`) 
			 				VALUES ($customerId,
			 				 		'$address',
			 				 		$postalCode,
			 				 		'$city',
			 				 		'$state',
			 				 		'$country',
			 				 		$billing,
			 				 		$shipping)";

			 		$result = $adapter->insert($query);
			 		
			 		if(!$result){
			 			throw new Exception("System is unable to insert.", 1);
			 			
			 		}
				}
	}

	public function saveAction()
	{
		try {
			 
				global $adapter;
			 $customerId=$this->saveCustomer();
			 $this->saveAddress($customerId);

			 $adapter->redirect('index.php?a=grid&c=customer');

			
		} catch (Exception $e) {
			//$adapter->redirect('index.php?a=grid');
			}
			
	}

	public function deleteAction()
	{
		try {
			global $adapter;
			$id=$_GET['id'];
			$query="delete 
					from customer
					where customerId=$id";

			$result=$adapter->delete($query);
			if(!$result){
				throw new Exception("system is unable to delete", 1);
			}
			$adapter->redirect('index.php?a=grid&c=customer');
		} catch (Exception $e) {
			$adapter->redirect('index.php?a=grid&c=customer');
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}

//$action=($_GET['a'] )? $_GET['a'] : 'errorAction';

//$customer = new Customer();
//$customer->$action();

?>