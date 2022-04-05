<!DOCTYPE html>
<html lang="en">
    <?php echo $this->getHead()->toHtml(); ?>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<style type="text/css">
    .container-fluid{
        margin-top: 50px;
    }
</style>

<div class="wrapper">
    
    <?php echo $this->getHeader()->toHtml(); ?>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid">
                        <?php echo $this->getContent()->toHtml(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php echo $this->getFooter()->toHtml(); ?>
</div>
</div>
</body>
</html>


















<!-- <!DOCTYPE html>
<html>

<?php //echo $this->getHead()->toHtml(); ?>
<body>
	<table border="1" cellspacing="4" width="100%">
		<tr>
			<td><?php //echo $this->getHeader()->toHtml();?></td>
		</tr>

		<tr>
			<td><?php //echo $this->getContent()->toHtml();?></td>
		</tr>

		<tr>
			<td><?php //echo $this->getFooter()->toHtml();?></td>
		</tr>
	</table>
</body>
</html>
 -->