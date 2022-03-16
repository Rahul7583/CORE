<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Customer extends Controller_Admin_Login
{
	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }
    
	public function gridAction()			
	{
		$this->setTitle('Customer Grid');
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$content = $this->getLayout()->getContent()->addChild($customerGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Customer Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$customerModel = Ccc::getModel('Customer');
			$customerModel=$customerModel->load($id);
		}
		else
		{
			$this->setTitle('Customer Add');
			$customerModel = Ccc::getModel('Customer');	
		}
		$customerEdit = Ccc::getBlock('Customer_Edit')->setCustomer($customerModel);
		$content = $this->getLayout()->getContent()->addChild($customerEdit);
		$this->renderLayout();
	}

	public function saveCustomer()
	{
		try {
				$request = $this->getRequest();
				$customer = $request->getPost('customer');
				$id = (int)$request->getRequest('id');
		
				if(!$customer)
				{
					throw new Exception("Missing Customer data in request.", 1);
				}

				$customerModel = Ccc::getModel('Customer');
				$customerModel->setData($customer);
				if($id)
				{
					$customerModel->customerId = $id;	
					$customerModel->updatedDate = date('Y-m-d H:m:s');
				}
				else
				{	
					$customerModel->createdDate = date('Y-m-d H:m:s');	
				}
				$customerId = $customerModel->save();
		 		if (!$customerId) 
		 		{
		 			throw new Exception("system is unable to insert.", 1);
		 		}
				return $customerId;
			} catch (Exception $e) {
				
			}	
			
	}

	public function saveBillingAddress($customerId)
	{
		try {
				$request = $this->getRequest();
				$address = $request->getPost('billingAddress');
				if(!$address)
				{
					throw new Exception("Missing Address data in Request ", 1);	
				}
				
				$address['billing'] = 1;
				$address['shipping'] = 0;
					
				 $addressModel = Ccc::getModel('Customer_Address');
				 $addressModel->setData($address);

				$resultAddress = $addressModel->load($customerId, 'customerId');
				
				if($resultAddress)
				{	
					$addressModel->addressId = $resultAddress->addressId;
				}
				else
				{	
					$addressModel->customerId = $customerId;
				}
				$result = $addressModel->save();	
		 		if(!$result)
		 		{
		 			throw new Exception("System is unable to insert.", 1);	
		 		}
				$this->getMessage()->addMessage('Data Saved');			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Something Wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function saveShippingAddress($customerId)
	{
		try {
				$request = $this->getRequest();
				$address = $request->getPost('shippingAddress');
				if(!$address)
				{
					throw new Exception("Missing Address data in Request ", 1);	
				}
				
				$address["shipping"] = 1;
				$address['billing'] = 0;
					
				 $addressModel = Ccc::getModel('Customer_Address');
				 $addressModel->setData($address);
				 $resultAddress = $addressModel->fetchRow("SELECT * FROM `address` 
											WHERE `customerId` = {$customerId} AND `shipping` = 1");

				if($resultAddress)
				{	
					$addressModel->addressId = $resultAddress->addressId;
				}
				else
				{	
					$addressModel->customerId = $customerId;
				}
				$result = $addressModel->save();	
		 		if(!$result)
		 		{
		 			throw new Exception("System is unable to insert.", 1);	
		 		}
				$this->getMessage()->addMessage('Data Saved');
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Something Wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function saveAction()
	{
		try {
			 $customerId = $this->saveCustomer();
			 $this->saveBillingAddress($customerId);	
			 $this->saveShippingAddress($customerId);
			$this->redirect($this->getLayout()->getUrl('grid'));

			} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage('Something Wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
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
				$this->getMessage()->addMessage('Data Deleted');
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Something wrong with your Data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
