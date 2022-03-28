<?php $result = $this->getAdmin(); ?>

		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>admin Information</b></td>
			</tr>

			<tr>
				<td width="10%">First Name</td>
				<td><input type="text" name="admin[firstName]" value="<?php echo $result->firstName ?>"></td>
			</tr>

			<tr>
				<td width="10%">LastName</td>
				<td><input type="text" name="admin[lastName]" value="<?php echo $result->lastName ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="email" name="admin[email]" value="<?php echo $result->email ?>"></td>
			</tr>

			<tr>
				<td width="10%">Password</td>
				<td><input type="password" name="admin[password]" value="<?php echo $result->password ?>"></td>
			</tr>
					
			<tr>
				<td>Status</td>
				<td width="10%">
					<select name="admin[status]">
						<?php foreach ($result->getStatus() as $key => $value): ?>
						<option value="<?php echo $key?>" <?php if($result->status == $key){?> selected <?php }?> ><?php echo $value; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'admin') ?>">Cancel</button> 
				</td>
			</tr>
		</table>
