<?php
    /* ================================================
    File Name         	: viewLinkInner.php
    Description		: This page is used to view links.
    Author Name		:  T Ketaki Debadarshini
    Date Created	: 04-Sept-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsLink
    Functions Used	: manageLink,deleteRule
    ==================================================*/
    $objLink     = new clsLink;	
    $isPaging      = 0;
    $pgFlag	   = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	   = 0;
    $strHeadlineE  = '';
    $strlinkcatType = 0;
    //======================= Permission ===========================*/
    $glId          = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
    $pageName       = $_REQUEST['PAGE'].'.php';
    $userId         = $_SESSION['adminConsole_userID'];
    $explPriv       = $objLink->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
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
         //============= search function =================
         if(isset($_REQUEST['btnSearch']))
        {
            $strHeadlineE	= (isset($_REQUEST['txthead'])&& $_REQUEST['txthead']!='')?trim(htmlspecialchars($_REQUEST['txthead'],ENT_QUOTES)):'';
                    $strlinkcatType	= ($_REQUEST['linkcatType']!=0)?trim(htmlspecialchars($_REQUEST['linkcatType'],ENT_QUOTES)):0;
            
        }
         //============= Delete/Active/Inactive function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	{
        //print_r($_REQUEST); exit;
		$qs	= $_REQUEST['hdn_qs'];
		$ids	= $_REQUEST['hdn_ids'];
        
		$outMsg	= $objLink->deleteLink($qs,$ids);
	}
    if($isPaging==0)	
        $result		= $objLink->manageLink('PG',$intRecno,$strHeadlineE,'','','',0,0,0,0,$strlinkcatType,'');
		  
	else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objLink->manageLink('V',0,$strHeadlineE,'','','',0,0,0,0,$strlinkcatType,'');
	}
       $totalResult                 = $objLink->manageLink('V',0,$strHeadlineE,'','','',0,0,0,0,$strlinkcatType,'');
       $intTotalRec                 = $totalResult->num_rows; 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>