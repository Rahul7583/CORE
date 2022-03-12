<?php $result = $this->getCategory(); ?>
<?php $path = $this->getPath(); ?>
<?php $categoryId = (isset($_GET['id'])) ? $_GET['id'] : null; ?>

<form method="post" action="<?php echo $this->getUrl('save','categories', ['id' => $result->categoryId])?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Categories Information</b></td>
			</tr>
			<tr>
      			<td width="10%">Select Parent Category</td>
      			<td>
      				<select name="category[parentId]" class="form-control">
      					<option value="0">New Category</option>
              <?php foreach ($path as $value): ?>
              <option value="<?php echo $value->categoryId; ?>" <?php if($value->categoryId == $categoryId):?> selected <?php endif; ?>><?php echo $value->path;?></option>
            <?php endforeach; ?> 
            </select>
      			</td>
    		</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $result->name; ?>"></td>
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