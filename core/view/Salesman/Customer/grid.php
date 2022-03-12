<?php $customers = $this->getCustomers(); ?>
<table border='1' width='100%' cellspacing="4">
<form action="<?php echo $this->getUrl('save','Salesman_Customer',['id'=> $this->getSalesmanId()],true) ?>" method="post">
<input type="submit" value="save">
	<tr>
		<td> Customer List</td>
		<td> CustomerID</td>
		<td> First Name</td>
		<td> Last Name</td>
		<td> Price List</td>
	</tr>
<?php if (!$customers): ?>
	<tr><td colspan="16"> No Record Available.</td></tr>
<?php else: ?>
	<?php foreach ($customers as $customer) : ?>
	<tr>
		<td><input type="checkbox" name="customer[]" value='<?php echo $customer->customerId; ?>' <?php echo $this->selected($customer->customerId); ?> ></td>
		<td><?php echo $customer->customerId; ?></td> 
		<td><?php echo $customer->firstName; ?></td> 
		<td><?php echo $customer->lastName; ?></td> 
		<td> 
		<a href="<?php echo $this->getUrl('grid','Customer_Price',['id' => $customer->customerId, 'salesmanId' => $this->getSalesmanId()]) ?>"> Price List </a> </td>
	</tr>
	<?php endforeach; ?>
<?php endif; ?>
</table>