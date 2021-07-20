<?php
@define('APP_CAPTCHA_ENV', 'D');//D: Development :: L: Live
$devFolder = (APP_CAPTCHA_ENV=='D')? 'ORBPM_WEB/' :'';
$resourcesPath = $_SERVER["DOCUMENT_ROOT"] .'/'.((APP_CAPTCHA_ENV=='D')? $devFolder :'').'Application/resources';	
session_start();
header ("content-type: image/png");
function getRandomWord($len = 5) {
    $word = array_merge(range('0', '9'), range('9', '0'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

$ranStr = getRandomWord();
$_SESSION["captcha"] = $ranStr;


$height = 35; //CAPTCHA image height
$width = 150; //CAPTCHA image width
$font_size = 24; 

$image_p = imagecreate($width, $height);
$graybg = imagecolorallocate($image_p, 255, 255, 255);
$textcolor = imagecolorallocate($image_p, 34, 34, 34);

imagefttext($image_p, $font_size, -2, 15, 26, $textcolor, $resourcesPath.'/fonts/mono.ttf', $ranStr);
//imagestring($image_p, $font_size, 5, 3, $ranStr, $white);
imagepng($image_p);

    
?>
