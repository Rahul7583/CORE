<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()			
	{
		$salesmanGrid= Ccc::getBlock('Salesman_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($salesmanGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Salesman_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$id = (int)$this->getRequest()->getRequest('id');
			$salesmanModel = Ccc::getModel('Salesman')->load($id);
		}
		else
		{
			$salesmanModel = Ccc::getModel('Salesman');	
		}		
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->setSalesman($salesmanModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($salesmanEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Salesman_Edit');
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
