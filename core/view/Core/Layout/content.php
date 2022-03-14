<?php echo $this->getMessage()->toHtml(); ?>
<?php foreach ($this->getChildren() as $key => $value): 
		 echo $value->toHtml(); 
	 endforeach; 
?>
