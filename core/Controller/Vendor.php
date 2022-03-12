<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()			
	{
		$vendorGrid = Ccc::getBlock('Vendor_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($vendorGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Vendor_Grid');
		$this->renderLayout();
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
		$vendorEdit = Ccc::getBlock('Vendor_Edit')->setVendor($vendorModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($vendorEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Vendor_Edit');
		$this->renderLayout();
	}

	public function saveVendor()
	{	
		try {
				$request = $this->getRequest();
				$vendor = $request->getPost('vendor');
				$id = $request->getRequest('id');
		
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
				$vendorId = $vendorModel->save();
		 		if (!$vendorId) 
		 		{
		 			throw new Exception("system is unable to insert.", 1);
		 		}
			 	return $vendorId;
			} catch (Exception $e) {
				
			}	
	}

	public function saveAddress($vendorId)
	{
		try{
				$request = $this->getRequest();
				$address = $request->getPost('vendor_address');
				if(!$address)
				{
					throw new Exception("Missing Address data in Request ", 1);	
				}

				$addressModel = Ccc::getModel('Vendor_Address');
				$addressModel->setData($address);
				$resultAddress = $addressModel->load($vendorId, 'vendorId');
				if($resultAddress)
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
		 		$this->getMessage()->addMessage('Data Saved');
				$this->redirect($this->getLayout()->getUrl('grid'));
			} catch (Exception $e) {
				$this->getMessage()->addMessage('Somthing wrong with your data', Model_core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
			}	
	}

	public function saveAction()
	{
		try 
		{
			 $vendorId = $this->saveVendor();
			 $this->saveAddress($vendorId);
		} 
		catch (Exception $e) 
		{	
			$this->getMessage()->addMessage('Somthing wrong with your data.', Model_core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
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
				$this->getMessage()->addMessage('Data Deleted');
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Somthing wrong with your data.', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
