<?php

/* ================================================
  File Name         	: setPermissionInner.php
  Description		: This page is used to give previlage to the administrators.
  Developed By		: T Ketaki Debadarshini
  Developed On		: 29-Aug-2015
  Update History	:
  <Updated by>		<Updated On>		<Remarks>

  Class Used			: clsUserPermission,clsAdminLinks
  Functions Used		: 
  ================================================== */


    $objPermission = new clsUserPermission;
    $objLinks = new clsAdminLinks;
    $action = '';
    $flag = '0';
    $sessUserId         = $_SESSION['adminConsole_userID'];

  //======================= Permission ===========================*/
    $glId               = $_REQUEST['GL'];
    $plId               = $_REQUEST['PL'];
    $pageName           = $_REQUEST['PAGE'].'.php';
//=================== Button Submit ==================	
if (isset($_POST['btnSave'])) {
    $btnVal = $_POST['btnSave'];
    if ($btnVal == 'Submit') {
        $action = 'A';
    } else {
        $action = 'U';
        $flag = 1;
    }
    $userId = $_POST['DdlName'];
    if ($userId != '0') {
       
        $GLResult = $objLinks->manageAdminGLinks('S','0',''); 
        if (mysqli_num_rows($GLResult) > 0) {
            while ($GLRow = mysqli_fetch_array($GLResult)) {
                $GLId = $GLRow['INT_ADMIN_GL_ID'];
                
                $PLResult =  $objLinks->manageAdminPLinks('S','0',$GLId,'','');
                if (mysqli_num_rows($PLResult) > 0) {
                    if ($_POST['hdnPreGl_' . $GLId] == '1' && $_POST['hdnGl_' . $GLId] == '0') {
                                             
                        $delGlResult = $objPermission->managePermission('D','0',$userId,$GLId,0,0,0,0,0,0,0);
                        
                    } else if ($_POST['hdnGl_' . $GLId] != '0') {
                        while ($PLRow = mysqli_fetch_array($PLResult)) {
                            $PLId = $PLRow['INT_ADMIN_PL_ID'];

                            if ($_POST['hdnPreVal_' . $GLId . '_' . $PLId] == '1' && $_POST['hdn_' . $GLId . '_' . $PLId] == '0') {
                              
                                $delResult = $objPermission->managePermission('D','0',$userId,$GLId,$PLId,0,0,0,0,0,0);
                                
                            } else if ($_POST['hdn_' . $GLId . '_' . $PLId] != '0') {
                                $author = ($_POST['chkAuthor_' . $GLId . '_' . $PLId] == '') ? 0 : $_POST['chkAuthor_' . $GLId . '_' . $PLId];
                                $editor = ($_POST['chkEditor_' . $GLId . '_' . $PLId] == '') ? 0 : $_POST['chkEditor_' . $GLId . '_' . $PLId];
                                $publisher = ($_POST['chkPublisher_' . $GLId . '_' . $PLId] == '') ? 0 : $_POST['chkPublisher_' . $GLId . '_' . $PLId];
                                $manager = ($_POST['chkManager_' . $GLId . '_' . $PLId] == '') ? 0 : $_POST['chkManager_' . $GLId . '_' . $PLId];
                               
                                $result = $objPermission->managePermission($action,'0',$userId,$GLId,$PLId,$author,$editor,$publisher,$manager,0,0);
                            }
                        }
                    }
                }
            }
        }
    }
    if ($action == 'A')
        $outMsg = 'Permission Added Successfully';
    else if ($action == 'U')
        $outMsg = 'Permission Updated Successfully';
}
if ($flag == 1) {
    $intUserId = $userId;
}
?>