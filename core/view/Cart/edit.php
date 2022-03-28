<?php	$customerId = Ccc::getFront()->getRequest()->getRequest('id');
 $products = $this->getProduct(); 
	 $customers = $this->getCustomers();
	 $cartItems = $this->getCatItems();
	 $shippings = $this->getShipping();
	 $payments = $this->getPayment();
	 $cartShippingMethod = $this->getCartShippingMethod();
	 $shippingMethod = $this->getShippingMethod();
	 
	$cartId = $this->getCart()->getCart();
	$cartId = $this->getCart()->getCart()['cartId'];
	$cartModel = $this->getCart();
	$cartModel->cartId = $cartId;
 	$billingAddress = $cartModel->getBillingAddresses();
 	$shippingAddress = $cartModel->getShippingAddresses();

?> 
<script type="text/javascript">
	
	function selectCustomer() 
	{
		var customerId = document.getElementById('dropdown').value;
		console.log(customerId);
		var url = new URL(window.location.href);
		var search_parameter = url.searchParams;
		search_parameter.set('id', customerId);
		search_parameter.set('a', 'getCart');
		url.search = search_parameter.toString();
		var newUrl = url.toString();
		window.location = newUrl; 
	}

	function saveShipping() {
		if(document.getElementById('shipping').checked) {
           document.getElementById('shippingAddress').style.display = "none";
		}
		else{
           document.getElementById('shippingAddress').style.display = "block";
		}	
	}

</script>
<form method="post" action="<?php echo $this->getUrl('saveBillingAddress','cart')?>">
		<table border="1" width="100%" cellspacing="4">		
			
			<select name="customer[customerId]" onchange="selectCustomer()" id="dropdown">
				<option>Select Customers</option>
				<?php foreach ($customers as $customer): ?>
				<option value="<?php echo $customer->customerId; ?>" <?php if($customer->customerId == $customerId):?> selected <?php endif;?>><?php echo $customer->customerId.'=>'.$customer->firstName; ?></option>
				<?php endforeach; ?>		
			</select>
			
			<tr>
				<td colspan="2"><b>Billing Address</b></td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="billingAddress[address]" value="<?php echo $billingAddress->address ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>"></td>
			</tr>

			<tr>
				<td width="10%"><input type="checkbox" name="billingAddress[addressBook]" value="addressBook"></td>
				<td><p>Save To Address Book</p></td>
			</tr>

			<tr>
				<td width="10%">
					<input type="checkbox" name="billingAddress[shipping]" id="shipping" onchange="saveShipping()" value="shipping"></td>
				<td><p>Mark as Shipping</p></td>
			</tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save" value="Save">
				</td>
			</tr>
