<?php
	/* ================================================
	File Name         	: addWebdirectoryInner.php
	Description		: This page is used to add Webdirectory 
	Developed By		: Chinmayee
	Developed On		: 27-MAy-2016
	Update History		:
	<Updated by>		<Updated On>		<Remarks>
     
	Class Used		: clsDirectory
	Functions Used		: readDirectory(),addUpdateDirectory(),
	==================================================*/	
	
	$obj                = new clsDirectory;	
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewWebdirectory/".$glId."/".$plId."';":"";
	//========== Default variable ===============	
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intCategory        = 0;
        $selplugintype          =0;
        $intType            = 0;
        $intStatus          = 2;
       //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $obj->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewWebdirectory/".$glId."/".$plId."'</script>";  
	

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
          
           $result          = $obj->addUpdateDirectory($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strname        = htmlspecialchars_decode($result['strname'],ENT_QUOTES);  
           $strdegs        = htmlspecialchars_decode($result['strdegs'],ENT_QUOTES);
           $strnameO       = htmlspecialchars_decode($result['strnameO'],ENT_QUOTES);  
           $strdegsO       = htmlspecialchars_decode($result['strdegsO'],ENT_QUOTES);
           $stremail       = htmlspecialchars_decode($result['stremail'],ENT_QUOTES);  
           $strfax         = $result['strfax'];
           $intStatus      = $result['stractive'];
           $selplugintype  = $result['intType'];
           $strpbx         = $result['strpbx'];
           $strFileName     =  $result['strFileName'];
           $intCategory     = $result['intCategory']; 
           $redirectLoc     = APP_URL.'viewWebdirectory/'.$glId.'/'.$plId;
	}
        
        //=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
           
            //============ Read value for updation ===========	
           $result         = $obj->readDirectory($id);
           $strCategory    = $result['intCategory'];
           $strname        = htmlspecialchars_decode($result['strname'],ENT_QUOTES);  
           $strdegs        = htmlspecialchars_decode($result['strdegs'],ENT_QUOTES);
           $strnameO       = htmlspecialchars_decode($result['strnameO'],ENT_QUOTES);  
           $strdegsO       = htmlspecialchars_decode($result['strdegsO'],ENT_QUOTES);
           $stremail       = htmlspecialchars_decode($result['stremail'],ENT_QUOTES);  
           $strfax         = $result['strfax'];
           $strFileName    =  $result['strdoc'];
           $intStatus      = $result['stractive'];
           $selplugintype  = $result['intType'];
           $strpbx         = $result['strpbx'];
           $intSlNo        = $result['intslno'];
           $redirectLoc     = APP_URL.'viewWebdirectory/'.$glId.'/'.$plId;
                 
            
	}
       
?>