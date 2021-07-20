<?php
	/* ================================================
	File Name         	: addFaqInner.php
	Description		: This page is used to add FAQ Images.
	Developed By		: Indrani
	Developed On		: 16-NOV-2020
	Update History		:
	<Updated by>		<Updated On>		<Remarks>
     
	Class Used		: clsFaq
	Functions Used		: readFaq(),addUpdateFaq(),
	==================================================*/	
	include_once(ABS_PATH."Application/controller/clsFaq.php");
	$objFaq         = new clsFaq;	
  $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
  $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
  $strclick           =($id>0)?"window.location.href='". APP_URL."viewFaq/".$glId."/".$plId."';":"";
	//========== Default variable ===============	
	$flag               = 0;  
  $errFlag            = 0;
	$outMsg             = '&nbsp;';	
  $intChapter        = 0;
       
  //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objFaq->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewFaq/".$glId."/".$plId."'</script>";  
	

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objFaq->addUpdateFaq($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $intChapter      = $result['chapterType'];
           $strQuestion     = htmlspecialchars_decode($result['txtQuestion'],ENT_QUOTES);
           $strDec          = htmlspecialchars_decode($result['txtDes'],ENT_QUOTES); 
            
	}
        
        //=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
       //============ Read value for updation ===========	
           $result          = $objFaq->readFaq($id);
           $intChapter      = $result['intchapterType'];
           $strQuestion     = htmlspecialchars_decode($result['strQuestion'],ENT_QUOTES);
           $strDec          = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);        
	}
      
?>