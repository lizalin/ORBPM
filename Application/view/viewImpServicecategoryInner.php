<?php
    /* ================================================
    File Name         	: viewWebdirectoryInner.php
    Description		: This page is used to view directory Details.
    Author Name		: Chinmayee
    Date Created	: 31-May-2016
    Update History	:
    <Updated by>		<Updated On>		<Remarks>
      
    Class Used		: clsDirectory
    Functions Used	: manageDirectory,deleteDirectory
    ==================================================*/
//print_r($_REQUEST);exit;selCat
    $obj             = new clsImportantServicesCategory;	
    $isPaging        = 0;
    $pgFlag          = 0;
    $intPgno         = 1;
    $intRecno        = 0;
    $ctr             = 0;
    $intCategory     = 0;
    $intCattype      = 0;
    $selplugintype   = 0;
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
        
        //$selplugintype	  = (isset($_REQUEST['selCategory'])&& $_REQUEST['selCategory']!='')?trim(htmlspecialchars($_REQUEST['selCategory'],ENT_QUOTES)):'0';
        $selCat	  = (isset($_REQUEST['catName'])&& $_REQUEST['catName']!='')?$_REQUEST['catName']:' ';
       
       // $txthead          = (isset($_REQUEST['txthead'])&& $_REQUEST['txthead']!='')?trim(htmlspecialchars($_REQUEST['txthead'],ENT_QUOTES)):'';
        //$txtdesg          = (isset($_REQUEST['txtdesg'])&& $_REQUEST['txtdesg']!='')?trim(htmlspecialchars($_REQUEST['txtdesg'])):'';
       
        //============= search function =================
         if(isset($_REQUEST['btnSearch']))
	{
            $intPgno	= 1;
            $intRecno	= 0;
	}
         //============= Delete/Active/Inactive function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	{
		$qs	= $_REQUEST['hdn_qs'];
		$ids	= $_REQUEST['hdn_ids'];
		$outMsg	= $obj->deleteImpService($qs,$ids);
	}
        if($isPaging==0)	
            $result		= $obj->manageImpServiceCategory('PG',0,0,1,$selCat,'','','',0,$userId);              
	else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $obj->manageImpServiceCategory('V',0,0,1,$selCat,'','','',0,0,$userId);     
	}
       $totalResult                 = $obj->manageImpServiceCategory('V',0,0,1,$selCat,'','','',0,$userId);     
       $intTotalRec                 = $totalResult->num_rows; 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
       //echo $selCat;exit;
        
        
    
?>