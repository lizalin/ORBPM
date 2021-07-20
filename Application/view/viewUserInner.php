<?php
	/* ================================================
	File Name         	: viewUserInner.php
	Description		: This page is used to View User Profile.
	Author Name		: 
	Developer Name          : T Ketaki Debadarshini
	Date Created		: 29-Aug-2015
	Update History		:
							<Updated by>		<Updated On>		<Remarks>
							
	includes	        : 
	Functions Used		: manageUser(),checkPrivilege()
	
	
	==================================================*/
	$objUser      = new clsUserProfile;	
        $isPaging     = 0;
        $pgFlag       = 0;
        $intPgno	   = 1;
        $intRecno	   = 0;
        $ctr	   = 0;
        //======================= Permission ===========================*/
        $glId               = $_REQUEST['GL'];
        $plId               = $_REQUEST['PL'];
        $pageName           = $_REQUEST['PAGE'].'.php';
        $userId         = $_SESSION['adminConsole_userID'];
        $explPriv       = $objUser->checkPrivilege($userId, $glId, $plId, $pageName, 'V');
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
	//======================= Get control value ===========================*/
        $intLocation	= (isset($_REQUEST['ddlLocation'])&& $_REQUEST['ddlLocation']!='')?$_REQUEST['ddlLocation']:'0';
        $intDepartment	= (isset($_REQUEST['ddlDepartment'])&& $_REQUEST['ddlDepartment']!='')?$_REQUEST['ddlDepartment']:'0';	
	//===================== Remove pagination session value =======================
		
		if(isset($_POST['btnDelete']))
		{
                    $intPgno =1;
                    $intRecno=0;	
		}
		if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
                {
                    $qs	= $_REQUEST['hdn_qs'];
                    $ids	= $_REQUEST['hdn_ids'];	
                    $outMsg	= $objUser->deleteUser($qs, $ids);
                }
                $strUserName	= (isset($_REQUEST['txtUserName'])&& $_REQUEST['txtUserName']!='')?$_REQUEST['txtUserName']:'';
                 
		if(isset($_POST['btnSearch']))
		{
                    $intPgno =1;
                    $intRecno=0; 
                    $intLocation	= $_REQUEST['ddlLocation'];
                    $intDepartment	= $_REQUEST['ddlDepartment'];
		}
		//echo md5('aaaaaaa');	
		
		if($isPaging==0)	
                    $result		= $objUser->manageUser('PG',$intRecno,0,$intLocation,$intDepartment,0,$strUserName,0,'','','','','','','','','','','','',0,'0',0,0,0,0,0);                      
                else
                {
                    $intPgno	= 1;
                    $intRecno	= 0;
                    $result                 = $objUser->manageUser('V',0,0,$intLocation,$intDepartment,0,$strUserName,0,'','','','','','','','','','','','',0,'0',0,0,0,0,0);    
                }
               $totalResult                 = $objUser->manageUser('V',0,0,$intLocation,$intDepartment,0,$strUserName,0,'','','','','','','','','','','','',0,'0',0,0,0,0,0);    
               $intTotalRec                 = mysqli_num_rows($totalResult); 
               $intCurrPage                 = $intPgno;
               $intPgSize                   = 10;
               $_SESSION['paging']['recNo'] = $intRecno;
               $_SESSION['paging']['pageNo']= $intPgno;
		
?>
