<?php
session_start();
@include 'localization/current-lang.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ART CMS - <?php echo $autorization;?></title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body id="art_gradient">
  <form name="autorization" id="art_autorization"  action="" method="POST">
           <h1>ART CMS - <?php echo $elogin; ?></h1>
<?php
@include 'passport.php';

if (($_COOKIE['login'] == $login) && ($_COOKIE['password'] == $password) || ($_SESSION['password'] == md5($login.':'.$password)))
 {
  echo '<p>'.$logined.'</p>';
  if (file_exists('../index.php')) {
    header('Location: index.php?page=index.php ');
  } else {
      header('Location: index.php?page=index.html ');
  }
 }
 else
 {
  if(($_POST['login']) && ($_POST['password']))
   {
  if((trim($_POST['login']) == $login) && (trim($_POST['password']) == $password))
   {
    if(!$_POST['save_cookie'])
     {
      $_SESSION['password'] = md5($login.':'.$password);
      echo '<p class="ock">'.$authsess.'</p>';
      if (file_exists('../index.php')) {
    header('Location: index.php?page=index.php ');
  } else {
      header('Location: index.php?page=index.html ');
  }
     }
     else
     {
      setcookie("login",$login);
      setcookie("password",$password);
      echo '<p class="ock">'.$authcoockies.'</p>';
      if (file_exists('../index.php')) {
    header('Location: index.php?page=index.php ');
  } else {
      header('Location: index.php?page=index.html ');
  }
     }
   }
   else
   {
    echo '<p>'.$logfail.'</p>';
   }
  } 
  else
  {
   if((!$_POST['login']) && (!$_POST['password'])) 
   {
   }
   else
   {
   echo '<p>'.$typeall.'</p>';
   }
  }
  }



  /* geforse.name */
?> 
            <input placeholder="<?php echo $youtlogin; ?>" type="text" name="login"><br>
            <input placeholder="<?php echo $yourpass; ?>" type="password" name="password"><br>
            <?php echo $remember; ?> ? <input type=checkbox name="save_cookie" value=1><p>
            <input type="submit" name="data" value="<?php echo $elogin; ?>">
            <div class="art-back-link">
               <span><?php echo $backto; ?></span> <a href="/"><?php echo $site; ?></a>
            </div>
           
           </form>
</body>
</html>