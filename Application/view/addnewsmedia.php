<?php
/*================================================
	File Name         	: addnewsmedia.php
	Description		: This is used for adding news and media cms. 
	Designed By		: Indrani Biswas
    Designed On		: 03-Dec-2020
    Devloped By		: Indrani Biswas
    Devloped On		: 03-Dec-2020
	Update History		: <Updated by>	<Updated On>	<Remarks>
       
	Style sheet              : datepicker.css,custom.css                                          
	Javscript Functions      : jquery.min.js,custom.js,validatorchklist.js,loadAjax.js,bootstrap-datepicker.min.js
	includes		 : header.php, navigation.php, util.php, footer.php,addSpecialInfoInner.php

==================================================*/
require 'addnewsmediaInner.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css"/>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
    pageHeader   = "<?php echo $strTab; ?> News and Media";
    strFirstLink = "Manage Application";
    strLastLink  = "News and Media";
    
    $('[data-rel=tooltip]').tooltip();   

    <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>','','<?php echo APP_URL; ?>viewnewsmedia/<?php echo $glId; ?>/<?php echo $plId; ?>');
     <?php } ?>

     $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
    });
     
     $(".divImg").hide();
     $(".divVideo").hide();

     showTypeDet(<?php echo $selType;?>);

    });
        
    function validator(){
          
        if (!blankCheck('txtTitleE', 'Title in english can not be left blank'))
        return false;
        
        if (!checkSpecialChar('txtTitleE'))
        return false; 

        if (!maxLength('txtTitleE',250, 'Title in english'))
        return false;

        if (!blankCheck('txtDetailsE', 'Description in english can not be left blank'))
        return false;
        
        if (!checkSpecialChar('txtDetailsE'))
        return false; 

        if (!maxLength('txtDetailsE',500, 'Description in english'))
        return false;

        if (!blankCheck('txtPublishDate', 'Publish Date can not be left blank'))
        return false;

        if ($('#fileDocument').val() != '')
        {

             if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'pdf,jpg'))
                     return false;
             var fileSize_inKB = Math.round(($("#fileDocument")[0].files[0].size / 1024));
             if (fileSize_inKB > 51200)
             {
                 viewAlert('Document File size cannot be more than 10MB.');
                 return false;
             }
        }    

        if(!selectDropdown('selType', 'Select Media Type'))
        return false;

        if ($('#selType').val() ==1 )
        {
                       <?php if($id == 0){?>
                        if (!blankCheck('fileImage', 'Please Upload Image.'))
                             return false;
                        <?php }  ?>   
                      
                      if ($('#fileImage').val() != '')
                        {

                             if (!IsCheckFile('fileImage', 'Invalid file types for Upload Image. Upload only ', 'jpeg,jpg,png'))
                                   return false;
                             var imgfileSize_inKB = Math.round(($("#fileImage")[0].files[0].size / 1024));
                             if (imgfileSize_inKB > 51200)
                             {
                                 viewAlert('Image File size cannot be more than 10 MB.');
                                 return false;
                             }
                       } 
        }
        if($('#selType').val() == 2)
        {
             if('<?php echo $id;?>'== '0' || '<?php echo $strVideoName;?>'=='' )
                            {
                                if(!blankCheck('filevideo','Please Upload video'))
                                        return false;
                            }
                           if ($('#filevideo').val() != '')
                            {
                                if(!IsCheckFile('filevideo', 'Invalid file type for Upload Video. Upload only filetype','mp4'))          
                                {
                                    $("#filevideo").focus();
                                    return false;
                                }
                                var videofileSize_inKB = Math.round(($("#filevideo")[0].files[0].size / 1024));
                                if (videofileSize_inKB > 51200)
                                {
                                    viewAlert('Video File size cannot be more than 10MB.');
                                    return false;
                                }   
                            } 
        }                       
    } 

     function showTypeDet(idVal)
            {               
                if (idVal == 1)
                {
                    $(".divImg").show();
                    $(".divVideo").hide();
                }
                else if (idVal == 2)
                {
                   $(".divVideo").show();
                   $(".divImg").hide();
                } 
                else if(idVal == 0)
                {
                   $(".divImg").hide();
                   $(".divVideo").hide(); 
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

            <div class="top_tab_container">
                <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab; ?></a> 
                <a href="<?php echo APP_URL; ?>viewnewsmedia/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">
                 
                <div class="form-group" id="divtitleE">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtTitleE">Title in English </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTitleE" name="txtTitleE" maxlength="250" placeholder="" class="form-control" value="<?php echo $strTitleE; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div> 
                 <div class="form-group" id="divtitleO">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtTitleO">Title in Odia</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtTitleO" name="txtTitleO" maxlength="250" placeholder="" class="form-control akrutiorisarala" value="<?php echo $strTitleO; ?>">

                    </div>
                </div> 
                <div class="form-group" id="divContentEn">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDetailsE">Description in English</label>
                        <div class="col-sm-4">
                            <span class="colon">:</span>
                            <textarea class="form-control" id="txtDetailsE" name="txtDetailsE" rows="3" maxlength="500"><?php echo $strDetailsE; ?></textarea>
                             <span class="mandatory">*</span>
                        </div>
                </div>  
                <div class="form-group" id="divContentO">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDetailsO">Description in Odia</label>
                        <div class="col-sm-4">
                            <span class="colon">:</span>
                            <textarea class="form-control akrutiorisarala" id="txtDetailsO" name="txtDetailsO" rows="3" maxlength="500"><?php echo $strDetailsO; ?></textarea>

                        </div>
                </div>
                <div class="form-group" id="divSourceName">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtSourceName">Source Name</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtSourceName" name="txtSourceName" maxlength="250" placeholder="" class="form-control" value="<?php echo $strSourceName; ?>">
                    </div>
                </div>  
                <div class="form-group" id="divSource">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtSource">Source Url</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtSource" name="txtSource" maxlength="250" placeholder="" class="form-control" value="<?php echo $strSource; ?>">
                    </div>
                </div>
                 <div class="form-group" id="divPublishDate">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtPublishDate"> Publish Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtPublishDate" id="txtPublishDate" class="form-control date-picker" value="<?php echo $publishdate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div> 
                        <span class="mandatory">*</span>
                    </div>
                </div>
              <div class="form-group">
                      <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="fileDocument">Upload Document</label>
                      <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="file" id="fileDocument" name="fileDocument" placeholder="" class="form-control">
                            <small><span class="red">( .pdf ,.jpg file only and Max size file Size 10 MB )</span></small>
                          <input type="hidden" name="hdnDocFile" id="hdnDocFile" value="<?php echo $strFileName; ?>"/>
                       </div>
                      <?php
                      $extDoc = pathinfo($strFileName, PATHINFO_EXTENSION);
                      if ($id != '' && $strFileName != '') {
                          $display = '';
                      } else {
                          $display = 'style="display:none;"';
                      }
                      if ($strFileName != '') {
                            if($extDoc=='pdf'){
                          ?>
                          <a href="<?php echo APP_URL ?>uploadDocuments/NewsMedia/<?php echo $strFileName; ?>" target="_blank">
                              <img id="pdfdocFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strFileName; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                      <?php } else {?>
                              <img id="imagedocFile" src="<?php echo APP_URL ?>uploadDocuments/NewsMedia/<?php echo $strFileName; ?>" alt="<?php echo $strFileName; ?>" width="100" height="100" <?php echo $display; ?> /> 
                      <?php }} ?>
                         
                      
                  </div>
                <div class="form-group" >
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="selType">Media Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="selType" id="selType" onChange="showTypeDet(this.value);">
                            <option value="0" <?php if ($selType == 0) echo 'selected="selected"'; ?> >- Select -</option>  
                            <option value="1" <?php if ($selType == 1) echo 'selected="selected"'; ?>>Photo</option>
                            <option value="2" <?php if ($selType == 2) echo 'selected="selected"'; ?>>Video</option>
                        </select>
                           <span class="mandatory">*</span>            
                    </div>
                </div>

                <div class="form-group divImg">
                      <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="fileImage">Upload Image</label>
                      <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="file" id="fileImage" name="fileImage" placeholder="" class="form-control">
                            <small><span class="red">( .jpg,.jpeg,.png files only and Max size file Size 10 MB )</span></small>
                          <input type="hidden" name="hdnImgFile" id="hdnImgFile" value="<?php echo $strImgName; ?>"/>
                     <span class="mandatory">*</span>
                      <?php
                      if ($id != '' && $strImgName != '') {
                          $display = '';
                      } else {
                          $display = 'style="display:none;"';
                      }
                      if ($strImgName != '') {
                          ?>
                              <img id="uploadImg" src="<?php echo APP_URL ?>uploadDocuments/NewsMedia/<?php echo $strImgName; ?>" alt="<?php echo $strImgName; ?>" width="100" height="100" <?php echo $display; ?> />
                      <?php } ?>
                     </div>   
                  </div>

                <div class="form-group divVideo" >
                    <label class="col-sm-2 control-label no-padding-right" for="filevideo">Upload Video</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="filevideo" name="filevideo" class="form-control" >
                        <input type="hidden" name="hdnvideoFile" id="hdnvideoFile" value="<?php echo $strVideoName; ?>"/>
                      <span class="mandatory">*</span>
                    </div>
                    <?php
                      if ($id != '' && $strVideoName != '') {
                          $display = '';
                      } else {
                          $display = 'style="display:none;"';
                      }
                      if ($strVideoName != '') {
                          ?>
                          <a href="<?php echo APP_URL ?>uploadDocuments/NewsMedia/<?php echo $strVideoName; ?>" class="html5lightbox" data-group="set1"  title="Video" target="_blank">
                              <img id="uploadVideo" src="<?php echo APP_URL; ?>img/video-player.png" alt="<?php echo $strVideoName; ?>" width="16" height="16" <?php echo $display; ?> />
                          </a>   
                      <?php } ?>
                </div>
                 <div class="form-group divVideo">
                    <label class="col-sm-2 control-label no-padding-right"></label>
                    <div class="col-sm-4">
                       <span class="red">* &nbsp; (mp4 files upto 10 MB only)</span>
                    </div>
                </div>
               
              
               <div class="form-group">
                   <div class="col-sm-3  col-lg-2 no-padding-right"></div>
                   <div class="col-sm-4">
                       <input type="submit" id="btnSubmit" name="btnSubmit" value="<?php echo $strSubmit; ?>" class="btn btn-success" onclick="return validator();"/>
                       <input type="reset" id="btnReset" name="btnReset"  class="btn btn-danger" value="<?php echo $strReset; ?>" onclick="<?php echo $strclick; ?>" />
                       <input type="hidden" id="hdnSlNo" name="hdnSlNo" value="<?php echo $intSlNo; ?>"/>
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

 
