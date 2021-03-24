<?php  
session_start();
@include 'localization/current-lang.php';
$mylang=$currentlang;
@include 'passport.php';
if (($_COOKIE['login'] == $login) && ($_COOKIE['password'] == $password) || ($_SESSION['password'] == md5($login.':'.$password)))
 {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="../">
	<meta charset="UTF-8">
	<title><?php echo $modules; ?> ART CMS</title>
	<link rel="stylesheet" href="admin/css/main.css">
	<script src="admin/js/art-jquery.min.js"></script>
</head>
<body>


<div class="art-header">
	<label class="art-menu-wrap" for="art-menu-toggle"></label>
		<input type="checkbox" id="art-menu-toggle" autocomplete="off">
		<div class="art-menu"></div>
		

		<span class="art-to-up"><i class="fa fa-chevron-up" aria-hidden="true"></i></span>
		<div class="art-main-menu-wrap">
			<?php @include 'main-menu.php'; ?>
		</div>
	
	<div class="art-profile">
		<span class="art-myname"><?php echo $login; ?></span> <a href="admin/logout.php" class="art-logout"><?php echo $logout; ?> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
	</div>
	
	
</div>	
	
<div class="art-screen">
	<div class="art-wrapper">
		<div class="art-heading">
			<?php echo $modules; ?>
		</div>
		<div class="art-block">
			<ul class="art-sub-menu art-module-menu">
			<?php
				$dir = opendir('modules');
				while($file = readdir($dir)) {
				   if (is_dir('modules/'.$file) && $file != '.' && $file != '..') {?>
				       <li class="art-text-tag art-module-line">
				       	<h2 class="art-heading-modules">
					       	<?php echo $file; ?><?php
					       	$filename = 'modules/'.$file.'/detail.html';
					       	if (file_exists($filename)) { ?><i class="fa fa-angle-down" aria-hidden="true"></i><?php } ?>
				       </h2>
				       	<?php
				       	$filename = 'modules/'.$file.'/detail.html';
				       	if (file_exists($filename)) { ?>
						    <iframe src="admin/<?php echo $filename ?>" class="art-details">
				       		
				       		</iframe>
						<?php } ?>
				       	
				       <label class="art-label" for="<?php echo str_replace(' ', '_', $file) ?>">
				       <input <?php if (!strripos(file_get_contents('modules/'.$file.'/res.php'), '/*enabled*/')===false){echo 'checked="true"';}?> type="checkbox" id="<?php echo str_replace(' ', '_', $file) ?>" autocomplete="off"><span class="art-text-tag"><?php echo $turnon; ?></span></label></li>
				   <?php }
				}
			?>
		</ul>

		</div>
	</div>	
</div>


<div id="art-buffer"></div>

<div class="art-res">
	<?php @include 'resources.php'; ?>
</div>	
</body>
</html>
<?php }else{
	header('Location: login.php ');
} ?>