<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php Ccc::loadClass('Model_Customer_Address'); ?>
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
			$customerModel = $customerModel->load($id);
		}
		else
		{
			$this->setTitle('Customer Add');
			$customerModel = Ccc::getModel('Customer');	
		}
		Ccc::register('customer', $customerModel);
		$customerEdit = Ccc::getBlock('Customer_Edit');
		$content = $this->getLayout()->getContent()->addChild($customerEdit);
		$this->renderLayout();
	}

	public function saveCustomer()
	{
				$customer = $this->getRequest()->getPost('customer');
				$id = (int)$this->getRequest()->getRequest('id');
				$customerModel = Ccc::getModel('Customer');

				if($this->getRequest()->getRequest('tab') == 'personal'){
				if(!$customer)
				{
					throw new Exception("Missing Customer data in request.", 1);
				}

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
				$customerRow = $customerModel->save();

		 		if (!$customerRow) 
		 		{
					$customerRow = $customerModel->load($id);
		 			throw new Exception("ssystem is unable to insert.", 1);
		 		}
		 		$customerId = $customerRow->customerId;
				$this->redirect($this->getLayout()->getUrl('edit','customer', ['id'=>$customerId]));
			
				return $customerRow;
		 		}
				/*print_r($customerRow->customerId);
				exit();*/
			

			
	}

	public function saveBillingAddress($customerRow = null)
	{
				$request = $this->getRequest();
				$address = $request->getPost('billingAddress');

			
		if(!$customerRow)
		{
			$customerId = $this->getRequest()->getRequest('id');

			if(!$customerId)
			{
				throw new Exception("System is unable to Save Address without Customer.", 1);
			}
			$customer = Ccc::getModel('customer')->load($customerId);
		}
				
				//$customerId = $customerRow->customerId;
				if(!$address)
				{
					throw new Exception("Missing Billing Address data in Request ", 1);	
				}
				
				 $address["billing"] = Model_Customer_Address::BILLING;
					
				 $addressModel = Ccc::getModel('Customer_Address');
				 $addressModel->setData($address);

				$resultAddress = $customer->getBillingAddresses();
				if($resultAddress->addressId)
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
				$this->getMessage()->addMessage('Data Saved.');			

	}

	public function saveShippingAddress($customerRow = null)
	{
		if(!$customerRow)
		{
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("System is unable to Save Address without Customer.", 1);
			}
			$customer = Ccc::getModel('customer')->load($customerId);
		}
	
				$request = $this->getRequest();
				$address = $request->getPost('shippingAddress');
				//$customerId = $customerRow->customerId;
				if(!$address)
				{
					throw new Exception("Missing Shipping Address data in Request ", 1);	
				}
				
				 $address["shipping"] = Model_Customer_Address::SHIPPING;
									
				 $addressModel = Ccc::getModel('Customer_Address');
				 $addressModel->setData($address);
				 $resultAddress = $customer->getShippingAddresses();
				if($resultAddress->addressId)
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
				$this->getMessage()->addMessage('Data Saved.');

	}

	public function saveAction()
	{
		try 
		{
			$customerRow = $this->saveCustomer();
			//print_r($customerRow);
			$this->saveBillingAddress();	
			//$this->saveShippingAddress($customerRow);
			//$this->redirect($this->getLayout()->getUrl('grid'));



		} 
		catch (Exception $e) 
		{
			/*$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));*/
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
				$this->getMessage()->addMessage('Data Deleted.');
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
