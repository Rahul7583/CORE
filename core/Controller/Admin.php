<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Admin extends Controller_Admin_Login
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
		$adminGrid = Ccc::getBlock('Admin_Index');
		$content->addChild($adminGrid);
		$this->renderLayout();
	}
	
	public function gridBlockAction()
	{
		$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $adminGrid
		];
		$this->renderJson($response);
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Admin Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$adminModel = Ccc::getModel('Admin')->load($id);
		}
		else
		{
			$this->setTitle('Admin Add');
			$adminModel = Ccc::getModel('Admin');				
		}
		
		Ccc::register('admin',$adminModel);
		$adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $adminEdit
		];
		$this->renderJson($response);		
	}

	public function saveAction()
	{	
		try 
		{ 
			$admin = $this->getRequest()->getPost('admin');
			$id = (int)$this->getRequest()->getRequest('id');
			
			if(!$admin)
			{
				throw new Exception("Missing admin data in request.", 1);
			}

			$adminModel = Ccc::getModel('Admin');
			$adminModel->setData($admin);
			if($id)
			{	
				$adminModel->adminId = $id;
				$adminModel->updatedDate = date('Y-m-d H:m:s');
			}
			else
			{
		 		$adminModel->createdDate = date('Y-m-d H:m:s');
			}
					
			$adminId = $adminModel->save();
	 		if (!$adminId) 
	 		{
	 			throw new Exception("System can't save admin data", 1); 
	 		}
		 		$this->getMessage()->addMessage('Data Saved.');
		 		$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'sucess',
				'content' => $adminGrid,
				'message' => $message
				];
				$this->renderJson($response);
		} 
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'sucess',
				'content' => $adminGrid,
				'message' => $message
				];
				$this->renderJson($response);
		}	 
	}

	public function deleteAction()
	{
		try {
				$adminModel = Ccc::getModel('admin');
	 			$id = (int)$this->getRequest()->getRequest('id');

				$result = $adminModel->delete($id);
				if(!$result)
				{
					throw new Exception("system is unable to delete.", 1);
				}
				$this->getMessage()->addMessage('Data Deleted.');
				$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'sucess',
				'content' => $adminGrid,
				'message' => $message
				];
				$this->renderJson($response);
		} catch (Exception $e) {
				$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
				$this->gridBlockAction();
		}
	}
}
