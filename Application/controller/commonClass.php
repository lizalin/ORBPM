<?php

    /* ================================================
      File Name         	  : commonClass.php
      Description		  : This is used for manage all common classes. 
      Devloped By		  : CHINMAYEE
      Devloped On	          : 20-MAY-2016
      Update History	  :	<Updated by>		<Updated On>		<Remarks>
                                Ashis Kumar Patra          05-Oct-2016          added function for important services
      ================================================== */
/* * ****Class to manage GAllery Category ********************
'By                     : CHINMAYEE'
'On                     : 26-MAY-2016
'Procedure Used        : USP_GALLERY_CATEGORY       '
* ************************************************** */
ob_start();
date_default_timezone_set('Asia/Kolkata');
class clsGalleryCategory extends Model {
    
    // Function To Manage gallery  Category By::Shweta   :: On:: 2-Nov-2017 
    public function manageGalleryCategory($action, $catId,$intcatType,$plugintype, $category, $categoryO, $description,$descriptionO,$pubStatus ,$createdBy) {
        $catId         = htmlspecialchars(addslashes($catId),ENT_QUOTES);
        $intcatType    = htmlspecialchars(addslashes($intcatType),ENT_QUOTES);
        $plugintype    = htmlspecialchars(addslashes($plugintype),ENT_QUOTES);
        $category      = htmlspecialchars(addslashes($category),ENT_QUOTES);
        $categoryO     = htmlspecialchars(addslashes($categoryO),ENT_QUOTES);
        $description   = htmlspecialchars(addslashes($description),ENT_QUOTES);
        $descriptionO  = htmlspecialchars(addslashes($descriptionO),ENT_QUOTES);
        
        $categorySql = "CALL USP_GALLERY_CATEGORY('$action', $catId,$intcatType,$plugintype,'$category','$categoryO', '$description','$descriptionO','$pubStatus', $createdBy,@OUT);";
        /* if($action == 'U'){
            echo $categorySql;exit;
        } */
        
        $errAction        = Model::isSpclChar($action);
        $errCategory      = Model::isSpclChar($category);
        $errDescription   = Model::isSpclChar($description);
        
        if ($errAction > 0 || $errCategory > 0 || $errDescription > 0)
            header("Location:" . APP_URL . "error");
        else {
            $categoryResult = Model::executeQry($categorySql);
            return $categoryResult;
        }
    }
    // Function To Add Upadate Gallery Category By::CHINMAYEE   :: On:: 26-MAY-2016 
    public function addUpdateGalleryCategory($catId) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId                 = $_SESSION['adminConsole_userID']; 
        $selCattype             = 0;
        $selplugintype          = 0;
        $txtCategory            = htmlspecialchars(addslashes($_POST['txtCategory']), ENT_QUOTES);
        $txtCategoryO           = '';
        $blankCategory          = Model::isBlank($txtCategory);
        $errCategory            = Model::isSpclChar($_POST['txtCategory']);
        $lenCategory            = Model::chkLength('max', $txtCategory,100);
        $radStatus              = htmlspecialchars(addslashes($_POST['intStatus']), ENT_QUOTES);;
        $outMsg                 = '';
        $flag                   = ($catId != 0) ? 1 : 0;
        $action                 = ($catId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if(($blankCategory >0))
        {
                $errFlag		= 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenCategory>0)
        {
                $errFlag		= 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if(($errCategory>0))
        {
                $errFlag		= 1;
                $outMsg			= "Special Characters are not allowed";
        }
        
        $dupResult = $this->manageGalleryCategory('CD', $catId,$selCattype,$selplugintype,$txtCategory,'','','',0,$userId);
         if($errFlag==0){
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Gallery Category with this name already exists';
                $errFlag = 1;
            } else {
                $action=($catId >0) ? 'U' : 'A';

                $result = $this->manageGalleryCategory($action, $catId,$selCattype,$selplugintype,$txtCategory,$txtCategoryO,'','',$radStatus,$userId);
                if ($result)
                    $outMsg = ($action == 'A') ? 'Gallery Category added successfully ' : 'Gallery Category updated successfully';
               
                }
            }
         }
         }
         else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strCategory        = ($errFlag == 1) ? $txtCategory : '';
        $strCategoryO       = ($errFlag == 1) ? $txtCategoryO : '';
        $intStatus          = ($errFlag == 1) ? $radStatus : '2'; 
        $selplugintype      = ($errFlag == 1) ? $selplugintype : '0'; 
        $selCattype         = ($errFlag == 1) ? $selCattype : '0';
        $arrResult = array('msg' => $outMsg, 'flag' => $flag,'selCattype' => $selCattype,'strCategoryO' => $strCategoryO, 'strCategory' => $strCategory, 'selplugintype' => $selplugintype, 'intStatus' => $intStatus);
        return $arrResult;
    }

    // Function To read Gallery Category  By::CHINMAYEE   :: On:: 26-MAY-2016 
    public function readGalleryCategory($id) {

        $result = $this->manageGalleryCategory('R', $id,0,0,'','','','',0 ,0);
        if ($result->num_rows > 0) {

            $row               = $result ->fetch_array();
            $strCategory       = htmlspecialchars_decode($row['VCH_CATEGORY_NAME'],ENT_QUOTES);
            $strCategoryO      =  htmlspecialchars_decode($row['VCH_CATEGORY_NAME_O'],ENT_QUOTES);
            $intCattype        = $row['INT_TYPE'];
            $strDescription    = htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_QUOTES);
            $strDescriptionO   = htmlspecialchars_decode($row['VCH_DESCRIPTION_O'],ENT_QUOTES);
            $intStatus         = $row['INT_PUBLISH_STATUS']; 
            $selplugintype     = $row['INT_PLUGIN_TYPE'];
        }

        $arrResult = array('selplugintype' => $selplugintype, 'intCattype' => $intCattype,'strCategoryO' => $strCategoryO,'strCategory' => $strCategory, 'strDescription' => $strDescription,'strCategoryO' => $strCategoryO, 'strDescriptionO' => $strDescriptionO,'intStatus'=>$intStatus);
        return $arrResult;
    }

    // Function To Delete Gallery Category  By::CHINMAYEE   :: On:: 26-MAY-2016 
    public function deleteGalleryCategory($action, $ids) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageGalleryCategory($action,$explIds[$ctr],0,0,'','','','', 0 ,$userId); 
            $row = $result ->fetch_array();
            if ($row[0] == '0'){
                    $delRec++;
                }else{
                    $delRec = 0;
                }
            $ctr++;
        }
        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg = 'Category(s) deleted successfully';
            else
                $outMsg = 'Dependency record exist. Page(s) can not be deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Category(s) activated successfully';
        else if ($action == 'UIN')
            $outMsg = 'Category(s) deactivated successfully';
        
        return $outMsg;
    }


}


/* * ****Class to manage Gallery ********************
'By                     : Chinmayee'
'On                     : 26-May-2016       '
' Procedure Used        : USP_GALLERY       '
* ************************************************** */

