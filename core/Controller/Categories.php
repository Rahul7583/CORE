<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Categories extends Controller_Core_Action{


	public function gridAction()			
	{
		$categoryGrid = Ccc::getBlock('Category_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($categoryGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Category_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{
		$categoryModel = null;
		if((int)$this->getRequest()->getRequest('id'))
		{
			$id = (int)$this->getRequest()->getRequest('id');
			$categoryModel = Ccc::getModel('Category')->load($id);
		}
		else
		{
			$categoryModel = Ccc::getModel('Category');	
		}
		$CategoryEdit = Ccc::getBlock('Category_Edit')->setCategory($categoryModel);

		$content = $this->getLayout()->getContent();
		$content->addChild($CategoryEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Category_Edit');
		$this->renderLayout();
	}

	public function saveAction()
	{
		$categoryModel = Ccc::getModel('Category');
		$formData = $this->getRequest()->getPost('category');
	
		if(!(int)$formData['hiddenId'])
		{
			try {
				unset($formData['hiddenId']);
				$setData = $categoryModel->setData($formData); 
				
				$setData->createdDate = date("Y-m-d H:m:s");
				$insertId = $categoryModel->save();
	
				$categoryPath = $categoryModel->load($formData['parentId']);
				$newPath = NULL;
				if($categoryPath)
				{
					$newPath = $categoryPath->path.'/'.$insertId;
				}
				else{
					$newPath = $insertId;
				}
				
				$updatePath = $categoryModel->load($insertId);
			
				$updatePath->parentId = $insertId;

				$updatePath->path = $newPath;
				$updatePath->save();
				$this->getMessage()->addMessage('Added SuccessFully.');

			} catch (Exception $e) {
				$this->getMessage()->addMessage('System is not able to add.',Model_Core_Message::ERROR);

			}
		}
		else{
			try{
				$row = $categoryModel->load($formData['parentId']);
				unset($formData['hiddenId']);
				$row->setData($formData);
				$row->categoryId = $formData['parentId'];// 114
				$row->updatedDate = date('Y-m-d H:m:s');
				print_r($row);
				$result = $row->save();
				$this->getMessage()->addMessage('Updated SuccessFully.');

			}catch(Exception $e){
				$this->getMessage()->addMessage('System is not able to Update.',Model_Core_Message::ERROR);

			}		
		}
		$this->redirect($this->getLayout()->getUrl('grid'));
	}

	public function deleteAction()
	{
		try {

			global $adapter;
			$id = "%".$_GET['id']."%"; 
			$query="DELETE FROM categories 
					WHERE path LIKE '$id'";	

			$result = $adapter->delete($query);
			if (!$result)
			{
				throw new Exception("system is unable to delete", 1);
			}

			$this->redirect($this->getLayout()->getUrl('grid'));
			
		} catch (Exception $e) {
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}	
}
