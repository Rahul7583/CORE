

<?php 

$id=$_GET['id'];

global $adapter;

$result=$adapter->fetchRow("select * from categories where categoryId='$id'");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories Edit Page</title>
</head>
<body>

	<form method="post" action="index.php?a=save&c=categories">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Categories Information</b></td>
			</tr>

			<tr>
      			<td width="10%">Select Parent Category</td>
      			<td>
      				<select name="category[parentName]"> 
        				<?php
        					if(!$result): 
          						echo 'No data';
        					endif;
          					foreach($result as $row) :?>
            			<?php
            				//echo "<option value='".$row['name']."'>".$this->path($row['path'])."</option>" ;
          					endforeach;
        				?>
      				</select>
      			</td>
    		</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="category[name]" value="<?php echo $result['name'] ?>"></td>
				<input type="hidden" name="category[hiddenId]" value="<?php echo $result['categoryId'] ?>">
			
			</tr>

			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="category[status]" value="<?php echo $result['status'] ?>" >
						<?php if ($row['status']==1):?>
						<option value="1" selected>Active</option>
						<option value="2">Inactive</option>
					<?php else:?>
						<option value="1">Active</option>
						<option value="2" selected>Inactive</option>
					<?php endif; ?>
					</select>
				</td>
			</tr>
			
		

			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button">Cancel</button> 

				</td>
			</tr>
			

		</table>
	</form>

</body>
</html>