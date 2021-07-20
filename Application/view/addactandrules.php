<?php
	/* ================================================
	File Name         	  : addactandrules.php
	Description		  : This is used for add Act and Rules Details.
	Designed By		  : Chinmayee
        Designed On		  : 25-May-2016
        Devloped By		  : Chinmayee
        Devloped On		  : 28-May-2016
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
					
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes		  :	header.php, navigation.php, util.php, footer.php,addGallerycategoryInner.php

	==================================================*/
	
     require 'addactandrulesInner.php';
?>


<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
        $(document).ready(function () {
             	pageHeader   = "Add Whats New";
                strFirstLink = "Manage Application";
                strLastLink  = "Whats New"; 
          //fillActplugin('selType','<?php echo $selplugintype;?>');                 
               <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                viewAlert('<?php echo $outMsg; ?>');
            <?php }if ($flag == 1 && $id != 0) { ?>
                        window.location.href = '<?php echo $redirectLoc;?>';
            <?php } ?>
                  
	});
              function validator()
            {
               
                if (!blankCheck('txtCaption', 'Headline can not be left blank'))
                    return false;
                if (!checkSpecialChar('txtCaption'))
                    return false;
                if (!maxLength('txtCaption',400, 'Headline'))
                    return false;
                 /* if($('#selType').val()=='http://')
                {
                 if (!blankCheck('selType', 'URL can not left blank'))
                return false;
                }*/
                    var url=$.trim($('#selType').val());
                    var url=url.replace("http://",'');
                    var prevdoc = $('#hdnDocFile').val();
                  if($('#fileDocument').val()=='' &&  url=='' && prevdoc =='')
                     {
                         viewAlert('Please enter Url Or upload Document'); 
                         return false;
                     }
                 if($('#fileDocument').val()!='' &&  url!='')
                     {
                         viewAlert('Please enter Url Or upload Document'); 
                         return false;
                     }
                  if($('#fileDocument').val()=='')
                     {
                         if (!checkSpecialChar('selType'))
                          return false;
               
                        if (!validURL('selType','Please enter a valid URL'))
                         return false;
                     }
                   
                 <?php /*if($id == 0){?>
                        if (!blankCheck('fileDocument', 'Please Upload Document File'))
                             return false;
                        <?php }*/  ?>   
                      
                      if ($('#fileDocument').val() != '')
                        {

                             if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'pdf,xls'))
                                   return false;
                             var fileSize_inKB = Math.round(($("#fileDocument")[0].files[0].size / 1024));
                             if (fileSize_inKB > 20480)
                             {
                                 viewAlert('Document File size cannot be more than 20MB.');
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
        
           <div class="clearfix"></div>
             <div class="top_tab_container">
               
                <?php  if($adminConsole_Privilege==0|| $adminConsole_Privilege==1 ||$intPermission!=2) { ?>
                    <a href="javascript:void(0);" class="btn btn-info active">Add</a>
                <?php }?>
               
                <a href="<?php echo APP_URL;?>viewactandrules/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                 <a href="javascript:void(0);" class="btn btn-info ">Archive</a> 
            
             </div>
           
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
           <div class="col-xs-12"> 
		<!--div class="form-group" >
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="selType">Section</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="selType" id="selType" >
                         
                         </select>
                           <span class="mandatory">*</span>            
                    </div>
                </div-->             
              
              
               <div class="form-group">
                   <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCaption">Headline in English</label>
                   <div class="col-sm-4">
                       <span class="colon">:</span>
                       <input type="text" id="txtCaption" name="txtCaption" maxlength="400" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                       <span class="mandatory">*</span>
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCaption">Headline in Odia</label>
                   <div class="col-sm-4">
                       <span class="colon">:</span>
                       <input type="text" id="txtCaptionO" name="txtCaptionO" maxlength="400" placeholder="" class="form-control akrutiorisarala" value="<?php echo $strCategoryO; ?>">
                       <!--span class="mandatory">*</span-->
                   </div>
               </div>
                    <div class="form-group">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtURL">URL</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="selType" name="selType" placeholder="" class="form-control" value="<?php echo $strURL; ?>">
                         <!--span class="mandatory">*</span-->
                    </div>
                </div> 
   <div class="form-group">
                      <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="fileDocument">Document</label>
                      <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="file" id="fileDocument" name="fileDocument" placeholder="" class="form-control">
                            <small><span class="red">( .pdf ,.xls file only and Max size file Size 20 MB )</span></small>
                          <input type="hidden" name="hdnDocFile" id="hdnDocFile" value="<?php echo $strFileName; ?>"/>
                     <!--span class="mandatory">*</span-->  </div>
                      <?php
                      if ($id != '' && $strFileName != '') {
                          $display = '';
                      } else {
                          $display = 'style="display:none;"';
                      }
                      if ($strFileName != '') {
                          ?>
                          <a href="<?php echo APP_URL ?>uploadDocuments/Notification/<?php echo $strFileName; ?>" target="_blank">
                              <img id="imageFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strFileName; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                      <?php } ?>
                         
                      
                  </div>
             
             
<div class="form-group">
                      <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="radStatus">Publish Status</label>
                      <div class="col-sm-8">
                          <span class="colon">:</span>
                          <div class="radio">
                              <label>
                                  <input type="radio" name="radStatus" id="radStatus" class="ace" value="2"  <?php if ($intStatus == 2) { ?>checked="checked" <?php } ?> >
                                  <span class="lbl"> Active</span>
                              </label>
                              <label>
                                  <input type="radio" name="radStatus" id="radStatus" class="ace" value="1" <?php if ($intStatus == 1) { ?>checked="checked" <?php } ?> >
                                  <span class="lbl"> Inactive</span>
                              </label>

                          </div>
                      </div>
                  </div>
                      <div class="form-group">
                      <div class="col-sm-offset-3 col-md-offset-2 col-sm-8"><label><input name="chkbox" type="checkbox" value="0" class="ace chkbox" <?php if ($chkval == 1) { ?>checked="checked" <?php } ?>> 
                         &nbsp;<span class="lbl"> Tick here for blinking new items</span> </label></div>
                   </div> 
              
              <div class="form-group">
                <div class="col-sm-3  col-lg-2 no-padding-right"></div>
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

 
