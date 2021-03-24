<?php  
$newpass=$_POST['newpass'];
$newlogin=$_POST['newlogin'];
echo $newpass;
$filename = 'passport.php';
$file = file($filename);
if ($newlogin){
	$file[1] = '$login = "'.$newlogin.'";'.PHP_EOL;  // PHP_EOL — это перевод на новую строку
}
if ($newpass){
$file[2] = '$password = "'.$newpass.'";'.PHP_EOL;  // PHP_EOL — это перевод на новую строку
}
file_put_contents($filename, $file);
?>