<?php date_default_timezone_set("Asia/Kolkata");?>

<?php 
global $adapter;
$products=$adapter->fetchAll('select * from product');


?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Grid</title>
</head>
<body>
	<button type="button" name="addNew"><a href="index.php?a=add&c=product"> Add New </a></button>
	<table border="1" width="100" cellspacing="4">
		<tr>
			<th>Product_Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

			<?php if(!$products):?>
		<tr>
			<td colspan="10">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product['productId']; ?></td>
					<td><?php echo $product['name']; ?></td>
					<td><?php echo $product['price']; ?></td>
					<td><?php echo $product['quantity']; ?></td>
					<td><?php echo $product['status']; ?></td>
					<td><?php echo $product['createdDate']; ?></td>
					<td><?php echo $product['updatedDate']; ?></td>
					<td><a href="index.php?a=edit&c=product&id=<?php echo $product['productId']; ?>">Edit</a></td>
					<td><a href="index.php?a=delete&c=product&id=<?php echo $product['productId']; ?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	

		
	</table>

</body>
</html>