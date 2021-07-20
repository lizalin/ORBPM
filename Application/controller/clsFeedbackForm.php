<?php
/* ******* Class to manage Feedback ********************
'By                     : Ajmal'
'On                     : 21-Dec-2020'       
' Procedure Used        : USP_USER_FEEDBACK'     
*************************************************** */

class clsFeedback extends Model {

// Function To Manage Feedback  By::Ajmal  :: On:: 21-Dec-2020

    public function manageFeedback($vchAction,$intId,$vchName,$vchName_l,$vchEmail,$vchMobileNo,$vchSubject,$vchFeedback,$vchRemark, $dtFrom,$dtTo,$createdBy) {
        $dtFrom = (!empty($dtFrom))?"'".$dtFrom."'":'null';
        $dtTo = (!empty($dtTo))?"'".$dtTo."'":'null';
        $sql              = "CALL USP_FEEDBACK('$vchAction','$intId','$vchName','$vchName_l','$vchEmail','$vchMobileNo','$vchSubject','$vchFeedback','$vchRemark',$dtFrom,$dtTo,'$createdBy',@OUT);";
        if($action == 'A'){
      echo $sql;exit();
            
        }
        $errAction          = Model::isSpclChar($action);
        $errName            = Model::isSpclChar($name);
        $errEmail           = Model::isSpclChar($email);
        $errSubject         = Model::isSpclChar($subject);
        $errFeedback        = Model::isSpclChar($feedback);
 
        if ($errAction > 0 || $errName > 0 || $errEmail > 0 || $errSubject > 0 || $errFeedback > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($sql); 
            return $sqlResult;           
        }
    }

// Function To Add Feedback  By::Ajmal  :: On:: 21-Dec-2020
    public function addFeedback() {
        
        $userId         = 0;
        $intId          = 0;
        $txtName        = htmlspecialchars($_POST['txtName'], ENT_QUOTES);
        $blankName      = Model::isBlank($txtName);
        $errTxtName     = Model::isSpclChar($_POST['txtName']);
        $txtEmail       = htmlspecialchars($_POST['txtEmail'], ENT_QUOTES);
        $blankEmail     = Model::isBlank($txtEmail);
        $errTxtEmail    = Model::isSpclChar($_POST['txtEmail']);
        $txtMobile      = htmlspecialchars($_POST['txtNo'], ENT_QUOTES);
        $txtSubject     = htmlspecialchars($_POST['txtSubject'], ENT_QUOTES);
        $blankSubject   = Model::isBlank($txtSubject);
        $errTxtSubject  = Model::isSpclChar($_POST['txtSubject']);
        $txtFeedback    = htmlspecialchars($_POST['txtFeedback'], ENT_QUOTES);
        $blankFeedback  = Model::isBlank($txtFeedback);
        $errTxtFeedback = Model::isSpclChar($_POST['txtFeedback']);
        $outMsg = '';
        $flag   =  0;
        $action = 'A'; 
        $errFlag            = 0 ;
      
        if(($blankName >0) || ($blankEmail >0) || ($blankSubject >0) || ($blankFeedback >0)) 
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errTxtName>0)||($errTxtEmail>0) || ($errTxtSubject>0)||($errTxtFeedback>0))
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Special Characters are not allowed";
        }
     
        if($errFlag==0){
             
                $result = $this->manageFeedback($action,$intId,$txtName,$txtEmail,$txtMobile,$txtSubject,$txtFeedback,'0001-01-01',0,0,$userId,'','',0,0);
                if ($result)
                $outMsg = 'Feedback added successfully ';
                    }
               
        $strName        = ($errFlag == 1) ? $txtName : '';              
        $strEmail       = ($errFlag == 1) ? $txtEmail : '';
        $strMobile      = ($errFlag == 1) ? $txtMobile : '';
        $strSubject     = ($errFlag == 1) ? $txtSubject : ''; 
        $strFeedback    = ($errFlag == 1) ? $txtFeedback : '';
               
        $arrResult = array('strName' => $strName,'strEmail' => $strEmail,'strMobile' => $strMobile,'strSubject' => $strSubject,'strFeedback' => $strFeedback,'msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

    // Function To Delete Feedback  By::Ajmal  :: On:: 24-Dec-2020
    public function deleteFeedback($action, $ids) {

        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            
            $result = $this->manageFeedback($action,$explIds[$ctr],'','','','','','1000-01-01',0,0,$userId,'','',0,0);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
               $outMsg .= 'Feedback deleted successfully';
        }
        return $outMsg;
         }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}

?>