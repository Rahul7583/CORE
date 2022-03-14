<?php $salesmans = $this->getSalesmanData(); ?>
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
     		<a href="<?php echo $this->getUrl('grid','salesman',['page' => $this->getPager()->getNext()])?>"> Next </a>
     	</button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','salesman',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','salesman',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','salesman',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','salesman',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>
<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','salesman')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Salesman_Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Discount</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Manage Customer</th>
		</tr>
			<?php if(!$salesmans):?>
		<tr>
			<td colspan="10">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($salesmans as $salesman): ?>
				<tr>
					<td><?php echo $salesman->salesmanId;  ?></td>
					<td><?php echo $salesman->firstName;  ?></td>
					<td><?php echo $salesman->lastName;  ?></td>
					<td><?php echo $salesman->email;  ?></td>
					<td><?php echo $salesman->mobile;  ?></td>
					<td><?php echo $salesman->discount;  ?></td>
					<td><?php echo $salesman->getStatus($salesman->status); ?></td>
					<td><?php echo $salesman->createdDate;  ?></td>
					<td><?php echo $salesman->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','salesman',['id' => $salesman->salesmanId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','salesman',['id' => $salesman->salesmanId])?>">Delete</a></td>
					<td><a href="<?php echo $this->getUrl('grid','salesman_customer',['id' => $salesman->salesmanId])?>">Customer List</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
