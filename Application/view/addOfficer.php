<?php
/* ================================================
	File Name       : addOfficer.php
	Description		  : This is used for add Employee Profile.
	Designed By		  : Rajesh kumar Sahoo
  Designed On		  : 
  Devloped By     : 
  Devloped On     : 
	Update History		    :	<Updated by>		<Updated On>		<Remarks>
	
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js,validatorchklist.js
	includes		  :	header.php, navigation.php, util.php, footer.php,addProfileInner.php

	==================================================*/
require 'addOfficerInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
	$(document).ready(function() {
		pageHeader = "<?php echo $strTab; ?> Officer Profile";
		strFirstLink = "Manage Application";
		strLastLink = "Raj Bhavan Officers Profile";
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
		
	});
	TextCounter('txtAddress', 'lblChar', 500);
	function validator() {
		if (!blankCheck('selCategory', 'Officer Category can not left blank'))
			return false;
		if (!blankCheck('vchOfficerName', 'Officer Name can not left blank'))
			return false;
		if (!checkSpecialChar('vchOfficerName'))
			return false;
		if (!maxLength('vchOfficerName', 100, 'Officer Name'))
			return false;
		if (!checkSpecialChar('txtAddress'))
			return false;
		if (!maxLength('txtAddress', 500, 'Address'))
			return false;
		if (!blankCheck('vchofficeno', 'Office Contact Number can not left blank'))
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
			<div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> <a href="<?php echo APP_URL; ?>viewOfficers/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
				<a href="<?php echo APP_URL; ?>viewOfficercategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm" data-rel="tooltip" title="" data-original-title="Category">Category</a>
			</div>
			<?php include('includes/util.php'); ?>
			<div class="hr hr-solid"></div>
			<div class="col-xs-12">
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="selType">Select Authority</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<select class="form-control" name="selCategory" id="selCategory">
                            <option value="">- Select -</option>
                            <?php while ($row = mysqli_fetch_array($officerCatList)) { ?>
                            <option value="<?php echo $row['INT_CATEGORY_ID']?>" <?php echo ($intCatId == $row['INT_CATEGORY_ID'])? 'selected' :'' ?>><?php  echo htmlspecialchars_decode($row['VCH_CATEGORY_NAME'],ENT_NOQUOTES);?></option>
                            <?php }?>
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
				<div class="form-group" >
					<label class="col-sm-3  col-lg-2 control-label no-padding-right " for="txtFromDate"> Address</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<div class="input-group">
							<textarea class="form-control" id="txtAddress" name="txtAddress" rows="3" onKeyUp="return TextCounter('txtAddress','lblChar',500)" onMouseUp="return TextCounter('txtAddress','lblChar',500)"><?php echo $txtAddress; ?></textarea>
							<span class="red">Maximum <span id="lblChar"> 500 </span> characters</span>
							
						</div>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-3  col-lg-2 control-label no-padding-right" for="vchOfficerName">Office Contact No</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="text" id="vchofficeno" Name="vchofficeno" placeholder="" class="form-control" maxlength="100" value="<?php echo $vchofficeno; ?>">
						<span class="mandatory">*</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3  col-lg-2 control-label no-padding-right" for="vchOfficerName">Residence Contact No</label>
					<div class="col-sm-4">
						<span class="colon">:</span>
						<input type="text" id="vchResno" Name="vchResno" placeholder="" class="form-control" maxlength="100" value="<?php echo $vchResno; ?>">
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