<?php  
$data_href=$_POST['data_href']; 
$phpfile=file_get_contents('../'.$data_href);
?>	
<?php  
$dom = new DOMDocument('1.0', 'UTF-8');
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' .$phpfile);
    $xpath = new DOMXPath($dom);
    $tags = $xpath->query('body//*');
    $myneedid=0;
    foreach ($tags as $tag) {
        $tag->setAttribute("data-art-ident",$myneedid );
        $myneedid=$myneedid+1;
    }
    $dom->formatOutput = true;
    echo $dom->saveHTML();
    file_put_contents('../'.$data_href, '<!DOCTYPE html>'.PHP_EOL.$dom->saveHTML($dom->documentElement));
?>
