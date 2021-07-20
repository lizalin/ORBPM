<?php
	/* ================================================
	File Name         	: addDepartmentInner.php
	Description		: This page is used to add department details
	Developed By		: T Ketaki Debadarshini
	Developed On		: 10-Sept-2015
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsDepartment
	Functions Used		: readDepartment(),addUpdateDepartment(),
	==================================================*/	
	
	$objDept            = new clsDepartment;	
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewDepartment/".$glId."/".$plId."';":"location.reload();";
	//========== Default variable ===============	
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intStatus          = 2;
        $intLocation        = 0;
       //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objDept->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewDepartment/".$glId."/".$plId."'</script>";   
       
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
           
            //============ Read value for updation ===========	
           $result          = $objDept->readDepartment($id);
           $intLocation     = $result['intLocation'];
           $strDepartment     = $result['strDepartment'];  
           $strDescription  = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
         
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objDept->addUpdateDepartment($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           
           $intLocation     = $result['intLocation'];
           $strDepartment   = htmlspecialchars_decode($result['strDepartment'],ENT_QUOTES);  
           $strDescription  = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
        
	}
       
?>