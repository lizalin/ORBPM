<?php 
/* * ****Class to manage FAQ ********************
'By                     : Indrani'
'On                     : 16-Nov-2020       '
' Procedure Used        : USP_FAQ       '
* ************************************************** */

class clsFaq extends Model {

// Function To Manage Faq By::Indrani  :: On:: 16-Nov-2020
    public function manageFaq($action,$faqId,$chapterId,$Question,$description,$pubStatus,$archiveStatus,$createdBy,$strattr1,$strattr2,$intattr1,$intattr2) {
        $faqSql       = "CALL USP_FAQ('$action',$faqId,$chapterId,'$Question','$description',$pubStatus,$archiveStatus,$createdBy,'$strattr1','$strattr2',$intattr1,$intattr2,@OUT);";
        //echo   $faqSql;
        $errAction        = Model::isSpclChar($action);
        $errQuestion       = Model::isSpclChar($Question);
        $errdescription      = Model::isSpclChar($description);       
        if ($errAction > 0 || $errQuestion > 0 || $errdescription > 0)
            header("Location:" . APP_URL . "error");
        else {
            $faqResult = Model::executeQry($faqSql); 
            return $faqResult;
            
        }
    }

// Function To Add Upadate Faq By::Indrani  :: On:: 16-Nov-2020
    public function addUpdateFaq($faqId) { 
        
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $faqId          = (isset($faqId))?$faqId:0;
        $chapterType    = htmlspecialchars($_POST['selChapter'], ENT_QUOTES);
        $blankChapterType  = Model::isBlank($chapterType);
        $errchpType     = Model::isSpclChar($_POST['selChapter']);
        $txtQuestion    = htmlspecialchars($_POST['txtQuestion'], ENT_QUOTES);
        $blankQuestion  = Model::isBlank($txtQuestion);
        $errQuestion    = Model::isSpclChar($_POST['txtQuestion']);
        $txtDes         = htmlspecialchars($_POST['txtDes'], ENT_QUOTES);
        $blankDes       = Model::isBlank($txtDes);
        $errDes         = Model::isSpclChar($_POST['txtDes']);
       
        $outMsg = '';
        $flag = ($faqId != 0) ? 1 : 0;
        $action = ($faqId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        if(($blankQuestion >0) || ($blankDes >0) || ($blankChapterType > 0))
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errchpType>0) || ($errQuestion>0)|| ($errDes>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
       

        if($errFlag==0){
      
            $result = $this->manageFaq($action,$faqId,$chapterType,$txtQuestion,$txtDes,0,0,$userId,'','',0,0);
                  
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Faq Details added successfully ' : 'Faq Details updated successfully';
      
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $chapterType   = ($errFlag == 1) ? $chapterType : '0'; 
        $txtQuestion   = ($errFlag == 1) ? $txtQuestion : '';
        $txtDes        = ($errFlag == 1) ? $txtDes : '';
         
        $arrResult = array('chapterType' => $chapterType,'txtQuestion' => $txtQuestion,'txtDes' => $txtDes,'msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

// Function To read Faq  By::Indrani :: On:: 16-Nov-2020
    public function readFaq($id) {

        $result = $this->manageFaq('R',$id,0,'','',0,0,0,'','',0,0); 
        if ($result->num_rows > 0) {
            $row                  = $result->fetch_array();
            $intchapterType       = $row['INT_CHAPTER_ID'];
            $strQuestion          =  htmlspecialchars_decode($row['VCH_QUESTION'],ENT_QUOTES);
            $strDescription       = htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_NOQUOTES);    
        }

        $arrResult = array('intchapterType'=>$intchapterType, 'strQuestion' => htmlspecialchars_decode($strQuestion,ENT_NOQUOTES), 'strDescription' => htmlspecialchars_decode($strDescription,ENT_NOQUOTES));
        return $arrResult;
    }
 
// Function To Delete Faq By::Indrani :: On:: 16-Nov-2020
    public function deleteFaq($action, $ids) {
                 $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
             
            $result = $this->manageFaq($action,$explIds[$ctr],0,'','',0,0,0,'','',0,0);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
            $outMsg .= 'Faq Detail(s) deleted successfully';
        else if ($action == 'IN')
            $outMsg = 'Faq(s) unpublished successfully';
        else if($action == 'P')
            $outMsg = 'Faq(s) Published successfully';
     

        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}

?>