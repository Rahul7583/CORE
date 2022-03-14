<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Page extends Controller_Admin_Login
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
		$this->setTitle('Page Grid');
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content = $this->getLayout()->getContent()->addChild($pageGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Page Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$pageModel = Ccc::getModel('Page')->load($id);
		}
		else
		{
			$this->setTitle('Page Add');
			$pageModel = Ccc::getModel('Page');	
		}
		$pageEdit = Ccc::getBlock('Page_Edit')->setPage($pageModel);
		$content = $this->getLayout()->getContent()->addChild($pageEdit);
		$this->renderLayout();
	}

	public function saveAction()
	{	
		try {
				$request = $this->getRequest();
				$page = $request->getPost('page');
				$id = $request->getRequest('id');
				if(!$page)
				{
					throw new Exception("Missing page data in request.", 1);
				}
				$pageModel = Ccc::getModel('Page');
				$pageModel->setData($page);
				if($id)
				{
					$pageModel->pageId = $id; 	
					$pageModel->updatedDate = date('Y-m-d H:m:s');
				}
			else{	

					$pageModel->createdDate = date('Y-m-d H:m:s');
			 	}
				$pageId = $pageModel->save();
		 		if (!$pageId) 
		 		{
		 			throw new Exception("system is unable to insert.", 1);
		 		}
			 	$this->getMessage()->addMessage('Data Saved'); 		
			 	$this->redirect($this->getLayout()->getUrl('grid'));
			} 
			catch (Exception $e) 
			{
				$this->getMessage()->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
			}	
	}

	public function deleteAction()
	{
		try 
		{
			$pageModel = Ccc::getModel('Page');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $pageModel->delete($id);
			if(!$result)
			{
				throw new Exception("system is unable to delete", 1);
			}
			$this->getMessage()->addMessage('Data Deleted');
			$this->redirect($this->getLayout()->getUrl('grid'));
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