</form>
			<tr>
				<td id="shippingAddress">
					<form method="post" action="<?php echo $this->getUrl('saveShippingAddress','cart', [])?>">
					<table border="1" width="100%" cellspacing="4">

					<tr>
						<td colspan="2"><b>Shipping Address</b></td>
					</tr>

					<tr>
						<td width="10%">Address</td>
						<td><input type="text" name="shippingAddress[address]" value="<?php echo $shippingAddress->address ?>"></td>
					</tr>
					
					<tr>
						<td width="10%">Postal Code</td>
						<td><input type="text" name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode ?>"></td>
					</tr>

					<tr>
						<td width="10%">City</td>
						<td><input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city ?>"></td>
					</tr>
					
					<tr>
						<td width="10%">State</td>
						<td><input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state ?>"></td>
					</tr>

					<tr>
						<td width="10%">Country</td>
						<td><input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>"></td>
					</tr>
					
					<tr>
						<td width="10%"><input type="checkbox" name="shippingAddress[addressBook]" value="addressBook"></td>
						<td><p>Save To Address Book</p></td>
					</tr>
					
					<tr>
						<td width="10%">&nbsp;</td>
						<td><input type="submit" name="Save" value="Save"></td>
					</tr>
				</table>
			</td>
		</tr>
	</form>
			<tr>
				<td>
					<form method="post" action="<?php echo $this->getUrl('savePaymentMethod','cart')?>">
					<table>
						<tr>
							<td colspan="2"><b>Payment Method</b></td>
						</tr>

						<?php foreach ($cartShippingMethod as $cartPaymentId):?>
	 						<?php $cartPaymentId = $cartPaymentId->paymentMethod; ?>
	 					<?php endforeach; ?>
						<?php foreach ($payments as $payment): ?>								
							<tr>
								<td><input type="radio" name="paymentMethod" 
									<?php if($cartPaymentId == $payment->paymentId){echo('checked');} ?>
									value="<?php echo $payment->paymentId?>"></td>
								<td><LABEL><?php echo $payment->name;?></LABEL></td>
							</tr>
							<?php endforeach ?>
						<tr>
							<td width="10%">&nbsp;</td>
							<td><input type="submit" name="Save" value="UPDATE"></td>
						</tr>
					</table>
				</td>
			</tr>
		</form>
				<tr>
					<td>
						<form method="post" action="<?php echo $this->getUrl('saveShippingMethod','cart')?>">
						<table>
							<tr>
								<td colspan="2"><b>Shipping Method</b></td>
							</tr>
							<?php foreach ($cartShippingMethod as $cartShippingId):?>
	 						<?php $cartShippingId = $cartShippingId->shippingMethod; ?>
	 					<?php endforeach; ?>
							<?php foreach ($shippings as $shipping): ?>
							<tr>
								<td>
									<input type="radio" name="shippingMethod"  
									<?php foreach ($shippingMethod as $shippingId): ?>
									<?php if($cartShippingId == $shippingId->shippingId){echo('checked');} ?> <?php endforeach; ?>value="<?php echo $shipping->shippingId?>">
								</td>
								<td><p><?php echo $shipping->name;?></p></td>
								<td><LABEL><?php echo $shipping->amount;?></LABEL></td>
							</tr>
							<?php endforeach ?>

							<tr>
								<td width="10%">&nbsp;</td>
								<td><input type="submit" name="Save" value="UPDATE"></td>
							</tr>
						</table>
					</td>
				</tr>
			</form>
			<tr>
				<td colspan="2"><b>Add Items </b></td>
			</tr>

			<tr id="itemTable">
				<td>
					<form method="post" action="<?php echo $this->getUrl('addItem','cart')?>">
					<table  border="1" width="100%" cellspacing="4" id="table">
						<tr>
							<input type="button" name="Save" value="CANCEL">
							<input type="submit" name="Save" value="ADD ITEM">
						</tr>
						<tr>
							<td>Image</td>
							<td>Name</td>
							<td>Quantity</td>
							<td>Price</td>
							<td>Row Total</td>
							<td>Action</td>
						</tr>
						<?php if(!$products):?>
			        	<tr>
			            	<td colspan="10">No record Available</td>
			        	</tr>   
			    		<?php else:?>
			        
			       	 <?php foreach ($products as $product): ?>
			            <tr>
			                <td><img src="<?php echo $product->getBase()->getImageUrl(); ?>" width="80px" height="80px"></td>
			                <td><?php echo $product->name ?></td>
			                <td><input type="text" name="ite[quantity][]" value="<?php echo $product->quantity ?>"></td>
			                <td><?php echo $product->price ?></td>
			                <td><?php echo ($product->price)*($product->quantity) ?></td>
			                <td><input type="checkbox" name="items[<?php echo $product->productId ?>]" value="<?php echo $product->productId ?>"></td>
			            </tr>
			        <?php endforeach; ?>
			    <?php endif; ?>
					</table>
				</form>
				</td>
			</tr>

			<tr>
				<td>
					<form method="Post" action="<?php echo $this->getUrl('removeCartItem', 'cart')?>">
					<table  border="1" width="100%" cellspacing="4">
						<tr>
							<td><input type="submit" name="Save" value="UPDATE"></td>
							<td><input type="button" name="Save" value="NEW ITEM" onClick='javascript:showTable();'></td>
						</tr>
						<tr>
							<td>Image</td>
							<td>Name</td>
							<td>Quantity</td>
							<td>Price</td>
							<td>Row Total</td>
							<td>Action</td>
						</tr>
						<?php if(!$cartItems):?>
			        	<tr>
			            	<td colspan="10">No record Available</td>
			        	</tr>   
			    		<?php else:?>
			        	<?php $subTotal = 0;?>
			        	<?php $discount = 0;?>
			       	 <?php foreach ($products as $product): ?>
			       	 <?php foreach ($cartItems as $item): ?>
			       	 	<?php if($product->productId == $item->productId):?>
			            <tr>
			                <td><img src="<?php echo $product->getBase()->getImageUrl(); ?>" width="80px" height="80px"></td>
			                <td><?php echo $product->name ?></td>
			                <td><input type="text" name="items[quantity][<?php echo $item->itemId ?>]" value="<?php echo $item->quantity ?>"></td>
			                <td><?php echo $item->price ?></td>
			                <td><?php echo $row = ($item->price)*($item->quantity) ?></td>
			                	<?php $discount = $this->getDiscount($product->productId, $row) + $discount;?>
			                	<?php $tax = $this->getTax($product->productId, $row); ?>
			                <?php $subTotal = $row + $subTotal;?>
			                <td><input type="checkbox" name="items[itemId]" value="<?php echo $item->itemId ?>"></td>
			            </tr>
			    		<?php endif; ?>
			        <?php endforeach; ?>
			        <?php endforeach; ?>
			    <?php endif; ?>

					</table>
				</form>
				<tr>
					<td>
						<form method="Post" action="<?php echo $this->getUrl('save', 'cart')?>"> 
							<table  border="1" width="100%" cellspacing="4">
								<tr>
									<td>Sub Total  </td>
									<td><label><?php echo $subTotal; ?></label></td>
									
								</tr>

								<tr>
									<td>Tax</td>
									<td><label><?php echo $tax; ?></label></td>

								</tr>

								<tr>
									<td>Discount </td>
									<td><label><?php echo $discount;?></label></td>

								</tr>

								<?php foreach ($cartShippingMethod as $method): ?>
									<?php  $shippingCost = $method->deliveryCharge; ?>
								<?php endforeach; ?>

								<tr>
									<td>Shipping Cost</td>
									<td><label><?php echo $shippingCost; ?></label></td>
								</tr>

								<tr>
									<td>Grand Total</td>
									<input type="hidden" name="grandTotal" value="<?php echo $this->getGrandTotal($subTotal,$tax,$discount,$shippingCost); ?>">
									<td><label><?php echo $this->getGrandTotal($subTotal,$tax,$discount,$shippingCost); ?></label></td>
								</tr>

								<tr>
									<td>&nbsp;</td>
									<td><input type="submit" name="Save" value="Place Order"></td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
				</td>
			</tr>
		</table>
		<script>
			document.getElementById('itemTable').style.display = "none";
			function showTable()
			{
				document.getElementById('itemTable').style.display = "block";
			}
		</script>

