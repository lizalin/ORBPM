<?php
/* ================================================
	File Name         	: addNotificationInner.php
	Description		: This page is used to add Notification /Tender / Route Rationalization 
                                   /Guideline for Public.
	Developed By		: Sonali satapathy
	Developed On		: 29-SEPT-2016
	Update History		:
	<Updated by>		<Updated On>        <Remarks>
        
	Class Used		: clsNotification
	Functions Used		: readNotification(),addUpdateNotification()
==================================================*/

$obj                = new clsNotification;
$id                 = (isset($_REQUEST['ID'])) ? $_REQUEST['ID'] : 0;
$strSubmit          = ($id > 0) ? 'Update' : 'Submit';
$strReset           = ($id > 0) ? 'Cancel' : 'Reset';
$strTab             = ($id > 0) ? 'Edit' : 'Add';
$strclick           = ($id > 0) ? "window.location.href='" . APP_URL . "viewNotification/" . $glId . "/" . $plId . "';" : "";
$strLinkType        = 1;
$strURL             = 'http://';
$intWinStatus       = 1;
$intUrlType         = 1;
$intTemplateType    = 1;
//========== Default variable ===============	

$outMsg             = '';
$intStatus          = 2;
$selplugintype      = 0;
$intCattype         = 0;
$chkval             = 0;
$intPluginId        = 0;
//========== Permission ===============	
$glId          = $_REQUEST['GL'];
$plId          = $_REQUEST['PL'];
$pageName      = $_REQUEST['PAGE'] . '.php';
$userId        = $_SESSION['adminConsole_userID'];
$explPriv      = $obj->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
$noAdd         = $explPriv['add'];

if ($noAdd == 1 && $id == 0)
	echo "<script>location.href = '" . APP_URL . "viewNotification/" . $glId . "/" . $plId . "'</script>";


//=========== For editing ======================
if (isset($_REQUEST['ID']) && $id > 0) {

	//============ Read value for updation ===========	
	$result          = $obj->readNotification($id);
	//print_r($result);exit;
	$strCategory     = $result['strCaption'];
	$strFileName     = $result['strdoc'];
	$DateTime        = $result['strdate'];
	$selplugintype   = $result['intType'];
	$intStatus       = $result['stractive'];
	$strCaptionO     = $result['strCaptionO'];
	$chkval          = $result['strblink'];
	$strCode         = $result['strCode'];
	$strlinkType     = $result['strlinkType'];
	$strstartdate    = $result['strstartdate'];
	$intUrlType      = $result['intUrlType'];
	$intSlNo         = $result['intSlNo'];
	$strURL          = $result['strUrl'];
	$strDetailsE     = $result['strDetailE'];
	$strDetailsO     = $result['strDetailO'];
	$intTemplateType = $result['intTemplateTYpe'];
	$intWinStatus    = $result['intWinStatus'];
	$intPluginId     = $result['intPluginId'];
}

//============ Button Submit ===================
if (isset($_POST['btnSubmit'])) {
	$result          = $obj->addUpdateNotification($id);
	$outMsg          = $result['msg'];
	$flag            = $result['flag'];
	$strCategory     = htmlspecialchars_decode($result['txtHeadline'], ENT_QUOTES);
	$DateTime        = $result['DateTime'];
	$selplugintype   = $result['intCategory'];
	$intStatus       = $result['rbtLnkType'];
	$intUrlType      = $result['intUrlType'];
	$strURL          = $result['strUrl'];
	$strDetailsE     = $result['strDetailE'];
	$strDetailsO     = $result['strDetailO'];
	$intTemplateType = $result['intTemplateType'];
	$intWinStatus    = $result['intWinStatus'];
	$intPluginId     = $result['intPluginId'];

	$strCaptionO     = $result['strCaptionO'];
	$chkval          = $result['strblink'];
	$strCode         = $result['txtCode'];
	$strlinkType     = $result['linkType'];
}
