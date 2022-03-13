<?php $categories = $this->getCategoryData(); ?>
<table border="1">
	<tr>
		<button type="button" name="addNew"><a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getNext()])?>"> Next </a></button>
		<button type="button" name="addNew"><a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getEnd()])?>"> End </a></button>
		<button type="button" name="addNew"><a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getCurrent()])?>"> Current </a></button>
		<button type="button" name="addNew"><a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getStart()])?>"> Start </a></button>
		<button type="button" name="addNew"><a href="<?php echo $this->getUrl('grid','categories',['page' => $this->getPager()->getPrev()])?>"> Prev </a></button>

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
						<?php if(!$category->base): echo "Image Not Available"; ?>
							<?php else: ?>
							<img src="<?php echo 'Media/Category/'.$category->base; ?>" width="80px" height="80px">
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$category->thumbnail): echo "Image Not Available"; ?>
								<?php else: ?>
								<img src="<?php echo 'Media/Category/'.$category->thumbnail; ?>" width="80px" height="80px">
						<?php endif; ?>
					</td>
					<td>
						<?php if(!$category->small): echo "Image Not Available"; ?>
							<?php else: ?>
								<img src="<?php echo 'Media/Category/' .$category->small; ?>" width="80px" height="80px"> 
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