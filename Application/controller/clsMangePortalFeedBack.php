<?php
/****** Function To Manage FeedBack ********************
        By	 	 : T Ketaki Debadarshini					
        On	 	 : 28-Aug-2015
    *************************************************** */
class ClsMangePortalFeedBack extends Model {
   
    public function manageFeedBack($action, $feedbackId,$name, $Email, $mobile, $subject, $message, $remark, $dateFrom, $dateTo, $updatedBy) 
    {
        $feedBackSql           = "CALL USP_FEEDBACK('$action', '$feedbackId', '$name', '','$Email', '$mobile', '$subject', '$message', '$remark', '$dateFrom', '$dateTo', '$updatedBy', @OUT);";
        //echo $feedBackSql;
        $errAction              = Model::isSpclChar($action);
        if ($errAction > 0)
            header("Location:" . APP_URL . "error");
        else {
            $feedBackResult = Model::executeQry($feedBackSql);
            return $feedBackResult;
        }
    } 
    
    /****** Function To view FeedBack ********************
        By	 	 : T Ketaki Debadarshini					
        On	 	 : 28-Aug-2015
    ************************************************** */

    public function viewFeedBack($action, $recNo, $txtSubject) 
    {
        $feedBackResult      = $this->manageFeedBack($action, $recNo,'', '', '', '', $txtSubject, '', '0000-00-00', '0000-00-00',0);
        $resultArr      = array();
        if ($feedBackResult->num_rows > 0) {
            while ($row = $feedBackResult->fetch_array()) {
                
                $resultArr[] = array('feedBackId' => $row['intFeedbackId'], 'feedBackType' => $row['intType'], 'strName' => $row['vchName'],'strNameL' => $row['vchNameL'], 'strEmail' => $row['vchEmail'], 'strTelNo' => $row['vchTelNo'], 'vchSubject' => $row['vchSubject'],'strMessage' => $row['vchMessage'], 'strRemarks' => $row['vchRemarks'], 'strCreatedOn' => $row['stmCreatedOn'], 'strUpdatedOn' => $row['dtmUpdatedOn'], 'strUpdatedBy' => $row['intUpdatedBy'], 'deletedFlag' => $row['bitDeletedFlag']);
            }
        }
        return $resultArr;
    }
    /************ Function to delete feedBack Record *****************
         By	 	 : T Ketaki Debadarshini					
        On	 	 : 28-Aug-2015
    *************************************************** */

    public function deleteFeedBack($action, $ids) {
        $ctr = 0;
       // $userId = $_SESSION['adminConsole_userID'];
        $userId=0;
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $feedBackResult = $this->manageFeedBack('D', $explIds[$ctr],'', '', '', '', '', '', '0000-00-00', '0000-00-00',$userId);
            if ($feedBackResult)
                $delRec++;
            $ctr++;
        }
        if ($delRec > 0)
            $msg = 'Selected Record(s) Deleted Successfully';
        else
            $msg = 'Operation Failed. Transaction Aborted';
        return $msg;
    }
    /****** Function To Update Complaint Remark ********************
            By	 	 : T Ketaki Debadarshini					
        On	 	 : 28-Aug-2015
    ************************************************** */    
    public function UpdateFeedBack($complainId)
    {    $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId = $_SESSION['adminConsole_userID'];
        $complainRemark     = htmlspecialchars(addslashes($_POST['txtRemarks']), ENT_QUOTES);
        $blankComRemark     = Model::isBlank($complainRemark);
        $errComRemark       = Model::isSpclChar($complainRemark);
        $lenComRemark       = Model::chkLength('max', $complainRemark, 250);
        $outMsg             = '';
        $errFlag            = 0 ;
        if ($blankComRemark >0) {
            $errFlag        = 1;
            $outMsg         = "Mandatory Fields should not be blank";
        }
        else if ($lenComRemark) {
            $errFlag        = 1;
            $outMsg         = "Length should not excided maxlength";
        }
        else if ($errComRemark) {
            $errFlag        = 1;
            $outMsg         = "Special Characters are not allowed";
        }
        else if($complainId == '') {
            $errFlag        = 1;
            $outMsg         = "No complain entry found.";
        }
        if ($errFlag == 0) {
            $result = $this->manageFeedBack('U', $complainId, '', '', '', '', '', $complainRemark, '0000-00-00', '0000-00-00',$userId);
            if ($result) {
                $complaintRes		= $this->viewFeedBack('V', $complainId, '0', '');
                $strSubject		= $complaintRes[0]['strSubject'];
                $strMessage		= $complaintRes[0]['strMessage'];
                $strCompRemark          = $complaintRes[0]['strRemarks'];
                $CompRemarkDate         = $complaintRes[0]['dtmUpdatedOn'];
                $strName		= $complaintRes[0]['strName'];
                $strEmail		= $complaintRes[0]['strEmail'];
                if(sendMail == "Y")
                {
                    $Subject       = "Remark On Your Complain From HPTCP Portal";
                    $strTo         = $strEmail;
                    $strFrom       = "tcphimachal@gmail.com";
                    $MailMessage   = "Below are Reamrk Details of Mr./Mrs. <strong>".$strName."</strong></br>";
                    $MailMessage  .= "<div>";
                    $MailMessage  .= "<strong>Name &nbsp; &nbsp; &nbsp; : </strong>";
                    $MailMessage  .= $strName."<br/>";
                    $MailMessage  .= "<strong>Message : </strong>";
                    $MailMessage  .= "Subject :".$strSubject.'<br/>';
                    $MailMessage  .= "Message :".$strMessage.'<br/>';
                    $MailMessage  .= "Remark :".$strCompRemark.'<br/>';
                    $MailMessage  .= "Remark Date:".$CompRemarkDate;
                    $MailMessage  .= "</div>";
                    Model::Sendmail($strFrom,$strTo,$Subject,$MailMessage);
                }
                $outMsg	= 'Your Remark is updated successfully';
            }
        }
        }
         else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         } 
        $strRemark           = ($errFlag==1) ? $complainRemark : '';
        $arrResult           = array('msg' => $outMsg, 'strRemark' => $strRemark );
        return $arrResult;
 
    }
    
}
    ?>