<?php
	/* ================================================
	File Name         	: addSchemecategoryInner.php
	Description		: This page is used to add Scheme Category.
	Developed By		: T Ketaki Debadarshini
	Developed On		: 17-Aug-2015
	Update History		:
	<Updated by>		<Updated On>		<Remarks>

	Class Used		: clsSchemeCategory
	Functions Used		: readSchemeCategory(),addUpdateSchemeCategory(),
	==================================================*/	
	
	$objSchemeCat      = new clsSchemeCategory;	
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit          =($id>0)?'Update':'Submit';
	$strReset           =($id>0)?'Cancel':'Reset';
	$strTab             =($id>0)?'Edit':'Add';
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewSchemecategory/".$glId."/".$plId."';":"location.reload();";
	//========== Default variable ===============	
	$flag               = 0;  
        $errFlag            = 0;
	$outMsg             = '&nbsp;';	
        $intStatus          = 2;
       //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objSchemeCat->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewSchemecategory/".$glId."/".$plId."'</script>";   
       
	//=========== For editing ======================
	if(isset($_REQUEST['ID']))
	{
           
            //============ Read value for updation ===========	
           $result          = $objSchemeCat->readSchemeCategory($id);
           $strCategory    = $result['strCategory'];  
           $strDescription     = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
           $intStatus            = $result['intStatus'];
	}

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $objSchemeCat->addUpdateSchemeCategory($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strCategory    = htmlspecialchars_decode($result['strCategory'],ENT_QUOTES);  
           $strDescription     = htmlspecialchars_decode($result['strDescription'],ENT_QUOTES);
           $intStatus            = $result['intStatus'];
	}
       
?>