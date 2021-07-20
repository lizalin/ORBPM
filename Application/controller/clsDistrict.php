<?php

/* * ****Class to manage district details ********************
' By                     : Ashis patra   '
' On                     : 21-Sept-2016     '
' Procedure Used         : USP_DISTRICT_MASTER '
* ************************************************** */

class clsDistrict extends Model {

// Function To Manage district details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
   public function manageDistrict($action,$intDistId,$strDistname,$strDistnameO,$strDescription,$strDescriptionO,$intPublishsts,$createdBy,$intPgsize) {                  
        
        $districtSql = "CALL USP_DISTRICT_MASTER('$action',$intDistId,'$strDistname','$strDistnameO','$strDescription','$strDescriptionO',$intPublishsts,$createdBy,$intPgsize);";
       //echo $districtSql; 
 
        $errDistname         = Model::isSpclChar($strDistname);
       // $errDistnameO        = Model::isSpclChar($strDistnameO);
        $errDescription      = Model::isSpclChar($strDescription);
       // $errDescriptionO     = Model::isSpclChar($strDescriptionO);
         
        if ($errDistname > 0 ||  $errDescription > 0)
            header("Location:" . APP_URL . "error");
        else {
                $districtResult = Model::executeQry($districtSql);
                return $districtResult;
        }
    }

// Function To Add Update district details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
    public function addUpdateDistrict($districtId) {        
      $newSessionId           = session_id();
      $hdnPrevSessionId       = $_POST['hdnPrevSessionId']; 
      if($newSessionId == $hdnPrevSessionId) {    
        $txtDistrict            = htmlspecialchars($_POST['txtDistrict'],ENT_QUOTES);
        $blankDistrict          = Model::isBlank($txtDistrict);
        $errDistrict            = Model::isSpclChar($_POST['txtDistrict']);
        $lenDistrict            = Model::chkLength('max', $txtDistrict,100);
  
        $txtDistrictO           = htmlspecialchars($_POST['txtDistrictO'], ENT_QUOTES, 'UTF-8'); //addslashes($_POST['txtDistrictO']);
        $lenDistrictO           = Model::chkLength('max', $txtDistrictO,150);
        
        $txtDescription         = htmlspecialchars($_POST['txtDescription'],ENT_QUOTES);
        $errDescription         = Model::isSpclChar($_POST['txtDescription']);
        $lenDescription         = Model::chkLength('max', $txtDescription,500);
        
        $txtDescriptionO        = htmlspecialchars($_POST['txtDescriptionO'], ENT_QUOTES, 'UTF-8'); //addslashes($_POST['txtDescriptionO']);

        $outMsg                 = '';
        $flag                   = ($districtId != 0) ? 1 : 0;
        $action                 = 'AU';
        $errFlag                = 0 ;
        
        if($blankDistrict>0)
        {
                    $errFlag    = 1;
                    $flag       = 1;
                    $outMsg     = "Mandatory Fields should not be blank";
                
        }
        else if($lenDistrict>0 ||$lenDistrictO>0 ||$lenDescription>0)
        {
                    $errFlag    = 1;
                    $flag       = 1;
                    $outMsg     = "Length should not exceed maxlength";
        }
        else if($errDistrict>0  || $errDescription>0)
        {
                    $errFlag    = 1;
                    $flag       = 1;
                    $outMsg     = "Special Characters are not allowed";
        }
       
        if($errFlag==0){
                
            $result             = $this->manageDistrict($action,$districtId,$txtDistrict,$txtDistrictO,$txtDescription,$txtDescriptionO,0,USER_ID,0);
                   
            if($result)
            {
                $numRow         = $result->fetch_array();
                $statusflag     = $numRow['@P_STATUS']; 

                if($statusflag=='0'){
                  $outMsg       = 'District Name already exists';
                  $errFlag      = 1;
                  $flag         = 1;
                }
               else{
                    $outMsg     = ($districtId != 0) ?'District details updated successfully':'District details added successfully';
                   
               }
            }
         }
       }else{
                header("Location:" . APP_URL . "error");
           }      
        $strDistrict            = ($errFlag == 1) ? $txtDistrict : '';
        $strDistrictO           = ($errFlag == 1) ? $txtDistrictO : '';   
        $strDescription         = ($errFlag == 1) ? $txtDescription : ''; 
        $strDescriptionO        = ($errFlag == 1) ? $txtDescriptionO : ''; 
        
        $arrResult = array('strDistrict' => $strDistrict,'strDistrictO' => $strDistrictO,
            'strDescription' => $strDescription,'strDescriptionO' => $strDescriptionO,
            'msg' => $outMsg, 'flag' => $errFlag);
        return $arrResult;
      
    }

// Function To read District details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
    public function readDistrict($districtId) {

       $result = $this->manageDistrict('R',$districtId,'','','','',0,0,0);
        if ($result->num_rows> 0) {
            
            $row                    = $result->fetch_array(); 
            $strDistrict            = htmlspecialchars_decode($row['vchDistrictname'],ENT_QUOTES);   
            $strDistrictO           = $row['vchDistrictnameO'];
            $strDescription         = htmlspecialchars_decode($row['vchDescription'],ENT_QUOTES); 
            $strDescriptionO        = $row['vchDescriptionO'];        
        }
        $arrResult = array('strDistrict' => $strDistrict,'strDistrictO' => $strDistrictO,
            'strDescription' => $strDescription,'strDescriptionO' => $strDescriptionO);
        return $arrResult;
    }
    
 
// Function To Delete District details By::T Ketaki Debadarshini    :: On:: 21-Sept-2016
    public function deleteDistrict($action, $ids) {
      $newSessionId           = session_id();
      $hdnPrevSessionId       = $_POST['hdnPrevSessionId']; 
      if($newSessionId == $hdnPrevSessionId) {   
                $ctr        = 0;        
                $explIds    = explode(',', $ids);
                $delRec     = 0;

                $msgTitle           = 'District detail(s)';
                foreach ($explIds as $indIds) {

                    $result = $this->manageDistrict($action,$explIds[$ctr],'','','','',0,USER_ID,0);
                    $row = $result->fetch_array();

                    if ($row[0] == 0)   
                        $delRec++;

                      $ctr++;
                }

                if ($action == 'D') {
                     if ($delRec > 0)
                            $outMsg .= $msgTitle.' deleted successfully';
                        else
                            $outMsg .= 'Dependency record exist. '.$msgTitle.' can not be deleted';

                }
                else if ($action == 'AC')
                    $outMsg = $msgTitle.' activated successfully';
                else if ($action == 'IN')
                    $outMsg =  $msgTitle.' unpublished successfully';
                else if ($action == 'AR')
                    $outMsg =  $msgTitle.' archieved successfully';
                else if($action == 'P'){
                    $outMsg =  $msgTitle.' Published successfully';
                }
                return $outMsg;
          }else{
                header("Location:" . APP_URL . "error");
           }    
    }

}
