<?php $admin = $this->getAdmin();
print_r($admin->getStatus());
 ?>

<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="admin[firstName]" id="firstName" value="<?php echo $admin->firstName ?>" placeholder="First Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="admin[lastName]" id="lastName" value="<?php echo $admin->lastName ?>" placeholder="Last Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control"  name="admin[email]" id="email" value="<?php echo $admin->email ?>" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control"  name="admin[password]" id="password" value="" placeholder="Password">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="admin[status]" id="pageSelect">
            	<?php foreach ($admin->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($admin->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
			</select>
		</div>
      </div>	
		<div class="card-footer">
			<button type="button" class="btn btn-info" id="adminFormSaveBtn">Save</button> 
			<button type="button" class="btn btn-default" id="adminFormCancelBtn">Cancel</button>
		</div>
</div>
</div>	 
		<script type="text/javascript">
			jQuery('#adminFormCancelBtn').click(function() {
				admin.setUrl("<?php echo $this->getUrl('gridBlock', 'admin'); ?>");
				admin.load();
			});

			$('#adminFormSaveBtn').click(function() {
				admin.setForm(jQuery("#indexForm"));
				admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
				admin.load();
			});
		</script>
