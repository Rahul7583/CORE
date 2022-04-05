<?php $product = $this->getProduct();  ?>
<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="product[name]" id="name" value="<?php echo $product->name ?>" placeholder="Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="sku" class="col-sm-2 col-form-label">Sku</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="product[sku]" id="sku" value="<?php echo $product->sku ?>" placeholder="Sku">
        </div>
      </div>
      <div class="form-group row">
        <label for="map" class="col-sm-2 col-form-label">Map</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="product[map]" id="map" value="<?php echo $product->map ?>" placeholder="Map">
        </div>
      </div>
      <div class="form-group row">
        <label for="msp" class="col-sm-2 col-form-label">Msp</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="product[msp]" id="msp" value="<?php echo $product->msp ?>" placeholder="Msp">
        </div>
      </div>
       <div class="form-group row">
        <label for="cost_price" class="col-sm-2 col-form-label">Cost Price</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="product[cost_price]" id="cost_price" value="<?php echo $product->cost_price ?>" placeholder="Cost Price">
        </div>
      </div>
      <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="product[price]" id="price" value="<?php echo $product->price ?>" placeholder="Price">
        </div>
      </div>
      <div class="form-group row">
        <label for="discount" class="col-sm-2 col-form-label">Discount</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="product[discount]" id="discount" value="<?php echo $product->discount ?>" placeholder="Discount">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="product[status]" id="pageSelect">
            	<?php foreach ($product->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($product->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
			</select>
		</div>
      </div>	
		<div class="card-footer">
			<input type="submit" class="btn btn-info" name="Save">
			<button type="button" class="btn btn-default" ><a href="<?php echo $this->getUrl('grid', 'product') ?>">Cancel</a></button>
		</div>
	</div>	
</div>			

