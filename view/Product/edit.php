<?php $result = $this->getData('productEdit');?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Edit Page</title>
</head>
<body>
	<form method="POST" action="<?php echo $this->getUrl('product','save');?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Product Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $result->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo $result->price ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $result->quantity ?>"></td>
				<input type="hidden" name="product[productId]" value="<?php echo $result->productId ?>">
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="product[status]">
						<?php foreach ($result->getStatus() as $key => $value): ?>
						<option value="<?php echo $key; ?>"<?php if($result->status == $key){?> selected <?php }?>
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