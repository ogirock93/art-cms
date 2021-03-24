<?php  
/*enabled*/
?>
<link rel="stylesheet" type="text/css" href="admin/modules/Text editor/css/style.css">
<script src="admin/modules/Text editor/js/art-common.js"></script>




<div class="art-main-popup-wrap art-text-editor">
	<div class="art-popup-wrap">
		<div class="art-popup">
			<div class="art-close"><div class="art-drag"></div><span></span></div>
				<form name="compForm" id="compForm" method="post" action="/" onsubmit="if(validateMode()){this.myDoc.value=oDoc.innerHTML;return true;}return false;">
				<input type="hidden" name="myDoc">
				<div id="toolBar2">
				<div class="popup-body">
					<div class="art_btn_panel">
						<button class="art_html_view"  title="<?php echo $htmlview; ?>"><i class="fa fa-code"></i></button>
						<button class="art-undo"  title="<?php echo $undo; ?>" onclick='document.execCommand("undo")'><i class="fa fa-undo"></i></button>
						<button class="art-redo"  title="<?php echo $redo; ?>" onclick='document.execCommand("redo")'><i class="fa fa-repeat" aria-hidden="true"></i></button>
						<button class=""  title="<?php echo $fontbold; ?>" onclick='document.execCommand("bold")'><i class="fa fa-bold" aria-hidden="true"></i></button>
						<button title="<?php echo $fontitalic; ?>" style="font-style: italic;" class="" onclick='document.execCommand("italic")'><i class="fa fa-italic" aria-hidden="true"></i></button>
						<button  title="<?php echo $underline; ?>" style="font-style: underline;" class="" onclick='document.execCommand("underline")'><i class="fa fa-underline" aria-hidden="true"></i></button>
						<button  title="<?php echo $strikethrough; ?>" style="font-style: line-through;" class="" onclick='document.execCommand("strikethrough")'><i class="fa fa-strikethrough" aria-hidden="true"></i></button>
						<button class=""  title="<?php echo $alignleft; ?>" onclick='document.execCommand("justifyleft")'><i class="fa fa-align-left" aria-hidden="true"></i></button>
						<button class="" title="<?php echo $aligncenter; ?>" onclick='document.execCommand("justifycenter")'><i class="fa fa-align-center" aria-hidden="true"></i></button>
						<button class="" title="<?php echo $alignright; ?>" onclick='document.execCommand("justifyright")'><i class="fa fa-align-right" aria-hidden="true"></i></button>
						<button class="" title="<?php echo $createlink; ?>" onclick="var sLnk=prompt('Введите ваш URL','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}"><i class="fa fa-link" aria-hidden="true"></i></button>
						<button class="" title="<?php echo $removelink; ?>" onclick='document.execCommand("unlink",false,"")'><i class="fa fa-chain-broken" aria-hidden="true"></i></button>
						<button class="art-some_attr" title="<?php echo $blantlink; ?>"><i class="fa fa-external-link" aria-hidden="true"></i></button>

					</div>
				</div>
				</div>
				<div id="art_realtime_text" onkeydown='document.execCommand("defaultParagraphSeparator", false, "br")' oninput="if ($('#sourceText').length>0){newtext=$('#sourceText').text();	}else{newtext=$('#art_realtime_text').html();}$('.can_redact_me').replaceWith(function() {return $(newtext, {html: $(this).html()}).addClass('can_redact_me')});" class="art_realtime_text"  contenteditable="true"></div>
				<span id="editMode"><input id="switchBox" type="checkbox" name="switchMode" onchange="setDocMode(this.checked);"> </span>
				</form>
				<div class="art-btn-wrap"><button class="art-main-btn" id="save_text_btn"><?php echo $savechanges; ?> <i class="fa fa-floppy-o" aria-hidden="true"></i></button></div>


		</div>
	</div>
</div>	