class clsGallery extends Model {

// Function To Manage Gallery By::Chinmayee  :: On:: 27-May-2016
    public function manageGallery($action,$galleryId,$typeId,$pluginid,$categoryId,$videotypeId,$caption,$captionH,$thumbImage,$largeImage,$description,$descriptionO,$strUrl,$pubStatus,$archiveStatus,$createdBy,$portalType,$screenType=0) {
        $galleryId        = htmlspecialchars(addslashes($galleryId),ENT_QUOTES);
        $caption          = htmlspecialchars(addslashes($caption),ENT_QUOTES);    
        $description      = addslashes($description);  
        $gallerySql       = "CALL USP_GALLERY('$action',$galleryId,$typeId,$pluginid,$categoryId,$videotypeId,'$caption','$captionH','$thumbImage','$largeImage','$description','$descriptionO','$strUrl',$pubStatus,$archiveStatus,$createdBy,'$portalType',$screenType,@OUT);";
        // if($action == 'A'){
        //     echo $gallerySql;exit;        
        // }
        $errAction        = Model::isSpclChar($action);
        $errCaption       = Model::isSpclChar($caption);
        $errfetImage      = Model::isSpclChar($largeImage);       
        if ($errAction > 0 || $errCaption > 0 || $errfetImage > 0)
            header("Location:" . APP_URL . "error");
        else {
            $galleryResult = Model::executeQry($gallerySql); 
            return $galleryResult;
            
        }
    }

// Function To Add Upadate Gallery By::Chinmayee  :: On:: 27-May-2016
    public function addUpdateGallery($galleryId) { 
        
        $allow_img_files=array('jpeg','jpg','gif','png');
        $allow_media_files = array('mp4','wmv');
        $newSessionId        = session_id();
        $hdnPrevSessionId   = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $galleryId      = (isset($galleryId))?$galleryId:0;
        /*$screenType     = htmlspecialchars($_POST['selScreen'], ENT_QUOTES);*/
        $screenType =0;
        $errscreenType  = Model::isSpclChar($_POST['selScreen']);
        $setType        = htmlspecialchars($_POST['selType'], ENT_QUOTES);
        $errsetType     = Model::isSpclChar($_POST['selType']);
        $numPluginId    = ($_POST['ddlPlugin']!=0)?htmlspecialchars($_POST['ddlPlugin'], ENT_QUOTES):1;
        $numcategoryId  = htmlspecialchars($_POST['selCategory'], ENT_QUOTES);
        $errcategoryId  = Model::isSpclChar($_POST['selCategory']);
        $rbtLnkType     = '';
        $errrbtLnkType  = '';
        $txtHeadline    = htmlspecialchars($_POST['txtCaption'], ENT_QUOTES);
        $errCaption     = Model::isSpclChar($_POST['txtCaption']);
        $txtHeadlineO   = '';
        $videoFileName  = '';
        $txtDescription =  htmlspecialchars($_POST['strDescription'], ENT_QUOTES);
        $txtLargeimage  = $_FILES['fileDocument']['name'];
        $prevLargeImage = $_POST['hdnImageFile'];
        $extension      = pathinfo($txtLargeimage, PATHINFO_EXTENSION);
        $txtFileSize    = $_FILES['fileDocument']['size'];
        $txtTempName    = $_FILES['fileDocument']['tmp_name'];
        $formattedFileName = ($txtLargeimage != '') ? 'UP_Gallery_' . time() . '.' . $extension: '';
        if($txtLargeimage!='')
            $errImageFile  = Model::isValidFile($txtLargeimage,$allow_img_files);
          else
            $errImageFile  = Model::isValidFile($prevLargeImage,$allow_img_files);
        
        if ($txtLargeimage == '' && $galleryId != 0)
            $formattedFileName = $prevLargeImage;
        if ($filevideo == '' && $galleryId != 0)
            $videoFileName = $prevVideoFile;
        
        if ($setType == 2) {
            $txtUrl = '';
            $videoFileName = '';
            $rbtLnkType = 0;
        }
       
        $outMsg = '';
        $flag = ($galleryId != 0) ? 1 : 0;
        $action = ($galleryId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        /*if(($blankCaption >0) || ($setType==0) || ($screenType==0)) 
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }*/
        if(($errCaption>0) || ($errsetType>0)|| ($errcategoryId>0)||($errrbtLnkType>0) || ($errscreenType>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
        else if($errImageFile==0 || ($errImageFile%2) ==0)
        {
                $errFlag                = 1;
                $flag                   = 1;
                $outMsg                 = "Invalid File types.Upload only jpeg,jpg,gif,png.";
        }
       
        else if ($txtFileSize > size10MB) {
            $errFlag               = 1;
            $flag                  = 1;
            $outMsg = 'Image File size can not more than 10 MB';
        }
        $dupResult = $this->manageGallery('CD',$galleryId,$setType,0,$numcategoryId,0,$txtHeadline,'','','','','','',0,0,0,'',0);
       // echo "1".$numRows;exit;
        if($errFlag==0){
            if ($dupResult) {
                $numRows = $dupResult->fetch_array();
                 if ($numRows > 0) {
                    $outMsg = 'Media Details already exists';
                    $errFlag = 1;
                    $flag   = 1;
                } else { 
                    
                    $txtDescriptionH='';
                    $result = $this->manageGallery($action,$galleryId,$setType,$numPluginId,$numcategoryId,$rbtLnkType,$txtHeadline,$txtHeadlineO,$videoFileName,$formattedFileName,$txtDescription,$txtDescriptionH,$txtUrl,0,0,$userId,'',$screenType);
                  
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Media Details added successfully ' : 'Media Details updated successfully';
                   
                    if ($_FILES['fileDocument']['name'] != '') {
                        
                        if (file_exists("uploadDocuments/gallery/".$prevLargeImage) && $prevLargeImage != '')
                        {
                            unlink("uploadDocuments/gallery/"  . $prevLargeImage);
                        }

                         $this->GetResizeImage($this,'uploadDocuments/Video/ThumbImage/',350,0,$formattedFileName,$txtTempName);
                        // move_uploaded_file($txtTempName, "uploadDocuments/gallery/" . $formattedFileName);
                         $this->GetResizeImages('uploadDocuments/gallery/',800,600,$formattedFileName,$txtTempName);
                        
                    }

                    if ($_FILES['filevideo']['name'] != '') {
                        if (file_exists("uploadDocuments/Video/VideoFile/" . $prevVideoFile) && $prevVideoFile != '') {
                            unlink("uploadDocuments/Video/VideoFile/" . $prevVideoFile);
                        }
                        move_uploaded_file($videoTempName, "uploadDocuments/Video/VideoFile/" . $videoFileName);
                    }
                    if ($_FILES['fileAudio']['name'] != '') {
                        if (file_exists("uploadDocuments/Video/AudioFile/" . $prevAudio) && $prevAudio != '') {
                            unlink("uploadDocuments/Video/AudioFile/" . $prevAudio);
                        }
                        move_uploaded_file($AudioTempName, "uploadDocuments/Video/AudioFile/" . $audioFileName);
                    }  
                    
                }
            }
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $intCategory       = ($errFlag == 1) ? $numcategoryId : '0'; 
        $intType           = ($errFlag == 1) ? $setType : '0';
        $strFileName        = ($errFlag == 1) ? $fileDocument : '';
        $strCaptionO         = ($errFlag == 1) ? $txtHeadlineO : '';
        $strCaption         = ($errFlag == 1) ? $txtHeadline : '';
        $strDescription         = ($errFlag == 1) ? $txtDescription : ''; 
        $intscreenType      = ($errFlag == 1) ? $screenType  : '0';
       
        $arrResult = array('strCaptionO' => $strCaptionO,'intCategory' => $intCategory,'strFileName' => $strFileName,'strPlace' => $strPlace,'msg' => $outMsg, 'flag' => $flag, 'strCaption' => $strCaption,'strCaptionH' => $strCaptionO,'intType'=>$intType, 'strDescription' => $strDescription,'intscreenType' => $intscreenType);
        return $arrResult;
    }

// Function To read Gallery  By::Chinmayee  :: On:: 27-May-2016
    public function readGallery($id) {

        $result = $this->manageGallery('R',$id,0,0,0,0,'','','','','','','',0,0,0,''); 
        if ($result->num_rows > 0) {
            $row                  = $result->fetch_array();
            $strCaption           =  htmlspecialchars_decode($row['VCH_HEADLINE_E'],ENT_QUOTES);
            $strCaptionH          =  $row['VCH_HEADLINE_O'];
            $strThumbFileName     = $row['VCH_THUMB_IMAGE'];
            $strFileName          = $row['VCH_LARGE_IMAGE'];
            $strDescription       = htmlspecialchars_decode($row['VCH_DESCRIPTION_E'],ENT_NOQUOTES);  
            $strDescriptionH      = $row['VCH_DESCRIPTION_O'];  
            $intCategory          = $row['INT_CATEGORY_ID'];
            $intType              = $row['INT_TYPE_ID'];
            $intplugin            = $row['INT_PLUGIN_ID'];
            $strEmbedurl          = $row['VCH_URL'];
            $intVideolinktype     = $row['INT_VIDEO_LINK_TYPE'];
            $strPortaltype        = $row['VCH_PORTAL_TYPE'];
            $intscreenType        = $row['INT_SCREEN_TYPE'];
        }

        $arrResult = array('intplugin'=>$intplugin,'strPortaltype'=>$strPortaltype,'intVideolinktype'=>$intVideolinktype,'strEmbedurl'=>$strEmbedurl,'strThumbFileName'=>$strThumbFileName,'intType'=>$intType,'strCaptionH'=>$strCaptionH,'strDescriptionH'=>$strDescriptionH,'strCaption' => $strCaption, 'strFileName' => $strFileName, 'intCategory' => $intCategory, 'strDescription' => htmlspecialchars_decode($strDescription,ENT_NOQUOTES), 'intscreenType' => $intscreenType);
        return $arrResult;
    }
// Function To view Gallery  By::Ashis Kumar Patra  :: On:: 12-Oct-2016
    public function viewGallery($action,$intRecno,$intTYPE,$intCattype,$publish,$arcStatus) {

        $result = $this->manageGallery($action,$intRecno,$intTYPE,$intCattype,0,0,'','','','','','','',$publish,$arcStatus,0,'',''); 

        return $result;
    } 	
 // Function To view Gallery  By::Ashis Kumar Patra  :: On:: 12-Oct-2016
    public function viewPubGallery($action,$intRecno,$intTYPE,$intCattype,$intCatID,$publish,$arcStatus) {

        $result = $this->manageGallery($action,$intRecno,$intTYPE,$intCattype,$intCatID,0,'','','','','','','',$publish,$arcStatus,0,'',''); 

        return $result;
    } 
// Function To Delete Gallery  By::Chinmayee  :: On:: 27-May-2016
    public function deleteGallery($action, $ids) {
                 $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
             
            $result = $this->manageGallery($action,$explIds[$ctr],0,0,0,0,'','','','','','','',0,0,0,'');                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
            $outMsg .= 'Gallery Detail(s) deleted successfully';
         else if ($action == 'AC')
            $outMsg = 'Gallery(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Gallery(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Gallery(s) archieved successfully';
        else if($action == 'P')
            $outMsg = 'Gallery(s) Published successfully';
     

        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}





/* * ****Class to manage Notification ********************
'By                     : Ashis Kumar Patra'
'On                     :10-Oct-2016       '
' Procedure Used        : USP_NOTIFICATION       '
* ************************************************** */

class clsNotification extends Model {

// Function To Manage Notification/Tender/Route Rationalization  By::Sonali  :: On:: 29-Sept-2016
    public function manageNotification($action,$ntfId,$linkType,$sectionid,$intTemptype,$intWinstatus,$intContenttype,$intPluginId,$strUrl,$caption,$txtHeadlineO,$txtDetaile,$txtDetailo,$txtCode,$doc,$date,$closedate,$pubStatus,$archiveStatus,$createdBy,$blinksts,$intSlno) {
        $ntfId            = htmlspecialchars(addslashes($ntfId),ENT_QUOTES);
        $caption          = htmlspecialchars(addslashes($caption),ENT_QUOTES);    
        $Sql              = "CALL USP_NOTIFICATION('$action',$ntfId,$linkType,$sectionid,$intTemptype,$intWinstatus,$intContenttype,$intPluginId,'$strUrl','$caption','$txtHeadlineO','$txtDetaile','$txtDetailo','$txtCode','$doc','$date','$closedate','$pubStatus','$createdBy','$archiveStatus','$blinksts','$intSlno',@OUT);";
       //echo $Sql; //exit;
        $errAction        = Model::isSpclChar($action);
       //$errCaption       = Model::isSpclChar($caption);
           
        if ($errAction > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($Sql); 
            return $sqlResult;
            
        }
    }

// Function To Add Upadate Notification/Tender/Route Rationalization  By::Ashis Kumar Patra  :: On::12-Oct-2016
    public function addUpdateNotification($ntfId) {
        //echo 111;exit;
        $allow_doc_files    = array('pdf','xls','xlsx','PDF','XLS','XLSX');
        $clear = array('object', 'iframe', 'form', 'frame', 'script', 'select', 'input', 'select', 'option');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        if ($newSessionId == $hdnPrevSessionId) {
        $userId                 = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
/*        $ntfId                  = (isset($ntfId))?$ntfId:0;
*/     //$ntfId=0;
        $intSecId               = ($_POST['noticeType']!=0)?htmlspecialchars($_POST['noticeType'], ENT_QUOTES):0;
        $errSecId               = Model::isSpclChar($_POST['noticeType']);
        $linkType               = htmlspecialchars($_POST['radStatus1'], ENT_QUOTES);
        $errlinkType            = Model::isSpclChar($_POST['radStatus1']);
        $rbtLnkType             = htmlspecialchars($_POST['radStatus'], ENT_QUOTES);
        $errbtlinkType            = Model::isSpclChar($_POST['radStatus']);
            $txtHeadline            = htmlspecialchars($_POST['txtCategory'], ENT_QUOTES);
            $txtHeadlineO           = htmlspecialchars($_POST['txtCategoryO'], ENT_QUOTES);
            $txtCode                = htmlspecialchars($_POST['txtrandNum'], ENT_QUOTES);
            $blankCaption           = Model::isBlank($txtHeadline);
            $errCaption             = Model::isSpclChar($_POST['txtCategory']);
            $errCode                = Model::isSpclChar($_POST['txtrandNum']);

            $hdnTotalDoc            = $_POST['hdnTotalDoc'];
            $txtdate                = htmlspecialchars($_POST['txtClosingDate'],ENT_QUOTES);
            $txtstartdate           = htmlspecialchars($_POST['txtStartDate'],ENT_QUOTES);
            $errdate                = Model::isSpclChar($_POST['txtClosingDate']);
            if($txtdate!='' && $txtdate!='0000-00-00 00:00:00'){
            $DateTime               =  Model::dbDateFormat($txtdate);
            }else{
            $DateTime               =  '0000-00-00 00:00:00';
            }
            $startDateTime          =  ($txtstartdate!='' && $txtstartdate!='0000-00-00 00:00:00')?Model::dbDateFormat($txtstartdate):'0000-00-00';
            $errstdate              = Model::isSpclChar($_POST['txtStartDate']);
            $rbtContentType           = ($_POST['rbtLnkType']!='')?$_POST['rbtLnkType']:1;
        if ($rbtContentType == 2) {
            $txtURL = htmlspecialchars(addslashes($_POST['txtURL']), ENT_QUOTES);
            //echo $txtURL;exit;
            $errPageFlag    = 0;
            $errPageFlagH   =0;
            $txtContentE = '';
            $txtContentH = '';
        } else
            $txtURL = '';
         $radTemplateType = htmlspecialchars($_POST['radTemplateType'],ENT_QUOTES);
         $errFile   = 1;
        if ($radTemplateType == 1) {
           
          $selplginid             =0;
          $txtDetailsE = Model::strip_editor_tag_content($_POST['txtDetailsE'], $clear);
          $txtDetailsE   = (isset($_POST['txtDetailsE']))?htmlspecialchars($txtDetailsE, ENT_QUOTES):'';
          $errDetailsE    = Model::isSpclChar($_POST['$txtDetailsE']);
          $txtDetailsO = Model::strip_editor_tag_content($_POST['txtDetailsO'], $clear);
          $txtDetailsO   = (isset($_POST['txtDetailsO']))?htmlspecialchars( $txtDetailsO, ENT_QUOTES):'';
          $errDetailsO    = Model::isSpclChar($_POST['$txtDetailsO']);
        } else if ($radTemplateType == 2 && $rbtContentType==1) {
            $txtDetailsE = '';
            $txtDetailsO = '';
            $selplginid  = 0;
            $query1		 = '';
                    $hdnTotalDocument = count($_FILES['fileDocument']['name']);
                    
                    for($i=0;$i<$hdnTotalDocument;$i++)
                    {  
                        $fileMaterial		= $_FILES['fileDocument']['name'][$i];
                        $extension      = pathinfo($fileMaterial, PATHINFO_EXTENSION);
                        
                                $formattedFileName = ($fileMaterial != '') ? 'document_'.$i.'_' . time() . '.' . $extension: '';
                                $ptevFileMaterial   = $_POST['hdnDocFile'][$i];
                                $txtTempName    = $_FILES['fileDocument']['tmp_name'][$i];
                                if($_FILES['fileDocument']['name'][$i]!='')
                                    $errFile  = Model::isValidFile($_FILES['fileDocument']['name'][$i],$allow_doc_files);
                                   //else
                                    // $errFile  = Model::isValidFile($ptevFileMaterial ,$allow_doc_files); 
                                if($fileMaterial!='')
                                {
                                    if (file_exists($uploadPath . $fileMaterial) && $ptevFileMaterial != '')
                                        unlink($uploadPath . $ptevFileMaterial);
                                        move_uploaded_file($txtTempName, "uploadDocuments/Notification/" . $formattedFileName);

                                }else{
                                    $formattedFileName = $ptevFileMaterial;
                                }

                                 $query1	.='"'.$formattedFileName.'",';
                         
                    }
                    $query1	= substr($query1,0,-1);
                    
        } else if ($radTemplateType == 3) {
            $txtDetailsE    = '';
            $txtDetailsO   = '';
           $selPlugin = $_POST['selPluginName'];
           $selPluginNameArr=  explode("_", $selPlugin);
           $selplginid   = $selPluginNameArr[1];
           //$selFunctionid  = $selPluginNameArr[1];
        }
        $radWinStatus       = ($_POST['radWinStatus']!='')?$_POST['radWinStatus']:1;
        $chkblink               = $_POST['chkbox'];
        $uploadPath             = "uploadDocuments/Notification/";
       
        $selplginid              = ($selplginid!='')?$selplginid:0;
        $radTemplateType         = ($radTemplateType!='')?$radTemplateType:0;
        
        if(isset($_POST['chkbox'])){
           $blanksts =1;
        } 
        else {
           $blanksts =0;
        }
       
        $outMsg     = '';
        $flag       = ($ntfId != 0) ? 1 : 0;
       
        $action     = ($ntfId == 0) ? 'A' : 'U';
        $errFlag    = 0 ;
        if($action=='A')
        $intSlNo            = (Model::getMaxVal('INT_SLNO','t_notification','BIT_DELETED_FLAG')=='')?1:Model::getMaxVal('INT_SLNO','t_notification','BIT_DELETED_FLAG');
        else 
          
           $intSlNo        = $_POST['hdnSlNo'];
           $errFlag            = 0 ;
          
        if(($blankCaption >0) ) 
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errCode >0) ||($errdate>0) ||($errstdate>0) || ($errDetailsE >0) || ($errDetailsO >0) || ($errSecId>0) || ($errlinkType>0) || ($errbtlinkType>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
      if ($radTemplateType == 2 && $linkType==1) {
                if($errFile==0 || ($errFile%2)==0)
                {
                        $errFlag                = 1;
                        $flag                   = 1;
                        $outMsg                 = "Invalid File types.Upload only pdf,xls.";
                }
        }
        
        if($errFlag==0){
            $dupResult = $this->manageNotification('CD',$ntfId,$linkType,0,0,0,0,0,'',$txtHeadline,'','','','','','0000-00-00','0000-00-00',0,0,$userId,0,0,0);
       
             if ($dupResult) {
                $numRows = $dupResult->fetch_array();
                if ($numRows > 0) {
                    $outMsg = 'Notification already exists';
                    $errFlag = 1;
                    $flag   = 1;
                } else {
                     
                    $result = $this->manageNotification($action,$ntfId,$linkType, $intSecId,$radTemplateType,$radWinStatus,$rbtContentType,$selplginid,$txtURL,$txtHeadline,$txtHeadlineO,$txtDetailsE,$txtDetailsO,$txtCode,$query1,$startDateTime,$DateTime,$rbtLnkType,2,$userId,$blanksts,$intSlNo);
                  
                    if ($result)
                       
                        $outMsg = ($action == 'A') ? 'Data added successfully ' : 'Data updated successfully';
                   
            
                }
            }
        }
       }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $numPluginId       = ($errFlag == 1) ? $numPluginId : '0';              
        $strFileName       = ($errFlag == 1) ? $fileDocument : '';
        $txtHeadline       = ($errFlag == 1) ? $txtHeadline : '';
        $txtHeadlineO       = ($errFlag == 1) ? $txtHeadlineO : '';
        $txtCode           = ($errFlag == 1) ? $txtCode : '';
        $DateTime          = ($errFlag == 1) ? $DateTime : '';
        $startDateTime     = ($errFlag == 1) ? $startDateTime : '';
        $rbtLnkType        = ($errFlag == 1) ? $rbtLnkType : '1';
        $linkType          = ($errFlag == 1) ? $linkType : '1'; 
       $rbtContentType     = ($errFlag == 1) ? $rbtContentType:'1';
       $txtURL             = ($errFlag == 1) ? $txtURL:'http://';
       $radTemplateType    = ($errFlag == 1) ? $radTemplateType:'1'; 
       $selplginid         = ($errFlag == 1) ? $selplginid:'0';
       $radWinStatus       = ($errFlag == 1) ? $radWinStatus:'1';
        $txtDetailsE       = ($errFlag == 1) ? $txtDetailsE:'';
        $txtDetailsO      = ($errFlag == 1) ? $txtDetailsO:'';
        $arrResult = array('intCategory' => $numPluginId,'strblink'=>$blanksts,'strCaptionO'=>$txtHeadlineO,'intUrlType'=>$rbtContentType,'strUrl'=>$txtURL,'intTemplateTYpe'=>$radTemplateType,'intPluginId'=>$selplginid,'intWinStatus'=>$radWinStatus,'txtCode' => $txtCode,'strFileName' => $strFileName,'txtHeadline' => $txtHeadline,'strDetailE'=>$txtDetailsE,'strDetailO'=>$txtDetailsO,'msg' => $outMsg, 'flag' => $errFlag,'startDateTime' => $startDateTime,  'DateTime' => $DateTime, 'rbtLnkType' => $rbtLnkType,'linkType' => $linkType);
        return $arrResult;
    }

// Function To read Notification/Tender/Route Rationalization  By::Ashis Kumar Patra  :: On::12-Oct-2016
    public function readNotification($id) {

        $result = $this->manageNotification('R',$id,0,0,0,0,0,0,'','','','','','','','0000-00-00','0000-00-00',0,0,0,0,0); 
        if ($result->num_rows > 0) {
            $row                  = $result-> fetch_array();
            $strCaption           =  htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_QUOTES);
            $strdoc               =  $row['VCH_DOCUMENT'];
            $intType              = $row['INT_PLUGIN_TYPE'];
            $intContentType       = $row['INT_URL_TYPE'];
            $strURL               = $row['VCH_URL'];
            $intSlNo                = $row['INT_SLNO'];
            $strDetailE           = $row['VCH_DETAILE'];
            $strDetailO           = $row['VCH_DETAILO'];
            $intTemplateType      = $row['INT_TEMPLATE_TYPE'];
            $intWinStatus         = $row['INT_WIN_STATUS'];
            $intPluginId          = $row['INT_PLUGIN_ID'];
            $strCaptionO          =  htmlspecialchars_decode($row['VCH_HEADLINE_O'],ENT_QUOTES);
            $strdate              = date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_NOTIFICATION_DATE'],ENT_NOQUOTES)));
            $stractive            = $row['INT_PUBLISH_STATUS'];  
            $strblink             = $row['INT_BLINK_STATUS'];
            $strCode          =  htmlspecialchars_decode($row['VCH_CODE'],ENT_QUOTES);
            $strlinkType             = $row['INT_LINK_TYPE'];
            $strstartdate              = date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_NOTICE_START'],ENT_NOQUOTES)));

        }

        $arrResult = array('strCode'=>$strCode,'strlinkType'=>$strlinkType,'intUrlType'=> $intContentType,'strUrl'=>$strURL,'intTemplateTYpe'=>$intTemplateType,'intPluginId'=>$intPluginId,'intWinStatus'=>$intWinStatus,'strstartdate'=>$strstartdate,'strblink'=>$strblink,'strCaptionO'=>$strCaptionO,'strCaption'=>$strCaption,'strDetailE'=>$strDetailE,'strDetailO'=>$strDetailO,'strdoc'=>$strdoc,'intType'=>$intType,'strdate'=>$strdate,'stractive'=>$stractive ,'intSlNo'=>$intSlNo);
        return $arrResult;
    }
	

// Function To Delete Notification/Tender/Route Rationalization  By::Ashis Kumar Patra  :: On::12-Oct-2016
    public function deleteNotification($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {      
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        
        foreach ($explIds as $indIds) {
              if($action=='US')
            $slNumber	= $_POST['txtSLNo'.$explIds[$ctr]];
            else
            $slNumber   =0;
            $result = $this->manageNotification($action,$explIds[$ctr],0,0,0,0,0,0,'','','','','','','','0000-00-00','0000-00-00',0,0,$userId,0,$slNumber);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
                $outMsg .= 'Data Detail(s) deleted successfully';
     
        else if ($action == 'AC')
            $outMsg = 'Data(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Data(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Data(s) archieved successfully';
        else if($action == 'P')
            $outMsg = 'Data(s) Published successfully';
        else if ($action == 'US')
                 $outMsg = 'Serial number updated successfully';
        return $outMsg;
        }
        else {
        return   $outMsg = 'Transaction fail due to session mismatch.';
        }
    }

}

/* * ****Class to manage Act and rule ********************
'By                     : Chinmayee'
'On                     : 28-May-2016       '
'Procedure Used        : USP_ACT_RULES       '
* ************************************************** */

class clsActRules extends Model {

// Function To Manage Act and rule  By::Chinmayee  :: On:: 28-May-2016
    public function manageActRules($action,$ntfId,$pluginid,$caption,$captionO,$doc,$pubStatus,$archiveStatus,$createdBy,$blinksts) {
        $ntfId            = htmlspecialchars(addslashes($ntfId),ENT_QUOTES);
        $caption          = htmlspecialchars(addslashes($caption),ENT_QUOTES);    
        $Sql                = "CALL USP_ACT_RULES('$action',$ntfId,'$pluginid','$caption','$captionO','$doc','$pubStatus','$createdBy','$archiveStatus','$blinksts',@OUT);";
     //echo $Sql;exit();
        $errAction        = Model::isSpclChar($action);
       // $errCaption       = Model::isSpclChar($caption);
           
        if ($errAction > 0 || $errCaption > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($Sql); 
            return $sqlResult;
            
        }
    }

// Function To Add Upadate Act and rule  By::Chinmayee  :: On:: 28-May-2016
    public function addUpdateActRules($ntfId) {
        $allow_doc_files    = array('pdf','xls');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $ntfId          = (isset($ntfId))?$ntfId:0;
        //$numPluginId    = $_POST['selType'];
        $numPluginId         = ($action == 'A') ? 'http://'.$_POST['selType'] : $_POST['selType'];
        //echo "selType".$_POST['selType'];
        if($_POST['selType']!="http://")
        {
            $errURL              =   Model::isValidURL($numPluginId);
        }
        $rbtLnkType     = htmlspecialchars($_POST['radStatus'], ENT_QUOTES);
        $txtHeadline    = htmlspecialchars($_POST['txtCaption'], ENT_QUOTES);
        //echo $txtHeadline;exit();
        $blankCaption   = Model::isBlank($txtHeadline);
        $errCaption     = Model::isSpclChar($_POST['txtCaption']);
        $fileDocument   = $_FILES['fileDocument']['name'];
        $prevDocument   = $_POST['hdnDocFile'];
        $extension      = pathinfo($fileDocument, PATHINFO_EXTENSION);
        $txtFileSize    = $_FILES['fileDocument']['size'];
        $txtTempName    = $_FILES['fileDocument']['tmp_name'];
        $formattedFileName = ($fileDocument != '') ? 'Rules_' . time() . '.' . $extension: '';
        if($_FILES['fileDocument']['name']!='')
            $errFile  = Model::isValidFile($_FILES['fileDocument']['name'],$allow_doc_files);
           else
             $errFile  = Model::isValidFile($prevfile,$allow_doc_files); 
        
        $txtHeadlineO   = htmlspecialchars($_POST['txtCaptionO'], ENT_QUOTES);
        $chkblink        = $_POST['chkbox'];
    // echo $errCaption.$errURL;
       if(isset($_POST['chkbox'])){
           $blanksts =1;
       } 
       else {
           $blanksts =0;
       }
       if ($fileDocument == '' && $ntfId != 0)
            $formattedFileName = $prevDocument;
       
        $outMsg = '';
        $flag   = ($ntfId != 0) ? 1 : 0;
        $action = ($ntfId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        if(($blankCaption >0)) //
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errCaption>0)||($errURL>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
        else if(($errURL>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Please enter a valid URL";
        }
       if($_FILES['fileDocument']['name']!=''){
                if($errFile==0 || ($errFile%2)==0)
                {
                        $errFlag                = 1;
                        $flag                   = 1;
                        $outMsg                 = "Invalid File types.Upload only pdf,xls.";
                }
       }
        $dupResult = $this->manageActRules('CD',$ntfId,0,$txtHeadline,'','',0,0,$userId,0);
       
        if($errFlag==0){
             if ($dupResult) {
                $numRows = $dupResult->fetch_array();
                if ($numRows > 0) {
                    $outMsg = 'Data already exists';
                    $errFlag = 1;
                    $flag   = 1;
                } else {
                    $result = $this->manageActRules($action,$ntfId,$numPluginId,$txtHeadline,$txtHeadlineO,$formattedFileName,$rbtLnkType,2,$userId,$blanksts);
                  
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Whats New added successfully ' : 'Whats New updated successfully';
                   
                    if ($_FILES['fileDocument']['name'] != '') {
                        if (file_exists("uploadDocuments/Notification/".$prevDocument) && $prevDocument != '')
                            unlink("uploadDocuments/Notification/"  . $prevDocument);
                            move_uploaded_file($txtTempName, "uploadDocuments/Notification/" . $formattedFileName);
                        
                    }
            
                }
            }
        }
              }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $numPluginId       = ($errFlag == 1) ? $numPluginId : '0';              
        $strFileName       = ($errFlag == 1) ? $fileDocument : '';
        $txtHeadline       = ($errFlag == 1) ? $txtHeadline : '';
        $DateTime          = ($errFlag == 1) ? $DateTime : ''; 
        $rbtLnkType         = ($errFlag == 1) ? $rbtLnkType : '1';
        $txtHeadlineO       = ($errFlag == 1) ? $txtHeadlineO : '';
       
        $arrResult = array('intCategory' => $numPluginId,'strFileName' => $strFileName,'txtHeadlineO' => $txtHeadlineO,'txtHeadline' => $txtHeadline,'msg' => $outMsg, 'flag' => $flag, 'DateTime' => $DateTime, 'rbtLnkType' => $rbtLnkType);
        return $arrResult;
    }

// Function To read Act and rule  By::Chinmayee  :: On:: 28-May-2016
    public function readActRules($id) {

        $result = $this->manageActRules('R',$id,0,'','','',0,0,0,0); 
        if ($result->num_rows > 0) {
            $row                  = $result-> fetch_array();
            $strCaption           =  htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_QUOTES);
            $strCaptionO          =  htmlspecialchars_decode($row['VCH_HEADLINE_O'],ENT_QUOTES);
            $strdoc               =  $row['VCH_DOCUMENT'];
            $intUrl               =  $row['VCH_PLUGIN_TYPE'];
            //$strFileName          = $row['VCH_LARGE_IMAGE'];
            $strdate              = date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_NOTIFICATION_DATE'],ENT_NOQUOTES)));
            $stractive            = $row['INT_PUBLISH_STATUS'];  
            $strblink             = $row['INT_BLINK_STATUS'];

        }

        $arrResult = array('strblink'=>$strblink,'strCaptionO'=>$strCaptionO,'strCaption'=>$strCaption,'strdoc'=>$strdoc,'intType'=>$intUrl,
            'strdate'=>$strdate,'stractive'=>$stractive );
        return $arrResult;
    }
	

// Function To Delete Act and rule  By::Chinmayee  :: On:: 28-May-2016
    public function deleteActRules($action, $ids) {
                $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
             
            $result = $this->manageActRules($action,$explIds[$ctr],0,'','','',0,0,$userId,0);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') {
               $outMsg .= 'Whats New deleted successfully';
        }
        else if ($action == 'AC')
            $outMsg = 'Whats New activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Whats New unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Whats New archieved successfully';
        else if($action == 'P')
            $outMsg = 'Whats New Published successfully';
   

        return $outMsg;
         }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}
/* * ****Class to manage Directory ********************
'By                     : Chinmayee'
'On                     : 31-May-2016       '
' Procedure Used        : USP_DIRECTORY       '
* ************************************************** */

class clsDirectory extends Model {

// Function To Manage Directory  By::Chinmayee  :: On:: 31-May-2016
    public function manageDirectory($action,$dirId,$pluginid,$name,$nameo,$desg,$desgO,$email,$fax,$pbx,$query1,$query2,$doc,$pubStatus,$archiveStatus,$createdBy,$intSlNo,$intCatid) {
        //echo $intCatid;
        $dirId            = htmlspecialchars(addslashes($dirId),ENT_QUOTES);
        $name             = htmlspecialchars(addslashes($name),ENT_QUOTES);
        $desg             = htmlspecialchars(addslashes($desg),ENT_QUOTES); 
        $email            = htmlspecialchars(addslashes($email),ENT_QUOTES); 
        $fax              = htmlspecialchars(addslashes($fax),ENT_QUOTES); 
        $pbx              = htmlspecialchars(addslashes($pbx),ENT_QUOTES); 
        $Sql                = "CALL USP_DIRECTORY('$action',$dirId,$pluginid,'$name','$nameo','$desg','$desgO','$email','$fax','$pbx','$query1','$query2','$doc','$pubStatus','$archiveStatus','$createdBy','$intSlNo','$intCatid',@OUT);";
         //echo $Sql;
        $errAction        = Model::isSpclChar($action);
        $errname          = Model::isSpclChar($name);
        $errdesg          = Model::isSpclChar($desg);
        $errEmail         = Model::isSpclChar($email);
        $errfax           = Model::isSpclChar($fax);
        $errpbk           = Model::isSpclChar($pbx);
           
        if ($errAction > 0 || $errname > 0|| $errdesg > 0 || $errEmail > 0 || $errfax > 0|| $errpbk > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($Sql); 
            return $sqlResult;
            
        }
    }
 // Function to get Max Val

// Function To Add Upadate Directory  By::Chinmayee  :: On:: 31-May-2016
    public function addUpdateDirectory($dirId) { 
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $dirId          = (isset($dirId))?$dirId:0;
        $numPluginId    = 1;
       // echo $numPluginId;
        $rbtLnkType     = $_POST['radStatus'];
        $selCat         = $_POST['selCat'];
        $blankCat       = Model::isBlank($selCat);
        $txtname        = htmlspecialchars($_POST['txtName'], ENT_QUOTES);
        $txtnameO        = htmlspecialchars($_POST['txtNameO'], ENT_QUOTES);
        $blankname      = Model::isBlank($txtname);
        $errname        = Model::isSpclChar($_POST['txtName']);
        $txtdesg        = htmlspecialchars($_POST['txtDesignation'], ENT_QUOTES);
         $txtdesgO        = htmlspecialchars($_POST['txtDesignationO'], ENT_QUOTES);
        $blankdesg      = Model::isBlank($txtdesg);
        $errdesg        = Model::isSpclChar($_POST['txtDesignation']);
        $txtEmail       = $_POST['txtEmail'];
        $errEmail       = Model::isSpclChar($_POST['txtEmail']);
        $txtFax         = $_POST['txtFax'];
        $errfax         = Model::isSpclChar($txtFax);
        $txtPbx         = $_POST['txtPbx'];
        $errpbx         = Model::isSpclChar($txtPbx);
        $fileDocument   = $_FILES['fileDocument']['name'];
        $prevDocument   = $_POST['hdnImageFile'];
        $extension      = pathinfo($fileDocument, PATHINFO_EXTENSION);
        $txtFileSize    = $_FILES['fileDocument']['size'];
        $txtTempName    = $_FILES['fileDocument']['tmp_name'];
        $formattedFileName = ($fileDocument != '') ? 'dir_' . time() . '.' . $extension: '';

        
       if ($fileDocument == '' && $dirId != 0)
            $formattedFileName = $prevDocument;
       
        $outMsg = '';
        $flag   = ($dirId != 0) ? 1 : 0;
        $action = ($dirId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
              if($action=='A')
        $intSlNo            = (Model::getMaxValdir('intSlNo','t_directory',$numPluginId,'BIT_DELETED_FLAG')=='')?1:Model::getMaxValdir('intSlNo','t_directory',$numPluginId,'BIT_DELETED_FLAG');
        
        else 
           $intSlNo        = $_POST['hdnSlNo'];
        
     
        if(($blankname >0) ||  ($blankdesg>0) || ($blankCat>0)) 
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errname>0) || ($errdesg>0) || ($errEmail>0) || ($errfax>0) || ($errpbx>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
        
    
     
        if($errFlag==0){
            
                    $result = $this->manageDirectory($action,$dirId,$numPluginId,$txtname,$txtnameO,$txtdesg,$txtdesgO,$txtEmail,$txtFax,$txtPbx,'','',$formattedFileName,$rbtLnkType,2,$userId,$intSlNo,$selCat);
                   if ($result){
                        $outMsg = ($action == 'A') ? 'Directory added successfully ' : 'Directory updated successfully';
                        $row  = $result-> fetch_array(); 
                    
		       $emplid	                = $row['@ID'];
                   
                    if ($_FILES['fileDocument']['name'] != '') {
                        if (file_exists("uploadDocuments/Directory/".$prevDocument) && $prevDocument != '')
                            unlink("uploadDocuments/Directory/"  . $prevDocument);
                            move_uploaded_file($txtTempName, "uploadDocuments/Directory/" . $formattedFileName);
                    }
                }
                $emplid = ($action == 'A') ?$emplid:$dirId;
        $totaltelRow = count($_REQUEST['txtTelno']);
        $totalmobRow = count($_REQUEST['txtMobno']);
        $query1='';        
        for ($i = 0; $i < $totaltelRow; $i++) {
            $txttelval = $_POST['txtTelno'][$i];
             if($txttelval!=''){
            $query1 .='("' . $txttelval . '",'.$emplid.' ),';
             }
        }
        $query1 = substr($query1, 0, -1);
       // print_r($query1);
        $query2='';        
        for ($i = 0; $i < $totalmobRow; $i++) {
            $txtmobval = $_POST['txtMobno'][$i];
            
             if($txtmobval!=''){
            $query2 .='("' . $txtmobval . '",'.$emplid.'),';
             
             }
        }
        $query2 = substr($query2, 0, -1);
       // print_r($query2);exit;
          if($action=='A')  
                           {
                           $Queryresult1		= $this->manageDirectory('AT',0,0,'','','','','','','',$query1,'','',0,0,0,0,0);     
                           $Queryresult2		= $this->manageDirectory('AM',0,0,'','','','','','','','',$query2,'',0,0,0,0,0);   
                           }
           if($action=='U')  
                           {
                           $Queryresult1		= $this->manageDirectory('UT',$dirId,0,'','','','','','','',$query1,'','',0,0,0,0,0);     
                           $Queryresult2		= $this->manageDirectory('UM',$dirId,0,'','','','','','','','',$query2,'',0,0,0,0,0);   
                          
                               
                               
                           }  
        }
                     }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $intCatId       = ($errFlag == 1) ? $selCat : '0'; 
        $txtname        = ($errFlag == 1) ? $txtname : '';
        $txtnameO        = ($errFlag == 1) ? $txtnameO : '';
        $txtdesg       = ($errFlag == 1) ? $txtdesg : '';
        $txtdesgO        = ($errFlag == 1) ? $txtdesgO : '';
        $txtEmail        = ($errFlag == 1) ? $txtEmail : '';
        $txtFax        = ($errFlag == 1) ? $txtFax : '';
        $txtPbx        = ($errFlag == 1) ? $txtPbx : '';
        $strFileName       = ($errFlag == 1) ? $fileDocument : '';
        $DateTime          = ($errFlag == 1) ? $DateTime : ''; 
        $rbtLnkType         = ($errFlag == 1) ? $rbtLnkType : '1'; 
       
        $arrResult = array('intCategory' => $intCatId ,'intType'=>$numPluginId,'strname'=>$txtname,'strnameO'=>$txtnameO,'strdegs'=>$textdesg,'strdegsO'=>$textdesgO,'stremail'=>$txtEmail,'strfax'=>$txtFax,'strpbx'=>$txtPbx,'strFileName' => $strFileName,'msg' => $outMsg, 'flag' => $flag, 'DateTime' => $DateTime, 'stractive' => $rbtLnkType);
        return $arrResult;
    }

// Function To read Director  By::Chinmayee  :: On:: 31-May-2016
    public function readDirectory($id) {

        $result = $this->manageDirectory('R',$id,0,'','','','','','','','','','',0,0,0,0,0);
        //print_r($result);
        if ($result->num_rows > 0) {
            $row                  = $result-> fetch_array();
            $strname              =  htmlspecialchars_decode($row['VCH_NAME'],ENT_QUOTES);
            $strnameO             =  htmlspecialchars_decode($row['VCH_NAME_O'],ENT_QUOTES);
            $strdegs              =  htmlspecialchars_decode($row['VCH_DESIGNATION'],ENT_QUOTES);
            $strdegsO             =  htmlspecialchars_decode($row['VCH_DESIGNATION_O'],ENT_QUOTES);
            $strdoc               =  $row['VCH_DOC'];
            $intType              = $row['INT_PLUGIN_ID'];
            $stractive            = $row['INT_PUB_STATUS']; 
            $stremail             =  htmlspecialchars_decode($row['VCH_EMAIL'],ENT_QUOTES);
            $strfax               =  htmlspecialchars_decode($row['INT_FAX'],ENT_QUOTES);
            $strpbx               =  htmlspecialchars_decode($row['INT_PBX'],ENT_QUOTES);
            $intslno              = $row['intSlNo'];
            $intCat              = $row['intDirCat'];

        }

        $arrResult = array('intCategory'=>$intCat,'intslno'=>$intslno,'strnameO'=>$strnameO,'strdegsO'=>$strdegsO,'strname'=>$strname,'strdoc'=>$strdoc,'intType'=>$intType,
            'strdoc'=>$strdoc,'stractive'=>$stractive,'strdegs'=>$strdegs,
            'stremail'=>$stremail,'strfax'=>$strfax,'strpbx'=>$strpbx );
        return $arrResult;
    }
	

// Function To Delete Director  By::Chinmayee  :: On:: 31-May-2016
    public function deleteDirectory($action, $ids) {
                $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            if($action=='US')
            {
            $slNumber	= $_POST['txtSLNo'.$explIds[$ctr]];
            $catids	= $_POST['hdncatid'.$explIds[$ctr]];
            }
            else
            {
            $slNumber   =0;
            $catids   =0;
            }
            $result = $this->manageDirectory($action,$explIds[$ctr],$catids,'','','','','','','','','','',0,0,0,$slNumber,0);                           
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Directory Detail(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist Directory(s) can not be  deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Directory(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Directory(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Directory(s) archieved successfully';
        else if($action == 'P')
            $outMsg = 'Directory(s) Published successfully';
       

        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

}

   


      /* * ****Class to manage Logo ********************
        'By                     :T Ketaki Dabadarshini	'
        'On                     : 28-Aug-2015        '
        ' Procedure Used        : USP_MANAGE_LOGO       '
        * ************************************************** */

        class clsLogo extends Model {
// Function To Manage logo By::chinmayee   :: On:: 28-AUG-2015
    public function manageLogo($action, $logoId, $Title, $TitleH, $Image,$ImageH, $description,$pubStatus, $previlige, $createdBy, $approval) {
        $logoId             = htmlspecialchars(addslashes($logoId),ENT_QUOTES);
        $Title              = htmlspecialchars(addslashes($Title),ENT_QUOTES);
        $TitleH             = htmlspecialchars(addslashes($TitleH),ENT_QUOTES);
        $description        = htmlspecialchars(addslashes($description),ENT_QUOTES);  
        $logoSql = "CALL USP_MANAGE_LOGO('$action', $logoId, '$Title', '$TitleH', '$Image', '$ImageH','$description',$pubStatus,$previlige,$createdBy,$approval,@OUT);";
     //echo $logoSql;  //exit();        
        $errAction          = Model::isSpclChar($action);
        $errTitle           = Model::isSpclChar($Title);
       $errfetImage         = Model::isSpclChar($Image); 
       $errfetImageH        = Model::isSpclChar($ImageH);
        if ($errAction > 0 || $errTitle > 0 || $errfetImage > 0 || $errfetImageH > 0)
            header("Location:" . APP_URL . "error");
        else {
            $result = Model::executeQry($logoSql);
            return $result;
        }
    }
    //===============
    public function  UpdateLogo($id){
        
       $result = $this->manageLogo('UP', $id, $txtTitle,'',$fileDocument,$fileDocumentH,'', 0,0,0,0,$userId);
     //$Sql = "CALL USP_MANAGE_LOGO('UP',$logoId, '$Title', '$TitleH', '$Image', '$ImageH','$description',$pubStatus,$previlige,$createdBy,$approval,@OUT);";   
    // echo $Sql;
     //$result = Model::executeQry($Sql);
       
           return $result;
    } 
// Function To Add Upadate Page By::Chinmayee :: On:: 14-Aug-2015
    public function  addUpdateLogo($LogoId) 
    {  
        //$allow_img_files=array('jpeg','jpg','gif','png');
        $allow_img_files=array('png');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
            $userId          = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $logoId                 = (isset($LogoId))?$LogoId:0;
        $txtTitle           = $_POST['txtTitle'];  
        $blankTitle         = Model::isBlank($txtTitle);
        $errTitle           = Model::isSpclChar($txtTitle);
        $lenTitle           = Model::chkLength('max', $txtTitle,50);
       // $txtTitle           = '';
        $errTitle           = Model::isSpclChar($txtTitle);
        $fileDocument           = $_FILES['fileDocument']['name'];
       
        $prevFile               = $_POST['hdnfileLogo'];
        $fileSize               = $_FILES['fileDocument']['size'];
        $fileTemp               = $_FILES['fileDocument']['tmp_name'];
        if($_FILES['fileDocument']['name']!='')
         $ext                    = pathinfo($fileDocument , PATHINFO_EXTENSION);
        else
         $ext                    = pathinfo($prevFile , PATHINFO_EXTENSION); 
        if($_FILES['fileDocument']['name']!='')
            $errFile        =  Model::isValidFile($_FILES['fileDocument']['name'],$allow_img_files);
        else
            $errFile        =  Model::isValidFile($prevFile,$allow_img_files);
        $fileDocument           = ($fileDocument != '') ? 'Logo' . date("Ymd_His") . '.' . $ext : '';
        
        $fileDocumentH           = $_FILES['fileDocumentH']['name'];
        $prevFileH               = $_POST['hdnfileLogoH'];
        $fileSizeH               = $_FILES['fileDocumentH']['size'];
        $fileTempH               = $_FILES['fileDocumentH']['tmp_name'];
         if($_FILES['fileDocumentH']['name']!='')
        $extH                    = pathinfo($fileDocumentH , PATHINFO_EXTENSION);
         else
        $extH                    = pathinfo($prevFileH  , PATHINFO_EXTENSION); 
        if($_FILES['fileDocumentH']['name']!='')
            $errFileH        =  Model::isValidFile($_FILES['fileDocumentH']['name'],$allow_img_files);
        else
            $errFileH        =  Model::isValidFile($prevFileH,$allow_img_files);
        $fileDocumentH           = ($fileDocumentH != '') ? 'LogoH' . date("Ymd_His") . '.' . $extH : '';

        $fileDocumentWhite           = $_FILES['fileDocumentWhite']['name'];
        $prevFileWhite               = $_POST['hdnfileLogoWhite'];
        $fileSizeWhite               = $_FILES['fileDocumentWhite']['size'];
        $fileTempWhite               = $_FILES['fileDocumentWhite']['tmp_name'];
        $extWhite                    = pathinfo($fileDocumentWhite , PATHINFO_EXTENSION);
        $fileDocumentWhite           = ($fileDocumentWhite != '') ? 'LogoWhite' . date("Ymd_His") . '.' . $extWhite : '';
        
        $outMsg = '';
        $flag = ($logoId != 0) ? 1 : 0;
        $action = ($logoId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
       
        if($blankTitle >0)
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";  
        }
        else if($lenTitle>0)
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Length should not exceed maxlength";
        }
        else if($errTitle>0)
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
       /* else if(($fileDocument == '') || ($fileDocumentH == '' ))
        {
            $outMsg	= 'Image can not be empty.'; echo $txtTitle.$errFlag;
            $errFlag	= 1;
            $flag       = 1;
        }*/
        else if($errFile==0 || ($errFile%2)==0)
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Invalid File types.Upload only jpeg,jpg,gif,png.";
        }
        else if($errFileH==0 || ($errFileH%2) ==0)
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Invalid File types.Upload only jpeg,jpg,gif,png.";
        }
//        else if(!in_array($ext,$allow_img_files)){
//           $errFlag               = 1;
//           $flag                  = 1; 
//           $outMsg = 'Invalid file types. Upload only jpeg,jpg,gif,png.'; 
//        }
//        else if(!in_array($extH,$allow_img_files)){
//           $errFlag               = 1;
//           $flag                  = 1; 
//           $outMsg = 'Invalid file types. Upload only jpeg,jpg,gif,png.'; 
//        }
        else if (($fileSize > size2MB) ||($fileSizeH > size2MB)||($fileSizeWhite > size2MB) )
        {
            $errFlag               = 1;
            $flag                  = 1;
            $outMsg = 'File size can not more than 2 MB';
        }
       

         if(($fileDocument == '') && ($logoId != 0))
            $fileDocument = $prevFile;
         
         if(($fileDocumentH == '') && ($logoId != 0))
            $fileDocumentH = $prevFileH;
         
         if(($fileDocumentWhite == '') && ($logoId != 0))
            $fileDocumentWhite = $prevFileWhite;
        // echo "action".$action."logoId".$logoId."tit".$txtTitle."filedocwh".$fileDocumentWhite."fdd".$fileDocument."fdh".$fileDocumentH."uid".$userId;exit();
        
        if($errFlag==0){
          
                    $result = $this->manageLogo($action, $logoId, $txtTitle,$fileDocumentWhite,$fileDocument,$fileDocumentH,'', 0,0,0,0,$userId);
                  
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Logo added successfully ' : 'Logo updated successfully';
                   
                    if ($fileDocument != '') {
                        
                        if (file_exists("uploadDocuments/Logo/" . $prevFile) && $prevFile != '') {
                           //unlink("uploadDocuments/Logo/" . $prevFile); 
                        }
                        move_uploaded_file($fileTemp, "uploadDocuments/Logo/" . $fileDocument);
                    }
                  if ($fileDocumentH != '') {
                        if (file_exists("uploadDocuments/Logo/" . $prevFileH) && $prevFileH != '') {
                          //unlink("uploadDocuments/Logo/" . $prevFileH);   
                        }
                        move_uploaded_file($fileTempH, "uploadDocuments/Logo/" . $fileDocumentH);
                    } 
                    
                    if ($fileDocumentWhite != '') {
                        if (file_exists("uploadDocuments/Logo/" . $prevFileWhite) && $prevFileWhite != '') {
                          unlink("uploadDocuments/Logo/" . $prevFileWhite);   
                        }
                        move_uploaded_file($fileTempWhite, "uploadDocuments/Logo/" . $fileDocumentWhite);
                    } 
              
                }
               
                   }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
              
        $strTitle   = ($errFlag == 1) ? $txtTitle : '';
        $strFileName   = ($errFlag == 1) ? $fileDocument : '';
        $strFileNameH   = ($errFlag == 1) ? $fileDocumentH : '';
        $arrResult = array('strTitle' => $strTitle,'strFileName' => $strFileName,'strFileNameH' => $strFileNameH,'strFileNameWhite' => $strFileNameWhite,'msg' => $outMsg, 'flag' => $flag );
        return $arrResult;
       
    }
  
    // Function To Delete Logo  By::Chinmayee  :: On:: 14-Aug-2015
    public function deleteLogo($action, $ids) {
          $newSessionId           = session_id();
          $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
         $userId = ($_SESSION['adminConsole_userID']!='')?$_SESSION['adminConsole_userID']:0;
        $explIds = explode(',', $ids);
        $delRec = 0;
        $fail	= '';
        foreach ($explIds as $indIds) {
            $result1 = $this->manageLogo('R', $explIds[$ctr],'', '', '','','',1, 0, 0, 0,$userId);
            $row2 = $result1->fetch_array();
            $strImageFile = $row2['VCH_IMAGE'];
            $strImageFileH = $row2['VCH_IMAGE_H'];
            
            $result = $this->manageLogo($action, $explIds[$ctr],'', '', '','','',1, 0, 0, 0,$userId);
            $row = $result->fetch_array();
             if ($row[0] == 0)
                 $delRec++;
             $ctr++;
           
             if ($action == 'D' && $strImageFile != '' &&  $strImageFileH != '') {
                if (file_exists("uploadDocuments/Logo/" . $strImageFile)) {
                    unlink("uploadDocuments/Logo/" . $strImageFile);
                }
                if (file_exists("uploadDocuments/Logo/" . $strImageFileH)) {
                    unlink("uploadDocuments/Logo/" . $strImageFileH);
                }
                
            }
        }
 if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Logo Detail(s) deleted successfully';
//            else
//                $outMsg .= 'Logo can not be  deleted';
        }
        
          else if ($action == 'P')
            $outMsg = 'Logo published successfully';
        return $outMsg;
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }
       


}     

 /* * ****Class to manage Global link ********************
  '	By	 	 : T Ketaki Debadarshini	'
  '	On	 	 : 28-Aug-2015        '
  ' Procedure Used       : USP_MENUS            '
 * ************************************************** */
class clsGlobalLink extends Model {

// Function To Manage Globallink By::T Ketaki Debadarshini   :: On::13-Aug-2015    
    public function manageGL($action, $pId, $pageId, $parentId, $menuType, $menuOrder, $linkType, $pageNavigation) {

        $glSql = "CALL USP_MENUS('$action','$pId','$pageId','$parentId','$menuType','$menuOrder','$linkType','$pageNavigation');";
        //echo $glSql; exit;
        $glResult = Model::executeQry($glSql);
        return $glResult;
    }
    
    
     // Function To delete Menu By::Chinmayee  :: On:: 23-May-2016
    public function DeleteMenu($action, $menuId ,$pageid, $menuType) {
           $newSessionId           = session_id();
          $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
                  $result = $this->manageGL($action, $menuId, 0, $pageid, $menuType, 0, '', '');
            if ($result)
                {
               $numRows = $result->fetch_array();
               $flagval = $numRows['@DELETFLAG'];
               if($flagval>0){
               $outMsg =  'MainMenu Deleted successfully';
                }
                else{
                   $outMsg =  'MainMenu can not Deleted as some other menu exsit under it.';  
                }
                }
            else
            {
                $outMsg = "error Occured";
            }
       
       
                return $outMsg;
                
                }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }

    public function viewMenulSubChild($menutype=1, $pageId = 0){
        $menuRes = $this->manageGL('VP', 0, 0, $pageId, $menutype, 0,'', '');
        $subChild=false;
        if ($menuRes->num_rows > 0) {
            $level=0; 
            while ($glrow = $menuRes->fetch_array()) {
                $glpageid   = $glrow['intPageId'];
                $chkSubMenu=$this->manageGL('VP', 0, 0, $glpageid, $menutype, 0,'', '');
                $totalPlmenu = $chkSubMenu->num_rows;
                if($totalPlmenu>0){
                    $subChild=true;
                }
                
            }
        }
        return $subChild;
            
    }

    public function viewMenulIstRec( $menutype=1, $parent = 0,$level=0,$child= false, $subchild= false){
        $menuRes = $this->manageGL('VP', 0, 0, $parent, $menutype, 0,'', '');
        if ($menuRes->num_rows > 0) {
            
            if($level == 1){
                if($child == true ){
                    echo '<ul class="dropdown-menu menumanag ">';
                }else{
                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                }
            }
            if($level == 2){
               echo '<ul class="dropdown-menu menu-scroll">';
            }
            
            while ($glrow = $menuRes->fetch_array()) {
                
                $glpageid   = $glrow['intPageId'];
                $glpageName = htmlspecialchars_decode($glrow['vchTitle'],ENT_NOQUOTES);
                $iconClass  = $glrow['vchMetaImage'];
                $menuGlUrl          = htmlspecialchars_decode($glrow['vchUrl'],ENT_NOQUOTES);
                $pluginGlName       = htmlspecialchars_decode($glrow['pageName'],ENT_NOQUOTES);
                $intLinkGLType      = $glrow['intLinkType'];
                $intTemplateGLType  = $glrow['intTemplateType'];
                $intGlWindownStatus = $glrow['intWindowStatus'];
                $gliconClass        = $glrow['vchMetaImage'];
                $exglodegl      = explode(' ',$gliconClass); 
                $glicon=$exglodegl[0];
                $strglDocFile   = $glrow['vchLinkImage'];
                $glPageAlias    = $glrow['vchPageAlias']; 
                
                if($intLinkGLType == 1)
                {
                    if($intTemplateGLType == 1 || $intTemplateGLType == 3)
                    {
                        $ghref = SITE_URL.'content/'.$glPageAlias;
                    }
                    else if($intTemplateGLType == 2)
                    {
                        $ghref = SITE_URL.$pluginGlName.'/'.$glPageAlias;
                    }
                    else if($intTemplateGLType == 4)
                    {
                        $ghref = APP_URL.'uploadDocuments/LinkDoc/'.$strglDocFile;
                    }
                }else if($intLinkGLType == 2)
                {
                    $ghref = $menuGlUrl;
                }	 
                if($intGlWindownStatus == 1)
                {
                    $glTargetBlank = '';
                }
                else
                {
                    $glTargetBlank = 'target="_blank"';
                }

                $chkSubMenu=$this->manageGL('VP', 0, 0, $glpageid, $menutype, 0,'', '');
                $totalPlmenu = $chkSubMenu->num_rows;
                $ghref=($totalPlmenu>0)?'javascript:void(0)':$ghref;
                
                $anchorClass=(($totalPlmenu>0)?'nav-link dropdown-toggle' :'nav-link blinking');

                //echo "<pre>parent=".$parent."::totalPlmenu=".$totalPlmenu."::level=".$level; print_r($glrow); echo "</pre>";
                if($level == 0){
                    $childResData=$this->viewMenulSubChild($menutype,$glpageid);
                    $liClass=($childResData==false)?(($totalPlmenu>0)?'nav-item dropdown' :'nav-item'):'dropdown-submenu';
                    echo  '<li class= "'.$liClass.'">' 
                    . '<a  class="'.$anchorClass.'" href="'.$ghref.'" title="'.$glpageName.'" '. $glTargetBlank.'> '.$glpageName .'</a>';
                    if( $totalPlmenu > 0){
                        $childRes=$this->viewMenulSubChild($menutype,$glpageid);
                        $this->viewMenulIstRec($menutype,$glpageid,1, $childRes, false);
                    }
                    echo '</li>';
                } 
                if($level ==1){ 
                    if($child == true){
                        echo '<li class="dropdown-submenu">' .
                            '<a class="dropdown-item" href="'.$ghref.'">'.$glpageName.'</a>';
                        $this->viewMenulIstRec($menutype,$glpageid,2, true, false);
                        echo '</li>';
                    }else{
                        echo '<a class="dropdown-item" href="'.$ghref.'">'.$glpageName.'</a>';
                    }   
                    
                }
                if($level == 2){ 
                    echo '<li>' .
                            '<a class="dropdown-item" href="'.$ghref.'">'.$glpageName.'</a></li>';  
                        
                }
                    
                    
                
            
               /*  if($totalPlmenu>0) { 
                    $level=$level+1;
                    $loop=1;
                    $this->viewMenulIstRec1($menutype,$glpageid,$level, $child, $subchild);
                }else{
                    $loop=0;
                } */
                
                
                
            }
           
            if($level == 1){
                if($child == true ){
                    echo '</ul>';
                }else{
                    echo '</div>';
                }
            }
            if($level == 2){
               echo '</ul>';
            }
            
        }
            
    }
    
    // Function To view portlet menu By::Chinmayee   :: On:: 23-May-2016
    function viewMenuList($menutype, $parent = 0, $user_tree_array = '') {
        //echo $parent;
        if (!is_array($user_tree_array))
            $user_tree_array = array();
            $menuRes = $this->manageGL('VM', 0, 0, $parent, $menutype, 0,'', '');
            //echo $menuRes->num_rows.',';
        if ($menuRes->num_rows > 0) {
            $user_tree_array[] = '<ol class="dd-list" id="portletMenu" >';
            while ($menuRow    = $menuRes->fetch_array()) {
                  $pageTitle   = htmlspecialchars_decode($menuRow['vchTitle'], ENT_QUOTES);
                  $pageId      = $menuRow['intPageId'];
                  $intmenuId   = $menuRow['intId'];
                  $onChangeFunction    = '';    
                 
                    $divClasss           = 'dd-handle poartletMenuItem col-md-10';
		    $hdnFld              = '<input type="hidden" name="poartletMenuArr[]" id="hdnpoartletMenuId' . $pageId . '" class="poartletMenuClass" value="' . $pageId . '">';
                    $closeBtn            = '<span style="float:right;cursor:pointer;padding:10px" data-rel="tooltip" data-original-title="Delete" title=""><a href="#" onclick="removepoartletMenu('.$pageId.');"><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" ></a></span>';
                    $user_tree_array[]   = '<li class="dd-item dd-item_main" data-id="'. $pageId . '" id="item_main'. $pageId . '">';
                    $user_tree_array[]   = '<div class="row"><div class="'.$divClasss.'" id="poartletMenuItem' . $pageId . '">'. $pageTitle . $hdnFld .'</div> ';
                    $user_tree_array[]   = '<div class="col-md-1 pull-right" id="poartletMainMenuItemrmv' . $pageId . '">'. $closeBtn . '</div></div> ';
                    $user_tree_array     = $this->viewMenuList($menutype, $pageId, $user_tree_array);
                    $user_tree_array[]   = '</li>';
            }
                    $user_tree_array[] = '</ol>';
        }
        return $user_tree_array;
    }

    // Function To view Footer portlet menu By::Lizalin Rout   :: On:: 08-June-2021
    function viewFooterMenuList($menutype, $parent = 0, $user_tree_array = '') {
        //echo $parent;
        if (!is_array($user_tree_array))
            $user_tree_array = array();
            $menuRes = $this->manageGL('VM', 0, 0, $parent, $menutype, 0,'', '');
            //echo $menuRes->num_rows.',';
        if ($menuRes->num_rows > 0) {
            $user_tree_array[] = '<ol class="dd-list" id="portletFooterMenu" >';
            while ($menuRow    = $menuRes->fetch_array()) {
                  $pageTitle   = htmlspecialchars_decode($menuRow['vchTitle'], ENT_QUOTES);
                  $pageId      = $menuRow['intPageId'];
                  $intmenuId   = $menuRow['intId'];
                  $onChangeFunction    = '';    
                 
                    $divClasss           = 'dd-handle col-md-10 poartletFooterMenuItem';
            $hdnFld              = '<input type="hidden" name="poartletFooterMenuArr[]" id="hdnpoartletFooterMenuId' . $pageId . '" class="poartletFooterMenuClass" value="' . $pageId . '">';
                    $closeBtn            = '<span style="float:right;cursor:pointer;padding:10px" data-rel="tooltip" data-original-title="Delete" title=""><a href="#" onclick="removepoartletFooterMenu('.$pageId.');"><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" ></a></span>';
                    $user_tree_array[]   = '<li class="dd-item dd-item_footer" data-id="'. $pageId . '" id="item_footer' . $pageId . '">';
                    $user_tree_array[]   = '<div class="row"><div class="'.$divClasss.'" id="poartletFooterMenuItem' . $pageId . '">'. $pageTitle . $hdnFld . '</div> ';
                    $user_tree_array[]   = '<div class="col-md-1 pull-right" id="poartletFooterMenuItemrmv' . $pageId . '">'. $closeBtn . '</div></div> ';
                    $user_tree_array     = $this->viewFooterMenuList($menutype, $pageId, $user_tree_array);
                    $user_tree_array[]   = '</li>';
            }
                    $user_tree_array[] = '</ol>';
        }
        return $user_tree_array;
    }

    //======Function to view looking for menus by indrani on::12-01-2021
    function viewLkMenuList($menutype, $parent = 0, $user_tree_arrayLk = '') {
        //echo $parent;
        if (!is_array($user_tree_arrayLk))
            $user_tree_arrayLk = array();
            $menuRes = $this->manageGL('VM', 0, 0, $parent, $menutype, 0,'', '');
            //echo $menuRes->num_rows.',';
        if ($menuRes->num_rows > 0) {
            $user_tree_arrayLk[] = '<ol class="dd-list" id="portletMenu_lk" >';
            while ($menuRow    = $menuRes->fetch_array()) {
                  $pageTitle   = htmlspecialchars_decode($menuRow['vchTitle'], ENT_QUOTES);
                  $pageId      = $menuRow['intPageId'];
                  $intmenuId   = $menuRow['intId'];
                  $onChangeFunction    = '';    
                 
                    $divClasss           = 'dd-handle poartletMenuItem_lk';
            $hdnFld              = '<input type="hidden" name="poartletMenuArr_lk[]" id="hdnpoartletMenuId_lk' . $pageId . '" class="poartletMenuClass_lk" value="' . $pageId . '">';
                    $closeBtn            = '<span style="float:right;cursor:pointer;" data-rel="tooltip" data-original-title="Delete" title=""><a href="#" onclick="removeFrompoartletMenu('.$intmenuId.','.$pageId.');"><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" ></a></span>';
                    $user_tree_arrayLk[]   = '<li class="dd-item dd-item_lk" data-id="'. $pageId . '">';
                    $user_tree_arrayLk[]   = '<div class="'.$divClasss.'" id="poartletMenuItem_lk' . $pageId . '">'. $pageTitle . $hdnFld . $closeBtn . '</div> ';
                    $user_tree_arrayLk     = $this->viewLkMenuList($menutype, $pageId, $user_tree_arrayLk);
                    $user_tree_arrayLk[]   = '</li>';
            }
                    $user_tree_arrayLk[] = '</ol>';
        }
        return $user_tree_arrayLk;
    }
    
	
	//========= Function to view global link By::T Ketaki Debadarshini   :: On::28-Aug-2015 ==========
	public function viewGL($action, $pId, $menuType)
	{
		$result	= $this->manageGL($action, $pId, 0, 0, $menuType, 0, 'globalLink', '');
		$glArr	= array();
		$ctr	= 0;
		if($result->num_rows > 0)
		{
			while($row	= $result->fetch_array())
			{				
				$glArr[$ctr]['pageId']	= $row['intPageId'];
				$glArr[$ctr]['menuName']	= $row['vchTitle'];
				$ctr++;
			}
		}
		return $glArr;
	}

// Function To Manage Menu item By::T Ketaki Debadarshini   :: On::28-Aug-2015
    public function saveMenuItems($parentId, $menuType, $linkType, $pageNavigation) {
         $newSessionId          = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {

        
        if ($menuType == 3)
            $rows = $_POST['bottomMenuArr'];
        /* For top menu */
        else if ($menuType == 2)
            $rows = $_POST['topMenuArr'];
        /* For Looking for menu */
        else if ($menuType == 6)
            $rows = $_POST['LkMenuArr'];
       

        $delResult = $this->manageGL('DL', 0, 0, $parentId, $menuType, '0', $linkType, '');
        if ($delResult) {
            $counter = 0;
            foreach ($rows as $row) {
                $counter++;
                $pageNavigation .= '_' . $row;
                if ($linkType == 'globalLink')
                    $pageNavigationVal = $row;
                else
                    $pageNavigationVal = $pageNavigation;
					
				
                $result = $this->manageGL('A', 0, $row, $parentId, $menuType, $counter, $linkType, $pageNavigationVal);

                $lastIndex = strrpos($pageNavigation, '_');
                $pageNavigation = substr($pageNavigation, 0, $lastIndex);
            }
            return $outMsg = 'Selected Menu(s) Published successfully.';
        }
        else {
            return $outMsg = 'Error in operation please try again.';
        }
        
                 
        }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
                
    }
     // Function To add portlet menu By::Chinmayee   :: On:: 20-May-2016 
     public function tagMenuList() {
         $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $hdnMain   = $_REQUEST['hdnMain'];   //echo $hdnMain; 
        $mainVal = explode(',', $hdnMain);
        $mainctr = 0;
         $query = '';
        foreach ($mainVal as $indmain) {
            $indmainVal = $mainVal[$mainctr];
            $mainctr++;
            $childVal = explode('_', $indmainVal);
            $menutype = $childVal[0];
            $pageId   = $childVal[1];
            $parentId = $childVal[2];
            $rank     = $childVal[3];
            if($parentId==0){
            $pageNavigation   =   $pageId; 
            }  else {
              $pageNavigation = $parentId.'_'.$pageId;  
            }
            $txtquery .='("' . $pageId . '","' . $parentId . '","' .$menutype. '","' . $rank . '","'.$pageNavigation.'"),';
           
        }
        $txtquery = substr($txtquery, 0, -1);
      // echo $txtquery;
         $result   = $this->manageGL('PM', 0, 0, 0, 1, 0, $txtquery,'');
            if ($result)
                $outMsg = 'Menus(s) Tagged successfully';
            else
                $outMsg = "error Occured";
          
        return $outMsg;
         }    else {
            return  $outMsg = 'Transaction fail due to session mismatch.';
               
         }
    } 


     // Function To add Footer menu By::Lizalin   :: On:: 08-June-2021 
     public function tagFooterMenuList() {
         $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $hdnMain   = $_REQUEST['hdnMainFooter'];   
        // echo $hdnMain;exit; 
        $mainVal = explode(',', $hdnMain);
        $mainctr = 0;
         $query = '';
        foreach ($mainVal as $indmain) {
            $indmainVal = $mainVal[$mainctr];
            $mainctr++;
            $childVal = explode('_', $indmainVal);
            $menutype = $childVal[0];
            $pageId   = $childVal[1];
            $parentId = $childVal[2];
            $rank     = $childVal[3];
            if($parentId==0){
            $pageNavigation   =   $pageId; 
            }  else {
              $pageNavigation = $parentId.'_'.$pageId;  
            }
            $txtquery .='("' . $pageId . '","' . $parentId . '","' .$menutype. '","' . $rank . '","'.$pageNavigation.'"),';
           
        }
        $txtquery = substr($txtquery, 0, -1);
      // echo $txtquery;
         $result   = $this->manageGL('PM', 0, 0, 0, 4, 0, $txtquery,'');
            if ($result)
                $outMsg = 'Footer Menus(s) Tagged successfully';
            else
                $outMsg = "error Occured";
          
        return $outMsg;
         }    else {
            return  $outMsg = 'Transaction fail due to session mismatch.';
               
         }
    } 
    
    
    // Function To add looking for menu By::Indrani :: On:: 12-jan-2021 
     public function tagMenuList_lk() 
     {
         $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $hdnMain   = $_REQUEST['hdnMain_lk'];   //echo $hdnMain; 
        $mainVal = explode(',', $hdnMain);
        $mainctr = 0;
         $query = '';
        foreach ($mainVal as $indmain) {
            $indmainVal = $mainVal[$mainctr];
            $mainctr++;
            $childVal = explode('_', $indmainVal);
            $menutype = $childVal[0];
            $pageId   = $childVal[1];
            $parentId = $childVal[2];
            $rank     = $childVal[3];
            if($parentId==0){
            $pageNavigation   =   $pageId; 
            }  else {
              $pageNavigation = $parentId.'_'.$pageId;  
            }
            $txtquery .='("' . $pageId . '","' . $parentId . '","' .$menutype. '","' . $rank . '","'.$pageNavigation.'"),';
           
        }
        $txtquery = substr($txtquery, 0, -1);
      // echo $txtquery;
         $result   = $this->manageGL('PM', 0, 0, 0, 7, 0, $txtquery,'');
            if ($result)
                $outMsg = 'Looking For Menus(s) Tagged successfully';
            else
                $outMsg = "error Occured";
          
        return $outMsg;
         }    else {
            return  $outMsg = 'Transaction fail due to session mismatch.';
               
         }
    } 
    
    
    
    
    
    
    
    
     // Function To fill Primary Link By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    function fillPrimaryLink($glId,$selVal)
    {
        $conResult      = $this->manageGL('F',0,0,$glId,0,0,'primaryLink','');
        $selOptions	= model::FillDropdown($conResult,$selVal);
	return $selOptions;
    }
    
    //========= Function to view global link By::T Ketaki Debadarshini   :: On:: 28-Aug-2015==========
	public function viewPL($glid)
	{
		$result	= $this->manageGL('F',0,0, $glid,0,0,'primaryLink','');
		$glArr	= array();
		$ctr	= 0;
		if($result->num_rows > 0)
		{
			while($row	= $result->fetch_array())
			{				
				$glArr[$ctr]['pageId']          = $row['intPageId'];
				$glArr[$ctr]['menuName']	= $row['vchTitle'];
				$ctr++;
			}
		}
		return $glArr;
	}
        
     //========= Function to view primary link By::T Ketaki Debadarshini   :: On:: 28-Aug-2015==========
	public function viewPLDetails($action,$parentid)
	{
		$result	= $this->manageGL($action,0,0,$parentid,0,0,'primaryLink','');
		$glArr	= array();
		$ctr	= 0;
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_array())
			{				
				$glArr[$ctr]['pageId']          = $row['intPageId'];
				$glArr[$ctr]['menuName']	= $row['vchTitle'];
				$ctr++;
			}
		}
		return $glArr;
	}


}   
 
