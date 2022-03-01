<?php $vendors = $this->getVendorData(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Vendor Grid</title>
</head>
<body>
	<br><br>
	<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','vendor')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Vendor_Id</th>
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
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

			<?php if(!$vendors):?>
		<tr>
			<td colspan="17">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($vendors as $vendor): ?>
				<tr>
					<td><?php echo $vendor->vendorId;  ?></td>
					<td><?php echo $vendor->firstName;  ?></td>
					<td><?php echo $vendor->lastName;  ?></td>
					<td><?php echo $vendor->email;  ?></td>
					<td><?php echo $vendor->mobile;  ?></td>
					<td><?php echo $vendor->status;  ?></td>
					<td><?php echo $vendor->address; ?></td>
					<td><?php echo $vendor->postalCode; ?></td>
					<td><?php echo $vendor->city;  ?></td>
					<td><?php echo $vendor->state;  ?></td>
					<td><?php echo $vendor->country;  ?></td>
					<td><?php echo $vendor->createdDate;  ?></td>
					<td><?php echo $vendor->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','vendor',['id' => $vendor->vendorId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','vendor',['id' => $vendor->vendorId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
</body>
</html>