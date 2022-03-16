<?php $categories = $this->getCategoryData(); ?>
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
     	<a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getNext()])?>"> Next </a>
     </button>
	<button type="button" name="End">
		<a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getEnd()])?>"> End </a>
	</button>
	<button type="button" name="Current">
		<a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getCurrent()])?>"> Current </a>
	</button>
	<button type="button" name="Start">
		<a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getStart()])?>"> Start </a>
	</button>
	<button type="button" name="Prev">
		<a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getPrev()])?>"> Prev </a>
	</button>
	</tr>
</table>

<button type="button" name="addNew"><a href="<?php echo $this->getUrl('edit','categories');?>"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>CategoryId</th>
			<th>Name</th>
			<th>Base</th>
			<th>Thumbnail</th>
			<th>Small</th>
			<th>Path</th>
			<th>Status</th>
			<th>Created_Date</th>
			<th>Updated_Date</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Media</th>
		</tr>
			<?php if(!$categories):?>
		<tr>
			<td colspan="12">No record Available</td>
		</tr>	
		<?php else:?>
			<?php foreach ($categories as $category): ?>
				<tr>
					<td><?php echo $category->categoryId ; ?></td>
					<td><?php echo $category->path; ?></td>
					<td>
						<?php if(!$category->getBase()): echo "Image Not Available"; ?>
							<?php else: ?>
							<img src="<?php echo 'Media/Category/'.$category->getBase()->name; ?>" width="80px" height="80px">
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$category->getThumbnail()): echo "Image Not Available"; ?>
								<?php else: ?>
								<img src="<?php echo 'Media/Category/'.$category->getThumbnail()->name; ?>" width="80px" height="80px">
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$category->getSmall()): echo "Image Not Available"; ?>
							<?php else: ?>
								<img src="<?php echo 'Media/Category/' .$category->getSmall()->name; ?>" width="80px" height="80px"> 
						<?php endif; ?>
					</td>

					<td><?php echo $category->path;?></td>
					<td><?php echo $category->getStatus($category->status); ; ?></td>
					<td><?php echo $category->createdDate ; ?></td>
					<td><?php echo $category->updatedDate ; ?></td>
					<td><a href="<?php echo $this->getUrl('edit','categories',['id' => $category->categoryId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','categories',['id' => $category->categoryId])?>">Delete</a></td>
					<td><a href="<?php echo $this->getUrl('grid','category_media',['id' => $category->categoryId])?>">Gallery</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>			