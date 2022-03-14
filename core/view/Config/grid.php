<?php $configs = $this->getConfigData(); ?>
<table>
	<tr>
		<script type="text/javascript"> 
    	function ppr() 
      	{
	        const value = document.getElementById('ppr').selectedOptions[0].value;
	        var language = window.location.href;

	        if(!language.includes('ppr'))
	        {
	            language+='&ppr=20';
	        }
	        const myArray = language.split("&");
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
     		<a href="<?php echo $this->getUrl('grid','config',['page' => $this->getPager()->getNext()])?>"> Next </a>
     	</button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','config',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','config',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','config',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','config',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>
	
<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','config')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Config_Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Value</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
			<?php if(!$configs):?>
		<tr>
			<td colspan="9">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($configs as $config): ?>
				<tr>
					<td><?php echo $config->configId; ?></td>
					<td><?php echo $config->name; ?></td>
					<td><?php echo $config->code; ?></td>
					<td><?php echo $config->value; ?></td>
					<td><?php echo $config->getStatus($config->status); ?></td>
					<td><?php echo $config->createdDate; ?></td>
					<td><?php echo $config->updatedDate; ?></td>
					<td><a href="<?php echo $this->getUrl('edit','config',['id' => $config->configId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','config',['id' => $config->configId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>			
	</table>
