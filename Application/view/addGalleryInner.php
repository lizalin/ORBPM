<?php
	/* ================================================
	File Name         	: addGalleryInner.php
	Description		: This page is used to add Gallery Images.
	Developed By		: Chinmayee
	Developed On		: 27-MAy-2016
	Update History		:
	<Updated by>		<Updated On>		<Remarks>
     
	Class Used		: clsGallery
	Functions Used		: readGallery(),addUpdateGallery(),
	==================================================*/	
	
	$objGallery         = new clsGallery;	
	$objGalleryCat   = new clsGalleryCategory;
	$id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
	$strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
	$strclick           =($id>0)?"window.location.href='". APP_URL."viewGallery/".$glId."/".$plId."';":"location.reload();";
	//========== Default variable ===============	
	$flag               = 0;  
	$errFlag            = 0;
	$outMsg             = '&nbsp;';	
	$intCategory        = 0;
	$intplugin          =0;
	$intType            = 0;
	$intLinkType        = 1;
	$strDescription  = '';
	//========== Permission ===============	
	$glId          = $_REQUEST['GL'];
	$plId          = $_REQUEST['PL'];
	$pageName      = $_REQUEST['PAGE'].'.php';
	$userId        = $_SESSION['adminConsole_userID'];
	$explPriv      = $objGallery->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
	$noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewGallery/".$glId."/".$plId."'</script>";  
        
        $galleryCatList=$objGalleryCat->manageGalleryCategory('V', 0,0,0, '', '','', '',0 ,$userId);
        

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           
           $result          = $objGallery->addUpdateGallery($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strCaption      = htmlspecialchars_decode($result['strCaption'],ENT_QUOTES);
           $strCaptionO     = htmlspecialchars_decode($result['strCaptionH'],ENT_QUOTES); 
           $strDescription  = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
           $strFileName     =  $result['strFileName'];
           $intCategory     = $result['intCategory'];
           $intLocation     = $result['intLocation'];
           $intType         = $result['intType'];
           $intscreenType   = $result['intscreenType'];
           $redirectLoc    =  ($flag==0)? APP_URL.'viewGallery/'.$glId.'/'.$plId:'';
           
           
	}
        
        //=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
           
        //============ Read value for updation ===========	
		$result            = $objGallery->readGallery($id);
		//echo "<pre>"; print_r($result);exit;
		$strCaption        = htmlspecialchars_decode($result['strCaption'],ENT_QUOTES); 
		$strDescription    = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
		
		$strFileName       =  $result['strFileName'];
		$intCategory       = $result['intCategory'];
		$intplugin         = $result['intplugin'];
		$intType           = $result['intType'];
          
	}
       
?>