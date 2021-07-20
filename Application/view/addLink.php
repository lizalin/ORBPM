<?php
/* ================================================
  File Name         	  : addLink.php
  Description		  : This is used for add act and Link details.
  Designed By		  : T Ketaki Debadarshini
  Designed On		  : 04-Sept-2015
  Devloped By             : T Ketaki Debadarshini
  Devloped On             : 04-Sept-2015
  Update History		  :	<Updated by>		<Updated On>		<Remarks>

  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
  includes			  :	header.php, navigation.php, util.php, footer.php,addLinkInner.php

  ================================================== */

require 'addLinkInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function() {
        $('#btnConfirmOk').on('click', function() {
            $('form').submit();
        });
        pageHeader = "<?php echo $strTab; ?> Important Links";
        strFirstLink = "Manage Application";
        strLastLink = "Important Link";

        indicate = 'yes';
        $('#txtHeadlineE').focus();

        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>');
        <?php }
        if ($flag == 0 && $id != 0 && isset($_REQUEST['btnSubmit'])) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewLink/<?php echo $glId; ?>/<?php echo $plId; ?>';
        <?php } ?>
        
    });

    function validator() {

        if (!blankCheck('txtHeadlineE', 'Link Name can not left blank'))
            return false;
        if (!checkSpecialChar('txtHeadlineE'))
            return false;
        if (!maxLength('txtHeadlineE', 50, 'Headline'))
            return false;

        if (!blankCheck('txtURL', 'URL can not left blank'))
            return false;
            
        if (!validURL('txtURL','Provide valid URL'))
            return false;

        var url = $.trim($('#txtURL').val());
        var url = url.replace("http://", '');

    }
</script>
<div class="page-content">
    <div class="page-header">
        <h1 id="title"></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> <a href="<?php echo APP_URL; ?>viewLink/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a> <a href="<?php echo APP_URL; ?>archieveLink/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">

                <div class="form-group">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtHeadlineE">Link Name</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtHeadlineE" name="txtHeadlineE" maxlength="300" placeholder="" class="form-control" value="<?php echo $strHeadLineE; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtURL">URL</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtURL" name="txtURL" placeholder="" class="form-control" value="<?php echo $strURL; ?>">

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3  col-lg-2 no-padding-right"></div>
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