class clsOfficerProfile extends Model {

// Function To Manage officer profile By::Ashis Kumar Patra  :: On:: 12-Oct-2016
    public function manageOffProfile($action, $profileId,$slNo, $ministerNameE, $ministerNameH,$designationE,$designationH,$QulificationE,$QulificationH,$mobileno,$image,$publishStatus,$archiveStatus, $createdBy,$linkType,$url,$archStartDate,$arcEndDate) {
        
      
        $offSql = "CALL USP_OFFICER_PROFILE('$action', '$profileId','$slNo','$ministerNameE', '$ministerNameH','$designationE','$designationH','$QulificationE','$QulificationH','$mobileno','$image','$publishStatus','$archiveStatus',$createdBy,$linkType,'$url','$archStartDate','$arcEndDate',@OUT);";
       //echo $offSql; exit;        
        $errAction          = Model::isSpclChar($action);
        $errNameE           = Model::isSpclChar($ministerNameE);
        $errNameH           = Model::isSpclChar($ministerNameH);
        $errDesgE           = Model::isSpclChar($designationE);
        $errDesgH           = Model::isSpclChar($designationH);
        $errQuliE           = Model::isSpclChar($QulificationE);
        $errQuliH           = Model::isSpclChar($QulificationH); 
        $errMob             = Model::isSpclChar($mobileno);
       /* if ($errAction > 0 || $errNameE > 0 || $errNameH > 0 || $errDesgE > 0||$errDesgH ||$errQuliE ||$errQuliH  )
            header("Location:" . URL . "error");
        else {*/
            $offResult = Model::executeQry($offSql);
            return $offResult;
       // }
    }
 // Function To Add Upadate Officer profile By::Ashis Kumar Patra  :: On:: 12-Oct-2016
    public function addUpdateProfile($offId) {
        $allow_img_files=array('jpeg','jpg','gif');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        if ($newSessionId == $hdnPrevSessionId) {
            $userId             = $_SESSION['adminConsole_userID'];
            $txtOfficerNameE    = $_POST['txtOfficerNameE'];
            $txtOfficerNameH    = $_POST['txtOfficerNameO'];
            $blankOffcerNameE   = Model::isBlank($txtOfficerNameE);
            $errOffcerNameE     = Model::isSpclChar($txtOfficerNameE);
            $lenOfficerNameE    = Model::chkLength('max', $txtOfficerNameE, 100);        
            $filePhoto          = $_FILES['filePhoto']['name'];
            //echo '<br><br><br><br> - '.$filePhoto;
            $prevFile           = $_POST['hdnImageFile'];
            $fileSize           = $_FILES['filePhoto']['size'];
            $fileTemp           = $_FILES['filePhoto']['tmp_name'];
            $ext                = pathinfo($filePhoto, PATHINFO_EXTENSION);
            $filePhoto          = ($filePhoto != '') ? 'OffProfile' . date("Ymd_His") . '.' . $ext : '';
            $errFile =1;
            if($filePhoto!=''){
                $errFile  = Model::isValidFile($filePhoto,$allow_img_files);
            }
            if($prevFile !=''){
                $errFile  = Model::isValidFile($prevFile,$allow_img_files); 
            } 
        $txtDesgE           = $_POST['txtDesgE'];
        $txtDesgH           = $_POST['txtDesgO'];
        $blankDesgE         = Model::isBlank($txtDesgE);
        $errDesgE           = Model::isSpclChar($txtDesgE);
        $lenDesgE           = Model::chkLength('max', $txtDesgE, 80);        
        $txtQualificationE  = $_POST['txtQualificationE'];  
        $txtQualificationH  = $_POST['txtQualificationO'];  
        $errQualificationE  = Model::isSpclChar($txtQualificationE);
        $lenQualificationE  = Model::chkLength('max', $txtQualificationE, 50);
        $txtMobile          = $_POST['txtMobno'];  
        $errMobile          = Model::isSpclChar($txtMobile);
        //$lenMobile  = Model::chkLength('max',$txtMobile, 10);   
        $rdLinkType         = $_POST['rbtLnkType'];
       
        $outMsg             = '';
        $flag               = ($offId != 0) ? 1 : 0;
        $action             = ($offId == 0) ? 'A' : 'U';
        if($action=='A')
        $intSlNo            = (Model::getMaxVal('intSlNo','t_officer_profile','bitDeletedFlag')=='')?1:Model::getMaxVal('intSlNo','t_officer_profile','bitDeletedFlag');
        else 
           $intSlNo        = $_POST['hdnSlNo'];
            $errFlag            = 0 ;
        
         if($lenOfficerNameE>0 || $lenQualificationE>0||$lenDesgE>0)
        {
                $errFlag		= 1;
                $flag                  = 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if($errOffcerNameE>0 ||$errQualificationE>0||$errUrl>0||$errMobile>0)
        {
                $errFlag		= 1;
                $flag                  = 1;
                $outMsg			= "Special Characters are not allowed";
        }
       else if(($errFile%2)==0)
        {
                $errFlag                = 1;
                $flag                   = 1;
                $outMsg                 = "Invalid File types.Upload only jpeg,jpg,gif.";
        }
        else if ($fileSize > size2MB) {
            $errFlag = 1;
            $flag    = 1;
            $outMsg = 'File size can not more than 2 MB';
        }
        if( $errFlag==0)
        {
            $dupResult = $this->manageOffProfile('CD', $offId,0,$txtOfficerNameE,'','','','','','','',0,0,0,0,'','0000-00-00','0000-00-00');

            if ($filePhoto == '' && $offId != 0){
                $filePhoto = $prevFile;
            }
            
            //echo '<br><br><br><br>'.$filePhoto.' '.$prevFile;
            if ($dupResult) {
                $numRows = $dupResult->fetch_array();
                if ($numRows > 0) {
                    $outMsg = 'Officer profile wih this name already exists';
                    $errFlag = 1;
                } else{
                        $result = $this->manageOffProfile($action, $offId,$intSlNo, $txtOfficerNameE, $txtOfficerNameH,$txtDesgE,$txtDesgH,$txtQualificationE,$txtQualificationH,$txtMobile,$filePhoto,0,0, $userId,0,$txtURL,'0000-00-00','0000-00-00');
                       // if ($result){
                            $outMsg = ($action == 'A') ? 'Officer Profile added successfully ' : 'Officer Profile updated successfully';
                        if ($filePhoto != '') {
                            if (file_exists("uploadDocuments/offProfile/" . $prevFile) && $prevFile != '') {
        //unlink("../uploadDocuments/featuredImage/".$prevFile);
                            }
                            move_uploaded_file($fileTemp, "uploadDocuments/offProfile/" . $filePhoto);
                        //}
                        }
                    }                   
            }
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strOfficerNameE          = ($flag == 1) ? $txtOfficerNameE : '';       
        $strDesgE                 = ($flag == 1) ? $txtDesgE : '';        
        $strQuliE                 = ($flag == 1) ? $txtQualificationE : '';        
        $intLinkType              = ($flag == 1) ? $rdLinkType : '1';
        $strUrl                   = ($flag == 1) ? $txtURL : '';
        $txtMobile                = ($flag == 1) ? $txtMobile : '';
        $arrResult = array('msg' => $outMsg, 'flag' => $flag, 'strOfficerNameE' => $strOfficerNameE, 'strDesgE' => $strDesgE, 'strQuliE' => $strQuliE,'intLinkType'=>$intLinkType,'strUrl'=>$strUrl,'strMobno'=>$txtMobile );
        return $arrResult;
    }
  // Function To read Page  By::Ashis Kumar Patra  :: On:: 12-Oct-2016
    public function readProfile($id) {

        $result = $this->manageOffProfile('R', $id,0,'','','','','','','','',0,0,0,0,'','0000-00-00','0000-00-00');
        if ($result->num_rows > 0) {

            $row                  =$result ->fetch_array();
            $strOfficerNameE      =  htmlspecialchars_decode($row['vchMinisterNameE'],ENT_QUOTES);        
            $strDesgE             =  htmlspecialchars_decode($row['vchDesignationE'],ENT_QUOTES); 
            $strQuliE             =  htmlspecialchars_decode($row['vchQulificationE'],ENT_QUOTES);
            $strOfficerNameH      =  htmlspecialchars_decode($row['vchMinisterNameH'],ENT_QUOTES);         
            $strDesgH             =  htmlspecialchars_decode($row['vchDesignationH'],ENT_QUOTES);         
            $strQuliH             =  htmlspecialchars_decode($row['vchQulificationH'],ENT_QUOTES); 
            $strMobno            =  htmlspecialchars_decode($row['vchMobile'],ENT_QUOTES); 
            $intSlNo              = $row['intSlNo'];
            $strImageFile         = $row['vchImage'];
            $intLinkType          = $row['intLinkType'];
            $strUrl               = $row['vchUrl'];
        }

        $arrResult = array(  'strQuliH' => $strQuliH,'strDesgH' => $strDesgH,  'strOfficerNameH' => $strOfficerNameH,'strOfficerNameE' => $strOfficerNameE, 'strDesgE' => $strDesgE,  'strQuliE' => $strQuliE, 'intSlNo'=>$intSlNo,'strImageFile'=>$strImageFile,'intLinkType'=>$intLinkType,'strUrl'=>$strUrl,'strMobno'=>$strMobno);
        return $arrResult;
    }
    // Function To Delete Active Profile By::Rasmi Ranjan Swain   :: On:: 08-Jan-20
    public function deleteActiveProfile($action,$ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;       
        foreach ($explIds as $indIds) {
             if($action=='US')
            $slNumber	= $_POST['txtSLNo'.$explIds[$ctr]];
            else
            $slNumber   =0;
            $result = $this->manageOffProfile($action,$explIds[$ctr],$slNumber,'','','','','','','','',0,0,$userId,0,'','0000-00-00','0000-00-00');                   
            $row = $result ->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Officer Profile(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist Page(s) can not be  deleted';
        }
        else if ($action == 'AC')            
                $outMsg = 'Officer Profile(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Officer Profile(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Officer Profile(s) archived successfully';
        else if ($action == 'P')
                 $outMsg = 'Officer Profile(s) published successfully';
        else if ($action == 'US')
                 $outMsg = 'Serial number updated successfully';
         return $outMsg;
        }  
           else {
         return        $outMsg = 'Transaction fail due to session mismatch.';
                
         }

       
    }
}

/* * ****Class to manage Banner ********************
  '	By	 	 : T Ketaki Debadarshini	'
  '	On	 	 : 28-Aug-2015        '
  ' Procedure Used       : USP_BANNER            '
 * ************************************************** */

class clsBanner extends Model {

// Function To Manage Banner By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function manageBanner($action,$bannerId,$Caption,$CaptionO,$image,$pubStatus,$createdBy) {
        $bannerSql = "CALL USP_BANNER('$action',$bannerId,'$Caption','$CaptionO','$image','$pubStatus',$createdBy,@OUT);";
   //echo $bannerSql; //exit();
        $errAction          = Model::isSpclChar($action);
        //$errCaption     = Model::isSpclChar($Caption);
        $errfetImage        = Model::isSpclChar($image);
        //$errContentE        = Model::isSpclChar($contentE);
        if ($errAction > 0 ||  $errfetImage > 0)
            header("Location:" . APP_URL . "error");
        else {
            $bannerResult = Model::executeQry($bannerSql);
            return $bannerResult;
        }
    }

// Function To Add Upadate Banner By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function addUpdateBanner($bannerId) {
         $clear = array('object', 'iframe', 'form', 'frame', 'script', 'select', 'input', 'select', 'option');
        //$allow_img_files=array('jpeg','jpg','gif','png');
         $allow_img_files=array('jpeg','jpg','gif');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId               = $_SESSION['adminConsole_userID'];
         $txtCaption          = Model::strip_editor_tag_content($_POST['txtCaption'], $clear);
         $txtCaption          = htmlspecialchars($txtCaption, ENT_QUOTES);
   
       // $blankCaption         = Model::isBlank($txtCaption);
         $txtCaptionO         = Model::strip_editor_tag_content($_POST['txtCaptionO'], $clear);
         $txtCaptionO         = htmlspecialchars($txtCaptionO, ENT_QUOTES);
        //$blankCaptionO         = Model::isBlank($txtCaptionO);
        //$errCaption           = Model::isSpclChar($_POST['txtCaption']);
        //$lenCaption           = Model::chkLength('max', $txtCaption,200);
       
        $fileDocument           = $_FILES['fileDocument']['name'];
        $fileDocumentName       = $_FILES['fileDocument']['name'];
        $prevFile               = $_POST['hdnImageFile'];
        $fileSize               = $_FILES['fileDocument']['size'];
        $fileTemp               = $_FILES['fileDocument']['tmp_name'];
        $ext                    = pathinfo($fileDocument, PATHINFO_EXTENSION);
        $fileDocument           = ($fileDocument != '') ? 'Banner' . date("Ymd_His") . '.' . $ext : ''; 
        
        if($_FILES['fileDocument']['name']!='')
            $errFile  = Model::isValidFile($fileDocumentName ,$allow_img_files);
           else
           $errFile  = Model::isValidFile($prevFile,$allow_img_files); 
        
        $outMsg                 = '';
        $flag                   = ($bannerId != 0) ? 1 : 0;
        $action                 = ($bannerId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if($errFile==0 || ($errFile%2)==0)
        {
                $errFlag                = 1;
                $flag                   = 1;
                $outMsg                 = "Invalid File types.Upload only jpeg,jpg,gif,png.";
        }
        else if ($fileSize > size10MB) {
            $errFlag = 1;
            $outMsg = 'File size can not more than 10 MB';
        }
//        $dupResult = $this->manageBanner('CD', $bannerId,$txtCaption,$txtCaptionO,'',0,$userId);
        
        if ($fileDocument == '' && $bannerId != 0)
            $fileDocument = $prevFile;
//        if ($dupResult) {
//            $numRows = $dupResult->fetch_array();
            if ($errFlag ==0) {
                 $result = $this->manageBanner($action,$bannerId,$txtCaption,$txtCaptionO,$fileDocument,0,$userId);
                if ($result)
                    $outMsg = ($action == 'A') ? 'Banner added successfully ' : 'Banner updated successfully';
                
                if ($fileDocument != '') {
                    //echo $fileDocument.$fileTemp;//exit();
                    if (file_exists("uploadDocuments/banner/" . $prevFile) && $prevFile != '' && $fileDocumentName!= '') {                       
                        unlink("uploadDocuments/banner/" . $prevFile);               
                    }
                    
                   if($fileDocumentName!="")
                   {
                   $this->GetResizeImages('uploadDocuments/banner/',1600,340,$fileDocument,$fileTemp);}
                    
                    //move_uploaded_file($fileTemp, "uploadDocuments/banner/" . $fileDocument);
                }
                
            } 
//        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strCaption       = ($errFlag == 1) ? $txtCaption : '';
        $strFileName        = ($errFlag == 1) ? $fileDocument : '';                
        $arrResult = array('msg' => $outMsg, 'flag' => $flag, 'strCaption' => $strCaption,'strFileName' => $strFileName);
        return $arrResult;
    }

// Function To read Banner  By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function readBanner($id) {
        $result = $this->manageBanner('R',$id,'','','',0 ,0);
        if ($result->num_rows > 0) {

            $row                = $result ->fetch_array();
            $strCaption         = $row['VCH_CAPTIONS'];
            $strCaptionO         = $row['VCH_CAPTIONS_O'];
            $strFileName        = $row['VCH_IMAGE'];            
        }

        $arrResult = array( 'strCaption' => $strCaption,'strCaptionO' => $strCaptionO,'strFileName'=>$strFileName);
        return $arrResult;
    }

// Function To Delete Banner  By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function deleteBanner($action, $ids) {
            $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            
            $result1 = $this->manageBanner('R',$explIds[$ctr],'','','',0,$userId);
            $row = $result1 ->fetch_array();
            $strImageFile = $row['VCH_IMAGE'];
             
            $result = $this->manageBanner($action,$explIds[$ctr],'','','',0,$userId);                   
            $row = $result ->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
            
             if ($action == 'D' && $strImageFile != '') {
                if (file_exists("uploadDocuments/banner/" . $strImageFile)) {
                    unlink("uploadDocuments/banner/" . $strImageFile);
                }
             }
            
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Banner(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist Page(s) can not be  deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Banner(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Banner(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Banner(s) archieved successfully';
        else if ($action == 'P')
            $outMsg = 'Banner(s) published successfully';
          return $outMsg;
}  
           else {
         return        $outMsg = 'Transaction fail due to session mismatch.';
                
         }
      
    }

}
/* * ****Class to manage Plugins  ********************
  '	By	 	 : T Ketaki Debadarshini	'
  '	On	 	 : 9-Sep-2015          '
  ' Procedure Used       : USP_PLUGIN            '
 * ************************************************** */

class clsPlugin extends Model {
function fillSchemeCat($selVal)
    {
        $schemeSql = "CALL USP_SCHEME_CATEGORY('F', 0, '', '', '0', 1,@OUT);";
        $conResult = Model::executeQry($schemeSql);
        $selOptions	= model::FillDropdown($conResult,$selVal);
	return $selOptions;
    }
// Function To Manage Plugins By::T Ketaki Debadarshini   :: On:: 09-Sep-2015 
    public function managePlugin($action, $pluginId,$functionId,$funCatid,$headLine,$desc,$filedoc,$pubStatus,$archiveStatus,$createdBy,$arcStartDate,$arcEnddate,$portaltype) {
        $headLine           = htmlspecialchars(addslashes($headLine), ENT_QUOTES);
        $pluginSql = "CALL USP_PLUGIN('$action', $pluginId, $functionId,$funCatid,'$headLine','$desc','$filedoc','$pubStatus','$archiveStatus',$createdBy,'$arcStartDate','$arcEnddate','$portaltype',@OUT);";
        //echo '<br><br><br><br><br><br><br><br><br><br>'.$pluginSql;
   
        $errAction          = Model::isSpclChar($action);
        $errHeadline      = Model::isSpclChar($headLine);
        $errfiledoc        = Model::isSpclChar($filedoc);
        //$errContentE        = Model::isSpclChar($contentE);
        if ($errAction > 0 || $errHeadline > 0 || $errfiledoc > 0)
            echo '<script>window.location.href="' . APP_URL . 'error";</script>';
        else {
            $pluginResult = Model::executeQry($pluginSql);
            return $pluginResult;
        }
    }

// Function To Add Update Plugins By::T Ketaki Debadarshini   :: On:: 09-Sep-2015 
    public function addUpdatePlugin($pluginId) {
                                $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId                 = $_SESSION['adminConsole_userID'];
        $txtHeadlineE           = htmlspecialchars(addslashes($_POST['txtHeadline']), ENT_QUOTES);
        $blankHeadlineE         = Model::isBlank($txtHeadlineE);
        $errHeadlineE           = Model::isSpclChar($_POST['txtHeadline']);
        $lenHeadlineE           = Model::chkLength('max', $txtHeadlineE,300);
        
        $rdLinkType         = $_POST['rbtLnkType'];
        $ddlPluginType           = ($_POST['selCat']!='') ? $_POST['selCat'] : 0;
        
        $intfuncId               =$_SESSION['sessFuncId'];
        
        $fileDocumentName       = $_FILES['fileDocument']['name'];
        $prevFile               = $_POST['hdnDocFile'];
        $fileSize               = $_FILES['fileDocument']['size'];
        $fileTemp               = $_FILES['fileDocument']['tmp_name'];
        $ext                    = pathinfo($fileDocumentName , PATHINFO_EXTENSION);
        $fileDocument           = ($fileDocumentName != '') ? 'doc' . date("Ymd_His") . '.' . $ext : '';
       // $txtDetailsE            = htmlspecialchars(addslashes($_POST['txtDetailsE']), ENT_QUOTES);
       // $txtDetailsH            = '';  
        $txtDesc               = htmlspecialchars(addslashes($_POST['txtDesc']), ENT_QUOTES);
        
        $outMsg = '';
        $flag = ($pluginId != 0) ? 1 : 0;
        $action = ($pluginId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
        if($blankHeadlineE >0)
        {
            $errFlag		= 1;
            $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenHeadlineE>0)
        {
            $errFlag		= 1;
            $outMsg			= "Length should not excided maxlength";
        }
        else if($errHeadlineE>0)
        {
            $errFlag		= 1;
            $outMsg			= "Special Characters are not allowed";
        }
        else if ($fileSize > size10MB) {
            $errFlag = 1;
            $outMsg = 'File size can not more than 10 MB';
        }
        $dupResult = $this->managePlugin('CD',$pluginId,$intfuncId,$ddlPluginType,$txtHeadlineE,'','',0,0,0,'0000-00-00','0000-00-00',0);
      //  die();  
        if ($fileDocument == '' && $pluginId != 0)
            $fileDocument = $prevFile;
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Headline wih this name already exists';
                $errFlag = 1;
            } else {
                $result = $this->managePlugin($action,$pluginId,$intfuncId,$ddlPluginType,$txtHeadlineE,$txtDesc,$fileDocument,0,0,$userId,'0000-00-00','0000-00-00',$rdLinkType);
                if ($result)
                    $outMsg = ($action == 'A') ?  $_SESSION['sessPageName'].' added successfully ' : $_SESSION['sessPageName'].' updated successfully';
                if ($fileDocument != '') {
                    if (file_exists("uploadDocuments/plugin/" . $prevFile) && $prevFile != '' && $fileDocumentName!='') {
                         unlink("uploadDocuments/plugin/" . $prevFile);
                    }
                    move_uploaded_file($fileTemp, "uploadDocuments/plugin/" . $fileDocument);
                }
            }
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strHeadLineE       = ($errFlag == 1) ? $txtHeadlineE : '';
        $intfuncId       = ($errFlag == 1) ? $intfuncId : '';       
        $strFileName        = ($errFlag == 1) ? $fileDocument : '';      
        $intPluginType         = ($errFlag == 1) ? $ddlPluginType : '';
        $strDetailH         = ($errFlag == 1) ? $txtDetailsH : '';        
        $arrResult = array('msg' => $outMsg, 'flag' => $flag, 'strHeadLineE' => $strHeadLineE, 'intfuncId' => $intfuncId, 'strFileName' => $strFileName, 'intPluginType' => $intPluginType, 'strDetailH' => $strDetailH);
        return $arrResult;
    }

// Function To read Plugins  By::T Ketaki Debadarshini   :: On:: 09-Sep-2015 
    public function readPlugin($id) {

        $result = $this->managePlugin('R',$id,0,0,'','','',0,0,0,'0000-00-00','0000-00-00',0);
        if ($result->num_rows > 0) {

            $row                  = $result ->fetch_array();
            $strHeadLine          = htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_QUOTES);
            $intFnid              = $row['INT_FN_ID'];
            $strFileName          = $row['VCH_DOCFILE'];                     
            $strFnsubcat          = $row['INT_SUBCAT_ID'];
            $strDesc              =  htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_QUOTES);  
            $strportaltype        = $row['INT_PORTAL_TYPE'];
           
        }

        $arrResult = array( 'strportaltype' => $strportaltype,'strHeadLine' => $strHeadLine, 'intFnid' => $intFnid, 'strFileName' => $strFileName, 'strFnsubcat' => $strFnsubcat,'strDesc' => $strDesc);
        return $arrResult;
    }

// Function To Delete Plugins  By::T Ketaki Debadarshini   :: On:: 09-Sep-2015 
    public function deletePlugin($action, $ids) {
                 $newSessionId           = session_id();
           
                $hdnPrevSessionId       = $_POST['hdnSessionId'];
               if ($newSessionId == $hdnPrevSessionId) { 
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            
        if ($action == 'D'){
            $result1 = $this->managePlugin('R',$explIds[$ctr],0,0,'','','',0,0,0,'0000-00-00','0000-00-00',0);
            $row2 = $result1 ->fetch_array();
            $strDocFile = $row2['VCH_DOCFILE'];
        } 
            $result = $this->managePlugin($action,$explIds[$ctr],0,0,'','','',0,0,0,'0000-00-00','0000-00-00',0);          
            $row = $result ->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
            
             if ($action == 'D' && $strDocFile != '') {
                if (file_exists("uploadDocuments/plugin/" . $strDocFile)) {
                    unlink("uploadDocuments/plugin/" . $strDocFile);
                }
             }
           
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= $_SESSION['sessPageName'].' deleted successfully';
            else
                $outMsg .= 'Dependency record exist Page(s) can not be  deleted';
        }
        else if ($action == 'AC')
            $outMsg = $_SESSION['sessPageName'].' activated successfully';
        else if ($action == 'IN')
            $outMsg = $_SESSION['sessPageName'].' unpublished successfully';
        else if ($action == 'AR')
            $outMsg = $_SESSION['sessPageName'].' archieved successfully';
        else if ($action == 'P')
            $outMsg = $_SESSION['sessPageName'].' published successfully';
         return $outMsg;
}  
           else {
         return        $outMsg = 'Transaction fail due to session mismatch.';
                
         }
       
    }

}

 /*------------------------------------------------
          Function to display all page contents
          By : Sukanta kumar mishra
          On : 25-Apr-2015  
         ------------------------------------------------*/
