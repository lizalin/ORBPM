<?php
    /* ================================================
    File Name         	: archievePlugindetailsInner.php
    Description		: This page is used to view archive plugin details.
    Author Name		: T Ketaki Debadarshini
    Date Created	: 10-Sept-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsPlugin
    Functions Used	: managePlugin,deletePlugin
    ==================================================*/
    $objPlugin     = new clsPlugin;	
    $isPaging      = 0;
    $pgFlag	   = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	   = 0;
    $strHeadlineE  = '';
    $startDate     = '0000-00-00';
    $endDate       = '0000-00-00';
    $strDate       ='';
    $endDatee      ='';
   
    $intfuncId          =$_SESSION['sessFuncId'];
    //======================= Permission ===========================*/
    $glId           = $_REQUEST['GL'];
    $plId           = $_REQUEST['PL'];
    $pageName       = $_REQUEST['PAGE'].'.php';
    $userId        = $_SESSION['adminConsole_userID'];
    $explPriv       = $objPlugin->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
    $deletePriv     = $explPriv['delete'];
    $noAdd          = $explPriv['add'];
    $noActive       = $explPriv['active'];
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
		$strHeadlineE	= $_REQUEST['txtHeadLineE'];
                $startDate	= (isset($_POST['txtStartDt'])&& $_POST['txtStartDt']!='')?$objPlugin->dbDateFormat($_POST['txtStartDt']):'0000-00-00';
                $endDate        = (isset($_POST['txtEndDt'])&& $_POST['txtEndDt']!='')?$objPlugin->dbDateFormat($_POST['txtEndDt']):'0000-00-00';   
                 if($startDate=='0000-00-00')
                     $strDate='';
                 else 
                     $strDate= $_POST['txtStartDt'];
                  if($endDate=='0000-00-00')
                     $endDatee='';
                 else 
                     $endDatee= $_POST['txtEndDt'];
		
	}
        
        
         //============= Delete/Active/Inactive function =================
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	{
		$qs	= $_REQUEST['hdn_qs'];
		$ids	= $_REQUEST['hdn_ids'];
		$outMsg	= $objPlugin->deletePlugin($qs,$ids);
	}
        if($isPaging==0)	
            $result		= $objPlugin->managePlugin('PG',$intRecno,$intfuncId,0,$strHeadlineE,'','',0,1,0,$startDate,$endDate,0);		  
	else
	{
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objPlugin->managePlugin('V',0,$intfuncId,0,$strHeadlineE,'','',0,1,0,$startDate,$endDate,0);
	}
       $totalResult                 = $objPlugin->managePlugin('V',0,$intfuncId,0,$strHeadlineE,'','',0,1,0,$startDate,$endDate,0);
       $intTotalRec                 =($totalResult->num_rows); 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;
      
        
        
    
?>