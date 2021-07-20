<?php
	/* ================================================
	File Name         	  : addWebdirectiry.php
	Description		  : This is used for add officer  Details.
	Designed By		  : Bikash Ku. Panda
        Designed On		  : 25-May-2016
        Devloped By		  :Ashis Kumar Patra
        Devloped On		  : 27-MAy-2016
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
					
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes		  :	header.php, navigation.php, util.php, footer.php,addWebdirectoryInner.php

	==================================================*/
	
     require 'addWebdirectoryInner.php';
?>


<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
        $(document).ready(function () {
             	pageHeader   = "Add Web Directory";
                strFirstLink = "Manage Application";
                strLastLink  = "Web Directory"; 
				  $('[data-rel=tooltip]').tooltip();       
               <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
                viewAlert('<?php echo $outMsg; ?>');
            <?php }if ($flag == 1 && $id != 0) { ?>
                      window.location.href = '<?php echo $redirectLoc; ?>';
            <?php } ?>
                     
                     
		});
	</script>
    
  <script>
   $(document).ready(function () { 
       
        
        fillWebCategory('selCat','<?php echo $strCategory;?>');
       $('#less1').hide(); 
       $('#btnless1').hide(); 
		 
	$('.addMore').click(function () { 
           
            var totRowNo = $('#appenddiv .adddiv').length;
           // alert(totRowNo);
           if(!blankCheck('txtTelno'+totRowNo,' Telephone Number Should not be left balnk'))
            return false; 
           if(!checkSpecialChar('txtTelno'+totRowNo))
               return false; 
           if(!validatePhone('txtTelno'+totRowNo,'Please enter valid Telephone Number'))
               return false; 
           if(!maxLength('txtTelno'+totRowNo,12,'History'))
               return false;
           
            var cloneRow = $('.adddiv:last').clone(true);
              
            $(this).closest('.adddiv').after(cloneRow);
            $('.adddiv:last').find('.remove').show();
            
            $('.adddiv:last').find('.txtTelno').val('');
            $.each($('#appenddiv .adddiv'), function (e) {
                
                   var rowNo = Number(e) + 1;

                   $(this).find('.txtTelno').attr('id', 'txtTelno' + rowNo);
                   $(this).find('.addMore').attr('id', 'btnAdd' + rowNo);
                   $(this).find('.remove').attr('id', 'less' + rowNo);
                   $('#btnAdd' + Number(rowNo - 1)).hide();
                   $('#less' + Number(rowNo - 1)).show();

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
                   $(this).find('.txtTelno').attr('id', 'txtTelno' + rowNo);
                   $(this).find('.addMore').attr('id', 'btnAdd' + rowNo);
                   $(this).find('.remove').attr('id', 'less' + rowNo);
               });
               if (totRowNo == 1)
               {
                   $('#btnAdd1').show();
                   $('#less1').hide();
               }
               else
                   $('#btnAdd' + totRowNo).show();
           });


           $("#btnReset").click(function () {
               $('#frmhistory')[0].reset();
               $(".txtTelno").text("");
           });
           $('.mobnoaddMore').click(function () {

               var totRowNo = $('#appenddiv2 .adddiv2').length;
               //  alert(totRowNo);
               if (!blankCheck('txtMobno' + totRowNo, ' Mobile Number Should not be left balnk'))
                   return false;
               if (!checkSpecialChar('txtMobno' + totRowNo))
                   return false;
                if (!validMobileNo('txtMobno' + totRowNo, 'Please enter valid mobile Number'))
                   return false;
               if (!maxLength('txtMobno' + totRowNo, 10, 'Mobile Number'))
                   return false;

               var cloneRow = $('.adddiv2:last').clone(true);

               $(this).closest('.adddiv2').after(cloneRow);
               $('.adddiv2:last').find('.mobremove').show();

               $('.adddiv2:last').find('.txtMobno').val('');
               $.each($('#appenddiv2 .adddiv2'), function (e) {

                   var rowNo = Number(e) + 1;

                   $(this).find('.txtMobno').attr('id', 'txtMobno' + rowNo);
                   $(this).find('.mobnoaddMore').attr('id', 'btnAdds' + rowNo);
                   $(this).find('.mobremove').attr('id', 'btnless' + rowNo);
                   $('#btnAdds' + Number(rowNo - 1)).hide();
                   $('#btnless' + Number(rowNo - 1)).show();

               });
           });


           $('.mobremove').click(function () {
               if (!confirm('Are you sure to delete selected Record(s)'))
                   return false;
               $(this).closest('.adddiv2').remove();
               $('.uploadConf').hide();
               var totRowNo2 = $('#appenddiv2 .adddiv2').length;
               $.each($('#appenddiv2 .adddiv2'), function (e) {
                   var rowNo = Number(e) + 1;
                   $(this).find('.txtMobno').attr('id', 'txtMobno' + rowNo);
                   $(this).find('.mobnoaddMore').attr('id', 'btnAdds' + rowNo);
                   $(this).find('.mobremove').attr('id', 'btnless' + rowNo);
               });
               if (totRowNo2 == 1)
               {
                   $('#btnAdds1').show();
                   $('#btnless1').hide();
               }
               else
                   $('#btnAdds' + totRowNo2).show();
           });


           $("#btnReset").click(function () {
               $('#frmhistory')[0].reset();
               $(".txtMobno").text("");
                $(".txtTelno").text("");
           });


       });

       function validator()
       {

            if(!selectDropdown('selCat', 'Please Select Category'))
                return false; 
           if (!blankCheck('txtName', 'Name can not be left blank'))
               return false;
           if (!checkSpecialChar('txtName'))
               return false;
           if (!maxLength('txtName', 70, 'Name'))
               return false;
           if (!blankCheck('txtDesignation', 'Designation can not be left blank'))
               return false;
           if (!checkSpecialChar('txtDesignation'))
               return false;
           if (!maxLength('txtDesignation', 70, 'Designation'))
               return false;
           if (!validEmail('txtEmail'))
               return false;
            if (!maxLength('txtFax', 12, 'Fax Number'))
               return false;
            if (!maxLength('txtPbx', 4, 'PBX Number'))
               return false;

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
              <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Web Directory" >Web Directory</a>
              <a href="<?php echo APP_URL; ?>viewDirectorycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm" data-rel="tooltip" title="" data-original-title="Category" >Category</a>
             
           </div>
           <div class="clearfix"></div>
             <div class="top_tab_container">
               
        
                    <a href="javascript:void(0);" class="btn btn-info active"><?php echo $strTab;?></a>
               
               
                <a href="<?php echo APP_URL;?>viewWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a>
                 <a href="javascript:void(0);" class="btn btn-info ">Archive</a> 
            
             </div>
           
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
           <div class="col-xs-12"> 
		<div class="form-group" id="showSection">
                    <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="ddlType">Select Category </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        
                        <select class="form-control" name="selCat" id="selCat">
                            
                        </select>
                        <span class="mandatory">*</span>             
                    </div>
                </div>           
               <div class="form-group">
                   <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtName">Name In English</label>
                   <div class="col-sm-4">
                       <span class="colon">:</span>
                       <input type="text" id="txtName" name="txtName" maxlength="100" placeholder="" class="form-control" value="<?php echo $strname; ?>">
                       <span class="mandatory">*</span>
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtName">Name In Odia</label>
                   <div class="col-sm-4">
                       <span class="colon">:</span>
                       <input type="text" id="txtNameO" name="txtNameO" maxlength="100" placeholder="" class="form-control akrutiorisarala" value="<?php echo $strnameO; ?>">
                      
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtDesignation">Designation In English</label>
                   <div class="col-sm-4">
                       <span class="colon">:</span>
                       <input type="text" id="txtDesignation" name="txtDesignation" maxlength="100" placeholder="" class="form-control" value="<?php echo $strdegs; ?>">
                       <span class="mandatory">*</span>
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtDesignation">Designation In Odia</label>
                   <div class="col-sm-4">
                       <span class="colon">:</span>
                       <input type="text" id="txtDesignationO" name="txtDesignationO" maxlength="100" placeholder="" class="form-control akrutiorisarala" value="<?php echo $strdegsO; ?>">
                       <span class="mandatory">*</span>
                   </div>
               </div>
                <?php if($id !=0 ) { 
                                    $Queryresult1  = $obj->manageDirectory('VT',$id,0,'','','','','','','','','','',0,0,0,0,0); 
                                     
                                     $cn = $Queryresult1->num_rows;  
                                     
                                     if($cn>0){
                                         $mctr=0;
                                    while($m1= $Queryresult1 ->fetch_array())
                                    {
                                        $mctr++;    
                                       
                                            ?>
                              
             <span id="appenddiv">
        <div class="form-group adddiv">
            <label class="col-lg-2 col-sm-3 col-xs-10 control-label no-padding-right" id="txt-person-namel" for="txt-person-name">Telephone Number</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10"> <span class="colon">:</span>
                <input type="text" id="txtTelno<?php echo $mctr;?>"  value="<?php echo $m1['VCH_TEL_NO']?>" name="txtTelno[]" class="form-control txtTelno" maxlength="12" onkeypress="return isNumberKey(event)">  </div>
            <div class="col-lg-2  col-sm-3  col-lg-2 col-xs-2"> 
            <span class="addbtn"><a value="Add" id="btnAdd<?php echo $mctr;?>"  class="btn btn-success addMore "  data-rel="tooltip" title="" data-original-title="Add More"  data-placement="top" title="Add More"><i class="fa fa-plus"></i></a></span>
<span class="addbtn"><a value="Remove" id="less<?php echo $mctr;?>"  class="btn btn-danger remove" title="Remove" data-rel="tooltip" title="" data-original-title="Remove"  data-placement="right" ><i class="fa fa-times"></i></a></span>
            </div>
        </div>
        </span>
                                     <?php }} else {  ?>
               <span id="appenddiv">
        <div class="form-group adddiv">
            <label class="col-lg-2 col-sm-3 col-xs-10 control-label no-padding-right" id="txt-person-namel" for="txt-person-name">Telephone Number</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10"> <span class="colon">:</span>
                <input type="text" id="txtTelno1" name="txtTelno[]" class="form-control txtTelno" maxlength="12" onkeypress="return isNumberKey(event)">  </div>
            <div class="col-lg-2  col-sm-3  col-lg-2 col-xs-2"> 
            <span class="addbtn"><a value="Add" id="btnAdd1"  class="btn btn-success addMore "  data-rel="tooltip" title="" data-original-title="Add More"  data-placement="top" title="Add More"><i class="fa fa-plus"></i></a></span>
<span class="addbtn"><a value="Remove" id="less1"  class="btn btn-danger remove" data-rel="tooltip" title="" data-original-title="Remove"  data-placement="right"><i class="fa fa-times"></i></a></span>
            </div>
        </div>
        </span>
                                     <?php } } else {?>
                   <span id="appenddiv">
        <div class="form-group adddiv">
            <label class="col-lg-2  col-sm-3 col-xs-10 control-label no-padding-right" id="txt-person-namel" for="txt-person-name">Telephone Number</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10"> <span class="colon">:</span>
                <input type="text" id="txtTelno1" name="txtTelno[]" class="form-control txtTelno" maxlength="12" onkeypress="return isNumberKey(event)">  </div>
            <div class="col-lg-2 col-sm-3  col-lg-2 col-xs-2"> 
            <span class="addbtn"><a value="Add" id="btnAdd1"  class="btn btn-success addMore "  data-rel="tooltip" title="" data-original-title="Add More"  data-placement="top" title="Add More"><i class="fa fa-plus"></i></a></span>
<span class="addbtn"><a value="Remove" id="less1"  class="btn btn-danger remove" title="Remove" data-rel="tooltip" title="" data-original-title="Remove"  data-placement="right"><i class="fa fa-times"></i></a></span>
            </div>
        </div>
        </span> <?php } ?>
            <div id="TextBoxContainer"></div>
              <?php if($id !=0 ) { 
                                    $Queryresult1  = $obj->manageDirectory('VM',$id,0,'','','','','','','','','','',0,0,0,0,0); 
                                     
                                     $cns = $Queryresult1->num_rows; 
                                     if($cns>0){
                                     $mctr=0;
                                    while($m1= $Queryresult1 ->fetch_array())
                                    {
                                        $mctr++;    
                                       
                                            ?>
              	  <span id="appenddiv2">
        <div class="form-group adddiv2">
            <label class="col-lg-2  col-sm-3 col-xs-10 control-label no-padding-right" id="txt-person-namel" for="txt-person-name">Mobile Number</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10"> <span class="colon">:</span>
                <input type="text" id="txtMobno<?php echo $mctr;?>" name="txtMobno[]"  value="<?php echo $m1['VCH_MOBILE_NO']?>" class="form-control txtMobno" maxlength="12" onkeypress="return isNumberKey(event)">  </div>
            <div class="col-lg-2  col-sm-3  col-lg-2 col-xs-2"> 
            <span class="addbtn"><a value="Add" id="btnAdds<?php echo $mctr;?>" class="btn btn-success mobnoaddMore" data-rel="tooltip" title="" data-original-title="Add More"  data-placement="top" title="Add More" ><i class="fa fa-plus"></i></a></span>
<span class="addbtn"><a value="Remove" id="btnless<?php echo $mctr;?>"  class="btn btn-danger mobremove" title="Remove" data-rel="tooltip" title="" data-original-title="Remove"  data-placement="right"><i class="fa fa-times"></i></a></span>
            </div>
        </div>
                                     </span>   <?php }  } else {?>
            <span id="appenddiv2">
        <div class="form-group adddiv2">
            <label class="col-lg-2  col-sm-3 col-xs-10 control-label no-padding-right" id="txt-person-namel" for="txt-person-name">Mobile Number</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10"> <span class="colon">:</span>
                <input type="text" id="txtMobno1" name="txtMobno[]" class="form-control txtMobno" maxlength="12" onkeypress="return isNumberKey(event)">  </div>
            <div class="col-lg-2 col-sm-3  col-lg-2 col-xs-2"> 
            <span class="addbtn"><a value="Add" id="btnAdds1" class="btn btn-success mobnoaddMore" data-rel="tooltip" title="" data-original-title="Add More"  data-placement="top" title="Add More"><i class="fa fa-plus"></i></a></span>
<span class="addbtn"><a value="Remove" id="btnless1"  class="btn btn-danger mobremove" title="Remove" data-rel="tooltip" title="" data-original-title="Remove"  data-placement="right"><i class="fa fa-times"></i></a></span>
            </div>
        </div>
        </span>
                                     <?php } } else {?>
            <span id="appenddiv2">
        <div class="form-group adddiv2">
            <label class="col-lg-2 col-sm-3 col-xs-10 control-label no-padding-right" id="txt-person-namel" for="txt-person-name">Mobile Number</label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10"> <span class="colon">:</span>
                <input type="text" id="txtMobno1" name="txtMobno[]" class="form-control txtMobno" maxlength="12" onkeypress="return isNumberKey(event)">  </div>
            <div class="col-lg-2  col-sm-3  col-lg-2 col-xs-2"> 
            <span class="addbtn"><a value="Add" id="btnAdds1" class="btn btn-success mobnoaddMore" data-rel="tooltip" title="" data-original-title="Add More"  data-placement="top" title="Add More"><i class="fa fa-plus"></i></a></span>
<span class="addbtn"><a value="Remove" id="btnless1"  class="btn btn-danger mobremove" title="Remove" data-rel="tooltip" title="" data-original-title="Remove"  data-placement="right" ><i class="fa fa-times"></i></a></span>
            </div>
        </div>
        </span><?php } ?>
            <div id="TextBoxContainer2"></div>
           
              <div class="form-group">
                <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtEmail">Email Id</label>
                <div class="col-sm-4">
                <span class="colon">:</span>
                <input type="text" id="txtEmail" name="txtEmail" maxlength="100" placeholder="" class="form-control"  value="<?php echo $stremail; ?>">
                  
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtFax">Fax</label>
                <div class="col-sm-4">
                <span class="colon">:</span>
                <input type="text" id="txtFax" name="txtFax" maxlength="12" placeholder="" class="form-control" onkeypress="return isNumberKey(event)"  value="<?php echo $strfax; ?>">
                  
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="txtFax">PBX</label>
                <div class="col-sm-4">
                <span class="colon">:</span>
                <input type="text" id="txtPbx" name="txtPbx" maxlength="4" placeholder="" class="form-control" onkeypress="return isNumberKey(event)"  value="<?php echo $strpbx; ?>">
                  
                </div>
              </div>
<div class="form-group">
                      <label class="col-sm-3  col-lg-2 control-label no-padding-right" for="radStatus">Publish Status</label>
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
            </div>
          <div class="hr hr32 hr-dotted"></div>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.page-content -->

 
