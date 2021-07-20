<?php
	/* ================================================
	File Name         	  : addBanner.php
	Description		  : This is used for add Gallery Images Details.
	Designed By		  : 
        Designed On		  : 
        Devloped By		  : T Ketaki Debadarshini
        Devloped On		  : 24-Aug-2015
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
						
	Style sheet                 : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions          : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes			  :	header.php, navigation.php, util.php, footer.php,addBannerInner.php

	==================================================*/
	
     require 'addBannerInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo APP_URL; ?>ckeditor/ckeditor.js"></script>
<script language="javascript">
        $(document).ready(function () {
               // loadNavigation('<?php echo $strTab;?> Banner');
               pageHeader   = "<?php echo $strTab; ?> Banner";
                strFirstLink = "Manage Application";
                strLastLink  = "Manage Banner"; 
              
                $('#txtCaption').focus();
                $('#txtCaptionO').focus();
                indicate = 'yes';
             <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                viewAlert('<?php echo $outMsg; ?>');
            <?php }if ($flag == 1 && $id != 0) { ?>
                        window.location.href = '<?php echo APP_URL; ?>viewBanner/<?php echo $glId; ?>/<?php echo $plId; ?>';
            <?php } 
                   
             if($id==0){
            ?>
         $('#userImage').hide();
        <?php } else {?>
                $('#imgMsg').css('margin-left', '110px');
            <?php }?>
        
          
	});
        function validator()
            {
                            
                /*if (!blankCheck('txtCaption', 'Caption can not be left blank'))
                    return false;
                if (!checkSpecialChar('txtCaption'))
                    return false;
                if (!maxLength('txtCaption',130, 'Caption'))
                    return false; */
                //var page_content   = CKEDITOR.instances['txtCaption'].getData();

                /*if(page_content == ''){
                viewAlert('Caption can not be left blank');
                return false;
                }*/
        
                
                <?php if($id == 0){?>
                if (!blankCheck('fileDocument', 'Please Upload Image'))
                     return false;
                <?php }  ?>  
                  console.log($('#fileDocument').val());
               if ($('#fileDocument').val() != '')
                    {
                      
                         if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'jpeg,jpg,gif'))
                                    return false;
                           var fileSize_inKB = Math.round(($("#fileDocument")[0].files[0].size / 10240));
                            if (fileSize_inKB > 1024)
                            {
                                viewAlert('File size cannot be more than 10MB.');
                                return false;
                            }
                   } 
             

            }
        function readImage(input) {
            
            $('#userImage').show();
            if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                    $('#userImage').attr('src', e.target.result);
                    $('#imgMsg').css('margin-left', '110px');
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
          <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab;?></a> <a href="<?php echo APP_URL;?>viewBanner/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
           <div class="col-xs-12">                        
                <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="txtCaption">Caption </label>
                <div class="col-sm-4">
                <span class="colon">:</span>
                <input type="text" id="txtCaption" name="txtCaption" maxlength="130" placeholder="" class="form-control" value="<?php echo $strCaption; ?>">
               
                  <!--<span class="mandatory">*</span>-->
                </div>
              </div>
              
               <div class="form-group" ></div>
               <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="fileDocument">Upload Image</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocument" name="fileDocument" placeholder="" class="form-control" onChange="readImage(this);">
                        <input type="hidden" name="hdnImageFile" id="hdnImageFile" value="<?php echo $strFileName; ?>"/>
                        <span class="mandatory">*</span>
                        <small><span class="red">(jpeg,jpg,gif file only and Max size file Size 10 MB)</span></small>
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6" style="margin-top:25px;">
                        <?php if ($id > 0) { ?>
                            <img id="userImage" width="200" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10" src="<?php echo APP_URL . 'uploadDocuments/banner/' . $strFileName; ?>">
                        <?php } else { ?>
                            <img id="userImage" width="200" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10" >
                        <?php } ?>
                        <a href="javascript:void(0);" id="userImgClose" class="imgClose" style="display:none;">X</a>
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