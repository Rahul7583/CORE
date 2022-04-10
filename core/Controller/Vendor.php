<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Vendor extends Controller_Admin_Login
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
		$vendorGrid = Ccc::getBlock('Vendor_Index');
		$content->addChild($vendorGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $vendorGrid
		];
		$this->renderJson($response);
	}

	
	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Vendor Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$vendorModel = Ccc::getModel('vendor');
			$vendorModel = $vendorModel->load($id);
		}
		else
		{
			$this->setTitle('Vendor Add');
			$vendorModel = Ccc::getModel('Vendor');
		}

		Ccc::register('vendor', $vendorModel);
		$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $vendorEdit
		];
		$this->renderJson($response);
	}

	public function saveVendor()
	{	
		try {
				$request = $this->getRequest();
				$vendor = $request->getPost('vendor');

				$id = (int)$request->getRequest('id');
				if(!$vendor)
				{
					throw new Exception("Missing Vendor data in request.", 1);
				}
				$vendorModel = Ccc::getModel('Vendor');
				$vendorModel->setData($vendor);

				if($id)
				{
					$vendorModel->vendorId = $id;
					$vendorModel->updatedDate = date('Y-m-d H:m:s');	 	
				}
				else
				{	
					$vendorModel->createdDate = date('Y-m-d H:m:s');				 		
				}
				$vendorRow = $vendorModel->save();
		 		if (!$vendorRow) 
		 		{
		 			throw new Exception("system is unable to insert.", 1);
		 		}
		 	
			 	return $vendorRow;
			} catch (Exception $e) {
				$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);				
			}	
	}

	public function saveAddress($vendorRow)
	{
		$vendorId = $vendorRow->vendorId;
		$vendor = Ccc::getModel('vendor')->load($vendorId);
		
		$address = $this->getRequest()->getPost('vendor_address');
		
		if(!$address)
		{
			throw new Exception("Missing Address data in Request ", 1);	
		}
		$addressModel = Ccc::getModel('Vendor_Address');
		if($address)
		{
			$addressModel->setData($address);
		}
		
		$resultAddress = $vendorRow->getAddress();
			
		if($resultAddress->addressId)
		{	
			$addressModel->addressId = $resultAddress->addressId;
		}
		else
		{
			$addressModel->vendorId = $vendorId;
		}

		$result = $addressModel->save();
 		if(!$result)
 		{
 			throw new Exception("System is unable to insert.", 1);	
 		}
	}

	public function saveAction()
	{
		try 
		{
			$vendorRow = $this->saveVendor();
			$this->saveAddress($vendorRow);
 			$this->getMessage()->addMessage('Data Saved.');
		 	$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
	 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
	 		$response = [
			'status' => 'success',
			'content' => $vendorGrid,
			'message' => $message
			];
			$this->renderJson($response);	
		} 
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage($e->getMessage(), Model_core_Message::ERROR);
			$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
	 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
	 		$response = [
			'status' => 'success',
			'content' => $vendorGrid,
			'message' => $message
			];
			$this->renderJson($response);
		}
	}	

	public function deleteAction()
	{
		try 
		{
			$vendorModel = Ccc::getModel('vendor');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $vendorModel->delete($id);
			if(!$result)
			{
				throw new Exception("system is unable to delete.", 1);
			}
			$this->getMessage()->addMessage('Data Deleted.');
			$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
	 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
	 		$response = [
			'status' => 'success',
			'content' => $vendorGrid,
			'message' => $message
			];
			$this->renderJson($response);
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
	 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
	 		$response = [
			'status' => 'success',
			'content' => $vendorGrid,
			'message' => $message
			];
			$this->renderJson($response);
		}
	}
}
