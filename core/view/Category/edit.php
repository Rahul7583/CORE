<?php $result = $this->getCategory(); ?>
<?php $categoryPath = $this->getSubPath($result->categoryId);?>
<?php $categories = $this->getCategoriesEdit();?> 
	<form method="post" action="<?php echo $this->getUrl('save','categories')?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Categories Information</b></td>
			</tr>
			<tr>
      			<td width="10%">Select Parent Category</td>
      			<td>
      				<select name="category[parentId]" class="form-control">
            		<?php if ($result->categoryId) : ?>
              		<option value="<?php echo null; ?>" <?php echo ($result->parentId == NULL) ? 'selected' : ''; ?>>Parent Category</option>
              <?php foreach ($categoryPath as $key => $value) {?>
              <option value="<?php echo $value->path; ?>" <?php echo ($value->categoryId ==$result->parentId) ? "selected" : ''; ?>><?php echo $this->path($value->path);?></option>
            <?php } ?> 
            <?php else : ?>

              <option value="0">Parent Category</option>
              <?php foreach ($categories as $key => $value) {?>
                <option><?php echo $this->path($value->path); ?> </option> <?php
              } ?>
            <?php endif; ?>
            </select>
      			</td>
    		</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $result->name; ?>"></td>
				<input type="hidden" name="category[hiddenId]" value="<?php echo $result->categoryId; ?>">
			</tr>

			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="category[status]">
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