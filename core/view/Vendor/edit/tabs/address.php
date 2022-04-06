<?php $vendor = $this->getVendor(); ?>
<?php $vendorAddress = $vendor->getAddress(); ?>

<!-- <form method="post" action="<?php //echo $this->getUrl('save','vendor', ['id' => $result->vendorId])?>"> -->

	<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="vendor_address[address]" id="address" value="<?php echo $vendorAddress->address ?>" placeholder="Address">
        </div>
      </div>
      <div class="form-group row">
        <label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="vendor_address[postalCode]" id="postalCode" value="<?php echo $vendorAddress->postalCode ?>" placeholder="PostalCode">
        </div>
      </div>
      <div class="form-group row">
        <label for="city" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="vendor_address[city]" id="city" value="<?php echo $vendorAddress->city ?>" placeholder="City">
        </div>
      </div>
      <div class="form-group row">
        <label for="state" class="col-sm-2 col-form-label">State</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="vendor_address[state]" id="state" value="<?php echo $vendorAddress->state ?>" placeholder="State">
        </div>
      </div>
      <div class="form-group row">
        <label for="country" class="col-sm-2 col-form-label">Country</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="vendor_address[country]" id="country" value="<?php echo $vendorAddress->country ?>" placeholder="Country">
        </div>
      </div>
		<div class="card-footer">
			<button type="button" class="btn btn-info" id="vendorAddressSaveBtn" name="Save">Save</button>
			<button type="button" class="btn btn-default" id="vendorAddressCancelBtn">Cancel</button>
		</div>
	</div>
</div>	
<script type="text/javascript">
			jQuery('#vendorAddressCancelBtn').click(function() {
				admin.setUrl("<?php echo $this->getUrl('gridBlock', 'vendor'); ?>");
				admin.load();
			});

			$('#vendorAddressSaveBtn').click(function() {

				admin.setForm(jQuery("#indexForm"));
				admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
				//alert(admin.getUrl());
				admin.load();
			});
</script>		 			
</form>
