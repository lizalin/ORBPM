<?php
/* ================================================
  File Name         	  : addPlugindetails.php
  Description		  : This is used for add plugin details.
  Designed By		  :  T Ketaki Debadarshini  
  Designed On		  : 09-Sep-2015 
  Devloped By             :  T Ketaki Debadarshini  
  Devloped On             : 09-Sep-2015 
  Update History		  :	<Updated by>		<Updated On>		<Remarks>

  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
  includes			  :	header.php, navigation.php, util.php, footer.php,addPlugindetailsInner.php

  ================================================== */

require 'addPlugindetailsInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo APP_URL; ?>ckeditor/ckeditor.js"></script>
<script language="javascript">
    $(document).ready(function () {
        
        pageHeader   = "<?php echo $strTab.' '.$_SESSION['sessPageName']; ?> ";
        strFirstLink = "Manage Application";
        strLastLink  = "<?php echo $_SESSION['sessPageName']; ?>"; 
        
        indicate = 'yes';
        $('#txtHeadlineE').focus();
      

        <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                    alert('<?php echo $outMsg; ?>');
        <?php }if ($flag == 1 && $id != 0) { ?>
                    window.location.href = '<?php echo APP_URL; ?>viewPlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>';
        <?php } ?>
                $('#close').click(function () {
                    if (!confirm('Are you sure to delete selected File'))
                        return false;

                    $('#hdnDocFile').val('');
                    $('#imageFile').hide();
                    $(this).hide();
                });
            });
            function validator()
            {
                <?php if($_SESSION['sessFuncId'] == 9){?>
                if(!selectDropdown('selCat','Select Category'))
                    return false; 
                <?php } ?>
                if (!blankCheck('txtHeadline', 'Headline can not be left blank'))
                    return false;
                if (!checkSpecialChar('txtHeadline'))
                    return false;
                if (!maxLength('txtHeadline', 300, 'Headline '))
                    return false;
                
                
                if ($('#fileDocument').val() != '')
                {
                    if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'pdf'))
                        return false;
                    var fileSize_inKB = Math.round(($("#fileDocument")[0].files[0].size / 1024));
                    if (fileSize_inKB > 10240)
                    {
                        alert('File size can not be more than 10MB.');
                        return false;
                    }
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
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab;?></a> 
                <a href="<?php echo APP_URL; ?>viewPlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a> <a href="<?php echo APP_URL; ?>archievePlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archieve</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
            <?php if($_SESSION['sessFuncId'] == 9){?>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtHeadline">Select Category</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select name="selCat" id="selCat" class="form-control"><?php echo $objPlugin->fillSchemeCat($strFnsubcat);?></select>
                        <span class="mandatory">*</span>
                    </div>
                </div> 
            <?php } ?>
            <?php if($_SESSION['sessFuncId'] == 13){?>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="type">Select Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        Office Orders 
                        <input type="radio" name="selCat" id="radType1" value="1" checked="checked" <?php if($strFnsubcat==1){echo 'checked="checked"';}?> />
                        &nbsp; Circulars 
                        <input type="radio" name="selCat" id="radType2" value="2" <?php if($strFnsubcat==2){echo 'checked="checked"';}?> />
                        <span class="mandatory">*</span>
                    </div>
                </div> 
            <?php } ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtHeadline">Headline</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtHeadline" name="txtHeadline" maxlength="300" placeholder="" class="form-control" value="<?php echo $strHeadLine; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="fileDocument">Document</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocument" name="fileDocument" placeholder="" class="form-control">
                        <input type="hidden" name="hdnDocFile" id="hdnDocFile" value="<?php echo $strFileName; ?>"/>
                    </div>
                    <?php
                    if ($id != '' && $strFileName != '') {
                        $display = '';
                    } else {
                        $display = 'style="display:none;"';
                    }
                    if ($strFileName != '') {
                        ?>
                        <a href="<?php echo APP_URL ?>uploadDocuments/plugin/<?php echo $strFileName; ?>" target="_blank">
                       <img id="imageFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strFileName; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                   <?php } ?>
                       
                    <span class="red">*(.pdf file only and Max size file Size 10 MB)</span>
                </div>
                <div class="form-group contentval1 contentActive">
                    <label class="col-sm-2 control-label no-padding-right" for="txtContentE">Description </label>
                    <div class="col-sm-10">
                        <span class="colon">:</span>
                        <textarea class="ckeditor" cols="50" id="txtDesc" name="txtDesc" rows="10"><?php echo $strDesc;?></textarea>

                        <span class="mandatory">*</span>                  
                    </div>
                </div>
            <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="rbtLnkType">Link Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input name="rbtLnkType" type="radio" class="ace" value="1" <?php if ($intLinkType == 1) { ?>checked="checked"<?php } ?> >
                                <span class="lbl"> Commerce</span>
                            </label>
                            <label>
                                <input name="rbtLnkType" type="radio" value="2" class="ace" <?php if ($intLinkType == 2) { ?>checked="checked"<?php } ?> >
                                <span class="lbl"> Transport</span>
                            </label>
                        </div>
                      
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 no-padding-right"></div>
                    <div class="col-sm-4">
                        <input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $strSubmit; ?>" class="btn btn-success" onclick="return validator();"/>
                        <input type="reset" id="btnReset" name="btnReset"  class="btn btn-danger" value="<?php echo $strReset; ?>" onclick="<?php echo $strclick; ?>" />
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


