<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Page extends Controller_Core_Action
{
	public function gridAction()			
	{
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($pageGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Page_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$id = (int)$this->getRequest()->getRequest('id');
			$pageModel = Ccc::getModel('Page')->load($id);
		}
		else
		{
			$pageModel = Ccc::getModel('Page');	
		}
		$pageEdit = Ccc::getBlock('Page_Edit')->setPage($pageModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($pageEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Page_Edit');
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
