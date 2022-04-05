<?php $result = $this->getProduct(); ?>  
<?php $categoryResult = $this->getCategory(); ?>
<?php $row = $this->getCategoryProduct(); ?>

<table class="table table-bordered table-striped">			
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
				<td>
					<input type="submit" class="btn btn-info" name="Save">
					<button type="button" class="btn btn-default" ><a href="<?php echo $this->getUrl('grid', 'product') ?>">Cancel</button> 
				</td>
			</tr>
		</table>
