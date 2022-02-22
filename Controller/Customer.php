<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Customer_Add')->toHtml();
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id = $request->getRequest('id');

		$customerTable = Ccc::getModel('customer');
		$result=$customerTable->fetchRow("SELECT c.*,a.*
							FROM customer c
							JOIN address a
							ON a.customerId = c.customerId
							WHERE c.customerId = {$id}");
		Ccc::getBlock('Customer_Edit')->addData('customerEdit', $result)->toHtml();
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