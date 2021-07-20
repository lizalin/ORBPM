<?php
	/* ================================================
	File Name         	  : addSchemecategory.php
	Description		  : This is used for add Scheme Category.
	Designed By		  : 
        Designed On		  : 
        Devloped By		  : T Ketaki Debadarshini
        Devloped On		  : 17-Aug-2015
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
						
	Style sheet                 : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions          : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes			  :	header.php, navigation.php, util.php, footer.php,addSchemecategoryInner.php

	==================================================*/
	
     require 'addSchemecategoryInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
        $(document).ready(function () {
                //loadNavigation('<?php echo $strTab;?> Category');
                pageHeader   = "<?php echo $strTab; ?> Category";
                strFirstLink = "Manage Application";
                strLastLink  = "Scheme Category"; 
                
                $('#txtCategory').focus();
               
                indicate = 'yes';
             <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                alert('<?php echo $outMsg; ?>');
            <?php }if ($flag == 1 && $id != 0) { ?>
                        window.location.href = '<?php echo APP_URL; ?>viewSchemecategory/<?php echo $glId; ?>/<?php echo $plId; ?>';
            <?php } 
                   
            ?>
        
             TextCounter('txtDescription','lblChar1',500);
	});
        function validator()
            {
                            
                if (!blankCheck('txtCategory', 'Category can not be left blank'))
                    return false;
                if (!checkSpecialChar('txtCategory'))
                    return false;
                if (!maxLength('txtCategory',50, 'Category'))
                    return false;                
               if (!maxLength('txtDescription', 500,'Description'))
                    return false;
                 if (!checkSpecialChar('txtDescription'))
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
          <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab;?></a> <a href="<?php echo APP_URL;?>viewSchemecategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
           <div class="col-xs-12">              
            
              <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="txtCategory">Category Name </label>
                <div class="col-sm-4">
                <span class="colon">:</span>
                <input type="text" id="txtCategory" name="txtCategory" maxlength="50" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                  <span class="mandatory">*</span>
                </div>
              </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtDescription">Description</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <textarea class="form-control" id="txtDescription" name="txtDescription" style="height:100px;"  maxlength="250" onKeyUp="return TextCounter('txtDescription','lblChar1',500)" onMouseUp="return TextCounter('txtDescription','lblChar1',500)"><?php echo $strDescription;?></textarea>
                        <span class="red">Maximum <span id="lblChar1">500</span> characters </span>
                        
                    </div>
                </div> 	  
             <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right">Publish Status</label>
                <div class="col-sm-8">
                <span class="colon">:</span>
                 <div class="radio">
                    <label>
                        <input type="radio" name="radStatus" id="radStatus" class="ace" value="2" <?php if ($intStatus == 2) { ?>checked="checked" <?php } ?>/>
                        <span class="lbl"> Active</span>
                    </label>
                    <label>
                       <input type="radio" name="radStatus" id="radStatus" class="ace" value="1" <?php if ($intStatus == 1) { ?>checked="checked" <?php } ?>/>
                        <span class="lbl"> Inactive</span>
                    </label>
                     
                </div>
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

 
