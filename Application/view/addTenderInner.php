<?php
    /* ================================================
    File Name         	: addTenderInner.php
    Description		: This page is used to add Tender Details.
    Developed By	: T Ketaki Debadarshini
    Developed On	: 11-Sept-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsTender
    Functions Used	: readTender(),addUpdateTender(),
    ==================================================*/	
	//========== create object of clsTender class===============	
	$objTender      = new clsTender;	
	$id             = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
	$strSubmit      = ($id>0)?'Update':'Submit';
	$strReset       = ($id>0)?'Cancel':'Reset';
	$strTab         = ($id>0)?'Edit':'Add';
	$strclick       = ($id>0)?"window.location.href='". APP_URL."viewTender/".$glId."/".$plId."';":"";
	//========== Permission ===============	
	$glId          = $_REQUEST['GL'];
	$plId          = $_REQUEST['PL'];
	$pageName      = $_REQUEST['PAGE'].'.php';
	$userId        = $_SESSION['adminConsole_userID'];
	$explPriv      = $objTender->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
	$noAdd         = $explPriv['add'];
        
	if ($noAdd == 1 && $id==0)
		echo "<script>location.href = '".APP_URL."viewTender/".$glId."/".$plId."'</script>";                     
               
	//========== Default variable ===============				
	$intWinStatus    = 1;
	$flag            = 0;  
	$errFlag         = 0;
	$intLinkType     = 1;
	$intTempletType  = 1;	
	$outMsg          = '&nbsp;';	
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
		$btnValue	 = 'Update';
		$strTab	 = 'Edit';		

		//============ Read value for updation ===========	
		$result          = $objTender->readTender($id);
		$strTenderNo     =  $result['strTenderNo'];  
		$strHeadLine     =  $result['strHeadLine'];  
		
		$strOpeningDate  =  $result['strOpeningDate'];
		$strClosingDate  =  $result['strClosingDate']; 
		$strTenderFile      =  $result['strTenderFile'];
		$extTenderFile 	= pathinfo($strTenderFile, PATHINFO_EXTENSION);	
		$strDescription     =  $result['strDescription'];
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
		$result        = $objTender->addUpdatteTender($id);
		//echo "<pre>"; print_r($result); exit;
		$outMsg        =  $result['msg']; 
		$flag          =  $result['flag'];   
		$redirectLoc    =  ($flag==0)? APP_URL.'viewTender/'.$glId.'/'.$plId:'';       
          
	}
