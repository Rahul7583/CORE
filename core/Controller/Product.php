<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php
class Controller_Product extends Controller_Core_Action
{
	public function gridAction()			
	{
		$productGrid = Ccc::getBlock('Product_Grid');
		$content = $this->getLayout()->getContent();
		$content->addChild($productGrid);
		$this->getLayout()->getChild('content')->getChild('Block_Product_Grid');
		$this->renderLayout();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$id = (int)$this->getRequest()->getRequest('id');
			$productModel = Ccc::getModel('Product')->load($id);
		}
		else
		{
			$productModel = Ccc::getModel('Product');	
		}
		$productEdit = Ccc::getBlock('Product_Edit')->setProduct($productModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($productEdit);
		$this->getLayout()->getChild('content')->getChild('Block_Product_Edit');
		$this->renderLayout();
	}

	public function saveAction()
	{	
		$adminMessage = Ccc::getModel('Admin_Message');
		try 
		{
			$productModel = Ccc::getModel('product');
			$categoryModel = Ccc::getModel('category_product');
			$request = $this->getRequest();
			$product = $request->getPost('product');
			$category = $request->getPost('category');
			$id = $request->getRequest('id');

			if(!$product)
			{
				throw new Exception("Missing peoduct data in request.", 1);
			}	
			
		 	if($id != NULL)
		 	{
				$productRow = $productModel->load($id);
				$productRow->setData($product);
				$productRow->updatedDate = date('Y-m-d H:m:s');
				$productId = $productRow->productId;
				
				$row = $categoryModel;

				foreach ($category['categoryId'] as $key => $value) 
				{
					$row->categoryId = $value;
					$row->productId = $productId;
					$row->save();	
				}	

				$row->productId = $productId;		  		
		  		$adminMessage->addMessage('Data updated');
		  		$this->redirect($this->getLayout()->getUrl('grid'));	
			}
			else{	
					
					$setData = $productModel->setData($product);
					$setData->createdDate = date('Y-m-d H:m:s');
					$insertId = $productModel->save();
					
					foreach ($category['categoryId'] as $key => $value) 
					{
						$row = $categoryModel;
						$row->categoryId = $value;
						$row->productId = $insertId;
						$row->save();	
					}	
					
			 		if(!$insertId)
			 		{
			 			throw new Exception("System is unable to insert.", 1);	
			 		}			
				}
				$adminMessage->addMessage('Data Saved');
				$this->redirect($this->getLayout()->getUrl('grid'));
			
		} catch (Exception $e) {
			$adminMessage->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function deleteAction()
	{
		$adminMessage = Ccc::getModel('Admin_Message');
		try {
				$productTable = Ccc::getModel('product');
				$id = (int)$this->getRequest()->getRequest('id');
				$result = $productTable->delete($id);
					if (!$result)
					{
						throw new Exception("system is unable to delete.", 1);
					}
					$adminMessage->addMessage('Data Deleted');
					$this->redirect($this->getLayout()->getUrl('grid'));	
		} 
		catch (Exception $e)
		{
			$adminMessage->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));			
		}	
	}
}
