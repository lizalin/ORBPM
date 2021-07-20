<?php
	/* ================================================
	File Name         	: addPLInner.php
	Description		: This page is used to assign menus to Primary link.
	Author Name		: T Ketaki Debadarshini
	Date Created		: 29-Aug-2015
	Update History		:
	<Updated by>		<Updated On>		<Remarks>
	
	Class Used		: clsGlobalLink
	Functions Used		: saveMenuItems()
	==================================================*/
	$objGl          = new clsGlobalLink;  
        $linkType       = 'primaryLink';
        $menuType 	= 1;
        
        $glId		= $_REQUEST['GL'];
	$plId		= $_REQUEST['PL'];
	$pageName	= $_REQUEST['PAGE'].'.php';
	$explPriv	= $objGl->checkPrivilege($_SESSION['adminConsole_userID'],$glId,$plId,$pageName,'V');
	$editPriv	= $explPriv['edit'];
	$deletePriv	= $explPriv['delete'];
	$noAdd		= $explPriv['add'];	
	$noActive	= $explPriv['active'];
	$noPublish	= $explPriv['publish'];
        
        
        if(isset($_POST['btnSaveMainMenu']))
        {
            /* For main menu */            
                $parentIds	= $_REQUEST['chkGLId'];
                foreach($parentIds as $glIds)
                {
                        $outMsg  = $objGl->saveMenuItems($glIds,$menuType,$linkType,$glIds);
                }			
           
        }  
        
	$viewGl		= $objGl->viewGL('VA', 0, 1);		
?>
 