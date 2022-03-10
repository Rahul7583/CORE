<?php $salesmans = $this->getSalesmanData(); ?>
<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','salesman')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Salesman_Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Discount</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Manage Customer</th>
		</tr>
			<?php if(!$salesmans):?>
		<tr>
			<td colspan="10">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($salesmans as $salesman): ?>
				<tr>
					<td><?php echo $salesman->salesmanId;  ?></td>
					<td><?php echo $salesman->firstName;  ?></td>
					<td><?php echo $salesman->lastName;  ?></td>
					<td><?php echo $salesman->email;  ?></td>
					<td><?php echo $salesman->mobile;  ?></td>
					<td><?php echo $salesman->discount;  ?></td>
					<td><?php echo $salesman->getStatus($salesman->status); ?></td>
					<td><?php echo $salesman->createdDate;  ?></td>
					<td><?php echo $salesman->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','salesman',['id' => $salesman->salesmanId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','salesman',['id' => $salesman->salesmanId])?>">Delete</a></td>
					<td><a href="<?php echo $this->getUrl('grid','salesman_customer',['id' => $salesman->salesmanId])?>">Customer List</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
