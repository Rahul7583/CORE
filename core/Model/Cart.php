<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php Ccc::loadClass('Model_Customer_Address'); ?>
<?php
class Model_Cart extends Model_Core_Row
{
	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $session = null;
	protected $shipping = null;
	protected $payment = null;
	protected $customer = null;
	protected $item = null;

	public function __construct()
	{
		$this->setResourceClassName('Cart_Resource');
	}

	public function setSession($session)
    {
		$this->session = $session;
		return $this->session;
    }

    public function getSession()
    {
        if(!$this->session){
            $this->setSession(Ccc::getModel('Core_Session'));
        }
        return $this->session;
    }

     public function setCart($cartId)
    {
        if(!$cartId){
            return $this;
        }
        $cart['cartId'] = $cartId;
        $this->getSession()->cart = $cart;
        return $this->getSession()->cart;
    }

     public function getCart()
    {
        if(!$this->getSession()->cart){
            return null;
        }
        return $this->getSession()->cart;        
    }

	public function setBillingAddresses(Model_Cart_Address $billingAddress)
	{
		$this->billingAddress = $billingAddress;
		return $this;
	}

	public function getBillingAddresses($reload = false)
	{

		$addressModel = Ccc::getModel('Cart_Address');
		$BILLING = Model_Customer_Address::BILLING; 
		if (!$this->cartId) 
		{
			return $addressModel;
		}
		if ($this->billingAddress && !$reload) 
		{
			return $this->billingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `cart_address` 
											WHERE `cartId` = {$this->cartId} AND `billing`  = 1 ");
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setBillingAddresses($address);
		return $address;
	}

	public function setShippingAddresses(Model_Cart_Address $shippingAddress)
	{
		$this->shippingAddress = $shippingAddress;
		return $this;
	}
	
	public function getShippingAddresses($reload = false)
	{
		$addressModel = Ccc::getModel('Cart_Address');
		$SHIPPING = Model_Customer_Address::SHIPPING; 

		if (!$this->cartId) 
		{
			return $addressModel;
		}
		if ($this->shippingAddress && !$reload) 
		{
			return $this->shippingAddress;
		}
		$address = $addressModel->fetchRow("SELECT * FROM `cart_address` 
											WHERE `cartId` = {$this->cartId} AND `shipping` = 1");
		if (!$address) 
		{
			return $addressModel;
		}
		$this->setShippingAddresses($address);
		return $address;
	}

	public function setShippingMethod(Model_Cart_Shipping $shipping)
	{
		$this->shipping = $shipping;
		return $this;
	}

	public function getShippingMethod($reload = false)
	{
		$cartShippingModel = Ccc::getModel('Cart_Shipping');
		if (!$this->shippingMethod) 
		{

			return $cartShippingModel;
		}
		if ($this->shipping && !$reload) 
		{
			return $this->shipping;
		}
		$cartShippingRow = $cartShippingModel->fetchRow("SELECT * FROM `cart_shipping` 
											WHERE `shippingId` = {$this->shippingMethod}");
		if (!$cartShippingRow) 
		{
			return $cartShippingModel;
		}
		$this->setShippingMethod($cartShippingRow);
		return $cartShippingRow;
	}

	public function setPaymentMethod(Model_Cart_Payment $payment)
	{
		$this->payment = $payment;
		return $this;
	}

	public function getPaymentMethod($reload = false)
	{
		$cartPaymentModel = Ccc::getModel('Cart_Payment');
		if (!$this->paymentMethod) 
		{
			return $cartPaymentModel;
		}
		if ($this->payment && !$reload) 
		{
			return $this->payment;
		}
		$cartPaymentRow = $cartPaymentModel->fetchRow("SELECT * FROM `cart_payment` 
											WHERE `paymentId` = {$this->paymentMethod}");
		if (!$cartPaymentRow) 
		{
			return $cartPaymentRow;
		}
		$this->setPaymentMethod($cartPaymentRow);
		return $cartPaymentRow;
	}


	public function setCustomer($customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if (!$this->customerId) 
		{
			return $customerModel;
		}
		if ($this->customer && !$reload) 
		{
			return $this->customer;
		}
		$customer = $customerModel->fetchRow("SELECT * FROM `customer` 
											WHERE `customerId` = {$this->customerId}");
		if (!$customer) 
		{
			return $customerModel;
		}
		$this->setCustomer($customer);
		return $customer;
	}

	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}

	public function getItems($reload = false)
	{
		$cartItemModel = Ccc::getModel('Cart_Item'); 
		if(!$this->cartId)
		{
			return $cartItemModel;
		}

		if($this->items && !$reload)
		{
			return $this->items;
		}

		$cartItem = $cartItemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$this->cartId}");

		if(!$cartItem)
		{
			return $cartItemModel;
		}
		$this->setItems($cartItem);
		return $cartItem;
	}
}



