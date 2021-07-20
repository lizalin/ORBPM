<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/custom.css">
<div class="viewTable" id="viewTable">
<table class="viewTable">
<tr><th>Sl#</th><th>Image name</th><th>Image</th></tr>
<?php	
	$log_directory	= "../uploadDocuments/content";	
	$ctr	= 0;
	$selfLink	= dirname($_SERVER['PHP_SELF']);
	$folderLink	= substr($selfLink, 0, strrpos($selfLink, "/"));
	$folderPath	= $_SERVER['HTTP_HOST'].$folderLink.'/uploadDocuments/content/';
	foreach(glob($log_directory.'/*.*') as $file) 
	{
		$ctr++;
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		if($ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='png' || $ext=='bmp')
		{
?>
	<tr><td width="25"><?php echo $ctr;?></td><td><a href="javascript:setLink('<?php echo $folderPath.basename($file);?>');" ><?php echo basename($file);?></a></td><td width="90"><img src="<?php echo 'http://'.$folderPath.basename($file);?>" height="70px" width="90px" onclick="setLink('<?php echo $folderPath.basename($file);?>');" style="cursor:pointer;"/></td></tr>
		
<?php
	}}
?>
</table>
</div>
<script type="text/javascript">

function setLink(url) {
window.opener.CKEDITOR.tools.callFunction(1, "http://"+url);
window.close();
}
</script>