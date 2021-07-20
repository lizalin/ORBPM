<?php 
/* * ****Class to manage Message********************
'By                     : Indrani'
'On                     : 23-Dec-2020       '
'Procedure Used         : USP_MESSAGE      '
* ************************************************** */

class clsMessage extends Model {

// Function To Manage Message By::Indrani  :: On:: 23-Dec-2020
    public function manageMessage($action,$intId,$intPageType,$txtContent,$txtContentO,$pubStatus,$archiveStatus,$createdBy,$strattr1,$strattr2,$intattr1,$intattr2) {
        $sql       = "CALL USP_MESSAGE('$action',$intId,$intPageType,'$txtContent','$txtContentO',$pubStatus,$archiveStatus,$createdBy,'$strattr1','$strattr2',$intattr1,$intattr2,@OUT);";
        $errAction        = Model::isSpclChar($action);
        $errPageType      = Model::isSpclChar($intPageType); 
        $errContent       = Model::isSpclChar($txtContent);       
        if ($errAction > 0 || $errPageType > 0 || $errContent > 0)
            header("Location:" . APP_URL . "error");
        else {
            $result = Model::executeQry($sql); 
            return $result;
            
        }
    }

// Function To Add Upadate Message By::Indrani  :: On:: 23-Dec-2020
    public function addUpdateMessage($intId) { 
        
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $intId          = (isset($intId))?$intId:0;
        $selPageType    = htmlspecialchars($_POST['selPageType'], ENT_QUOTES);
        $blankPageType  = Model::isBlank($selPageType);
        $errPageType    = Model::isSpclChar($_POST['selPageType']);
        $txtContentE     = htmlspecialchars($_POST['txtContentE'], ENT_QUOTES);
        $blankContentE   = Model::isBlank($txtContentE);
        $errContentE     = Model::isSpclChar($_POST['txtContentE']);
        $txtContentO    = htmlspecialchars($_POST['txtContentO'], ENT_QUOTES);
       
        $outMsg = '';
        $flag = ($intId != 0) ? 1 : 0;
        $action = ($intId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        if(($blankPageType >0) || ($blankContentE >0))
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errPageType>0) || ($errContentE>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
       
        if($errFlag==0){      
            $result = $this->manageMessage($action,$intId,$selPageType,$txtContentE,$txtContentO,0,0,$userId,'','',0,0);if ($result)
                $outMsg = ($action == 'A') ? 'Message added successfully ' : 'Message updated successfully';     
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $selPageType     = ($errFlag == 1) ? $selPageType : 0;
        $txtContentE      = ($errFlag == 1) ? $txtContentE : '';
        $txtContentO     = ($errFlag == 1) ? $txtContentO : '';
         
        $arrResult = array('selPageType' => $selPageType,'txtContentE' => $txtContentE,'txtContentO' => $txtContentO,'msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

// Function To read Message By::Indrani :: On:: 23-Dec-2020
    public function readMessage($intId) {

        $result = $this->manageMessage('R',$intId,0,'','',0,0,0,'','',0,0); 
        if ($result->num_rows > 0) {
            $row                  = $result->fetch_array();
            $selPageType          =  $row['INT_PAGETYPE_ID']; 
            $txtContentE           =  htmlspecialchars_decode($row['VCH_CONTENT_E'],ENT_QUOTES);
            $txtContentO          =  htmlspecialchars_decode($row['VCH_CONTENT_O'],ENT_QUOTES);   
        }

        $arrResult = array('selPageType'=>$selPageType, 'txtContentE' => $txtContentE, 'txtContentO' => $txtContentO);
        return $arrResult;
    }
 
// Function To Delete Message By::Indrani :: On:: 23-Dec-2020
    public function deleteMessage($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
             
            $result = $this->manageMessage($action,$explIds[$ctr],0,'','',0,0,0,'','',0,0);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
            $outMsg = 'Message(s) deleted successfully';
        else if ($action == 'IN')
            $outMsg = 'Message(s) unpublished successfully';
        else if($action == 'P')
            $outMsg = 'Message(s) Published successfully';
     

        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}

?>