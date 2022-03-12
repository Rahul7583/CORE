<?php $result = $this->getProduct();  ?>
<?php $categoryResult = $this->getCategory(); ?>
<?php $row = $this->getCategoryProduct(); ?>

<form method="POST" action="<?php echo $this->getUrl('save','product', ['id' => $result->productId]);?>">
		<table border="1" width="100%" cellspacing="4">			
			<tr>
				<td colspan="2"><b>Product Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="product[name]" value="<?php echo $result->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Sku</td>
				<td><input type="text" name="product[sku]" value="<?php echo $result->sku ?>"></td>
			</tr>

			<tr>
				<td width="10%">Map</td>
				<td><input type="number" name="product[map]" value="<?php echo $result->map ?>"></td>
			</tr>

			<tr>
				<td width="10%">Msp</td>
				<td><input type="number" name="product[msp]" value="<?php echo $result->msp ?>"></td>
			</tr>

			<tr>
				<td width="10%">Cost_Price</td>
				<td><input type="number" name="product[cost_price]" value="<?php echo $result->cost_price ?>"></td>
			</tr>

			<tr>
				<td width="10%">Price</td>
				<td><input type="text" name="product[price]" value="<?php echo $result->price ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Quantity</td>
				<td><input type="text" name="product[quantity]" value="<?php echo $result->quantity ?>"></td>
			</tr>
					
			<tr>
				<td width="10%">Status</td>
				<td>
					<select name="product[status]">
						<?php foreach ($result->getStatus() as $key => $value): ?>
						<option value="<?php echo $key; ?>"<?php if($result->status == $key){?> selected <?php }?>
						><?php echo $value; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Categories</td>
				<td>
					<table border="1" width="50%" cellspacing="4">
			<tr>
				<td width="10%">CategoryId</td>
				<td width="10%">Name</td>
				<td width="10%">Select</td>
			</tr>
			<?php foreach ($categoryResult as $key => $value): ?>
				<tr>
					<td>
						<input type="text" name="category[categoryId]" value="<?php echo $value->categoryId ?>" disabled="true">
					</td>
					<td>
						<input type="text" name="category[name]" value="<?php echo $this->path($value->path); ?>" disabled="true">
					</td>

				<?php if($row): ?> 
          			<?php if ($result->productId) : ?>
            			<td>
            				<input type="checkbox" name="category[categoryId][]" value="<?php echo $value->categoryId ?>"
            				<?php foreach ($row as $key1 => $value1): ?>
            				<?php if ($value->categoryId == $value1->categoryId && $value1->productId == $result->productId) :?> checked <?php else: echo "not"; endif; ?>
            				<?php endforeach; ?>>
            			</td> 
            		<?php else : ?>
              			<td>
              				<input type="checkbox" name="category[categoryId][]" value="<?php echo $value->categoryId ?>"
            				<?php foreach ($row as $key1 => $value1): ?>
              					<?php if ($value->categoryId == $value1->categoryId) :?>
              					<?php else: echo "not"; endif; ?>
            				<?php endforeach; ?>>
            			</td>
          			<?php endif; ?>
        		<?php else: ?>
          				<td>
          					<input type="checkbox" name="category[categoryId][]" value="<?php echo $value->categoryId ?>">
          				</td>
        		<?php endif; ?>	
				</tr>
			<?php endforeach; ?>
				</table>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'product') ?>">Cancel</button> 
				</td>
			</tr>
		</table>
	</form>
