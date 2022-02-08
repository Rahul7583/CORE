

<?php 

$id = $_GET['id'];

//echo $id;
global $adapter;

$result=$adapter->fetchAll("select * from product where productId='$id'");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Edit Page</title>
</head>
<body>

	<?php foreach ($result as $row): ?>


	<form method="POST" action="index.php?a=save&c=product">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Product Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $row['name'] ?>"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo $row['price'] ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $row['quantity'] ?>"></td>
				<input type="hidden" name="product[hiddenId]" value="<?php echo $row['productId'] ?>">
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="product[status]" value="<?php echo $row['status'] ?>" >
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