<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php
class Controller_Config extends Controller_Admin_Login
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
		$configGrid = Ccc::getBlock('Config_Index');
		$content->addChild($configGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $configGrid
		];
		$this->renderJson($response);
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Config Edit');	
			$id = $this->getRequest()->getRequest('id');
			$configModel = Ccc::getModel('Config')->load($id);
		}
		else
		{
			$this->setTitle('Config Add');	
			$configModel = Ccc::getModel('Config');
		}
		Ccc::register('config', $configModel);
		$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $configEdit
		];
		$this->renderJson($response);
	}

	public function saveAction()
	{
		try 
		{
			$config = $this->getRequest()->getPost('config');
			$id = (int)$this->getRequest()->getRequest('id');
			if(!$config)
			{
				throw new Exception("Missing config data in request.", 1);
			}

			$configModel = Ccc::getModel('Config');
			$configModel->setData($config);
		 	if($id)
		 	{
				$configModel->configId = $id;  	  	
				$configModel->updatedDate = date('Y-m-d H:m:s');
		  	}			
			else
			{	
					$configModel->createdDate = date('Y-m-d H:m:s');
			}
			$insertId = $configModel->save();
	 		if(!$insertId)
	 		{
	 			throw new Exception("System can't save config data", 1);
	 		}
	 			$this->getMessage()->addMessage('Data Saved.');
		 		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'success',
				'content' => $configGrid,
				'message' => $message
				];
				$this->renderJson($response);
						
		}
		catch (Exception $e)
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'success',
				'content' => $configGrid,
				'message' => $message
				];
				$this->renderJson($response);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$configModel = Ccc::getModel('config');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $configModel->delete($id);
			if (!$result)
			{
				throw new Exception("system is unable to delete.", 1);
			}
				$this->getMessage()->addMessage('Data Deleted.');
				$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'success',
				'content' => $configGrid,
				'message' => $message
				];
				$this->renderJson($response);
			
		} 
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
				$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'success',
				'content' => $configGrid,
				'message' => $message
				];
				$this->renderJson($response);									
		}	
	}
}
