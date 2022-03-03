<?php $pages = $this->getpageData(); ?>
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
					<td><?php echo $page->status;  ?></td>
					<td><?php echo $page->createdDate;  ?></td>
					<td><?php echo $page->updatedDate;  ?></td>
					<td><a href="<?php echo $this->getUrl('edit','page',['id' => $page->pageId])?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','page',['id' => $page->pageId])?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>	
	</table>