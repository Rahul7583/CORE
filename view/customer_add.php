<?php    ?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Add Page</title>
</head>
<body>

	<form action="index.php?a=save&c=customer" method="POST">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Personal Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="customer[firstName]"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="customer[lastName]"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="customer[email]"></td>
			</tr>
			
			<tr>
				<td width="10%">Mobile</td>
				<td><input type="text" name="customer[mobile]"></td>
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="customer[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><b>Address Information</b></td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><textarea rows="1" cols="50" name="address[address]"></textarea></td>
			</tr>

			<tr>
				<td>Postal Code</td>
				<td><input type="number" name="address[postalCode]"></td>
			</tr>

			<tr>
				<td>City</td>
				<td><input type="text" name="address[city]"></td>
			</tr>

			<tr>
				<td>State</td>
				<td><input type="text" name="address[state]"></td>
			</tr>

			<tr>
				<td>Country</td>
				<td><input type="text" name="address[country]"></td>
			</tr>

			<tr>
				<td>Address Type</td>
				<td><input type="checkbox" name="address[billing]" value="1">Billing
					<input type="checkbox" name="address[shipping]" value="1">Shipping
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="submit">
					<button type="button">Cancel</button> 
				</td>
			</tr>
		</table>
	</form>
</body>
</html>