<?php
	/* ================================================
	File Name         	: addProfileInner.php
	Description		: This page is used to add Profile.
	Developed By		: Rajesh Kumar Sahoo	
	Developed On		: 20-May-2021
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsOfficers
	Functions Used		: readProfile(),addUpdateProfile(),
	==================================================*/	
	
	
	$objProfile  = new clsOfficers;
	$id          = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
	$strSubmit   =($id>0)?'Update':'Submit';
	$strReset    =($id>0)?'Cancel':'Reset';
	$strTab	     =($id>0)?'Edit':'Add';
	$strclick		=($id>0)?"window.location.href='". APP_URL."viewProfile/".$glId."/".$plId."';":"";
	//=========== For Permission======================
	$glId          = $_REQUEST['GL'];
	$plId          = $_REQUEST['PL'];
	$pageName      = $_REQUEST['PAGE'].'.php';
	$userId        = $_SESSION['adminConsole_userID'];
	$explPriv      = $objProfile->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
	$noAdd         = $explPriv['add'];
        
	if ($noAdd == 1 && $id==0)
		echo "<script>location.href = '".APP_URL."viewProfile/".$glId."/".$plId."'</script>"; 
        
	//========== Default variable ===============			
	
	$flag               = 0;  
	$errFlag            = 0;
	$intLinkType        = 1; 
	$outMsg             = '&nbsp;';	
	$strImageFile       = '';
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
                    
		$btnValue	  = 'Update';
		$strTab	  = 'Edit';		

		//============ Read value for updation ===========	
		$result          = $objProfile->readProfile($id);
		$intType =  $result['intType'];           
		$vchOfficerName        =  $result['vchOfficerName'];           
		$strjoindate        =  $result['strjoindate']; 
		$strleavedate =  $result['strleavedate'];           
		$strImageFile        =  $result['strImageFile'];  
		$intOrderno        =  $result['intOrderno'];  
            
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
		$result          = $objProfile->addUpdateProfile($id);
		$outMsg          =  $result['msg'];  
		$flag            =  $result['flag'];
		$strOfficerNameE =  $result['strOfficerNameE'];          
		$strDesgE        =  $result['strDesgE'];         
		$strQuliE        =  $result['strQuliE'];           
		$intLinkType     =  $result['intLinkType'];
		$strUrl          =  $result['strUrl'];
		$strMob           =  $result['strMobno'];
		$redirectLoc     = APP_URL."viewProfile/".$glId."/".$plId;
           
	}
