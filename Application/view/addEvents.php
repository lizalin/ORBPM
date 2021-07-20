<?php
/*================================================
	File Name         	: addEvents.php
	Description		: This is used for adding events cms. 
	Designed By		: Indrani Biswas
    Designed On		: 10-Dec-2020
    Devloped By		: Indrani Biswas
    Devloped On		: 10-Dec-2020
	Update History		: <Updated by>	<Updated On>	<Remarks>
       
	Style sheet              : datepicker.css,custom.css                                          
	Javscript Functions      : jquery.min.js,custom.js,validatorchklist.js,loadAjax.js,bootstrap-datepicker.min.js
	includes		 : header.php, navigation.php, util.php, footer.php,addEventsInner.php

==================================================*/
require 'addEventsInner.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/bootstrap-timepicker.css"/>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-timepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
    pageHeader   = "<?php echo $strTab; ?> Events";
    strFirstLink = "Manage Application";
    strLastLink  = "Events";
    
    $('[data-rel=tooltip]').tooltip();   

    <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>','','<?php echo APP_URL; ?>viewEvents/<?php echo $glId; ?>/<?php echo $plId; ?>');
     <?php } ?>

     $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
    });

    $('.time-picker').timepicker({
        format: 'hh:mm:ss',
        showMeridian: false
    });

    <?php if($id==0){?>
      $('#txtFromTime').val('');
      $('#txtToTime').val('');
      <?php }?>
      
    });
        
    function validator(){

        var startdate = $('#txtFromDate').val();
        var enddate = $('#txtToDate').val(); 
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
        
        if (!blankCheck('txtTitleE', 'Title in english can not be left blank'))
        return false;
        
        if (!checkSpecialChar('txtTitleE'))
        return false; 

        if (!maxLength('txtTitleE',250, 'Title in english'))
        return false;

        if (!blankCheck('txtSource', 'Source can not be left blank'))
        return false;

        if (!checkSpecialChar('txtSource'))
        return false;

        if (!validURL('txtSource', 'Please enter a valid URL(Ex : http://www.google.com) for Source Url'))
        return false;

        if (!blankCheck('txtFromDate', 'Start Date can not be left blank'))
        return false;

        if(startdate.length>0){
          if(sDate<todaydt){
            viewAlert('Start Date must be greater than Current date');
            return false;
        }}

        if(!blankCheck('txtFromTime','Start Time can not be left blank'))
        return false;  

        if (!blankCheck('txtToDate', 'End Date can not be left blank'))
        return false;  

        if(enddate.length>0){
          if(eDate<todaydt){
            viewAlert('End Date must be greater than Current date');
            return false;
        }}

        if(!blankCheck('txtToTime','End Time can not be left blank'))
        return false;

        if(startdate.length>0 && enddate.length>0){
          if(enddate<startdate){
           viewAlert('End Date must be greater than or equal to Start date');
            return false; 
        }}

        if (!blankCheck('txtLocation', 'Location can not be left blank'))
        return false;
        
        if (!checkSpecialChar('txtLocation'))
        return false; 

        if (!maxLength('txtLocation',250, 'Location'))
        return false;
   
        if (!blankCheck('txtDetailsE', 'Description in english can not be left blank'))
        return false;
        
        if (!checkSpecialChar('txtDetailsE'))
        return false; 

        if (!maxLength('txtDetailsE',500, 'Description in english'))
        return false;

        <?php if($id == 0){?>
        if (!blankCheck('fileImage', 'Please upload Image'))
        return false;
        <?php } ?> 

        if ($('#fileImage').val() != '')
        {
              if (!IsCheckFile('fileImage', 'Invalid file types for Upload Image. Upload only ', 'jpg,jpeg,png'))
              return false;
              var imgfileSize_inKB = Math.round(($("#fileImage")[0].files[0].size / 1024));
              if (imgfileSize_inKB > 51200)
              {
               viewAlert('Image File size cannot be more than 10 MB.');
               return false;
              }
        }
                                        
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
                <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab ?></a> 
                <a href="<?php echo APP_URL; ?>viewEvents/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">

              <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="selScreen" id="selScreen">
                            <option value="0" <?php if ($intscreenType == 0) echo 'selected="selected"'; ?>>- Select -</option>  
                            <option value="1" <?php if ($intscreenType == 1) echo 'selected="selected"'; ?>>Cultural Events</option>
                            <option value="2" <?php if ($intscreenType == 2) echo 'selected="selected"'; ?>>Your Safety Our Concern</option>
                        </select>
                           <span class="mandatory">*</span>            
                    </div>
                 
                <div class="form-group" id="divtitleE">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtTitleE">Title in English </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTitleE" name="txtTitleE" maxlength="250" placeholder="" class="form-control" value="<?php echo $strTitleE; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div> 
                 <!-- <div class="form-group" id="divtitleO">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtTitleO">Title in Odia</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTitleO" name="txtTitleO" maxlength="250" placeholder="" class="form-control akrutiorisarala" value="<?php echo $strTitleO; ?>">

                    </div>
                </div> --> 
                   <div class="form-group" id="divSource">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtSource">Source Url</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtSource" name="txtSource" maxlength="250" placeholder="" class="form-control" value="<?php echo $strSource; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                 <div class="form-group" id="divFromDateTime">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtFromDate"> Start Date & Time</label>
                    <div class="col-sm-2">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtFromDate" id="txtFromDate" class="form-control date-picker" value="<?php echo $strfromdate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div> 
                        <!-- <span class="mandatory">*</span> -->
                    </div>
               
                    <!-- <label class="col-sm-3  col-lg-1 control-label no-padding-right" for="txtFromTime"> Start Time</label> -->
                    <div class="col-sm-2">
                        <div class="input-group">
                            <input type="text" name="txtFromTime" id="txtFromTime" class="form-control time-picker" value="<?php echo $strfromtime; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o bigger-110"></i>
                            </span>
                        </div> 
                        <span class="mandatory">*</span>
                    </div>
                </div>
                  <div class="form-group" id="divToDatetime">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtToDate"> End Date & Time</label>
                    <div class="col-sm-2">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtToDate" id="txtToDate" class="form-control date-picker" value="<?php echo $strtodate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div> 
                        <!-- <span class="mandatory">*</span> -->
                    </div>
                
                    <!-- <label class="col-sm-3  col-lg-1 control-label no-padding-right" for="txtToTime"> End Time</label> -->
                    <div class="col-sm-2">
                        <div class="input-group">
                            <input type="text" name="txtToTime" id="txtToTime" class="form-control time-picker" value="<?php echo $strtotime; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o bigger-110"></i>
                            </span>
                        </div> 
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group" id="divLocation">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtSource">Event Location </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtLocation" name="txtLocation" maxlength="250" placeholder="" class="form-control" value="<?php echo $strLocation; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group" id="divContentEn">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDetailsE">Description in English</label>
                        <div class="col-sm-4">
                            <span class="colon">:</span>
                            <textarea class="form-control" id="txtDetailsE" name="txtDetailsE" rows="3" maxlength="500"><?php echo $strDetailsE; ?></textarea>
                             <span class="mandatory">*</span>
                        </div>
                </div>  
                <!-- <div class="form-group" id="divContentO">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDetailsO">Description in Odia</label>
                        <div class="col-sm-4">
                            <span class="colon">:</span>
                            <textarea class="form-control akrutiorisarala" id="txtDetailsO" name="txtDetailsO" rows="3" maxlength="500"><?php echo $strDetailsO; ?></textarea>

                        </div>
                </div> --> 

              <div class="form-group">
                      <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="fileImage">Upload Image</label>
                      <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="file" id="fileImage" name="fileImage" placeholder="" class="form-control">
                          <span class="mandatory">*</span>
                            <small><span class="red">( .jpg,.jpeg,.png file only and Max size file Size 10 MB )</span></small>
                          <input type="hidden" name="hdnImgFile" id="hdnImgFile" value="<?php echo $strImgName; ?>"/>
                       </div>
                      <?php
                      if ($id != '' && $strImgName != '') {
                          $display = '';
                      } else {
                          $display = 'style="display:none;"';
                      }
                      if ($strImgName != '') {   
                         ?>
                              <img id="imageFile" src="<?php echo APP_URL ?>uploadDocuments/Events/<?php echo $strImgName; ?>" alt="<?php echo $strImgName; ?>" width="100" height="100" <?php echo $display; ?> /> 
                      <?php } ?>               
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

 
