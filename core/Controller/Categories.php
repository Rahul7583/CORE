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
		$message = Ccc::getModel('Core_Message');
		try {
			 $categoryModel = Ccc::getModel('Category');
			 $request = $this->getRequest();
			 $category = $request->getPost('category');
			 print_r($category);

			if(!isset($category))
			{
				throw new Exception("Missing category data in request.", 1);
			}

			if($category['hiddenId'] != null)
			{
					$row = $categoryModel->load($category['categoryId']);
					$row->setData($category);	
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
				$block = Ccc::getBlock('Category_Edit');
					unset($category['hiddenId']);
			 		$setData = $categoryModel->setData($category);
			 		$setData->createdDate = date('Y-m-d H:i:s');
					$parentPath = $block->getpath($setData->parentId);
					print_r($parentPath);
					exit();
					$categoryId = $categoryModel->save();
			 		if (!$categoryId) 
			 		{
			 			throw new Exception("system is unable to insert.", 1);
			 		}
			 		
			 		$message->addMessage('Data Saved', Model_Core_Message::SUCCESS);
			 		$this->redirect($this->getLayout()->getUrl('grid'));
			 	}
			 } catch (Exception $e) 
			 {
			 	$message->addMessage('Something wrong with your data', Model_Core_Message::ERROR);
			 	$this->redirect($this->getLayout()->getUrl('grid'));
			 }	 
	}

	/*public function saveAction()
	{
		global $adapter;
		$row = $_POST['category'];
		$parentName = $row['parentName'];
		$name = $row['name'];
		$status = $row['status'];
		$date = date('y-m-d h:m:s');	
		$parentPath = NULL;
	
						
		if($parentName == '0')
		{
			$insert="INSERT INTO `categories` (`parentId`,`name`, `status`, `createdDate`) 
					VALUES ('$parentName','$name' , '$status', '$date' )";
			
			$insertId = $adapter->insert($insert);
				if(!$insertId){
					throw new Exception("System is unable to insert.", 1);
				}
			$parentPath = $insertId;

			$updateQuery = "UPDATE `categories` 
							SET `path` = '$parentPath' 
							WHERE `categories`.`categoryId` = '$insertId'";
			$result = $adapter->update($updateQuery);

				if(!$result){
					throw new Exception("System is unable to update.", 1);
				}
			$this->redirect("index.php?a=grid&c=categories");
		}
		else
		{
			$insert = "INSERT INTO `categories` (`name`, `status`,`createdDate`,`path`)
					  VALUES ('$name' , $status, '$date','$parentName' )";

			$insertId = $adapter->insert($insert);
			
			$path = $adapter->fetchRow("SELECT * FROM `categories` 
										WHERE `name` = '$parentName' ");
			$parentPath = $path['path']."/".$insertId;//45/20			
			$path1 = explode("/", $path['path']);
			$parentId = array_pop($path1);

			$updateQuery = "UPDATE `categories` 
							SET `path` = '$parentPath', `parentId` = '$parentId' 
							WHERE `categories`.`categoryId` = '$insertId'";			
			$newPath = $adapter->update($updateQuery);

				if(!$newPath){
					throw new Exception("System is unable to Update.", 1);
				}
				$this->redirect("index.php?a=grid&c=categories");	
		}	
	}*/

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

			$this->redirect('index.php?a=grid&c=categories');
			
		} catch (Exception $e) {
			$this->redirect('index.php?a=grid&c=categories');
		}
	}	

	public function errorAction()
	{
		echo "error";		
	}
}

?>