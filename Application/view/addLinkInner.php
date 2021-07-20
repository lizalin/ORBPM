<?php
	/* ================================================
	File Name         	: addLinkInner.php
	Description		: This page is used to add Link Details.
	Developed By		: T Ketaki Debadarshini
	Developed On		: 04-Sept-2015
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsLink
	Functions Used		: readLink(),addUpdateLink(),
	==================================================*/	
	
	$objLink     = new clsLink;	
        $id          = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit   =($id>0)?'Update':'Submit';
	$strReset    =($id>0)?'Cancel':'Reset';
	$strTab	     =($id>0)?'Edit':'Add';
        $strclick    =($id>0)?"window.location.href='". APP_URL."viewLink/".$glId."/".$plId."';":"";
	//========== Default variable ===============				
	$intWinStatus       = 1;
	
        $intLinkType        = 1;
        $intTempletType      = 1;	
	$outMsg             = '&nbsp;';	
        $strURL            = "http://";
        $strLinkType         = 1;
        //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objLink->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewLink/".$glId."/".$plId."'</script>";   
	//=========== For editing ======================
	if(isset($_REQUEST['ID']) && $id>0)
	{
            //============ Read value for updation ===========	
            $result             = $objLink->readLink($id);
            //  print_r($result);
            $strHeadLineE       =  $result['strHeadLineE'];                      
            $strURL              =  $result['strURL']; 
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objLink->addUpdateLink($id);
           //print_r($result);
           $outMsg          =  $result['msg']; 
           $flag            =  $result['flag'];          
           $strHeadLineE    =  htmlspecialchars_decode($result['strHeadLineE'],ENT_QUOTES);
           $strURL          =  $result['strURL']; 
	}
       
?>