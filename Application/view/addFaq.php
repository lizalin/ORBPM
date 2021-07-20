<?php
/*================================================
	File Name         	: addFaq.php
	Description		: This is used for Faq. 
	Designed By		: Indrani Biswas
        Designed On		: 11-Nov-2020
        Devloped By		: Indrani Biswas
        Devloped On		: 11-Nov-2020
	Update History		: <Updated by>	<Updated On>	<Remarks>
       
	Style sheet              : datepicker.css,custom.css                                          
	Javscript Functions      : jquery.min.js,custom.js,validatorchklist.js,loadAjax.js,bootstrap-datepicker.min.js
	includes		 : header.php, navigation.php, util.php, footer.php,addFaqInner.php

==================================================*/
require 'addFaqInner.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css"/>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
    pageHeader   = "<?php echo $strTab; ?> FAQ";
    strFirstLink = "Manage Application";
    strLastLink  = "FAQ";
    
    $('[data-rel=tooltip]').tooltip();   

    <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>');
     <?php }if ($flag == 1 && $id != 0 && isset($_REQUEST['btnSubmit'])) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewFaq/<?php echo $glId; ?>/<?php echo $plId; ?>';
    <?php } ?>

    <?php if($_REQUEST["ID"]>0){?>
        $("#selChapter").val('<?php echo $intChapter;?>');
    <?php }?>
   
                
    });
        
    function validator(){
        
                  if(!selectDropdown('selChapter', 'Select Chapter'))
                    return false; 
                  if (!blankCheck('txtQuestion', 'Question can not be left blank'))
                    return false;
        
                  if (!checkSpecialChar('txtQuestion'))
                    return false;

                  if (!blankCheck('txtDes', 'Description can not be left blank'))
                    return false;
        
                  if (!checkSpecialChar('txtDes'))
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

            <div class="top_tab_container">
                <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> 
                <a href="<?php echo APP_URL; ?>viewFaq/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12"> 

            <div class="form-group" id="divChapter">
                <label class="col-sm-2 control-label no-padding-right" for="ddlChapter">Select Chapter</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="selChapter" id="selChapter">
                            <option value="0">-- Select --</option>  
                            <option value="1" >Chapter-1</option>
                            <option value="2" >Chapter-2</option>
                        </select>
                           <span class="mandatory">*</span>            
                    </div>
            </div>  
                    
                <div class="form-group" id="divQuestion">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtQuestion">Question </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtQuestion" name="txtQuestion" maxlength="200" placeholder="" class="form-control" value="<?php echo $strQuestion; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
               
                  <div class="form-group" id="divDes">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDes">Description</label>
                        <div class="col-sm-9">
                            <span class="colon">:</span>
                            <textarea class="form-control" id="txtDes" name="txtDes" rows="10"><?php echo $strDec; ?></textarea>
                            <span class="mandatory">*</span>
                        </div>
                    </div>  
            <div class="form-group">
                <div class="col-sm-3  col-lg-2 no-padding-right"></div>
                <div class="col-sm-4">
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $strSubmit; ?>" class="btn btn-success" onclick="return validator();"/>
                    <input type="reset" id="btnReset" name="btnReset"  class="btn btn-danger" value="<?php echo $strReset; ?>" onclick="<?php echo $strclick; ?>" />
                    <input type="hidden" id="hdnSlNo" name="hdnSlNo" value="<?php echo $intSlNo; ?>"/>
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

 
