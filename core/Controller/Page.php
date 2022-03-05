<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Page extends Controller_Core_Action{

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
		$message = Ccc::getModel('Core_Message');
		try {
				$pageModel = Ccc::getModel('Page');
				$request = $this->getRequest();
				$page = $request->getPost('page');

				if(!isset($page))
				{
					throw new Exception("Missing page data in request.", 1);
				}
				if($page['pageId'] != null)
				{
						$row = $pageModel->load($page['pageId']); 	
						$row->setData($page);
						$row->updatedDate = date('Y-m-d H:i:s');
						$result = $row->save();
				  		if(!$result)
				  		{
				  			throw new Exception("system is unable to update.", 1);
				  		}
				  		$message->addMessage('Data Updated', Model_Core_Message::SUCCESS);
				  		$this->redirect($this->getLayout()->getUrl('grid'));
				}
			else{	
					unset($page['pageId']);
					$setData = $pageModel->setData($page);
					$setData->createdDate = date('Y-m-d H:i:s');
					$pageId = $pageModel->save();
			
			 		if (!$pageId) 
			 		{
			 			throw new Exception("system is unable to insert.", 1);
			 		} 		
			 	}
			 	$message->addMessage('Data Saved', Model_Core_Message::SUCCESS);
			 	$this->redirect($this->getLayout()->getUrl('grid'));
			} catch (Exception $e) {
				$message->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
			}	
	}

	public function deleteAction()
	{
		$message = Ccc::getModel('Core_Message');
		try 
		{
			$pageModel = Ccc::getModel('Page');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $pageModel->delete($id);
			if(!$result)
			{
				throw new Exception("system is unable to delete", 1);
			}
			$message->addMessage('Data Deleted', Model_Core_Message::SUCCESS);
			$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
			$message->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function errorAction()
	{
			echo "Error.";
	}
}


?>