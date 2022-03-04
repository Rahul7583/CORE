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
		$vendorEdit = Ccc::getBlock('Vendor_Edit')->setData(['vendorEdit' => $vendorModel]);
		$content = $this->getLayout()->getContent();
		$content->addChild($vendorEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Vendor_Edit');
		$this->renderLayout();
	}

	public function saveVendor()
	{	
		try {
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
			} catch (Exception $e) {
				
			}	
	}

	public function saveAddress($vendorId)
	{
		$message = Ccc::getModel('Core_Message');
		try {
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
						$message->addMessage('Data Updated', Model_core_Message::SUCCESS);
						$this->redirect($this->getLayout()->getUrl('grid'));		
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
					$message->addMessage('Data Saved', Model_core_Message::SUCCESS);
					$this->redirect($this->getLayout()->getUrl('grid','vendor'));
			} catch (Exception $e) {
				$message->addMessage('Somthing wrong with your data', Model_core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
			}	
	}

	public function saveAction()
	{
		try {
			 $vendorId = $this->saveVendor();
			 $this->saveAddress($vendorId);
		} 
		catch (Exception $e) 
		{	
			$message->addMessage('Somthing wrong with your data.', Model_core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
			
	}

	public function deleteAction()
	{
		$message = Ccc::getModel('Core_Message');
		try {
				$vendorModel = Ccc::getModel('vendor');
				$id = (int)$this->getRequest()->getRequest('id');
				$result = $vendorModel->delete($id);
				if(!$result)
				{
					throw new Exception("system is unable to delete", 1);
				}
				$message->addMessage('Data Deleted', Model_core_Message::SUCCESS);
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Somthing wrong with your data.', Model_Core_Message::SUCCESS);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}

?>