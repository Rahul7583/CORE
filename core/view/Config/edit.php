<?php $result = $this->getConfig(); ?>
	<form method="POST" action="<?php echo $this->getUrl('save','config');?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Config Information</b></td>
			</tr>

			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="config[name]" value="<?php echo $result->name ?>"></td>
			</tr>

			<tr>
				<td width="10%">Code</td>
				<td><input type="text" name="config[code]" value="<?php echo $result->code ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Value</td>
				<td><input type="text" name="config[value]" value="<?php echo $result->value ?>"></td>
				<input type="hidden" name="config[configId]" value="<?php echo $result->configId ?>">
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="config[status]">
						<?php foreach ($result->getStatus() as $key => $value):?> 
						<option value="<?php echo $key?>" <?php if($result->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'config') ?>">Cancel</button> 
				</td>
			</tr>
		</table>
	</form>