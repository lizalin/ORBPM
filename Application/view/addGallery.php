<?php
/* ================================================
	File Name         	  : addGallery.php
	Description		  : This is used for add Gallery Images Details.
	Designed By		  : Chinmayee
        Designed On		  : 25-May-2016
        Devloped By		  : Chinmayee
        Devloped On		  : 27-May-2016
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
					
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes		  : header.php, navigation.php, util.php, footer.php,addGalleryInner.php

	==================================================*/

require 'addGalleryInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function() {
        $('[data-rel=tooltip]').tooltip();
        pageHeader = "<?php echo $strTab; ?> Gallery";
        strFirstLink = "Manage Application";
        strLastLink = "Manage Gallery";

        indicate = 'yes';

        $('#selScreen').focus();
        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>', '', '<?php echo $redirectLoc; ?>');
        <?php  }
        /*if ($flag == 1 && $id != 0) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewGallery/<?php echo $glId; ?>/<?php echo $plId; ?>';
        <?php  }*/ ?>
        <?php

        if ($id == 0) {
        ?>
            $('#userImage').hide();
        <?php } else { ?>
            $('#imgMsg').css('margin-left', '110px');
        <?php } ?>

        // showTypeDetails('<?php echo $intType; ?>');
        <?php if ($intType == 3) { ?>
            ShowHideLnkType2('<?php echo $intLinkType; ?>');
        <?php } ?>


        fillpluginCategorys('<?php echo $intplugin; ?>', 'selCategory', '<?php echo $intType; ?>');
    });

    function ShowHideLnkType2(linkType) {
        if (linkType == '1') {
            $(".URL").hide();
            $(".upload").show();
        } else if (linkType == '2') {
            $(".URL").show();
            $(".upload").hide();
        }
    }

    // function fillpluginCategory(catfldid , pluginid){

    //         var typeid=$("#selType").val();
    //        fillpluginCategorys(typeid,catfldid,pluginid,0);
    // }





    function validator() {
        if (!selectDropdown('selScreen', 'Select Publish on Screen'))
            return false;
        if (!selectDropdown('selType', 'Select Type'))
            return false;

        if ($('#selType').val() == 2 || $('#selType').val() == 3) {

            if (!selectDropdown('selCategory', 'Select Category'))
                return false;
        }
        if (!blankCheck('txtCaption', 'Caption can not be left blank'))
            return false;
        if (!checkSpecialChar('txtCaption'))
            return false;
        if (!maxLength('txtCaption', 100, 'Caption'))
            return false;

        if ($('#selType').val() == 2 || $('#selType').val() == 3) {
            <?php if ($id == 0) { ?>
                if (!blankCheck('fileDocument', 'Please Upload Image.'))
                    return false;
            <?php }  ?>

            if ($('#fileDocument').val() != '') {

                if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'jpeg,jpg,gif'))
                    return false;
                var fileSize_inKB = Math.round(($("#fileDocument")[0].files[0].size / 1024));
                // if (fileSize_inKB > 1024)
                if (fileSize_inKB > 51200) {
                    viewAlert('Image File size cannot be more than 10 MB.');
                    return false;
                }
            }
        }
        if ($('#selType').val() == 3) {
            var linkType = $('input:radio[name=rbtLnkType]:checked').val();
            if (linkType == '1') {
                if ('<?php echo $id; ?>' == '0' || '<?php echo $strvideo; ?>' == '') {
                    if (!blankCheck('filevideo', 'Please Upload video'))
                        return false;
                }
                if ($('#filevideo').val() != '') {
                    if (!IsCheckFile('filevideo', 'upload a valid filetype', 'mp4')) {
                        $("#filevideo").focus();
                        return false;
                    }
                    var videofileSize_inKB = Math.round(($("#filevideo")[0].files[0].size / 1024));
                    if (videofileSize_inKB > 51200) {
                        viewAlert('Video File size cannot be more than 10MB.');
                        return false;
                    }
                }
            } else {
                if (!blankCheck('txtEmbedCode', 'You Tube Embed Code can not be left blank')) {
                    return false;
                }
                if (!validURL('txtEmbedCode', 'Please enter a valid URL(Ex : http://www.google.com)'))
                    return false;
            }
        }

    }

    function readImage(input) {
        $('#userImage').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#userImage').attr('src', e.target.result);
                $('#imgMsg').css('margin-left', '5px');
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
            <div class="srvc_hdr_nav " style="right:20px;">
                <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Gallery">Gallery</a>
                <a href="<?php echo APP_URL; ?>viewGallerycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm" data-rel="tooltip" title="" data-original-title="Category">Category</a>
            </div>
            <div class="clearfix"></div>
            <div class="top_tab_container">
                <a href="javascript:void(0);" class="btn btn-info active">Add</a>
                <a href="<?php echo APP_URL; ?>viewGallery/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                <a href="<?php echo APP_URL; ?>archieveGallery/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info ">Archive</a>
            </div>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                <div class="form-group" id="categoryDiv">
                    <label class="col-sm-2 control-label no-padding-right" for="selCategory">Select Category</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="selCategory" id="selCategory">
                            <option value="0">- Select -</option>
                            <?php while ($row = mysqli_fetch_array($galleryCatList)) { ?>
                            <option value="<?php echo $row['INT_CATEGORY_ID']?>" <?php echo ($intCategory == $row['INT_CATEGORY_ID'])? 'selected' :'' ?>><?php  echo htmlspecialchars_decode($row['VCH_CATEGORY_NAME'],ENT_NOQUOTES);?></option>
                            <?php }?>
                        </select>
                        <span class="mandatory">*</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="selType">Select Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="selType" id="selType" >
                            <option value="2" >Image</option>
                        </select>
                        <span class="mandatory">*</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtCaption">Caption </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtCaption" name="txtCaption" maxlength="100" placeholder="" class="form-control" value="<?php echo $strCaption; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="strDescription">Short Description </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <textarea id="strDescription" name="strDescription" class="form-control">
                            <?php echo $strDescription; ?>
                        </textarea>
                        
                    </div>
                </div>
                <div class="form-group divImage divMainPic">
                    <label class="col-sm-2 control-label no-padding-right" for="fileDocument">Upload Image</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocument" name="fileDocument" placeholder="" class="form-control" onChange="readImage(this);">
                        <input type="hidden" name="hdnImageFile" id="hdnImageFile" value="<?php echo $strFileName; ?>" />
                        <span class="mandatory">*</span>
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6">
                        <?php if ($id > 0) { ?>
                            <img id="userImage" width="200" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10" src="<?php echo APP_URL. 'uploadDocuments/gallery/' . $strFileName; ?>">
                        <?php } else { ?>
                            <img id="userImage" width="200" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10">
                        <?php } ?>
                        <a href="javascript:void(0);" id="userImgClose" class="imgClose" style="display:none;">X</a>
                    </div>

                </div>
                <div class="form-group divImage divVideo">
                    <label class="col-sm-2 control-label no-padding-right"></label>
                    <div class="col-sm-4">
                        <span class="red">(jpeg,jpg,png,gif file only and Max size file Size 10 MB)</span>
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