<?php
    /* ================================================
    File Name         	: viewLocationInner.php
    Description		: This page is used to view Location Details.
    Author Name		: T Ketaki Debadarshini
    Date Created	: 10-Sept-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsLocation
    Functions Used	: 
    ==================================================*/
    /* ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); */
    $objLocation      = new clsLocation;	
    $isPaging      = 0;
    $pgFlag	   = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	   = 0;
    //======================= Permission ===========================*/
    $glId          = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
    $pageName       = $_REQUEST['PAGE'].'.php';
    $userId         = $_SESSION['adminConsole_userID'];
    $explPriv       = $objLocation->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
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
        
       
         //============= Delete/Active/Inactive function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	{
		$qs	= $_REQUEST['hdn_qs'];
		$ids	= $_REQUEST['hdn_ids'];
        //echo $qs	;exit;
		$outMsg	= $objLocation->deleteLocation($qs,$ids);
	}
        if($isPaging==0)	
            $result		= $objLocation->manageLocation('PG',$intRecno,'','','','','','',$userId);		  
	else                                    
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objLocation->manageLocation('V',0,'','','','','','',$userId);
	}
       $totalResult                 = $objLocation->manageLocation('V',0,'','','','','','',$userId);
       $intTotalRec                 = mysqli_num_rows($totalResult); 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>