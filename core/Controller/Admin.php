<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Admin extends Controller_Core_Action{

	public function gridAction()			
	{
		$content = $this->getLayout()->getContent();
		$adimnGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adimnGrid);
		$this->renderLayout();
	}	

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$id = (int)$this->getRequest()->getRequest('id');
			$adminModel = Ccc::getModel('admin')->load($id);
		}
		else
		{
			$adminModel = Ccc::getModel('admin');				
		}
		$adminEdit = Ccc::getBlock('Admin_Edit')->setAdmin($adminModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($adminEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Admin_Edit');
		$this->renderLayout();
	}

	public function saveAction()
	{	
		try 
		{
			$request = $this->getRequest();
			$admin = $request->getPost('admin');
			$id = $request->getRequest('id');

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
	 		$this->getMessage()->addMessage('Data Saved');
	 		$this->redirect($this->getLayout()->getUrl('grid'));
		} 
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	 
	}

	public function deleteAction()
	{
		try {
				$adminModel = Ccc::getModel('admin');
	 			$id = $this->getRequest()->getRequest('id');
				$result = $adminModel->delete($id);
				if(!$result)
				{
					throw new Exception("system is unable to delete.", 1);
				}
				$this->getMessage()->addMessage('Data Deleted');
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
				$this->getMessage()->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
