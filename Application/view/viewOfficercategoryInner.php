<?php
    /* ================================================
    File Name         	: viewOfficercategoryInner.php
    Description		: This page is used to view Officer Category Details.
    Author Name		: Rajesh Kumar Sahoo
    Date Created	: 21-May-2021
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsGalleryCategory
    Functions Used	: 
    ==================================================*/
    $objOfficerCat   = new clsOfficerCategory;
    $isPaging        = 0;
    $pgFlag          = 0;
    $intPgno         = 1;
    $intRecno        = 0;
    $ctr             = 0;
    $intCattype      = 0;
    $selplugintype   = 0;
    //======================= Permission ===========================*/
    $glId           = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
    $pageName       = $_REQUEST['PAGE'].'.php';
    $userId         = $_SESSION['adminConsole_userID'];
    $explPriv       = $objOfficerCat->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
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
        
       
       $intCattype	= (isset($_REQUEST['selType'])&& $_REQUEST['selType']!='')?$_REQUEST['selType']:'0';
       $selplugintype	= (isset($_REQUEST['selplugin'])&& $_REQUEST['selplugin']!='')?$_REQUEST['selplugin']:'0';
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
            $outMsg	= $objOfficerCat->deleteOfficerCategory($qs,$ids);
	    }
        
        if($isPaging==0){	
            $result		= $objOfficerCat->manageOfficerCategory('PG', $intRecno,'','', 0, $userId);
        }else {
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objOfficerCat->manageOfficerCategory('V', 0,'','', 0,$userId);
        }
       $totalResult                 = $objOfficerCat->manageOfficerCategory('V', 0,'','',0, $userId);
       $intTotalRec                 = $totalResult->num_rows; 
      // echo $intTotalRec;
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 20;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
