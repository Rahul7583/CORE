<?php $media = $this->getCategoryMediaData(); ?> 
<?php $id = Ccc::getFront()->getRequest()->getRequest('id'); ?>
	<form method="POST" action="<?php echo $this->getUrl('save', 'category_media', ['id' => $id]);?>">
<div class="card-footer">		
	<button type="submit" class="btn btn-info" name="update"> Update </a></button>
	<button type="button" class="btn btn-default" name="cancel"><a href="<?php echo $this->getUrl('grid','categories')?>"> Cancel </a></button>
</div>	
			<table class="table table-bordered table-striped">
				<tr>
					<th>Image Id</th>
					<th>Category Id</th>
					<th>Picture</th>
					<th>Name</th>
					<th>Base</th>
					<th>Thumbnail</th>
					<th>Small</th>
					<th>Gallery</th>
					<th>Remove</th>	
				</tr>
					<?php if(!$media):?>
				<tr>
					<td colspan="11">No record Available</td>
				</tr>	
				<?php else:?>
					
					<?php foreach ($media as $row): ?>
						<tr>
							<td><input type="number" readonly  name="image[imageId][]" value="<?php echo $row->imageId;?>"></td>
							<td><?php echo $row->categoryId ?></td>
							<td>
								<?php if($row->gallery != 1): ?>
									<?php else: ?>
										<img src="<?php echo 'Media/Category/'.$row->name;?>" width="80px" height="80px">		
								<?php endif; ?>
							</td>
							<td><?php echo $row->name ?></td>
							<td><input type="hidden" name="image[categoryId]" value="<?php echo $row->categoryId;?>">
							<input type="radio" name="image[base]" <?php if($row->base == 1){echo('checked');} ?> value="<?php echo($row->imageId); ?>" ></td>

							<td><input type="radio" name="image[thumbnail]" <?php if($row->thumbnail == 1){echo('checked');} ?> value="<?php echo ($row->imageId); ?>"></td>

							<td><input type="radio" name="image[small]" value="<?php echo ($row->imageId); ?>"
								<?php if ($row->small == 1):?> checked <?php endif;?> ></td>

							<td><input type="checkbox" name="image[gallery][]" value="<?php echo ($row->imageId); ?>"<?php if ($row->gallery == 1):?> checked <?php endif;?> ></td>
							<td><input type="checkbox" name="image[remove][]" value="<?php echo ($row->imageId); ?>"<?php if ($row->remove == 1):?> checked <?php endif;?>></td>

						</tr>
					<?php endforeach; ?>
				<?php endif; ?>			
			</table>
	</form>
	
	<form method="POST" action="<?php echo $this->getUrl('save', 'category_media', ['id' =>  $id]);?>" enctype="multipart/form-data">
		<table class="table table-bordered table-striped">
			
			<tr>
				<td colspan="2"><b>Image Upload</b></td>
			</tr>

			<tr>
				<td width="10%">Browse</td>
				<td><input class="btn btn-default" type="file" name="image" ></td>
			</tr>
			
			<tr>
				<td width="10%">&nbsp;</td>
				<td>
					<button class="btn btn-info" type="submit">Upload</button> 
				</td>
			</tr>
		</table>
	</form>
