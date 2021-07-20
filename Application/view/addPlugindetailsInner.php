<?php
	/* ================================================
	File Name         	: addPlugindetailsInner.php
	Description		: This page is used to add rule Details.
	Developed By		: T Ketaki Debadarshini  
	Developed On		: 09-Sep-2015 
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsPlugin
	Functions Used		: readPlugin(),addUpdatePlugin(),managePlugin()
	==================================================*/	
	
	$objPlugin     = new clsPlugin;	
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick	    =($id>0)?"window.location.href='". APP_URL."viewPlugindetails/".$glId."/".$plId."';":"";
        //=========== For Permission======================
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objPlugin->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewPlugindetails/".$glId."/".$plId."'</script>";   
        
        
	//========== Default variable ===============				
	 $intLinkType        = 1; 
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intfuncId          =$_SESSION['sessFuncId'];
        $intPlugintype      =0;
        
       
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
            //============ Read value for updation ===========	
            $result             = $objPlugin->readPlugin($id);
            $strHeadLine        =  $result['strHeadLine'];
            $strFileName        =  $result['strFileName'];    
            $intFnid            =  $result['intFnid']; 
            $strFnsubcat        =  $result['strFnsubcat']; 
            $strDesc            =  $result['strDesc'];
            $intLinkType            =  $result['strportaltype'];
                         
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objPlugin->addUpdatePlugin($id);
           $outMsg          =  $result['msg']; 
           $flag            =  $result['flag'];
           $strHeadLineE    =  htmlspecialchars_decode($result['strHeadLine'],ENT_QUOTES);          
           $strFileName     =  $result['strFileName']; 
         //  $strDetailE     =  htmlspecialchars_decode($result['strDetailE'],ENT_QUOTES);
           
	}
       
?>