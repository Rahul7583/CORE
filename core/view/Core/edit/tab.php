<?php $tabs = $this->getTabs(); ?>

<?php foreach ($tabs as $key => $value) : ?>
<button type="button" onclick="tab('<?php if($this->getCurrentTab() != $key){ echo $value['url']; }?>')"><?php echo $value['title'] ?></button>
<?php endforeach; ?>

<script type="text/javascript">
	function tab(href){
		admin.setUrl(href);
		admin.load();
	}
</script>
