<?php
    /* ================================================
    File Name         	: viewImpServicesInner.php
    Description		: This page is used to view Important Services Details.
    Author Name		: Ashis Kumar Patra
    Date Created	:06-Oct-2016
    Update History	:
    <Updated by>		<Updated On>		<Remarks>
      
    Class Used		: clsImpServices
    Functions Used	: manageImpServices,deleteImpServices
    ==================================================*/
    $obj             = new clsImpServices;	
    $isPaging        = 0;
    $pgFlag          = 0;
    $intPgno         = 1;
    $intRecno        = 0;
    $ctr             = 0;
    $intCategory     = 0;
    $intCattype      = 0;
    $intplugintype   = 0;
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
        
        $intCategory	  = (isset($_REQUEST['selCategory'])&& $_REQUEST['selCategory']!='')?$_REQUEST['selCategory']:'0';
        $txtHeadE         = (isset($_REQUEST['txtheadE'])&& $_REQUEST['txtheadE']!='')?trim(htmlspecialchars($_REQUEST['txtheadE'],ENT_QUOTES)):'';
       
        //============= search function =================
         if(isset($_REQUEST['btnSearch']))
	{
            $intPgno	= 1;
            $intRecno	= 0;
	}
         //============= Delete/Active/Inactive function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='')
	{
		$qs	= $_REQUEST['hdn_qs'];
		$ids	= $_REQUEST['hdn_ids'];
		$outMsg	= $obj->deleteImpServices($qs,$ids);
	}
        if($isPaging==0){	
            $result		= $obj->manageImpServices('PG',$intRecno,$intCategory,0,0,0,0,$txtHeadlineE,'','','','','',0,0,1);
             //print_r($result);
        }else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $obj->manageImpServices('V',0,$intCategory,0,0,0,0,$txtHeadlineE,'','','','','',0,0,1);
           
	}
       $totalResult                 = $obj->manageImpServices('V',0,$intCategory,0,0,0,0,$txtHeadlineE,'','','','','',0,0,1);      
       $intTotalRec                 = $totalResult->num_rows; 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>