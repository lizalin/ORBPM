<?php
	/* ================================================
	File Name         	  : addGallerycategory.php
	Description		  : This is used for add Gallery Category.
	Designed By		  : Chinmayee
        Designed On		  : 25-May-2016
        Devloped By		  : Chinmayee
        Devloped On		  : 26-May-2016
	Update History		  : <Updated by>		<Updated On>		<Remarks>
						
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes		  : header.php, navigation.php, util.php, footer.php,addGallerycategoryInner.php

	==================================================*/
     require 'addImportantServicescategoryInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
        $(document).ready(function () {
                pageHeader   = "<?php echo $strTab; ?> Important Service Category";
                strFirstLink = "Manage Application";
                strLastLink  = "Important Service Category"; 
                $('#ddlType').focus();
                indicate = 'yes';
                fillgalleryplugin('ddlPlugin',<?php echo $selplugintype;?>);
                <?php  if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                viewAlert('<?php echo $outMsg; ?>');
            <?php  }if ($flag == 1 && $id != 0) { ?>
                        window.location.href = '<?php echo APP_URL; ?>viewImpServicecategory/<?php echo $glId; ?>/<?php echo $plId; ?>';
            <?php  } ?>
	});
         function validator()
            {
                if(!selectDropdown('ddlType', 'Select Type'))
                    return false;      
                    
                if (!blankCheck('txtCategory', 'Category can not be left blank'))
                    return false;
                if (!checkSpecialChar('txtCategory'))
                    return false;
                if (!maxLength('txtCategory',70, 'Category'))
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
              <div class="srvc_hdr_nav pull-right" style="right: 210px;">
                  <a href="<?php echo APP_URL; ?>viewImpServices/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm " >Important Services</a>
                  <a href="javascript:void(0);" class="btn btn-success btn-sm active">Category</a>
              </div>
              <div class="clearfix"></div>
              <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> <a href="<?php echo APP_URL; ?>viewImpServiceCategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>

              <?php include('includes/util.php'); ?>
              <div class="hr hr-solid"></div>
              <div class="col-xs-12">              
                 
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="txtCategory">Category Name In English</label>
                      <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="text" id="txtCategory" name="txtCategory" maxlength="80" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                          <span class="mandatory">*</span>
                      </div>
                  </div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="txtCategory">Category Name  In Odia</label>
                      <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="text" id="txtCategoryO" name="txtCategoryO" maxlength="80" placeholder="" class="form-control akrutiorisarala" value="<?php echo $strCategoryO; ?>">
                        
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="radStatus">Publish Status</label>
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

 
