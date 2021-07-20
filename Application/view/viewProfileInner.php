<?php
/* ================================================
    File Name         	: viewProfileInner.php
    Description		: This page is used to view Officer profile.
    Developed By		: Rajesh Kumar Sahoo	
	Developed On		: 20-May-2021	
    Update History	:
    <Updated by>		<Updated On>		<Remarks>
    ==================================================*/
$objProfile  = new clsOfficers;
$isPaging      = 0;
$pgFlag       = 0;
$intPgno       = 1;
$intRecno       = 0;
$ctr       = 0;
//======================= Permission ===========================*/
$glId          = $_REQUEST['GL'];
$plId           = $_REQUEST['PL'];
$pageName       = $_REQUEST['PAGE'] . '.php';
$userId         = $_SESSION['adminConsole_userID'];
$explPriv       = $objProfile->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
$editPriv       = $explPriv['edit'];
$deletePriv     = $explPriv['delete'];
$noAdd          = $explPriv['add'];
$noActive       = $explPriv['active'];
$noPublish      = $explPriv['publish'];

//======================= Pagination ===========================*/

if ($_REQUEST['hdn_IsPaging'] != "" && $_REQUEST['hdn_IsPaging'] > 0)
    $isPaging = 1;
if ($_REQUEST['hdn_PageNo'] != ""  && $_REQUEST['hdn_PageNo'] > 0) {
    $intPgno = $_REQUEST['hdn_PageNo'];
    $pgFlag    = 1;
}
if ($_REQUEST['hdn_RecNo'] != ""  && $_REQUEST['hdn_RecNo'] > 0) {
    $intRecno = $_REQUEST['hdn_RecNo'];
    $pgFlag    = 1;
}
if ($isPaging == 0 && $_REQUEST['hdn_PageNo'] == '' && $_REQUEST['ID'] > 0) {
    $intRecno    = (isset($_SESSION['paging']['recNo']) && $_SESSION['paging']['recNo'] > 0) ? $_SESSION['paging']['recNo'] : $intRecno;
    $intPgno    = (isset($_SESSION['paging']['pageNo']) && $_SESSION['paging']['pageNo'] > 0) ? $_SESSION['paging']['pageNo'] : $intPgno;
} else{
    unset($_SESSION['paging']);
    //============= Delete/Active/Inactive function =================
    if (isset($_REQUEST['hdn_qs']) && $_REQUEST['hdn_qs'] != '') {

        $qs    = $_REQUEST['hdn_qs'];
        $ids    = $_REQUEST['hdn_ids'];
        $outMsg    = $objProfile->deleteActiveProfile($qs, $ids);
    }
    //$action, $officerId, $officerType, $officerName, $joiningDate,$retirementDate,$officerFile,$pubStatus,$createdBy
    if ($isPaging == 0)
        $result        = $objProfile->manageOfficer('PG', $intRecno, '0', '', '', '', '', 0, 0);

    else {
        $intPgno    = 1;
        $intRecno    = 0;
        $result                 = $objProfile->manageOfficer('V', 0, 0, '', '', '', '', 0, 0);
    }

    $totalResult                 = $objProfile->manageOfficer('V', 0, 0, '', '', '', '', 0, 0);
    $intTotalRec                 = ($totalResult->num_rows);
    $intCurrPage                 = $intPgno;
    $intPgSize                   = 10;
    $_SESSION['paging']['recNo'] = $intRecno;
    $_SESSION['paging']['pageNo'] = $intPgno;
}
    
