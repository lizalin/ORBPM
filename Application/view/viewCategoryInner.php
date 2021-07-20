<?php
    /* ================================================
    File Name         	: viewcategoryInner.php
    Description		: This page is used to view Category Details.
    Author Name		: T Ketaki Debadarshini
    Date Created	: 18-Aug-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsCategory
    Functions Used	: 
    ==================================================*/
    $objCat      = new clsCategory;	
    $isPaging      = 0;
    $pgFlag	   = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	   = 0;
    //======================= Permission ===========================*/
    $glid          = $_COOKIE['GLink'];
    $plId          = $_COOKIE['PLink'];
    $userId        = $_SESSION['adminConsole_userID'];
    $intPermission = $objCat->getPermission($glid,$plId,$userId);
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
		$outMsg	= $objCat->deleteCategory($qs,$ids);
	}
        if($isPaging==0)	
            $result		= $objCat->manageCategory('PG', $intRecno, '','', '',0 ,$userId);
		  
	else                                    
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objCat->manageCategory('V', 0, '','', '',0 ,$userId);
	}
       $totalResult                 = $objCat->manageCategory('V', 0, '','', '',0 ,$userId);
       $intTotalRec                 = ($totalResult->num_rows); 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>