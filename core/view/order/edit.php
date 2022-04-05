<?php $customerInfo = $this->getOrder(); ?>
<?php $billingAddress = $this->getOrder()->getBillingAddresses(); ?>
<?php $shippingAddress = $this->getOrder()->getBillingAddresses(); ?>
<?php $shippingMethod = $this->getOrder()->getShippingMethod(); ?>
<?php $paymentMethod = $this->getOrder()->getPaymentMethod(); ?>
<?php $orderItem = $this->getOrder()->getItems(); ?>


<table class="table table-bordered table-striped">
			<tr>
				<td colspan="2"><b>Customer Information</b><br>
					<label><?php echo $customerInfo->firstName ?></b></label>
					<label><?php echo $customerInfo->lastName ?></b><br></label>
					<label><?php echo $customerInfo->email ?></b><br></label>
					<label><?php echo $customerInfo->mobile ?></b></label>
				</td>
			</tr>
		</table>

<table class="table table-bordered table-striped">
			<tr>
				<td colspan="2"><b>Billing Address</b><br>
					<label><?php echo $billingAddress->address ?><br></label>
					<label><?php echo $billingAddress->city ?><br></label>
					<label><?php echo $billingAddress->state ?><br></label>
					<label><?php echo $billingAddress->postalCode ?></label>
				</td>
			</tr>
		</table>
		
		<table class="table table-bordered table-striped">
			<tr>
				<td colspan="2"><b>Shipping Address</b><br>
					<label><?php echo $shippingAddress->address ?><br></label>
					<label><?php echo $shippingAddress->city ?><br></label>
					<label><?php echo $shippingAddress->state ?><br></label>
					<label><?php echo $shippingAddress->postalCode ?></label>
				</td>		
			</tr>
		</table>

		<table class="table table-bordered table-striped">
			<tr>
				<td colspan="2"><b>Payment Method</b><br>
					<label><?php echo $paymentMethod->name ?></label>
				</td>
			</tr>
		</table>
				
		<table class="table table-bordered table-striped">
			<tr>
				<td colspan="2"><b>Shipping Method</b><br>
					<label><?php echo $shippingMethod->name ?></label>
					<label><b><?php echo $shippingMethod->amount ?></b></label>
				</td>
			</tr>
		</table>

		<table class="table table-bordered table-striped">
			<tr>
				<td colspan="2"><b>Product Details</b><br>

					<?php foreach ($orderItem as $item):?>
            	
               		<label><b>Name:</b><?php echo $item->name ?><br></label>
               		<label><b>Quantity:</b><?php echo $item->quantity ?><br></label>
					<label><b>Price:</b><?php echo $item->price  ?><br></label>
					<label><b>Row Total:</b><?php echo $rowTotal = ($item->price)*($item->quantity); ?><br><br></label>
            
    	<?php endforeach;?>
					
				</td>		
			</tr>
		</table>
			
		<table   class="table table-bordered table-striped">
			<tr>
				<td colspan="2"><b>Order Summery</b></td>
			</tr>

			<tr>
				<td>Sub Total: <?php echo $this->getSubTotal(); ?></td>
			</tr>

			<tr>
				<td>Tax: <?php echo $this->getTax(); ?></td>
			</tr>

			<tr>
				<td>Discount:<?php echo $this->getDiscount(); ?> </td>
			</tr>

			<tr>
				<td>Shipping Cost: <?php echo $customerInfo->shippingAmount; ?></td>
			</tr>

			<tr>
				<td>Grand Total:<?php echo $customerInfo->grandTotal; ?></td>
			</tr>
		</table>
		

