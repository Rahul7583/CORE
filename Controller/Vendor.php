<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Vendor extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Vendor_Grid')->toHtml();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{

				$id = (int)$this->getRequest()->getRequest('id');
				$vendorModel = Ccc::getModel('vendor');
				$vendorModel=$vendorModel->fetchRow("SELECT v.*,v_a.*
									FROM vendor v
									JOIN vendor_address v_a
									ON v_a.vendorId = v.vendorId
									WHERE v.vendorId = {$id}");
		}
		else
		{
			$vendorModel = Ccc::getModel('Vendor');
		}
		Ccc::getBlock('Vendor_Edit')->setData(['vendorEdit' => $vendorModel])->toHtml();
	}

	public function saveVendor()
	{	
			$vendorModel = Ccc::getModel('Vendor');
			$request = $this->getRequest();
			$vendor = $request->getPost('vendor');
			$vendorId = $vendor['vendorId'];
	
			if(!isset($vendor))
			{
				throw new Exception("Missing Customer data in request.", 1);
			}

			if($vendor['vendorId'] != null)
			{

					$row = $vendorModel->load($vendor['vendorId']); 	
					$row->setData($vendor);
					$row->updatedDate = date('Y-m-d H:i:s');
					$result = $row->save();
			  		if(!$result)
			  		{
			  			throw new Exception("system is unable to update.", 1);
			  		}
				 	
			}
			else{	
					
					unset($vendor['vendorId']);
					$setData = $vendorModel->setData($vendor);
					$setData->createdDate = date('Y-m-d H:i:s');
					$vendorId = $vendorModel->save();
			 		if (!$vendorId) 
			 		{
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 		
			 	}
			 	return $vendorId;
	}

	public function saveAddress($vendorId)
	{
			$addressModel = Ccc::getModel('Vendor_Address');
			$request = $this->getRequest();
			$address = $request->getPost('vendor_address');
			$resultAddress = $addressModel->load($vendorId, 'vendorId');
			if(!isset($address))
			{
				throw new Exception("Missing Address data in Request ", 1);	
			}

			 $addressData=$addressModel->fetchAll("SELECT * FROM vendor_address WHERE vendorId = {$vendorId}");
		
				if($addressData)
				{	
					$row = $addressModel->load($vendorId);
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
					$addressModel->vendorId = $vendorId;
					$result = $addressModel->save();	
			 		if(!$result)
			 		{
			 			throw new Exception("System is unable to insert.", 1);	
			 		}
				}
				//$this->redirect($this->getView()->getUrl('grid','vendor'));
	}

	public function saveAction()
	{
		try {
			 $vendorId = $this->saveVendor();
			 $this->saveAddress($vendorId);
			
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','customer'));
		}
			
	}

	public function deleteAction()
	{
		try {
				$vendorModel = Ccc::getModel('vendor');
				$id = (int)$this->getRequest()->getRequest('id');
				$result = $vendorModel->delete($id);
				if(!$result)
				{
					throw new Exception("system is unable to delete", 1);
				}
				$this->redirect($this->getView()->getUrl('grid','vendor'));
		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('grid','vendor'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}

?>