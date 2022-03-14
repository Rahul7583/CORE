<?php $pages = $this->getpageData(); ?>
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
	          if(myArray[i].includes('page='))
	          {
	              myArray[i]='page=1';
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
     	<a href="<?php echo $this->getUrl('grid','page',['page' => $this->getPager()->getNext()])?>"> Next </a>
     </button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','page',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','page',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','page',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','page',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
  </tr>
</table>

<br>
<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','page')?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Page_Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Content</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

			<?php if(!$pages):?>
		<tr>
			<td colspan="9">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($pages as $page): ?>
				<tr>
					<td><?php echo $page->pageId;  ?></td>
					<td><?php echo $page->name;  ?></td>
					<td><?php echo $page->code;  ?></td>
					<td><?php echo $page->content;  ?></td>
					<td><?php echo $page->getStatus($page->status); ?></td>
					<td><?php echo $page->createdDate;  ?></td>
					<td><?php echo $page->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','page',['id' => $page->pageId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','page',['id' => $page->pageId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>
