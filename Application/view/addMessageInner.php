<?php
    /* ================================================
    File Name           : addMessageInner.php
    Description         : This page is used giving instruction to contactus left pane pages.
    Developed By        : Indrani
    Developed On        : 23-Dec-2020
    Update History      :
    <Updated by>        <Updated On>        <Remarks>
     
    Class Used          : clsMessage
    Functions Used      : readMessage(),addUpdateMessage(),
    ==================================================*/    
    include_once(ABS_PATH."Application/controller/clsMessage.php");
    $objMessage         = new clsMessage;   
    $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
    $strSubmit          =($id>0)?'Update':'Submit';
    $strReset           =($id>0)?'Cancel':'Reset';
    $strTab             =($id>0)?'Edit':'Add';
    $strclick           =($id>0)?"window.location.href='". APP_URL."viewMessage/".$glId."/".$plId."';":"";
    //========== Default variable ===============   
    $flag               = 0;  
    $errFlag            = 0;
    $outMsg             = '&nbsp;'; 
       
  //========== Permission ===============   
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objMessage->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewMessage/".$glId."/".$plId."'</script>";  
    

    //============ Button Submit ===================
    if(isset($_POST['btnSubmit']))
    {
           $result          = $objMessage->addUpdateMessage($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $selPageType     = $result['selPageType']; 
           $txtContentE      = htmlspecialchars_decode($result['txtContentE'],ENT_QUOTES);
           $txtContentO     = htmlspecialchars_decode($result['txtContentO'],ENT_QUOTES);               
    }
        
        //=========== For editing ======================
    if(isset($_REQUEST['ID']))
    {
       //============ Read value for updation ===========   
           $result          = $objMessage->readMessage($id);
           $selPageType     = $result['selPageType']; 
           $txtContentE      = htmlspecialchars_decode($result['txtContentE'],ENT_QUOTES); 
           $txtContentO     = htmlspecialchars_decode($result['txtContentO'],ENT_QUOTES);  
    }
      
?>