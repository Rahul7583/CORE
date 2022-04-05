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
    

    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$customerGrid = Ccc::getBlock('Customer_Index');
		$content->addChild($customerGrid);
		$this->renderLayout();

	}

	public function gridBlockAction()
	{
		$customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $customerGrid
		];
		$this->renderJson($response);
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
		$customerEdit = Ccc::getBlock('Customer_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $customerEdit
		];
		$this->renderJson($response);
	}

	public function saveCustomer()
	{
		$customer = $this->getRequest()->getPost('customer');
		$id = (int)$this->getRequest()->getRequest('id');
		$customerModel = Ccc::getModel('Customer');

		if($this->getRequest()->getRequest('tab') == 'personal')
		{
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
			// $this->redirect($this->getLayout()->getUrl('index','customer', ['id'=>$customerRow->customerId, 'tab' => 'address']));
		
			return $customerRow;
 		}	
	}

	public function saveBillingAddress($customerRow = null)
	{
				$customerId = $this->getRequest()->getRequest('id');
				$customerModel = Ccc::getModel('Customer')->load($customerId);

				$request = $this->getRequest();
				$address = $request->getPost('billingAddress');
				$resultAddress = $customerModel->getBillingAddresses();

				 $address["billing"] = Model_Customer_Address::BILLING;
					
				 $addressModel = Ccc::getModel('Customer_Address');
				 $addressModel->setData($address);

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
				$customerId = $this->getRequest()->getRequest('id');
				$customerModel = Ccc::getModel('Customer')->load($customerId);

				$request = $this->getRequest();
				$address = $request->getPost('shippingAddress');
				$resultAddress = $customerModel->getShippingAddresses();

				
				 $address["shipping"] = Model_Customer_Address::SHIPPING;
					
				 $addressModel = Ccc::getModel('Customer_Address');
				 $addressModel->setData($address);

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
			$this->saveBillingAddress();	
			$this->saveShippingAddress();
			$this->gridBlockAction();

		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->gridBlockAction();
			
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
				$this->gridBlockAction();

		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->gridBlockAction();

		}
	}
}
