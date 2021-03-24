<?php  
/*enabled*/
?>
<link rel="stylesheet" type="text/css" href="admin/modules/Image editor/css/style.css">
<script src="admin/modules/Image editor/js/art-common.js"></script>

<!--<div class="art-image-editor-panel art-default-panel">
	<div class="art-instruments">
		<div class="art-colo art-edit-image">
			<i class="fa fa-picture-o" aria-hidden="true"></i>
		</div>
		<div class="art-colo art-trigger-element">
			<img src="admin/modules/Text editor/img/trigger.png" class="art-btn-image" alt="">
		</div>
		<div class="art-colo art-delete-image">
			<i class="fa fa-times" aria-hidden="true"></i>
		</div>
		
	</div>
</div>-->



<div class="art-main-popup-wrap art-image-editor">
	<div class="art-popup-wrap">
		<div class="art-popup">
			<div class="art-close"><div class="art-drag"></div><span class="art-close-span"></span></div>
			<form action="" id="drop-area" title="<?php echo $havedragndrop; ?>">
				<label id="art_image_preview" class="art-image-preview" for="art_image_loader">
					<input type="file" onchange="encodeImage(this)" accept=".jpg, .jpeg, .png, .gif" id="art_image_loader" name="art-image-loader">

					<img src="" id="art-image-preview-example" class="art-image-preview-example" alt="">
				</label>
				<div class="art-input-flex">
					<div class="art-input-wrap">
						<p class="art-input-heading">Title</p>
						<input type="text" id="art-image-title" placeholder="<?php echo $entertitle; ?>">
					</div>
					<div class="art-input-wrap">
						<p class="art-input-heading">Alt</p>
						<input type="text" id="art-image-alt" placeholder="<?php echo $enteralt; ?>">
					</div>
				</div>
			</form>
				
				<div class="art-btn-wrap"><button class="art-main-btn" id="save_image_btn"><?php echo $savechanges; ?> <i class="fa fa-floppy-o" aria-hidden="true"></i></button></div>


		</div>
	</div>
</div>	
