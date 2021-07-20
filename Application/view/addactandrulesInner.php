<?php
	/* ================================================
	File Name         	: addactandrulesInner.php
	Description		: This page is used to add Notification.
	Developed By		: Chinmayee
	Developed On		: 28-May-2016 
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsActRules
	Functions Used		: readActRules(),addUpdateActRules(),
	==================================================*/	
	
	$obj                = new clsActRules;	
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewactandrules/".$glId."/".$plId."';":"";
	//========== Default variable ===============	
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intStatus          = 2;
        //$selplugintype      = 0;
        $intCattype         = 0;
        $chkval             = 0;
        $strURL            = "http://";
       //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $obj->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewactandrules/".$glId."/".$plId."'</script>";   
       
	
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
           
            //============ Read value for updation ===========	
           $result          = $obj->readActRules($id);
           $strCategory     = $result['strCaption'];  
           $strCategoryO    = $result['strCaptionO']; 
           $strFileName     = $result['strdoc'];  
           $DateTime        = $result['strdate'];
           $strURL          = $result['intType'];
           $intStatus       = $result['stractive'];
           $chkval          = $result['strblink'];
           
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $obj->addUpdateActRules($id);
           $outMsg          = $result['msg']; 
         //  echo $outMsg;
           $flag            = $result['flag'];
           $strCategory     = htmlspecialchars_decode($result['txtHeadline'],ENT_QUOTES);  
           $strCategoryO    = htmlspecialchars_decode($result['txtHeadlineO'],ENT_QUOTES);
           $strURL           = $result['intCategory'];
           $intStatus       = $result['rbtLnkType']; 
           $redirectLoc     = APP_URL."viewactandrules/".$glId."/".$plId;
	}
       
?>