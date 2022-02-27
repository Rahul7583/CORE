<?php
Ccc::loadClass('Controller_Core_Action'); 


class Controller_Config extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Config_Grid')->toHtml();
	}

	public function addAction()
	{
		$configModel = Ccc::getModel('Config');
		Ccc::getBlock('Config_Edit')->setData(['configEdit' => $configModel])->toHtml();

	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$configModel = Ccc::getModel('Config')->load($id);
		Ccc::getBlock('Config_Edit')->setData(['configEdit' => $configModel])->toHtml();

	}

	public function saveAction()
	{	
		try {
			 $configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			$config = $request->getPost('config');
	
			 	if($config['configId'] != null)
			 	{
					$row = $configModel->load($config['configId']);
					$row->setData($config);  	
					$row->updatedDate = date('Y-m-d H:i:s');
					$result = $row->save();
			  		if(!$result)
			  		{
			  			throw new Exception("System is unable to update. ", 1);
			  		} 
			  	}			
				else{	
						unset($config['configId']);
						$setData = $configModel->setData($config);
						$setData->createdDate = date('Y-m-d H:i:s');
						$insertId = $configModel->save();
				 		if(!$insertId)
				 		{
				 			throw new Exception("System is unable to insert.", 1);	
				 		}			
					}
						$this->redirect($this->getView()->getUrl('config','grid'));
			}
		 catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('config','grid'));
		}
	}

	public function deleteAction()
	{
		try {
			$configModel = Ccc::getModel('config');
			$id = $this->getRequest()->getRequest('id');
			$result = $configModel->delete($id);
				if (!$result)
				{
					throw new Exception("system is unable to delete.", 1);
				}

			$this->redirect($this->getView()->getUrl('config','grid'));
	
		} 
		catch (Exception $e)
		{
			$this->redirect($this->getView()->getUrl('config','grid'));			
		}	
	}
	public function errorAction()
	{
		echo "Error.";
	}
}

?>