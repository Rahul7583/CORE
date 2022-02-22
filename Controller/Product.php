<?php
Ccc::loadClass('Controller_Core_Action'); 
Ccc::loadClass('Model_Core_Request');

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
<?php
Ccc::loadClass('Controller_Core_Action'); 
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
<?php
Ccc::loadClass('Controller_Core_Action'); 
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
<?php
Ccc::loadClass('Controller_Core_Action'); 
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
<?php
Ccc::loadClass('Controller_Core_Action'); 
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
class Controller_Product extends Controller_Core_Action{

	public function gridAction()			
	{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
		Ccc::getBlock('Product_Grid')->toHtml();
=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		global $adapter;
		$products=$adapter->fetchAll('select * from product');
		
		$view=$this->getView();
		$view->setTemplate('view\product_grid.php');
		$view->addData('productGrid',$products);
		$view->toHtml();

		//require_once 'view\product_grid.php';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function addAction()
	{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
		Ccc::getBlock('Product_Add')->toHtml();
=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		$view=$this->getView();
		$view->setTemplate('view\product_add.php');
		$view->toHtml();
		//require_once 'view\product_add.php';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	}

	public function editAction()
	{
		global $adapter;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
		$request = $this->getRequest();
		$id = $request->getRequest('id');
		$productTable = Ccc::getModel('product');
		$result = $productTable->fetchRow("SELECT * FROM product WHERE productId = {$id} ");
		Ccc::getBlock('Product_Edit')->addData('productEdit', $result)->toHtml();

=======
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
		$id = $_GET['id'];
		$result=$adapter->fetchRow("select * from product where productId='$id'");
		
		$view=$this->getView();
		$view->setTemplate('view\product_edit.php');
		$view->addData('productEdit',$result);
		$view->toHtml();
		//require 'view\product_edit.php';
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
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