<?php
/* ================================================
	File Name         	  : addLocation.php
	Description		  : This is used for add Location
	Designed By		  : 
        Designed On		  : 
        Devloped By		  : T Ketaki Debadarshini
        Devloped On		  : 10-Sept-2015
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
						
	Style sheet                 : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions          : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes			  :	header.php, navigation.php, util.php, footer.php,addLocationInner.php

	==================================================*/

require 'addLocationInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
	$(document).ready(function() {

		pageHeader = "<?php echo $strTab; ?> Location";
		strFirstLink = "Manage Application";
		strLastLink = "Location";

		$('#txtLocation').focus();
		indicate = 'yes';
		<?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
			viewAlert('<?php echo $outMsg; ?>', '', '<?php echo $redirectLoc; ?>');
		<?php }
		/*if ($flag == 1) { ?>
			window.location.href = '<?php echo APP_URL; ?>viewLocation/<?php echo $glId; ?>/<?php echo $plId; ?>';
		<?php }*/   ?>

		TextCounter('txtDescription', 'lblChar1', 500);
	});

	function validator() {

		if (!blankCheck('txtLocation', 'Location Name can not be left blank'))
			return false;
		if (!checkSpecialChar('txtLocation'))
			return false;
		if (!maxLength('txtLocation', 50, 'Location'))
			return false;
		if (!maxLength('txtDescription', 500, 'Description'))
			return false;
		if (!checkSpecialChar('txtDescription'))
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
			<div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> <a href="<?php echo APP_URL; ?>viewLocation/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>
			<?php include('includes/util.php'); ?>
			<div class="hr hr-solid"></div>
			<div class="col-xs-12">

				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="txtLocation">Location Name </label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="text" id="txtLocation" name="txtLocation" maxlength="50" placeholder="" class="form-control" value="<?php echo $strLocation; ?>">
						<span class="mandatory">*</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="txtDescription">Address</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<textarea class="form-control" id="txtDescription" name="txtDescription" style="height:100px;" maxlength="250" onKeyUp="return TextCounter('txtDescription','lblChar1',500)" onMouseUp="return TextCounter('txtDescription','lblChar1',500)"><?php echo $strDescription; ?></textarea>
						<span class="red">Maximum <span id="lblChar1">500</span> characters </span>

					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="txtLocation">Office No 1</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="text" id="txtOfficeNO1" name="txtOfficeNO1" maxlength="50" placeholder="" class="form-control" value="<?php echo $strOfficeNO1; ?>">
						<!-- <span class="mandatory">*</span> -->
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="txtOfficeNO1">Office No 2</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="text" id="txtOfficeNO2" name="txtOfficeNO2" maxlength="50" placeholder="" class="form-control" value="<?php echo $strOfficeNO2; ?>">
						<!-- <span class="mandatory">*</span> -->
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="txtLocation">Office Email</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="email" id="txtEmail" name="txtEmail" maxlength="50" placeholder="" class="form-control" value="<?php echo $strEmail; ?>">
						<!-- <span class="mandatory">*</span> -->
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