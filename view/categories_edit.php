

<?php 

$id=$_GET['id'];

global $adapter;

$result=$adapter->fetchAll("select * from categories where categoryId='$id'");


?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories Edit Page</title>
</head>
<body>

	<?php foreach ($result as $row): ?>

	<form method="post" action="index.php?a=save&c=categories">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Categories Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $row['name'] ?>"></td>
				<input type="hidden" name="category[hiddenId]" value="<?php echo $row['categoryId'] ?>">
			
			</tr>

			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="category[status]" value="<?php echo $row['status'] ?>" >
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
			<?php endforeach; ?>
		

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