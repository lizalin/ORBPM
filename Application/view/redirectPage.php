<?php

    /* ================================================
	File Name         	: redirectPage.php
	Description		: This page is used to redirect to plugin page and set pageid.
	Developed By		: T Ketaki Debadarshini
	Developed On		: 9-Sept-2015
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsAdminLinks
	Functions Used		: manageAdminPLinks()
	==================================================*/	

    $obj            = new clsAdminLinks;
    $glId           = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
   // $adminPLSql     = "CALL USP_ADMIN_PL('R','$plId','$glId','','',@OUT);";
    
    $adminPLResult  =  $obj->manageAdminPLinks('R',$plId,$glId,'','');
    $adminPLRow     = mysqli_fetch_array($adminPLResult);                                  
    $linkUrl        = $adminPLRow['LINK_URL']; 
    $vchUrl         = $adminPLRow['VCH_URL'];
    $vchPlName      = $adminPLRow['VCH_PL_NAME'];
    if($vchUrl == '')
    {
        $href = $linkUrl;
    }
    else
    {
        $href = $vchUrl;
    }
    $pageId                     = $adminPLRow['PAGE_ID'];
    $intfuncId                     = $adminPLRow['INT_FUNCTION_ID'];
    $redirectUrl                = APP_URL . $href . '/' . $glId . '/' . $plId;
    $pageId                     = ($pageId !='')?$pageId:0;
    $intfuncId                     = ($intfuncId !='')?$intfuncId:0;
    $_SESSION['sessPageId']     =  $pageId; 
    $_SESSION['sessFuncId']     =  $intfuncId; 
    $_SESSION['sessPageName']   =  $vchPlName; 
    
  // echo $redirectUrl; die();
    echo  "<script>location.href='".$redirectUrl."'</script>" ;
?>