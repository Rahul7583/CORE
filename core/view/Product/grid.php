<?php $products = $this->getProductData(); ?>
<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','product')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Product_Id</th>
			<th>Name</th>
			<th>Sku</th>
			<th>Map</th>
			<th>Cost_Price</th>
			<th>Base</th>
			<th>Thumbnail</th>
			<th>Small</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Gallery</th>
		</tr>
			<?php if(!$products):?>
		<tr>
			<td colspan="16">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product->productId; ?></td>
					<td><?php echo $product->name; ?></td>
					<td><?php echo $product->sku; ?></td>
					<td><?php echo $product->map; ?></td>
					<td><?php echo $product->cost_price; ?></td>
					<td>
						<?php if(!$product->base): echo "Image Not Available"; ?>
								<?php else:?>
						<img src="<?php echo 'Media/Product/'. $product->base; ?>" width="80px" height="80px"> 
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$product->thumbnail): echo "Image Not Available"; ?>
								<?php else:?>
						<img src="<?php echo 'Media/Product/'. $product->thumbnail; ?>" width="80px" height="80px"> 
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$product->small): echo "Image Not Available"; ?>
								<?php else:?>
						<img src="<?php echo 'Media/Product/'. $product->small; ?>" width="80px" height="80px"> 
						<?php endif; ?>
					</td>
					<td><?php echo $product->price; ?></td>
					<td><?php echo $product->quantity; ?></td>
					<td><?php echo $product->getStatus($product->status); ?></td>
					<td><?php echo $product->createdDate; ?></td>
					<td><?php echo $product->updatedDate; ?></td>
					<td><a href="<?php echo $this->getUrl('edit','product',['id' => $product->productId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','product',['id' => $product->productId])?>">Delete</a></td>
					<td><a href="<?php echo $this->getUrl('grid','product_media',['id' => $product->productId])?>">Gallery</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>			
	</table>
