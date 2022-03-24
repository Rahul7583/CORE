<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php Ccc::loadClass('Model_Customer_Address'); ?>
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
    	$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));
    	

    }

	public function gridAction()			
	{
		$this->setTitle('Cart Grid');
		$cartGrid = Ccc::getBlock('Cart_Grid');
		$content = $this->getLayout()->getContent()->addChild($cartGrid);
		$this->renderLayout();
	}

	public function editAction()			
	{
		$cartModel = Ccc::getModel('Cart');

		$this->setTitle('Cart Edit');

		$cartEdit = Ccc::getBlock('Cart_Edit')->setCart($cartModel);
		$content = $this->getLayout()->getContent()->addChild($cartEdit);
		$this->renderLayout();
	}

	public function saveBillingAddressAction()
	{
		try 
		{
			$cartModel = Ccc::getModel('Cart');
			$customerId = $this->getRequest()->getRequest('id');
			$billingAddress = $this->getRequest()->getPost('billingAddress');
			$cartId = $cartModel->getCart()['cartId'];
					
			$cartRow = $cartModel->load($cartId);
			$cartBilling = $cartRow->getBillingAddresses();
				
				if($billingAddress['addressBook'])
				{
					$customerModel = Ccc::getModel('Customer')->load($customerId);
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
			$this->getMessage()->addMessage('Data Saved.');
			$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));			
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
			$customerId = $this->getRequest()->getRequest('id');
			$shippingAddress = $this->getRequest()->getPost('shippingAddress');
			$cartAddressRow = $cartRow->getShippingAddresses();

			 if($shippingAddress['addressBook'])
				{
					$customerModel = Ccc::getModel('Customer')->load($customerId);
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
			$this->getMessage()->addMessage('Data Saved.');
			$this->redirect($this->getLayout()->getUrl('edit','cart', ['id' =>$customerId]));
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
					}
				}
				else
				{
					$result = $cartItemModel->delete($value);
					if(!$result)
		 			{
		 				throw new Exception("System is unable to delete.", 1);	
		 			}
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
