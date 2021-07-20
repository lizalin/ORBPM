<?php
/* ================================================
  File Name         	  : addLogo.php
  Description		  : This is used for add Logo.
  Designed & Devloped By  :T Ketaki Debadarshini
  Designed & Devloped On  :29-Aug-2015
  Update History	:	<Updated by>		<Updated On>		<Remarks>
  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
  includes		:	header.php, navigation.php, util.php, footer.php,addNewsInner.php

  ================================================== */

require 'addLogoInner.php';
?>

<script language="javascript" type="text/javascript" src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript" type="text/javascript" >
    $(document).ready(function () {

        //loadNavigation('<?php //echo $strTab;  ?> Logo');
        pageHeader = "<?php echo $strTab; ?> Logo";
        strFirstLink = "Manage Application";
        strLastLink = "Manage Logo";

        indicate = 'yes';
        $('#txtTitle').focus();
<?php  if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>','','<?php echo $redirectLoc; ?>');
<?php } ?>
            });
</script>
<script language="javascript" type="text/javascript">
    function validator() {

        if (!blankCheck('txtTitle', 'Title can not left blank')) {
            
            return false;
        }
        if (!checkSpecialChar('txtTitle'))
	{
	return false;
	}
	if (!maxLength('txtTitle',20, 'Logo Title'))
	{
	return false;
	}
        <?php if($id !=0){?>
                if ($('#hdnfileLogo').val() == '')
        {
            viewAlert('Please upload Admin Logo');
            return false;
        }<?php }?>
  
<?php if ($strFileName != '') { ?>

          if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'png'))
            return false;
<?php } ?>
        <?php if($id !=0){?>if ($('#hdnfileLogoH').val() == '')
        {
            viewAlert('Please upload Home page Logo');
            return false;
        }<?php } ?>

        if (!IsCheckFile('fileDocumentH', 'Invalid file types. Upload only ', 'png'))
            return false;

    }
</script>            

<div id="page-content" class="page-content">
    <!-- Header Area-->
    <div class="page-header">
        <h1 id="title" class="col-sm-5"></h1>
    </div>
    
    <!-- Header Area-->
    <!-- Login Area-->
    <div id="row">
        <div class="col-xs-12">
           <div class="clearfix"></div>
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> <a href="<?php echo APP_URL; ?>viewLogo/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>
<?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>

            <div class="col-xs-12"> 
                         <div class="form-group">
                <label class="col-sm-3  col-lg-2   control-label no-padding-right" for="txtCaption">Logo Title </label>
                <div class="col-sm-4">
                <span class="colon">:</span>
                <input type="text" id="txtTitle" name="txtTitle" maxlength="130" placeholder="" class="form-control" value="<?php echo $strTitle; ?>">
                  <span class="mandatory">*</span>
                </div>
              </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2   control-label no-padding-right" for="fileDocument">Upload Admin Logo</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocument" name="fileDocument" placeholder="" class="form-control" onChange="readImage(this, 'userImage');">
                        <input type="hidden" id="hdnfileLogo" name="hdnfileLogo" value="<?php echo $strFileName; ?>"/>
                        <span class="mandatory">*</span>
                        <span class="red"><small>(Upload only png files upto 2MB for better visibility 534*106)</small></span>
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6">
<?php if ($id > 0) { ?>
                            <img id="userImage" src="<?php echo APP_URL . 'uploadDocuments/Logo/' . $strFileName; ?>" alt="<?php echo $strTitle; ?>" width="120" height="65" border="0" align="absmiddle" style="width:217px; height:62px;">

<?php } ?>

                        
                    </div>
                </div>
                
             
                
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2   control-label no-padding-right" for="fileDocumentH">Upload home Logo</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocumentH" name="fileDocumentH" placeholder="" class="form-control" onChange="readImage(this, 'userImage1');">
                        <input type="hidden" id="hdnfileLogoH" name="hdnfileLogoH" value="<?php echo $strFileNameH; ?>"/>
                        <span class="mandatory">*</span>
                         <span class="red"><small>(Upload only png files upto 1MB for better visibility 534*106)</small></span>
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6">
<?php if ($id > 0) { ?>
                            <img id="userImage1"  src="<?php echo APP_URL . 'uploadDocuments/Logo/' . $strFileNameH; ?>" alt="<?php echo $strTitle; ?>" width="120" height="65" border="0" align="absmiddle" style="width:217px; height:62px;">

<?php } ?>

                      

                    </div>

                </div>

            

                <div class="form-group">
                    <div class="col-sm-3  col-lg-2   no-padding-right"></div>
                    <div class="col-sm-4">
                        <input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $strSubmit; ?>" class="btn btn-success" onclick="return validator();"/>
                        <input type="reset" id="btnReset" name="btnReset"  class="btn btn-danger" value="<?php echo $strReset; ?>" onclick="<?php echo $strclick; ?>" />
                    </div>
                </div>


            </div>

            <div class="hr hr32 hr-dotted"></div>
        </div>
    </div> </div>

<script language="javascript" type="text/javascript">
                            function readImage(input, imgElement) {
                                //alert('rewrwe');
                                $('#' + imgElement).show();
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $('#' + imgElement).attr('src', e.target.result);
                                        // $('#imgMsg').css('margin-left', '110px');
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
</script>