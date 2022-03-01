<?php $result = $this->getPageData('pageEdit'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Edit Page</title>
</head>
<body>
	<form method="post" action="<?php echo $this->getUrl('save','page')?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Page Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="page[Name]" value="<?php echo $result->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Code</td>
				<td><input type="text" name="page[code]" value="<?php echo $result->code ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Content</td>
				<td><input type="text" name="page[content]" value="<?php echo $result->content ?>"></td>
				<input type="hidden" name="page[pageId]" value="<?php echo $result->pageId  ?>">
			</tr>
			
			
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="page[status]">
					<?php foreach ($result->getStatus() as $key => $value): ?>
					<option value="<?php echo $key ?>" <?php if($result->status == $key){?> selected <?php }?>
					><?php echo $value; ?></option>
					<?php endforeach; ?>
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