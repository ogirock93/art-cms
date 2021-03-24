<?php 
$data_href=$_POST['data_href']; 
$dev_data=$_POST['dev_data']; 
?>
<?php
    echo $finalhtml=htmlspecialchars_decode($dev_data);
    file_put_contents('../'.$data_href, $finalhtml);
?>


