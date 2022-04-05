<?php $vendor = $this->getVendor(); 
 $vendorAddress = $vendor->getAddress(); 

?>
<form method="post" action="<?php echo $this->getUrl('save','vendor', ['id' => $result->vendorId])?>">
		<table border="1" width="100%" cellspacing="4">
			<tr>
				<td colspan="2"><b>Address Information</b></td>
			</tr>

			<tr>
				<td width="10%">Address</td>
				<td><input type="text" name="vendor_address[address]" value="<?php echo $vendorAddress->address ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">Postal Code</td>
				<td><input type="text" name="vendor_address[postalCode]" value="<?php echo $vendorAddress->postalCode ?>"></td>
			</tr>

			<tr>
				<td width="10%">City</td>
				<td><input type="text" name="vendor_address[city]" value="<?php echo $vendorAddress->city ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">State</td>
				<td><input type="text" name="vendor_address[state]" value="<?php echo $vendorAddress->state ?>"></td>
			</tr>

			<tr>
				<td width="10%">Country</td>
				<td><input type="text" name="vendor_address[country]" value="<?php echo $vendorAddress->country ?>"></td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" name="Save">
					<button type="button"><a href="<?php echo $this->getUrl('grid', 'vendor') ?>">Cancel</button> 
				</td>
			</tr>
		</table>
	</form>
</body>
</html>