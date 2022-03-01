<?php $customers = $this->getCustomerData(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Grid</title>
</head>
<body>
	<br><br>
	<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','customer')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Customer_Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Address</th>
			<th>Postal Code</th>
			<th>City</th>
			<th>State</th>
			<th>Country</th>
			<th>Billing</th>
			<th>Shipping</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

			<?php if(!$customers):?>
		<tr>
			<td colspan="17">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($customers as $customer): ?>
				<tr>
					<td><?php echo $customer->customerId;  ?></td>
					<td><?php echo $customer->firstName;  ?></td>
					<td><?php echo $customer->lastName;  ?></td>
					<td><?php echo $customer->email;  ?></td>
					<td><?php echo $customer->mobile;  ?></td>
					<td><?php echo $customer->status;  ?></td>
					<td><?php echo $customer->address; ?></td>
					<td><?php echo $customer->postalCode; ?></td>
					<td><?php echo $customer->city;  ?></td>
					<td><?php echo $customer->state;  ?></td>
					<td><?php echo $customer->country;  ?></td>
					<td><?php echo $customer->billing; ?></td>
					<td><?php echo $customer->shipping; ?></td>
					<td><?php echo $customer->createdDate;  ?></td>
					<td><?php echo $customer->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','customer',['id' => $customer->customerId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','customer',['id' => $customer->customerId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
</body>
</html>