class clsPageContents extends Model {
        public function viewPageContentDetails($action,$menuId,$hdnPgNo)
        {            
            $sql	= "CALL USP_PAGE_CONTENT('$action','$hdnPgNo','$menuId',0);";
            $result	= Model::executeQry($sql);          
            return $result;
        }
        /*************Function to manage Feedback ***********************
	 		BY :Chinmayee
			On:22-sep-2015
            ****************************************************************/
            public function contactUs()
             {       
                $newSessionId           = session_id();
         
                $hdnPrevSessionId       = $_REQUEST['hdnSessionIds'];
               if ($newSessionId == $hdnPrevSessionId) {  
                        $arrResult		= array();
                        $strCaptcha		= $_REQUEST["txtCaptcha"]; 
                        if($_SESSION['captcha']==$strCaptcha)
                        {	
                            $strName 		= htmlspecialchars(addslashes($_REQUEST["name"]), ENT_QUOTES);
                         
                            $strEmail 		= $_REQUEST["email"];
                            $strMessage		= htmlspecialchars(addslashes($_REQUEST["feedback"]), ENT_QUOTES);
                            $strSubject		= htmlspecialchars(addslashes($_REQUEST["subject"]), ENT_QUOTES);
                            $strPhone           = $_REQUEST["phone"];
                            $MailMessage        = '';
                            $errMsgName		= Model::isSpclChar($_REQUEST["name"]);
                            $errMsgMail		= Model::isSpclChar($_REQUEST["email"]);
                            $errMsgMessage      = Model::isSpclChar($_REQUEST["feedback"]);
                            $errMsgSubject      = Model::isSpclChar($_REQUEST["subject"]);
                            
                            if(($errMsgName>0) || ($errMsgMail>0) || ($errMsgMessage>0) || ($errMsgSubject>0))
                            {
                                    $outMsg		= "Error: Special Characters Are Not Allowed ";
                                    $errFlag	= 1; 
                            }
                            if($errFlag != 1)
                            {
                                $sql		= "CALL USP_FEEDBACK('A', '0', '$strName','', '$strEmail', '$strPhone', '$strSubject', '$strMessage','', '0000-00-00','0000-00-00',0,@out);"; 
                                $result		= Model::executeQry($sql);
                                if($result)
                                {
                                    if(sendMail==Y)
                                    {
                                            //$Subject	= "Contact from GNPOC portal";
                                            $strTo          = portalEmail;
                                            $strFrom	= $strEmail;
                                            $MailMessage.= "Below are Feedback Details of Mr./Mrs. <strong>".$strName."</strong></br>";
                                            $MailMessage.="<div>";
                                            $MailMessage.="<strong>Name &nbsp; &nbsp; &nbsp; : </strong>";
                                            $MailMessage.=$strName."<br/>";
                                            $MailMessage.="<strong>Contact No &nbsp; &nbsp; &nbsp; : </strong>";
                                            $MailMessage.=$strPhone."<br/>";
                                            $MailMessage.="<strong>Subject &nbsp; &nbsp; &nbsp; : </strong>";
                                            $MailMessage.=$strSubject."<br/>";
                                            $MailMessage.="<strong>Message : </strong>";
                                            $MailMessage.=$strMessage;
                                            $MailMessage.="</div>";
                                            Model::Sendmail($strFrom,$strTo,$strSubject,$MailMessage);
                                    }

                                    $outMsg= "Thanks for Contacting Us."; 
                                    $txtName	= '';
                                    $txtNameL	= '';
                                    $txtEmail	= '';
                                    $txtSubject	= '';
                                    $txtMessage	= '';
                                    $txtPhone='';
                                }
                            }
                        }
                        else
                        {
                                $outMsg		= "The Captcha code is invalid! Please try it again";
                                $errFlag	= 1;
                        }
                         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
                        if($errFlag	== 1)
                        {
                                $txtName	= $_POST["name"];
                                //$txtNameL	= $_POST["txtNameL"];
                                $txtEmail	= $_POST["ema"
                                    . "il"];
                                $txtSubject     = $_POST["subject"];
                                $txtMessage	= $_POST["feedback"];
                                $txtPhone	= $_POST["phone"];
                        }

                        $arrResult	= array('flag'=>$errFlag,'msg'=>$outMsg,'strName'=>$txtName,'strEmail'=>$txtEmail,'strSubject'=>$txtSubject,'strMessage'=>$txtMessage,'strMobile'=>$txtPhone);
                        return $arrResult;

                }
        /*------------------------------------------------
          Function to display all page contents
          By : Sukanta kumar mishra
          On : 25-Apr-2015  
         ------------------------------------------------*/
        public function viewPageContentPaging($action,$menuId)
        {            
            $sql	= "CALL USP_PAGE_CONTENT('$action','','$menuId',0);";
            //echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'.$sql;
            $result	= Model::executeQry($sql);        
            return $result;
        }
}

/* * ****Class to manage lINK  ********************
  '	By	 	 : T Ketaki Debadarshini 	'
  '	On	 	 : 04-Sep-2015          '
  ' Procedure Used       : USP_IMP_LINK            '
 * ************************************************** */

class clsLink extends Model {

// Function To Manage Link By::T Ketaki Debadarshini   :: On:: 04-Sep-2015 
    public function manageLink($action, $linkId, $headLineE, $headLineH, $url,$document, $pubStatus,$archiveStatus ,$createdBy,$slNo,$linkType,$fileDocument) {
        $linkSql = "CALL USP_IMP_LINK('$action', $linkId, '$headLineE', '$headLineH', '$url','$document', '$pubStatus','$archiveStatus', $createdBy,$slNo,$linkType,'$fileDocument',@OUT);";
        /*if($action == 'A'){
            echo $linkSql;
            exit;
        }*/
   
        //echo $linkSql;
        $errAction          = Model::isSpclChar($action);
        $errHeadlineE      = Model::isSpclChar($headLineE);

        if ($errAction > 0 || $errPageTitleE > 0 )
            echo '<script>window.location.href="' . APP_URL . 'error";</script>';
        else {
            $linkResult = Model::executeQry($linkSql);
            return $linkResult;
        }
    }

