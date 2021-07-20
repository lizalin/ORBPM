<?php
    /* ================================================
    File Name           : addSpecialInfoInner.php
    Description     : This page is used to add Special Information.
    Developed By        : Indrani
    Developed On        : 26-NOV-2020
    Update History      :
    <Updated by>        <Updated On>        <Remarks>
     
    Class Used      : clsSpecialInfo
    Functions Used      : readSpecialInfo(),addUpdateSpecialInfo(),
    ==================================================*/    
    include_once(ABS_PATH."Application/controller/clsSpecialInfo.php");
    $objSpecialInfo         = new clsSpecialInfo;   
    $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
    $strSubmit          =($id>0)?'Update':'Submit';
    $strReset           =($id>0)?'Cancel':'Reset';
    $strTab             =($id>0)?'Edit':'Add';
    $strclick           =($id>0)?"window.location.href='". APP_URL."viewSpecialInfo/".$glId."/".$plId."';":"";
    //========== Default variable ===============   
    $flag               = 0;  
    $errFlag            = 0;
    $outMsg             = '&nbsp;'; 
    $intChapter         = 0;
       
  //========== Permission ===============   
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objSpecialInfo->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewSpecialInfo/".$glId."/".$plId."'</script>";  
    

    //============ Button Submit ===================
    if(isset($_POST['btnSubmit']))
    {
           $result          = $objSpecialInfo->addUpdateSpecialInfo($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $txtTitle        = htmlspecialchars_decode($result['txtTitle'],ENT_QUOTES);
           $txtStartDate    = $result['txtStartDate'];
           $txtEndDate      = $result['txtEndDate'];       
    }
        
        //=========== For editing ======================
    if(isset($_REQUEST['ID']))
    {
       //============ Read value for updation ===========   
           $result          = $objSpecialInfo->readSpecialInfo($id);
           $txtTitle        = htmlspecialchars_decode($result['txtTitle'],ENT_QUOTES);
           $txtStartDate    = $result['txtStartDate'];
           $txtEndDate      = $result['txtEndDate']; 
    }
      
?>