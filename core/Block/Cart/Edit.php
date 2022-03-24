<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Cart_Edit extends Block_Core_Template
{
	protected $cart = null;

	public function __construct()
	{
		$this->setTemplate('view/Cart/edit.php');
	}

	public function setCart($cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getCart()
	{
		return $this->cart;
	}

	public function getCustomers()
	{
		$customers = Ccc::getModel('Customer')->fetchAll("SELECT * FROM `customer`");
		return $customers;
	}

	public function getProduct()
	{
		$products = Ccc::getModel('Product')->fetchAll("SELECT * FROM `product`");
		return $products;
	}

	public function getCatItems()
	{
		$cartItems = Ccc::getModel('Cart_Item')->fetchAll("SELECT * FROM `cart_item` where cartId = {$this->getCart()->getCart()['cartId']}");
		return $cartItems;
	}

	public function getShipping()
	{
		$cartShipping = Ccc::getModel('Cart_Shipping')->fetchAll("SELECT * FROM `cart_shipping`");
		return $cartShipping;
	}

	public function getPayment()
	{
		$cartPayment = Ccc::getModel('Cart_Payment')->fetchAll("SELECT * FROM `cart_payment`");
		return $cartPayment;
	}

	public function getDiscount($productId,$row)
	{

		$productModel = Ccc::getModel('Product')->load($productId);
		$discount = $row*$productModel->discount/100;
		return $discount;
	}

	public function getTax($productId,$row)
	{

		$productModel = Ccc::getModel('Product')->load($productId);
		$tax = $row*$productModel->tax/100;
		return $tax;
	}

	public function getCartShippingMethod()
	{
		$shippingMethod = Ccc::getModel('Cart')->fetchAll("SELECT * FROM `cart` where cartId = {$this->getCart()->getCart()['cartId']}");
		return $shippingMethod;
	}

	public function getShippingMethod()
	{
		$shippingMethod = Ccc::getModel('Cart_Shipping')->fetchAll("SELECT * FROM `cart_shipping`");
		return $shippingMethod;
	}

}