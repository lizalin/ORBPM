<?php
/* ================================================
  File Name         	  : complaintInner.php
  Description		  : This page is to view feedback and complain.
  Date Created            : 13-Aug-2015
  Devloped By		  : T Ketaki Debadarshini
  Devloped On		  : 13-Aug-2015
  Update History	  :
  <Updated by>		<Updated On>		<Remarks>
  Include Functions	  : viewConstructionType(), deleteConstructionType()
================================================== */
//================= Call to clsManageHelpDesk class ===========================
include_once(APP_CLASS_PATH."clsMangePortalFeedBack.php");
    $objFeedBack = new ClsMangePortalFeedBack();

//================setting default value for Paging================
    $isPaging   = 0;
    $pgFlag     = 0;
    $intPgno    = 1;
    $intRecno   = 0;
    $ctr        = 0;
//======================= Permission ===========================*/
    $glId          = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
    $pageName       = $_REQUEST['PAGE'].'.php';
    $userId         = $_SESSION['adminConsole_userID'];
    $explPriv       = $objFeedBack->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
    $editPriv       = $explPriv['edit'];
    $deletePriv     = $explPriv['delete'];
    $noAdd          = $explPriv['add'];
    $noActive       = $explPriv['active'];
    $noPublish      = $explPriv['publish'];
    
//======================= Pagination ===========================*/
	
    if ($_REQUEST['hdn_IsPaging']!="" && $_REQUEST['hdn_IsPaging'] >0)
        $isPaging = 1;
    if ($_REQUEST['hdn_PageNo']!=""  && $_REQUEST['hdn_PageNo'] >0) {
        $intPgno=$_REQUEST['hdn_PageNo'];
        $pgFlag	= 1;
    }
    if ($_REQUEST['hdn_RecNo']!=""  && $_REQUEST['hdn_RecNo'] >0) {	
        $intRecno=$_REQUEST['hdn_RecNo'];
        $pgFlag	= 1;
    }
    if ($isPaging==0 && $_REQUEST['hdn_PageNo']=='' && $_REQUEST['ID']>0) {
        $intRecno	= (isset($_SESSION['paging']['recNo']) && $_SESSION['paging']['recNo']>0)?$_SESSION['paging']['recNo']:$intRecno;
        $intPgno	= (isset($_SESSION['paging']['pageNo']) && $_SESSION['paging']['pageNo']>0)?$_SESSION['paging']['pageNo']:$intPgno;		
    } else {
        unset($_SESSION['paging']);
    }
    //============= Delete Records ================================	
    if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
    {
            $qs         = $_REQUEST['hdn_qs'];
            $ids	= $_REQUEST['hdn_ids'];
            $outMsg	= $objFeedBack->deleteFeedBack($qs,$ids);
    }
    //======================== Take Action for query======================================================
    if(isset($_REQUEST['btnTakeAction'])) {
        $hdnFid         = $_REQUEST['hdnFid'];
        $result         = $objFeedBack->UpdateFeedBack($hdnFid);
        $adminRemark    = $result['strRemark'];
        $outMsg         = $result['msg'];
    }
    ////======================= Value For Filter Search ===========================*/
    if(isset($_REQUEST['btnSearch'])) {
        $intPgno = 1;
        $intRecno = 0;
    }
        $txtSubj	= (isset($_REQUEST['selSubj']))?trim(htmlspecialchars($_REQUEST['selSubj'],ENT_QUOTES)):'';

    //=================== View feedBack records ================================
    if ($isPaging==0) {
        $result		= $objFeedBack->viewFeedBack('PG', $intRecno, $txtSubj);
    } else {
        $intPgno	= 1;
        $intRecno	= 0;
        $result		= $objFeedBack->viewFeedBack('V', 0, $txtSubj);
    }

    $totalResult	= $objFeedBack->viewFeedBack('V', 0, $txtSubj);
    $intTotalRec	= count($totalResult);
    $intCurrPage	= $intPgno;
    $intPgSize		= 10;
    $_SESSION['paging']['recNo']		= $intRecno;
    $_SESSION['paging']['pageNo']               = $intPgno;