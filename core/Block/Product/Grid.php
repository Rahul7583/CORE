<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Product_Grid extends Block_Core_Template
{
	public $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/Product/grid.php');
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}


	public function getProductData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('productId') as totalCount FROM product;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		$productModel = Ccc::getModel('Product');
		$product = $productModel->fetchAll("SELECT p.*,
														 base.name as base,
														 thumbnail.name as thumbnail,
														 small.name as small
												FROM product p 
												LEFT JOIN image base
												ON p.productId = base.productId AND (base.base = 1)
												LEFT JOIN image thumbnail 
												ON p.productId = thumbnail.productId AND (thumbnail.thumbnail = 1)
												LEFT JOIN image small
												ON p.productId = small.productId AND (small.small = 1)
												Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
	
		return $product;
	}

}