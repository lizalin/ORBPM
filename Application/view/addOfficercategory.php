<?php
/* ================================================
	File Name         	  : addOfficercategory.php
	Description		  : This is used for add Officer Category.
	Designed By		  : Rajesh Kumar Sahoo
        Designed On		  : 21-May-2021
        Devloped By		  : Rajesh Kumar Sahoo
        Devloped On		  : 21-May-2021
	Update History		  : <Updated by>		<Updated On>		<Remarks>
						
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes		  : header.php, navigation.php, util.php, footer.php,addGallerycategoryInner.php

	==================================================*/
require 'addOfficercategoryInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function() {
        pageHeader = "<?php echo $strTab; ?> Officer Category";
        strFirstLink = "Manage Application";
        strLastLink = "Officer Category";
        $('#txtCategory').focus();
        indicate = 'yes';

        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>');
        <?php  }
        if ($flag == 1 && $id != 0) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewOfficercategory/<?php echo $glId; ?>/<?php echo $plId; ?>';
        <?php  } ?>
    });

    function validator() {

        if (!blankCheck('txtCategory', 'Category can not be left blank'))
            return false;
        if (!checkSpecialChar('txtCategory'))
            return false;
        if (!maxLength('txtCategory', 70, 'Category'))
            return false;
        if (!blankCheck('intOrderno', 'Order No can not be left blank'))
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
                <a href="<?php echo APP_URL; ?>viewOfficers/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm ">Raj Bhavan Officers</a>
                <a href="javascript:void(0);" class="btn btn-success btn-sm active">Category</a>
            </div>
            <div class="clearfix"></div>
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> <a href="<?php echo APP_URL; ?>viewOfficercategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtCategory">Category Name </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtCategory" name="txtCategory" maxlength="80" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group">
					<label class="col-sm-3  col-lg-2 control-label no-padding-right" for="intOrderno">Order No</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="integer" id="intOrderno" Name="intOrderno" placeholder="" class="form-control" onKeyPress="return isNumberKey(event);"  value="<?php echo $intOrderno; ?>">
						<span class="mandatory">*</span>
					</div>
				</div>
                <div class="form-group">
                    <div class="col-sm-2 no-padding-right"></div>
                    <div class="col-sm-4">
                        <input type="hidden" id="intStatus" name="intStatus" value="<?php echo (isset($intStatus)) ? $intStatus : 0; ?>">
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