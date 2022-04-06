<?php $orders = $this->getOrderData(); ?>

<!-- <form method="POST" action="<?php //echo $this->getUrl('edit','cart', ['id' => 1])?>"> -->
<script type="text/javascript">
	function edit(url)
		{
			admin.setUrl(url);
			alert(admin.getUrl());
	        admin.load();
		}
</script>	
<div class="card-footer"> 
	<button type="button" class="btn btn-success" id="addOrder" >Add Order</button>
</div>

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
					<td><button type="button" class="btn btn-block btn-info" 
						onclick="edit('<?php echo $this->getUrl('edit','order',['id' => $order->orderId])?>')">View</button></td>
					<td><button type="button" class="btn btn-block btn-info" 
						onclick="edit('<?php echo $this->getUrl('delete','order',['id' => $order->orderId])?>')">Delete</button></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
	<script type="text/javascript">
		$("#addOrder").click(function(){
			admin.setType("GET");
			admin.setData({'id' : null});
		    admin.setUrl("<?php echo $this->getUrl('edit'); ?>");
		    admin.load();
		});
    </script>			