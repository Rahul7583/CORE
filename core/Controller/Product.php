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
		$message = Ccc::getModel('Core_Message');
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
				  		$message->addMessage('Data updated', Model_Core_Message::SUCCESS);
				  		$this->redirect($this->getLayout()->getUrl('grid'));	
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
				$message->addMessage('Data Saved', Model_Core_Message::SUCCESS);
				$this->redirect($this->getLayout()->getUrl('grid'));
			
		} catch (Exception $e) {
			$message->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function deleteAction()
	{
		$message = Ccc::getModel('Core_Message');
		try {
				$productTable = Ccc::getModel('product');
				$id = (int)$this->getRequest()->getRequest('id');
				$result = $productTable->delete($id);
					if (!$result)
					{
						throw new Exception("system is unable to delete.", 1);
					}
					$message->addMessage('Data Deleted', Model_Core_Message::SUCCESS);
					$this->redirect($this->getLayout()->getUrl('grid'));	
		} 
		catch (Exception $e)
		{
			$message->addMessage('Somthing wrong with your data', Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));			
		}	
	}
	public function errorAction()
	{
		echo "Error.";
	}
}

?>