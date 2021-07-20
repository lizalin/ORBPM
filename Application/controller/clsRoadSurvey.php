<?php

/* * ****Class to manage district details ********************
' By                     : Ashis patra   '
' On                     : 21-Sept-2016     '
' Procedure Used         : USP_DISTRICT_MASTER '
* ************************************************** */

class clsRoadSurvey extends Model {

// Function To Manage district details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
   public function manageRoadSurvey($action,$intsurveyId,$strName,$strContact,$strDistrict,$strRuleslist,$intPublishsts,$createdBy,$intPgsize) {                  
        
        $districtSql = "CALL USP_ROAD_SAFETY_SURVEY('$action',$intsurveyId,'$strName','$strContact','$strDistrict','$strRuleslist',$intPublishsts,$createdBy,$intPgsize);";
      //echo $districtSql; //exit;
 
        $errname         = Model::isSpclChar($strName);
        $errContact        = Model::isSpclChar($strContact);
        $errDistrict     = Model::isSpclChar($strDistrict);
        $errRules     = Model::isSpclChar($strRuleslist);
         
        if ($errname >0 || $errContact >0 || $errDistrict > 0 ||  $errRules > 0)
            header("Location:" . SITE_PATH . "error");
        else {
                $districtResult = Model::executeQry($districtSql);
                return $districtResult;
        }
    }

// Function To Add Update district details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
    public function addUpdateRoadSurvey($surveyId) {        
       
        $txtName            = htmlspecialchars($_POST['txtName'],ENT_QUOTES);
        $blankName          = Model::isBlank($txtName);
        $errName            = Model::isSpclChar($_POST['txtName']);
        $lenName            = Model::chkLength('max', $txtDistrict,100);
        
        $txtContact         = htmlspecialchars($_POST['txtPhone'],ENT_QUOTES);
        $blankContact       = Model::isBlank($txtContact);
        $errContact         = Model::isSpclChar($_POST['txtPhone']);
        $lenContact            = Model::chkLength('max', $txtContact,10);
  
        $txtDistrict            = htmlspecialchars($_POST['ddlDistrict'], ENT_QUOTES);
        $blankDistrict          = Model::isBlank($txtDistrict);
     
        
          $txtRules               = $_POST['strRules'];
          $blankRules         = count($txtRules>0)?0:1;
            if(count($txtRules)>0){
                $rulesList=implode('::',$txtRules);
            }
        
        //addslashes($_POST['txtDescriptionO']);

        $outMsg                 = '';
        $flag                   = ($surveyId != 0) ? 1 : 0;
        $action                 = 'AU';
        $errFlag                = 0 ;
        
        if($blankName>0 || $blankContact || $blankDistrict)
        {
                    $errFlag    = 1;
                    $flag       = 1;
                    $outMsg     = "Mandatory Fields should not be blank";
                
        }
         else if($lenName>0)
        {
                    $errFlag    = 1;
                    $flag       = 1;
                    $outMsg     = "Name Field should not exceed maxlength";
        }
        else if($lenContact>0)
        {
                    $errFlag    = 1;
                    $flag       = 1;
                    $outMsg     = "Mobile No. should not exceed maxlength";
        }
       
        else if($errContact>0  || $errName>0)
        {
                    $errFlag    = 1;
                    $flag       = 1;
                    $outMsg     = "Special Characters are not allowed";
        }
         $dupResult = $this->manageRoadSurvey('CD',0,$txtName,$txtContact,$txtDistrict,$rulesList,0,1,0);
     
        if($errFlag==0){
            if ($dupResult) {
                        $numRows =$dupResult->num_rows;
                        
                        if ($numRows > 0) {
                            $outMsg = 'You have already participated in this pledge.';
                            $errFlag = 1;
                            $flag   = 1;
                        } else {
                          
                
                            $result             = $this->manageRoadSurvey('AU',0,$txtName,$txtContact,$txtDistrict,$rulesList,0,1,0);
                        if($result)
                         {
                             $numRow         = $result->fetch_array();
                             $statusflag     = $numRow['@ACK_NO']; 

                             if($statusflag ==''){
                               $outMsg       = 'Some Error Occured';
                               $errFlag      = 1;
                               $flag         = 1;
                             }
                            else{
                                 $outMsg     = ($surveyId != 0) ?'Thank you for participating in road safety pledge. Reference No:-'.$statusflag:'Thank you for participating in road safety pledge. Reference No:-'.$statusflag;

                            }
                         }
                    }
                }
        }
           
        $strName             = ($errFlag == 1) ? $txtName : '';
        $strContact          = ($errFlag == 1) ? $txtContact : '';   
        $strDistrict         = ($errFlag == 1) ? $txtDistrict : ''; 
        $aryRules     = ($errFlag == 1) ? explode('::',$rulesList) : ''; 
       
        $arrResult = array('strDistrict' => $strDistrict,'strName' => $strName,
            'strContact' => $strContact,'strRules' => $aryRules,
            'msg' => $outMsg, 'flag' => $errFlag,'acknowledgeNo'=>$statusflag);
        return $arrResult;
      
    }

// Function To read District details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
//    public function readDistrict($districtId) {
//
//       $result = $this->manageDistrict('R',$districtId,'','','','',0,0,0);
//        if ($result->num_rows> 0) {
//            
//            $row                    = $result->fetch_array(); 
//            $strDistrict            = htmlspecialchars_decode($row['vchDistrictname'],ENT_QUOTES);   
//            $strDistrictO           = $row['vchDistrictnameO'];
//            $strDescription         = htmlspecialchars_decode($row['vchDescription'],ENT_QUOTES); 
//            $strDescriptionO        = $row['vchDescriptionO'];        
//        }
//        $arrResult = array('strDistrict' => $strDistrict,'strDistrictO' => $strDistrictO,
//            'strDescription' => $strDescription,'strDescriptionO' => $strDescriptionO);
//        return $arrResult;
//    }
    
 
// Function To Delete District details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
//    public function deleteDistrict($action, $ids) {
//      $newSessionId           = session_id();
//      $hdnPrevSessionId       = $_POST['hdnPrevSessionId']; 
//      if($newSessionId == $hdnPrevSessionId) {   
//                $ctr        = 0;        
//                $explIds    = explode(',', $ids);
//                $delRec     = 0;
//
//                $msgTitle           = 'District detail(s)';
//                foreach ($explIds as $indIds) {
//
//                    $result = $this->manageDistrict($action,$explIds[$ctr],'','','','',0,USER_ID,0);
//                    $row = $result->fetch_array();
//
//                    if ($row[0] == 0)   
//                        $delRec++;
//
//                      $ctr++;
//                }
//
//                if ($action == 'D') {
//                     if ($delRec > 0)
//                            $outMsg .= $msgTitle.' deleted successfully';
//                        else
//                            $outMsg .= 'Dependency record exist. '.$msgTitle.' can not be deleted';
//
//                }
//                else if ($action == 'AC')
//                    $outMsg = $msgTitle.' activated successfully';
//                else if ($action == 'IN')
//                    $outMsg =  $msgTitle.' unpublished successfully';
//                else if ($action == 'AR')
//                    $outMsg =  $msgTitle.' archieved successfully';
//                else if($action == 'P'){
//                    $outMsg =  $msgTitle.' Published successfully';
//                }
//                return $outMsg;
//          }else{
//                header("Location:" . APP_URL . "error");
//           }    
//    }

}
