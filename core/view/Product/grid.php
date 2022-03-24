<?php $products = $this->getProductData(); ?>
<table>
	<tr>
		<script type="text/javascript"> 
    	function ppr() 
      	{
	        const value = document.getElementById('ppr').selectedOptions[0].value;
	        var url = window.location.href;

	        if(!url.includes('ppr'))
	        {
	            url+='&ppr=20';
	        }
	        const myArray = url.split("&");
	        for (i = 0; i < myArray.length; i++)
	        {
	          if(myArray[i].includes('p='))
	          {
	              myArray[i]='p=1';
	          }
	          if(myArray[i].includes('ppr='))
	          {
	              myArray[i]='ppr='+value;
	          }
	        }
	         const str = myArray.join("&");  
	         location.replace(str);
      	}
    </script>
    <select onchange="ppr()" id="ppr">
      <option selected>select</option>
      <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
      <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></a></option>
      <?php endforeach;?>
    </select>
		<button type="button" name="Next">
     		<a href="<?php echo $this->getUrl('grid','product',['page' => $this->getPager()->getNext()])?>"> Next </a>
     	</button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','product',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','product',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','product',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','product',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>

<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','product')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Product_Id</th>
			<th>Name</th>
			<th>Sku</th>
			<th>Map</th>
			<th>Msp</th>
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
			<td colspan="17">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($products as $product): ?>
				<tr>
					<td><?php echo $product->productId; ?></td>
					<td><?php echo $product->name; ?></td>
					<td><?php echo $product->sku; ?></td>
					<td><?php echo $product->map; ?></td>
					<td><?php echo $product->msp; ?></td>
					<td><?php echo $product->cost_price; ?></td>
					<td>
						<?php if(!$product->getBase()->getImageUrl()): echo "Image Not Available"; ?>
								<?php else:?>
						<img src="<?php echo $product->getBase()->getImageUrl(); ?>" width="80px" height="80px"> 
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$product->getThumbnail()->getImageUrl()): echo "Image Not Available"; ?>
								<?php else:?>
						<img src="<?php echo $product->getThumbnail()->getImageUrl(); ?>" width="80px" height="80px"> 
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$product->getSmall()->getImageUrl()): echo "Image Not Available"; ?>
								<?php else:?>
						<img src="<?php echo $product->getSmall()->getImageUrl(); ?>" width="80px" height="80px"> 
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