 // Function To Add Upadate Link By::T Ketaki Debadarshini   :: On:: 04-Sep-2015
//  Updated By :: Sonali Satapathy   Updated On :: 27-Sep-2016  
    public function addUpdateLink($linkId) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        //echo $hdnPrevSessionId.'==='.$newSessionId;
        if ($newSessionId == $hdnPrevSessionId) {
            $userId                 = $_SESSION['adminConsole_userID'];
            $linkType=0;
            $errlinkType            = Model::isSpclChar($_POST['radStatus']);
            $txtHeadlineE           = htmlspecialchars(addslashes($_POST['txtHeadlineE']),ENT_QUOTES);
            $blankHeadlineE         = Model::isBlank($txtHeadlineE);
            
       
            $txtURL                 = ($action == 'A') ? 'http://'.$_POST['txtURL'] :$_POST['txtURL'];
            $errURL                   = ($txtURL!='http://')?Model::isValidURL($_POST['txtURL']):0;
            
        
        
            $flag                           = ($linkId != 0) ? 1 : 0;
            $action                         = ($linkId == 0) ? 'A' : 'U';
            $errFlag                        = 0 ;
            if($blankHeadlineE >0)
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
            }
            else if($lenHeadlineE>0)
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Length should not excided maxlength";
            }
            else if(($errHeadlineE >0) || ($errlinkType>0))
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
            }
            else if(($errURL>0))
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Please enter a valid URL";
            }
           
            if($errFlag==0){
                $dupResult = $this->manageLink('CD', $linkId,$txtHeadlineE,'','','', 0,0,$userId,0,$linkType,'');     
                if ($dupResult) {
                    $numRows = $dupResult->fetch_array();
                    if ($numRows > 0) {
                        $outMsg = 'Important Link wih this name already exists';
                        $errFlag = 1;
                    } else {
                        $result = $this->manageLink($action, $linkId, $txtHeadlineE,'',$txtURL,'', 0,0 ,$userId,0,$linkType,'');
                        if ($result)
                            $outMsg = ($action == 'A') ? 'Link added successfully' : 'Link updated successfully';
                    }
                }
            }
        }else {
            $outMsg = 'Transaction fail due to session mismatch.';
            $errFlag = 1; 
         }
        $strHeadLineE       = ($errFlag == 1) ? $txtHeadlineE : '';    
        $strURL             = ($errFlag == 1) ? $txtURL : '';
               
        $arrResult = array('msg' => $outMsg, 'flag' => $errFlag,'strHeadLineE' => $strHeadLineE,  'strURL' => $strURL);
        return $arrResult;
    }

// Function To read Link  By::T Ketaki Debadarshini   :: On:: 04-Sep-2015 
    public function readLink($id) {

        $result = $this->manageLink('R', $id,'','','','', 0,0 ,0,0,0,'');
        
        if ($result->num_rows > 0) {

            $row                = $result ->fetch_array();
            $strHeadLineE       = $row['vchLinkNameE'];
            $strLinkType        = $row['tinLinkType'];
            $strHeadLineH       = htmlspecialchars_decode($row['VchLinknameH'],ENT_QUOTES);
            $strURL             = $row['vchUrl'];                    
            $strimage           = $row['vchImage'];
            $strdocument        = $row['vchDocument'];
           
        }

        $arrResult = array( 'strLinkType' => $strLinkType,'strimage' => $strimage,'strdocument' => $strdocument,'strHeadLineE' => $strHeadLineE, 'strHeadLineH' => $strHeadLineH, 'strURL' => $strURL);
        return $arrResult;
    }

// Function To Delete External Link(  By::T Ketaki Debadarshini   :: On:: 04-Sep-2015 
    public function deleteLink($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageLink($action,$explIds[$ctr],'','', '','', 0,0 ,$userId,0,0,'');                   
            $row = $result ->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Important Link(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist Page(s) can not be  deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Important Link(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Important Link(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Important Link(s) archieved successfully';
        else if ($action == 'P')
            $outMsg = 'Important Link(s) published successfully'; return $outMsg;
            }  
           else {
         return        $outMsg = 'Transaction fail due to session mismatch.';
                
         }
       
    }

}




class clsSearch extends Model {
    public function viewSearch($action,$intRecno,$searchTxt)
        {   
   
           $errsearch   = Model::isSpclChar($searchTxt);        
                                       
          if ($errsearch > 0)
             header("Location:" . SITE_PATH. "error");
            else {
            $sql	= "CALL USP_SEARCH('$action',$intRecno,'$searchTxt');"; 
          // echo $sql;
            $result = Model::executeQry($sql);
            return $result;
          }
           
          }
     
}




/* * ****Class to manage Page ********************
  '	By	 	 : T Ketaki Debadarshini	'
  '	On	 	 : 10-Aug-2016          '
  ' Procedure Used       : USP_PAGES            '
 * ************************************************** */

class clsPages extends Model {

// Function To Manage Page By::T Ketaki Debadarshini   :: On:: 13-Aug-2015
    public function managePage($action,$pageId, $pageTitleE, $pageTitleH, $pageTitleO,$fetImage, $linkType, $url, $templetType, $contentE, $contentH, $pluginName, $windowType, $pubStatus, $createdBy,$arcStatus,$arcStartDate,$arcEndDate,$pageAlias,$metaTitle,$metaType,$metaKey,$metaDesc,$metaImage,$attr1,$attr2,$selFunctionid,$fileDoc='') {
        $pageId         = htmlspecialchars(addslashes($pageId),ENT_QUOTES);
        $pageTitleE     = htmlspecialchars(addslashes($pageTitleE),ENT_QUOTES);
        $pageTitleH     = htmlspecialchars(addslashes($pageTitleH),ENT_QUOTES);
        $fetImage       = htmlspecialchars(addslashes($fetImage),ENT_QUOTES);
        $linkType       = htmlspecialchars(addslashes($linkType),ENT_QUOTES);
        $url            = htmlspecialchars(addslashes($url),ENT_QUOTES);
        $templetType    = htmlspecialchars(addslashes($templetType),ENT_QUOTES);
        $pluginName    = htmlspecialchars(addslashes($pluginName),ENT_QUOTES);  

        $pageSql = "CALL USP_PAGES('$action','$pageId','$pageTitleE','$pageTitleH','$pageTitleO','$pageAlias','$metaTitle','$metaKey','$metaDesc','$metaType','$metaImage','$fetImage','$linkType','$url','$templetType','$pluginName','$windowType','$pubStatus','$createdBy','$attr1','$attr2',$selFunctionid,'$fileDoc');";

         //echo $pageAlias."::----".$pageSql; exit;
        $errAction          = Model::isSpclChar($action);
        //$errPageTitleE      = Model::isSpclChar($pageTitleE);
        $errfetImage        = Model::isSpclChar($fetImage); 
        //echo $errAction ." ". $errPageTitleE." ".$errfetImage;
        if ($errAction > 0 || $errfetImage > 0)
            header("Location:" . APP_URL . "error");
        else { 
            $pageResult = Model::executeQry($pageSql);
            return $pageResult;
        }
    }

    // Function To Manage Page Content By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function managePageContent($action,$contentId,$pageId,$pageNo, $contentE, $contentH,$text) {
        $contentId      = htmlspecialchars(addslashes($contentId),ENT_QUOTES);
        $pageId         = htmlspecialchars(addslashes($pageId),ENT_QUOTES); 
        $pageNo         = htmlspecialchars(addslashes($pageNo),ENT_QUOTES);
        $pageSql        = "CALL USP_PAGE_CONTENT('$action','$text','$pageId','$pageNo');";        
      // echo $pageSql;
        $errAction      = Model::isSpclChar($action);
        $errContentId   = Model::isSpclChar($contentId);
        $errPageId      = Model::isSpclChar($pageId); 
      
        if ($errAction > 0 || $errContentId > 0 || $errPageId > 0)
            header("Location:" . APP_URL . "error");
        else {
            $pageResult = Model::executeQry($pageSql);
            return $pageResult;
        }
    }
    function getMaxPage($pageId)
    {
        $maxRes= $this->managePageContent('MP',0, $pageId,0,'','','');
        if($maxRes->num_rows>0)
        {
            $row        = $maxRes->fetch_array();
            $maxPageno  = $row['maxPageNo'];
        }
            return $maxPageno;
    }
    
// Function To Add Upadate Page By::sonali Satapathy   :: On:: 22-Sept-2016
    public function addUpdatePages($pageId) {
        $clear = array('object', 'iframe', 'form', 'frame', 'script', 'select', 'input', 'select', 'option');
        $allow_doc_files        = array('pdf','xls','xlsx');
        $allow_img_files=array('jpeg','jpg','gif','png');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        //echo $newSessionId ."==". $hdnPrevSessionId;exit;
         if ($newSessionId == $hdnPrevSessionId) 
         {
        $userId             = ($_SESSION['adminConsole_userID']!='')?$_SESSION['adminConsole_userID']:0;
        $userId             = 1;
        $txtTitle_e         = htmlspecialchars(addslashes($_POST['txtTitle_e']), ENT_QUOTES);
        $blankTitleE        = Model::isBlank($txtTitle_e);
        $errTitleE          = Model::isSpclChar($_POST['txtTitle_e']);
        $lenTitleE          = Model::chkLength('max', $txtTitle_e, 70);
        
        $txtPagename         = htmlspecialchars(addslashes($_POST['txtPagename']), ENT_QUOTES);
        $blankPagename       = Model::isBlank($txtPagename);
        $errPagename         = Model::isSpclChar($_POST['txtPagename']);
        $lenPagename         = Model::chkLength('max', $txtPagename, 70);   
        $txtPagenameO       = htmlspecialchars(addslashes($_POST['txtPagenameO']), ENT_QUOTES);
        //echo $txtPagenameO;
        $pageAlias          = htmlspecialchars(addslashes($_POST['txtPageAlias']), ENT_QUOTES);
        $errpageAlias       = Model::isSpclChar($_POST['txtPageAlias']);
        $metaTitle          = htmlspecialchars(addslashes($_POST['txtMetaTitle']), ENT_QUOTES);
        $errmetaTitle       = Model::isSpclChar($_POST['txtMetaTitle']);
        $metaType           = htmlspecialchars(addslashes($_POST['txtMetaType']), ENT_QUOTES);
        $errmetaType        = Model::isSpclChar($_POST['txtMetaType']);
        $metaKey            = htmlspecialchars(addslashes($_POST['txtMetaKey']), ENT_QUOTES);
        $errmetaKey          = Model::isSpclChar($_POST['txtMetaKey']);
        $metaDesc           = htmlspecialchars(addslashes($_POST['txtMetaDescription']), ENT_QUOTES);
        $errmetaDesc        = Model::isSpclChar($_POST['txtMetaDescription']);
       
        $txtSnippet         = htmlspecialchars(addslashes($_POST['txtSnippet']), ENT_QUOTES);
        $errSnippet         = Model::isSpclChar($_POST['txtSnippet']);
       
        $metaImageName        = htmlspecialchars(addslashes($_POST['fileMetaImage']), ENT_QUOTES);
        $fileFeaturedImageName= $_FILES['fileUploadDocument']['name'];
        $prevFile             = $_POST['hdnUploadDocument'];
        $fileSize             = $_FILES['fileUploadDocument']['size'];
        $fileTemp             = $_FILES['fileUploadDocument']['tmp_name'];
        //echo $_FILES['fileUploadDocument']['type'];
        if($_FILES['fileUploadDocument']['name']!='')
        $ext                  = pathinfo($fileFeaturedImageName, PATHINFO_EXTENSION);
        else
         $ext                  = pathinfo($prevFile, PATHINFO_EXTENSION);  
        //echo $ext;exit;
        $fileFeaturedImage    = ($fileFeaturedImageName != '') ? 'Doc' . date("Ymd_His") . '.' . $ext : '';
        
          $errPageFlag    = 0; $errPageFlagH    = 0;
           $chkTags = '<button,<form,<iframe,<input,<script,<select,<textarea,<svg,onload,onerror,alert';
        $rbtLnkType           = $_POST['rbtLnkType'];

        /* link document for document radio button */
        $fileDocName             = $_FILES['docFile']['name'];
        $prevDocFile             = $_POST['hdnDocFile'];
        $docfileSize             = $_FILES['docFile']['size'];
        $docfileTemp             = $_FILES['docFile']['tmp_name'];
        if($_FILES['docFile']['name']!='')
         $docext                  = pathinfo($fileDocName, PATHINFO_EXTENSION);
        else
         $docext                  = pathinfo($prevDocFile, PATHINFO_EXTENSION);  

        $fileDoc    = ($fileDocName != '') ? 'LinkDoc' . date("Ymd_His") . '.' . $docext : '';
        //End for link document

        if ($rbtLnkType == 2) {
            $txtURL = $_POST['txtURL'];
            $errURL  =  !empty($txtURL)? Model::isValidURL($txtURL):0;
            $errPageFlag    = 0;
            $errPageFlagH    = 0;
            $txtContentE = '';
            $txtContentH = '';
            if($_FILES['fileUploadDocument']['name']!='')
            $errFile  = Model::isValidFile($_FILES['fileUploadDocument']['name'],$allow_doc_files);
           else
             $errFile  = Model::isValidFile($prevFile,$allow_doc_files); 
        } else
            $txtURL = '';
        $radTemplateType = $_POST['radTemplateType'];
        if ($radTemplateType == 1) {
            $txtContentE = Model::strip_editor_tag_content($_POST['txtContentE'], $clear);
            $txtContentE    = htmlspecialchars($txtContentE, ENT_QUOTES);
            $txtContentH = Model::strip_editor_tag_content($_POST['txtContentO'], $clear);
            $txtContentH    = htmlspecialchars( $txtContentH, ENT_QUOTES);

            //======image option on page start=====
            $featuredPageimage  = $_FILES['fileDocumentImage']['name'];
            $fileTemp             = $_FILES['fileDocumentImage']['tmp_name'];
            $prevFile = $_POST['hdnImageFile'];
            $extension      = pathinfo($featuredPageimage, PATHINFO_EXTENSION);
            $fetImgFileSize    = $_FILES['fileDocumentImage']['size'];
            $formattedfeaturedPageimage = ($featuredPageimage != '') ? 'Page_' . time() . '.' . $extension: '';
            if($featuredPageimage!='')
                $errImageFile  = Model::isValidFile($featuredPageimage,$allow_img_files);
            else
                $errImageFile  = Model::isValidFile($prevFile,$allow_img_files);
            
            if ($featuredPageimage == '' && $pageId != 0)
                $formattedfeaturedPageimage = $prevFile;
            //=====================================
            
            $selPlid  = 0;  $selFunctionid  = 0;
        } else if ($radTemplateType == 2) {
            $txtContentE    = '';
            $txtContentH = '';
           // $selPluginName  = $_POST['selPluginName'];
           $selPlugin = $_POST['selPluginName'];
           $selPluginNameArr=  explode("_", $selPlugin);
           $selPlid  = $selPluginNameArr[0];
           $selFunctionid  = $selPluginNameArr[1];
             
        } else if ($radTemplateType == 3) {
            $txtContentE    = '';
            $txtContentH    = '';
            $selPlid  = 0;  $selFunctionid  = 0;
        } else if ($radTemplateType == 4) {
            $txtContentE    = '';
            $txtContentH    = '';
            $selPlid  = 0;  
            $selFunctionid  = 0;
            if($_FILES['docFile']['name']!='')
             $errDocFile  = Model::isValidFile($_FILES['docFile']['name'],$allow_doc_files);
            else
             $errDocFile  = Model::isValidFile($prevDocFile,$allow_doc_files);
        }

        $radWinStatus       = $_POST['radWinStatus'];
        
        $outMsg             = '';
        $flag               = 0;
        $action             = ($pageId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
        $query              = '';$queryH              = '';
        if(($blankTitleE >0 ) || ($blankPagename >0 ))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($lenTitleE>0) || ($lenPagename>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Length should not exceed maxlength";
        }
        else if(($errTitleE>0) || ($errSnippet>0)||($errPagename>0) ||( $errpageAlias>0)||($errmetaTitle >0) ||($errmetaType>0)||($errmetaKey>0)||($errmetaDesc >0) )
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
        if ($rbtLnkType == 2 && $_FILES['fileUploadDocument']['name'] !='') {
                if($errFile==0 || ($errFile%2)==0)
                     {
                             $errFlag                = 1;
                             $flag                   = 1;
                             $outMsg                 = "Invalid File types.Upload only pdf,xls.";
                     }
                 else if ($fileSize > size10MB) {
                       $errFlag                     = 1;
                       $flag                        = 1;
                       $outMsg                      = 'File size can not more than 10 MB';
                   }
                 else if(($errURL>0))
                {
                        $errFlag		= 1;
                        $flag                   = 1;
                        $outMsg			= "Please enter a valid URL";
                }
      
        }
        if ($rbtLnkType == 1 && $radTemplateType == 4 && $_FILES['docFile']['name'] !='') {
                if($errDocFile==0 || ($errDocFile%2)==0)
                     {
                             $errFlag                = 1;
                             $flag                   = 1;
                             $outMsg                 = "Invalid File types.Upload only pdf,xls,xlsx.";
                     }
                 else if ($docfileSize > size10MB) {
                       $errFlag                     = 1;
                       $flag                        = 1;
                       $outMsg                      = 'File size can not more than 10 MB';
                   }          
        }else if($rbtLnkType == 1 && $radTemplateType ==1 && $_FILES['fileDocumentImage']['name'] !=''){
            if($errImageFile==0 || ($errImageFile%2)==0)
            {
                    $errFlag                = 1;
                    $flag                   = 1;
                    $outMsg                 = "Invalid File types.Upload only jpeg,jpg,gif,png";
            }
            else if ($fetImgFileSize > size10MB) {
                $errFlag                     = 1;
                $flag                        = 1;
                $outMsg                      = 'File size can not more than 10 MB';
            }   
        }
        if ($radTemplateType == 1) {
            $fileFeaturedImage = $formattedfeaturedPageimage;
        }
        if ($fileFeaturedImage == '' && $pageId != 0)
            $fileFeaturedImage = $prevFile;

        if ($fileDoc == '' && $pageId != 0)
            $fileDoc = $prevDocFile;
        
         $metaImage =  $metaImageName ;

        //Assign page image to fileFeaturedImage
        
        

        //====
        $totalRowNum        = count($_POST['hdnPagevalue']);
           $totalRowNumH        = count($_POST['hdnPagevalueO']); 
        if($errFlag==0){
            $dupResult          = $this->managePage('CD', $pageId, $txtTitle_e, '','', '', 0, '', 0, '', '', '', 0, 0, 0,0,'0000-00-00','0000-00-00',$pageAlias,'','','','','','0','',0);
           if ($dupResult) {
               $numRows =($dupResult->num_rows);  
               if ($numRows > 0) {
                   $outMsg = 'Page with this name already exists';
                   $flag = 1;
               } else {
                   $result = $this->managePage($action, $pageId, $txtTitle_e, $txtPagename,$txtPagenameO, $fileFeaturedImage, $rbtLnkType, $txtURL, $radTemplateType, $txtContentE, $txtContentH, $selPlid, $radWinStatus, 1, $userId,0,'0000-00-00','0000-00-00',$pageAlias,$metaTitle,$metaType,$metaKey,$metaDesc,$metaImageName,'0',$txtSnippet,$selFunctionid,$fileDoc);
                   if($action == 'A')
                   $row =$result ->fetch_array();
                   $conPageId=($action == 'A') ? $row[0] :$pageId;
                   for($rowNum=0;$rowNum<$totalRowNum;$rowNum++)
                    {
                        $strContent          = $_POST['hdnPagevalue'][$rowNum];
                        $intPageNo           = $_POST['hdnPageId'][$rowNum];
                        $intContentId        = $_POST['hdnContentId'][$rowNum];  
                        $pregContent        = preg_replace('/\s+/', '', $strContent);                   
                        $checkTagsStatus    = Model::checkHtmlTags($pregContent, $chkTags);
                        if($checkTagsStatus>0)
                        {
                           $errPageFlag++;
                        }else
                        {
                        $query	.='('.$conPageId.','.$intPageNo.',"'.htmlspecialchars(addslashes($strContent), ENT_QUOTES).'",0),';
                        }
                    }
                    $query	= substr($query,0,-1); //print_r($query);
                  for($rowNumH=0;$rowNumH<$totalRowNumH;$rowNumH++)
                    {
                        $strContentH          = $_POST['hdnPagevalueO'][$rowNumH];
                        $intPageNoH           = $_POST['hdnPageIdO'][$rowNumH];
                        $intContentIdH        = $_POST['hdnContentIdO'][$rowNumH]; 
                        $pregContentH        = preg_replace('/\s+/', '', $strContentH);                   
                        $checkTagsStatusH    = Model::checkHtmlTags($pregContentH, $chkTags);
                        if($checkTagsStatusH>0)
                        {
                           $errPageFlagH++;
                        }else
                        {
                        $queryH	.='('.$conPageId.','.$intPageNoH.',"'.htmlspecialchars(addslashes($strContentH), ENT_QUOTES).'",0),';	
                        }
                    }
                     $queryH	= substr($queryH,0,-1);
                   //  print_r($queryH);
                    if($action == 'U')
                    {                
                        $this->managePageContent('D1',0,$conPageId,0,'','',''); 
                         $this->managePageContent('D2',0,$conPageId,0,'','',''); 
                    }
                      $pageResult = $this->managePageContent('A1',0,$conPageId, 0, $txtContentE,'',$query);
                     $pageResult2 = $this->managePageContent('A2',0,$conPageId, 0, $txtContentH,'',$queryH);
                   if ($pageResult)
                       $outMsg = ($action == 'A') ? 'Page added successfully ' : 'Page updated successfully';
                   if ($fileFeaturedImage != '') {
                       
                       if (file_exists("uploadDocuments/featuredImage/" . $prevFile) && $prevFile != '' && $fileFeaturedImage!= '') {                                  
                            unlink("uploadDocuments/featuredImage/" . $prevFile);                                 
                       }
                       move_uploaded_file($fileTemp, "uploadDocuments/featuredImage/" . $fileFeaturedImage);
                   }
                   if ($fileDoc != '') {
                       if (file_exists("uploadDocuments/LinkDoc/" . $prevDocFile) && $prevDocFile != '' && $fileDocName!= '') {                                  
                            unlink("uploadDocuments/LinkDoc/" . $prevDocFile);                                 
                       }
                       move_uploaded_file($docfileTemp, "uploadDocuments/LinkDoc/" . $fileDoc);
                   }

               }
           }
        }
        
    }else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strTitleE          = ($flag == 1) ? $txtTitle_e : '';
        $strSnippet          = ($flag == 1) ? $txtSnippet : '';
        $strName          = ($flag == 1) ? $txtPagename : '';
        $intLinkType        = ($flag == 1) ? $rbtLnkType : '1';
        $strFileName        = ($flag == 1) ? $fileBanner : '';
        $strUrl             = ($flag == 1) ? $txtURL : '';
        $intTempletType     = ($flag == 1) ? $radTemplateType : '1';
        $strContentE        = ($flag == 1) ? $txtContentE : '';
        $strContentH        = ($flag == 1) ? $txtContentH : '';
        $strPluginName      = ($flag == 1) ? $selPluginName : '0';
        $intWinStatus       = ($flag == 1) ? $radWinStatus : '1';
        
        $intPlid            = ($flag == 1) ? $selPlid : '0';
        $intFunctionid      = ($flag == 1) ? $selFunctionid : '0';
        $strDocFile         = ($flag == 1) ? $fileDoc : '';
        
        $arrResult = array('msg' => $outMsg, 'flag' => $flag, 'strTitleE' => $strTitleE,'strName' => $strName,'strSnippet' => $strSnippet, 'strTitleH' => $strTitleH, 'intLinkType' => $intLinkType, 'strFileName' => $strFileName, 'strUrl' => $strUrl, 'intTempletType' => $intTempletType, 'strContentE' => $strContentE, 'strContentH' => $strContentH, 'strPluginName' => $strPluginName, 'intWinStatus' => $intWinStatus,'intPlid' => $intPlid,'intFunctionid' => $intFunctionid,'strDocFile' => $strDocFile);
        return $arrResult;
    }

  // Function To read Page  By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function readPage($id) {

        $result = $this->managePage('R', $id, '', '','', '', 0, '', 0, '', '', '', 0, 0, 0,0,'0000-00-00','0000-00-00','','','','','','','0','',0);
        if ($result->num_rows > 0) {

            $row            = $result ->fetch_array();
            $strTitleE      = htmlspecialchars_decode($row['vchTitle'], ENT_NOQUOTES);
            $strSnippet      = $row['vchSnippet'];
            $strName        = htmlspecialchars_decode($row['vchName'], ENT_NOQUOTES);
            $strNameO        = htmlspecialchars_decode($row['vchNameO'], ENT_NOQUOTES);
            $intLinkType    = $row['intLinkType'];
            $strFileName    = $row['vchFeaturedImage'];
            $strUrl         = $row['vchUrl'];
            $strPageAlias   = $row['vchPageAlias'];
            $strMetaTitle   = $row['vchMetaTitle'];
            $strMetaKeyword = $row['vchMetaKeyword'];
            $strMetaDescription   = $row['vchMetaDescription'];
            $strMetaType    = $row['vchMetaType'];
            $strMetaImage   = $row['vchMetaImage'];
            $intTempletType = $row['intTemplateType'];
            $strContentE    = $row['vchPageContentE'];
            $strContentH    = $row['vchPageContent_H'];
            //$strPluginName  = $row['vchPluginName'];
            $intWinStatus   = $row['intWindowStatus'];
            
            $intPlid    = $row['vchPluginName'];
            $intFunctionid    = $row['INT_FUNCTION_ID'];
            $strDocFile = $row['vchLinkImage'];
        }

        $arrResult = array('strNameO' => $strNameO,'strPageAlias' => $strPageAlias,'strSnippet' => $strSnippet,'strMetaTitle' => $strMetaTitle,'strMetaKeyword' => $strMetaKeyword,'strMetaDescription' => $strMetaDescription,'strMetaType' => $strMetaType,'strMetaImage' => $strMetaImage,'strTitleE' => $strTitleE, 'strName' => $strName, 'intLinkType' => $intLinkType, 'strFileName' => $strFileName, 'strUrl' => $strUrl, 'intTempletType' => $intTempletType, 'strContentE' => $strContentE, 'strContentH' => $strContentH, 'strPluginName' => $strPluginName, 'intWinStatus' => $intWinStatus,'intPlid' => $intPlid,'intFunctionid' => $intFunctionid, 'strDocFile' => $strDocFile);
        return $arrResult;
    }
// Function To view page content  By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function viewPageContent($id,$pageNo) {

        $result = $this->managePageContent('VC',0,$id, $pageNo,'','','');
        if ($result->num_rows > 0) {

            $row            = $result ->fetch_array();
            $strContentE    = htmlspecialchars_decode(str_replace('&quot;','"',$row ['vchContentE']),ENT_NOQUOTES);
            $pageTitle      = htmlspecialchars_decode(str_replace('&quot;','"',$row ['pageTitle']),ENT_NOQUOTES);
            
        }

        $arrResult = array('strContentE' => $strContentE,'pageTitle'=>$pageTitle);
        return $arrResult;
    }
    
    //function to Read page content By T Ketaki Debadarshini On:28-Aug-2015
	public function readPageContent($pageId)
	{
		$result	= $this->managePageContent('VR',0,$pageId,0,'','','');
		$arrRow		= array();
		if($result->num_rows>0)
		{
			$ctr	= 0;
			while($row=$result->fetch_array())
			{
				//$arrRow[$ctr]['intContentId']		= $row['intContentId'];
				$arrRow[$ctr]['intPageId']		= $row['intPageId'];
				$arrRow[$ctr]['intPageNo']		= $row['intPageNo'];
				$arrRow[$ctr]['strContent']		= htmlspecialchars_decode(str_replace('&quot;','"',$row ['vchContentE']),ENT_NOQUOTES);
                                      
				$ctr++;
			}
		}
		return $arrRow;
	}

