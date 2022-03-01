<?php $result = $this->getSalesmanData('salesmanEdit'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Salesman Edit Page</title>
</head>
<body>
	<form method="post" action="<?php echo $this->getUrl('save','salesman')?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Salesman Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="salesman[firstName]" value="<?php echo $result->firstName ?>"></td>
			</tr>

			<tr>
				<td width="10%">Last Name</td>
				<td><input type="text" name="salesman[lastName]" value="<?php echo $result->lastName ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="text" name="salesman[email]" value="<?php echo $result->email ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Mobile</td>
				<td><input type="text" name="salesman[mobile]" value="<?php echo $result->mobile ?>"></td>
				<input type="hidden" name="salesman[salesmanId]" value="<?php echo $result->salesmanId  ?>">
			</tr>
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="salesman[status]">
					<?php foreach ($result->getStatus() as $key => $value): ?>
					<option value="<?php echo $key ?>" <?php if($result->status == $key){?> selected <?php }?>
					><?php echo $value; ?></option>
					<?php endforeach; ?>
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