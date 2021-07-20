<?php
    /* ================================================
    File Name           : addnewsmediaInner.php
    Description     : This page is used to add news and media.
    Developed By        : Indrani
    Developed On        : 03-Dec-2020
    Update History      :
    <Updated by>        <Updated On>        <Remarks>
     
    Class Used      : clsNewsMedia
    Functions Used      : readNewsMedia(),addUpdateNewsMedia(),
    ==================================================*/    
    include_once(ABS_PATH."Application/controller/clsNewsMedia.php");
    $objNewsMedia         = new clsNewsMedia;   
    $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
    $strSubmit          =($id>0)?'Update':'Submit';
    $strReset           =($id>0)?'Cancel':'Reset';
    $strTab             =($id>0)?'Edit':'Add';
    $strclick           =($id>0)?"window.location.href='". APP_URL."viewnewsmedia/".$glId."/".$plId."';":"";
    //========== Default variable ===============   
    $flag               = 0;  
    $errFlag            = 0;
    $outMsg             = '&nbsp;'; 
    $intChapter         = 0;
    $strSource          = 'http://';
    $selType            = 0;
       
  //========== Permission ===============   
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objNewsMedia->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewnewsmedia/".$glId."/".$plId."'</script>";  
    

    //============ Button Submit ===================
    if(isset($_POST['btnSubmit']))
    {
           $result          = $objNewsMedia->addUpdateNewsMedia($id);
           $outMsg          = $result['msg']; 
           $flag            = $result['flag'];
           $strTitleE       = htmlspecialchars_decode($result['strTitleE'],ENT_QUOTES);
           $strTitleO       = htmlspecialchars_decode($result['strTitleO'],ENT_QUOTES);
           $strDetailsE     = htmlspecialchars_decode($result['strDetailsE'],ENT_QUOTES);
           $strDetailsO     = htmlspecialchars_decode($result['strDetailsO'],ENT_QUOTES);
           $strSourceName   = htmlspecialchars_decode($result['strSourceName'],ENT_QUOTES);
           $strSource       = $result['strSource'];
           $publishdate     = $result['publishdate'];
           $strFileName     = $result['strFileName'];
           $selType         = $result['selType'];
           $strImgName      = $result['strImgName'];
           $strVideoName    = $result['strVideoName'];               
    }
        
        //=========== For editing ======================
    if(isset($_REQUEST['ID']))
    {
       //============ Read value for updation ===========   
           $result          = $objNewsMedia->readNewsMedia($id);
           $strTitleE       = htmlspecialchars_decode($result['strTitleE'],ENT_QUOTES);
           $strTitleO       = htmlspecialchars_decode($result['strTitleO'],ENT_QUOTES);
           $strDetailsE     = htmlspecialchars_decode($result['strDetailsE'],ENT_QUOTES);
           $strDetailsO     = htmlspecialchars_decode($result['strDetailsO'],ENT_QUOTES);
           $strSourceName   = htmlspecialchars_decode($result['strSourceName'],ENT_QUOTES);
           $strSource       = $result['strSource'];
           $publishdate     = $result['publishdate'];
           $strFileName     = $result['strFileName'];
           $selType         = $result['selType'];
           $strImgName      = $result['strImgName'];
           $strVideoName    = $result['strVideoName']; 
    }
      
?>