// Function To Delete Page  By::T Ketaki Debadarshini   :: On:: 28-Aug-2015
    public function deletePage($action, $ids) {
                $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0; 
        $userId = ($_SESSION['adminConsole_userID']!='')?$_SESSION['adminConsole_userID']:0;
        $explIds = explode(',', $ids);
        $delRec = 0;
        $fail	= '';
        foreach ($explIds as $indIds) {
            
            $result1 = $this->managePage('R',$explIds[$ctr],'', '', '','', 0, '', 0, '', '', '', 0, 0, $userId,0,'0000-00-00','0000-00-00','','','','','','','0','',0);
            $delrow = $result1->fetch_array;
            $strFImageFile = $delrow['vchFeaturedImage'];
            $strMImageFile = $delrow['vchMetaImage'];
            $result = $this->managePage($action, $explIds[$ctr], '', '', '','', 0, '', 0, '', '', '', 0, 0, $userId,0,'0000-00-00','0000-00-00','','','','','','','0','',0);
            $row = $result->fetch_array();
            if ($row[0]=='0')
                $delRec++;
            else
		$fail	.= $row[0].',';
         
            if ($action == 'D' && ($strFImageFile != '' || $strMImageFile != '')) {
                if (file_exists("uploadDocuments/banner/" . $strMImageFile)) {
                    unlink("uploadDocuments/banner/" . $strMImageFile);
                }
                if (file_exists("uploadDocuments/featuredImage/" . $strFImageFile)) {
                    unlink("uploadDocuments/featuredImage/" . $strFImageFile);
                }
             }
				
            $ctr++;
            
        }
	$msgFail    = '';
        $msgSuccess = '';
        if ($action == 'D') {
            if ($delRec > 0)
                $msgSuccess .= 'Page(s) deleted successfully';
            if($fail !='')
                $msgFail .=  $fail.' Page(s) used in menu can not be  deleted';
            
            $outMsg	= $msgFail.' '.$msgSuccess;
        }
        else if ($action == 'AC')
            $outMsg = 'Page(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Page(s) unpublished successfully';
        else if ($action == 'P')
            $outMsg = 'Page(s) published successfully';
        else if ($action == 'AR')
        {
            if ($delRec > 0)
                $msgSuccess .= 'Page(s) archived successfully';
            if($fail !='')
                $msgFail .= $fail.' Page(s) used in menu can not be  archived';
                $outMsg = $msgFail.' '.$msgSuccess;
        } return $outMsg;
           }  
           else {
         return        $outMsg = 'Transaction fail due to session mismatch.';
                
         }
       
    }
    

}

class clsAdminLinksnew extends Model {

    // Function To Manage Admin Globallink By::T Ketaki Debadarshini   :: On::3-Sept-2015  
    public function manageAdminGLinks($action,$glId,$glName)
     {
         $glSql = "CALL USP_ADMIN_GL('$action',$glId,'$glName',@out);";
         $glResult = Model::executeQry($glSql);
         return $glResult;
     }
 
   // Function To Manage Admin Primarylink By::T Ketaki Debadarshini   :: On::3-Sept-2015  
    public function manageAdminPLinks($action,$plId,$glId,$plName,$plUrl)
    {
         $plSql = "CALL USP_ADMIN_PL('$action',$plId,$glId,'$plName','$plUrl',@out);";
       // echo $plSql;
         $plResult = Model::executeQry($plSql);
         return $plResult;
    }
     
     // Function To Manage Plugins By::T Ketaki Debadarshini   :: On::9-Sept-2015  
   /* public function managePlugins($action,$plId,$glId,$plName,$plUrl)
     {
         $plSql = "CALL USP_ADMIN_PL('$action',$plId,$glId,'$plName','$plUrl',@out);";
        
         $plResult = Model::executeQry($plSql);
         return $plResult;
     }*/
 
}

/* * ****Class to manage directory category ********************
  '	By	 	 : Chinmayee	'
  '	On	 	 : 03-06-2016          '
  ' Procedure Used       : USP_DIRECTORY_CATEGORY            '
 * ************************************************** */

class clsDircategory extends Model {

    // Function To Mange directory category By::Chinmayee  :: On:: 03-06-2016  
    public function manageDircategory($action, $catId, $catName, $slno, $query, $createdBy,$publish) {
        $catId         = htmlspecialchars(addslashes($catId),ENT_QUOTES);
        $catName       = htmlspecialchars(addslashes($catName),ENT_QUOTES);
        $sql = "CALL USP_DIRECTORY_CATEGORY('$action','$catId','$catName', '$query',$createdBy,'$slno','$publish',@OUT);";
      // echo $sql;
        $errAction = Model::isSpclChar($action);
        $errword = Model::isSpclChar($catName);
        if ($errAction > 0 || $errword > 0)
             header("Location:" . APP_URL . "error");
        else {
            $result = Model::executeQry($sql);
            return $result;
        }
    }

    // Function To Update directory category By::Chinmayee  :: On:: 03-06-2016 
    public function EditDircategory() {
                
         $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $txtCategory = htmlspecialchars(addslashes($_POST['txtCategory']), ENT_QUOTES);
        $userId = $_SESSION['adminConsole_userID'];
        $hdnrecId = $_POST['hdnCatid'];
        $hdnpublish = $_POST['hdnpublish'];
        $slnoId = $_POST['txtslno'];
        $outMsg = '';
        $flag = ($hdnrecId != 0) ? 1 : 0;
        $action = 'U';
        $result = $this->manageDircategory($action, $hdnrecId, $txtCategory, $slnoId, '', $userId,$hdnpublish);
        if ($result) {
            $outMsg = 'Category Updated successfully ';
        }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                
         }
        $arrResult = array('msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

    // Function To Add  directory category By::Chinmayee  :: On:: 03-06-2016 

    public function addUpdateDircategory($catId) {
         $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        if ($newSessionId == $hdnPrevSessionId) {
        $outMsg = '';
        $flag = ($catId != 0) ? 1 : 0;
        $userId = $_SESSION['adminConsole_userID'];
        $errFlag = 0;
        $hdnslno = $_POST['hdnSlno'];
        $radStatus = $_POST['radStatus'];
        $totalRowNum = count($_REQUEST['txtCategory']);
        //   echo $totalRowNum;
        $query = '';
        $query2 = '';
        for ($rowNum = 0; $rowNum < $totalRowNum; $rowNum++) {

            $txtCategory = $_POST['txtCategory'][$rowNum];
            $errCategory = Model::isSpclChar($txtCategory);

            $query .='("' . $txtCategory . '",1,@slno :=@slno + 1,'.$radStatus.'),';
        }
        $query2 = (implode(",", $_POST['txtCategory']));
        
         if($errCategory>0){
             
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed"; 
         }
        //  print_r($query2);
        $query = substr($query, 0, -1);
        $dupResult = $this->manageDircategory('CD', $catId, '', 0, $query2, $userId,$radStatus);
        
        if ($dupResult) {
                $numRows = $dupResult->fetch_array();
                $flagval = $numRows['@FLAG'];
            //   print_r($flagval);
                 if ($flagval > 0) {
                    $outMsg = 'Category with this name already exists';
                    $errFlag = 1;
                } else {
                    $result = $this->manageDircategory('A', $catId, '', 0, $query, $userId,$radStatus);
                     if ($result) {
                      if ($id == 0)
                        $outMsg = 'Category added successfully ';
                   
                    }
                }
            }
         }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                
         }
        $arrResult = array('msg' => $outMsg);
        return $arrResult;
    }

    // Function To Delete directory category By::Chinmayee  :: On:: 03-06-2016 
    public function deleteDircategory($action, $ID) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $intID = explode(',', $ID);
        $success = 0;
        $fail = '';
        for ($i = 0; $i < count($intID); $i++) {
            $indvidualID = $intID[$i];
            $result = $this->manageDircategory($action, $indvidualID, '', 0, '', 0,0);
            if ($action == 'D') {
                $row = $result->fetch_array();
                if ($row[0] == '0') {
                    $success++;
                } else {
                    $fail .= $row[0] . ',';
                }
            }
        }

        $fail = substr($fail, 0, -1);
        
        if ($result) {
            if ($action == 'D') {
                if ($fail != '') {
                   
                     $outMsg  = $fail . " Category name can not be deleted.Dependency record exist ";
                }
                if ($success > 0) {
                    $outMsg = $success . ' record(s) Deleted Successfully.';
                }
             
            }
            elseif ($action == 'P') {
             $outMsg = 'Category Published Sucessfully';
        } elseif ($action == 'IN') {
             $outMsg = 'Category Unpublished Sucessfully';
        }
        }

        return $outMsg;
         }    else {
         return        $outMsg = 'Transaction fail due to session mismatch.';
                
         }
         }
		 
 }
 
 /* * ****Class to manage Important Services ********************
' By                     : Ashis Kumar Patra'
 'On                     : 05-Oct-2016       '
' Procedure Used        : USP_IMP_SERVICES     '
* ************************************************** */

class clsImpServices extends Model {

    // Function To Manage Important Services  By::Ashis kumar Patra  :: On:: 05-Oct-2016 
    public function manageImpServices($action,$ntfId,$catId,$intLnkType,$intTemp,$intWinSts,$intPlugin,$headlineE,$headlineO,$url,$detailE,$detailO,$doc,$createdBy,$pubStatus,$archiveStatus,$strimg='') {
        $ntfId            = htmlspecialchars(addslashes($ntfId),ENT_QUOTES);
        $headlineE          = htmlspecialchars(addslashes($headlineE),ENT_QUOTES); 
        $detailE      =      htmlspecialchars(addslashes($detailE),ENT_QUOTES); 
        $detailO      =      htmlspecialchars(addslashes($detailO),ENT_QUOTES);
        $Sql                = "CALL USP_IMP_SERVICES('$action',$ntfId,'$catId',$intLnkType,$intTemp,$intWinSts,'$intPlugin','$headlineE','$headlineO','$url','$detailE','$detailO','$doc',$createdBy,$pubStatus,$archiveStatus,'$strimg',@OUT);";
        /* if($action='PG'){
            echo $Sql;exit;
        }  */ 
        $errAction        = Model::isSpclChar($action);
        $errHeadlineE       = Model::isSpclChar($headlineE);
           
        if ($errAction > 0 || $errHeadlineE  > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($Sql); 
            return $sqlResult;
            
        }
    }

    // Function To add,Update Important Services  By::Ashis kumar Patra  :: On:: 05-Oct-2016 
    public function addUpdateImpServices($ntfId) { 
        $allow_doc_files    = array('pdf','xls');
        $allow_img_files=array('jpeg','jpg','gif','png');
        $clear = array('object', 'iframe', 'form', 'frame', 'script', 'select', 'input', 'select', 'option');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId ==  $hdnPrevSessionId) {
        $userId         = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $ntfId          = (isset($ntfId))?$ntfId:0;
        //$numPluginId    = $_POST['selType'];
        $selCategory    = 0;
        $errselCategory     = Model::isSpclChar($_POST['catType']);
        $txtHeadlineE    = htmlspecialchars($_POST['txtHeadE'], ENT_QUOTES);
        $blankHeadlineE   = Model::isBlank($txtHeadlineE);
        $errHeadlineE     = Model::isSpclChar($_POST['$txtHeadE']);
        $txtHeadlineO   = '';
        
        
        $fileDocument   = $_FILES['fileUploadDocument']['name'];
        $prevDocument   = $_POST['hdnUploadDocument'];
        $extension      = pathinfo($fileDocument, PATHINFO_EXTENSION);
        $txtFileSize    = $_FILES['fileUploadDocument']['size'];
        $txtTempName    = $_FILES['fileUploadDocument']['tmp_name'];
        $formattedFileName = ($fileDocument != '') ? 'Services_' . time() . '.' . $extension: '';
        if($_FILES['fileUploadDocument']['name']!='')
            $errFile  = Model::isValidFile($fileDocument,$allow_doc_files);
           else
             $errFile  = Model::isValidFile($prevDocument,$allow_doc_files); 
        $radPubSts     = ($_POST['radPubStatus']!='')?$_POST['radPubStatus']:2;
        $rbtLinkType           = ($_POST['rbtLnkType']!='')?$_POST['rbtLnkType']:1;

        //======image option on page start=====
        $featuredPageimage  = $_FILES['fileDocumentImage']['name'];
        $fileTemp             = $_FILES['fileDocumentImage']['tmp_name'];
        $prevFile = $_POST['hdnImageFile'];
        $extension_img      = pathinfo($featuredPageimage, PATHINFO_EXTENSION);
        $fetImgFileSize    = $_FILES['fileDocumentImage']['size'];
        $formattedfeaturedimage = ($featuredPageimage != '') ? 'Services_' . time() . '.' . $extension_img: '';
        if($featuredPageimage!='')
            $errImageFile  = Model::isValidFile($featuredPageimage,$allow_img_files);
        else
            $errImageFile  = Model::isValidFile($prevFile,$allow_img_files);
        
        if ($featuredPageimage == '' && $ntfId != 0)
            $formattedfeaturedimage = $prevFile;
        //=====================================
         
        if ($rbtLinkType == 2) {
            $txtURL = $_POST['txtURL'];
            $errURL = Model::isValidURL($txtURL);
            //echo $txtURL;exit;
            $errPageFlag    = 0;
            $errPageFlagH   =0;
            $txtContentE = '';
            $txtContentH = '';
        } else
            $txtURL = '';
            $radTemplateType = $_POST['radTemplateType'];
        if ($radTemplateType == 1) {
            $txtDetailsE = Model::strip_editor_tag_content($_POST['txtDetailsE'], $clear);
            $txtDetailsE   = (isset($_POST['txtDetailsE']))?htmlspecialchars($txtDetailsE, ENT_QUOTES):'';
            $errDetailsE    = Model::isSpclChar($_POST['$txtDetailsE']);
            $txtDetailsO = Model::strip_editor_tag_content($_POST['txtDetailsO'], $clear);
            $txtDetailsO   = (isset($_POST['txtDetailsO']))?htmlspecialchars($txtDetailsO, ENT_QUOTES):'';
            $errDetailsO    = Model::isSpclChar($_POST['$txtDetailsO']);
            $selPlid  = 0;  $selFunctionid  = 0;
        } else if ($radTemplateType == 2) {
            $txtDetailsE    = '';
            $txtDetailsO = '';
           // $selPluginName  = $_POST['selPluginName'];
            $selPlid  = 0; 
            $selFunctionid  = 0;
            if ($fileDocument == '' && $ntfId != 0)
            $formattedFileName = $prevDocument;
               
        } else if ($radTemplateType == 3) {
            $txtDetailsE    = '';
            $txtDetailsO   = '';
            $selPlugin = $_POST['selPluginName'];
            $selPluginNameArr=  explode("_", $selPlugin);
            $selPlid  = $selPluginNameArr[0];
            $selFunctionid  = $selPluginNameArr[1];
        }
        $radWinStatus       = ($_POST['radWinStatus']!='')?$_POST['radWinStatus']:1;
        $outMsg = '';
        $flag   = ($ntfId != 0) ? 1 : 0;
        $action = ($ntfId == 0) ? 'A' : 'U';
        $errFlag            = 0 ;
      
        if($blankHeadlineE >0) //
        {
            $errFlag		= 1;
            $flag                   = 1;
            $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($errHeadlineE>0 )
        {
            $errFlag		= 1;
            $flag                   = 1;
            $outMsg			= "Special Characters are not allowed";
        }
        if($rbtLinkType == 2){
            
            if(($errURL>0))
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Please enter a valid URL";
            }
            
        }
        if($errImageFile==0 || ($errImageFile%2)==0)
        {
            $errFlag                = 1;
            $flag                   = 1;
            $outMsg                 = "Invalid File types.Upload only jpeg,jpg,gif,png";
        }
        else if ($fetImgFileSize > size10MB) {
            $errFlag                     = 1;
            $flag                        = 1;
            $outMsg                      = 'File size can not more than 10 MB';
        }   
        if ($radTemplateType == 2) {
            
     
            if($errFile==0 || ($errFile%2)==0)
            {
                $errFlag                = 1;
                $flag                   = 1;
                $outMsg                 = "Invalid File types.Upload only pdf,xls.";
            }
            else if ($txtFileSize > size10MB) {
                $errFlag                     = 1;
                $flag                        = 1;
                $outMsg                      = 'File size can not more than 10 MB';
            }
        }
        $dupResult = $this->manageImpServices('CD',$ntfId,$selCategory,0,0,0,0,$txtHeadlineE,'','','','','',$userId,0,0);
   
        if($errFlag==0){
            if ($dupResult) {
                $numRows = $dupResult->fetch_array();
                if ($numRows > 0) {
                    $outMsg = 'Data already exists';
                    $errFlag = 1;
                    $flag   = 1;
                } else {
                    
                    $result = $this->manageImpServices($action,$ntfId,$selCategory,$rbtLinkType,$radTemplateType,$radWinStatus,$selFunctionid,$txtHeadlineE,$txtHeadlineO, $txtURL,$formattedFileName,$txtDetailsE,$txtDetailsO,$userId,$radPubSts,0,$formattedfeaturedimage);                                                                                  
                    //exit;
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Important Services added successfully ' : 'Important Services updated successfully';
                   
                    if ($_FILES['fileUploadDocument']['name'] != '') {
                        if (file_exists("uploadDocuments/ImpServices/".$prevDocument) && $prevDocument != '')
                            unlink("uploadDocuments/ImpServices/"  . $prevDocument);
                            move_uploaded_file($txtTempName, "uploadDocuments/ImpServices/" . $formattedFileName);
                        
                    }
                    if ($_FILES['fileDocumentImage']['name'] != '') {
                        if (file_exists("uploadDocuments/ImpServices/".$prevFile) && $prevFile != '')
                            unlink("uploadDocuments/ImpServices/"  . $prevFile);

                            move_uploaded_file($fileTemp, "uploadDocuments/ImpServices/" . $formattedfeaturedimage);
                        
                    }
            
                }
            }
        }  
        
       }  else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
        
        $txtURL    = ($errFlag == 1) ? $txtURL : ''; 
        $selCategory    = ($errFlag == 1) ? $selCategory : ''; 
        $txtHeadlineE    = ($errFlag == 1) ? $txtHeadlineE : ''; 
        $txtHeadlineO    = ($errFlag == 1) ? $txtHeadlineO : ''; 
        $txtDetailsE    = ($errFlag == 1) ? $txtDetailsE : ''; 
        $txtDetailsO    = ($errFlag == 1) ? $txtDetailsO : ''; 
        $fileDocument   = ($errFlag == 1) ? $fileDocument : '';
        $radPubSts     = ($errFlag == 1) ? $radPubSts :'1';
        $radTemplateType = ($errFlag == 1) ? $radTemplateType :'1';
        $rbtLnkType      = ($errFlag == 1) ? $rbtLinkType :'1';
        
        $arrResult = array('intCategory' => $selCategory,'intLinkType'=>$rbtLnkType,'intTemplateType'=>$radTemplateType,'intWinStatus'=>$radWinStatus,'intPluginId'=>$selPlid,'strHeadlineE' => $txtHeadlineE,'strHeadlineO' => $txtHeadlineO,'strUrl'=>$txtURL,'strDetailsE' => $txtDetailsE,'strDetailsO' => $txtDetailsO,'strFileDoc'=>$fileDocument,'msg' => $outMsg, 'flag' => $flag,'radPubSts' => $radPubSts);
        //print_r($arrResult);exit(1);
        return $arrResult;
       
    }

// Function To read Important Services  By::Ashis Kumar Patra  :: On:: 06-Oct-2016
    public function readImpServices($id) {

        $result = $this->manageImpServices('R',$id,0,0,0,0,0,'','','','','','',0,0,0);
        if ($result->num_rows > 0) {
            $row                  = $result-> fetch_array();
	        $intCategory          =  0;
            $radLinkType          =  htmlspecialchars_decode($row['intLinkType'],ENT_QUOTES);
            $radTemplateType          =  htmlspecialchars_decode($row['intTemplateType'],ENT_QUOTES);
            $radWinStatus          =  htmlspecialchars_decode($row['intWindowStatus'],ENT_QUOTES);
            $intPlugId          =  htmlspecialchars_decode($row['intPluginId'],ENT_QUOTES);
            $strHeadlineE         =  htmlspecialchars_decode($row['vchServiceNameE'],ENT_QUOTES);
            $strHeadlineO         =  htmlspecialchars_decode($row['vchServiceNameO'],ENT_QUOTES);
            $strUrl               =  htmlspecialchars_decode($row['vchUrl'],ENT_QUOTES);
            $strDetailsE          =  htmlspecialchars_decode($row['vchDetailE'],ENT_QUOTES);
            $strDetailsO          =  htmlspecialchars_decode($row['vchDetailO'],ENT_QUOTES);
            $strdoc               =  $row['vchDocument'];
            $strImage               =  $row['vchimage'];
			
            $intPublish            = $row['intPublishStatus'];  
            $intblink             = $row['intBlinkStatus'];
            $intArc             = $row['intArcStatus'];
			
        }
        $arrResult = array('intCategory' => $intCategory,'intLinkType'=>$radLinkType,'intTemplateType'=>$radTemplateType,'intWinStatus'=>$radWinStatus,'intPluginId'=>$intPlugId,'strHeadlineE' => $strHeadlineE,'strHeadlineO' =>  $strHeadlineO,'strUrl'=>$strUrl,'strFileDoc'=>$strdoc,'strDetailsE' =>  $strDetailsE,'strDetailsO' =>  $strDetailsO,'strFileDoc'=>$strdoc,'radPubSts' => $intPublish,'intArc'=>$intArc,'strImage'=>$strImage);
       
        return $arrResult;
    }
	

// Function To delete Important Services  By::Ashis Kumar Patra  :: On:: 06-Oct-2016
    public function deleteImpServices($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId         = $_POST['hdnPrevSessionId'];
        if ($newSessionId ==  $hdnPrevSessionId) {
            $ctr = 0;
            $msg=0;
            $userId = $_SESSION['adminConsole_userID'];
            $explIds = explode(',', $ids);
            $delRec = 0;
            foreach ($explIds as $indIds) {
                
                $result = $this->manageImpServices($action,$explIds[$ctr],0,0,0,0,0,'','','','','','',$userId,0,0);
                $row = $result->fetch_array();
                if ($row[0] == 0)
                    $delRec++;
                $ctr++;
            
            }

            if ($action == 'D') {
                $outMsg = 'Services deleted successfully';
            }
            else if ($action == 'AC')
                $outMsg = 'Services activated successfully';
            else if ($action == 'IN')
                $outMsg = 'Services unpublished successfully';
            else if ($action == 'AR')
                $outMsg = 'Services archieved successfully';
            else if($action == 'P')
                $outMsg = 'Services Published successfully';
    

            return $outMsg;
        }else {
            return   $outMsg = 'Transaction fail due to session mismatch.';
        }
    }

}
/* * ****Class to manage Service Category********************
' By                     : Ashis Kumar Patra'
 'On                     : 17-Oct-2016       '
' Procedure Used        : USP_SERVICE_MASTER     '
* ************************************************** */
class clsService extends Model {
    
  // Function To Manage  Services Category  By::Ashis kumar Patra  :: On:: 17-Oct-2016 
    public function manageServices($action,$sId,$sname) {
 
        $serviceNameE          = htmlspecialchars(addslashes($headlineE),ENT_QUOTES); 
        $detailE      =      htmlspecialchars(addslashes($detailE),ENT_QUOTES); 
        $Sql                = "CALL USP_SERVICE_MASTER('$action','$sId','$serviceNameE', @OUT)";
    // echo $Sql;
        $errAction        = Model::isSpclChar($action);
        $errHeadlineE       = Model::isSpclChar($serviceNameE);
           
        if ($errAction > 0 || $errHeadlineE  > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($Sql); 
            return $sqlResult;
            
        }
    }
     
}
/* * ****Class to Fetch Circular Master********************
' By                     : Ashis Kumar Patra'
 'On                     : 17-Oct-2016       '
' Procedure Used        : USP_CIRCULAR_MASTER     '
* ************************************************** */
class clsCircular extends Model {
    
