<?php
/* ================================================
  File Name         	  : addTender.php
  Description		  : This is used for add Tender details.
  Designed By		  :
  Designed On		  : 
  Devloped By             : T Ketaki Debadarshini
  Devloped On             : 11-Sept-2015
  Update History	:	<Updated by>		<Updated On>		<Remarks>
  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
  includes	       :	header.php, navigation.php, util.php, footer.php,addTenderInner.php

  ================================================== */

require 'addTenderInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<link rel="stylesheet" href="<?php echo APP_URL; ?>css/datepicker.css">
<script language="javascript">
    $(document).ready(function() {

        pageHeader = "<?php echo $strTab; ?> Tender";
        strFirstLink = "Manage Application";
        strLastLink = "Tender";

        indicate = 'yes';
        $('#txtHeadlineE').focus();
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        TextCounter('txtDetails', 'lblChar', 500);

        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>', '', '<?php echo $redirectLoc; ?>');
        <?php }
        /*if ($flag == 0 && $id != 0 && isset($_REQUEST['btnSubmit'])) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewTender/<?php echo $glId; ?>/<?php echo $plId; ?>';
        <?php } */?>
        <?php if ($id == '0') { ?>
            $('#userImage').hide();
        <?php } ?>
    });

    function validator() {
        if (!blankCheck('txtTenderNo', 'Tender No can not be left blank'))
            return false;
        if (!checkSpecialChar('txtTenderNo'))
            return false;
        if (!maxLength('txtTenderNo', 50, 'Tender No '))
            return false;
        if (!blankCheck('txtHeadline', 'Headline can not be left blank'))
            return false;
        if (!checkSpecialChar('txtHeadline'))
            return false;
        if (!maxLength('txtHeadline', 300, 'Headline '))
            return false;

        if (!blankCheck('txtOpeningDate', 'Opening Date can not be left blank'))
            return false;
        if (!checkSpecialChar('txtOpeningDate'))
            return false;
        if (!compareCurDate('txtOpeningDate', 'Opening Date', 'l'))
            return false;

        if (!blankCheck('txtClosingDate', 'Closing Date can not be left blank'))
            return false;
        if (!checkSpecialChar('txtClosingDate'))
            return false;
        if (!compareCurDate('txtClosingDate', 'Closing Date', 'l'))
            return false;
        
        if (!compareDate('txtOpeningDate', 'txtClosingDate', 'Closing Date', 'Opening Date', 'Closing Date can not be less than Opening Date'))
            return false;

        <?php if ($id == 0) { ?>
            if (!blankCheck('fileTender', 'Tender File can not be left blank.'))
                return false;
        <?php } ?>
        if ($('#fileTender').val() != '') {
            if (!IsCheckFile('fileTender', 'Invalid file types. Upload only ', 'pdf,doc,docx'))
                return false;
            var fileSize_inKB = Math.round(($("#fileTender")[0].files[0].size / 1024));
            if (fileSize_inKB > 10240) {
                alert('File size cannot be more than 10MB.');
                return false;
            }
        }

        if (!blankCheck('txtDetails', 'Description can not be left blank'))
            return false;
        if (!checkSpecialChar('txtDetails'))
            return false;
        if (!maxLength('txtDetails', 500, 'Description'))
            return false;

    }
</script>
<script src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<div class="page-content">
    <div class="page-header">
        <h1 id="title"></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a>
                <a href="<?php echo APP_URL; ?>viewTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                <a href="<?php echo APP_URL; ?>archieveTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a>
            </div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>

            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtTenderNo">Tender No.</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTenderNo" name="txtTenderNo" maxlength="50" placeholder="" class="form-control" value="<?php echo $strTenderNo; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtHeadline">Tender Headline</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtHeadline" name="txtHeadline" maxlength="500" placeholder="" class="form-control" value="<?php echo $strHeadLine; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtOpeningDate">Opening Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtOpeningDate" id="txtOpeningDate" class="form-control date-picker" value="<?php echo $strOpeningDate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                            
                        </div>
                        <span class="mandatory">*</span>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtClosingDate">Closing Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtClosingDate" id="txtClosingDate" class="form-control date-picker" value="<?php echo $strClosingDate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                           
                        </div>
                        <span class="mandatory">*</span>
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="fileTender">Upload Document</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileTender" name="fileTender" placeholder="" class="form-control">
                        <input type="hidden" name="hdnTenderFile" id="hdnTenderFile" value="<?php echo $strTenderFile; ?>" />
                    </div>
                    <?php
                    if ($id != '' && $strTenderFile != '') {
                        $display = '';
                    } else {
                        $display = 'style="display:none;"';
                    }
                    if ($strTenderFile != '') {
                    ?>
                        <a href="<?php echo APP_URL ?>uploadDocuments/Tender/<?php echo $strTenderFile; ?>" target="_blank" <?php echo $display; ?>>
                            <img id="imageFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strTenderFile; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                    <?php } ?>

                    <span class="red">* (.pdf,.doc,.docx file only and Max size file Size 10 MB)</span>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtDetails">Description </label>
                    <div class="col-sm-5">
                        <span class="colon">:</span>
                        <textarea class="form-control" id="txtDetails" name="txtDetails" rows="3" onKeyUp="return TextCounter('txtDetails','lblChar',500)" onMouseUp="return TextCounter('txtDetails','lblChar',500)"><?php echo $strDescription; ?></textarea>
                        <span class="mandatory">*</span><span class="red">Maximum <span id="lblChar"> 500 </span> characters</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 no-padding-right"></div>
                    <div class="col-sm-4">
                        <input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $strSubmit; ?>" class="btn btn-success" onclick="return validator();" />
                        <input type="reset" id="btnReset" name="btnReset" class="btn btn-danger" value="<?php echo $strReset; ?>" onclick="<?php echo $strclick; ?>" />
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