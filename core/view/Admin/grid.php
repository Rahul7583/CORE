<?php $admin = $this->getAdminData(); ?>
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
     	<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getNext()])?>"> Next </a>
    </button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','admin',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>

<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','admin');?>"> Add New </a></button>
<button type="button" name="logout"><a href="<?php echo $this->getUrl('logout','admin_login');?>"> Logout </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Admin_Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
			<?php if(!$admin):?>
		<tr>
			<td colspan="10">No record Available</td>
		</tr>	
		<?php else:?>
			<?php foreach ($admin as $row): ?>
				<tr>
					<td><?php echo $row->adminId; ?></td>
					<td><?php echo $row->firstName; ?></td>
					<td><?php echo $row->lastName; ?></td>
					<td><?php echo $row->email; ?></td>
					<td><?php echo $row->password; ?></td>
					<td><?php echo $row->getStatus($row->status); ?></td>
					<td><?php echo $row->createdDate; ?></td>
					<td><?php echo $row->updatedDate; ?></td>
					<td><a href="<?php echo $this->getUrl('edit','admin',['id' => $row->adminId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','admin',['id' => $row->adminId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
