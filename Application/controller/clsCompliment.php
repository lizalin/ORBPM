<?php
/* ******* Class to manage Compliment ********************
'By                     : Ajmal'
'On                     : 22-Dec-2020'       
' Procedure Used        : USP_COMPLIMENT'     
*************************************************** */

class clsCompliment extends Model {

// Function To Manage Compliment  By::Ajmal  :: On:: 22-Dec-2020

    public function manageCompliment($action,$intId,$compliment,$name,$mobileNo,$email,$radioVal,$createdBy,$createdOn,$pubStatus,$archiveStatus,$varAttr1,$varAttr2,$intAttr1,$intAttr2) {

        $sql              	= "CALL USP_COMPLIMENT('$action',$intId,'$compliment','$name','$mobileNo','$email',$radioVal,$createdBy,'$createdOn',$pubStatus,$archiveStatus,'$varAttr1','$varAttr2',$intAttr1,$intAttr2,@OUT);";
     // echo $sql;exit();
        $errAction          = Model::isSpclChar($action);
        $errCompliment      = Model::isSpclChar($compliment);
        $errName            = Model::isSpclChar($name);
        $errEmail           = Model::isSpclChar($email);
 
        if ($errAction > 0 || $errCompliment > 0 || $errName > 0 || $errEmail > 0){
            header("Location:" . APP_URL . "error");
        }else {
            $sqlResult = Model::executeQry($sql);
            return $sqlResult;
        }
    }

// Function To Add Compliment  By::Ajmal  :: On:: 22-Dec-2020
    public function addCompliment() {
  
        $userId                 = 0;
        $intId                  = 0;
        $txtCompliment        	= htmlspecialchars($_POST['txtCompliment'], ENT_QUOTES);
        $blankCompliment      	= Model::isBlank($txtCompliment);
        $errTxtCompliment     	= Model::isSpclChar($_POST['txtCompliment']);
        $radioVal    = $_POST["optradioYes"];
        if($radioVal == 1)
        {
        $txtName                = htmlspecialchars($_POST['txtName'], ENT_QUOTES);
        $blankName              = Model::isBlank($txtName);
        $errTxtName             = Model::isSpclChar($_POST['txtName']);
        $txtMobile              = htmlspecialchars($_POST['txtNumber'], ENT_QUOTES);
        $blankMobile            = Model::isBlank($txtMobile);
        $errTxtMobile           = Model::isSpclChar($_POST['txtNumber']);
        $txtEmail               = htmlspecialchars($_POST['txtEmail'], ENT_QUOTES);
        $blankEmail             = Model::isBlank($txtEmail);
        $errTxtEmail            = Model::isSpclChar($_POST['txtEmail']);
        }
        $outMsg = '';
        $flag   =  0;
        $action = 'A'; 
        $errFlag            = 0 ;
		if(($blankCompliment > 0))
        {
                        $errFlag        = 1;
                        $flag           = 1;
                        $outMsg         = "Compliment should not be blank";
        }else if(($errTxtCompliment))
        {
                        $errFlag        = 1;
                        $flag           = 1;
                        $outMsg         = "Special Characters are not allowed";  
        }else if(($radioVal == 1))
        {
            if(($blankName >0) || ($blankEmail >0) || ($blankMobile >0)) 
                    {
                        $errFlag        = 1;
                        $flag           = 1;
                        $outMsg         = "Mandatory Fields should not be blank";
                    }
                else if(($errTxtName>0) || ($errTxtEmail> 0) || ($errTxtMobile >0))
                    {
                        $errFlag        = 1;
                        $flag           = 1;
                        $outMsg         = "Special Characters are not allowed";
                    } 
        }

        if($errFlag==0){
  
                $result = $this->manageCompliment($action,$intId,$txtCompliment,$txtName,$txtMobile,$txtEmail,$radioVal,$userId,'0001-01-01',0,0,'','',0,0);
                if ($result)
                $outMsg = 'Compliment added successfully ';
                    }
              
        $strCompliment    	= ($errFlag == 1) ? $txtCompliment : '';         
        $strName        	= ($errFlag == 1) ? $txtName : '';
        $strMobile      	= ($errFlag == 1) ? $txtMobile : '';
        $strEmail       	= ($errFlag == 1) ? $txtEmail : '';
                      
        $arrResult = array('strCompliment' => $strCompliment,'strName' => $strName,'strMobile' => $strMobile,'strEmail' => $strEmail,'msg' => $outMsg, 'flag' => $flag);
        return $arrResult;
    }

// Function To Delete Compliment  By::Ajmal  :: On:: 24-Dec-2020
    public function deleteCompliment($action, $ids) {

        $newSessionId           = session_id();
        $hdnPrevSessionId       = $_POST['hdnPrevSessionId'];
        if ($newSessionId == $hdnPrevSessionId) {
        $ctr = 0;
        $msg=0;
        $userId = $_SESSION['adminConsole_userID'];
        $explIds = explode(',', $ids);
        $delRec = 0;
        foreach ($explIds as $indIds) {
            
            $result = $this->manageCompliment($action,$explIds[$ctr],'','','','',0,$userId,'1000-01-01',0,0,'','',0,0);          
            $row = $result->fetch_array();
            if ($row[0] == 0)
                $delRec++;
            $ctr++;
        }

        if ($action == 'D') {
               $outMsg .= 'Compliment deleted successfully';
        }
        return $outMsg;
         }    else {
             return   $outMsg = 'Transaction fail due to session mismatch.';
                   }
    }    

}
?>