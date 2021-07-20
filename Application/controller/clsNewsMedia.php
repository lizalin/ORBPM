<?php 
/* * ****Class to manage news and media ********************
'By                     : Indrani'
'On                     : 03-Dec-2020       '
' Procedure Used        : USP_NEWS_MEDIA     '
* ************************************************** */

class clsNewsMedia extends Model {

// Function To Manage Special Info By::Indrani  :: On:: 26-Nov-2020
    public function manageNewsMedia($action,$nId,$txtTitleE,$txtTitleO,$txtDecE,$txtDecO,$txtSourceName,$txtSource,$publishDate,$docfile,$selType,$imgfile,$videofile,$pubStatus,$archiveStatus,$createdBy,$strattr1,$strattr2,$intattr1,$intattr2) {
        $newsmediaSql       = "CALL USP_NEWS_MEDIA('$action',$nId,'$txtTitleE','$txtTitleO','$txtDecE','$txtDecO','$txtSourceName','$txtSource','$publishDate','$docfile',$selType,'$imgfile','$videofile',$pubStatus,$archiveStatus,$createdBy,'$strattr1','$strattr2',$intattr1,$intattr2,@OUT);";//echo $newsmediaSql;
        $errAction        = Model::isSpclChar($action);
        $errTitleE        = Model::isSpclChar($txtTitleE);
        $errDecE          = Model::isSpclChar($txtDecE); 
        $errSourceName    = Model::isSpclChar($txtSourceName);      
        if ($errAction > 0 || $errTitleE > 0 || $errDecE > 0 || $errSourceName > 0)
            header("Location:" . APP_URL . "error");
        else {
            $newsmediaResult = Model::executeQry($newsmediaSql); 
            return $newsmediaResult;
            
        }
    }

// Function To Add Upadate news and media By::Indrani  :: On:: 03-Dec-2020
    public function addUpdateNewsMedia($nId) { 
        $allow_doc_files    = array('pdf','jpg');
        $allow_img_files    = array('jpg','jpeg','png');
        $allow_video_files  = array('mp4');

        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $nId            = (isset($nId))?$nId:0;
        $txtTitleE      = htmlspecialchars($_POST['txtTitleE'], ENT_QUOTES);
        $blankTitle     = Model::isBlank($txtTitleE);
        $errTitle       = Model::isSpclChar($_POST['txtTitleE']);
        $txtTitleO      = htmlspecialchars($_POST['txtTitleO'], ENT_QUOTES);
        $txtDetailsE    = htmlspecialchars($_POST['txtDetailsE'], ENT_QUOTES);
        $blankDetailsE  = Model::isBlank($txtDetailsE);
        $errDetailsE    = Model::isSpclChar($_POST['txtDetailsE']);
        $txtDetailsO    = htmlspecialchars($_POST['txtDetailsO'], ENT_QUOTES);
        $txtSourceName  = ($_POST['txtSourceName']!='')?(htmlspecialchars($_POST['txtSourceName'], ENT_QUOTES)):'';
        $errSourceName  = Model::isSpclChar($_POST['txtSourceName']);
        if($_POST['txtSource']!=''){
          if($_POST['txtSource']=='http://')
            $txtSource = '';
          else
            $txtSource = $_POST['txtSource'];  
        }
        $errvalidUrl = Model::isValidURL($txtSource);

        $txtPublishDate = htmlspecialchars($_POST['txtPublishDate'],ENT_QUOTES);
        $blankPublishDate    = Model::isBlank($txtPublishDate);
        $errPublishDate = Model::isSpclChar($_POST['txtPublishDate']);
        $publishdate    =  ($txtPublishDate!='' && $txtPublishDate!='0000-00-00')?Model::dbDateFormat($txtPublishDate):'';

        $fileDocument   = $_FILES['fileDocument']['name'];
        $prevDocument   = $_POST['hdnDocFile'];
        $extension      = pathinfo($fileDocument, PATHINFO_EXTENSION);
        $txtFileSize    = $_FILES['fileDocument']['size'];
        $txtTempName    = $_FILES['fileDocument']['tmp_name'];
        $formattedFileName = ($fileDocument != '') ? 'NewsMediaDoc_' . time() . '.' . $extension: '';
        if($_FILES['fileDocument']['name']!='')
            $errFile  = Model::isValidFile($_FILES['fileDocument']['name'],$allow_doc_files);
        else
             $errFile  = Model::isValidFile($prevfile,$allow_doc_files);

        $selType = $_POST['selType'];

        $fileImg   = $_FILES['fileImage']['name'];
        $prevImg   = $_POST['hdnImgFile'];
        $extensionImg   = pathinfo($fileImg, PATHINFO_EXTENSION);
        $txtImgSize    = $_FILES['fileImage']['size'];
        $txtTempImgName    = $_FILES['fileImage']['tmp_name'];
        $formattedImgName = ($fileImg != '') ? 'NewsMediaImg_' . time() . '.' . $extensionImg: '';

        $fileVideo   = $_FILES['filevideo']['name'];
        $prevVideo   = $_POST['hdnvideoFile'];
        $extensionVideo   = pathinfo($fileVideo, PATHINFO_EXTENSION);
        $txtVideoSize    = $_FILES['filevideo']['size'];
        $txtTempVideoName    = $_FILES['filevideo']['tmp_name'];
        $formattedVideoName = ($fileVideo != '') ? 'NewsMediaVideo_' . time() . '.' . $extensionVideo: '';
         
        if($selType==1){
            if($_FILES['fileImage']['name']!='')
            $errFileImg  = Model::isValidFile($_FILES['fileImage']['name'],$allow_img_files);
            else
             $errFileImg  = Model::isValidFile($prevImg,$allow_img_files);
        }elseif ($selType==2) {
           if($_FILES['filevideo']['name']!='')
            $errFilevideo  = Model::isValidFile($_FILES['filevideo']['name'],$allow_video_files);
           else
             $errFilevideo  = Model::isValidFile($prevVideo,$allow_video_files);
        } 

        if ($fileDocument == '' && $nId != 0)
            $formattedFileName = $prevDocument;
        if ($fileImg == '' && $nId != 0)
            $formattedImgName = $prevImg;
        if ($fileVideo == '' && $nId != 0)
            $formattedVideoName = $prevVideo;

        if($selType==1){
           $formattedVideoName=''; 
        }elseif($selType==2) {
            $formattedImgName='';
        }

        $outMsg = '';
        $flag = ($nId != 0) ? 1 : 0;
        $action = ($nId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        if(($blankTitle >0 || $blankDetailsE >0 || $blankPublishDate >0 || $selType ==0))
        {
                $errFlag		= 1;
                $flag           = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errTitle>0) || ($errDetailsE>0) || ($errPublishDate>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
        else if($txtSource !='' && $txtSource!='http://')
        {
            if($errvalidUrl > 0){
                $errFlag      = 1;
                $flag                   = 1;
                $outMsg         = "Please Enter Source Url in valid url format(Ex: http://www.google.com)";
                }  
        }
        else if($fileDocument!=''){
              if($errFile==0)
                {
                                $errFlag                = 1;
                                $flag                   = 1;
                                $outMsg                 = "Invalid File types.Upload only pdf or jpg files.";
                }
                else if ($txtFileSize > size10MB) {
                    $errFlag               = 1;
                    $flag                  = 1;
                    $outMsg = 'File size can not more than 10 MB';
                }
        }
        if($selType>0){
            if($selType==1){
                if($errFileImg==0)
                {
                                $errFlag                = 1;
                                $flag                   = 1;
                                $outMsg                 = "Invalid File types.Upload only jpg,jpeg files.";
                }
                else if ($txtImgSize > size10MB) {
                    $errFlag               = 1;
                    $flag                  = 1;
                    $outMsg = 'File size can not more than 10 MB';
                }
            }else if($selType==2){
                if($errFilevideo==0)
                {
                                $errFlag                = 1;
                                $flag                   = 1;
                                $outMsg                 = "Invalid File types.Upload only mp4 files.";
                }
                else if ($txtVideoSize > size10MB) {
                    $errFlag               = 1;
                    $flag                  = 1;
                    $outMsg = 'File size can not more than 10 MB';
                }
            }
        }
       
        if($errFlag==0){
      
            $result = $this->manageNewsMedia($action,$nId,$txtTitleE,$txtTitleO,$txtDetailsE,$txtDetailsO,$txtSourceName,$txtSource,$publishdate,$formattedFileName,$selType,$formattedImgName,$formattedVideoName,0,0,$userId,'','',0,0);
                  
                    if ($result)
                        $outMsg = ($action == 'A') ? 'News and Media added successfully ' : 'News and Media updated successfully';


                    if ($_FILES['fileDocument']['name'] != '') {
                        if (file_exists("uploadDocuments/NewsMedia/" . $prevDocument) && $prevDocument != '') {
                            unlink("uploadDocuments/NewsMedia/" . $prevDocument);
                        }
                        move_uploaded_file($txtTempName, "uploadDocuments/NewsMedia/" . $formattedFileName);
                    }
                     if ($_FILES['fileImage']['name'] != '') {
                        if (file_exists("uploadDocuments/NewsMedia/" . $prevImg) && $prevImg != '') {
                            unlink("uploadDocuments/NewsMedia/" . $prevImg);
                        }
                        move_uploaded_file($txtTempImgName, "uploadDocuments/NewsMedia/" . $formattedImgName);
                    }
                    if ($_FILES['filevideo']['name'] != '') {
                        if (file_exists("uploadDocuments/NewsMedia/" . $prevVideo) && $prevVideo != '') {
                            unlink("uploadDocuments/NewsMedia/" . $prevVideo);
                        }
                        move_uploaded_file($txtTempVideoName, "uploadDocuments/NewsMedia/" . $formattedVideoName);
                    }
      
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strTitleE   = ($errFlag == 1) ? $txtTitleE : '';
        $strTitleO   = ($errFlag == 1) ? $txtTitleO : '';
        $strDetailsE   = ($errFlag == 1) ? $txtDetailsE : '';
        $strDetailsO   = ($errFlag == 1) ? $txtDetailsO : '';
        $strSourceName = ($errFlag == 1) ? $txtSourceName : '';
        $strSource     = ($errFlag == 1) ? $txtSource : '';
        $publishdate  = ($errFlag == 1) ? $publishdate : '';
        $strFileName  = ($errFlag == 1) ? $formattedFileName : '';
        $selType      = ($errFlag == 1) ? $selType : 0;
        $strImgName   = ($errFlag == 1) ? $formattedImgName : '';
        $strVideoName = ($errFlag == 1) ? $formattedVideoName : '';
         
        $arrResult = array('strTitleE' => $strTitleE,'strTitleO' => $strTitleO,'strDetailsE' => $strDetailsE,'strDetailsO' => $strDetailsO,'strSourceName' => $strSourceName,'strSource' => $strSource,'publishdate' => $publishdate,'strFileName' => $strFileName,'selType' => $selType,'strImgName' => $strImgName,'strVideoName' => $strVideoName,'msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

// Function To read news and media Info By::Indrani :: On:: 03-Dec-2020
    public function readNewsMedia($nId) {

        $result = $this->manageNewsMedia('R',$nId,'','','','','','','','',0,'','',0,0,0,'','',0,0); 
        if ($result->num_rows > 0) {
           $row                  = $result->fetch_array(); 
           $strTitleE       = htmlspecialchars_decode($row['VCH_TITLE_E'],ENT_QUOTES);
           $strTitleO       = htmlspecialchars_decode($row['VCH_TITLE_O'],ENT_QUOTES);
           $strDetailsE     = htmlspecialchars_decode($row['VCH_DESCRIPTION_E'],ENT_QUOTES);
           $strDetailsO     = htmlspecialchars_decode($row['VCH_DESCRIPTION_O'],ENT_QUOTES);
           $strSourceName   = htmlspecialchars_decode($row['VCH_SOURCE_NAME'],ENT_QUOTES);
           $strSource       = $row['VCH_SOURCE'];
           $publishdate     = ($row['DTM_PUBLISH_DATE']!='' && $row['DTM_PUBLISH_DATE']!='0000-00-00')?date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_PUBLISH_DATE'],ENT_NOQUOTES))):'';
           $strFileName     = $row['VCH_DOCUMENT'];
           $selType         = $row['INT_TYPE_ID'];
           $strImgName      = $row['VCH_IMAGE'];
           $strVideoName    = $row['VCH_VIDEO_FILE'];  
        }

        $arrResult = array('strTitleE' => $strTitleE,'strTitleO' => $strTitleO,'strDetailsE' => $strDetailsE,'strDetailsO' => $strDetailsO,'strSourceName' => $strSourceName,'strSource' => $strSource,'publishdate' => $publishdate,'strFileName' => $strFileName,'selType' => $selType,'strImgName' => $strImgName,'strVideoName' => $strVideoName);
        return $arrResult;
    }
 
// Function To Delete News and Media By::Indrani :: On:: 02-Dec-2020
    public function deletenewsmedia($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
             
            $result = $this->manageNewsMedia($action,$explIds[$ctr],'','','','','','','','',0,'','',0,0,0,'','',0,0);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
            $outMsg = 'News and Media(s) deleted successfully';
        else if ($action == 'IN')
            $outMsg = 'News and Media(s) unpublished successfully';
        else if($action == 'P')
            $outMsg = 'News and Media(s) Published successfully';
     

        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}

?>