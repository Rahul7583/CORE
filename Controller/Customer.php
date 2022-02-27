<?php date_default_timezone_set("Asia/Kolkata");?>
<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		$customerModel = Ccc::getModel('Customer');
		Ccc::getBlock('Customer_Edit')->setData(['customerEdit' => $customerModel])->toHtml();
	}

	public function editAction()
	{
		$id = (int)$this->getRequest()->getRequest('id');
		$customerModel = Ccc::getModel('Customer');
		$result=$customerModel->fetchRow("SELECT c.*,a.*
							FROM customer c
							JOIN address a
							ON a.customerId = c.customerId
							WHERE c.customerId = {$id}");
		Ccc::getBlock('Customer_Edit')->setData(['customerEdit' => $result])->toHtml();
	}

	public function saveCustomer()
	{	
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			$customer = $request->getPost('customer');
			$customerId = $customer['customerId'];
	
			if(!isset($customer))
			{
				throw new Exception("Missing Customer data in request.", 1);
			}

			if($customer['customerId'] != null)
			{

					$row = $customerModel->load($customer['customerId']); 	
					$row->setData($customer);
					$row->updatedDate = date('Y-m-d H:i:s');
					$result = $row->save();
			  		if(!$result)
			  		{
			  			throw new Exception("system is unable to update.", 1);
			  		}
				 	
			}
			else{	
					
					unset($customer['customerId']);
					$setData = $customerModel->setData($customer);
					$setData->createdDate = date('Y-m-d H:i:s');
					$customerId = $customerModel->save();
			 		if (!$customerId) 
			 		{
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 		
			 	}
			 	return $customerId;
	}

	public function saveAddress($customerId)
	{
			$addressModel = Ccc::getModel('Customer_Address');
			$request = $this->getRequest();
			$address = $request->getPost('address');
			$resultAddress = $addressModel->load($customerId, 'customerId');
			if(!isset($address))
			{
				throw new Exception("Missing Address data in Request ", 1);	
			}
			
			$billing = 0;
			if(array_key_exists('billing',$address) && $address["billing"] == 1){
				$billing = 1;
			}
			$shipping = 0;
			if(array_key_exists('shipping',$address) && $address["shipping"] == 1){
					$shipping = 1;
			}
			 $address["billing"] = $billing;
			 $address["shipping"] = $shipping;
				
			 $addressData=$addressModel->fetchAll("SELECT * FROM address WHERE customerId = {$customerId}");
		
				if($addressData)
				{	
					$row = $addressModel->load($customerId);
					$addressModel->setData($address);
					$addressModel->addressId = $resultAddress->addressId;
					$result = $addressModel->save();	
					if(!$result)
					{
						throw new Exception("system is unable to update.", 1);	
					}
					
				}
				else{
					
					$addressModel->setData($address);
					$addressModel->customerId = $customerId;
					$result = $addressModel->save();	
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
			//$this->redirect($this->getView()->getUrl('customer','grid'));
		}
			
	}

	public function deleteAction()
	{
		try {
			$customerModel = Ccc::getModel('customer');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $customerModel->delete($id);
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