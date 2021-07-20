<?php
/*================================================
	File Name         	: addNotification.php
	Description		: This is used for Notification /Tender / Route Rationalization 
                                /Guideline for Public.
	Designed By		: Sonali Satapathy
        Designed On		: 29-SEPT-2016
        Devloped By		: Sonali Satapathy
        Devloped On		: 29-SEPT-2016
	Update History		: <Updated by>	<Updated On>	<Remarks>
       
	Style sheet              : datepicker.css,custom.css                                          
	Javscript Functions      : jquery.min.js,custom.js,validatorchklist.js,loadAjax.js,bootstrap-datepicker.min.js
	includes		 : header.php, navigation.php, util.php, footer.php,addNotification.php

==================================================*/
require 'addAuctionNoticeInner.php';
//echo $intTemplateType;//exit();
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css"/>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
    pageHeader   = "<?php echo $strTab; ?> Auction Notice";
    strFirstLink = "Manage Application";
    strLastLink  = "Auction Notice";
    
    displayCkeditor('txtDetailsE'); 
    displayCkeditor('txtDetailsO');
    $('[data-rel=tooltip]').tooltip();   
    $('#ddlType').focus();
     $('#divUrl').hide();
     $('#divuploadDocument').hide();
        
     $('#pluginDrp').hide();
     
    fillPlugins('selPluginName','<?php echo $intPluginId ;?>');/*fill all plugin name*/
    fillRTOOfficeName('RTOType','<?php echo $strlinkType;?>');
   ShowHideTempTyp(<?php echo $intTemplateType;?>);
     <?php if($id > 0){ ?>
        ShowHideLnkTyp(<?php echo $intUrlType;?>);
        if(<?php echo $intUrlType;?> == 1){
                
         }
    <?php }?>
       
       

    $('.date-picker').datepicker({
	autoclose: true,
	todayHighlight: true
    });
    <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            viewAlert('<?php echo $outMsg; ?>');
     <?php }if ($flag == 0 && $id != 0 && isset($_REQUEST['btnSubmit'])) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>';
    <?php } ?>
    $('.remove').not(':first').show();
    $('.addMore').on('click', function () {
            var totRowNo = $('.morePayPercentage').length;
            if (($('#fileDocument' + totRowNo).val()=="") && ($('#hdnDocFile' + totRowNo).val()==""))
                {
                    viewAlert("Upload Material -" +totRowNo+ "  can not left blank");
                    return false;     
                }
            var cloneDiv = $(this).closest('.form-group').clone(true);
            cloneDiv.find('input[type=text]').val('');
            cloneDiv.find('input[type=hidden]').val('');
             cloneDiv.find('.imageFile').html('');
            $(this).closest('.form-group').after(cloneDiv);
            $('.remove').not(':first').show();
            $('.morePayPercentage').each(function (e) {
                var rowNo = Number(e) + 1;
                $('.morePayPercentage:last').find('.percentageVal').val('');
                $('.morePayPercentage:last').find('.hdnpercentageVal').val('');
                $(this).find('.perInstNo').html(rowNo);
                $(this).find('.percentageVal').attr('id', 'fileDocument' + rowNo);
                $(this).find('.hdnpercentageVal').attr('id', 'hdnDocFile' + rowNo);
                
                
            });
      });
      
      $('.remove').on('click', function () {
            $(this).closest('.form-group').remove();
            $('.morePayPercentage').each(function (e) {
                var rowNo = Number(e) + 1;
                $(this).find('.perInstNo').html(rowNo);
                $(this).find('.percentageVal').attr('id', 'fileDocument' + rowNo);
                $(this).find('.hdnpercentageVal').attr('id', 'hdnDocFile' + rowNo);
            });
      });
    $('input:radio[name="radStatus1"]').click(function(){
                <?php if($id==0){ ?>
                    $('#txtCategory').val('');
                    $('#txtCategoryO').val('');
                    $('#txtrandNum').val('');
                    $('#txtStartDate').val('');
                    $('#txtClosingDate').val('');
                    $('#noticeType').val('');
                <?php }?>
                var linkType = $("input:radio[name='radStatus1']:checked").val();
                 if(linkType==1 || linkType==2 || linkType==3){
                      $('#docLevel').html('Upload Document');
                     $('.docfile').val('');
                      $('#tenderopen-date').show();
                      $('#txtheadE').show();
                      $('#txtheadO').show();
                       $('#chBlink').show();
                   $('#tenderopen-date').find('.open-date').html('Notification Date'); 
                }
                if(linkType==1){
                    $('#tenderopen-date').find('.open-date').html('Notification Date');
                $('#showSection').show();
                    fillcircularSection('noticeType',0);
                }else{
                    $('#showSection').hide(); 
                }
                if(linkType==1 || linkType==2){

                    $('#showCode').show();
                }else{
                    $('#showCode').hide();    
                }
                if(linkType==2){

                    $('#tenderopen-date').find('.open-date').html('Tender Open Date');
                    $('#showTenderdt').show();
                }else{
                    $('#showTenderdt').hide();  
                }
 
        });
                
    });
        
    function validator(){
       
        if(!selectDropdown('RTOType', 'Please Select RTO Office'))
        return false;  
        
        if (!blankCheck('txtCategory', 'ActionNotice can not be left blank'))
            return false;
        if (!maxLength('txtCategory',200, 'ActionNotice'))
            return false;
        
        if(!blankCheck('txtrandNum', 'Action Code can not be left blank'))
            return false;
        if(!validateCharNumber('txtrandNum', 'Action Code'))
            return false; 
        if (!checkSpecialChar('txtrandNum'))
            return false;
                
        if (!blankCheck('txtStartDate', 'Date can not be left blank'))
            return false;
        if (!checkSpecialChar('txtCategory'))
         return false;
         
       
       
         if($('input:radio[name=radTemplateType]:checked').val() == 2 ){
             
                  var totRowNo2 = $('.morePayPercentage').length;
                    $("#hdnTotalDoc").val(totRowNo2);
                    if (($('#fileDocument1').val()=="") && ($('#hdnDocFile1').val()=="")){
                        viewAlert('Please Upload one Document File');
                        return false;
                    }
                    if (!validDocument()){
                        return false;
                    }else{
                        return true;   
                    }
        
       }
       if($('input:radio[name=radTemplateType]:checked').val() == 3 ){
                  
                    if($('#selPluginName').val()==0){
                      viewAlert('Please Select Plugin Type');
                      return false;
                       }
           }
           
                
    }    
    function validDocument(){
        var totRowNo = $('.morePayPercentage').length;  
        for (var i = 1; i <= totRowNo; i++)
        {
            if (($('#fileDocument' + totRowNo).val()=="") && ($('#hdnDocFile' + totRowNo).val()==""))
            {
                viewAlert("Upload Document -" +totRowNo+ "  can not left blank");
                return false;     
            }
            if ($('#fileDocument' + i).val()!= '')
            {
                var fileDocument = 'fileDocument'+i;
                if (!IsCheckFile(fileDocument, "Document  -" +i+ ' Invalid file types. Upload only ', 'pdf,xls'))
                {
                    return false;
                }
                var fileSize_inKB = Math.round(($("#fileDocument"+ i)[0].files[0].size / 1024));
                if (fileSize_inKB > 16384)
                {
                    viewAlert("Document  -" +i+ " File size cannot be more than 16MB.");
                    return false;
                }
            }
                    
                    
                    
        }
        return true;
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
                <a href="<?php echo APP_URL; ?>viewAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                <a href="<?php echo APP_URL; ?>archiveAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a></div>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="col-xs-12">   
              
            <div class="form-group" id="RTOSection">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="ddlType">RTO Office </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        
                        <select class="form-control" name="RTOType" id="RTOType">
                           
                        </select>
                        <span class="mandatory">*</span>             
                    </div>
            </div> 
                <div class="form-group" id="txtheadE">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCategory">Action Notice in English </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtCategory" name="txtCategory" maxlength="200" placeholder="" class="form-control" value="<?php echo $strCategory; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
                <div class="form-group" id="txtheadO">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCategory">Action Notice in Odia</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtCategoryO" name="txtCategoryO" maxlength="200" placeholder="" class="form-control akrutiorisarala" value="<?php echo $strCaptionO; ?>">

                    </div>
                </div>
                <div class="form-group" id="showCode">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtCategory">Action Code</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtrandNum" name="txtrandNum" maxlength="10" placeholder="" class="form-control"  value="<?php echo $strCode; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>
              
                 <div class="form-group" id="auctionNoticeDate">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right open-date" for="txtOpeningDate"> Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" data-date-format="dd-mm-yyyy" name="txtStartDate" id="txtStartDate" class="form-control date-picker" value="<?php echo $strstartdate; ?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>

                        </div> <span class="mandatory">*</span>
                    </div>
                </div>
                
                 <!--<div class="form-group">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="rbtLnkType1">Link Type</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input name="rbtLnkType" id="rbtLnkType1" type="radio" class="ace" value="1"  onClick="ShowHideLnkTyp(this.value);" <?php if ($intUrlType == 1) { ?>checked="checked"<?php } ?> >
                                <span class="lbl"> Internal</span>
                            </label>
                            <label>
                                <input name="rbtLnkType"  id="rbtLnkType2" type="radio" value="2" class="ace" onClick="ShowHideLnkTyp(this.value);" <?php if ($intUrlType == 2) { ?>checked="checked"<?php } ?> >
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
                                <input name="radWinStatus" type="radio" class="ace" value="1" <?php //if ($intWinStatus == 1) { ?> checked="checked" <?php //} ?>>
                                <span class="lbl"> Same</span>
                            </label>
                            <label>
                                <input name="radWinStatus" type="radio" value="2" class="ace" <?php //if ($intWinStatus == 2) { ?> checked="checked" <?php //} ?>>
                                <span class="lbl"> New</span>
                            </label>
                        </div>
                    </div>
                </div>-->
                
                 <!--<div class="form-group" id="divUrl">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtURL">URL</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>                        
                        <input type="text" name="txtURL" id="txtURL" class="form-control" value="<?php //echo //$strURL ?>"/>
                        <span class="mandatory">*</span>               
                    </div>
                </div>-->
                
                 <div class="form-group" id="templateDiv">
                    <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="radTemplateType">Page Content</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="radio">
                              <label>
                                <input name="radTemplateType" type="radio"  value="1" class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTemplateType == 1) { ?> checked="checked" <?php } ?>  >
                                <span class="lbl"> Content</span>
                            </label>
                            <label>
                                <input name="radTemplateType" type="radio" value="2"  class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTemplateType == 2) { ?> checked="checked" <?php } ?> >
                                <span class="lbl">Document</span>
                            </label>
                            <label>
                                <input name="radTemplateType" type="radio" value="3" class="ace" onClick="ShowHideTempTyp(this.value);" <?php if ($intTemplateType == 3) { ?> checked="checked" <?php } ?> >
                                <span class="lbl">Plugin</span>
                            </label> 

                        </div>

                    </div>
                </div>
                  <div class="form-group" id="divContentEn">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDetailsE">Details  in English</label>
                        <div class="col-sm-9">
                            <span class="colon">:</span>
                            <textarea class="ckeditor form-control" id="txtDetailsE" name="txtDetailsE" rows="10"><?php echo $strDetailsE; ?></textarea>

                        </div>
                    </div>  
                    <div class="form-group" id="divContentO">
                        <label class="col-sm-3  col-lg-2  control-label no-padding-right" for="txtDetailsE">Details in Odia</label>
                        <div class="col-sm-9">
                            <span class="colon">:</span>
                            <textarea class="ckeditor form-control" id="txtDetailsO" name="txtDetailsO" rows="10"><?php echo $strDetailsO; ?></textarea>

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
               
                <?php
                if ($id > 0) {
                   
                    $fileExp = explode(',', $strFileName);
                    $tot = count($fileExp);
                    for ($i = 1; $i <= $tot; $i++) {
                        $j = $i - 1;
                        $fileName = $fileExp[$j];
                        $fileName = str_replace('"', '', $fileName);
                        ?>
                        <div class="form-group morePayPercentage filedocs" id="divuploadDocument1">
                            <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="fileDocument">Upload Document <span class="perInstNo"><?php //echo $i; ?></span></label>
                            <div class="col-sm-8">
                                <span class="colon">:</span>
                                <div class="col-sm-6 padding-left0">
                                    <input type="file" id="fileDocument<?php echo $i; ?>" name="fileDocument[]" placeholder="" class="percentageVal form-control">
                                    <input type="hidden" name="hdnDocFile[]" id="hdnDocFile<?php echo $i; ?>" value="<?php echo $fileName; ?>" class="hdnpercentageVal form-control"/>
                                    <input type="hidden" name="hdnTotalDoc" id="hdnTotalDoc" value=""/>
                                    <span class="mandatory">*</span>  
                                </div>
                                <div class="col-sm-3  col-lg-2">
                                    <a href="javascript:void(0);" class="btn btn-xs btn-sm btn-success  addMore" data-rel="tooltip" data-placement="top" data-original-title="Add More" > <i class="fa fa-plus"></i> </a> &nbsp; <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-sm remove" data-rel="tooltip" data-placement="top" data-original-title="Remove"  style="display: none;"> <i class="fa fa-minus"></i> </a>


                                </div>


                            </div>

                            <?php
                            if ($id != '' && $fileName != '') {
                                $display = '';
                            } else {
                                $display = 'style="display:none;"';
                            }
                            if ($fileName != '') {
                                ?>
                            <a href="<?php echo APP_URL ?>uploadDocuments/Notification/<?php echo $fileName; ?>" target="_blank" class="imageFile">
                                    <img id="imageFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $fileName; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                            <?php } ?>


                        </div> 

                    <?php } ?>
                <?php  } else { ?>
                    <div class="form-group morePayPercentage filedocs" id="divuploadDocument">
                        <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="fileDocument" id="docLevel">Upload Document <span class="perInstNo"></span></label>
                        <div class="col-sm-8">
                            <span class="colon">:</span>
                            <div class="col-sm-6 padding-left0">
                                <input type="file" id="fileDocument1" name="fileDocument[]" placeholder="" class="percentageVal form-control docfile">
                                <input type="hidden" name="hdnDocFile[]" id="hdnDocFile1" value="<?php echo $strFileName; ?>" class="hdnpercentageVal form-control"/>
                                <input type="hidden" name="hdnTotalDoc" id="hdnTotalDoc" value=""/>
                                <span class="mandatory">*</span>  
                               <small> <span class="red">(.pdf file only and Max size file Size 16 MB)</span></small>
                            </div>
                            <div class="col-sm-3  col-lg-2">
                                <a   data-rel="tooltip" data-placement="top" data-original-title="Add More" class="btn btn-xs btn-sm btn-success  addMore" > <i class="fa fa-plus"></i> </a> &nbsp; <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-sm remove" data-rel="tooltip" data-placement="right" data-original-title="Remove" title="Remove" style="display: none;"> <i class="fa fa-minus"></i> </a>


                            </div>


                        </div>

                        <?php
                        if ($id != '' && $strFileName != '') {
                            $display = '';
                        } else {
                            $display = 'style="display:none;"';
                        }
                        if ($strFileName != '') {
                            ?>
                        <a href="<?php echo APP_URL ?>uploadDocuments/Notification/<?php echo $strFileName; ?>" target="_blank" class="imageFile">
                                <img id="imageFile" src="<?php echo APP_URL; ?>img/pdf.png" alt="<?php echo $strFileName; ?>" width="16" height="16" <?php echo $display; ?> /></a>
                        <?php } ?>


                    </div>
                <?php } ?>
               
                <div class="form-group">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="radStatus">Publish Status</label>
                    <div class="col-sm-8">
                        <span class="colon">:</span>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radStatus" id="radStatus" class="ace" value="2"  <?php if ($intStatus == 2) { ?>checked="checked" <?php } ?>/>
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input type="radio" name="radStatus" id="radStatus" class="ace" value="1"  <?php if ($intStatus == 1) { ?>checked="checked" <?php } ?>/>
                                <span class="lbl"> Inactive</span>
                            </label>

                        </div>
                    </div>
                </div>
                <div class="form-group" id="chBlink">
                    <div class="col-sm-offset-3 col-lg-offset-2 col-sm-8"><label><input name="chkbox" type="checkbox" value="0" class="ace chkbox" <?php if ($chkval == 1) { ?>checked="checked" <?php } ?>> 
                            &nbsp;&nbsp;<span class="lbl"> Tick here for blinking new items</span> </label></div>
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
    <!-- /.page-content -->
<script type="text/javascript">
    
     function ShowHideLnkTyp(linkType)
    {
        if (linkType == '1')
        {
            $("#templateDiv").show();
            $("#divUrl").hide();
            $("#selPluginName").val('');
           
        }
         if (linkType == '2')
        {
            $("#templateDiv").hide();
            $('.filedocs').hide();
           //  $("#divuploadDocument").hide();
            $("#divUrl").show();
            if($('#txtURL').val=='')
            $("#txtURL").val('http://');
            $("#divContentEn").hide();
            $("#pluginDrp").hide();
            $('#txtDetailsE').html('');
            $("#divContentO").hide();

        }
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 1){
            $('.filedocs').hide();
            $("#divContentEn").show();
            $("#divContentO").show();
        }
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 2){
            $('.filedocs').show();
            //$("#divuploadDocument").show();
            $("#pluginDrp").hide();
            $('#divContentEn').hide('');
            $('#txtDetailsE').html('');
            $('#txtDetailsO').html('');
            $("#divContentO").hide();
        }
        if (linkType == '1' && $('input:radio[name=radTemplateType]:checked').val() == 3){
            $("#pluginDrp").show();
            $('.filedocs').hide();
            //$("#divuploadDocument").hide();
            $('#divContentEn').hide('');
            $('#txtDetailsE').html('');
            $('#txtDetailsO').html('');
            $("#divContentO").hide();
        }
       
    }
    function ShowHideTempTyp(tempType)
    {
        if (tempType == '1')
        {
            $("#divContentEn").show();
             $('.filedocs').hide();
            //$("#divuploadDocument").hide();
            $("#pluginDrp").hide();
            $("#selPluginName").val('');
            $("#divContentO").show();
        }
        if (tempType == '2')
        {
            //$("#divuploadDocument").show();
            $('.filedocs').show();
            $("#pluginDrp").hide();
            $("#divContentEn").hide();
            $("#txtDetailsE").val('');
            $("#divContentO").hide();
            $("#txtDetailsO").val('');
        }
        if (tempType == '3')
        {
           $("#pluginDrp").show();
            $('.filedocs').hide();
           //$("#divuploadDocument").hide();
            $("#divContentEn").hide();
            $("#txtDetailsE").val('');
            $("#divContentO").hide();
            $("#txtDetailsO").val('');
        }
    }
    // function to get page content
  
</script>
 
