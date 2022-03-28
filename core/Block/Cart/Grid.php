<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Cart_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/cart/grid.php');
	}
	
	public function getOrderData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('orderId') as totalCount FROM orders;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		$orderModel = Ccc::getModel('Order'); 
		$order = $orderModel->fetchAll("SELECT * FROM orders Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $order;
	}
}