<?php    ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Add Page</title>
</head>
<body>

	<form action="index.php?a=save&c=admin" method="POST">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Admin Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]"></td>
			</tr>

			<tr>
				<td width="10%">LastName</td>
				<td><input type="text" name="admin[lastName]"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="email" name="admin[email]"></td>
			</tr>

			<tr>
				<td width="10%">Password</td>
				<td><input type="password" name="admin[password]"></td>
			</tr>

			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="admin[status]">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
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