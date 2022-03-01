
<?php $categories = $this->getCategoryData(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories Grid</title>
</head>
<body>
	<br><br>
	<button type="button" name="addNew"><a href="index.php?a=add&c=categories"> Add New </a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>CategoryId</th>
			<th>Name</th>
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
			<td colspan="7">No record Available</td>
		</tr>	
		<?php else:?>
			
			<?php foreach ($categories as $category): ?>
				<tr>
					<td><?php echo $category->categoryId ; ?></td>
					<td><?php $this->path($category->path) ?></td>
					<td><?php echo $category->path ; ?></td>
					<td><?php echo $category->status ; ?></td>
					<td><?php echo $category->createdDate ; ?></td>
					<td><?php echo $category->updatedDate ; ?></td>
					<td><a href="index.php?a=edit&c=categories&id=<?php 
							echo $category->categoryId; ?>">Edit</a></td>
					<td><a href="index.php?a=delete&c=categories&id=<?php 
							echo $category->categoryId; ?>">Delete</a></td>
					<td><a href="<?php echo $this->getUrl('grid','category_media',['id' => $category->categoryId])?>">Gallery</a></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>			
	</table>

</body>
</html>