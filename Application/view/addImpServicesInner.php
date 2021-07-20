<?php
/* ================================================
	File Name       : addImpServicesInner.php
	Description		: This page is used to add Important Services.
	Developed By	: Ashis Kumar Patra
	Developed On	: 05-Oct-2016
	Update History	:
	<Updated by>		<Updated On>		<Remarks>
        Ashis Kumar Patra    05-Oct-2016         adding 

	Class Used      : clsImpServices
	Functions Used	: 
	==================================================*/

$obj                = new clsImpServices;
$id                 = (isset($_REQUEST['ID'])) ? $_REQUEST['ID'] : 0;
$strSubmit          = ($id > 0) ? 'Update' : 'Submit';
$strReset           = ($id > 0) ? 'Cancel' : 'Reset';
//exit(  $strSubmit .' '.$strReset );
$strTab             = ($id > 0) ? 'Edit' : 'Add';
$strclick           = ($id > 0) ? "window.location.href='" . APP_URL . "viewImpServices/" . $glId . "/" . $plId . "';" : "";
//========== Default variable ===============
$intWinStatus       = 1;
$intLinkType        = 1;
$intTempletType      = 1;
$flag               = 0;
$errFlag            = 0;
$outMsg             = '&nbsp;';
$intStatus          = 2;
$selplugintype      = 0;
$intCattype         = 0;
$chkval             = 0;
$strUrl            = "http://";
//========== Permission ===============	
$glId          = $_REQUEST['GL'];
$plId          = $_REQUEST['PL'];
$pageName      = $_REQUEST['PAGE'] . '.php';
$userId        = $_SESSION['adminConsole_userID'];
$explPriv      = $obj->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
$noAdd         = $explPriv['add'];
$strFileNameImage="";

if ($noAdd == 1 && $id == 0)
	echo "<script>location.href = '" . APP_URL . "viewImpServices/" . $glId . "/" . $plId . "'</script>";


//=========== For editing ======================
if (isset($_REQUEST['ID'])) {
	//============ Read value for updation ===========	
	$result          = $obj->readImpServices($id);
	//print_r($result);exit;
	$intCategory     = $result['intCategory'];
	$strHeadlineE    = $result['strHeadlineE'];
	$strUrl          = $result['strUrl'];
	$strDetailsE     = $result['strDetailsE'];
	$strFileName     = $result['strFileDoc'];
	//$DateTime        = $result['strdate'];
	$intPubSts   = $result['radPubSts'];
	$intLinkType = $result['intLinkType'];
	$intTemplateType = $result['intTemplateType'];
	$intWinStatus    = $result['intWinStatus'];
	$intArc          = $result['intArc'];
	$redirectLoc        =  APP_URL . "viewImpServices/" . $glId . "/" . $plId;
	$strFileNameImage = ($result['strImage'] !="")?$result['strImage']:'';
}

//============ Button Submit ===================
if (isset($_POST['btnSubmit'])) {
	$result          = $obj->addUpdateImpServices($id);
	$outMsg          = $result['msg'];
	//  echo $outMsg;
	$flag            = $result['flag'];
	/* $strHeadlineE     = htmlspecialchars_decode($result['strHeadLineE'], ENT_QUOTES);
	$strHeadlineO     = htmlspecialchars_decode($result['strHeadLineO'], ENT_QUOTES);
	$strDetailsE     = htmlspecialchars_decode($result['strDetailsE'], ENT_QUOTES);
	$strDetailsO     = htmlspecialchars_decode($result['strDetailsO'], ENT_QUOTES);;
	$intCategory     = $result['intCategory'];
	$strUrl          = $result['strUrl'];
	$strFileName     = $result['strFileDoc'];
	//$DateTime        = $result['strdate'];
	$intLinkType =    $result['intLinkType'];
	$intTemplateType = $result['intTemplateType'];
	$intWinStatus    = $result['intWinStatus'];
	$intPluginId     = $result['intPluginId'];
	$intPubSts   = $result['radPubSts'];
	$intArc          = $result['intArc'];
	$redirectLoc      =  APP_URL . "viewImpServices/" . $glId . "/" . $plId; */
}
