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

	public function gridAction()			
	{
		$this->setTitle('Salesman Grid');
		$salesmanGrid= Ccc::getBlock('Salesman_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($salesmanGrid);
		$this->renderLayout();
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
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->setSalesman($salesmanModel);
		$content = $this->getLayout()->getContent()->addChild($salesmanEdit);
		$this->renderLayout();
	}

	public function saveAction()
	{	
		try {
				$request = $this->getRequest();
				$salesman = $request->getPost('salesman');
				$id = $request->getRequest('id'); 
	
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
		 		if (!$salesmanId) 
		 		{
		 			throw new Exception("system is unable to insert.", 1);
		 		} 		
			 	$this->getMessge()->addMessage('Data Saved');
			 	$this->redirect($this->getLayout()->getUrl('grid'));
			} catch (Exception $e) {
				$this->getMessage()->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
				$this->redirect($this->getLayout()->getUrl('grid'));
			}	
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
				$this->getMessage()->addMessage('Data Deleted');
				$this->redirect($this->getLayout()->getUrl('grid'));
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}
}
