<?php include('simple_html_dom.php'); ?>
<?php 
$data_href=$_POST['data_href']; 
$data_save_id=$_POST['data_save_id'];
$data_save_buffer=$_POST['data_save_buffer'];
?>

<?php  
/*$ht='';
$lines = file('../'.$data_href);
foreach ($lines as &$value) {
    $html=str_get_html($value);
    foreach ($data_save_id as $key=>$id) {
	    foreach($html->find('*[data-art-ident='.$id.']') as $e){
		    $e->innertext=trim($data_save_buffer[$key]);
		    $value=trim($html).PHP_EOL;
		}
	}
	$ht=$ht.$value;
}*/
//echo $ht;

?>
<?php  
$html = file_get_html('../'.$data_href);
foreach($data_save_id as $key=>$value){
	foreach($html->find('*[data-art-ident='.$value.']') as $tag){
	    echo $tag->innertext=$data_save_buffer[$key];
	}
}
/*foreach($html->find('*') as $tag){
	    echo $tag->outertext=$tag->outertext.PHP_EOL;
	}
echo $html;*/
?>
<?php  
echo $html->save('../'.$data_href);
//file_put_contents('../'.$data_href, $ht); 
//$newContent = $html->saveHTMLFile('../index.php');

?>
