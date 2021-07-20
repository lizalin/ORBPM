<?php
	/* ================================================
	File Name         	  : setPermission.php
	Description	          : This page is used to give previlage to the administrators.	
	Developed By		  : T Ketaki Debadarshini
	Developed On		  : 29-Aug-2015
	Update History		  :
	<Updated by>		<Updated On>		<Remarks>

	Style sheet               : style.php                                             
	Javscript Functions       : jquery.js, loadComponent.js,loadXML.js,loadAjax.js,validator.js
	includes		  : setPermissionInner.php,header.php,leftmenu.php,navigation.php,util.php,footer.php

	==================================================*/
	include('setPermissionInner.php');
	
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
 <script type="text/javascript" src="<?php echo APP_URL; ?>js/modal.js"></script>
<script language="javascript"> 
	pageHeader   = "Add & Edit Permission";
	strFirstLink = "Manage User";
	strLastLink  = "Set Permission";
        indicate = 'yes'; 
         if('<?php echo $outMsg;?>'!='')                
             alert('<?php echo $outMsg;?>');
	
	$(document).ready(function(){		
                getAllUsers('<?php echo $intUserId;?>');
		
	});
	function showDiv(glTab,glDiv)
	{
            $('#'+glDiv).slideToggle('medium');					 
            $('#'+glTab).toggleClass("active");
	}
	function validCheck(gl,pl)
	{
            var count_checked = $("#tr_"+gl+"_"+pl+" input[type='checkbox']:not('#chkBox_"+gl+"_"+pl+"'):checked").length;	
            if(count_checked>0)
            {
                    $('#chkBox_'+gl+'_'+pl).attr('checked','checked');
                    $('#hdn_'+gl+'_'+pl).val(1);		
            }
            else
            {
                    $('#chkBox_'+gl+'_'+pl).attr('checked',false);
                    $('#hdn_'+gl+'_'+pl).val(0);		
            }
            var count_chkDiv= $("#tab"+gl+" input[type='checkbox']:checked").length;
            if(count_chkDiv>0)
                    $('#hdnGl_'+gl).val(1);
            else
                    $('#hdnGl_'+gl).val(0);
	}
	function validator()
	{			
            if(!selectDropdown('DdlName','Select User Name'))
                    return false;
            var checkLength	= $(".permissionList input[type='checkbox']:checked").length;
            if(checkLength==0)
            {
                    alert('Set permission to selected user');
                    return false;
            }
	}
