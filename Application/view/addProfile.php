<?php
/* ================================================
	File Name       : addProfile.php
	Description		  : This is used for add Employee Profile.
	Designed By		  : Dharashree Mohapatra
  Designed On		  : 
  Devloped By     : 
  Devloped On     : 
	Update History		    :	<Updated by>		<Updated On>		<Remarks>
	
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js,validatorchklist.js
	includes		  :	header.php, navigation.php, util.php, footer.php,addProfileInner.php

	==================================================*/
require 'addProfileInner.php';

?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
	$(document).ready(function() {
		pageHeader = "<?php echo $strTab; ?> Officer Profile";
		strFirstLink = "Manage Application";
		strLastLink = "Former Officers Profile";
		loadNavigation('<?php echo $strTab; ?> Officers Profile');
		indicate = 'yes';
		$('#selType').focus();

		<?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
			viewAlert('<?php echo $outMsg; ?>', '', '<?php echo $redirectLoc; ?>');
		<?php } ?>

		<?php if ($strImageFile == '') { ?>
			$('#userImage').hide();
		<?php } else { ?>
			$('#imgMsg').css('margin-left', '110px');
		<?php } ?>
		$("#userImgClose").click(function() {
			if (confirm("Are you sure to delete the image.")) {
				$("#hdnImageFile").val('');
				$('#userImage').remove();
				$('#imgMsg').css('margin-left', '');
				$(this).hide();
			}
		});
	});

	function readImage(input) {
		$('#userImage').show();
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#userImage').attr('src', e.target.result);
				$('#imgMsg').css('margin-left', '110px');
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	function validator() {
		if (!blankCheck('selType', 'Officer Type can not left blank'))
			return false;
		if (!blankCheck('vchOfficerName', 'Officer Name can not left blank'))
			return false;
		if (!checkSpecialChar('vchOfficerName'))
			return false;
		if (!maxLength('vchOfficerName', 100, 'Officer Name'))
			return false;

		/* if (!blankCheck('txtFromDate', 'Joining Date can not be left blank'))
            return false; */
        if (!checkSpecialChar('txtFromDate'))
            return false;
        

        /* if (!blankCheck('txttoDate', 'Leaving Date can not be left blank'))
            return false; */
        if (!checkSpecialChar('txttoDate'))
            return false;
        
        if (!compareDate('txtFromDate', 'txttoDate', 'Leaving Date', 'Joining Date', 'Leaving Date can not be less than Joining Date'))
        	return false;

		if ($('#filePhoto').val() != '') {
			if (!IsCheckFile('filePhoto', 'Invalid file types. Upload only ', 'jpeg,jpg,png'))
				return false;
		}

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
			<div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> <a href="<?php echo APP_URL; ?>viewProfile/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a> </div>
			<?php include('includes/util.php'); ?>
			<div class="hr hr-solid"></div>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="selType">Select Authority</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<select class="form-control" name="selType" id="selType" >
							<option value="" >- Select -</option>
							<option value="1" <?php if ($intType == 1) echo 'selected="selected"'; ?>>Former Governor</option>
							<option value="2" <?php if ($intType == 2) echo 'selected="selected"'; ?>>Former Secretary</option>
						</select>
						<span class="mandatory">*</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3  col-lg-2 control-label no-padding-right" for="vchOfficerName">Officer Name</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="text" id="vchOfficerName" Name="vchOfficerName" placeholder="" class="form-control" maxlength="100" value="<?php echo $vchOfficerName; ?>">
						<span class="mandatory">*</span>
					</div>
				</div>
				<div class="form-group" id="divFromDateTime">
					<label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtFromDate"> Joining Date</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<div class="input-group">
							<input type="text" data-date-format="dd-mm-yyyy" name="txtFromDate" id="txtFromDate" class="form-control date-picker" value="<?php echo $strjoindate; ?>">

							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
						<!-- <span class="mandatory">*</span> -->
					</div>

				</div>
				<div class="form-group" id="divFromDateTime">
					<label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txttoDate"> Leaving Date</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<div class="input-group">
							<input type="text" data-date-format="dd-mm-yyyy" name="txttoDate" id="txttoDate" class="form-control date-picker" value="<?php echo $strleavedate; ?>">

							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
						<!-- <span class="mandatory">*</span> -->
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3  col-lg-2 control-label no-padding-right" for="filePhoto"> Upload Photo </label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="file" id="filePhoto" name="filePhoto" placeholder="" class="form-control" onChange="readImage(this);">
						<input type="hidden" name="hdnImageFile" id="hdnImageFile" value="<?php echo $strImageFile; ?>" />
						<small><span id="imgMsg" class="red">( Only .jpeg,.jpg or gif file and Max file size 1 MB)</span></small>
					</div>

					<div class="help-inline col-xs-12 col-sm-6">
						<?php if ($id > 0 && $strImageFile != '') { ?>
							<a href="javascript:void(0);" id="userImgClose" class="imgClose" style="position: absolute; margin-left: 60px; margin-top: -25px;">
								<img src="<?php echo APP_URL; ?>img/close-btn.png" />
							</a>
							<img id="userImage" width="50" height="50" alt="" class="passportPhoto mgnLft_10 mgnTop_10" src="<?php echo APP_URL . 'uploadDocuments/offProfile/' . $strImageFile; ?>">

						<?php } else { ?>
							<img id="userImage" width="99" height="128" alt="" class="passportPhoto mgnLft_10 mgnTop_10">
						<?php } ?>
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
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css" />
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script>
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	});
</script>
<!-- /.page-content -->