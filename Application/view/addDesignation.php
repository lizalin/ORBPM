<?php
	/* ================================================
	File Name         	  : addDesignation.php
	Description		  : This is used for add department details
	Designed By		  : 
        Designed On		  : 
        Devloped By		  : T Ketaki Debadarshini
        Devloped On		  : 10-Sept-2015
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
						
	Style sheet                 : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions          : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes			  :	header.php, navigation.php, util.php, footer.php,addDesignationInner.php

	==================================================*/
	
     require 'addDesignationInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
        $(document).ready(function () {
               
                pageHeader   = "<?php echo $strTab; ?> Designation";
                strFirstLink = "Manage Application";
                strLastLink  = "Designation"; 
                
                fillLocation('<?php echo $intLocation;?>','ddlLocation');
                //fillDepartment('<?php echo $intDepartment;?>','ddlDepartment');
                getDepartments('<?php echo $intLocation;?>','ddlDepartment','<?php echo $intDepartment;?>');
                
                $('#txtDesignation').focus();              
                indicate = 'yes';
             <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                alert('<?php echo $outMsg; ?>');
            <?php }if ($flag == 1 && $id != 0) { ?>
                        window.location.href = '<?php echo APP_URL; ?>viewDesignation/<?php echo $glId; ?>/<?php echo $plId; ?>';
            <?php }   ?>
        
	});
        function validator()
            {
                 if(!selectDropdown('ddlLocation','Select Location'))
                    return false;    
                if(!selectDropdown('ddlDepartment','Select Department'))
                    return false;  
                if (!blankCheck('txtDesignation', 'Designation Name can not be left blank'))
                    return false;
                if (!checkSpecialChar('txtDesignation'))
                    return false;
                if (!maxLength('txtDesignation',50, 'Designation'))
                    return false;                
              

            }
           
  </script>
    <div class="page-content">
      <div class="page-header">
        <h1 id="title"></h1>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
          <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab;?></a> <a href="<?php echo APP_URL;?>viewDesignation/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
           <div class="col-xs-12">     
               <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="ddlLocation">Select Location</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="ddlLocation" id="ddlLocation" onChange="getDepartments(this.value,'ddlDepartment',0);">
                            <option value="0">- Select -</option>  
                        </select>
                                      
                    </div><span class="red"> *</span> 
                </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="ddlDepartment">Select Department</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="ddlDepartment" id="ddlDepartment">
                            <option value="0">- Select -</option>  
                        </select>
                                      
                    </div><span class="red"> *</span> 
                </div>
               
              <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="txtDesignation">Designation  </label>
                <div class="col-sm-4">
                <span class="colon">:</span>
                <input type="text" id="txtDesignation" name="txtDesignation" maxlength="50" placeholder="" class="form-control" value="<?php echo $strDesignation; ?>">
                  <span class="mandatory">*</span>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-2 no-padding-right"></div>
                <div class="col-sm-4">
                  <input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $strSubmit; ?>" class="btn btn-success" onclick="return validator();"/>
                  <input type="reset" id="btnReset" name="btnReset"  class="btn btn-danger" value="<?php echo $strReset; ?>" onclick="<?php echo $strclick; ?>" />
                </div>
              </div>
            </div>
          <div class="hr hr32 hr-dotted"></div>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.page-content -->

 
