<?php  
	$module_name=$_POST['module_name'];
?>
<?php  
$f_name = '../modules/'.$module_name.'/res.php';
 
$content = file_get_contents($f_name);
$position     = strripos($content, '/*enabled*/');
if($position == false){
	$content = str_replace('/*disabled*/','/*enabled*/',  $content);
}
else{
	$content = str_replace('/*enabled*/', '/*disabled*/', $content);
}
file_put_contents($f_name, $content);
?>