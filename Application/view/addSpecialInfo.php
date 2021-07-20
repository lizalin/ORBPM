<?php
/*================================================
	File Name         	: addSpecialInfo.php
	Description		: This is used for special information in Home page marquee. 
	Designed By		: Indrani Biswas
    Designed On		: 26-Nov-2020
    Devloped By		: Indrani Biswas
    Devloped On		: 26-Nov-2020
	Update History		: <Updated by>	<Updated On>	<Remarks>
       
	Style sheet              : datepicker.css,custom.css                                          
	Javscript Functions      : jquery.min.js,custom.js,validatorchklist.js,loadAjax.js,bootstrap-datepicker.min.js
	includes		 : header.php, navigation.php, util.php, footer.php,addSpecialInfoInner.php

==================================================*/
require 'addSpecialInfoInner.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css"/>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
    pageHeader   = "<?php echo $strTab; ?> Special Info";
    strFirstLink = "Manage Application";
    strLastLink  = "Special Info";
    
    $('[data-rel=tooltip]').tooltip();   

    <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>','','<?php echo APP_URL; ?>viewSpecialInfo/<?php echo $glId; ?>/<?php echo $plId; ?>');
     <?php } ?>

     $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
    });
               
    });
        
    function validator(){

        var startdate = $('#txtStartDate').val();
        var enddate = $('#txtEndDate').val(); 
        /* For date validation(start and end date must be greater than current date) */ 
        var ddS = startdate.substring(0, 2);
        var mmS = startdate.substring(3, 5);
        var yyS = startdate.substring(6, 10); 

        var ddE = enddate.substring(0, 2);
        var mmE = enddate.substring(3, 5);
        var yyE = enddate.substring(6, 10);

        var sDate = new Date(yyS, mmS - 1, ddS);
        var eDate = new Date(yyE, mmE - 1, ddE);
        var todaydt = new Date();
        //End
          
        if (!blankCheck('txtTitle', 'Title can not be left blank'))
        return false;
        
        if (!checkSpecialChar('txtTitle'))
        return false; 

        if(startdate.length>0){
          if(sDate<todaydt){
            viewAlert('Start Date must be greater than Current date');
            return false;
        }}

        if(enddate.length>0){
          if(eDate<todaydt){
            viewAlert('End Date must be greater than Current date');
            return false;
        }}

        if(startdate.length>0 && enddate.length>0){
          if(enddate<startdate){
           viewAlert('End Date must be greater than or equal to Start date');
            return false; 
        }}       
                
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
                <a href="<?php echo APP_URL; ?>viewSpecialInfo/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                    
                <div class="form-group" id="divTitle">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtMsg">Message </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTitle" name="txtTitle" maxlength="500" placeholder="" class="form-control" value="<?php echo $txtTitle; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                 <div class="form-group" id="divStartDate">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtOpenDate"> Start Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtStartDate" id="txtStartDate" class="form-control date-picker" value="<?php echo $txtStartDate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>

                        </div> 
                    </div>
                </div>
                 <div class="form-group" id="divEndDate">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtCloseDate"> End Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtEndDate" id="txtEndDate" class="form-control date-picker" value="<?php echo $txtEndDate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>

                        </div> 
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

 
