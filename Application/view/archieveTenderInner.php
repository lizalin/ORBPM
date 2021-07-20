<?php
    /* ================================================
    File Name         	: archieveTenderInner.php
    Description		: This page is used to view archived Tenders.
    Author Name		: T Ketaki Debadarshini
    Date Created	: 15-Sept-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsTender
    Functions Used	: 
    ==================================================*/
    $objTender      = new clsTender;	
    $isPaging      = 0;
    $pgFlag	   = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	   = 0;
    //======================= Permission ===========================*/
    $glId          = $_REQUEST['GL'];
    $plId          = $_REQUEST['PL'];
    $pageName      = $_REQUEST['PAGE'].'.php';
    $userId         = $_SESSION['adminConsole_userID'];
    $explPriv       = $objTender->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
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
        
        $strHeadline	= (isset($_REQUEST['txtHeadLineE'])&& $_REQUEST['txtHeadLineE']!='')?$_REQUEST['txtHeadLineE']:'';
        $strTenderNo     = (isset($_REQUEST['txtTenderno'])&& $_REQUEST['txtTenderno']!='')?$_REQUEST['txtTenderno']:'';
        
         //============= search function =================
         if(isset($_REQUEST['btnSearch']))
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $strHeadline	= $_REQUEST['txtHeadLineE'];
            $strTenderNo	= $_REQUEST['txtTenderno'];
	}
         //============= Delete/Active/Inactive function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	{
            $qs	= $_REQUEST['hdn_qs'];
            $ids	= $_REQUEST['hdn_ids'];
            $outMsg	= $objTender->deleteTender($qs,$ids);
	}
        if($isPaging==0)	
        $result		= $objTender->manageTender('PG',$intRecno,$strTenderNo,$strHeadline,'0000-00-00','0000-00-00','','',0,1,0,0);
		  
	else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objTender->manageTender('V',0,$strTenderNo,$strHeadline,'0000-00-00','0000-00-00','','',0,1,0,0);
	}
       $totalResult                 = $result                 = $objTender->manageTender('V',0,$strTenderNo,$strHeadline,'0000-00-00','0000-00-00','','',0,1,0,0);
       $intTotalRec                 = mysqli_num_rows($totalResult); 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>