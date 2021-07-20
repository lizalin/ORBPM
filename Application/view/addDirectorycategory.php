<?php
	/* ================================================
	File Name         	  : addWebdirectiry.php
	Description		  : This is used for add officer  Details.
	Designed By		  : Bikash Ku. Panda
        Designed On		  : 25-May-2016
        Devloped By		  : 
        Devloped On		  : 
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
					
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes		  :	header.php, navigation.php, util.php, footer.php,addGallerycategoryInner.php

	==================================================*/
	
     require 'addDirectorycategoryInner.php';
?>


<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
        $(document).ready(function () {
             	pageHeader   = "Add Web Directory Category";
                strFirstLink = "Manage Application";
                strLastLink  = "Web Directory Category"; 
				  $('[data-rel=tooltip]').tooltip();     

                     
                         
                  <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                alert('<?php echo $outMsg; ?>');
            <?php }if ($flag == 1 && $id != 0) { ?>
                      window.location.href = '<?php echo APP_URL; ?>viewDirectorycategory/<?php echo $glId; ?>/<?php echo $plId; ?>';
            <?php } ?>
                     
                     
		});
	</script>
    
  <script>
   $(document).ready(function () { 
         $('#less1').hide(); 
       $('.addMore').click(function () { 
           
            var totRowNo = $('#appenddiv .adddiv').length;
         if (!validate(totRowNo))
            {
                return false;
            }
           
           
            var cloneRow = $('.adddiv:last').clone(true);
              
            $(this).closest('.adddiv').after(cloneRow);
            $('.adddiv:last').find('.remove').show();
            
            $('.adddiv:last').find('.txtCategory').val('');
            $.each($('#appenddiv .adddiv'), function (e) {
                
                var rowNo = Number(e) + 1;
           
                $(this).find('.txtCategory').attr('id','txtCategory'+rowNo);
                $(this).find('.addMore').attr('id','btnAdd'+rowNo);
                $(this).find('.remove').attr('id','less'+rowNo);
                $('#btnAdd'+Number(rowNo-1)).hide();
                $('#less'+Number(rowNo-1)).show(); 
 
            });
        });
            
//================== Remove row ===========
        $('.remove').click(function () {
             if (!confirm('Are you sure to delete selected Record(s)'))
                  return false;
            $(this).closest('.adddiv').remove();
            $('.uploadConf').hide();
            var totRowNo = $('#appenddiv .adddiv').length;
           $.each($('#appenddiv .adddiv'), function (e) {
                var rowNo = Number(e) + 1;
                $(this).find('.txtCategory').attr('id','txtCategory'+rowNo);
                $(this).find('.addMore').attr('id','btnAdd'+rowNo);
                $(this).find('.remove').attr('id','less'+rowNo);
            });
            if(totRowNo==1)
            {
                    $('#btnAdd1').show();
                    $('#less1').hide();
            }
            else
                    $('#btnAdd'+totRowNo).show();
        }); 
        
    
    $("#btnReset").click(function () {
     $('#frmhistory')[0].reset();
     $(".txtCategory").text("");
           });


       });
    
     
    function validate()
    { 
         var totRowNumber = $('.addMore').length;
        
          for (var i = 1; i <= totRowNumber; i++)
           {
                //alert(totRowNumber);

            if(!blankCheck('txtCategory'+i,' Category Should not be left balnk'))
            return false; 
            if(!checkSpecialChar('txtCategory'+i))
               return false; 
            if(!maxLength('txtCategory'+i,100,'Category'))
               return false;
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
                <div class="srvc_hdr_nav " style="right:20px;">
              <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Web Directory" >Category</a>
              <a href="<?php echo APP_URL; ?>viewWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm" data-rel="tooltip" title="" data-original-title="Category" >Web Directory</a>
             
           </div>
           <div class="clearfix"></div>
             <div class="top_tab_container">
               
        
                    <a href="javascript:void(0);" class="btn btn-info active">Add</a>
               
               
                <a href="<?php echo APP_URL;?>viewDirectorycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                
            
             </div>
           
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
           <div class="col-xs-12"> 
		  <span id="appenddiv">
        <div class="form-group adddiv">
            <label class="col-lg-2 col-md-2 col-sm-3 col-xs-10 control-label no-padding-right" id="txt-person-namel" for="txt-person-name"> Category</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10"> <span class="colon">:</span>
                <input type="text" id="txtCategory1" name="txtCategory[]" class="form-control txtCategory" onkeypress="return !isNumberKey(event)"> <span class="mandatory">*</span> </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> 
            <span class="addbtn"><a value="Add" id="btnAdd1" class="btn btn-success addMore " data-rel="tooltip" data-placement="top" data-original-title="Add More"><i class="fa fa-plus"></i></a></span>
<span class="addbtn"><a value="Remove" id="less1"  class="btn btn-danger remove" title="Remove"><i class="fa fa-times"></i></a></span>
            </div>
        </div>
        </span>             
              
               <div class="form-group">
                      <label class="col-sm-2 control-label no-padding-right" for="radStatus">Publish Status</label>
                      <div class="col-sm-8">
                          <span class="colon">:</span>
                          <div class="radio">
                              <label>
                                  <input type="radio" name="radStatus" id="radStatus" class="ace" value="2" <?php if ($intStatus == 2) { ?>checked="checked" <?php } ?>>
                                  <span class="lbl"> Active</span>
                              </label>
                              <label>
                                  <input type="radio" name="radStatus" id="radStatus" class="ace" value="1" <?php if ($intStatus == 1) { ?>checked="checked" <?php } ?>>
                                  <span class="lbl"> Inactive</span>
                              </label>

                          </div>
                      </div>
                  </div>
            
              
              <div class="form-group">
                <div class="col-sm-2 no-padding-right"></div>
                <div class="col-sm-4">
                  <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" class="btn btn-success" onclick="return validator();"/>
                  <input type="reset" id="btnReset" name="btnReset"  class="btn btn-danger" value="Reset" onclick="<?php echo $strclick; ?>" />
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

 
