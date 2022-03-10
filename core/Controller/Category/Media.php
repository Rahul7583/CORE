<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Category_Media extends Controller_Core_Action
{

	public function gridAction()
	{
		$categoryMediaGrid = Ccc::getBlock('Category_Media_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($categoryMediaGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Category_Media_Grid');
		$this->renderLayout();
	}

	public function saveAction()
	{
		$adminMessage = Ccc::getModel('Admin_Message');
		try {
				if($_FILES['image'])
				{
					$id = (int)$this->getRequest()->getRequest('id');
					$file = $_FILES['image'];
					$extention =$file['type']; 
					$extention = explode("/", $extention);
					$extention = array_pop($extention);
					if($extention != "jpg" && $extention != "png" && $extention != "jpeg") 
					{
						$message->addMessage('only JPG, JPEG & PNG  files are allowed.', Model_Core_Message::ERROR);
						$this->redirect($this->getLayout()->getUrl('grid','category_media',['id'=>$id]));
					}

					$imageName = date('Y-m-d H:i:s');
					$imageName = str_replace(array('-',':',' ') ,'', $imageName.".jpg");
					$tempName = $file['tmp_name'];
					move_uploaded_file($tempName, 'Media/Category/'.$imageName);

					$categoryImageModel = Ccc::getModel('Category_Media');
					$categoryImageModel->categoryId = $id;
					$categoryImageModel->name = $imageName;
					$categoryImageModel->save();

					$adminMessage->addMessage('Data Saved.');
					$this->redirect($this->getLayout()->getUrl('grid','category_media',['id'=> $id]));	
				}
				else
				{
					$id = (int)$this->getRequest()->getRequest('id');
					$imageData = $this->getRequest()->getPost('image');
					$categoryImageModel = Ccc::getModel('Category_Media');
					$categoryImageModel->setData($imageData);
					
					foreach ($imageData['imageId'] as $row ) 
					{	
						$categoryImageModel = Ccc::getModel('Category_Media');
						$categoryImageModel->imageId = $row;
						$categoryImageModel->thumbnail = 2;
						$categoryImageModel->base = 2;
						$categoryImageModel->small = 2;
						$categoryImageModel->gallery = 2;
						$categoryImageModel->status = 2;
						$categoryImageModel->remove = 2;
						$categoryImageModel->save();
					}


					if(array_key_exists('base', $imageData))
					{
						$categoryImageModel = Ccc::getModel('Category_Media');
						$categoryImageModel->imageId = $imageData['base'];
						$categoryImageModel->base = 1;
						$categoryImageModel->save();	
					}

					if(array_key_exists('thumbnail', $imageData))
					{
						$categoryImageModel = Ccc::getModel('Category_Media');
						$categoryImageModel->imageId = $imageData['thumbnail'];
						$categoryImageModel->thumbnail = 1;
						$categoryImageModel->save();			
					}

					if(array_key_exists('small', $imageData))
					{
						$categoryImageModel = Ccc::getModel('Category_Media');
						$categoryImageModel->imageId = $imageData['small'];
						$categoryImageModel->small = 1;
						$categoryImageModel->save();
					}

					if(array_key_exists('status', $imageData))
					{
						$categoryImageModel = Ccc::getModel('Category_Media');
						$categoryImageModel->imageId = $imageData['status'];
						$categoryImageModel->status = 1;
						$categoryImageModel->save();
					}

					if(array_key_exists('gallery', $imageData))
					{
						foreach ($imageData['gallery'] as $row) 
						{
							$categoryImageModel = Ccc::getModel('Category_Media');
							$categoryImageModel->imageId = $row;
							$categoryImageModel->gallery = 1;
							$categoryImageModel->save();
						}	
					}

					if(array_key_exists('remove', $imageData))
					{
						foreach ($imageData['remove'] as $row) 
						{
							$categoryImageModel = Ccc::getModel('Category_Media');
							$categoryImageModel->imageId = $row;
							$categoryImageModel->remove = 1;
							$categoryImageModel->delete($row);
						}
					}	
					$adminMessage->addMessage('Data Updated.');
					$this->redirect($this->getLayout()->getUrl('grid','category_media',['id'=> $id]));	
				}
		} catch (Exception $e) {
			$adminMessage->addMessage('Somthing wrong with your data.', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid','category_media',['id'=> $id]));
		}
		
	}
			
}

