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

	public function saveAction()
	{
		$id = (int)$this->getRequest()->getRequest('id');
		$file = $_FILES['image'];
		$extention =$file['type']; 
		$extention = explode("/", $extention); // image/png
		$extention = array_pop($extention); //png
		if($extention != "jpg" && $extention != "png" && $extention != "jpeg") 
		{
			echo "Only JPG, JPEG, PNG  files are allowed.";
			return false;
		}

		$imageName = date('Y-m-d H:i:s');
		$imageName = str_replace(array('-',':',' ') ,'', $imageName.".jpg");
		$tempName = $file['tmp_name'];
		move_uploaded_file($tempName, 'Media/Product/'.$imageName);

		$imageModel = Ccc::getModel('Product_Media');
		$imageModel->productId = $id;
		$imageModel->name = $imageName;
		$imageModel->save();

		$this->redirect($this->getView()->getUrl('grid','product_media',['id'=> $id]));
	}
			
	public function editAction()
	{	
		global $adapter;
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

		foreach ($imageData['gallery'] as $row) {
			$imageModel = Ccc::getModel('Product_Media');
			$imageModel->imageId = $row;
			$imageModel->gallery = 1;
			$imageModel->save();
		}

		foreach ($imageData['remove'] as $row) {
			$imageModel = Ccc::getModel('Product_Media');
			$imageModel->imageId = $row;
			$imageModel->remove = 1;
			$imageModel->delete($row);
		}

		$this->redirect($this->getView()->getUrl('grid','product_media',['id'=> $id]));
	}
}