</script>
  <div class="page-content">
        <div class="page-header">
            <h1 id="title" class="col-sm-5"></h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
                 <!-- PAGE CONTENT BEGINS -->
                 <?php include('includes/util.php'); ?>
                <div class="hr hr-solid"></div>

                 <div id="viewTable">
                
                     
                  
                      <table border="0" cellspacing="0" cellpadding="0">                        
                        <tr>
                          <td>User Name</td>
                          <td align="center" valign="middle">:</td>
                          <td><select name="DdlName" id="DdlName" style="width:200px;" class="selectdrop" onChange="fillPermission(this.value);">
                              <option value="0">-Select-</option>
                            </select>&nbsp;<span class="mandatory">*</span></td>
                        </tr>
                      </table>
                 
                    <div class="permissionList">
                        <?php

                      if($adminPrevilegeStatus!=1)
                        {                         
                            $adminGLResult	= $objPermission->managePermission('DG','0',$sessUserId,0,0,0,0,0,0,0,0);
                              if(mysqli_num_rows($adminGLResult)>0)
                              {
                                  while($adminGLRow=mysqli_fetch_array($adminGLResult))
                                  {
                                      $adminGLId	= $adminGLRow['GL_ID'];
                        ?>
				<ul>
                                    <li><a href="javascript:void(0);" class="clickDiv" id="gl<?php echo $adminGLId;?>" onClick="showDiv(this.id,'tab<?php echo $adminGLId;?>');"><?php echo $adminGLRow['GL_NAME'];?></a>
                                    <input type="hidden" name="hdnGl_<?php echo $adminGLId;?>" id="hdnGl_<?php echo $adminGLId;?>" value="0">
                                    <input type="hidden" name="hdnPreGl_<?php echo $adminGLId;?>" id="hdnPreGl_<?php echo $adminGLId;?>" value="0">
                                    <div class="viewTable" id="tab<?php echo $adminGLId;?>" style="display:none;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                            <th width="200">&nbsp;</th>
                                            <th>Author Rights</th>
                                            <th>Editor Rights</th>
                                            <th>Publisher Rights</th>
                                            <th>Manager Rights</th>
                                      </tr>
                                        <?php
                                         $adminPLResult = $objPermission->managePermission('S','0',$sessUserId,$adminGLId,0,0,0,0,0,0,0);
                                         if(mysqli_num_rows($adminPLResult)>0)
                                         {
                                            while($adminPLRow=mysqli_fetch_array($adminPLResult))
                                            {
                                                    $adminPLId	= $adminPLRow['INT_PL_ID'];
                                        ?>
                                              <tr id="tr_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>">
                                                <td><input name="chkBox_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkBox_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" disabled="disabled" value="0">														
                                                  <strong><?php echo $adminPLRow['PL_NAME'];?></strong>
                                                  <input name="hdn_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="hdn_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="hidden" value="0">
                                                  <input name="hdnPreVal_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="hdnPreVal_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="hidden" value="0">
                                                </td>
                                                <td><input name="chkAuthor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkAuthor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1"></td>
                                                <td><input name="chkEditor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkEditor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1">
                                                </td>
                                                <td><input name="chkPublisher_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkPublisher_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1">
                                                </td>
                                                <td><input name="chkManager_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkManager_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1">
                                                </td>
                                              </tr>
                                    <?php
                                             }
                                          }
                                    ?>

                                            </table>
                                            </div>
                                          </li>
                                      </ul>
                                    <?php
                                    }
                                }
                            }
                            else
                            {
                                //$adminGLSql	= "CALL USP_ADMIN_GL('S','0','',@OUT);";
                                $adminGLResult	= $objLinks->manageAdminGLinks('S','0','');
                                if(mysqli_num_rows($adminGLResult)>0)
                                 {
                                    while($adminGLRow=mysqli_fetch_array($adminGLResult))
                                    {
                                        $adminGLId	= $adminGLRow['INT_ADMIN_GL_ID'];
                            ?>
				   <ul>
                        		<li><a href="javascript:void(0);" class="clickDiv" id="gl<?php echo $adminGLId;?>" onClick="showDiv(this.id,'tab<?php echo $adminGLId;?>');"><?php echo $adminGLRow['VCH_GL_NAME'];?></a>
                                        <input type="hidden" name="hdnGl_<?php echo $adminGLId;?>" id="hdnGl_<?php echo $adminGLId;?>" value="0">
                                        <input type="hidden" name="hdnPreGl_<?php echo $adminGLId;?>" id="hdnPreGl_<?php echo $adminGLId;?>" value="0">
                                        <div class="viewTable" id="tab<?php echo $adminGLId;?>" style="display:none;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                                <th width="200">&nbsp;</th>
                                                <th>Author Rights</th>
                                                <th>Editor Rights</th>
                                                <th>Publisher Rights</th>
                                                <th>Manager Rights</th>
                                          </tr>
                                            <?php
                                           // $adminPLSql	= "CALL USP_ADMIN_PL('S','0','$adminGLId','','',@OUT);";
                                            $adminPLResult	= $objLinks->manageAdminPLinks('S','0',$adminGLId,'','');
                                            
                                             if(mysqli_num_rows($adminPLResult)>0)
                                             {
                                                while($adminPLRow=mysqli_fetch_array($adminPLResult))
                                                {
                                                    $adminPLId	= $adminPLRow['INT_ADMIN_PL_ID'];
                                            ?>
                                                    <tr id="tr_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>">
                                                         <td><input name="chkBox_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkBox_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" disabled="disabled" value="0">														
                                                           <strong><?php echo $adminPLRow['VCH_PL_NAME'];?></strong>
                                                           <input name="hdn_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="hdn_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="hidden" value="0">
                                                           <input name="hdnPreVal_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="hdnPreVal_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="hidden" value="0">
                                                         </td>
                                                         <td><input name="chkAuthor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkAuthor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1"></td>
                                                         <td><input name="chkEditor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkEditor_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1">
                                                         </td>
                                                         <td><input name="chkPublisher_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkPublisher_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1">
                                                         </td>
                                                         <td><input name="chkManager_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" id="chkManager_<?php echo $adminGLId;?>_<?php echo $adminPLId;?>" type="checkbox" onClick="validCheck('<?php echo $adminGLId;?>','<?php echo $adminPLId;?>');" value="1">
                                                         </td>
                                                   </tr>
                                            <?php
                                                }
                                             }
                                            ?>

                                            </table>
                                           </div>
                                         </li>
                                       </ul>
                                  <?php
                                   }
                               }
                           }
                         ?>                    
                 
                    <input type="submit" name="btnSave" id="btnSave" value="Submit" class="btn btn-success" onclick="return validator();"/>
                    <input type="reset" name="btnReset" id="btnReset" value="Reset" class="btn btn-danger" />
               </div>
                
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
              
<script type="text/javascript">
    if('<?php echo $action;?>'=='U')
    {
           // $.fillName('SelDesignation', 'DdlName','<?php echo $intUserId;?>');
            fillPermission('<?php echo $intUserId;?>');
    }
</script>
