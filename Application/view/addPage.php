<?php
/* ================================================
  File Name                 : addPage.php
  Description               : This is used for add the Page Name and content details.
  Designed By               : Chinmayee
  Designed On               : 19-May-2016
  Devloped By               : Chinmayee
  Devloped On               : 19-May-2016
  Update History            :	<Updated by>		<Updated On>		<Remarks>
   Icon class added and featchered image deleted        Chinmayee                23-May-2016
 * Anchor class added and meta image deleted            Chinmayee                24-May-2016
  Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
  includes                  : header.php, navigation.php, util.php, footer.php,addPageInner.php			  :

  ================================================== */
require("addPageInner.php");
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo APP_URL; ?>ckeditor/ckeditor.js"></script>
<script language="javascript">
    $(document).ready(function() {
        pageHeader = "<?php echo $strTab; ?> Page";
        strFirstLink = "Manage Link";
        strLastLink = "Pages";

        indicate = 'yes';
        displayCkeditor('txtContentE');
        // displayCkeditor('txtContentO'); 
        $('#deletePage').hide();
        $('#deletePageO').hide();
        $('.clsActive').show();
        $('.clsDeactive').hide();
        $('#txtTitle_e').focus();
        $('#divUrl').hide();
        $('#divUploadDocument').hide();

        $('#pluginDrp').hide();
        $('.clsActiveO').show();
        $('.clsDeactiveO').hide();
        $('#divDocfile').hide();
        <?php if ($id > 0) { ?>
            ShowHideLnkTyp(<?php echo $intLinkType; ?>);
            if (<?php echo $intLinkType; ?> == 1) {
                ShowHideTempTyp(<?php echo $intTempletType; ?>);
            }
        <?php } ?>
        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>', '', '<?php echo $redirectLoc; ?>');
        <?php } ?>
        <?php /*if ($flag == 1 && $id != 0) { ?>
                window.location.href = '<?php echo APP_URL; ?>viewPage/<?php echo $glId; ?>/<?php echo $plId; ?>';
<?php }*/ ?>
        <?php if ($strFileNameImage == '') { ?>
            $('#userImage').hide();
        <?php } else { ?>
            $('#imgMsg').css('margin-left', '110px');
        <?php } ?>
        getContent('txtContentE', '<?php echo $id ?>', 1, 1);
        readPageContent('<?php echo $id ?>');
        readPageContentH('<?php echo $id ?>');
        //contentActive
        // Function to close image
        $('#close').click(function() {
            if (!confirm('Are you sure to delete selected File'))
                return false;
            $('#hdnImageFile').val('');
            $('#imageFile').hide();
            $(this).hide();
            $('#imgMsg').css('margin-left', '0px');
        });
        $('#closemeta').click(function() {
            if (!confirm('Are you sure to delete selected File'))
                return false;
            $('#hdnMetaImageFile').val('');
            $('#imagemetaFile').hide();
            $(this).hide();
            $('#imgMsg').css('margin-left', '0px');
        });

        setTimeout(function() {
            $("select option[value='<?php echo $strPluginName; ?>']").attr("selected", "selected");
        }, 1000);

        $('.addMore').live("click", function() {
            addContentDetail();
        });


        $('.addMoreO').live("click", function() {
            addContentDetailO();

        });

        $('#deletePage').live("click", function() {
            var lastPage = $(".contentLabel:last").val();
            if (lastPage <= 2)
                $(this).hide();
            var prevPage = Number(lastPage) - 1;
            $('#hdnPageId' + lastPage).remove();
            $('#hdnContentId' + lastPage).remove();
            $('#hdnPagevalue' + lastPage).remove();
            $('#hdnCurrentId').val(prevPage);
            $('#conBTn' + lastPage).removeClass('clsActive');
            $('#conBTn' + lastPage).removeClass('contentLabel');
            $('#conBTn' + lastPage).addClass('clsDeactive');
            $('#conBTn' + lastPage).removeClass('activeBtn');
            $('#conBTn' + prevPage).addClass('activeBtn');
            $('.clsActive').show();
            $('.clsDeactive').hide();
            arrcontent.splice(-1, 1);
            var arrayVal = arrcontent[Number(prevPage) - 1];
            CKEDITOR.instances['txtContentE'].setData(arrayVal);
        });


        var editor = CKEDITOR.instances['txtContentE'];
        if (editor) {
            editor.on('change', function(event) {
                var currId = $('#hdnCurrentId').val();
                var page = currId - 1;
                var page_content = CKEDITOR.instances['txtContentE'].getData();
                if (arrcontent.length == page) {
                    $('#hdnPageId' + currId).val(currId);
                    $('#hdnPagevalue' + currId).val(page_content);
                    arrcontent[page] = page_content;
                } else {
                    $('#hdnPageId' + currId).val(currId);
                    $('#hdnPagevalue' + currId).val(page_content);
                    arrcontent[page] = page_content;
                }

            });
        }
        $('#deletePageO').live("click", function() {
            var lastPageO = $(".contentLabelO:last").val();
            if (lastPageO <= 2)
                $(this).hide();
            var prevPageO = Number(lastPageO) - 1;
            $('#hdnPageIdO' + lastPageO).remove();
            $('#hdnContentIdO' + lastPageO).remove();
            $('#hdnPagevalueO' + lastPageO).remove();
            $('#hdnCurrentIdO').val(prevPageO);
            $('#conBTnO' + lastPageO).removeClass('clsActiveO');
            $('#conBTnO' + lastPageO).removeClass('contentLabelO');
            $('#conBTnO' + lastPageO).addClass('clsDeactiveO');
            $('#conBTnO' + lastPageO).removeClass('activeBtnO');
            $('#conBTnO' + prevPageO).addClass('activeBtnO');
            $('.clsActiveO').show();
            $('.clsDeactiveO').hide();
            arrcontentO.splice(-1, 1);
            var arrayValO = arrcontentO[Number(prevPageO) - 1];
            CKEDITOR.instances['txtContentO'].setData(arrayValO);
        });


        //  var editorO = CKEDITOR.instances['txtContentO'];
        // if (editorO) {
        //     editorO.on('change', function(event) { 
        //         var currIdO  = $('#hdnCurrentIdO').val();
        //         var pageO    = currIdO-1;
        //        var page_contentO   = CKEDITOR.instances['txtContentO'].getData(); 
        //        if(arrcontentO.length==pageO)
        //        {
        //            $('#hdnPageIdO'+currIdO).val(currIdO);
        //            $('#hdnPagevalueO'+currIdO).val(page_contentO);
        //             arrcontentO[pageO] = page_contentO; 
        //        }
        //        else
        //        {
        //            $('#hdnPageIdO'+currIdO).val(currIdO);
        //            $('#hdnPagevalueO'+currIdO).val(page_contentO);
        //             arrcontentO[pageO] = page_contentO; 
        //         }

        //     });
        // } 



        TextCounter('txtMetaDescription', 'lblChar1', 500);
        TextCounter('txtSnippet', 'lblChar2', 750);
        //
        fillPlugins('selPluginName');
    });
    // Create dynamic page


    function addContentDetail() {

        var totalRecord = $('.contentLabel').length;
        if (totalRecord >= 10) {
            viewAlert("Maximum 10 Page can be added.");
            return false;
        }
        var counter = totalRecord + 1;
        var prvCounter = counter - 1;
        var newTextBoxDiv = '';
        var page_content = CKEDITOR.instances['txtContentE'].getData();
        $('#hdnPagevalue' + prvCounter).val(page_content);
        $('#hdnPageId' + prvCounter).val(prvCounter);
        if (page_content != "") {
            $('#deletePage').show();
            $(".contentLabel").removeClass('activeBtn');
            $('#conBTn' + counter).addClass('clsActive');
            $('#conBTn' + counter).addClass('contentLabel');
            $('#conBTn' + counter).removeClass('clsDeactive');
            $('#conBTn' + counter).addClass('activeBtn');
            $('.clsActive').show();
            $('.clsDeactive').hide();

            newTextBoxDiv += '<input type="hidden" id="hdnPageId' + counter + '" name="hdnPageId[]" value="' + counter + '"/>';
            newTextBoxDiv += '<input type="hidden" id="hdnContentId' + counter + '" name="hdnContentId[]" value="0"/>';

            newTextBoxDiv += '<input type="hidden" id="hdnPagevalue' + counter + '" name="hdnPagevalue[]" />';


            arrcontent[Number(prvCounter) - 1] = page_content;
            $("#groupPageMore").append(newTextBoxDiv);
            CKEDITOR.instances['txtContentE'].setData('');
            $('#hdnCurrentId').val(counter);
        } else {
            if (Number(validFlag) != 1) {
                viewAlert("Page" + prvCounter + " Content can not be left blank");
                $('#conBTn' + prvCounter).focus();
                return false;
            }
        }
    }

    function addContentDetailO() {

        var totalRecordO = $('.contentLabelO').length;
        if (totalRecordO >= 10) {
            viewAlert("Maximum 10 Page can be added.");
            return false;
        }
        var counterO = totalRecordO + 1;
        var prvCounterO = counterO - 1;
        var newTextBoxDivO = '';
        var page_contentO = CKEDITOR.instances['txtContentO'].getData();
        $('#hdnPagevalueO' + prvCounterO).val(page_contentO);
        $('#hdnPageIdO' + prvCounterO).val(prvCounterO);
        if (page_contentO != "") {
            $('#deletePageO').show();
            $(".contentLabelO").removeClass('activeBtnO');
            $('#conBTnO' + counterO).addClass('clsActiveO');
            $('#conBTnO' + counterO).addClass('contentLabelO');
            $('#conBTnO' + counterO).removeClass('clsDeactiveO');
            $('#conBTn' + counterO).addClass('activeBtnO');
            $('.clsActiveO').show();
            $('.clsDeactiveO').hide();

            newTextBoxDivO += '<input type="hidden" id="hdnPageIdO' + counterO + '" name="hdnPageIdO[]" value="' + counter + '"/>';
            newTextBoxDivO += '<input type="hidden" id="hdnContentIdO' + counterO + '" name="hdnContentIdO[]" value="0"/>';

            newTextBoxDivO += '<input type="hidden" id="hdnPagevalueO' + counterO + '" name="hdnPagevalueO[]" />';


            arrcontent[Number(prvCounterO) - 1] = page_contentO;
            $("#groupPageMoreO").append(newTextBoxDivO);
            CKEDITOR.instances['txtContentO'].setData('');
            $('#hdnCurrentIdO').val(counterO);
        } else {
            if (Number(validFlagO) != 1) {
                viewAlert("Page" + prvCounterO + " Content Odia can not be left blank");
                $('#conBTnO' + prvCounterO).focus();
                return false;
            }
        }
    }
    // Function to validate
    function validator() {
        if (!blankCheck('txtTitle_e', 'Page Title can not be left blank'))
            return false;
        if (!checkSpecialChar('txtTitle_e'))
            return false;
        if (!maxLength('txtTitle_e', 70, 'Page Title.'))
            return false;

        if (!blankCheck('txtPagename', 'Page Name can not be left blank'))
            return false;
        if (!checkSpecialChar('txtPagename'))
            return false;
        if (!maxLength('txtPagename', 70, 'Page Name.'))
            return false;

        if (!blankCheck('txtPageAlias', 'Page Alias can not left blank'))
            return false;
        if (!checkValidPage('txtPageAlias'))
            return false;
        if (!maxLength('txtPageAlias', 50, 'Page Alias'))
            return false;

        if (!checkSpecialChar('txtSnippet'))
            return false;
        if (!maxLength('txtSnippet', 750, 'Snippet'))
            return false;


        if (!checkSpecialChar('txtMetaTitle'))
            return false;
        if (!maxLength('txtMetaTitle', 50, 'Meta Title'))
            return false;
        if (!checkSpecialChar('txtMetaTitle'))
            return false;

        if (!maxLength('txtMetaKey', 50, 'Meta Key Ward'))
            return false;
        if (!checkSpecialChar('txtMetaKey'))
            return false;
        if (!maxLength('txtMetaDescription', 500, 'Meta Description'))
            return false;
        if (!checkSpecialChar('txtMetaDescription'))
            return false;
        /*if (!checkSpecialChar('fileMetaImage'))
            return false;
        if (!checkSpecialChar('fileFeaturedImage'))
            return false;*/

        var linkType = $('input:radio[name=rbtLnkType]:checked').val();

        var templateType = $('input:radio[name=radTemplateType]:checked').val();
        if (linkType == 2) {
            /*if (!blankCheck('txtURL', 'URL can not left blank'))
                return false;*/

            if (($('#txtURL').val() == "") && ($('#hdnUploadDocument').val() == "" && $('#fileUploadDocument').val() == "")) {

                viewAlert("Please enter Url Or upload Document");
                return false;
            }
            var imgFile = $("#fileUploadDocument").val();
            if (imgFile != '') {
                if (!IsCheckFile('fileUploadDocument', 'Invalid file types. Upload only ', 'pdf'))
                    return false;
                var fileSize_inKB = Math.round(($("#fileUploadDocument")[0].files[0].size / 1024));
                if (fileSize_inKB > 10240) {
                    viewAlert('Document File size cannot be more than 10MB.');
                    return false;
                }
            }
            if (!checkSpecialChar('txtURL'))
                return false;
            if (!validURL('txtURL', 'Please enter a valid URL(Ex : http://www.google.com)'))
                return false;
        }
        if (linkType == '1' && templateType == '1') {
            var imgFile = $("#fileDocumentImage").val();
            if (imgFile != '') {
                if (!IsCheckFile('fileDocumentImage', 'Invalid file types. Upload only ', 'jpeg,jpg,gif,png'))
                    return false;
                var fileSize_inKB = Math.round(($("#fileDocumentImage")[0].files[0].size / 1024));
                if (fileSize_inKB > 10240) {
                    viewAlert('Image File size cannot be more than 10 MB.');
                    return false;
                }
            }
            var contentFlag = 0;
            var lengthFlag = 0;
            var pgNum = 0;
            $('input[name="hdnPagevalue[]"]').each(function() {
                pgNum++;
                var contentVal = $(this).val();
                if (contentVal == '') {
                    contentFlag++;
                    return false;
                }
                if (contentVal.length > 65535) {
                    alert(1);
                    lengthFlag++;
                    return false;
                }

            });
             //alert(contentFlag);
            if (contentFlag > 0) {
                viewAlert("Content can not be left blank in page " + pgNum);
                $("#txtContentE").focus();
                return false;
            } 
            if (lengthFlag > 0) {
                viewAlert("Maximum 65535 characters can be added in page " + pgNum);
                $("#txtContentE").focus();
                return false;
            }

        }
        if (linkType == '1' && templateType == '2') {
            if (!selectDropdown('selPluginName', 'Select Plugin Name'))
                return false;

        }
        if (linkType == '1' && templateType == '4') {
            if (($('#hdnDocFile').val() == "" && $('#docFile').val() == "")) {
                viewAlert("Please upload Link Document");
                return false;
            }
            var doclinkFile = $("#docFile").val();
            if (doclinkFile != '') {
                if (!IsCheckFile('docFile', 'Invalid file types. Upload only ', 'pdf,xls,xlsx'))
                    return false;
                var docfileSize_inKB = Math.round(($("#docFile")[0].files[0].size / 1024));
                if (docfileSize_inKB > 10240) {
                    viewAlert('Link Document File size cannot be more than 10MB.');
                    return false;
                }
            }
        }


    }

    function checkValidPage(controlId) {
        var numPattern = new RegExp(/^[-_a-zA-Z]+$/);
        var txtVal = $('#' + controlId).val();
        if (txtVal != '') {
            if (numPattern.test(txtVal) == true)
                return true;
            else {
                viewAlert("Please enter a valid Alias Name");
                $('#' + controlId).focus();
                return false;
            }
        } else
            return true;
    }
    // Function to Read image
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
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a>
                <a href="<?php echo APP_URL; ?>viewPage/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                <!--<a href="<?php //echo APP_URL 
                                ?>archievePage" class="btn btn-info">Archive</a>-->
            </div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtTitle_e"> Page Title</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTitle_e" name="txtTitle_e" placeholder="" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" class="form-control" maxlength="70" value="<?php echo $strTitleE; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtTitle_e"> Page Name </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtPagename" name="txtPagename" placeholder="" class="form-control" maxlength="70" value="<?php echo $strName; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtPageAlias">Page Alias</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtPageAlias" name="txtPageAlias" placeholder="" class="form-control" maxlength="50" value="<?php echo $strPageAlias; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtSnippet">Snippet</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <textarea class="form-control" id="txtSnippet" name="txtSnippet" style="height:100px;" <!-- onKeyUp="return TextCounter('txtSnippet','lblChar2',750)" onMouseUp="return TextCounter('txtSnippet','lblChar2',750)" --><?php echo $strSnippet; ?></textarea>
                        <!-- <small><span class="red">Maximum <span id="lblChar2">750</span> characters </span></small> -->

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtMetaTitle">Meta Title</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtMetaTitle" name="txtMetaTitle" placeholder="" class="form-control" maxlength="50" value="<?php echo $strMetaTitle; ?>">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtMetaKey">Meta Key Word</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtMetaKey" name="txtMetaKey" placeholder="" class="form-control" maxlength="50" value="<?php echo $strMetaKeyword; ?>">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtMetaDescription">Meta Description</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <textarea class="form-control" id="txtMetaDescription" name="txtMetaDescription" style="height:100px;" onKeyUp="return TextCounter('txtMetaDescription','lblChar1',500)" onMouseUp="return TextCounter('txtMetaDescription','lblChar1',500)"><?php echo $strMetaDescription; ?></textarea>
                        <small><span class="red">Maximum <span id="lblChar1">500</span> characters </span></small>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="fileMetaImage"> Icon Class </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="fileMetaImage" name="fileMetaImage" placeholder="" class="form-control" maxlength="100" value="<?php echo $strMetaImage; ?>">

                    </div>

                </div>
                
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="rbtLnkType">Link Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input name="rbtLnkType" type="radio" class="ace" value="1" onClick="ShowHideLnkTyp(this.value);" <?php if ($intLinkType == 1) { ?>checked="checked" <?php } ?>>
                                <span class="lbl"> Internal</span>
                            </label>
                            <label>
                                <input name="rbtLnkType" type="radio" value="2" class="ace" onClick="ShowHideLnkTyp(this.value);" <?php if ($intLinkType == 2) { ?>checked="checked" <?php } ?>>
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
                <div class="form-group" id="divUploadDocument">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="fileFeaturedImage"> Upload Document</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileUploadDocument" name="fileUploadDocument" placeholder="" class="form-control">
                        <input type="hidden" name="hdnUploadDocument" id="hdnUploadDocument" value="<?php echo $strFileName; ?>" />
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


                        <span id="imgMsg" class="red">(Only pdf files upto 10MB)</span>
                    </div>

                </div>

                <div class="form-group divImage divMainPic" id="divMainPic">
                    <label class="col-sm-2 control-label no-padding-right" for="fileDocumentImage">Upload Image</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocumentImage" name="fileDocumentImage" placeholder="" class="form-control" onChange="readImage(this,'userImage');">
                        <input type="hidden" name="hdnImageFile" id="hdnImageFile" value="<?php echo $strFileNameImage; ?>" />
                        
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6">
                        <?php if ($id > 0 && $intTempletType == 1 && $strFileNameImage !="") { ?>
                            <img id="userImage" width="200" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10" src="<?php echo APP_URL. 'uploadDocuments/featuredImage/' . $strFileNameImage; ?>">
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

                <div class="form-group" id="divUrl">
                    <label class="col-sm-3  col-lg-2     control-label no-padding-right" for="txtURL">URL</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" name="txtURL" id="txtURL" class="form-control" value="<?php echo $strURL; ?>" />
                    </div>
                </div>
                <div class="form-group" id="templateDiv">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="radTemplateType">Page Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input name="radTemplateType" type="radio" class="ace" value="1" onClick="ShowHideTempTyp(this.value);" <?php if ($intTempletType == 1) { ?> checked="checked" <?php } ?>>
                                <span class="lbl"> Content</span>
                            </label>
                            <label>
                                <input name="radTemplateType" type="radio" value="2" class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTempletType == 2) { ?> checked="checked" <?php } ?>>
                                <span class="lbl"> Plugin</span>
                            </label>
                            <label>
                                <input name="radTemplateType" type="radio" value="3" class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTempletType == 3) { ?> checked="checked" <?php } ?>>
                                <span class="lbl"> None</span>
                            </label>
                            <label>
                                <input name="radTemplateType" type="radio" value="4" class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTempletType == 4) { ?> checked="checked" <?php } ?>>
                                <span class="lbl"> Document</span>
                            </label>

                        </div>

                    </div>
                </div>
                <div id="divContentEn">
                    <div class="form-group">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="">Page No</label>
                        <div class="col-sm-9">
                            <input type="button" class="btn btn-xs contentLabel clsActive activeBtn" id="conBTn1" value="1" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn2" value="2" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn3" value="3" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn4" value="4" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn5" value="5" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn6" value="6" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn7" value="7" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn8" value="8" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn9" value="9" />
                            <input type="button" class="btn btn-xs clsDeactive" id="conBTn10" value="10" />
                            <span id="groupPageMore">

                                <input type="hidden" id="hdnPageId1" name="hdnPageId[]" value="1" />
                                <input type="hidden" id="hdnPagevalue1" name="hdnPagevalue[]" />
                                <input type="hidden" id="hdnContentId1" name="hdnContentId[]" value="0" />

                            </span>
                            <input type="hidden" id="hdnCurrentId" name="hdnCurrentId" value="1" />
                            <a href="javascript:void(0);" id="more1" class="btn btn-xs btn-info addMore" title="Add More"> <i class="icon-white icon-plus-sign"></i> </a> <a href="javascript:void(0);" id="deletePage" class="btn btn-xs btn-danger delete" title="Delete"> <i class="icon-white fa fa-times"></i> </a>
                        </div>

                    </div>

                    <div class="form-group contentval1 contentActive" id="divContentEn">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtContentE">Content </label>
                        <div class="col-sm-9">
                            <span class="colon">:</span>
                            <textarea class="ckeditor" cols="50" id="txtContentE" name="txtContentE" rows="10"></textarea>

                            <span class="mandatory">*</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-group" id="pluginDrp">
                <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="selPluginName">Select Plugin</label>
                <div class="col-sm-4">
                    <span class="colon">:</span>
                    <select class="form-control" name="selPluginName" id="selPluginName">
                        <option value="0">- Select -</option>

                    </select>
                    <span class="mandatory">*</span>
                </div>
            </div>

            <div class="form-group" id="divDocfile">
                <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="lbldocfile"> Upload Document</label>
                <div class="col-sm-4">
                    <span class="colon">:</span>
                    <input type="file" id="docFile" name="docFile" placeholder="" class="form-control">
                    <input type="hidden" name="hdnDocFile" id="hdnDocFile" value="<?php echo $strDocFile; ?>" />
                </div>
                <div class="help-inline col-xs-12 col-sm-6">
                    <?php
                    $extDoc = pathinfo($strDocFile, PATHINFO_EXTENSION);
                    if ($id != '' && $strDocFile != '') {
                        $display = '';
                    } else {
                        $display = 'style="display:none;"';
                    }
                    if ($strDocFile != '') {
                        if ($extDoc == 'pdf') {
                    ?>
                            <a href="<?php echo APP_URL ?>uploadDocuments/LinkDoc/<?php echo $strDocFile; ?>" target="_blank">
                                <img id="imageFile1" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strDocFile; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                        <?php } else if ($extDoc == 'xls' || $extDoc == 'xlsx') { ?>
                            <a href="<?php echo APP_URL ?>uploadDocuments/LinkDoc/<?php echo $strDocFile; ?>" target="_blank">
                                <img id="imageFile2" src="<?php echo APP_URL; ?>img/excel-icon.png" alt="<?php echo $strDocFile; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                    <?php }
                    } ?>


                    <span id="imgMsg" class="red">(Only pdf,xls,xlsx files upto 10MB)</span>
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
    $(doucment).ready(function() {
        ShowHideTempTyp(1);
    })

    function ShowHideLnkTyp(linkType) {

        if (linkType == '1') {
            $("#templateDiv").show();
            $("#divUrl").hide();
            $("#divUploadDocument").hide();
            $("#selPluginName").val('');
        }
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 1) {
            $("#divContentEn").show();
            $("#divContentO").show();
            $("#divMainPic").show();
        }
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 2)
            $("#pluginDrp").show();
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 4)
            $("#divDocfile").show();
        if (linkType == '2') {
            $("#templateDiv").hide();
            $("#divUrl").show();

            $("#divUploadDocument").show();
            if ($('#txtURL').val == '')
                $("#txtURL").val('http://');
            $("#divContentEn").hide();
            $("#divMainPic").hide();
            $("#pluginDrp").hide();
            $('#txtContentE').html('');
            $("#divContentO").hide();
            $("#divDocfile").hide();

        }
    }

    function ShowHideTempTyp(tempType) {
        if (tempType == '1') {
            $("#divContentEn").show();
            $("#pluginDrp").hide();
            $("#selPluginName").val('');
            $("#divContentO").show();
            $("#divDocfile").hide();
            $("#divMainPic").show();
        }
        if (tempType == '2') {
            $("#pluginDrp").show();
            $("#divContentEn").hide();
            $("#txtContent").val('');
            $("#divContentO").hide();
            $("#txtContentO").val('');
            $("#divDocfile").hide();
            $("#divMainPic").hide();
        }
        if (tempType == '3') {
            $("#pluginDrp").hide();
            $("#divContentEn").hide();
            $("#txtContent").val('');
            $("#divContentO").hide();
            $("#txtContentO").val('');
            $("#divDocfile").hide();
            $("#divMainPic").hide();
        }
        if (tempType == '4') {
            $("#divDocfile").show();
            $("#pluginDrp").hide();
            $("#divContentEn").hide();
            $("#txtContent").val('');
            $("#divContentO").hide();
            $("#txtContentO").val('');
            $("#divMainPic").hide();
        }
    }
    // function to get page content
    
    function getHiddenPage(id) {
        var btnValue = $('#' + id).val();
        CKEDITOR.instances['txtContentE'].setData(arrcontent[btnValue - 1]);
    }

    var ctr = 0;
    $(".contentLabel").live("click", function() {
        $(".contentLabel").removeClass('activeBtn');
        $(this).addClass('activeBtn');
        var lastId = $('.contentLabel:last').val();
        var idVal = $(this).attr("id");
        var btnValue = $('#' + idVal).val();
        var content = arrcontent[Number(btnValue) - 1];
        var prevContent = arrcontent[Number(btnValue) - 2];
        if (content != '')
            CKEDITOR.instances['txtContentE'].setData(content);
        var page_content = CKEDITOR.instances['txtContentE'].getData();

        // var page_content = CKEDITOR.instances['txtContentE'].getData();
        if (btnValue != 1 && prevContent == '') {
            $('#hdnPageId').val(Number(btnValue - 1));
            var pageno = Number(btnValue) - 1;
            viewAlert("Page" + pageno + " Content can not be left blank");
            $('#conBTn' + pageno).focus();
            return false;
        } else {
            $('#hdnPageId').val(btnValue);
            getHiddenPage(idVal);
            $('#hdnCurrentId').val(btnValue);
        }
    });

    function getHiddenPageO(id) {
        var btnValueO = $('#' + id).val();
        CKEDITOR.instances['txtContentO'].setData(arrcontentO[btnValueO - 1]);
    }

    var ctr = 0;
    $(".contentLabelO").live("click", function() {
        $(".contentLabelO").removeClass('activeBtnO');
        $(this).addClass('activeBtnO');
        var lastIdO = $('.contentLabelO:last').val();
        var idValO = $(this).attr("id");
        var btnValueO = $('#' + idValO).val();
        var contentO = arrcontentO[Number(btnValueO) - 1];
        var prevContentO = arrcontentO[Number(btnValueO) - 2];
        // if(contentO!='')
        //     CKEDITOR.instances['txtContentO'].setData(contentO);
        // var page_contentO   = CKEDITOR.instances['txtContentO'].getData();

        // var page_content = CKEDITOR.instances['txtContentE'].getData();
        if (btnValueO != 1 && prevContentO == '') {
            $('#hdnPageId').val(Number(btnValueO - 1));
            var pagenoO = Number(btnValueO) - 1;
            viewAlert("Page" + pagenoO + " Content can not be left blank");
            $('#conBTnO' + pagenoO).focus();
            return false;
        } else {
            $('#hdnPageIdO').val(btnValueO);
            getHiddenPageO(idValO);
            $('#hdnCurrentIdO').val(btnValueO);
        }


    });
</script>