<?php
    /* ================================================
    File Name         	: archiveGalleryInner.php
    Description		: This page is used to view archived Gallery Details.
    Author Name		: Chinmayee
    Date Created	: 26-MAy-2016
    Update History	:
    <Updated by>		<Updated On>		<Remarks>
      
    Class Used		: clsGallery
    Functions Used	: manageGallery,deleteGallery
    ==================================================*/
    $objGallery      = new clsGallery;	
    $isPaging      = 0;
    $pgFlag	   = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	   = 0;
    $intCategory   = 0;
    $intCattype   = 0;
    $intplugintype = 0;
    $intscreenType = 0;
    //======================= Permission ===========================*/
    $glId          = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
    $pageName       = $_REQUEST['PAGE'].'.php';
    $userId         = $_SESSION['adminConsole_userID'];
    $explPriv       = $objGallery->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
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
        
        $intCategory	  = (isset($_REQUEST['selCategory'])&& $_REQUEST['selCategory']!='')?htmlspecialchars($_REQUEST['selCategory'],ENT_QUOTES):'0';
        $intCattype       = (isset($_REQUEST['selType'])&& $_REQUEST['selType']!='')?htmlspecialchars($_REQUEST['selType'],ENT_QUOTES):'0';
        $intplugintype    = (isset($_REQUEST['ddlPlugin'])&& $_REQUEST['ddlPlugin']!='')?htmlspecialchars($_REQUEST['ddlPlugin'],ENT_QUOTES):'0';
        $intscreenType    = (isset($_REQUEST['selScreen'])&& $_REQUEST['selScreen']!='')?htmlspecialchars($_REQUEST['selScreen'],ENT_QUOTES):0;
        //============= search function =================
         if(isset($_REQUEST['btnSearch']))
	{
            $intCategory = $_REQUEST['selCategory'];
            $intCattype	= $_REQUEST['selType'];
            $intscreenType = $_REQUEST['selScreen'];
            $intPgno	= 1;
            $intRecno	= 0;
	}
         //============= Delete/Active/Inactive function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	{
		$qs	= $_REQUEST['hdn_qs'];
		$ids	= $_REQUEST['hdn_ids'];
		$outMsg	= $objGallery->deleteGallery($qs,$ids);
	}
        if($isPaging==0)	
            $result		= $objGallery->manageGallery('PG',$intRecno,$intCattype,$intplugintype,$intCategory,0,'','','','','','','',0,1,0,'',$intscreenType);              
	else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objGallery->manageGallery('V',0,$intCattype,$intplugintype,$intCategory,0,'','','','','','','',0,1,0,'',$intscreenType);      
	}
       $totalResult                 = $objGallery->manageGallery('V',0,$intCattype,$intplugintype,$intCategory,0,'','','','','','','',0,1,0,'',$intscreenType);      
       $intTotalRec                 = $totalResult->num_rows; 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 20;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>