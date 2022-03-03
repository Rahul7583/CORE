<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table border="1" cellspacing="4" width="100%">
		<tr>
			<td><?php $this->getHeader()->toHtml();?></td>
		</tr>

		<tr>
			<td><?php $this->getContent()->toHtml();?></td>
		</tr>

		<tr>
			<td><?php $this->getFooter()->toHtml();?></td>
		</tr>
	</table>
</body>
</html>