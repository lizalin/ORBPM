<?php
	/* ================================================
	File Name         	: addLocationInner.php
	Description		: This page is used to add Location
	Developed By		: T Ketaki Debadarshini
	Developed On		: 10-Sept-2015
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsLocation
	Functions Used		: readLocation(),addUpdateLocation(),
	==================================================*/	
	
	$objLocation      = new clsLocation;	
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewLocation/".$glId."/".$plId."';":"location.reload();";
	//========== Default variable ===============	
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intStatus          = 2;
       //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objLocation->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewLocation/".$glId."/".$plId."'</script>";   
       
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
           
            //============ Read value for updation ===========	
           $result          = $objLocation->readLocation($id);
           $strLocation     = $result['strLocation'];  
           $strOfficeNO1     = $result['strOfficeNO1'];  
           $strOfficeNO2     = $result['strOfficeNO2'];  
           $strEmail     = $result['strEmail'];  
           $strDescription  = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
         
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objLocation->addUpdateLocation($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strLocation     = htmlspecialchars_decode($result['strLocation'],ENT_QUOTES);  
           $strDescription  = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
           $redirectLoc    =  ($flag==0)? APP_URL.'viewLocation/'.$glId.'/'.$plId:'';
        
	}
