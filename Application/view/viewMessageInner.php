<?php

    /* ================================================
    File Name       : viewMessageInner.php
    Description		: This page is used to view messages for contactus pages.
    Devloper Name	: Indrani
    Date Created	: 23-Dec-2020
    Update History	:
    <Updated by>	<Updated On>		<Remarks>

    Class Used		: clsMessage
    Functions Used	: webPath(),checkPrivilege(),deleteMessage(),manageMessage()
    ================================================== */

    include_once(ABS_PATH."Application/controller/clsMessage.php");
    $obj      = new clsMessage;	
    $isPaging      = 0;
    $pgFlag	       = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	       = 0;
    $selPageType   = 0;
    //======================= Permission ===========================*/
    $glId          = $_REQUEST['GL'];
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

    $selPageType     = (isset($_REQUEST['selPageType']) && $_REQUEST['selPageType']>0)?trim(htmlspecialchars($_REQUEST['selPageType'],ENT_QUOTES)):'0';

    //============= search function =================
     if(isset($_REQUEST['btnSearch']))
    {
            $intPgno    = 1;
            $intRecno   = 0;
    }
                      
   //============= Delete/Active function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	{
		$qs	= $_REQUEST['hdn_qs'];
		$ids	= $_REQUEST['hdn_ids'];
		$outMsg	= $obj->deleteMessage($qs,$ids);
	}
        if($isPaging==0)	
            $result		= $obj->manageMessage('PG',$intRecno,$selPageType,'','',0,0,0,'','',0,0);
	
       else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $obj->manageMessage('V',0,$selPageType,'','',0,0,0,'','',0,0);
	}
       $totalResult                 = $obj->manageMessage('V',0,$selPageType,'','',0,0,0,'','',0,0);  
       $intTotalRec                 = ($totalResult->num_rows); 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>