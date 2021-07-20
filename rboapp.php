<?php
$file_name = 'RajBhavanOdisha.apk';
$file_path = 'https://play.google.com/store/apps/details?id=com.csm.rajbhawan&hl=en';

// if app on playstore
// $file_path = 'https://play.google.com/store/apps/details?id=com.whatsapp&hl=en';
// header('location:'.$file_path);

// if app on local folder
header('Content-Type: application/vnd.android.package-archive');
header("Content-length: " . filesize($file_path));
header('Content-Disposition: attachment; filename="' . $file_name . '"');
ob_end_flush();
readfile($file_path);
return true;