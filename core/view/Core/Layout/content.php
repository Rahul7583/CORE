<?php $this->getMessage()->toHtml();
 ?>
<?php foreach ($this->getChildren() as $key => $value): 
		 $value->toHtml(); 
	 endforeach; 
?>
