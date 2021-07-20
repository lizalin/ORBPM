<?php
	/* ================================================
	File Name         	: addPageInner.php
	Description		: This page is used to add pages.
	Developed By		: T Ketaki Debadarshini
	Developed On		: 13-Aug-2015
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsPages
	Functions Used		: readPage(),addUpdatePages(),
	==================================================*/	
	
	$objPages       = new clsPages;	
        $id             = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit      =($id>0)?'Update':'Submit';
	$strReset       =($id>0)?'Cancel':'Reset';
	$strTab         =($id>0)?'Edit':'Add';
        $strclick       =($id>0)?"window.location.href='". APP_URL."viewPage/".$glId."/".$plId."';":"location.reload();";
         //$intPageNo      = $objPages->getMaxPage($id);
	//========== Default variable ===============				
	$intWinStatus       = 1;
	$flag               = 0;  
        $errFlag            = 0;
        $intLinkType        = 1;
        $intTempletType      = 1;
	$outMsg             = '&nbsp;';	
        $strURL             = 'http://';
         $redirectLoc       = '';
        //=========== For Permission======================
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objPages->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewPage/".$glId."/".$plId."'</script>";
       
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{   
            //============ Read value for updation ===========	
            $result          = $objPages->readPage($id);
            $strTitleE       =  $result['strTitleE']; 
            $strName         =  $result['strName']; 
            $strNameO        =  $result['strNameO']; 
            $intLinkType     =  $result['intLinkType'];
            $strFileName     =  $result['strFileName'];
            $strURL          =  $result['strUrl'];
            $intTempletType  =  $result['intTempletType'];
            $strContentE     =  $result['strContentE'];            
            //$strPluginName   =  $result['strPluginName'];
            $strPluginName   = $result['intPlid'].'_'.$result['intFunctionid'];   
           // echo $strPluginName;
            $intWinStatus    =  $result['intWinStatus'];
            $strPageAlias    =  $result['strPageAlias'];
            $strMetaKeyword  =  $result['strMetaKeyword'];
            $strMetaDescription  =  $result['strMetaDescription'];
            $strMetaType     =  $result['strMetaType'];            
            $strMetaImage    =  $result['strMetaImage'];
            $strMetaTitle    =  $result['strMetaTitle'];
            $strSnippet    =  $result['strSnippet'];
            $strDocFile    =  $result['strDocFile'];
            //$redirectLoc    =   APP_URL.'viewPage/'.$glId.'/'.$plId;
            $strFileNameImage = ($intTempletType==1 && $intLinkType ==1 && $result['strFileName'] !="")?$result['strFileName']:'';
           
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objPages->addUpdatePages($id); //print_r($result);
           $outMsg          =  $result['msg']; 
           $flag            =  $result['flag'];
           $strTitleE       =  $result['strTitleE'];  
           $strName         =  $result['strName']; 
           $intLinkType     =  $result['intLinkType'];
           $strFileName     =  $result['strFileName'];
           $strURL          =  $result['strUrl'];
           $intTempletType  =  $result['intTempletType'];
           $strContentE     =  $result['strContentE'];          
           $strPluginName   =  $result['strPluginName'];
           $strPluginName   = $result['intPlid'].'_'.$result['intFunctionid'];   
           $intWinStatus    =  $result['intWinStatus'];
           $strSnippet      =  $result['strSnippet'];
           $strDocFile      =  $result['strDocFile'];
           $redirectLoc    =  ($flag==0)? APP_URL.'viewPage/'.$glId.'/'.$plId:'';
	}
       
?> 