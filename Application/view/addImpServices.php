<?php
/* ================================================
	File Name                 : addImpServices.php
	Description		  : This page is used to add Services.
	Designed By		  : Sonali
        Designed On		  : 26-Sept-2016
        Devloped By		  : Sonali
        Devloped On		  : 26-Sept-2016
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
					
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes		  :	header.php, navigation.php, util.php, footer.php,addImpServicesInner.php

	==================================================*/

require 'addImpServicesInner.php';
//print_r($_REQUEST);exit;
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo APP_URL; ?>ckeditor/ckeditor.js"></script>
<script language="javascript">
    $(document).ready(function() {
        pageHeader = "Add Services";
        strFirstLink = "Manage Application";
        strLastLink = "Services";
        $('#divUrl').hide();
        $('#divuploadDocument').hide();

        $('#pluginDrp').hide();
        displayCkeditor('txtDetailsE');
        
        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>');
        <?php }
        if ($flag == 1 && $id != 0) { ?>
            window.location.href = '<?php echo $redirectLoc; ?>';
        <?php } ?>
        <?php if ($id > 0) { ?>
            ShowHideLnkTyp(<?php echo $intLinkType; ?>);
            <?php if ($intLinkType == 1) { ?>
                ShowHideTempTyp(<?php echo $intTempletType; ?>);
            <?php } ?>
        <?php } ?>
        <?php if ($strFileNameImage == '') { ?>
            $('#userImage').hide();
        <?php } else { ?>
            $('#imgMsg').css('margin-left', '110px');
        <?php } ?>
    });

    function validator() { 
        if (!blankCheck('txtHeadE', 'Service Title can not be left blank'))
            return false;
        if (!checkSpecialChar('txtHeadE'))
            return false;
        if (!maxLength('txtHeadE', 70, 'Service Title'))
            return false;
        if ($('input[name=rbtLnkType]:checked').val() == 1 && $('input:radio[name=radTemplateType]:checked').val() == 2) {

            if (!blankCheck('fileUploadDocument', 'Please Upload Document File'))
                return false;
            if ($('#fileUploadDocument').val() != '') {

                if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'pdf,xls'))
                    return false;
                var fileSize_inKB = Math.round(($("#fileDocument")[0].files[0].size / 1024));
                if (fileSize_inKB > 10240) {
                    alert('Document File size cannot be more than 10MB.');
                    return false;
                }
            }

        }
        <?php if ($id == 0) { ?>
            if (!blankCheck('fileDocumentImage', 'Please Upload Image.'))
                return false;
        <?php }  ?>
        var imgFile = $("#fileDocumentImage").val();
        if (imgFile != '') {
            if (!IsCheckFile('fileDocumentImage', 'Invalid file types. Upload only ', 'jpeg,jpg,gif'))
                return false;
            var fileSize_inKB = Math.round(($("#fileDocumentImage")[0].files[0].size / 1024));
            if (fileSize_inKB > 10240) {
                viewAlert('Image File size cannot be more than 10 MB.');
                return false;
            }
        }
        
        if ($('input[name=rbtLnkType]:checked').val() == 2) {
            if (!checkSpecialChar('txtURL'))
                return false;
            if (!validURL('txtURL', 'Please enter a valid URL'))
                return false;
        }


    }

    function readImage(input, imgElement) {
        $('#' + imgElement).show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + imgElement).attr('src', e.target.result);

            }
            reader.readAsDataURL(input.files[0]);
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

            <div class="clearfix"></div>
            <div class="top_tab_container">

                <?php if ($adminConsole_Privilege == 0 || $adminConsole_Privilege == 1 || $intPermission != 2) { ?>
                    <a href="javascript:void(0);" class="btn btn-info active">Add</a>
                <?php } ?>

                <a href="<?php echo APP_URL; ?>viewImpServices/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                <a href="<?php echo APP_URL; ?>archieveImpServices/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info ">Archive</a>

            </div>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtHeadE">Service Title</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtHeadE" name="txtHeadE" maxlength="100" placeholder="" class="form-control" value="<?php echo $strHeadlineE; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="rbtLnkType1">Link Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input name="rbtLnkType" id="rbtLnkType1" type="radio" class="ace" value="1" onClick="ShowHideLnkTyp(this.value);" <?php if ($intLinkType == 1) { ?>checked="checked" <?php } ?>>
                                <span class="lbl"> Internal</span>
                            </label>
                            <label>
                                <input name="rbtLnkType" id="rbtLnkType2" type="radio" value="2" class="ace" onClick="ShowHideLnkTyp(this.value);" <?php if ($intLinkType == 2) { ?>checked="checked" <?php } ?>>
                                <span class="lbl"> External</span>
                            </label>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="radWinStatus">Window Status</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input name="radWinStatus" type="radio" class="ace" value="1" <?php if ($intWinStatus == 1) { ?> checked="checked" <?php } ?>>
                                <span class="lbl"> Same</span>
                            </label>
                            <label>
                                <input name="radWinStatus" type="radio" value="2" class="ace" <?php if ($intWinStatus == 2) { ?> checked="checked" <?php } ?>>
                                <span class="lbl"> New</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="divUrl">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtURL">URL</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" name="txtURL" id="txtURL" class="form-control" value="<?php echo $strUrl ?>" />
                        <!--span class="mandatory">*</span-->
                    </div>
                </div>
                <div class="form-group divImage divMainPic" id="divMainPic">
                    <label class="col-sm-2 control-label no-padding-right" for="fileDocumentImage">Upload Image</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocumentImage" name="fileDocumentImage" placeholder="" class="form-control" onChange="readImage(this,'userImage');">
                        <input type="hidden" name="hdnImageFile" id="hdnImageFile" value="<?php echo $strFileNameImage; ?>" />
                        <span class="mandatory">*</span>
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6">
                        <?php if ($id > 0 && $strFileNameImage !="") { ?>
                            <img id="userImage" width="200" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10" src="<?php echo APP_URL. 'uploadDocuments/ImpServices/'.$strFileNameImage; ?>">
                        <?php } else { ?>
                            <img id="userImage" width="200" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10">
                        <?php } ?>
                        <!-- <a href="javascript:void(0);" id="userImgClose" class="imgClose" style="display:none;">X</a> -->
                    </div>
                </div>
                <div class="form-group" id="templateDiv">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="radTemplateType">Page Content</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input name="radTemplateType" type="radio" value="1" class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTempletType == 1) { ?> checked="checked" <?php } ?>>
                                <span class="lbl"> Content</span>
                            </label>
                            <label>
                                <input name="radTemplateType" type="radio" value="2" class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTempletType == 2) { ?> checked="checked" <?php } ?>>
                                <span class="lbl">Document</span>
                            </label>
                            
                        </div>

                    </div>
                </div>

                <div class="form-group" id="divContentEn">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDetailsE">Details</label>
                    <div class="col-sm-9">
                        <span class="colon">:</span>
                        <textarea class="ckeditor form-control" id="txtDetailsE" name="txtDetailsE" rows="10"><?php echo $strDetailsE; ?></textarea>

                    </div>
                </div>
                
                <div class="form-group" id="divuploadDocument">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="fileFeaturedImage"> Upload Document</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileUploadDocument" name="fileUploadDocument" placeholder="" class="form-control">
                        <input type="hidden" name="hdnUploadDocument" id="hdnUploadDocument" value="<?php echo $strFileName;  ?>" />
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6">
                        <?php
                        if ($id != '' && $strFileName != '') {
                            $display = '';
                        } else {
                            $display = 'style="display:none;"';
                        }
                        if ($strFileName != '') {
                        ?>
                            <a href="<?php echo APP_URL ?>uploadDocuments/featuredImage/<?php echo $strFileName; ?>" target="_blank">
                                <img id="imageFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strFileName; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                        <?php } ?>


                        <span id="imgMsg" class="red">(Only pdf,xls files upto 10MB)</span>
                    </div>

                </div>
               
                <div class="form-group">
                    <div class="col-sm-3  col-lg-2  no-padding-right"></div>
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
<script type="text/javascript">
    function ShowHideLnkTyp(linkType) {
        if (linkType == '1') {
            $("#templateDiv").show();
            $("#divUrl").hide();
            $("#divuploadDocument").hide();
        }
        if (linkType == '2') {
            $("#divContentEn").hide();
            $("#templateDiv").hide();
            $("#divuploadDocument").hide();
            $("#divUrl").show();
            if ($('#txtURL').val == '')
                $("#txtURL").val('http://');
            $('#txtDetailsE').html('');

        }
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 1) {
            $("#divContentEn").show();
            $("#divuploadDocument").hide();
            $("#divUrl").hide();
        }
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 3)
            $("#pluginDrp").show();

    }

    function ShowHideTempTyp(tempType) {
        if (tempType == '1') {
            $("#divContentEn").show();
            $("#divuploadDocument").hide();
        }
        if (tempType == '2') {
            $("#divuploadDocument").show();
            $("#pluginDrp").hide();
            $("#divContentEn").hide();
            $("#txtDetailsE").val('');
        }
        if (tempType == '3') {
            $("#pluginDrp").show();
            $("#divuploadDocument").hide();
            $("#divContentEn").hide();
            $("#txtDetailsE").val('');
        }
    }
    // function to get page content
</script>