  // Function To Manage Circular Category Lists  By::Ashis kumar Patra  :: On:: 05-Oct-2016 
    public function manageCircular($action,$mId,$cId,$cname) {
 
        $serviceNameE          = htmlspecialchars(addslashes($headlineE),ENT_QUOTES); 
        $detailE               =      htmlspecialchars(addslashes($detailE),ENT_QUOTES); 
        $Sql                   = "CALL USP_CIRCULAR_MASTER('$action','$mId','$cId','$cname', @OUT)";
     //echo $Sql;
        $errAction        = Model::isSpclChar($action);
        $errHeadlineE       = Model::isSpclChar($serviceNameE);
           
        if ($errAction > 0 || $errHeadlineE  > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($Sql); 
            return $sqlResult;
            
        }
    }
     
}

/* * ****Class to Count Viewers********************
' By                     : Ashis Kumar Patra'
 'On                     : 21-Oct-2016       '
' Procedure Used         : USP_HIT_COUNTER    '
* ************************************************** */
class clsHitCount extends Model {
    
  
    //======== Function for visitors counter === By Sunil Kumar Parida On 13-Aug-2015
	public function hitCounter()
	{
		$curDate	= date("Y-m-d");
		$ipAddr		= $_SERVER['REMOTE_ADDR'];
		$hitSql	= "CALL USP_HIT_COUNTER('A','$curDate','$ipAddr')";
                //echo $hitSql;
		$result	= Model::executeQry($hitSql);
		 if ($result->num_rows > 0) 
		 {
			$row	= $result->fetch_array();
			return $row[0];
		 }
	}
}
   /* * ****Class to Update data from web service********************
  'By                     : Ashis Kumar Patra'
  'On                     : 31-Oct-2016       '
  'Procedure Used        : USP_VEHICLE_COUNT    '
  * ************************************************** */
 class clsCronJob extends Model {
     
    
     /*function to update vehicle info from webservice */
        public function updateVehicleInfo() {
          
                $url= 'http://as2.ori.nic.in:8080/web/TransDBTot';
                  try { 
                      $datef  = date("d/m/Y");
                      $myGetData = "?regndate=".$datef;
                      //echo $myGetData;
                     $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml','proxy' => 'tcp://10.150.9.191:8080', 'request_fulluri' => true)));
                        $xml = file_get_contents($url.$myGetData, false, $context);
                       if ($xml===FALSE) {

                            throw new Exception('XML File Not Found'); 
  
                          }else{
                              $xml = simplexml_load_string($xml);
                              $regvehicle = $xml->TotalRegCount;
                              $permitvehicle = $xml->TotalPermitCount;
                              $fitvehicle = $xml->TotalFitnessCount;
                              $chalanvehicle = $xml->TotalChallanCount;
                             if($regvehicle!=0 && $permitvehicle!=0 && $fitvehicle!=0 &&  $chalanvehicle!=0)
                              {
                              $sql      = "CALL USP_VEHICLE_COUNT('UV',0,$regvehicle,$permitvehicle,$fitvehicle,$chalanvehicle,'0000-00-00',0,0,@OUT)";
                              
                              $result   =  Model::executeQry($sql);
                            }
                          }
                   } catch(Exception $e) {
                       $msg = $e->getMessage();
                       return $msg;
                   }
    
          }
    }
     /* * ****Class to manage AUCTION NOTICE ********************
' By                     : Shweta choudhury'
' Procedure Used        : USP_AUCTION_NOTICE     '
* ************************************************** */
   class clsAuctionNotice extends Model {
       
     // Function To Manage Auction notice 
    public function manageAuctionNotice($action,$ntfId,$linkType,$sectionid,$intTemptype,$intWinstatus,$intContenttype,$intPluginId,$strUrl,$caption,$txtHeadlineO,$txtDetaile,$txtDetailo,$txtCode,$doc,$date,$closedate,$pubStatus,$archiveStatus,$createdBy,$blinksts,$intSlno) {
        $ntfId            = htmlspecialchars(addslashes($ntfId),ENT_QUOTES);
        $caption          = htmlspecialchars(addslashes($caption),ENT_QUOTES);    
        $Sql              = "CALL USP_AUCTION_NOTICE('$action',$ntfId,$linkType,$sectionid,$intTemptype,$intWinstatus,$intContenttype,$intPluginId,'$strUrl','$caption','$txtHeadlineO','$txtDetaile','$txtDetailo','$txtCode','$doc','$date','$closedate','$pubStatus','$createdBy','$archiveStatus','$blinksts','$intSlno',@OUT);";
        //echo $Sql;
        $errAction        = Model::isSpclChar($action);
       //$errCaption       = Model::isSpclChar($caption);
           
        if ($errAction > 0)
            header("Location:" . APP_URL . "error");
        else {
            $sqlResult = Model::executeQry($Sql); 
            return $sqlResult;
            
        }
    }
    
    // Function To Add Upadate Auction notice 
    public function addUpdateAuctionNotice($ntfId) 
    {
        $allow_doc_files    = array('pdf','xls','xlsx','PDF','XLS','XLSX');
        $clear = array('object', 'iframe', 'form', 'frame', 'script', 'select', 'input', 'select', 'option');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        if ($newSessionId == $hdnPrevSessionId) {
        $userId                 = (isset($_SESSION['adminConsole_userID']))?$_SESSION['adminConsole_userID']:0;
        $ntfId                  = (isset($ntfId))?$ntfId:0;
     
            $intRTOId               =$_POST['RTOType'];
            $rbtLnkType             = htmlspecialchars($_POST['radStatus'], ENT_QUOTES);
        $errbtlinkType            = Model::isSpclChar($_POST['radStatus']);
            $txtHeadline            = htmlspecialchars($_POST['txtCategory'], ENT_QUOTES);
            $txtHeadlineO           = htmlspecialchars($_POST['txtCategoryO'], ENT_QUOTES);
            $txtCode                = htmlspecialchars($_POST['txtrandNum'], ENT_QUOTES);
            $blankCaption           = Model::isBlank($txtHeadline);
            $errCaption             = Model::isSpclChar($_POST['txtCategory']);
            $errCode                = Model::isSpclChar($_POST['txtrandNum']);
            $hdnTotalDoc            = $_POST['hdnTotalDoc'];
            $txtdate                = htmlspecialchars($_POST['txtClosingDate'],ENT_QUOTES);
            $txtstartdate           = htmlspecialchars($_POST['txtStartDate'],ENT_QUOTES);
            $errdate                = Model::isSpclChar($_POST['txtClosingDate']);
            
            if($txtdate!='' && $txtdate!='0000-00-00 00:00:00'){
                $DateTime               =  Model::dbDateFormat($txtdate);
            }else{
                $DateTime               =  '0000-00-00 00:00:00';
            }
            
            $startDateTime          =  ($txtstartdate!='' && $txtstartdate!='0000-00-00 00:00:00')?Model::dbDateFormat($txtstartdate):'0000-00-00';
            $errstdate              = Model::isSpclChar($_POST['txtStartDate']);
            /*$rbtContentType           = ($_POST['rbtLnkType']!='')?$_POST['rbtLnkType']:1;
            if ($rbtContentType == 2) 
            {
                $txtURL = htmlspecialchars(addslashes($_POST['txtURL']), ENT_QUOTES);
                //echo $txtURL;exit;
                $errPageFlag    = 0;
                $errPageFlagH   =0;
                $txtContentE = '';
                $txtContentH = '';
            } 
            else
                $txtURL = '';*/
                $radTemplateType = htmlspecialchars($_POST['radTemplateType'],ENT_QUOTES);
                 $errFile   = 1;
            if ($radTemplateType == 1) 
            {
           
                $selplginid             =0;
                $txtDetailsE = Model::strip_editor_tag_content($_POST['txtDetailsE'], $clear);
                $txtDetailsE   = (isset($_POST['txtDetailsE']))?htmlspecialchars($txtDetailsE, ENT_QUOTES):'';
                $errDetailsE    = Model::isSpclChar($_POST['$txtDetailsE']);
                $txtDetailsO = Model::strip_editor_tag_content($_POST['txtDetailsO'], $clear);
                $txtDetailsO   = (isset($_POST['txtDetailsO']))?htmlspecialchars( $txtDetailsO, ENT_QUOTES):'';
                $errDetailsO    = Model::isSpclChar($_POST['$txtDetailsO']);
            } 
            else if ($radTemplateType == 2) {
            $txtDetailsE = '';
            $txtDetailsO = '';
            $selplginid  = 0;
            $query1		 = '';
                    $hdnTotalDocument = count($_FILES['fileDocument']['name']);
                    
                    for($i=0;$i<$hdnTotalDocument;$i++)
                    {  
                        $fileMaterial		= $_FILES['fileDocument']['name'][$i];
                        $extension      = pathinfo($fileMaterial, PATHINFO_EXTENSION);
                        
                                $formattedFileName = ($fileMaterial != '') ? 'document_'.$i.'_' . time() . '.' . $extension: '';
                                $ptevFileMaterial   = $_POST['hdnDocFile'][$i];
                                $txtTempName    = $_FILES['fileDocument']['tmp_name'][$i];
                                if($_FILES['fileDocument']['name'][$i]!='')
                                    $errFile  = Model::isValidFile($_FILES['fileDocument']['name'][$i],$allow_doc_files);
                                   //else
                                    // $errFile  = Model::isValidFile($ptevFileMaterial ,$allow_doc_files); 
                                if($fileMaterial!='')
                                {
                                    if (file_exists($uploadPath . $fileMaterial) && $ptevFileMaterial != '')
                                        unlink($uploadPath . $ptevFileMaterial);
                                        move_uploaded_file($txtTempName, "uploadDocuments/AuctionNotice/" . $formattedFileName);

                                }else{
                                    $formattedFileName = $ptevFileMaterial;
                                }

                                 $query1	.='"'.$formattedFileName.'",';
                         
                    }
                    $query1	= substr($query1,0,-1);
                    
        } else if ($radTemplateType == 3) {
            $txtDetailsE    = '';
            $txtDetailsO   = '';
           $selPlugin = $_POST['selPluginName'];
           $selPluginNameArr=  explode("_", $selPlugin);
           $selplginid   = $selPluginNameArr[1];
           //$selFunctionid  = $selPluginNameArr[1];
        }
        //$radWinStatus       = ($_POST['radWinStatus']!='')?$_POST['radWinStatus']:1;
        $chkblink               = $_POST['chkbox'];
        $uploadPath             = "uploadDocuments/AuctionNotice/";
       
        $selplginid              = ($selplginid!='')?$selplginid:0;
        $radTemplateType         = ($radTemplateType!='')?$radTemplateType:0;
        
        if(isset($_POST['chkbox'])){
           $blanksts =1;
        } 
        else {
           $blanksts =0;
        }
       
        $outMsg     = '';
        $flag       = ($ntfId != 0) ? 1 : 0;
       
        $action     = ($ntfId == 0) ? 'A' : 'U';
        $errFlag    = 0 ;
        if($action=='A')
        $intSlNo            = (Model::getMaxVal('INT_SLNO','t_auction_notice','BIT_DELETED_FLAG')=='')?1:Model::getMaxVal('INT_SLNO','t_auction_notice','BIT_DELETED_FLAG');
        else 
          
           $intSlNo        = $_POST['hdnSlNo'];
           $errFlag            = 0 ;
          
        if(($blankCaption >0) ) 
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if(($errCode >0) ||($errdate>0) ||($errstdate>0) || ($errDetailsE >0) || ($errDetailsO >0) || ($errSecId>0) || ($errlinkType>0) || ($errbtlinkType>0))
        {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
        }
      if ($radTemplateType == 2 ) {
                if($errFile==0 || ($errFile%2)==0)
                {
                        $errFlag                = 1;
                        $flag                   = 1;
                        $outMsg                 = "Invalid File types.Upload only pdf,xls.";
                }
        }
        
        if($errFlag==0){
            $dupResult = $this->manageAuctionNotice('CD',$ntfId,0,0,0,0,0,0,'',$txtHeadline,'','','','','','0000-00-00','0000-00-00',0,0,$userId,0,0,0);
       
             if ($dupResult) {
                $numRows = $dupResult->fetch_array();
                if ($numRows > 0) {
                    $outMsg = 'Notification already exists';
                    $errFlag = 1;
                    $flag   = 1;
                } else {
                   $result = $this->manageAuctionNotice($action,$ntfId,0,$intRTOId,$radTemplateType,0,0,$selplginid,'',$txtHeadline,$txtHeadlineO,$txtDetailsE,$txtDetailsO,$txtCode,$query1,$startDateTime,$DateTime,$rbtLnkType,2,$userId,$blanksts,$intSlNo);
                  
                    if ($result)
                       
                        $outMsg = ($action == 'A') ? 'Data added successfully ' : 'Data updated successfully';
                   
            
                }
            }
        }
       }    else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $numPluginId       = ($errFlag == 1) ? $numPluginId : '0';              
        $strFileName       = ($errFlag == 1) ? $fileDocument : '';
        $txtHeadline       = ($errFlag == 1) ? $txtHeadline : '';
        $txtHeadlineO       = ($errFlag == 1) ? $txtHeadlineO : '';
        $txtCode           = ($errFlag == 1) ? $txtCode : '';
        $DateTime          = ($errFlag == 1) ? $DateTime : '';
        $startDateTime     = ($errFlag == 1) ? $startDateTime : '';
        $rbtLnkType        = ($errFlag == 1) ? $rbtLnkType : '1';
        $linkType          = ($errFlag == 1) ? $linkType : '0'; 
       $rbtContentType     = ($errFlag == 1) ? $rbtContentType:'1';
       $txtURL             = ($errFlag == 1) ? $txtURL:'http://';
       $radTemplateType    = ($errFlag == 1) ? $radTemplateType:'1'; 
       $selplginid         = ($errFlag == 1) ? $selplginid:'0';
       $radWinStatus       = ($errFlag == 1) ? $radWinStatus:'1';
        $txtDetailsE       = ($errFlag == 1) ? $txtDetailsE:'';
        $txtDetailsO      = ($errFlag == 1) ? $txtDetailsO:'';
        $arrResult = array('intCategory' => $numPluginId,'strblink'=>$blanksts,'strCaptionO'=>$txtHeadlineO,'intUrlType'=>$rbtContentType,'strUrl'=>$txtURL,'intTemplateTYpe'=>$radTemplateType,'intPluginId'=>$selplginid,'intWinStatus'=>$radWinStatus,'txtCode' => $txtCode,'strFileName' => $strFileName,'txtHeadline' => $txtHeadline,'strDetailE'=>$txtDetailsE,'strDetailO'=>$txtDetailsO,'msg' => $outMsg, 'flag' => $errFlag,'startDateTime' => $startDateTime,  'DateTime' => $DateTime, 'rbtLnkType' => $rbtLnkType,'linkType' => $linkType);
        return $arrResult;
    }
     // Function To Read Auction notice 
    public function readAuctionNotice($id) {

        $result = $this->manageAuctionNotice('R',$id,0,0,0,0,0,0,'','','','','','','','0000-00-00','0000-00-00',0,0,0,0,0); 
        if ($result->num_rows > 0) {
            $row                  = $result-> fetch_array();
           
            $strCaption           =  htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_QUOTES);
            $strdoc               =  $row['VCH_DOCUMENT'];
            $intType              = $row['INT_PLUGIN_TYPE'];
            $intContentType       = $row['INT_URL_TYPE'];
            $strURL               = $row['VCH_URL'];
            $intSlNo                = $row['INT_SLNO'];
            $strDetailE           = $row['VCH_DETAILE'];
            $strDetailO           = $row['VCH_DETAILO'];
            $intTemplateType      = $row['INT_TEMPLATE_TYPE'];
            $intWinStatus         = $row['INT_WIN_STATUS'];
            $intPluginId          = $row['INT_PLUGIN_ID'];
            $strCaptionO          =  htmlspecialchars_decode($row['VCH_HEADLINE_O'],ENT_QUOTES);
            $strdate              = date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_NOTIFICATION_DATE'],ENT_NOQUOTES)));
            $stractive            = $row['INT_PUBLISH_STATUS'];  
            $strblink             = $row['INT_BLINK_STATUS'];
            $strCode          =  htmlspecialchars_decode($row['VCH_CODE'],ENT_QUOTES);
            $strlinkType             = $row['INT_PLUGIN_TYPE'];
            $strstartdate              = date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_NOTICE_START'],ENT_NOQUOTES)));

        }

        $arrResult = array('strCode'=>$strCode,'strlinkType'=>$strlinkType,'intUrlType'=> $intContentType,'strUrl'=>$strURL,'intTemplateTYpe'=>$intTemplateType,'intPluginId'=>$intPluginId,'intWinStatus'=>$intWinStatus,'strstartdate'=>$strstartdate,'strblink'=>$strblink,'strCaptionO'=>$strCaptionO,'strCaption'=>$strCaption,'strDetailE'=>$strDetailE,'strDetailO'=>$strDetailO,'strdoc'=>$strdoc,'intType'=>$intType,'strdate'=>$strdate,'stractive'=>$stractive ,'intSlNo'=>$intSlNo);
        return $arrResult;
    }
     // Function To Delete Auction notice 
       public function deleteAuctionNotice($action, $ids) {
         //echo $ids;
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {      
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        //print_r($explIds);
        $delRec = 0;
        
        foreach ($explIds as $indIds) {
              if($action=='US')
            $slNumber	= $_POST['txtSLNo'.$explIds[$ctr]];
            else
            $slNumber   =0;
            $result = $this->manageAuctionNotice($action,$explIds[$ctr],0,0,0,0,0,0,'','','','','','','','0000-00-00','0000-00-00',0,0,$userId,0,$slNumber);                              
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
          
        }

        if ($action == 'D') 
                $outMsg .= 'Data Detail(s) deleted successfully';
     
        else if ($action == 'AC')
            $outMsg = 'Data(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Data(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Data(s) archieved successfully';
        else if($action == 'P')
            $outMsg = 'Data(s) Published successfully';
        else if ($action == 'US')
                 $outMsg = 'Serial number updated successfully';
        return $outMsg;
        }
        else {
        return   $outMsg = 'Transaction fail due to session mismatch.';
        }
    }

   } 
   
   
class clsQuery extends Model {

// Function To Manage News By::T Ketaki Debadarshini   :: On:: 25-May-2015
    public function manageQuery($query) {
        //echo $query;
        $query = $query;
        $result = Model::executeQryAnalyzer($query);
        return $result;
    }

}

  /* * ****Class to Impoortant Service category********************
  'By                     : Shweta Choudhury'
  'On                     : 2-Nov-2017       '
  'Procedure Used        : USP_IMPSERVICE_CATEGORY    '
  * ************************************************** */

class clsImportantServicesCategory extends Model {
    
    // Function To Manage important service  Category By::Shweta   :: On:: 2-nov-2017 
    public function manageImpServiceCategory($action, $catId,$intcatType,$plugintype, $category, $categoryO, $description,$descriptionO,$pubStatus ,$createdBy) {
        $catId         = htmlspecialchars(addslashes($catId),ENT_QUOTES);
        $intcatType    = htmlspecialchars(addslashes($intcatType),ENT_QUOTES);
        $plugintype    = htmlspecialchars(addslashes($plugintype),ENT_QUOTES);
        $category      = htmlspecialchars(addslashes($category),ENT_QUOTES);
        $categoryO     = htmlspecialchars(addslashes($categoryO),ENT_QUOTES);
        $description   = htmlspecialchars(addslashes($description),ENT_QUOTES);
        $descriptionO  = htmlspecialchars(addslashes($descriptionO),ENT_QUOTES);
        
        $categorySql = "CALL USP_IMPSERVICE_CATEGORY('$action', $catId,$intcatType,$plugintype,'$category','$categoryO', '$description','$descriptionO','$pubStatus', $createdBy,@OUT);";
        //echo $categorySql;
        $errAction        = Model::isSpclChar($action);
        $errCategory      = Model::isSpclChar($category);
        $errDescription   = Model::isSpclChar($description);
        
        if ($errAction > 0 || $errCategory > 0 || $errDescription > 0)
            header("Location:" . APP_URL . "error");
        else {
            $categoryResult = Model::executeQry($categorySql);
            return $categoryResult;
        }
    }
    // Function To Manage important service  Category By::Shweta   :: On:: 2-nov-2017 
    public function addUpdateImpServiceCategory($catId) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId                 = $_SESSION['adminConsole_userID']; 
        
        $selplugintype          = 1;
        $txtCategory            = htmlspecialchars(addslashes($_POST['txtCategory']), ENT_QUOTES);
        $txtCategoryO           = htmlspecialchars(addslashes($_POST['txtCategoryO']), ENT_QUOTES);
        $blankCategory          = Model::isBlank($txtCategory);
        $errCategory            = Model::isSpclChar($_POST['txtCategory']);
        $errplugintype          = Model::isSpclChar($selplugintype);
        //$errCattype             = Model::isSpclChar($selCattype);
        $lenCategory            = Model::chkLength('max', $txtCategory,100);
        $radStatus              = $_POST['radStatus'];
        $outMsg                 = '';
        $flag                   = ($catId != 0) ? 1 : 0;
        $action                 = ($catId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if(($blankCategory >0) ||  ($selplugintype==0))
        {
                $errFlag		= 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenCategory>0)
        {
                $errFlag		= 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if(($errCategory>0)|| ($errplugintype>0)|| ($errCattype>0))
        {
                $errFlag		= 1;
                $outMsg			= "Special Characters are not allowed";
        }
        
        $dupResult = $this->manageImpServiceCategory('CD', $catId,1,$selplugintype,$txtCategory,'','','',0,$userId);
         if($errFlag==0){
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Important Service Category with this name already exists';
                $errFlag = 1;
            } else {
                $result = $this->manageImpServiceCategory($action, $catId,1,$selplugintype,$txtCategory,$txtCategoryO,'','',$radStatus,$userId);
                if ($result)
                    $outMsg = ($action == 'A') ? 'Important Service Category added successfully ' : 'Important Service Category updated successfully';
               
                }
            }
         }
         }
         else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strCategory        = ($errFlag == 1) ? $txtCategory : '';
        $strCategoryO       = ($errFlag == 1) ? $txtCategoryO : '';
        $intStatus          = ($errFlag == 1) ? $radStatus : '2'; 
        $selplugintype      = ($errFlag == 1) ? $selplugintype : '0'; 
        
        $arrResult = array('msg' => $outMsg, 'flag' => $flag,'strCategoryO' => $strCategoryO, 'strCategory' => $strCategory, 'selplugintype' => $selplugintype, 'intStatus' => $intStatus);
        return $arrResult;
    }

    // Function To read Important Service Category  By::Shweta   :: On:: 2-Nov-2017 
    public function readImpServiceCategory($id) {

        $result = $this->manageImpServiceCategory('R', $id,0,0,'','','','',0 ,0);
        if ($result->num_rows > 0) {

            $row               = $result ->fetch_array();
            $strCategory       = htmlspecialchars_decode($row['vchService'],ENT_QUOTES);
            $strCategoryO      =  htmlspecialchars_decode($row['VCH_CATEGORY_NAME_O'],ENT_QUOTES);
            $intCattype        = $row['INT_TYPE'];
            $intStatus         = $row['INT_PUBLISH_STATUS']; 
            $selplugintype     = $row['INT_PLUGIN_TYPE'];
        }

        $arrResult = array('selplugintype' => $selplugintype, 'intCattype' => $intCattype,'strCategory' => $strCategory, 'strCategoryO' => $strCategoryO, 'intStatus'=>$intStatus);
        return $arrResult;
    }

    // Function To Delete Gallery Category  By::Shweta   :: On:: 3-Nov-2017 
    public function deleteImpService($action, $ids) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageImpServiceCategory($action,$explIds[$ctr],0,0,'','','','', 0 ,$userId); 
            $row = $result ->fetch_array();
           // print_r($row[0]);
            
            if ($row[0]=='0')
            {
               
                $delRec++;
             
            }
           
            $ctr++;
        }

        if ($action == 'D') {
            
            if ($delRec > 0)
                $outMsg .= 'Category(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist. Category can not be deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Category(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Category(s) unpublished successfully';
        
        return $outMsg;
    }


}

/* * ****Class to Tender  ********************
  '	By	 	 : Rajesh Kumar Sahoo	'
  '	On	 	 : 19-May-2021          '
  ' Procedure Used       : USP_TENDER_DETAILS            '
 * ************************************************** */

class clsTender extends Model {
    public function manageTender($action, $tenderId, $tenderNo, $headLine, $openingDate,$closingDate,$tenderFile,$tenderDesc, $pubStatus,$archiveStatus ,$createdBy,$slNo) {
        $tenderSql = "CALL USP_TENDER_DETAILS('$action', $tenderId, '$tenderNo', '$headLine', '$openingDate','$closingDate','$tenderFile','$tenderDesc',0, '$pubStatus','$archiveStatus',1, $createdBy,@OUT);";
        //echo $tenderSql;//exit;
       
        $errAction          = Model::isSpclChar($action);
        $errheadLine      = Model::isSpclChar($headLine);

        if ($errAction > 0 || $errheadLine > 0 ){
            echo '<script>window.location.href="' . APP_URL . 'error";</script>';
        }else {
            //if($action == 'IN' || $action == 'P'){ echo $tenderSql; exit; }
            $tenderResult = Model::executeQry($tenderSql);
            return $tenderResult;
        }
    }
    
