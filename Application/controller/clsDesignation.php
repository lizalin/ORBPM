<?php 
/* * ****Class to manage Designation ********************
'By                     : T Ketaki Debadarshini	'
'On                     : 10-Sept-2015       '
' Procedure Used        : USP_DESIGNATION_MASTER       '
* ************************************************** */

class clsDesignation extends Model {
    
    // Function To Manage Designation By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function manageDesignation($action,$desgId,$locationId,$deptId,$desgName,$desgName_h,$publishon,$createdBy) {
        $desgSql = "CALL USP_DESIGNATION_MASTER('$action',$desgId,$locationId,$deptId,'$desgName','$desgName_h',$publishon,$createdBy,@OUT);";
        //echo $desgSql;
        $errAction        = Model::isSpclChar($action);
        $errdesgName      = Model::isSpclChar($desgName);
     
        if ($errAction > 0 || $errdesgName > 0)
            header("Location:" . APP_URL . "error");
        else {
            $desgResult = Model::executeQry($desgSql);
            return $desgResult;
        }
    }

// Function To Add Upadate Designation By::T Ketaki Debadarshini   :: On:: 11-Sept-2015
    public function addUpdateDesignation($desgId) {
         $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId                = $_SESSION['adminConsole_userID'];
        
        $ddlLocation            = $_POST['ddlLocation'];
        $ddlDept                = $_POST['ddlDepartment'];
        $txtDesignation           = htmlspecialchars(addslashes($_POST['txtDesignation']), ENT_QUOTES);
        $blankDesignation         = Model::isBlank($txtDesignation);
        $errDesignation           = Model::isSpclChar($txtDesignation);
        $lenDesignation          = Model::chkLength('max', $txtDesignation,50);
       
        
        $outMsg                 = '';
        $flag                   = ($desgId != 0) ? 1 : 0;
        $action                 = ($desgId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if($blankDesignation >0)
        {
                $errFlag		= 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenDesignation>0)
        {
                $errFlag		= 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if($errDesignation>0)
        {
                $errFlag		= 1;
                $outMsg			= "Special Characters are not allowed";
        }
      
        $dupResult = $this->manageDesignation('C',$desgId,$ddlLocation,$ddlDept,$txtDesignation,'',0,$userId);
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Designation wih this name already exists';
                $errFlag = 1;
            } else {
                $result = $this->manageDesignation($action,$desgId,$ddlLocation,$ddlDept,$txtDesignation,'',0,$userId);
                if ($result)
                    $outMsg = ($action == 'A') ? 'Designation added successfully ' : 'Designation updated successfully';
               
                }
            }
            }
         else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $intLocation     = ($errFlag == 1) ? $ddlLocation : 0;
        $intDept         = ($errFlag == 1) ? $ddlDept : 0;
        $strDesignation          = ($errFlag == 1) ? $txtDesignation : '';
      
        $arrResult = array('msg' => $outMsg, 'flag' => $flag,'intLocation' => $intLocation,'intDept' => $intDept, 'strDesignation' => $strDesignation);
        return $arrResult;
    }

// Function To read Designation  By::T Ketaki Debadarshini   :: On:: 11-Sept-2015
    public function readDesignation($id) {

        $result = $this->manageDesignation('R',$id,0,0,'','',0,0);      
        if (mysqli_num_rows($result) > 0) {

            $row               = mysqli_fetch_array($result);
            $intDept           = $row['INT_DEPARTMENT_ID'];
            $intLocation       = $row['INT_LOCATION'];
            $strDesignation    = htmlspecialchars_decode($row['VCH_DESIGNATION_NAME'],ENT_QUOTES);
                 
        }
        $arrResult = array( 'intLocation' => $intLocation,'intDept' => $intDept, 'strDesignation' => $strDesignation);
        return $arrResult;
    }

// Function To Delete Designation  By::T Ketaki Debadarshini   :: On:: 11-Sept-2015
    public function deleteDesignation($action, $ids) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageDesignation($action,$explIds[$ctr],0,0,'','',0,$userId); 
            $row = mysqli_fetch_array($result);
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Designation(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist. Page(s) can not be deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Designation(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Designation(s) unpublished successfully';
       
        return $outMsg;
    }
    
}
?>