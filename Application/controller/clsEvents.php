<?php 
/* * ****Class to manage Events ********************
'By                     : Indrani'
'On                     : 10-Dec-2020       '
' Procedure Used        : USP_EVENTS     '
* ************************************************** */

class clsEvents extends Model {

// Function To Manage Events By::Indrani  :: On:: 10-Dec-2020
    public function manageEvents($action,$EventId,$txtTitleE,$txtTitleO,$txtSource,$startDate,$startTime,$endDate,$endTime,$txtLocation,$txtDescriptionE,$txtDescriptionO,$formattedImgName,$pubStatus,$archiveStatus,$createdBy,$strattr1,$strattr2,$intattr1,$intattr2) {
        $eventSql       = "CALL USP_EVENT_DETAILS('$action',$EventId,'$txtTitleE','$txtTitleO','$txtSource','$startDate','$startTime','$endDate','$endTime','$txtLocation','$txtDescriptionE','$txtDescriptionO','$formattedImgName',$pubStatus,$archiveStatus,$createdBy,'$strattr1','$strattr2',$intattr1,$intattr2,@OUT);";//echo $eventSql;exit;
        $errAction        = Model::isSpclChar($action);
        $errTitleE         = Model::isSpclChar($txtTitleE);
        $errLocation      = Model::isSpclChar($txtLocation);
        $errDesE          = Model::isSpclChar($txtDescriptionE);        
        if ($errAction > 0 || $errTitleE > 0 || $errLocation > 0 || $errDesE > 0)
            header("Location:" . APP_URL . "error");
        else {
            $eventResult = Model::executeQry($eventSql); 
            return $eventResult;
            
        }
    }

// Function To Add Upadate Events By::Indrani  :: On:: 10-Dec-2020
    public function addUpdateEvents($eventId) { 
        
        $allow_img_files        = array('jpg','jpeg','png');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $eventId        = (isset($eventId))?$eventId:0;
        $txtTitleE      = htmlspecialchars($_POST['txtTitleE'], ENT_QUOTES);
        $blankTitleE    = Model::isBlank($txtTitleE);
        $errTitleE      = Model::isSpclChar($_POST['txtTitleE']);
        $txtTitleO      = htmlspecialchars($_POST['txtTitleO'], ENT_QUOTES);
        $txtSource      = $_POST['txtSource'];
        $blankSource    = Model::isBlank($txtSource);

        $txtStartDate   = htmlspecialchars($_POST['txtFromDate'],ENT_QUOTES);
        $txtEndDate     = htmlspecialchars($_POST['txtToDate'],ENT_QUOTES);
        $blankStartDate  = Model::isBlank($txtStartDate);
        $blankEndDate    = Model::isBlank($txtEndDate);
        $errStartDate   = Model::isSpclChar($_POST['txtFromDate']);
        $errEndDate     = Model::isSpclChar($_POST['txtToDate']);
        $startDate      =  ($txtStartDate!='' && $txtStartDate!='0000-00-00')?Model::dbDateFormat($txtStartDate):'';
        $endDate        =  ($txtEndDate!='' && $txtEndDate!='0000-00-00')?Model::dbDateFormat($txtEndDate):'';

        $txtFromTime   = htmlspecialchars($_POST['txtFromTime'],ENT_QUOTES);
        $txtToTime     = htmlspecialchars($_POST['txtToTime'],ENT_QUOTES);
        $blankStartTime  = Model::isBlank($txtFromTime);
        $blankEndTime    = Model::isBlank($txtToTime);
        $errStartTime    = Model::isSpclChar($_POST['txtFromTime']);
        $errEndTime      = Model::isSpclChar($_POST['txtToTime']);

        $txtLocation      = htmlspecialchars($_POST['txtLocation'], ENT_QUOTES);
        $blankLocation    = Model::isBlank($txtLocation);
        $errLocation      = Model::isSpclChar($_POST['txtLocation']);

        $txtDetailsE      = htmlspecialchars($_POST['txtDetailsE'], ENT_QUOTES);
        $blankDetailsE    = Model::isBlank($txtDetailsE);
        $errDetailsE      = Model::isSpclChar($_POST['txtDetailsE']);
        $txtDetailsO      = htmlspecialchars($_POST['txtDetailsO'], ENT_QUOTES);

        $fileImg   = $_FILES['fileImage']['name'];
        $prevImg   = $_POST['hdnImgFile'];
        $extensionImg   = pathinfo($fileImg, PATHINFO_EXTENSION);
        $txtImgSize    = $_FILES['fileImage']['size'];
        $txtTempImgName    = $_FILES['fileImage']['tmp_name'];
        $formattedImgName = ($fileImg != '') ? 'EventImg_' . time() . '.' . $extensionImg: '';

        if($_FILES['fileImage']['name']!='')
            $errFileImg  = Model::isValidFile($_FILES['fileImage']['name'],$allow_img_files);
        else
            $errFileImg  = Model::isValidFile($prevImg,$allow_img_files);

        if ($fileImg == '' && $eventId != 0)
            $formattedImgName = $prevImg;
       
        $outMsg = '';
        $flag = ($eventId != 0) ? 1 : 0;
        $action = ($eventId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        if(($blankTitleE>0) ||($blankSource>0) ||($blankStartDate>0) ||($blankEndDate>0) || ($blankStartTime>0) || ($blankEndTime>0) ||($blankLocation>0) || ($blankDetailsE>0))
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errTitleE>0) || ($errStartDate>0)|| ($errEndDate>0) || ($errStartTime>0) || ($errEndTime>0) ||($errLocation>0) ||($errDetailsE>0))
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Special Characters are not allowed";
        }
        else if($fileImg!='')
        {
            if($errFileImg==0)
                {
                    $errFlag                = 1;
                    $flag                   = 1;
                    $outMsg                 = "Invalid File types.Upload only jpg,jpeg,png files.";
                }
                else if ($txtImgSize > size10MB) {
                    $errFlag               = 1;
                    $flag                  = 1;
                    $outMsg = 'File size can not more than 10 MB';
                }
        }
       
        if($errFlag==0){
      
            $result = $this->manageEvents($action,$eventId,$txtTitleE,$txtTitleO,$txtSource,$startDate,$txtFromTime,$endDate,$txtToTime,$txtLocation,$txtDetailsE,$txtDetailsO,$formattedImgName,0,0,$userId,'','',0,0);
                  
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Event Details added successfully ' : 'Event Details updated successfully';
                    if ($_FILES['fileImage']['name'] != '') {
                        if (file_exists("uploadDocuments/Events/" . $prevImg) && $prevImg != '') {
                            unlink("uploadDocuments/Events/" . $prevImg);
                        }
                        move_uploaded_file($txtTempImgName, "uploadDocuments/Events/" . $formattedImgName);
                    }
      
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strTitleE      = ($errFlag == 1) ? $txtTitleE : '';
        $strTitleO      = ($errFlag == 1) ? $txtTitleO : '';
        $strSource      = ($errFlag == 1) ? $txtSource : '';
        $strfromdate    = ($errFlag == 1) ? $startDate : '';
        $strfromtime    = ($errFlag == 1) ? $txtFromTime : '';
        $strtodate      = ($errFlag == 1) ? $endDate : '';
        $strtotime      = ($errFlag == 1) ? $txtToTime : '';
        $strLocation    = ($errFlag == 1) ? $txtLocation : '';
        $strDetailsE    = ($errFlag == 1) ? $txtDetailsE : '';
        $strDetailsO    = ($errFlag == 1) ? $txtDetailsO : '';
        $strImgName     = ($errFlag == 1) ? $formattedImgName : '';
         
        $arrResult = array('strTitleE' => $strTitleE,'strTitleO' => $strTitleO,'strSource' => $strSource,'strfromdate' => $strfromdate,'strfromtime' => $strfromtime,'strtodate' => $strtodate,'strtotime' => $strtotime,'strLocation' => $strLocation,'strDetailsE' => $strDetailsE,'strDetailsO' => $strDetailsO,'strImgName' => $strImgName,'msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

// Function To read Events By::Indrani :: On:: 10-Dec-2020
    public function readEvents($eventId) {

        $result = $this->manageEvents('R',$eventId,'','','','','','','','','','','',0,0,0,'','',0,0); 
        if ($result->num_rows > 0) {
            $row                 = $result->fetch_array();
            $strTitleE           =  htmlspecialchars_decode($row['VCH_TITLE_E'],ENT_QUOTES);
            $strTitleO           =  htmlspecialchars_decode($row['VCH_TITLE_O'],ENT_QUOTES);
            $strSource           =  $row['VCH_SOURCE'];
            $strfromdate         =  ($row['DTM_START_DATE']!='' && $row['DTM_START_DATE']!='0000-00-00')?date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_START_DATE'],ENT_NOQUOTES))):'';
            $strfromtime         =   $row['START_TIME']; 
            $strtodate           =  ($row['DTM_END_DATE']!='' && $row['DTM_END_DATE']!='0000-00-00')?date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_END_DATE'],ENT_NOQUOTES))):'';
            $strtotime           =   $row['END_TIME'];  
            $strLocation         =  htmlspecialchars_decode($row['VCH_LOCATION'],ENT_QUOTES);
            $strDetailsE         =  htmlspecialchars_decode($row['VCH_DESCRIPTION_E'],ENT_QUOTES);
            $strDetailsO         =  htmlspecialchars_decode($row['VCH_DESCRIPTION_O'],ENT_QUOTES);
            $strImgName          =  htmlspecialchars_decode($row['VCH_IMAGE'],ENT_QUOTES); 
        }

        $arrResult = array('strTitleE' => $strTitleE,'strTitleO' => $strTitleO,'strSource' => $strSource,'strfromdate' => $strfromdate,'strfromtime' => $strfromtime,'strtodate' => $strtodate,'strtotime' => $strtotime,'strLocation' => $strLocation,'strDetailsE' => $strDetailsE,'strDetailsO' => $strDetailsO,'strImgName' => $strImgName);
        return $arrResult;
    }
 
// Function To Delete Events By::Indrani :: On:: 10-Dec-2020
    public function deleteEvents($action, $ids) {
                 $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
             
            $result = $this->manageEvents($action,$explIds[$ctr],'','','','','','','','','','','',0,0,0,'','',0,0);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
            $outMsg = 'Event Detail(s) deleted successfully';
        else if ($action == 'IN')
            $outMsg = 'Event Detail(s) unpublished successfully';
        else if($action == 'P')
            $outMsg = 'Event Detail(s) Published successfully';
     

        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}

?>