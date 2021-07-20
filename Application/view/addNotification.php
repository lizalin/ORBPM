<?php
/*================================================
	File Name         	: addNotification.php
	Description		: This is used for Notification /Tender / Route Rationalization 
                                /Guideline for Public.
	Designed By		: Sonali Satapathy
        Designed On		: 29-SEPT-2016
        Devloped By		: Sonali Satapathy
        Devloped On		: 29-SEPT-2016
	Update History		: <Updated by>	<Updated On>	<Remarks>
       
	Style sheet              : datepicker.css,custom.css                                          
	Javscript Functions      : jquery.min.js,custom.js,validatorchklist.js,loadAjax.js,bootstrap-datepicker.min.js
	includes		 : header.php, navigation.php, util.php, footer.php,addNotification.php

==================================================*/
require 'addNotificationInner.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css" />
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo APP_URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function() {
        pageHeader = "<?php echo $strTab; ?>  Tender";
        strFirstLink = "Manage Application";
        strLastLink = "Tender";
        $('[data-rel=tooltip]').tooltip();
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>');
        <?php }
        if ($flag == 0 && $id != 0 && isset($_REQUEST['btnSubmit'])) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewNotification/<?php echo $glId; ?>/<?php echo $plId; ?>';
        <?php } ?>
    });

    function validator() {
        
        if (linkType == 1 || linkType == 2) {
            if (!blankCheck('txtrandNum', 'Code number can not be left blank'))
                return false;
            if (!validateCharNumber('txtrandNum', 'Code No. '))
                return false;
            if (!checkSpecialChar('txtrandNum'))
                return false;

        }
        

        if (!blankCheck('txtStartDate', 'Start Date can not be left blank'))
            return false;

        if (!blankCheck('txtEndDate', 'End Date can not be left blank'))
            return false;

        if (!compareDate('txtStartDate', 'txtEndDate', 'Opening Date', 'Closing Date'))
            return false;
        if (($('#fileDocument1').val() == "") && ($('#hdnDocFile1').val() == "")) {
            viewAlert('Please Upload one Document File');
            return false;
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
                <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a>
                <a href="<?php echo APP_URL; ?>viewNotification/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                <a href="<?php echo APP_URL; ?>arhiveNotification/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a>
            </div>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                <div class="form-group" id="txtTenderNo">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCategory">Tender Number</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTenderNo" name="txtTenderNo" maxlength="200" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group" id="txtTenderNo">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCategory">Tender Title</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTenderNo" name="txtTenderNo" maxlength="200" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>

                <div class="form-group" id="txtheadE">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCategory">Tender Description </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtCategory" name="txtCategory" maxlength="200" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                
                <div class="form-group" id="tenderopen-dates">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtclosingDate"> Last Submission Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtEndDate" id="txtEndDate" class="form-control date-picker" value="<?php echo $strEnddate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>

                        </div> <span class="mandatory">*</span>
                    </div>
                </div>

                <div class="form-group" id="tenderopen-date">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtOpeningDate"> Opening Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtStartDate" id="txtStartDate" class="form-control date-picker" value="<?php echo $strstartdate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>

                        </div> <span class="mandatory">*</span>
                    </div>

                </div>
                
                <div class="form-group morePayPercentage filedocs" id="divuploadDocument">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="fileDocument" id="docLevel">Upload Document <span class="perInstNo"></span></label>
                    <div class="col-sm-8">
                        <span class="colon">:</span>
                        <div class="col-sm-6 padding-left0">
                            <input type="file" id="fileDocument1" name="fileDocument[]" placeholder="" class="percentageVal form-control docfile">
                            <input type="hidden" name="hdnDocFile[]" id="hdnDocFile1" value="<?php echo $strFileName; ?>" class="hdnpercentageVal form-control" />
                            <input type="hidden" name="hdnTotalDoc" id="hdnTotalDoc" value="" />
                            <span class="mandatory">*</span>
                            <small> <span class="red">(.pdf file only and Max size file Size 16 MB)</span></small>
                        </div>
                        
                    </div>

                    <?php
                    if ($id != '' && $strFileName != '') {
                        $display = '';
                    } else {
                        $display = 'style="display:none;"';
                    }
                    if ($strFileName != '') {
                    ?>
                        <a href="<?php echo APP_URL ?>uploadDocuments/Notification/<?php echo $strFileName; ?>" target="_blank" class="imageFile">
                            <img id="imageFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strFileName; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                    <?php } ?>


                </div>
               
            </div>
            <div class="form-group">
                <div class="col-sm-3  col-lg-2 no-padding-right"></div>
                <div class="col-sm-4">
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $strSubmit; ?>" class="btn btn-success" onclick="return validator();" />
                    <input type="reset" id="btnReset" name="btnReset" class="btn btn-danger" value="<?php echo $strReset; ?>" onclick="<?php echo $strclick; ?>" />
                    <input type="hidden" id="hdnSlNo" name="hdnSlNo" value="<?php echo $intSlNo; ?>" />
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
