<?php
// Define the Base64 value you need to save as an image
$b64 = $_POST['image_base_url'];
//$str = str_replace("data:image/png;base64,", "", $b64);
$str = substr($b64, strpos($b64, ","));
$imagefilename=$_POST['imagefilename'];
// Obtain the original content (usually binary data)
$bin = base64_decode($str);


$size = getImageSizeFromString($bin);


if (empty($size['mime']) || strpos($size['mime'], 'image/') !== 0) {
  //die('Base64 value is not a valid image');
}

$ext = substr($size['mime'], 6);

$img_file = "../art-uploaded-files/".$imagefilename;
if (!file_exists('../art-uploaded-files')) {
    mkdir('../art-uploaded-files', 0777, true);
}
file_put_contents($img_file, $bin);

echo $imagefilename;
?>