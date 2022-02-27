<?php
Ccc::loadClass('Controller_Core_Action'); 

class Controller_Product extends Controller_Core_Action{

	public function galleryAction()
	{
		Ccc::getBlock('Product_Gallery')->toHtml();	
	}

	public function gridAction()			
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		$productModel = Ccc::getModel('Product');
		Ccc::getBlock('Product_Edit')->setData(['productEdit' => $productModel])->toHtml();
	}

	public function editAction()
	{
		
		$id = (int)$this->getRequest()->getRequest('id');
		$productModel = Ccc::getModel('Product')->load($id);
		Ccc::getBlock('Product_Edit')->setData(['productEdit' => $productModel])->toHtml();

	}

	public function saveAction()
	{	
		try {

			$productModel = Ccc::getModel('product');
			$request = $this->getRequest();
			$product = $request->getPost('product');

			if(!isset($product))
			{
				throw new Exception("Missing admin data in request.", 1);
			}	
			 	if($product['productId'] != null)
			 	{
			 	
					$row = $productModel->load($product['productId']);
					$row->setData($product);
					$row->updatedDate = date('Y-m-d H:i:s');
					$result = $row->save();
			  		
			  		if(!$result)
			  		{
			  			throw new Exception("System is unable to update. ", 1);
			  		} 	
			}
			else{	
					
					unset($product['productId']);
					$setData = $productModel->setData($product);
					$setData->createdDate = date('Y-m-d H:i:s');
					$insertId = $productModel->save();
			 		if(!$insertId)
			 		{
			 			throw new Exception("System is unable to insert.", 1);	
			 		}			
				}
					$this->redirect($this->getView()->getUrl('product','grid'));
			
		} catch (Exception $e) {
			$this->redirect($this->getView()->getUrl('product','grid'));
		}
	}

	public function deleteAction()
	{
		try {
			$productTable = Ccc::getModel('product');
			$id = (int)$this->getRequest()->getRequest('id');
			$result = $productTable->delete($id);
				if (!$result)
				{
					throw new Exception("system is unable to delete.", 1);
				}
			$this->redirect($this->getView()->getUrl('product','grid'));
	
		} 
		catch (Exception $e)
		{
			$adapter->redirect($this->getView()->getUrl('product','grid'));			
		}	
	}
	public function errorAction()
	{
		echo "Error.";
	}
}

?>