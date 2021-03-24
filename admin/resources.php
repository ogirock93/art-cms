<?php  
$dev=$_GET['dev_mode'];
if (!$dev){

?>
<?php
	$dir = opendir('modules');
	while($file = readdir($dir)) {
		if (is_dir('modules/'.$file) && $file != '.' && $file != '..') {?>
			<?php if (!strripos(file_get_contents('modules/'.$file.'/res.php'), '/*enabled*/')===false){?>
				<div id="<?php echo str_replace(' ', '_', $file);?>_res">
				 	<?php @include 'modules/'.$file.'/res.php'; ?>
				</div>
			<?php }?> 
				 	
		<?php }
	}
}	
?>

<div class="art-default-panel">
  <div class="art-instruments">
    <div class="art-colo art-trigger-element">
      <img src="admin/modules/Text editor/img/trigger.png" alt="">
    </div>
    <div class="art-colo art-delete-element">
      <i class="fa fa-times" aria-hidden="true"></i>
    </div>
  </div>
</div>


<script src="admin/js/art-common.js"></script>
<script src="https://use.fontawesome.com/353c4ed595.js"></script>
<?php if ($dev){ ?>
<script src="admin/js/dev-mode/codemirror.js"></script>
<link rel="stylesheet" href="admin/css/dev-mode/codemirror.css">
<script src="admin/js/dev-mode/javascript.js"></script>
<script src="admin/js/dev-mode/htmlmixed.js"></script>
<script src="admin/js/dev-mode/vbscript.js"></script>
<script src="admin/js/dev-mode/css.js"></script>
<script src="admin/js/dev-mode/xml.js"></script>
<script src="admin/js/dev-mode/clike.js"></script>
<script src="admin/js/dev-mode/php.js"></script>
<script>
      // Define an extended mixed-mode that understands vbscript and
      // leaves mustache/handlebars embedded templates in html mode
      var mixedMode = {
        name: "htmlmixed",
        scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
                       mode: null},
                      {matches: /(text|application)\/(x-)?vb(a|script)/i,
                       mode: "vbscript"}]
      };
      var editor = CodeMirror.fromTextArea(document.getElementById("art-code"), {
        mode: "application/x-httpd-php",
        selectionPointer: true,
        lineNumbers: true,
        lineWrapping: true
      });
    </script>
<?php } ?>
