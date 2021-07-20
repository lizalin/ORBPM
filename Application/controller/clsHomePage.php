<?php 
/* * ****Class to manage Home Page ********************
'By                     : Indrani'
'On                     : 18-Nov-2020       '
' Procedure Used        : USP_HOMEPAGE       '
* ************************************************** */

class clsHomePage extends Model {

// Function To Manage Home Page By::Indrani  :: On:: 16-Nov-2020
    public function manageHomePage($action,$typeID,$strattr1,$strattr2,$intattr1,$intattr2,$intattr3,$intattr4,$pubStatus,$archiveStatus,$createdBy) {
        $sql       = "CALL USP_HOMEPAGE('$action',$typeID,'$strattr1','$strattr2',$intattr1,$intattr2,$intattr3,$intattr4,$pubStatus,$archiveStatus,$createdBy,@OUT);";
        $errAction        = Model::isSpclChar($action);
        if ($errAction > 0)
            header("Location:" . APP_URL . "error");
        else {
            $faqResult = Model::executeQry($sql); 
            return $faqResult;
            
        }
    }

}

?>