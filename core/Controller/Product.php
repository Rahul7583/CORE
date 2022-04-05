<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php
class Controller_Product extends Controller_Admin_Login
{
	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

	public function gridAction()			
	{
		$this->setTitle('Product Grid');
		$productGrid = Ccc::getBlock('Product_Grid');
		$content = $this->getLayout()->getContent()->addChild($productGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		if((int)$this->getRequest()->getRequest('id'))
		{
			$this->setTitle('Product Edit');
			$id = (int)$this->getRequest()->getRequest('id');
			$productModel = Ccc::getModel('Product')->load($id);
		}
		else
		{
			$this->setTitle('Product Add');
			$productModel = Ccc::getModel('Product');	
		}
		Ccc::register('product', $productModel);
		$productEdit = Ccc::getBlock('Product_Edit');
		$content = $this->getLayout()->getContent();
		$content->addChild($productEdit);
		$this->renderLayout();
	}

	public function saveAction()
	{	
		try 
		{
			$productModel = Ccc::getModel('product');
			$categoryModel = Ccc::getModel('category_product');
			$request = $this->getRequest();
			$product = $request->getPost('product');
			$category = $request->getPost('category');
			$id = (int)$request->getRequest('id');

			if(!$product)
			{
				throw new Exception("Missing peoduct data in request.", 1);
			}	
			
		 	if($id != NULL)
		 	{
				$productRow = $productModel->load($id);
				$productRow->setData($product);
				$productRow->productId = $id;
				$productRow->updatedDate = date('Y-m-d H:m:s');
				$result = $productRow->save();
				
				$row1 = $categoryModel->fetchAll("SELECT * FROM category_product WHERE productId = '{$id}'");

				foreach ($row1 as $key => $value) 
				{
					$categoryModel = Ccc::getModel('category_product');
					$categoryModel->delete($value->entityId);
				}

				foreach ($category['categoryId'] as $key => $value) 
				{
					$row = $categoryModel;
					$row->categoryId = $value;
					$row->productId = $id;
					$row->save();	
				}	
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
				$this->getMessage()->addMessage('Data Saved.');
				$this->redirect($this->getLayout()->getUrl('grid'));
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));
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
					$this->getMessage()->addMessage('Data Deleted.');
					$this->redirect($this->getLayout()->getUrl('grid'));	
		} 
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
			$this->redirect($this->getLayout()->getUrl('grid'));			
		}	
	}
}
