<?php
Ccc::loadClass('Controller_Core_Action'); 
Ccc::loadClass('Model_Core_Request');

class Controller_Product extends Controller_Core_Action{

	public function gridAction()			
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
	}

	public function editAction()
	{
		global $adapter;
		$request = $this->getRequest();
		$id = $request->getRequest('id');
		$productTable = Ccc::getModel('product');
		$result = $productTable->fetchRow("SELECT * FROM product WHERE productId = {$id} ");
		Ccc::getBlock('Product_Edit')->addData('productEdit', $result)->toHtml();

	}

	public function saveAction()
	{	
		try {
			$productTable = Ccc::getModel('product');
			$request = $this->getRequest();
			$row = $request->getPost('product');
			if(array_key_exists('hiddenId', $row))
			 {
			 	if(!(int)$row['hiddenId'])
			 	{
			 		throw new Exception("Invalid Request.", 1);
			 	}
				 	$productId = $row['hiddenId'];
					$row['updatedDate'] = date('Y-m-d H:i:s');
					unset($row['hiddenId']);
					$result = $productTable->update($row, ['productId' => $productId]);
			  		if(!$result)
			  		{
			  			throw new Exception("System is unable to update. ", 1);
			  		} 	
			}
			else{
			 		$row['createdDate'] = date('Y-m-d H:i:s');
			 		$insertId = $productTable->insert($row);	
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
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			$result = $productTable->delete(['productId' => $id]);
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