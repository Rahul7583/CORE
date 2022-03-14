<?php  ?>
	<form method="POST" action="<?php echo $this->getUrl('loginPost','admin_login');?>">
		<table border="1" width="100%" cellspacing="4">
			
			<tr>
				<td colspan="2"><b>Login</b></td>
			</tr>
			
			<tr>
				<td width="10%">Email</td>
				<td><input type="email" name="login[email]" ></td>
			</tr>

			<tr>
				<td width="10%">Password</td>
				<td><input type="passowrd" name="login[password]"></td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" value="Submit">
					<button type="button"><a href="<?php echo $this->getUrl('login', 'admin_login') ?>">Cancel</button> 
				</td>
			</tr>
		</table>
	</form>