<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Categories extends Controller_Admin_Login
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
		$this->setTitle('Category Grid');
		$categoryGrid = Ccc::getBlock('Category_Grid');
		$content = $this->getLayout()->getContent()->addChild($categoryGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		$categoryModel = null;
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Category Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$categoryModel = Ccc::getModel('Category')->load($id);
		}
		else
		{
			$this->setTitle('Category Add');
			$categoryModel = Ccc::getModel('Category');	
		}
		$CategoryEdit = Ccc::getBlock('Category_Edit')->setCategory($categoryModel);
		$content = $this->getLayout()->getContent()->addChild($CategoryEdit);
		$this->renderLayout();
	}

	public function saveAction()
	{
		$formData = $this->getRequest()->getPost('category');
		$id = (int)$this->getRequest()->getRequest('id');
	
		$categoryModel = Ccc::getModel('Category');
		$setData = $categoryModel->setData($formData); 
		if(!$id)
		{
			try 
			{
				$setData->createdDate = date("Y-m-d H:m:s");
				$insertId = $categoryModel->save();
	
				$categoryPath = $categoryModel->load($formData['parentId']);
				$newPath = NULL;
				if($categoryPath)
				{
					$newPath = $categoryPath->path.'/'.$insertId;
				}
				else
				{
					$newPath = $insertId;
				}
				
				$updatePath = $categoryModel->load($insertId);
			
				$updatePath->parentId = $insertId;

				$updatePath->path = $newPath;
				$updatePath->save();

			} catch (Exception $e) {
				$this->getMessage()->addMessage('System is not able to add.',Model_Core_Message::ERROR);

			}
		}
		else{
			try{
				$categoryModel->load($formData['parentId']);
				$categoryModel->categoryId = $formData['parentId'];
				$categoryModel->updatedDate = date('Y-m-d H:m:s');
				$result = $categoryModel->save();

			}catch(Exception $e){
				$this->getMessage()->addMessage('System is not able to Update.', Model_Core_Message::ERROR);
			}		
		}
		$this->getMessage()->addMessage('Data Saved.');
		$this->redirect($this->getLayout()->getUrl('grid'));
	}

	public function deleteAction()
	{
		try 
		{
			$id = $this->getRequest()->getRequest('id'); 
			$categoryModel = Ccc::getModel('Category');
			$result = $categoryModel->delete($id);
			if (!$result)
			{
				throw new Exception("system is unable to delete", 1);
			}
			$this->getMessage()->addMessage('Deleted SuccessFully.');
			$this->redirect($this->getLayout()->getUrl('grid'));
			
		} catch (Exception $e) {
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}	
}
