<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Category_Media extends Controller_Core_Action
{

	public function gridAction()
	{
		Ccc::getBlock('Category_Media_Grid')->toHtml();
	}

	public function saveAction()
	{
		$id = (int)$this->getRequest()->getRequest('id');
		$file = $_FILES['image'];
		$extention =$file['type']; 
		$extention = explode("/", $extention); // image/png
		$extention = array_pop($extention); //png
		if($extention != "jpg" && $extention != "png" && $extention != "jpeg") 
		{
			return false;
		}

		$imageName = date('Y-m-d H:i:s');
		$imageName = str_replace(array('-',':',' ') ,'', $imageName.".jpg");
		$tempName = $file['tmp_name'];
		move_uploaded_file($tempName, 'Media/Category/'.$imageName);

		$categoryImageModel = Ccc::getModel('Category_Media');
		$categoryImageModel->categoryId = $id;
		$categoryImageModel->name = $imageName;
		$categoryImageModel->save();

		//$this->redirect($this->getView()->getUrl('grid','category_media',['id'=> $id]));
	}
			
	public function editAction()
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

		foreach ($imageData['gallery'] as $row) {
			$categoryImageModel = Ccc::getModel('Category_Media');
			$categoryImageModel->imageId = $row;
			$categoryImageModel->gallery = 1;
			$categoryImageModel->save();
		}

		foreach ($imageData['remove'] as $row) {
			$categoryImageModel = Ccc::getModel('Category_Media');
			$categoryImageModel->imageId = $row;
			$categoryImageModel->remove = 1;
			$categoryImageModel->delete($row);
		}

		//$this->redirect($this->getView()->getUrl('grid','category_media',['id'=> $id]));
	}
}

