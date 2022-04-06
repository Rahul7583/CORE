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

    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Index');
		$content->addChild($pageGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$pageGrid = Ccc::getBlock('Page_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $pageGrid
		];
		$this->renderJson($response);
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
		Ccc::register('page', $pageModel);
		$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $pageEdit
		];
		$this->renderJson($response);
	
	}

	public function saveAction()
	{	
		try {
				$request = $this->getRequest();
				$page = $request->getPost('page');
				$id = (int)$request->getRequest('id');
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
		 		if ($pageId) 
		 		{
			 		$this->getMessage()->addMessage('Data Saved.'); 		
		 			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
			 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			 		$response = [
					'status' => 'sucess',
					'content' => $pageEdit,
					'message' => $message
					];
					$this->renderJson($response);
		 		}
				$this->gridBlockAction();			
			 	
			} 
			catch (Exception $e) 
			{
				$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
	 			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'sucess',
				'content' => $pageEdit,
				'message' => $message
				];
				$this->renderJson($response);
				$this->gridBlockAction();			

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
			$this->getMessage()->addMessage('Data Deleted.');
			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
	 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
	 		$response = [
			'status' => 'sucess',
			'content' => $pageEdit,
			'message' => $message
			];
			$this->renderJson($response);
			$this->gridBlockAction();						
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
	 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
	 		$response = [
			'status' => 'sucess',
			'content' => $pageEdit,
			'message' => $message
			];
			$this->renderJson($response);
			$this->gridBlockAction();
		}
	}

	public function deleteAllAction()
	{
		$pti = $this->getRequest()->getPost('checkbox');
		foreach ($pti as $key => $value) {
			$pageModel = Ccc::getModel('Page');
			$pageModel->delete($value);
		}
	}

}
