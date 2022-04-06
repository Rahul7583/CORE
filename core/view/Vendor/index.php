<form method="POST" id="indexForm" action="<?php echo $this->getUrl('gridBlock'); ?>" >
	<div id="indexMessage">
    	
    </div>
	<div id="indexContent">
		
	</div>

 </form>
 <script type="text/javascript">
 	admin.setForm(jQuery("#indexForm"));
 	console.log(admin);
 	admin.load();
 </script>