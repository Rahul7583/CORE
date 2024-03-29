<?php $customer = $this->getCustomer(); ?>
<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="customer[firstName]" id="firstName" value="<?php echo $customer->firstName ?>" placeholder="First Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="customer[lastName]" id="lastName" value="<?php echo $customer->lastName ?>" placeholder="Last Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control"  name="customer[email]" id="email" value="<?php echo $customer->email ?>" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="customer[mobile]" id="mobile"  value="<?php echo $customer->mobile ?>" placeholder="Mobile">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="customer[status]" id="pageSelect">
            	<?php foreach ($customer->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($customer->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
			</select>
		</div>
      </div>	
		<div class="card-footer">
			<button type="button" class="btn btn-info" id="customerSaveBtn">Save</button>
			<button type="button" class="btn btn-default" id="customerCancelBtn">Cancel</button>
		</div>
	</div>
</div>
<script type="text/javascript">
      jQuery('#customerCancelBtn').click(function() {
        admin.setUrl("<?php echo $this->getUrl('gridBlock', 'customer'); ?>");
        admin.load();
      });

      $('#customerSaveBtn').click(function() {
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        alert(admin.getUrl());
        admin.load();
      });
</script>			

		