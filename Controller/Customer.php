<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
Ccc::loadClass('Controller_Core_Action');
<<<<<<< HEAD
<<<<<<< HEAD
Ccc::loadClass('Model_Core_Request');
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()			
	{
<<<<<<< HEAD
<<<<<<< HEAD
		Ccc::getBlock('Customer_Grid')->toHtml();
=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		global $adapter;
		$customers=$adapter->fetchAll("SELECT c.*,a.*
							FROM customer c
							JOIN address a
							ON a.customerId= c.customerId");

		$view=$this->getView();
		$view->setTemplate('view\customer_grid.php');
		$view->addData('customerGrid',$customers);
		$view->toHtml();
		//require_once 'view\customer_grid.php';
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function addAction()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		Ccc::getBlock('Customer_Add')->toHtml();
=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		$view=$this->getView();
		$view->setTemplate('view\customer_add.php');
		$view->toHtml();
		//require_once 'view\customer_add.php';
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function editAction()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		$request = $this->getRequest();
		$id = $request->getRequest('id');

		$customerTable = Ccc::getModel('customer');
		$result=$customerTable->fetchRow("SELECT c.*,a.*
							FROM customer c
							JOIN address a
							ON a.customerId = c.customerId
							WHERE c.customerId = {$id}");
		Ccc::getBlock('Customer_Edit')->addData('customerEdit', $result)->toHtml();
=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		$id = $_GET['id'];
		global $adapter;
		$result=$adapter->fetchRow("SELECT c.*,a.*
							FROM customer c
							JOIN address a
							ON a.customerId = c.customerId
							WHERE c.customerId = $id");
		
		$view=$this->getView();
		$view->setTemplate('view\customer_edit.php');
		$view->addData('customerEdit',$result);
		$view->toHtml();
		//require 'view\customer_edit.php';
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function saveCustomer()
	{	
			$request = $this->getRequest();
			$row=$request->getPost('customer');
			$customerTable = Ccc::getModel('Customer');
			if(!isset($row))
			{
				throw new Exception("Missing Customer data in request.", 1);
			}

			if(array_key_exists('hid', $row)){
				if(!(int)$row['hid']){
					throw new Exception("Invalid Request", 1);
				}

				$customerId = $row['hid'];
	
				$row['updatedDate'] = date('Y-m-d H:i:s');
				unset($row['hid']);
				$result = $customerTable->update($row, ['customerId' => $customerId]);
		  		if(!$result)
		  		{
		  			throw new Exception("system is unable to update.", 1);
		  		}
				 	
			}
			else{	
					$row['createdDate'] = date('Y-m-d H:i:s');	
			 		$customerId = $customerTable->insert($row);
			 		if (!$customerId) 
			 		{
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 	}
			 	return $customerId;
			 	
	}

	public function saveAddress($customerId)
	{
			$request = $this->getRequest();
			$row=$request->getPost('address');
			$addressTable = Ccc::getModel('Customer_Address');
			if(!isset($row))
			{
				throw new Exception("Missing Address data in Request ", 1);	
			}
			
			$billing = 0;
			if(array_key_exists('billing',$row) && $row["billing"] == 1){
				$billing = 1;
			}
			$shipping = 0;
			if(array_key_exists('shipping',$row) && $row["shipping"] == 1){
					$shipping = 1;
			}
			 $row["billing"] = $billing;
			 $row["shipping"] = $shipping;
				
			 $addressData=$addressTable->fetchAll("SELECT * FROM address WHERE customerId = {$customerId}");
				if($addressData)
				{		
					$result = $addressTable->update($row, ['customerId' => $customerId]);
					if(!$result){
						throw new Exception("system is unable to update.", 1);	
					}
					
				}
				else{
					
			 		$row["customerId"] = $customerId;
			 		$result = $addressTable->insert($row);
			 		if(!$result)
			 		{
			 			throw new Exception("System is unable to insert.", 1);	
			 		}
				}
				$this->redirect($this->getView()->getUrl('customer','grid'));
	}

	public function saveAction()
	{
		try {
			 $customerId = $this->saveCustomer();
			 $this->saveAddress($customerId);
			
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('customer','grid'));
		}
			
	}

	public function deleteAction()
	{
		try {
			$customerTable = Ccc::getModel('customer');
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			$result = $customerTable->delete(['customerId' => $id]);
			if(!$result)
			{
				throw new Exception("system is unable to delete", 1);
			}
			$this->redirect($this->getView()->getUrl('customer','grid'));
		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('customer','grid'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}


?>