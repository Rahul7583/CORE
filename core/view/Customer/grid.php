<?php $customers = $this->getCustomerData(); ?>
<table>
	<tr>
		<script type="text/javascript"> 
    	function displayPageRecord() 
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
    <select onchange="displayPageRecord()" id="ppr">
      <option selected>select</option>
      <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
      <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></a></option>
      <?php endforeach;?>
    </select>
		<button type="button" name="Next">
     		<a href="<?php echo $this->getUrl('grid','customer',['page' => $this->getPager()->getNext()])?>"> Next </a>
     	</button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','customer',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','customer',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','customer',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','customer',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>


<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','customer')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Customer_Id</th>
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

			<?php if(!$customers):?>
		<tr>
			<td colspan="17">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($customers as $customer): ?>
				<tr>
					<td><?php echo $customer->customerId;  ?></td>
					<td><?php echo $customer->firstName;  ?></td>
					<td><?php echo $customer->lastName;  ?></td>
					<td><?php echo $customer->email;  ?></td>
					<td><?php echo $customer->mobile;  ?></td>
					<td><?php echo $customer->getStatus($customer->status);?></td>
					<?php $billingAddress= $customer->getBillingAddresses(); ?>
					<td><?php echo $billingAddress->address; ?></td>
					<td><?php echo $billingAddress->postalCode; ?></td>
					<td><?php echo $billingAddress->city;  ?></td>
					<td><?php echo $billingAddress->state;  ?></td>
					<td><?php echo $billingAddress->country;  ?></td>
					<?php $shippingAddress= $customer->getShippingAddresses() ?>
					<td><?php echo $shippingAddress->address; ?></td>
					<td><?php echo $shippingAddress->postalCode; ?></td>
					<td><?php echo $shippingAddress->city;  ?></td>
					<td><?php echo $shippingAddress->state;  ?></td>
					<td><?php echo $shippingAddress->country;  ?></td>
					<td><?php echo $customer->createdDate;  ?></td>
					<td><?php echo $customer->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','customer',['id' => $customer->customerId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','customer',['id' => $customer->customerId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
