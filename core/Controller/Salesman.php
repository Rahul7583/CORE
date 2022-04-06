<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Salesman extends Controller_Admin_Login
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
		$salesmanGrid = Ccc::getBlock('Salesman_Index');
		$content->addChild($salesmanGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $salesmanGrid
		];
		$this->renderJson($response);
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Salesman Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$salesmanModel = Ccc::getModel('Salesman')->load($id);
		}
		else
		{
			$this->setTitle('Salesman Add');
			$salesmanModel = Ccc::getModel('Salesman');	
		}
		Ccc::register('salesman', $salesmanModel);		
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $salesmanEdit
		];
		$this->renderJson($response);
	}

	public function saveAction()
	{	
		try {
				$request = $this->getRequest();
				$salesman = $request->getPost('salesman');
				$id = (int)$request->getRequest('id'); 
	
				if(!$salesman)
				{
					throw new Exception("Missing salesman data in request.", 1);
				}
				$salesmanModel = Ccc::getModel('Salesman');
				$salesmanModel->setData($salesman);

				if($id)
				{
					$salesmanModel->salesmanId = $id;
					$salesmanModel->updatedDate = date('Y-m-d H:m:s');
				}
				else
				{	
					$salesmanModel->createdDate = date('Y-m-d H:m:s');
				}
				$salesmanId = $salesmanModel->save();
		 		if ($salesmanId) 
		 		{
				 	$this->getMessage()->addMessage('Data Saved.');
				 	$salesmanEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
			 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			 		$response = [
					'status' => 'sucess',
					'content' => $salesmanEdit,
					'message' => $message
					];
					$this->renderJson($response);
		 		} 		
				$this->gridBlockAction();			
			} catch (Exception $e) {
				$this->getMessage()->addMessage($e->getMessage(), 
					Model_Core_Message::ERROR);
				$this->gridBlockAction();						}	
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
				$this->getMessage()->addMessage('Data Deleted.');
				$salesmanEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
		 		$message = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		 		$response = [
				'status' => 'sucess',
				'content' => $salesmanEdit,
				'message' => $message
				];
				$this->renderJson($response);
				$this->gridBlockAction();			
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->gridBlockAction();			
		}
	}
}
