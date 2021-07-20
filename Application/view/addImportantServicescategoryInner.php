<?php
	/* ================================================
	File Name         	: addGallerycategoryInner.php
	Description		: This page is used to add Gallery Category.
	Developed By		: Chinmayee
	Developed On		: 26-May-2016 
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsGalleryCategory
	Functions Used		: readGalleryCategory(),addUpdateGalleryCategory(),
	==================================================*/	
	
	
        $objImpServicesCat      = new clsImportantServicesCategory;
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewImpServicecategory/".$glId."/".$plId."';":"";
	//========== Default variable ===============	
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intStatus          = 2;
        $selplugintype      =0;
        $intCattype         =0;
       //========== Permission ===============	
        $glId               = $_REQUEST['GL'];
        $plId               = $_REQUEST['PL'];
        $pageName           = $_REQUEST['PAGE'].'.php';
        $userId             = $_SESSION['adminConsole_userID'];
        $explPriv           = $objImpServicesCat->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd              = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewImpServicecategory/".$glId."/".$plId."'</script>";   
       
	
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
           
            //============ Read value for updation ===========	
           $result          = $objImpServicesCat->readImpServiceCategory($id);
           $strCategory     = $result['strCategory'];  
           $intCattype      = $result['intCattype'];  
           $strDescription  = $result['strDescription'];
           $strCategoryO    = $result['strCategoryO'];  
           $strDescriptionO = $result['strDescriptionO'];
           $selplugintype   = $result['selplugintype'];
           $intStatus       = $result['intStatus'];
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objImpServicesCat->addUpdateImpServiceCategory($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strCategory     = htmlspecialchars_decode($result['strCategory'],ENT_QUOTES); 
           $strCategoryO    = htmlspecialchars_decode($result['strCategory'],ENT_QUOTES);
           $intStatus       = $result['intStatus'];
           $selplugintype   = $result['selplugintype'];
           $intCattype      = $result['selCattype']; 
	}
       
?>