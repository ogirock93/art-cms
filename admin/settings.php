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
	<title><?php echo $settings; ?> ART CMS</title>
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
			<?php echo $settings; ?>
		</div>
		<div class="art-block">
			<p class="art-p"><?php echo $yloginis; ?>- <b><?php echo $login; ?></b></p>

			<form action="/" id="art-login-submit" method="post">
				<p class="art-p art-mini-heading"><?php echo $changelogin; ?></p>
				<div class="art-input-wrap">
					<p class="art-p"><?php echo $changelogintext; ?></p>
					<input type="text" value="<?php echo $login; ?>" name="login" class="art-input" id="login">
				</div>
				<div class="art-err"></div>
				<button class="art-save-btn" id="art-save-login"><?php echo $savechanges; ?> <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
			</form>
			
			<form action="/" id="art-pass-submit" method="post">

				<p class="art-p art-mini-heading"><?php echo $changepass; ?></p>
				<div class="art-input-wrap">
					<p class="art-p"><?php echo $enterpass; ?></p>
					<input type="password" name="pass1" class="art-input" id="pass1">
					<div class="eye"><i class="fa fa-eye" aria-hidden="true"></i></div>
				</div>
				<div class="art-input-wrap">
					<p class="art-p"><?php echo $repeatpass; ?></p>
					<input type="password" name="pass2" class="art-input" id="pass2">
					<div class="eye"><i class="fa fa-eye" aria-hidden="true"></i></div>
				</div>
				<div class="art-err"></div>
				<button class="art-save-btn" id="art-save-pass"><?php echo $changepass; ?> <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
			</form>

			<p class="art-p art-mini-heading"><?php echo $localization; ?></p>
			<select id="localization">
			<?php
				$obIterator = new FilesystemIterator("localization");
				$rxIterator = new RegexIterator($obIterator,'/\.(php)$/');
				$arFileList = array();
				foreach($rxIterator as $obFile):?>
					<?php if ($arFileList[] = $obFile->getFilename()!='current-lang.php'){ ?>
				<option <?php if ($obFile->getBasename('.php')==$mylang){echo 'selected="true"';} ?> value="<?php echo $arFileList[] = $obFile->getBasename('.php'); ?>">
					<?php 
					$fopen=@file("localization/".$arFileList[] = $obFile->getBasename());
					echo str_replace('//', '', $fopen[1]);	
					?>
				</option>
			<?php } ?>
			<?php endforeach;?>
			</select>
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