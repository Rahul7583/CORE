<?php $configs = $this->getConfigData(); ?>
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
