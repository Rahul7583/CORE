<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Cart extends Controller_Admin_Login
{
	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

     public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$cartGrid = Ccc::getBlock('Cart_Index');
		$content->addChild($cartGrid);
		$this->renderLayout();
	}
	
	public function gridBlockAction()
	{
		$cartGrid = Ccc::getBlock('Cart_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $cartGrid
		];
		$this->renderJson($response);
	}

	public function editAction()			
	{
		$cartModel = Ccc::getModel('Cart');

		$this->setTitle('Cart Edit');

		Ccc::register('cart',$cartModel);
		$cartEdit = Ccc::getBlock('Cart_Edit')->toHtml();
		$response = [
			'status' => 'success',
			'content' => $cartEdit
		];
		$this->renderJson($response);
	}

    public function getCartAction()
    {
    	$customerId = $this->getRequest()->getRequest('id');
    	$cartModel = Ccc::getModel('Cart');
    	$cartRow = $cartModel->load('customerId', $customerId);
    	
    	if($cartRow)
    	{
    		$cartModel->setCart($cartRow->cartId);
    	}
    	else
    	{
    		$cartModel->customerId = $customerId;
    		$result = $cartModel->save();
    		if(!$result)
	 		{
	 			throw new Exception("System is unable to insert.", 1);	
	 		}
	 		$cartModel->setCart($result->cartId);
    	}
    	$this->redirect($this->getLayout()->getUrl('edit'));
    }

	public function saveBillingAddressAction()
	{
		try 
		{	
			$cartModel = Ccc::getModel('Cart');
			$billingAddress = $this->getRequest()->getPost('billingAddress');
			$cartId = $cartModel->getCart()['cartId'];
					
			$cartRow = $cartModel->load($cartId);
			$cartBilling = $cartRow->getBillingAddresses();
				
				if($billingAddress['addressBook'])
				{
					$customerModel = Ccc::getModel('Customer')->load($cartRow->customerId);
					$addressRow = $customerModel->getBillingAddresses();
			 		$addressRow->setData($billingAddress);
			 		unset($addressRow->addressBook);
					$addressRow->customerId = $cartRow->customerId;
					$addressRow->billing = Model_Customer_Address::BILLING;
					$result = $addressRow->save();
					if(!$result)
	 				{
	 					throw new Exception("System is unable to save in addressBook.", 1);	
	 				}
					$this->getMessage()->addMessage('Address Saved.');

				}

				if($billingAddress['shipping'])
				{
					$cartAddressModel = Ccc::getModel('Cart_Address');
			 		$cartAddressModel->setData($billingAddress);
					$cartAddressModel->cartId = $cartId;
					$cartAddressModel->shipping = Model_Customer_Address::SHIPPING;
					if ($billingAddress['addressBook']) 
					{
		 				unset($cartAddressModel->addressBook);
					}
					$result = $cartAddressModel->save();
					if(!$result)
	 				{
	 					throw new Exception("System is unable to save in addressBook.", 1);	
	 				}
					$this->getMessage()->addMessage('Address Saved.');

				}

			$addressRow = $cartBilling->setData($billingAddress);
			unset($addressRow->addressBook);
			$addressRow->cartId = $cartId;
			$addressRow->billing = Model_Customer_Address::BILLING;
			$result = $addressRow->save();
	 		if(!$result)
	 		{
	 			throw new Exception("System is unable to insert.", 1);	
	 		}
			$this->getMessage()->addMessage('Address Saved.');
			$this->redirect($this->getLayout()->getUrl('edit'));			
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	
	}

	public function saveShippingAddressAction()
	{
		try 
		{	
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$cartRow = $cartModel->load($cartId);
			$shippingAddress = $this->getRequest()->getPost('shippingAddress');
			$cartAddressRow = $cartRow->getShippingAddresses();

			 if($shippingAddress['addressBook'])
				{
					$customerModel = Ccc::getModel('Customer')->load($cartRow->customerId);
					$addressRow = $customerModel->getShippingAddresses();
			 		$addressRow->setData($shippingAddress);
			 		unset($addressRow->addressBook);
					$addressRow->customerId = $cartRow->customerId;
					$addressRow->shipping = Model_Customer_Address::SHIPPING;
					$result = $addressRow->save();
					if(!$result)
	 				{
	 					throw new Exception("System is unable to save in addressBook.", 1);	
	 				}
					$this->getMessage()->addMessage('Address Saved.');
				}	
			
			$addressRow = $cartAddressRow->setData($shippingAddress);
			unset($addressRow->addressBook);
			$addressRow->cartId = $cartId;
			$addressRow->shipping = Model_Customer_Address::SHIPPING;
			$result = $addressRow->save();
			
	 		if(!$result)
	 		{
	 			throw new Exception("System is unable to insert.", 1);	
	 		}
			$this->getMessage()->addMessage('Address Saved.');
			$this->redirect($this->getLayout()->getUrl('edit'));
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	
	}

	public function addItemAction()
	{
		try 
		{
			$customerId = $this->getRequest()->getRequest('id');
			$items = $this->getRequest()->getPost('items');
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$productModel = Ccc::getModel('Product');

			$itemModel = Ccc::getModel('Cart_Item');
			foreach ($items as $productId => $value) 
			{
				$productRow = $productModel->load($value);
				$itemModel->cartId = $cartId;
				$itemModel->productId = $productRow->productId;
				$itemModel->quantity = $productRow->quantity;
				$itemModel->price = $productRow->price;
				$result = $itemModel->save();
		 		if(!$result)
		 		{
		 			throw new Exception("System is unable to insert.", 1);	
		 		}
			}
			$this->getMessage()->addMessage('Item Added successfully.');
			$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	
	}

	public function savePaymentMethodAction()
	{
		try 
		{
			$customerId = $this->getRequest()->getRequest('id');
			$paymentId = $this->getRequest()->getPost('paymentMethod');
			$paymentModel = Ccc::getModel('cart_payment')->load($paymentId);
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$cartModel->cartId = $cartId;

			$cartModel->paymentMethod = $paymentId;
			$result = $cartModel->save();
			if(!$result)
		 	{
		 		throw new Exception("System is unable to insert.", 1);	
		 	}
			$this->getMessage()->addMessage('Saved Payment Method.');
			$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	
	}

	public function saveShippingMethodAction()
	{
		try 
		{
			$customerId = $this->getRequest()->getRequest('id');
			$shippingId = $this->getRequest()->getPost('shippingMethod');
			$shippingModel = Ccc::getModel('cart_shipping')->load($shippingId);
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$cartModel->cartId = $cartId;

			$cartModel->shippingMethod = $shippingId;
			$cartModel->deliveryCharge = $shippingModel->amount;
			$result = $cartModel->save();
			if(!$result)
		 	{
		 		throw new Exception("System is unable to insert.", 1);	
		 	}
			$this->getMessage()->addMessage('Saved Shipping Method.');
			$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	
	}

	public function saveOrderAction()
	{
		try 
		{
			$customerId = $this->getRequest()->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cartId = $cartModel->getCart()['cartId'];
			$cartRow = $cartModel->load($cartId);
			$customerRow = $cartRow->getCustomer();
			$shippingMethod = $cartRow->getShippingMethod();

			$orderModel = Ccc::getModel('Order');
			$orderModel->customerId = $customerRow->customerId;
			$orderModel->firstName = $customerRow->firstName;
			$orderModel->lastName = $customerRow->lastName;
			$orderModel->mobile = $customerRow->mobile;
			$orderModel->email = $customerRow->email;
			$orderModel->grandTotal = $this->getRequest()->getPost('grandTotal');
			$orderModel->shippingId = $shippingMethod->shippingId;
			$orderModel->shippingAmount = $shippingMethod->amount;
			$orderModel->paymentId = $cartRow->paymentMethod;
			$orderModel->state = Model_Order::STATE_ENABLED;//1;//self::STATE_ENABLED;
			$orderModel->status = Model_Order::STATUS_ENABLED;//1;//self::STATUS_ENABLED;
			$orderModel->createdDate = date('Y-m-d H:i:s');
			$orderDetails = $orderModel->save();
			if(!$orderDetails)
			{
				throw new Exception("System can't save ", 1);	
			}
			return $orderDetails;
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	
	}

	public function saveOrderAddressAction($orderRow)
	{

		 $customerRow = $orderRow->getCustomer();
		 $billingAddress = $customerRow->getCart()->getBillingAddresses();
		 $shippingAddress = $customerRow->getCart()->getShippingAddresses();

		
		$orderAddressModel = Ccc::getModel('Order_Address');
		$orderAddressModel->orderId = $orderRow->orderId;
		$orderAddressModel->firstName = $orderRow->firstName;
		$orderAddressModel->lastName = $orderRow->lastName;
		$orderAddressModel->mobile = $orderRow->mobile;
		$orderAddressModel->email = $orderRow->email;

		if($billingAddress->addressId)
		{
			$orderAddressModel->address = $billingAddress->address;
			$orderAddressModel->postalCode = $billingAddress->postalCode;
			$orderAddressModel->city = $billingAddress->city;
			$orderAddressModel->state = $billingAddress->state;
			$orderAddressModel->country = $billingAddress->country;
			$orderAddressModel->type = 1;
			$orderAddressModel->createdDate = date('Y-m-d H:i:s');
			$result = $orderAddressModel->save();
			if(!$result)
			{
				throw new Exception("System can't save ", 1);	
			}
		}

		if($shippingAddress->addressId)
		{
			$orderAddressModel->address = $shippingAddress->address;
			$orderAddressModel->postalCode = $shippingAddress->postalCode;
			$orderAddressModel->city = $shippingAddress->city;
			$orderAddressModel->state = $shippingAddress->state;
			$orderAddressModel->country = $shippingAddress->country;
			$orderAddressModel->createdDate = date('Y-m-d H:i:s');
			$result = $orderAddressModel->save();
			if(!$result)
			{
				throw new Exception("System can't save ", 1);	
			}
		}
	}

	public function saveOrderItemAction($orderRow)
	{
		  $order = $orderRow->getCustomer()->getCart()->getItems();
		  $orderId = $orderRow->orderId;
		  $orderItemModel = Ccc::getModel('Order_Item');
		  $orderItemModel->orderId = $orderId;
		  foreach ($order as $key => $value) 
		  {
		  	$row = $value->getProduct();
		  
		   $orderItemModel->productId = $row->productId;
		   $orderItemModel->name = $row->name;
		   $orderItemModel->sku = $row->sku;
		   $orderItemModel->cost = $row->cost_price;
		   $orderItemModel->price = $row->price;
		   $orderItemModel->quantity = $value->quantity;
		   $orderItemModel->discount = $row->discount;
		   $orderItemModel->taxPercentage = $row->tax;
		   $orderItemModel->taxAmount = $row->taxAmount;
		   $orderItemModel->createdDate = date('Y-m-d H:i:s');
		   $result = $orderItemModel->save();
		   if(!$result)
		 	{
		 		throw new Exception("System is unable to orderItem.", 1);	
		 	}
		}		
	}

	public function saveAction()
	{
		try 
		{
			$customerId = $this->getRequest()->getRequest('id');
			$orderRow = $this->saveOrderAction();
			$orderAddressRow = $this->saveOrderAddressAction($orderRow);
			$orderItemRow = $this->saveOrderItemAction($orderRow);
			$this->getMessage()->addMessage('order Placed Successfully.');
			$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));
			

		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}
	}

	public function removeCartItemAction()
	{
		try 
		{
			$cartItemModel = Ccc::getModel('Cart_Item');
			$items = $this->getRequest()->getPost('items');
			foreach ($items as $key => $value) 
			{
				if($key == 'quantity')
				{
					foreach ($value as $itemId => $value2) 
					{
						$cartItemModel->quantity = $value2;
						$cartItemModel->itemId = $itemId;
						$result = $cartItemModel->save();	
						if(!$result)
		 				{
		 					throw new Exception("System is unable to insert.", 1);	
		 				}
						$this->getMessage()->addMessage('Added Successfully.');
					}
				}
				else
				{
					$result = $cartItemModel->delete($value);
					if(!$result)
		 			{
		 				throw new Exception("System is unable to delete.", 1);	
		 			}
					$this->getMessage()->addMessage('Item Deleted.');

				}
			}
			$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));
		}
		catch (Exception $e) 
		{
		 	$this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
		 	$this->redirect($this->getLayout()->getUrl('grid'));
		}	
	}
}
