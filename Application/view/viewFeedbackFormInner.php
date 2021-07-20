<?php
    /* ================================================
    File Name         	: viewFeedbackFormInner.php
    Description		    : This page is used to view Feedback.
    Created By		    : Ajmal Akhtar
    Created On	        : 23-Dec-2020
    Update History	    :
    <Updated by>		<Updated On>		<Remarks>
    Class Used		    : clsFeedbackForm.php
    ==================================================*/
    include_once(APP_CLASS_PATH."clsFeedbackForm.php");
    $objFeedback     = new clsFeedback;
    $isPaging        = 0;
    $pgFlag          = 0;
    $intPgno         = 1;
    $intRecno        = 0;
    //======================= Permission ===========================*/
    $glId           = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
    $pageName       = $_REQUEST['PAGE'].'.php';
    $userId         = $_SESSION['adminConsole_userID'];
    $explPriv       = $obj->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
    $editPriv       = $explPriv['edit'];
    $deletePriv     = $explPriv['delete'];
    $noAdd          = $explPriv['add'];
    $noActive       = $explPriv['active'];
    $noPublish      = $explPriv['publish'];
    //======================= Pagination ===========================*/
	
	if($_REQUEST['hdn_IsPaging']!="" && $_REQUEST['hdn_IsPaging'] >0)
		$isPaging=1;
	if($_REQUEST['hdn_PageNo']!=""  && $_REQUEST['hdn_PageNo'] >0)
	{
		$intPgno=$_REQUEST['hdn_PageNo'];
		$pgFlag	= 1;
	}
	if($_REQUEST['hdn_RecNo']!=""  && $_REQUEST['hdn_RecNo'] >0)
	{	
		$intRecno=$_REQUEST['hdn_RecNo'];
		$pgFlag	= 1;
	}
	if($isPaging==0 && $_REQUEST['hdn_PageNo']=='' && $_REQUEST['ID']>0)
	{
		$intRecno	= (isset($_SESSION['paging']['recNo']) && $_SESSION['paging']['recNo']>0)?$_SESSION['paging']['recNo']:$intRecno;
		$intPgno	= (isset($_SESSION['paging']['pageNo']) && $_SESSION['paging']['pageNo']>0)?$_SESSION['paging']['pageNo']:$intPgno;		
	}
	else	
		unset($_SESSION['paging']);
        
        $txtName         = (isset($_REQUEST['txtName'])&& $_REQUEST['txtName']!='')?trim(htmlspecialchars($_REQUEST['txtName'],ENT_QUOTES)):'';
       
        //============= search function =================
         if(isset($_REQUEST['btnSearch']))
	{
            $intPgno	= 1;
            $intRecno	= 0;
	}

    //============= Delete/Active/Inactive function =================
    if(isset($_REQUEST['hdn_qs']) && $_REQUEST['hdn_qs']!='' )
    {
        $qs = $_REQUEST['hdn_qs'];
        $ids    = $_REQUEST['hdn_ids']; 
        $outMsg = $objFeedback->deleteFeedback($qs,$ids);
    }

        if($isPaging==0){
            $result		= $objFeedback->manageFeedback('PG',$intRecno,$txtName,'','','','','1000-01-01',0,0,0,'','',0,0); 
	}else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objFeedback->manageFeedback('V',0,'','','','','','1000-01-01',0,0,0,'','',0,0);      
	}
       $totalResult                 = $objFeedback->manageFeedback('V',0,$txtName,'','','','','1000-01-01',0,0,0,'','',0,0); 
       $intTotalRec                 = $totalResult->num_rows;
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
?>