<?php
    /* ================================================
    File Name           : addEventsInner.php
    Description     : This page is used to add Events.
    Developed By        : Indrani
    Developed On        : 10-Dec-2020
    Update History      :
    <Updated by>        <Updated On>        <Remarks>
     
    Class Used      : clsEvents
    Functions Used      : readEvents(),addUpdateEvents(),
    ==================================================*/    
    include_once(APP_CLASS_PATH."clsEvents.php");
    $objEvents          = new clsEvents;   
    $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
    $strSubmit          =($id>0)?'Update':'Submit';
    $strReset           =($id>0)?'Cancel':'Reset';
    $strTab             =($id>0)?'Edit':'Add';
    $strclick           =($id>0)?"window.location.href='". APP_URL."viewnewsmedia/".$glId."/".$plId."';":"";
    //========== Default variable ===============   
    $flag               = 0;  
    $errFlag            = 0;
    $outMsg             = '&nbsp;'; 
    $strSource          = 'http://';
           
  //========== Permission ===============   
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objEvents->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewEvents/".$glId."/".$plId."'</script>";  
    

    //============ Button Submit ===================
    if(isset($_POST['btnSubmit']))
    {
           $result          = $objEvents->addUpdateEvents($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strTitleE       = htmlspecialchars_decode($result['strTitleE'],ENT_QUOTES);
           $strTitleO       = htmlspecialchars_decode($result['strTitleO'],ENT_QUOTES);
           $strSource       = $result['strSource'];
           $strfromdate     = $result['strfromdate'];
           $strfromtime     = $result['strfromtime'];
           $strtodate       = $result['strtodate'];
           $strtotime       = $result['strtotime'];
           $strLocation     = htmlspecialchars_decode($result['strLocation'],ENT_QUOTES);
           $strDetailsE     = htmlspecialchars_decode($result['strDetailsE'],ENT_QUOTES);
           $strDetailsO     = htmlspecialchars_decode($result['strDetailsO'],ENT_QUOTES);
           $strImgName      = htmlspecialchars_decode($result['strImgName'],ENT_QUOTES);
    }
        
        //=========== For editing ======================
    if(isset($_REQUEST['ID']))
    {
       //============ Read value for updation ===========   
           $result          = $objEvents->readEvents($id);
           $strTitleE       = htmlspecialchars_decode($result['strTitleE'],ENT_QUOTES);
           $strTitleO       = htmlspecialchars_decode($result['strTitleO'],ENT_QUOTES);
           $strSource       = $result['strSource'];
           $strfromdate     = $result['strfromdate'];
           $strfromtime     = $result['strfromtime'];
           $strtodate       = $result['strtodate'];
           $strtotime       = $result['strtotime'];
           $strLocation     = htmlspecialchars_decode($result['strLocation'],ENT_QUOTES);
           $strDetailsE     = htmlspecialchars_decode($result['strDetailsE'],ENT_QUOTES);
           $strDetailsO     = htmlspecialchars_decode($result['strDetailsO'],ENT_QUOTES);
           $strImgName      = htmlspecialchars_decode($result['strImgName'],ENT_QUOTES); 
    }
      
?>