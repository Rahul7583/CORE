<?php $result = $this->getCustomerData('customerEdit'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Edit Page</title>
</head>
<body>
	<form method="post" action="<?php echo $this->getUrl('save','customer')?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Personal Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]" value="<?php echo $result->firstName ?>"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]" value="<?php echo $result->lastName ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="customer[email]" value="<?php echo $result->email ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Mobile</td>
				<td><input type="text" name="customer[mobile]" value="<?php echo $result->mobile ?>"></td>
				<input type="hidden" name="customer[customerId]" value="<?php echo $result->customerId  ?>">
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="customer[status]">
					<?php foreach ($result->getStatus() as $key => $value): ?>
					<option value="<?php echo $key ?>" <?php if($result->status == $key){?> selected <?php }?>
					><?php echo $value; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><b>Address Information</b></td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="address[address]" value="<?php echo $result->address ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="address[postalCode]" value="<?php echo $result->postalCode ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" name="address[city]" value="<?php echo $result->city ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="address[state]" value="<?php echo $result->state ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="address[country]" value="<?php echo $result->country ?>"></td>
			</tr>
			
			<tr>
				<td>Address Type</td>
				<td>
					<?php if ($result->billing==1):?>
						<input type="checkbox" name="address[billing]" value="1" checked>
					<?php else:?>
						<input type="checkbox" name="address[billing]" value="1" >
					<?php endif; ?>
					<label>Billing</label>

					<?php if ($result->shipping==1):?>
						<input type="checkbox" name="address[shipping]" value="1" checked>
					<?php else:?>
						<input type="checkbox" name="address[shipping]" value="1" >
					<?php endif; ?>
					<label>Shipping</label>
				</td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'customer') ?>">Cancel</button> 
				</td>
			</tr>
		</table>
	</form>
</body>
</html>