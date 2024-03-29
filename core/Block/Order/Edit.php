<?php
Ccc::loadClass('Block_Core_Template');
class Block_Order_Edit extends Block_Core_Template
{
	protected $order = null;

	public function __construct()
	{
		$this->setTemplate('view/order/edit.php');
	}
	
	public function getOrder()
	{
		return Ccc::getRegistry('order');
	}

	public function setOrder($order)
	{
		$this->order = $order;
		return $this;
	}

	public function getDiscount()
	{
		$orderItemModel = Ccc::getModel('Order_Item')->fetchRow("SELECT sum((price * quantity * discount)/100) as discount FROM order_item;");
		return $orderItemModel->discount;
	}

	public function getTax()
	{
		$tax = Ccc::getModel('Order_Item')->fetchRow("SELECT sum((price * quantity * taxPercentage)/100) as totalTax FROM order_item;");
		return $tax->totalTax;	
	}

	public function getSubTotal()
	{
		$amount = Ccc::getModel('Order_Item')->fetchRow("SELECT sum(price * quantity) as subTotal FROM order_item;");
		return $amount->subTotal;
	}

}