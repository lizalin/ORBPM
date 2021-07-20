<?php
	/* ================================================
	File Name         	: addBannerInner.php
	Description		: This page is used to add Banner details
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsBanner
	Functions Used		: readBanner(),addUpdateBanner(),
	==================================================*/	
	
	$objBanner      = new clsBanner;	
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewBanner/".$glId."/".$plId."';":"location.reload();";
	//========== Default variable ===============	
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intCategory          = 0;
       //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objBanner->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewBanner/".$glId."/".$plId."'</script>";  
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{ 
            //============ Read value for updation ===========	
           $result           = $objBanner->readBanner($id);
           $strCaption       = htmlspecialchars_decode($result['strCaption'],ENT_QUOTES);
           $strCaptionO      = htmlspecialchars_decode($result['strCaptionO'],ENT_QUOTES); 
           $strDescription   = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
           $strFileName      =  $result['strFileName'];
           $intCategory      = $result['intCategory'];
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{         
           $result          = $objBanner->addUpdateBanner($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strCaption      = htmlspecialchars_decode($result['strCaption'],ENT_QUOTES);  
           $strCaptionO      = htmlspecialchars_decode($result['strCaptionO'],ENT_QUOTES);  
           $strFileName     =  $result['strFileName'];
          
	}
       
?>