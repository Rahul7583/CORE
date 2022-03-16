<?php $vendors = $this->getVendorData(); ?>
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
     		<a href="<?php echo $this->getUrl('grid','vendor',['page' => $this->getPager()->getNext()])?>"> Next </a>
     	</button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','vendor',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','vendor',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','vendor',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','vendor',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>
<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','vendor')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Vendor_Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Address</th>
			<th>Postal Code</th>
			<th>City</th>
			<th>State</th>
			<th>Country</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

		<?php if(!$vendors):?>
		<tr>
			<td colspan="17">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($vendors as $vendor): ?>
				<tr>
					<td><?php echo $vendor->vendorId;  ?></td>
					<td><?php echo $vendor->firstName;  ?></td>
					<td><?php echo $vendor->lastName;  ?></td>
					<td><?php echo $vendor->email;  ?></td>
					<td><?php echo $vendor->mobile;  ?></td>
					<td><?php echo $vendor->getStatus($vendor->status);  ?></td>
					<?php  $address = $vendor->getAddress();?>
					<td><?php echo $address->address; ?></td>
					<td><?php echo $address->postalCode; ?></td>
					<td><?php echo $address->city;  ?></td>
					<td><?php echo $address->state;  ?></td>
					<td><?php echo $address->country;  ?></td>
					<td><?php echo $vendor->createdDate;  ?></td>
					<td><?php echo $vendor->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','vendor',['id' => $vendor->vendorId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','vendor',['id' => $vendor->vendorId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>