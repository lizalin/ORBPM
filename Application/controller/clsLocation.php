<?php 
/* * ****Class to manage Location ********************
'By                     : T Ketaki Debadarshini	'
'On                     : 10-Sept-2015       '
' Procedure Used        : USP_LOCATION_MASTER       '
* ************************************************** */

class clsLocations extends Model {
    
    // Function To Manage Location By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function manageLocation($action, $locationId, $locName,$locName_h, $description,$createdBy) {
        $locationSql = "CALL USP_LOCATION_MASTER('$action',$locationId,'$locName','$locName_h','$description',$createdBy,@OUT);";
       // echo $locationSql;
        $errAction          = Model::isSpclChar($action);
        $errCategory      = Model::isSpclChar($category);
        $errDescription        = Model::isSpclChar($description);
        
        if ($errAction > 0 || $errCategory > 0 || $errDescription > 0)
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
       // $radStatus             = $_POST['radStatus'];
        
        $outMsg                 = '';
        $flag                   = ($locationId != 0) ? 1 : 0;
        $action                 = ($locationId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if($blankCategory >0)
        {
                $errFlag		= 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenLocation>0)
        {
                $errFlag		= 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if($errLocation>0)
        {
                $errFlag		= 1;
                $outMsg			= "Special Characters are not allowed";
        }
      
        $dupResult = $this->manageLocation('C',$locationId,$txtLocation,'','',$userId);
        
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Location wih this name already exists';
                $errFlag = 1;
            } else {
                $result = $this->manageLocation($action,$locationId,$txtLocation,'',$txtDescription,$userId);
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

        $result = $this->manageLocation('R',$id,'','','',0);
        if (mysqli_num_rows($result) > 0) {

            $row               = mysqli_fetch_array($result);
            $strLocation       = $row['VCH_LOCATION'];
            $strDescription    = htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_QUOTES);
           // $intStatus        = $row['INT_PUBLISH_STATUS'];            
        }
        $arrResult = array( 'strLocation' => $strLocation, 'strDescription' => $strDescription);
        return $arrResult;
    }

// Function To Delete Location  By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function deleteLocation($action, $ids) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageLocation($action,$explIds[$ctr],'','','',$userId); 
            $row = mysqli_fetch_array($result);
           
            if ($row[0] === 0)
                $delRec++;
            
            $ctr++;
       
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Location(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist. Page(s) can not be deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Location(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Location(s) unpublished successfully';
       
        return $outMsg;
    }
    
}
?>
