<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Product_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}
	
	public function getProductData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('productId') as totalCount FROM product;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		$productModel = Ccc::getModel('Product');
		$product = $productModel->fetchAll("SELECT * FROM product 
											Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
	
		return $product;
	}

}