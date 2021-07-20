 <?php 
 /* * ****Class to manage Admin Links********************
  '	By	 	 : T Ketaki Debadarshini	'
  '	On	 	 : 3-Sept-2015        '
  ' Procedure Used       : USP_ADMIN_GL,USP_ADMIN_PL            '
 * ************************************************** */
class clsAdminLinks extends Model {

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
?>