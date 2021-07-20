<?php
/*================================================
	File Name       : addMessage.php
	Description		: This is used for giving instruction to contactus left pane pages. 
	Designed By		: Indrani Biswas
    Designed On		: 23-Dec-2020
    Devloped By		: Indrani Biswas
    Devloped On		: 23-Dec-2020
	Update History		: <Updated by>	<Updated On>	<Remarks>
       
	Style sheet              : datepicker.css,custom.css                                          
	Javscript Functions      : jquery.min.js,custom.js,validatorchklist.js,loadAjax.js,bootstrap-datepicker.min.js
	includes		 : header.php, navigation.php, util.php, footer.php,addInstructionInner.php

==================================================*/
require 'addMessageInner.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css"/>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
    pageHeader   = "<?php echo $strTab; ?> Message";
    strFirstLink = "Manage Application";
    strLastLink  = "Message";
    
    $('[data-rel=tooltip]').tooltip();   

    <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>','','<?php echo APP_URL; ?>viewMessage/<?php echo $glId; ?>/<?php echo $plId; ?>');
     <?php } ?>
               
    });
        
    function validator(){

        if(!selectDropdown('selPageType', 'Select Page Type'))
        return false;
          
        if (!blankCheck('txtContent', 'Content can not be left blank'))
        return false;
        
        if (!checkSpecialChar('txtContent'))
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
                <a href="<?php echo APP_URL; ?>viewMessage/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                <div class="form-group" id="divPageType">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="selPageType">Page Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="selPageType" id="selPageType" >
                            <option value="0" <?php if ($selPageType == 0) echo 'selected="selected"'; ?> >- Select -</option>  
                            <option value="1" <?php if ($selPageType == 1) echo 'selected="selected"'; ?>>Compliment</option>
                            <option value="2" <?php if ($selPageType == 2) echo 'selected="selected"'; ?>>Complaint</option>
                            <option value="3" <?php if ($selPageType == 3) echo 'selected="selected"'; ?>>Feedback</option>
                        </select>
                           <span class="mandatory">*</span>            
                    </div>
                </div>                   
                <div class="form-group" id="divContent">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtContentE">Message in English</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <textarea class="form-control" id="txtContentE" name="txtContentE" rows="3" maxlength="750"><?php echo $txtContentE; ?></textarea>
                        <span class="mandatory">*</span>
                        <small><span class="red">(750 Charcaters allowed)</span></small>
                    </div>
                </div>
                <div class="form-group" id="divContentO">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtContentO">Message in Odia</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <textarea class="form-control akrutiorisarala" id="txtContentO" name="txtContentO" rows="3" maxlength="750"><?php echo $txtContentO; ?></textarea>
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

 
