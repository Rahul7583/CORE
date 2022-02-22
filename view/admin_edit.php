<?php 
$result=$this->getData('adminEdit');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Edit Page</title>
</head>
<body>

	<form method="POST" action="index.php?a=save&c=admin">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>admin Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]" value="<?php echo $result['firstName'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">LastName</td>
				<td><input type="text" name="admin[lastName]" value="<?php echo $result['lastName'] ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="email" name="admin[email]" value="<?php echo $result['email'] ?>"></td>
				<input type="hidden" name="admin[hiddenId]" value="<?php echo $result['adminId'] ?>">
			</tr>

			<tr>
				<td width="10%">Password</td>
				<td><input type="passowrd" name="admin[password]" value="<?php echo $result['password'] ?>"></td>
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="admin[status]" value="<?php echo $result['status'] ?>" >
						<?php if ($row['status']==1):?>
						<option value="1" selected>Active</option>
						<option value="2">Inactive</option>
					<?php else:?>
						<option value="1">Active</option>
						<option value="2" selected>Inactive</option>
					<?php endif; ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button">Cancel</button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>