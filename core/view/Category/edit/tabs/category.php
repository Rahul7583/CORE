<?php $result = $this->getCategory(); ?>
<?php $path = $this->getPath(); ?>
<?php $categoryId = (isset($_GET['id'])) ? $_GET['id'] : null; ?>
		<table class="table table-bordered table-striped">
			
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
				<td><input type="text" class="form-control" name="category[name]" value="<?php echo $result->name; ?>"></td>
			</tr>

			<tr>
				<td>Status</td>
				<td width="10%">
					<select class="form-control" name="category[status]" id="pageSelect">
            		<?php foreach ($result->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($result->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
			</select>
				</td>
			</tr>

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<button type="button" class="btn btn-info" name="Save" id="categoryFormSaveBtn">Save</button>
					<button type="button" class="btn btn-default" id="categoryFormCancelBtn">Cancel</button> 
				</td>
			</tr>
		</table>
		<script type="text/javascript">
			jQuery('#categoryFormCancelBtn').click(function() {
				admin.setUrl("<?php echo $this->getUrl('gridBlock', 'categories'); ?>");
				alert(admin.getUrl());
				admin.load();
			});

			$('#categoryFormSaveBtn').click(function() {
				admin.setForm(jQuery("#indexForm"));
				admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
				admin.load();
			});
		</script>