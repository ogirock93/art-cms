<?php  
$lang=$_POST['lang'];
$filename = 'localization/current-lang.php';
$file = file($filename);
if ($lang){
	$file[1] = '$currentlang = "'.$lang.'";'.PHP_EOL;  // PHP_EOL — это перевод на новую строку
}
file_put_contents($filename, $file);
?>