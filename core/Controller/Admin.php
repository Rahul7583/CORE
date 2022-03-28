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

	public function gridAction()			
	{
		$this->setTitle('Admin Grid');
		$adimnGrid = Ccc::getBlock('Admin_Grid');
		$content = $this->getLayout()->getContent()->addChild($adimnGrid);
		$this->renderLayout();
	}	

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Admin Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$adminModel = Ccc::getModel('admin')->load($id);
		}
		else
		{
			$this->setTitle('Admin Add');
			$adminModel = Ccc::getModel('admin');				
		}
		Ccc::register('admin',$adminModel);
		$adminEdit = Ccc::getBlock('Admin_Edit');
		$content = $this->getLayout()->getContent()->addChild($adminEdit);
		$this->renderLayout();
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
	 			throw new Exception("system is unable to insert.", 1);
	 		}
	 		$this->getMessage()->addMessage('Data Saved.');
	 		$this->redirect($this->getLayout()->getUrl('grid'));
		} 
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
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
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
				$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
