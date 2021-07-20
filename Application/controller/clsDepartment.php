<?php

/* * ****Class to manage Department ********************
'By                     : T Ketaki Debadarshini	'
'On                     : 10-Sept-2015       '
' Procedure Used        : USP_DEPARTMENT_MASTER       '
* ************************************************** */

class clsDepartment extends Model {
    
    // Function To Manage Department By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function manageDepartment($action,$deptId,$locationId,$deptName,$deptName_h,$description,$publishon,$createdBy) {
        $deptSql = "CALL USP_DEPARTMENT_MASTER('$action',$deptId,$locationId,'$deptName','$deptName_h','$description',$publishon,$createdBy,@OUT);";
        //echo $deptSql;
        $errAction        = Model::isSpclChar($action);
        $errdeptName      = Model::isSpclChar($deptName);
        $errDescription   = Model::isSpclChar($description);
        
        if ($errAction > 0 || $errdeptName > 0 || $errDescription > 0)
            header("Location:" . APP_URL . "error");
        else {
            $deptResult = Model::executeQry($deptSql);
            return $deptResult;
        }
    }

// Function To Add Upadate Department By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function addUpdateDepartment($deptId) {
        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
         if ($newSessionId == $hdnPrevSessionId) {
        $userId                = $_SESSION['adminConsole_userID'];
        
        $ddlLocation           = $_POST['ddlLocation'];
        
        $txtDepartment           = htmlspecialchars(addslashes($_POST['txtDepartment']), ENT_QUOTES);
        $blankDepartment         = Model::isBlank($txtDepartment);
        $errDepartment           = Model::isSpclChar($txtDepartment);
        $lenDepartment           = Model::chkLength('max', $txtDepartment,50);
        $txtDescription        = htmlspecialchars(addslashes($_POST['txtDescription']), ENT_QUOTES);
        $errDescription        = Model::isSpclChar($txtDescription); 
       // $radStatus             = $_POST['radStatus'];
        
        $outMsg                 = '';
        $flag                   = ($deptId != 0) ? 1 : 0;
        $action                 = ($deptId == 0) ? 'A' : 'U';
        $errFlag                = 0 ;
        if($blankDepartment >0)
        {
                $errFlag		= 1;
                $outMsg			= "Mandatory Fields should not be blank";
        }
        else if($lenDepartment>0)
        {
                $errFlag		= 1;
                $outMsg			= "Length should not excided maxlength";
        }
        else if($errDepartment>0)
        {
                $errFlag		= 1;
                $outMsg			= "Special Characters are not allowed";
        }
      
        $dupResult = $this->manageDepartment('C',$deptId,$ddlLocation,$txtDepartment,'','',0,$userId);
      
        if ($dupResult) {
            $numRows = $dupResult->fetch_array();
            if ($numRows > 0) {
                $outMsg = 'Department wih this name already exists';
                $errFlag = 1;
            } else {
                $result = $this->manageDepartment($action,$deptId,$ddlLocation,$txtDepartment,'',$txtDescription,0,$userId);
                if ($result)
                    $outMsg = ($action == 'A') ? 'Department added successfully ' : 'Department updated successfully';
               
                }
            }
            }
         else {
                $outMsg = 'Transaction fail due to session mismatch.';
                $errFlag = 1; 
         }
        $intLocation          = ($errFlag == 1) ? $ddlLocation : 0;
        $strDepartment          = ($errFlag == 1) ? $txtDepartment : '';
        $strDescription       = ($errFlag == 1) ? $txtDescription : '';       
        
        $arrResult = array('msg' => $outMsg, 'flag' => $flag,'intLocation' => $intLocation,'strDepartment' => $strDepartment, 'strDescription' => $strDescription);
        return $arrResult;
    }

// Function To read Department  By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function readDepartment($id) {

        $result = $this->manageDepartment('R',$id,0,'','','',0,0);      
        if (mysqli_num_rows($result) > 0) {

            $row               = mysqli_fetch_array($result);
            $strDepartment     = $row['VCH_DEPARTMENT_NAME'];
            $intLocation       = $row['INT_LOCATION_ID'];
            $strDescription    = htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_QUOTES);
                 
        }
        $arrResult = array( 'intLocation' => $intLocation,'strDepartment' => $strDepartment,'strDescription' => $strDescription);
        return $arrResult;
    }

// Function To Delete Department  By::T Ketaki Debadarshini   :: On:: 10-Sept-2015
    public function deleteDepartment($action, $ids) {
        $ctr = 0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            $result = $this->manageDepartment($action,$explIds[$ctr],0,'','','',0,$userId); 
            $row = mysqli_fetch_array($result);
            if ($row[0] === 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
            if ($delRec > 0)
                $outMsg .= 'Department(s) deleted successfully';
            else
                $outMsg .= 'Dependency record exist. Page(s) can not be deleted';
        }
        else if ($action == 'AC')
            $outMsg = 'Department(s) activated successfully';
        else if ($action == 'IN')
            $outMsg = 'Department(s) unpublished successfully';
       
        return $outMsg;
    }
    
}
?>