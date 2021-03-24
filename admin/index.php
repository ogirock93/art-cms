<?php  
@include 'localization/current-lang.php';
$page=$_GET['page']; 
	if (!$page){
		if (file_exists('../index.php')) {
		    $pagehref= '../index.php';
		  } else {
		      $pagehref='../index.html';
		  }
	}else{
		$pagehref ='../'.$page;
	}

$dev=$_GET['dev_mode'];
if (!$page){
 if (file_exists('../index.php')) {
    header('Location: index.php?page=index.php ');
  } else {
      header('Location: index.php?page=index.html ');
  }
}
session_start();
@include 'passport.php';
if (($_COOKIE['login'] == $login) && ($_COOKIE['password'] == $password) || ($_SESSION['password'] == md5($login.':'.$password)))
 {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="../">
	<meta charset="UTF-8">
	<title>ART CMS</title>
	<link rel="stylesheet" href="admin/css/main.css">
	<script src="admin/js/art-jquery.min.js"></script>
</head>
<body>

<div class="art-header">
	<label class="art-menu-wrap" for="art-menu-toggle"></label>
		<input type="checkbox" id="art-menu-toggle" autocomplete="off">
		<div class="art-menu"></div>
		<!--<div class="art-devices-changer">
			<span class="art-device-pc art-active-device"><i class="fa fa-desktop" aria-hidden="true"></i></span>
			<span class="art-device-tablet"><i class="fa fa-tablet" aria-hidden="true"></i></span>
			<span class="art-device-mobile"><i class="fa fa-mobile" aria-hidden="true"></i></span>
		</div>-->
		<div class="art-dev-mode-wrap">
			<?php echo $devmode; ?><label for="art-dev-mode-checkbox" class="art-dev-mode"><input id="art-dev-mode-checkbox" type="checkbox" autocomplete="off" <?php if ($dev){echo 'checked="checked"';} ?>><span class="art-dev-mode-check"></span>
				<span class="art-dev-wrapper"></span></label>
		</div>
		<span class="art-to-up"><i class="fa fa-chevron-up" aria-hidden="true"></i></span>
		<div class="art-main-menu-wrap">
			<?php @include 'main-menu.php'; ?>
		</div>
	
	<div class="art-profile">
		<a href="<?php echo $_GET['page']; ?>" target="_blank" class="art-prev" title="Предпросмотр"><i class="fa fa-eye" aria-hidden="true"></i></a>
		<span class="art-myname"><?php echo $login; ?></span> <a href="admin/logout.php" class="art-logout"><?php echo $logout; ?> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
	</div>
	<?php if (!$dev){ ?>
<div id="art_save_content" class="art-main-save-buttons" data-art-href='<?php echo $page; ?>'><i class="fa fa-floppy-o" aria-hidden="true"></i><div class="art-save-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></div></div>
	<?php }else{ ?>	
<div id="art_save_dev_content" class="art-main-save-buttons" data-art-href='<?php echo $page; ?>'><i class="fa fa-floppy-o" aria-hidden="true"></i><div class="art-save-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></div>
</div>
	<?php } ?>
	
	
</div>	
	

<?php if (!$dev){ ?>
<div id="art_site_content">
	<?php  

		@include $pagehref;
	
	?>
	
</div>






<?php }else{ ?>
<pre id="art_dev_content" contenteditable=""  spellcheck="false">
<textarea id="art-code" class="myTextarea prettyprint lang-html lang-php language-html">
<?php $devcontent=file($pagehref);
foreach ($devcontent as $line_num => $line) {
echo  htmlspecialchars($line);
}
?>
</textarea>
</pre>


<?php }  ?>

<div id="art-buffer"></div>

<div class="art-res">
	<?php @include 'resources.php'; ?>
</div>	
</body>
</html>
<?php }else{
	header('Location: login.php ');
} ?>