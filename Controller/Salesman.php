<?php 
Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Salesman_Grid')->toHtml();
	}


	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$id = (int)$this->getRequest()->getRequest('id');
			$salesmanModel = Ccc::getModel('Salesman')->load($id);
		}
		else
		{
			$salesmanModel = Ccc::getModel('Salesman');	
		}		
		Ccc::getBlock('Salesman_Edit')->setData(['salesmanEdit' => $salesmanModel])->toHtml();
	}

	public function saveAction()
	{	
			$salesmanModel = Ccc::getModel('Salesman');
			$request = $this->getRequest();
			$salesman = $request->getPost('salesman');
	
			if(!isset($salesman))
			{
				throw new Exception("Missing salesman data in request.", 1);
			}

			if($salesman['salesmanId'] != null)
			{
					$row = $salesmanModel->load($salesman['salesmanId']); 	
					$row->setData($salesman);
					$row->updatedDate = date('Y-m-d H:i:s');
					$result = $row->save();
			  		if(!$result)
			  		{
			  			throw new Exception("system is unable to update.", 1);
			  		}
				 	
			}
			else{	
					unset($salesman['salesmanId']);
					$setData = $salesmanModel->setData($salesman);
					$setData->createdDate = date('Y-m-d H:i:s');
					$salesmanId = $salesmanModel->save();
			 		if (!$salesmanId) 
			 		{
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 		
			 	}
	}

	

	public function deleteAction()
	{
		try {
			$salesmanModel = Ccc::getModel('salesman');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $salesmanModel->delete($id);
			if(!$result)
			{
				throw new Exception("system is unable to delete", 1);
			}
			//$this->redirect($this->getView()->getUrl('grid','salesman'));
		} catch (Exception $e) {
			//$this->redirect($this->getView()->getUrl('grid','salesman'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}


?>