<?php 
/* * ****Class to manage Special Info ********************
'By                     : Indrani'
'On                     : 26-Nov-2020       '
' Procedure Used        : USP_SPECIAL_INFO      '
* ************************************************** */

class clsSpecialInfo extends Model {

// Function To Manage Special Info By::Indrani  :: On:: 26-Nov-2020
    public function manageSpecialInfo($action,$InfoId,$txtTitle,$startDate,$endDate,$pubStatus,$archiveStatus,$createdBy,$strattr1,$strattr2,$intattr1,$intattr2) {
        $infoSql       = "CALL USP_SPECIAL_INFO('$action',$InfoId,'$txtTitle','$startDate','$endDate',$pubStatus,$archiveStatus,$createdBy,'$strattr1','$strattr2',$intattr1,$intattr2,@OUT);";
        $errAction        = Model::isSpclChar($action);
        $errTitle         = Model::isSpclChar($txtTitle);       
        if ($errAction > 0 || $errTitle > 0)
            header("Location:" . APP_URL . "error");
        else {
            $infoResult = Model::executeQry($infoSql); 
            return $infoResult;
            
        }
    }

// Function To Add Upadate Info By::Indrani  :: On:: 26-Nov-2020
    public function addUpdateSpecialInfo($infoId) { 
        
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $infoId         = (isset($infoId))?$infoId:0;
        $txtTitle       = htmlspecialchars($_POST['txtTitle'], ENT_QUOTES);
        $blankTitle     = Model::isBlank($txtTitle);
        $errTitle       = Model::isSpclChar($_POST['txtTitle']);
        $txtStartDate   = htmlspecialchars($_POST['txtStartDate'],ENT_QUOTES);
        $txtEndDate     = htmlspecialchars($_POST['txtEndDate'],ENT_QUOTES);
        $errStartDate   = Model::isSpclChar($_POST['txtStartDate']);
        $errEndDate     = Model::isSpclChar($_POST['txtEndDate']);
        $startDateTime  =  ($txtStartDate!='' && $txtStartDate!='0000-00-00')?Model::dbDateFormat($txtStartDate):'';
        $endDateTime    =  ($txtEndDate!='' && $txtEndDate!='0000-00-00')?Model::dbDateFormat($txtEndDate):'';
       
        $outMsg = '';
        $flag = ($infoId != 0) ? 1 : 0;
        $action = ($infoId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        if(($blankTitle >0))
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errTitle>0) || ($errStartDate>0)|| ($errEndDate>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
       
        if($errFlag==0){
      
            $result = $this->manageSpecialInfo($action,$infoId,$txtTitle,$startDateTime,$endDateTime,0,0,$userId,'','',0,0);
                  
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Special Information added successfully ' : 'Special Information updated successfully';
      
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $txtTitle   = ($errFlag == 1) ? $txtTitle : '';
        $txtStartDate   = ($errFlag == 1) ? $txtStartDate : '';
        $txtEndDate     = ($errFlag == 1) ? $txtEndDate : '';
         
        $arrResult = array('txtTitle' => $txtTitle,'txtStartDate' => $txtStartDate,'txtEndDate' => $txtEndDate,'msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

// Function To read Special Info By::Indrani :: On:: 26-Nov-2020
    public function readSpecialInfo($infoId) {

        $result = $this->manageSpecialInfo('R',$infoId,'','','',0,0,0,'','',0,0); 
        if ($result->num_rows > 0) {
            $row                  = $result->fetch_array();
            $txtTitle           =  htmlspecialchars_decode($row['VCH_TITLE'],ENT_QUOTES);
            $txtStartDate       =  ($row['DTM_START_DATE']!='' && $row['DTM_START_DATE']!='0000-00-00')?date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_START_DATE'],ENT_NOQUOTES))):''; 
            $txtEndDate         =  ($row['DTM_END_DATE']!='' && $row['DTM_END_DATE']!='0000-00-00')?date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_END_DATE'],ENT_NOQUOTES))):'';  
        }

        $arrResult = array('txtTitle'=>$txtTitle, 'txtStartDate' => $txtStartDate, 'txtEndDate' => $txtEndDate);
        return $arrResult;
    }
 
// Function To Delete Special Information By::Indrani :: On:: 26-Nov-2020
    public function deleteSpecialInfo($action, $ids) {
                 $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
             
            $result = $this->manageSpecialInfo($action,$explIds[$ctr],'','','',0,0,0,'','',0,0);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
            $outMsg = 'Special Information(s) deleted successfully';
        else if ($action == 'IN')
            $outMsg = 'Special Information(s) unpublished successfully';
        else if($action == 'P')
            $outMsg = 'Special Information(s) Published successfully';
     

        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}

?>