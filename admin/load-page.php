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
	
	


<div id="art_site_content">
	<?php  

		@include $pagehref;
	
	?>
	
</div>




<div id="art_save_content" data-art-href='<?php echo $page; ?>'><i class="fa fa-floppy-o" aria-hidden="true"></i><div class="art-save-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i></div>
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