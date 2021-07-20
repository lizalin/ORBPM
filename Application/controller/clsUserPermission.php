<?php
/* * ****Class to manage User Permission********************
  '	By	 	 : T Ketaki Debadarshini	'
  '	On	 	 : 31-Aug-2015        '
  ' Procedure Used       : USP_USER_PERMISSION            '
 * ************************************************** */
class clsUserPermission extends Model {

// Function To Manage Globallink By::T Ketaki Debadarshini   :: On::31-Aug-2015    
    public function managePermission($action, $pId,$userId,$glId,$plId,$auther,$editor,$publisher,$manager,$previlage,$createdBy)
    {
        $permissionSql = "CALL USP_USER_PERMISSION('$action',$pId,$userId,$glId,$plId,$auther,$editor,$publisher,$manager,$previlage,$createdBy,@out);";
//echo $permissionSql; 
        $permissionResult = Model::executeQry($permissionSql);
        return $permissionResult;
    }
    
    
 }
 ?>