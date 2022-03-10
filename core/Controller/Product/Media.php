<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Product_Media extends Controller_Core_Action
{
	public function gridAction()
	{
		$productMediaGrid = Ccc::getBlock('Product_Media_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($productMediaGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Product_Media_Grid');
		$this->renderLayout();
	}

	public function editAction()
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
						$adminMessage->addMessage('only JPG, JPEG & PNG  files are allowed.', Model_Core_Message::ERROR);
						$this->redirect($this->getLayout()->getUrl('grid','product_media',['id'=> $id]));
					}

					$imageName = date('Y-m-d H:i:s');
					$imageName = str_replace(array('-',':',' ') ,'', $imageName.".jpg");
					$tempName = $file['tmp_name'];
					move_uploaded_file($tempName, 'Media/Product/'.$imageName);

					$imageModel = Ccc::getModel('Product_Media');
					$imageModel->productId = $id;
					$imageModel->name = $imageName;
					$imageModel->save();
					$message->addMessage('Data Saved.');
					$this->redirect($this->getLayout()->getUrl('grid','product_media',['id'=> $id]));
				}
				else
				{
					$id = (int)$this->getRequest()->getRequest('id');
					$imageData = $this->getRequest()->getPost('image');				

					$imageModel = Ccc::getModel('Product_Media');
					$imageModel->setData($imageData);
					
					foreach ($imageData['imageId'] as $row ) 
					{	
						$imageModel = Ccc::getModel('Product_Media');
						$imageModel->imageId = $row;
						$imageModel->thumbnail = 2;
						$imageModel->base = 2;
						$imageModel->small = 2;
						$imageModel->gallery = 2;
						$imageModel->status = 2;
						$imageModel->remove = 2;
						$imageModel->save();
					}

					if(array_key_exists('base', $imageData))
					{
						$imageModel = Ccc::getModel('Product_Media');
						$imageModel->imageId = $imageData['base'];
						$imageModel->base = 1;
						$imageModel->save();	
					}

					if(array_key_exists('thumbnail', $imageData))
					{
						$imageModel = Ccc::getModel('Product_Media');
						$imageModel->imageId = $imageData['thumbnail'];
						$imageModel->thumbnail = 1;
						$imageModel->save();			
					}

					if(array_key_exists('small', $imageData))
					{
						$imageModel = Ccc::getModel('Product_Media');
						$imageModel->imageId = $imageData['small'];
						$imageModel->small = 1;
						$imageModel->save();
					}

					if(array_key_exists('status', $imageData))
					{
						$imageModel = Ccc::getModel('Product_Media');
						$imageModel->imageId = $imageData['status'];
						$imageModel->status = 1;
						$imageModel->save();
					}

					if (array_key_exists('gallery', $imageData)) 
					{
						foreach ($imageData['gallery'] as $row) 
						{
							$imageModel = Ccc::getModel('Product_Media');
							$imageModel->imageId = $row;
							$imageModel->gallery = 1;
							$imageModel->save();
						}	
					}
					if (array_key_exists('remove', $imageData)) 
					{
						foreach ($imageData['remove'] as $row)
						{
							$imageModel = Ccc::getModel('Product_Media');
							$imageModel->imageId = $row;
							$imageModel->remove = 1;
							$imageModel->delete($row);
						}	
					}
					$adminMessage->addMessage('Data Updated.');
					$this->redirect($this->getLayout()->getUrl('grid','product_media',['id'=> $id]));
				}	
						
		} catch (Exception $e) {
			$adminMessage->addMessage('Somthing wrong with your data.', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid','product_media',['id'=> $id]));
		}
	}
}

