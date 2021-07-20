<?php
    /* ================================================
    File Name         	: addNewsInner.php
    Description		: This page is used to add News Details.
    Developed By	: Madhulita Sahoo
    Developed On	: 23-May-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsUserProfile
    Functions Used	: readUser(),addUpdateuser(),
    ==================================================*/	
	//========== create object of clsUserProfile class===============	
	$objUser        = new clsUserProfile;	
        $id             = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit      = ($id>0)?'Update':'Submit';
	$strReset       = ($id>0)?'Cancel':'Reset';
	$strTab         = ($id>0)?'Edit':'Add';
        $strclick       = ($id>0)?"window.location.href='". APP_URL."viewUser/".$glId."/".$plId."';":"";
        //========== Permission ===============	
        $glId           = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objUser->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewUser/".$glId."/".$plId."'</script>";                     
               
	//========== Default variable ===============				
	$intWinStatus    = 1;
	$flag            = 0;  
        $errFlag         = 0;
        $intGender       = 1;	
	$outMsg          = '&nbsp;';
        $strPassword     ='';
        //========== Get user max serial no ===========
	$maxSL		= $objUser->getUserSlNo();
	
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{          
            //============ Read value for updation ===========	
            $result          = $objUser->readUser($id);
            $strFullname     =  htmlspecialchars_decode($result['strFullname'],ENT_QUOTES);                   
            $intLocId        =  $result['intLocId'];
            $intDeptId       =  $result['intDeptId']; 
            $intDesigId      =  $result['intDesigId']; 
            $intGender       =  $result['intGender']; 
            $strQualification      =  htmlspecialchars_decode($result['strQualification'],ENT_QUOTES);
            $maxSL         =  $result['intSlno']; 
            $strPhno         =  $result['strPhno'];
            $intMobileNo        =  $result['strMobno'];
            
            $strEmail         =  $result['strEmail']; 
            $strImageFile      =  $result['strFileName'];
            $strUserid        =  $result['strUserid'];            
            $intAdminPrivilege      =  $result['intAdminpre'];
            $intPrivilege     =  $result['intPrevilage'];
            $strPassword      =  $result['strPassword'];
            $readOnly			= 'readonly="readonly"';
           
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result        = $objUser->addUpdateuser($id);
           $outMsg        =  $result['msg']; 
           $flag          =  $result['flag'];          
            $strFullname     =  htmlspecialchars_decode($result['strFullname'],ENT_QUOTES);                   
            $intLocId        =  $result['intLocId'];
            $intDeptId       =  $result['intDeptId']; 
            $intDesigId      =  $result['intDesigId']; 
            $intGender       =  $result['intGender']; 
            $strQualification      =  htmlspecialchars_decode($result['strQualification'],ENT_QUOTES);
            $maxSL         =  $result['intSlno']; 
            $strPhno         =  $result['strPhno'];
            $intMobileNo        =  $result['strMobno'];
            
            $strEmail         =  $result['strEmail']; 
            $strImageFile      =  $result['strFileName'];
            $strUserid        =  $result['strUserid'];            
            $intAdminPrivilege      =  $result['intAdminpre'];
            $intPrivilege     =  $result['intPrevilage'];
            
	}
        ?>