    public function addUpdatteTender($tenderId) {
        $allow_doc_files    = array('pdf','doc','docx');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        
        if ($newSessionId == $hdnPrevSessionId) {
            
            $userId                 = $_SESSION['adminConsole_userID'];
            $txtHeadline           = htmlspecialchars(addslashes($_POST['txtHeadline']),ENT_QUOTES);
            $txtTenderNo           = htmlspecialchars(addslashes($_POST['txtTenderNo']),ENT_QUOTES);
            $txtDescription =  htmlspecialchars($_POST['txtDetails'], ENT_QUOTES);
            $blankHeadlineE         = Model::isBlank($txtHeadline);
            $blankTenderNo         = Model::isBlank($txtTenderNo);
            $errHeadlineE        = Model::isSpclChar($txtHeadline);
            $txtTenderFile  = $_FILES['fileTender']['name'];
            $extension      = pathinfo($txtTenderFile, PATHINFO_EXTENSION);
            $prevfile = $_POST['hdnTenderFile'];
            $txtFileSize    = $_FILES['fileTender']['size'];
            $txtTempName    = $_FILES['fileTender']['tmp_name'];
            $formattedFileName = ($txtTenderFile != '') ? 'Tender_' . time() . '.' . $extension: '';

            $txtClosingdate                = htmlspecialchars($_POST['txtClosingDate'],ENT_QUOTES);
            $txtstartdate           = htmlspecialchars($_POST['txtOpeningDate'],ENT_QUOTES);
            $errClosingdate                = Model::isSpclChar($_POST['txtClosingDate']);
            $errstartdate              = Model::isSpclChar($_POST['txtOpeningDate']);
            if($txtClosingdate!='' && $txtClosingdate!='0000-00-00 00:00:00'){
                 $closingDateTime               =  date('Y-m-d H:i:s',strtotime($txtClosingdate));
            }else{
                $closingDateTime               =  '0000-00-00 00:00:00';
            }
            $startDateTime          =  ($txtstartdate!='' && $txtstartdate!='0000-00-00 00:00:00')?date('Y-m-d H:i:s',strtotime($txtstartdate)):'0000-00-00';

            
            $flag                           = ($tenderId != 0) ? 1 : 0;
            $action                         = ($tenderId == 0) ? 'A' : 'U';
            $errFlag                        = 0 ;

            if($_FILES['fileTender']['name']!='')
                $errFile  = Model::isValidFile($_FILES['fileTender']['name'],$allow_doc_files);
            else
                $errFile  = Model::isValidFile($prevfile,$allow_doc_files); 

            if($blankHeadlineE >0 || $blankTenderNo >0 || $errClosingdate>0 || $errstartdate>0)
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
            }
            else if(($errHeadlineE >0) )
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
            }else if($errFile==0 || ($errFile%2) ==0)
            {
                    $errFlag                = 1;
                    $flag                   = 1;
                    $outMsg                 = "Invalid File types.Upload only pdf,doc,docx.";
            }
            else if ($txtFileSize > size10MB) {
                $errFlag               = 1;
                $flag                  = 1;
                $outMsg = 'Image File size can not more than 10 MB';
            }
            
       
            if($errFlag==0){
                
                $dupResult = $this->manageTender('CD', $tenderId,$txtTenderNo,$txtHeadline ,$startDateTime,$closingDateTime,'', 0,0,0,$userId,0); 
                
                if ($dupResult) {
                    $numRows = $dupResult->fetch_array();
                    if ($numRows > 0) {
                        $outMsg = 'Tender wih this Tender Number already exists';
                        $errFlag = 1;
                    } else {
                        if($tenderId != 0 && $formattedFileName ==""){$formattedFileName=$prevfile;}
                        $result = $this->manageTender($action, $tenderId,$txtTenderNo,$txtHeadline ,$startDateTime ,$closingDateTime, $formattedFileName,$txtDescription,0,0 ,$userId,'');
                        if ($result)
                            $outMsg = ($action == 'A') ? 'Tender added successfully' : 'Tender updated successfully';
                        if ($_FILES['fileTender']['name'] != '') {
                            if (file_exists("uploadDocuments/Tender/" . $prevfile) && $prevfile != '') {
                                unlink("uploadDocuments/Tender/" . $prevfile);
                            }
                            move_uploaded_file($txtTempName, "uploadDocuments/Tender/" . $formattedFileName);
                        }
                    }
                }
            }
        }else {
            $outMsg = 'Transaction fail due to session mismatch.';
            $errFlag = 1; 
        }
        $strHeadLineE       = ($errFlag == 1) ? $txtHeadline : '';    
        $strURL             = ($errFlag == 1) ? $txtURL : '';
                
        $arrResult = array('msg' => $outMsg, 'flag' => $errFlag,'strHeadLineE' => $strHeadLineE,  'strURL' => $strURL);
        return $arrResult;
    }
     
    public function readTender($id) {

        $result = $this->manageTender('R', $id,'','','','', '','',0,0,0,'');
        
        if ($result->num_rows > 0) {

            $row                = $result ->fetch_array();
            $strTenderNo       = $row['VCH_REF_NO'];
            $strDescription        = $row['VCH_DESCRIPTION_E'];
            $strHeadLine       = htmlspecialchars_decode($row['VCH_HEAD_LINE_E'],ENT_QUOTES);
            $strOpeningDate  = date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_OPENING_DATETIME'],ENT_NOQUOTES)));
            $strClosingDate  = date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_CLOSING_DATETIME'],ENT_NOQUOTES)));
            $strTenderFile = $row['VCH_DOCUMENT_NAME'];
        }


        $arrResult = array( 'strTenderNo' => $strTenderNo, 'strHeadLine' => $strHeadLine,'strDescription' => $strDescription,'strTenderFile' => $strTenderFile, 'strOpeningDate' => $strOpeningDate, 'strClosingDate' => $strClosingDate);
        return $arrResult;
    }
    
    public function deleteTender($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        if ($newSessionId == $hdnPrevSessionId) {
            $ctr = 0;
            $userId = $_SESSION['adminConsole_userID'];
            $explIds = explode(',', $ids);
            $delRec = 0;
            foreach ($explIds as $indIds) {
                $result = $this->manageTender($action,$explIds[$ctr],'','', '','', '','',0,0 ,$userId,'');                   
                $row = $result ->fetch_array();
                if ($row[0] == 0){
                    $delRec++;
                }else{
                    $delRec = 0;
                }
                $ctr++;
            }
            // echo $delRec;exit;
            if ($action == 'D') {
                if ($delRec > 0)
                    $outMsg = 'Tender(s) deleted successfully';
                else
                    $outMsg = 'Dependency record exist Page(s) can not be  deleted';
            }
            else if ($action == 'AC'){
                if ($delRec > 0)
                    $outMsg = 'Tender(s) activated successfully';
                else
                    $outMsg = 'Change the date before activating';
            }
            else if ($action == 'IN')
                $outMsg = 'Tender(s) unpublished successfully';
            else if ($action == 'AR')
                $outMsg = 'Tender(s) archieved successfully';
            else if ($action == 'P')
                $outMsg = 'Tender(s) published successfully'; 
        }  
        else {
            $outMsg = 'Transaction fail due to session mismatch.';
                
        }
        return $outMsg;
    }
    
}

/* * ****Class to Former officers  ********************
  '	By	 	 : Rajesh Kumar Sahoo	'
  '	On	 	 : 20-May-2021          '
  ' Procedure Used       : USP_FORMER_OFFICERS            '
 * ************************************************** */

class clsOfficers extends Model {
    
    public function manageOfficer($action, $officerId, $officerType, $officerName, $joiningDate='',$retirementDate='',$officerFile,$pubStatus,$createdBy,$orderno=0) {
        
        $txtSql = "CALL USP_FORMER_OFFICERS('$action', $officerId, '$officerType', '$officerName', '$joiningDate','$retirementDate','$officerFile',$pubStatus, $createdBy,$orderno,@OUT);";
        $errAction          = Model::isSpclChar($action);

        if ($errAction > 0 ){
            echo '<script>window.location.href="' . APP_URL . 'error";</script>';
        }else {
            //if($action == 'A' || $action == 'V'){ echo $txtSql; exit; }
            $tenderResult = Model::executeQry($txtSql);
            return $tenderResult;
        }
    }
    
    public function addUpdateProfile($officerId) {
        $allow_img_files=array('jpeg','jpg','png');
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        
        if ($newSessionId == $hdnPrevSessionId) {
            $userId                 = $_SESSION['adminConsole_userID'];
            $selType           = htmlspecialchars(addslashes($_POST['selType']),ENT_QUOTES);
            $vchOfficerName           = htmlspecialchars(addslashes($_POST['vchOfficerName']),ENT_QUOTES);
            $intOrderno           = htmlspecialchars(addslashes($_POST['intOrderno']),ENT_QUOTES);
            $blankHeadlineE         = Model::isBlank($vchOfficerName);
            $blankselType        = Model::isBlank($selType);
            $blankOrderNo        = Model::isBlank($intOrderno);
            $errHeadlineE        = Model::isSpclChar($vchOfficerName);
            $errOrderNo        = Model::isNumericData($intOrderno);

            $txtFile  = $_FILES['filePhoto']['name'];
            $extension      = pathinfo($txtFile, PATHINFO_EXTENSION);
            $prevfile = $_POST['hdnImageFile'];
            $txtFileSize    = $_FILES['filePhoto']['size'];
            $txtTempName    = $_FILES['filePhoto']['tmp_name'];
            $formattedFileName = ($txtFile != '') ? 'OffProfile' . time() . '.' . $extension: '';

            $txttoDate                = htmlspecialchars($_POST['txttoDate'],ENT_QUOTES);
            $txtstartdate           = htmlspecialchars($_POST['txtFromDate'],ENT_QUOTES);
            $errClosingdate                = Model::isSpclChar($_POST['txttoDate']);
            $errstartdate              = Model::isSpclChar($_POST['txtFromDate']);
            if($txttoDate!='' && $txttoDate!='0000-00-00'){
                 $closingDateTime               =  date('Y-m-d',strtotime($txttoDate));
            }else{
                $closingDateTime               =  '';
            }
            $startDateTime          =  ($txtstartdate!='' && $txtstartdate!='0000-00-00')?date('Y-m-d',strtotime($txtstartdate)):'';

            
            $flag                           = ($officerId != 0) ? 1 : 0;
            $action                         = ($officerId == 0) ? 'A' : 'U';
            $errFlag                        = 0 ;
            $errFile =1;
            if($_FILES['filePhoto']['name']!='')
                $errFile  = Model::isValidFile($_FILES['filePhoto']['name'],$allow_img_files);
             

            if($blankHeadlineE >0 || $blankselType >0 || $errClosingdate>0 || $errstartdate>0  || $blankOrderNo>0)
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
            }
            else if(($errHeadlineE >0) )
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
            }else if($errFile==0 || ($errFile%2) ==0)
            {
                $errFlag                = 1;
                $flag                   = 1;
                $outMsg                 = "Invalid File types.Upload only jpeg,jpg,png";
            }else if($errOrderNo>0)
            {
                $errFlag                = 1;
                $flag                   = 1;
                $outMsg                 = "Invalid Numbers are not allowed";
            }
            else if ($txtFileSize > size2MB) {
                $errFlag               = 1;
                $flag                  = 1;
                $outMsg = 'Image File size can not more than 2 MB';
            }
            
       
            if($errFlag==0){
                /* if($startDateTime !='' && $closingDateTime!=''){
                    $dupResult = $this->manageOfficer('CD', $officerId,$selType,$vchOfficerName ,$startDateTime,$closingDateTime,'', 0,$userId,$intOrderno); 
                }
                
                if ($dupResult) {
                    $numRows = $dupResult->fetch_array();
                    if ($numRows > 0) {
                        $outMsg = 'Former Officer wih this Joining date and Leaving Date already exists';
                        $errFlag = 1;
                    }
                }else { */
                    if($officerId != 0 && $formattedFileName ==""){$formattedFileName=$prevfile;}
                    $result = $this->manageOfficer($action, $officerId,$selType,$vchOfficerName ,$startDateTime ,$closingDateTime, $formattedFileName,0,$userId,$intOrderno);
                    if ($result)
                        $outMsg = ($action == 'A') ? 'Former Officer added successfully' : 'Former Officer updated successfully';
                    if ($_FILES['filePhoto']['name'] != '') {
                        if (file_exists("uploadDocuments/offProfile/" . $prevfile) && $prevfile != '') {
                            unlink("uploadDocuments/offProfile/" . $prevfile);
                        }
                        move_uploaded_file($txtTempName, "uploadDocuments/offProfile/" . $formattedFileName);
                    }
                //}
            }
        }else {
            $outMsg = 'Transaction failed due to session mismatch.';
            $errFlag = 1; 
        }
        $arrResult = array('msg' => $outMsg, 'flag' => $errFlag);
        return $arrResult;
    }
     
    public function readProfile($id) {
        //$action, $officerId, $officerType, $officerName, $joiningDate,$retirementDate,$officerFile,$pubStatus,$createdBy
        $result = $this->manageOfficer('R', $id,0,'','','', '',0,0);
        //echo "<pre>"; print_r($result); echo "</pre>";exit;
        if ($result->num_rows > 0) {

            $row                = $result ->fetch_array();
            $intType       = $row['intOfficerType'];
            $intOrderno       = $row['intOrderno'];
            $vchOfficerName       = htmlspecialchars_decode($row['vchOfficerName'],ENT_QUOTES);
            $strjoindate  = date("d-m-Y",strtotime(htmlspecialchars_decode($row['dtJoiningDate'],ENT_NOQUOTES)));
            $strleavedate  = date("d-m-Y",strtotime(htmlspecialchars_decode($row['dtRetireDate'],ENT_NOQUOTES)));
            $strImageFile = $row['vchImage'];
        }


        $arrResult = array( 'intType' => $intType, 'vchOfficerName' => $vchOfficerName,'strjoindate' => $strjoindate,'strleavedate' => $strleavedate, 'strImageFile' => $strImageFile,'intOrderno'=>$intOrderno);
        return $arrResult;
    }
    
    public function deleteActiveProfile($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
            if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        //echo $action; print_r($explIds); exit;
        foreach ($explIds as $indIds) {
            $result = $this->manageOfficer($action,$explIds[$ctr],0,'', '','','',0 ,$userId);                   
            $row = $result ->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg = 'Former Officer(s) deleted successfully';
            else
                $outMsg = 'Dependency record exist Page(s) can not be  deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Former Officer(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Former Officer(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Former Officer(s) archieved successfully';
        else if ($action == 'P')
            $outMsg = 'Former Officer(s) published successfully'; 
        }  
        else {
             $outMsg = 'Transaction fail due to session mismatch.';
                
        }
        
        return $outMsg;
    }
    
}
/* * ****Class to officers Category  ********************
  '	By	 	 : Rajesh Kumar Sahoo	'
  '	On	 	 : 21-May-2021          '
  ' Procedure Used       : USP_FORMER_OFFICERS            '
 * ************************************************** */
class clsOfficerCategory extends Model {
    
    public function manageOfficerCategory($action, $catId, $category, $description,$pubStatus,$createdBy,$orderno=0) {
        $catId         = htmlspecialchars(addslashes($catId),ENT_QUOTES);
        
        $category      = htmlspecialchars(addslashes($category),ENT_QUOTES);
        $description   = htmlspecialchars(addslashes($description),ENT_QUOTES);
        
        $categorySql = "CALL USP_OFFICER_CATEGORY('$action', $catId,'$category', '$description','$pubStatus', $createdBy,$orderno,@OUT);";
        /* if($action == 'PG'){
            echo $categorySql;exit;
        } */
        
        $errAction        = Model::isSpclChar($action);
        $errCategory      = Model::isSpclChar($category);
        $errDescription   = Model::isSpclChar($description);
        
        if ($errAction > 0 || $errCategory > 0 || $errDescription > 0)
            header("Location:" . APP_URL . "error");
        else {
            $categoryResult = Model::executeQry($categorySql);
            return $categoryResult;
        }
    }
    public function addUpdateOfficerCategory($catId) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId                 = $_SESSION['adminConsole_userID']; 
        $txtCategory            = htmlspecialchars(addslashes($_POST['txtCategory']), ENT_QUOTES);
        $intOrderno           = htmlspecialchars(addslashes($_POST['intOrderno']),ENT_QUOTES);
        $blankCategory          = Model::isBlank($txtCategory);
        $errCategory            = Model::isSpclChar($_POST['txtCategory']);
        $lenCategory            = Model::chkLength('max', $txtCategory,100);

        $blankOrderNo        = Model::isBlank($intOrderno);
        $errOrderNo        = Model::isNumericData($intOrderno);

        $radStatus              = htmlspecialchars(addslashes($_POST['intStatus']), ENT_QUOTES);;
        $outMsg                 = '';
        $flag                   = ($catId != 0) ? 1 : 0;
        $action                 = ($catId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if($blankCategory >0 || $blankOrderNo>0)
        {
                $errFlag		= 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenCategory>0)
        {
                $errFlag		= 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if(($errCategory>0))
        {
                $errFlag		= 1;
                $outMsg			= "Special Characters are not allowed";
        }else if($errOrderNo>0)
        {
            $errFlag                = 1;
            $flag                   = 1;
            $outMsg                 = "Invalid Numbers are not allowed";
        }

        $dupResult = $this->manageOfficerCategory('CD', $catId,$txtCategory,'',0,0,$userId);
         if($errFlag==0){
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Officer Category with this name already exists';
                $errFlag = 1;
            } else {
                $action=($catId >0) ? 'U' : 'A';

                $result = $this->manageOfficerCategory($action, $catId,$txtCategory,'',$radStatus,$userId,$intOrderno);
                if ($result)
                    $outMsg = ($action == 'A') ? 'Officer Category added successfully ' : 'Officer Category updated successfully';
               
                }
            }
         }
         }
         else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strCategory        = ($errFlag == 1) ? $txtCategory : '';
        $intStatus          = ($errFlag == 1) ? $radStatus : '2'; 
        $arrResult = array('msg' => $outMsg, 'flag' => $flag,'strCategory' => $strCategory, 'intStatus' => $intStatus);
        return $arrResult;
    }

    public function readOfficerCategory($id) {
        $result = $this->manageOfficerCategory('R', $id,'','',0 ,0);
        if ($result->num_rows > 0) {

            $row               = $result ->fetch_array();
            $strCategory       = htmlspecialchars_decode($row['VCH_CATEGORY_NAME'],ENT_QUOTES);
            $strDescription    = htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_QUOTES);
            $intStatus         = $row['INT_PUBLISH_STATUS']; 
            $selplugintype     = $row['INT_PLUGIN_TYPE'];
            $intOrderno       = $row['intOrderno'];

        }

        $arrResult = array('selplugintype' => $selplugintype,'strCategory' => $strCategory, 'strDescription' => $strDescription, 'intStatus'=>$intStatus,'intOrderno'=>$intOrderno);
        return $arrResult;
    }

    public function deleteOfficerCategory($action, $ids) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageOfficerCategory($action,$explIds[$ctr],'','', 0 ,$userId); 
            $row = $result ->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Category(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist. Page(s) can not be deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Category(s) activated successfully';
        else if ($action == 'UIN')
            $outMsg = 'Category(s) deactivated successfully';
        
        return $outMsg;
    }


}


/* * ****Class to officers  ********************
  '	By	 	 : Rajesh Kumar Sahoo	'
  '	On	 	 : 21-May-2021          '
  ' Procedure Used       : USP_OFFICERS            '
 * ************************************************** */

class clsOfficerRajBhavan extends Model {
    
    public function manageOfficer($action, $officerId, $officerCat, $officerName, $offcerAddress,$officeno,$residenceno,$pubStatus,$createdBy,$orderno=0) {
        $txtSql = "CALL USP_OFFICERS('$action', $officerId, $officerCat, '$officerName', '$offcerAddress','$officeno','$residenceno',$pubStatus, $createdBy,$orderno,@OUT);";
        //echo $txtSql;exit;    
            $errAction          = Model::isSpclChar($action);

        if ($errAction > 0 ){
            echo '<script>window.location.href="' . APP_URL . 'error";</script>';
        }else {
            //if($action == 'PG' || $action == 'V'){ echo $txtSql; exit; }
            $residenceno = Model::executeQry($txtSql);
            return $residenceno;
        }
    }
    
    public function addUpdateProfile($officerId) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        
        if ($newSessionId == $hdnPrevSessionId) {
            $userId                 = $_SESSION['adminConsole_userID'];
            $selCategory           = htmlspecialchars(addslashes($_POST['selCategory']),ENT_QUOTES);
            $vchOfficerName           = htmlspecialchars(addslashes($_POST['vchOfficerName']),ENT_QUOTES);
            $txtAddress           = htmlspecialchars(addslashes($_POST['txtAddress']),ENT_QUOTES);
            $vchofficeno           = htmlspecialchars(addslashes($_POST['vchofficeno']),ENT_QUOTES);
            $vchResno           = htmlspecialchars(addslashes($_POST['vchResno']),ENT_QUOTES);
            $intOrderno           = htmlspecialchars(addslashes($_POST['intOrderno']),ENT_QUOTES);
            $blankHeadlineE         = Model::isBlank($vchOfficerName);
            $blankselCategory        = Model::isBlank($selCategory);
            $blankvchofficeno        = Model::isBlank($vchofficeno);
            $errHeadlineE        = Model::isSpclChar($vchOfficerName);
            $blankOrderNo        = Model::isBlank($intOrderno);
            $errOrderNo        = Model::isNumericData($intOrderno);
            
            $flag                           = ($officerId != 0) ? 1 : 0;
            $action                         = ($officerId == 0) ? 'A' : 'U';
            $errFlag                        = 0 ;
           
             

            if($blankHeadlineE >0 || $blankselCategory >0 || $blankvchofficeno>0 || $blankOrderNo>0)
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Mandatory Fields should not be blank";
            }
            else if(($errHeadlineE >0) )
            {
                $errFlag		= 1;
                $flag                   = 1;
                $outMsg			= "Special Characters are not allowed";
            }else if($errOrderNo>0)
            {
                $errFlag                = 1;
                $flag                   = 1;
                $outMsg                 = "Invalid Numbers are not allowed";
            }
            
       
            if($errFlag==0){
                $dupResult = $this->manageOfficer('CD', $officerId,$selCategory,$vchOfficerName ,$txtAddress ,$vchofficeno ,$vchResno, 0,$userId,$intOrderno); 
                
                if ($dupResult) {
                    $numRows = $dupResult->fetch_array();
                    if ($numRows > 0) {
                        $outMsg = 'Officer already exists';
                        $errFlag = 1;
                    } else {
                        $result = $this->manageOfficer($action, $officerId,$selCategory,$vchOfficerName ,$txtAddress ,$vchofficeno ,$vchResno,0,$userId,$intOrderno);
                        if ($result)
                            $outMsg = ($action == 'A') ? 'Officer added successfully' : 'Officer updated successfully';
                    }
                }
            }
        }else {
            $outMsg = 'Transaction failed due to session mismatch.';
            $errFlag = 1; 
        }
        
        $arrResult = array('msg' => $outMsg, 'flag' => $errFlag);
        return $arrResult;
    }
     
    public function readProfile($id) {
        
        $result = $this->manageOfficer('R', $id,0,'','','', '',0,0);
        //echo "<pre>"; print_r($result); echo "</pre>";exit;
        if ($result->num_rows > 0) {

            $row                = $result ->fetch_array();
            $intCatId       = $row['intCategory'];
            $intOrderno       = $row['intOrderno'];
            $vchOfficerName       = htmlspecialchars_decode($row['vchOfficername'],ENT_QUOTES);
            $txtAddress       = htmlspecialchars_decode($row['txtAddress'],ENT_QUOTES);
            $vchofficeno       = htmlspecialchars_decode($row['vchofficeno'],ENT_QUOTES);
            $vchResno       = htmlspecialchars_decode($row['vchResno'],ENT_QUOTES);
        }


        $arrResult = array( 'intCatId' => $intCatId, 'vchOfficerName' => $vchOfficerName,'txtAddress' => $txtAddress,'vchofficeno' => $vchofficeno, 'vchResno' => $vchResno,'intOrderno'=>$intOrderno);
        return $arrResult;
    }
    
    public function deleteActiveProfile($action, $ids) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
            if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        //echo $action; print_r($explIds); exit;
        foreach ($explIds as $indIds) {
            $result = $this->manageOfficer($action,$explIds[$ctr],0,'', '','','',0 ,$userId);                   
            $row = $result ->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg = 'Former Officer(s) deleted successfully';
            else
                $outMsg = 'Dependency record exist Page(s) can not be  deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Former Officer(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Former Officer(s) unpublished successfully';
        else if ($action == 'AR')
            $outMsg = 'Former Officer(s) archieved successfully';
        else if ($action == 'P')
            $outMsg = 'Former Officer(s) published successfully'; 
        }  
        else {
             $outMsg = 'Transaction fail due to session mismatch.';
                
        }
        
        return $outMsg;
    }
    
}

class clsLocation extends Model {
    
    // Function To Manage Location By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function manageLocation($action, $locationId, $locName,$locName_h, $description,$txtOfficeNO1,$txtOfficeNO2,$txtEmail,$createdBy) {
        $locationSql = "CALL USP_LOCATION_MASTER('$action',$locationId,'$locName','$locName_h','$description','$txtOfficeNO1','$txtOfficeNO2','$txtEmail',$createdBy,@OUT);";
       // echo $locationSql;
        $errAction          = Model::isSpclChar($action);
        //$errCategory      = Model::isSpclChar($category);
        $errDescription        = Model::isSpclChar($description);
        
        if ($errAction > 0 || $errDescription > 0)
            header("Location:" . APP_URL . "error");
        else {
            $locResult = Model::executeQry($locationSql);
            return $locResult;
        }
    }

// Function To Add Upadate Location By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function addUpdateLocation($locationId) {
         $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId                = $_SESSION['adminConsole_userID'];
        $txtLocation           = htmlspecialchars(addslashes($_POST['txtLocation']), ENT_QUOTES);
        $blankLocation         = Model::isBlank($txtLocation);
        $errLocation           = Model::isSpclChar($txtLocation);
        $lenLocation           = Model::chkLength('max', $txtLocation,50);
        $txtDescription        = htmlspecialchars(addslashes($_POST['txtDescription']), ENT_QUOTES);
        $errDescription        = Model::isSpclChar($txtDescription); 

        $txtOfficeNO1           = htmlspecialchars(addslashes($_POST['txtOfficeNO1']), ENT_QUOTES);
        $errOfficeNo1           = Model::isSpclChar($txtOfficeNO1);
        $txtOfficeNO2           = htmlspecialchars(addslashes($_POST['txtOfficeNO2']), ENT_QUOTES);
        $errOfficeNo2           = Model::isSpclChar($txtOfficeNO2);
        $txtEmail           = htmlspecialchars(addslashes($_POST['txtEmail']), ENT_QUOTES);
        $errEmail           = Model::isSpclChar($txtEmail);
       // $radStatus             = $_POST['radStatus'];
        
        $outMsg                 = '';
        $flag                   = ($locationId != 0) ? 1 : 0;
        $action                 = ($locationId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if($blankLocation >0)
        {
                $errFlag		= 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenLocation>0)
        {
                $errFlag		= 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if($errLocation>0 || $errOfficeNo1>0 || $errOfficeNo2>0 || $errEmail >0)
        {
                $errFlag		= 1;
                $outMsg			= "Special Characters are not allowed";
        }
       
        $dupResult = $this->manageLocation('C',$locationId,$txtLocation,'','','','','',$userId);
        
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Location wih this name already exists';
                $errFlag = 1;
            } else {
                $result = $this->manageLocation($action,$locationId,$txtLocation,'',$txtDescription,$txtOfficeNO1,$txtOfficeNO2,$txtEmail,$userId);
                if ($result)
                    $outMsg = ($action == 'A') ? 'Location added successfully ' : 'Location updated successfully';
               
                }
            }
       }
         else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $strLocation          = ($errFlag == 1) ? $txtLocation : '';
        $strDescription       = ($errFlag == 1) ? $txtDescription : '';       
        
        $arrResult = array('msg' => $outMsg, 'flag' => $flag, 'strLocation' => $strLocation, 'strDescription' => $strDescription);
        return $arrResult;
    }

// Function To read Location  By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function readLocation($id) {

        $result = $this->manageLocation('R',$id,'','','','','','',0);
        if (mysqli_num_rows($result) > 0) {

            $row               = mysqli_fetch_array($result);
            $strLocation       = $row['VCH_LOCATION'];
            $strDescription    = htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_QUOTES);
            $strOfficeNO1    = htmlspecialchars_decode($row['VCH_OFFICE_NO1'],ENT_QUOTES);
            $strOfficeNO2    = htmlspecialchars_decode($row['VCH_OFFICE_NO2'],ENT_QUOTES);
            $strEmail    = htmlspecialchars_decode($row['VCH_OFFICE_EMAIL'],ENT_QUOTES);
           // $intStatus        = $row['INT_PUBLISH_STATUS'];            
        }
        $arrResult = array( 'strLocation' => $strLocation, 'strDescription' => $strDescription, 'strOfficeNO1' => $strOfficeNO1, 'strOfficeNO2' => $strOfficeNO2, 'strEmail' => $strEmail);
        return $arrResult;
    }

// Function To Delete Location  By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function deleteLocation($action, $ids) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageLocation($action,$explIds[$ctr],'','','','','','',$userId); 
            $row = mysqli_fetch_array($result);
           
            if ($row[0] === 0)
                $delRec++;
            
            $ctr++;
       
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg = 'Location(s) deleted successfully';
           
        }
        else if ($action == 'P')
            $outMsg = 'Location(s) published successfully';
        else if ($action == 'IN')
            $outMsg = 'Location(s) unpublished successfully';
       
        return $outMsg;
    }
    
}
?>