<?php 
Ccc::loadClass('Controller_Core_Action');
class Controller_Product_Media extends Controller_Core_Action
{

	public function gridAction()
	{
		
		Ccc::getBlock('Product_Media_Grid')->toHtml();

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
		$imageName = str_replace(array('-',':',' ') ,'', $imageName.".JPG");
		$tempName = $file['tmp_name'];
		move_uploaded_file($tempName, 'Media/Product/'.$imageName);

		$imageModel = Ccc::getModel('Product_Media');
		$imageModel->productId = $id;
		$imageModel->name = $imageName;
		$imageModel->save();

		$this->redirect($this->getView()->getUrl('product_media','grid',['id'=> $id]));

	}
			
	public function editAction()
	{	
		global $adapter;
		$id = (int)$this->getRequest()->getRequest('id');
		$imageData = $this->getRequest()->getPost('image');
		$imageModel = Ccc::getModel('Product_Media');
		$imageModel->setData($imageData);
		echo "<pre>";
		print_r($imageData);
		//echo $imageModel->base;
		/*foreach ($imageModel as $row) 
		{	

		}
		exit();
		
		foreach ($imgData as $key => $value){
			if (is_array($value)) {
				foreach ($value as $key1 => $value) {
					$imgData['remove'] = $value;
					echo '<pre>';
					print_r($imgData['remove']);
		
					$query = "DELETE FROM `image` WHERE `imageId` = {$value}";
					// echo $query;
					$adapter->delete($query);
				}		
			}	
		}
		$this->redirect($this->getView()->getUrl('grid','product_media',['id'=> $id]));*/
	}
}