<?php
/**
 * uploader.php
 * Use class.upload.php to upload images etc.
 */
//include('Common_class_inc.php');
include 'config.php';
include('class.upload.php');          // where you have put class.upload.php
//$obj 		= new commonClass;
$dir		= dirname($_SERVER['PHP_SELF']);
$strPath	= substr($dir, 0, strrpos( $dir, '/') );
$msg = '';                                     // Will be returned empty if no problems
$callback = ($_GET['CKEditorFuncNum']);        // Tells CKeditor which function you are executing
//echo $_SERVER['DOCUMENT_ROOT'];exit;
$handle = new upload($_FILES['upload']);       // Create a new upload object 
if ($handle->uploaded) {
    $handle->image_resize         = false;
    //
    // Create a small image (thumbnail)
    //
    $handle->image_x              = 150;
    $handle->image_ratio_y        = true;

    $handle->process('../uploadDocuments/content/');  // directory for the uploaded image
    $image_url = 'http://'.$_SERVER['HTTP_HOST'] .$strPath .'/uploadDocuments/content/' . $handle->file_dst_name;          // URL for the uploaded image
 
    if ($handle->processed) {
         $handle->clean();
    } else {
        $msg =  'error : ' . $handle->error;
    }
}
$output = '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$callback.', "'.$image_url .'","'.$msg.'");</script>';
echo $output;
?>
