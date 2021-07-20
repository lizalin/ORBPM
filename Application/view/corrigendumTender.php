<?php
/* ================================================
  File Name         	  : corrigendumTender.php
  Description		  : This is used for add corrigendum Tender.
  Designed By		  :
  Designed On		  : 
  Devloped By             : T Ketaki Debadarshini
  Devloped On             : 14-Sept-2015
  Update History	:	<Updated by>		<Updated On>		<Remarks>
  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
  includes	       :	header.php, navigation.php, util.php, footer.php,corrigendumTenderInner.php

  ================================================== */

require 'corrigendumTenderInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<!--<script src="<?php echo APP_URL; ?>js/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo APP_URL; ?>css/jquery.timepicker.css">
<link rel="stylesheet" href="<?php echo APP_URL; ?>css/datepicker.css">-->
<script language="javascript">
    $(document).ready(function () {
     
        pageHeader   = "<?php echo $strTab; ?>";
        strFirstLink = "Manage Application";
        strLastLink  = " Tenders"; 
       
        indicate = 'yes';
        $('#txtHeadlineE').focus();
       
      
       fillTender('ddlTenderno',1);
     

<?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            alert('<?php echo $outMsg; ?>');
            document.location.href=document.location.href;
<?php } ?>    
    
       });
       
          function validator(){
				
		if(!selectDropdown('ddlTenderno','Please Select Tender Number'))
			return false;				
		if (!blankCheck('fileCorrigdnum', 'Please Upload Corrigendum File')) 
			return false;					
					
		if(!IsCheckFile('fileCorrigdnum', 'upload a valid filetype','doc,docx,pdf'))
			return false;
		if(!IsCheckFile('fileCorrigdnum2', 'upload a valid filetype','doc,docx,pdf'))
			return false;
		if(!IsCheckFile('fileCorrigdnum3', 'upload a valid filetype','doc,docx,pdf'))
			return false;
			
	}
                
              
            
</script>
<!--<script src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>-->
<div class="page-content">
    <div class="page-header">
        <h1 id="title"></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
             <div class="top_tab_container">
            <?php  if ($noAdd != '1') { ?>
                   <a href="<?php echo APP_URL?>addTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
               <?php }?>
            <a href="<?php echo APP_URL; ?>viewTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a> 
             <a href="<?php echo APP_URL; ?>addendumTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Addendum</a>
             <a href="javascript:void(0);" class="btn btn-info active">Corrigendum</a>
           
            <a href="<?php echo APP_URL; ?>archieveTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a>
            </div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            
            <div class="col-xs-12">
                 <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="ddlTenderno">Tender No.</label>
                    
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <select class="form-control" name="ddlTenderno" id="ddlTenderno" onchange="fillTenderfields(this.value,1)">
                            <option value="0">- Select -</option>  
                        </select>
                        <input type="hidden" name="hdnTenderNo" id="hdnTenderNo"/>
                        <span class="mandatory">*</span>
                    </div>
                </div>                 
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtHeadline">Tender Headline</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtHeadline" name="txtHeadline" maxlength="500" placeholder="" readonly="readonly" class="form-control" value="<?php echo $strHeadLine; ?>">
                        <span class="mandatory">*</span>
                    </div>
                </div>  
                  <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtClosingDate">Closing Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" readonly="readonly" name="txtClosingDate" id="txtClosingDate" class="form-control date-picker">
                            
                             <span class="mandatory">*</span>
                        </div>
                    </div>
                    <label class="col-sm-2 control-label no-padding-right" for="txtClosingTime">Closing Time</label>
                    <div class="col-sm-3">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" name="txtClosingTime" readonly="readonly" id="txtClosingTime" class="form-control time-picker"  >
                            <span class="mandatory">*</span>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtOpeningDate">Opening Date</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" readonly="readonly" name="txtOpeningDate" id="txtOpeningDate" class="form-control" >
                            
                             <span class="mandatory">*</span>
                        </div>
                    </div>
                    <label class="col-sm-2 control-label no-padding-right" for="txtOpeningTime">Opening Time</label>
                    <div class="col-sm-3">
                        <span class="colon">:</span>
                        <div class="input-group">
                            <input type="text" name="txtOpeningTime" readonly="readonly" id="txtOpeningTime" class="form-control time-picker" >
                            <span class="mandatory">*</span>
                        </div>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="fileCorrigdnum">Upload Document</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileCorrigdnum" name="fileCorrigdnum" placeholder="" class="form-control">
                        <input type="hidden" name="hdnCorrigdnumFile" id="hdnCorrigdnumFile" />
                    </div>
                      
                    <span class="red">* (.pdf,.doc,.docx file only and Max size file Size 5 MB)</span>
                </div>
               
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="fileCorrigdnum2">Upload Document 2</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileCorrigdnum2" name="fileCorrigdnum2" placeholder="" class="form-control">
                        <input type="hidden" name="hdnCorrigdnumFile2" id="hdnCorrigdnumFile2" />
                    </div>
                    <span class="red"> (.pdf,.doc,.docx file only and Max size file Size 5 MB)</span>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="fileCorrigdnum3">Upload Document 3</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileCorrigdnum3" name="fileCorrigdnum3" placeholder="" class="form-control">
                        <input type="hidden" name="hdnCorrigdnumFile3" id="hdnCorrigdnumFile3" />
                    </div>
                      
                    <span class="red">(.pdf,.doc,.docx file only and Max size file Size 5 MB)</span>
                </div>
                 
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtDetails">Description </label>
                    <div class="col-sm-5">
                        <span class="colon">:</span>
                       <textarea class="form-control" id="txtDetails" name="txtDetails" rows="3" readonly="readonly"></textarea>
                        <span class="mandatory">*</span>
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


