<?php $orders = $this->getOrderData(); ?>

<form method="POST" action="<?php echo $this->getUrl('edit','cart', ['id' => 1])?>">
<div class="card-footer">
	<input type="submit" class="btn btn-success" name="addOrder" value="Add Order">
</div>
</form>

<table class="table table-bordered table-striped">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Grand Total</th>
			<th>ShippingId</th>
			<th>PaymentId</th>
			<th>State</th>
			<th>Status</th>
			<th>View</th>
			<th>Delete</th>
		</tr>
			<?php if(!$orders):?>
		<tr>
			<td colspan="9">No record Available</td>
		</tr>	
		<?php else:?>
			<?php foreach ($orders as $order): ?>
				<tr>
					<td><?php echo $order->firstName; ?></td>
					<td><?php echo $order->lastName; ?></td>
					<td><?php echo $order->grandTotal; ?></td>
					<td><?php echo $order->shippingId; ?></td>
					<td><?php echo $order->paymentId; ?></td>
					<td><?php echo $order->getState($order->state); ?></td>
					<td><?php echo $order->getStatus($order->status); ?></td>
					<td><a class="btn btn-block btn-info" href="<?php echo $this->getUrl('edit','order',['id' => $order->orderId])?>">View</a></td>
					<td><a class="btn btn-block btn-info" href="<?php echo $this->getUrl('delete','order',['id' => $order->orderId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>