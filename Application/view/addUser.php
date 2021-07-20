<?php
/* ================================================
  File Name         	  : addUser.php
  Description		  : This is used for add user details.
  Designed By		  : T Ketaki Debadarshini
  Designed On		  : 01-Sep-2015
  Devloped By             : T Ketaki Debadarshini
  Devloped On             : 02-Sep-2015
  Update History	  :	<Updated by>		<Updated On>		<Remarks>
  Style sheet             : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions     : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
  includes		  :	header.php, navigation.php, util.php, footer.php,addNewsInner.php

  ================================================== */

require 'addUserInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
   $(document).ready(function () {
       // loadNavigation('<?php echo $strTab; ?> User');
        pageHeader   = "<?php echo $strTab; ?> User";
        strFirstLink = "Manage User";
        strLastLink  = "User Profile"; 
       
       
        $('#txtName').focus();
       
    <?php if ($outMsg != '' && isset($_REQUEST['btnSubmit'])) { ?>
            alert('<?php echo $outMsg; ?>');
        <?php }if ($flag == 1 && $id != 0) { ?>
            window.location.href = '<?php echo APP_URL; ?>viewUser/<?php echo $glId; ?>/<?php echo $plId; ?>';
        <?php } ?>    
         <?php if($id=='0') {?>
            $('#userImage').hide();
            <?php }?>
                
            if ('<?php echo $id; ?>'!= '' && '<?php echo $strUserid; ?>'!= '')
            {
                $('#login').attr('checked', 'checked');
                $('#displogin').show();
            }
            else
            {
                $('#displogin').hide();
            }
            
            fillLocation('<?php echo $intLocId;?>','DdlLocation');   
            getDepartments('<?php echo $intLocId;?>','DdlDepartment','<?php echo $intDeptId;?>');
            getDesignation('<?php echo $intDeptId;?>','DdlDesignation','<?php echo $intDesigId;?>');
     });
        function validator()
        {
            if (!blankCheck('txtName', 'Full Name can not be left blank'))
                return false;
            if (!checkSpecialChar('txtName'))
                return false;
            if (!maxLength('txtName', 70, 'Full Name '))
                return false;                          
            if ($('#fileDocument').val() != '')
            {
                if (!IsCheckFile('fileDocument', 'Invalid file types. Upload only ', 'jpg,jpeg,png'))
                    return false;
                var fileSize_inKB = Math.round(($("#fileDocument")[0].files[0].size / 1024));
                    if (fileSize_inKB > 1024)
                    {
                        alert('File size cannot be more than 1MB.');
                        return false;
                    }
            }
            if (!blankCheck('txtSLNo', 'Serial No can not be left blank'))
                return false;
             if (!checkSpecialChar('txtQualification'))
                return false;
            
             if(!selectDropdown('DdlLocation','Select Location'))
                return false; 
            if(!selectDropdown('DdlDepartment','Select Department'))
                return false; 
            if(!selectDropdown('DdlDesignation','Select Designation'))
                return false; 
            if (!equalLength('txtMobile', 10, 'Mobile Number'))
                 return false;
             
            if(!validEmail('txtEmail'))
                return false; 
            if ($('#txtEmail').val() != '')
                {
                    if ($('#hdnemail').val() == 1)
                    {
                        alert('Email Already Exist');
                        $('#txtEmail').val('');
                        $('#txtEmail').focus();
                    }
                }
            if ($('#login').is(':checked'))
                {
                    if (!blankCheck('txtUser', 'User ID can not left blank'))
                        return false;
                    if (!checkSpecialChar('txtUser', 'Special Character Not Allowed !'))
			return false;
                    if($('#txtUser').val().length<=5)	
                    {
                            alert('User Id must be greater than 5 character');
                            $('#txtUser').focus();
                            return false;
                    }	
                    
                    if ($('#hdnuser').val() == 1)
                    {
                        alert('UserId Already Exist');
                        $('#txtUser').val('');
                        $('#txtUser').focus();
                    }
                    
                   if (!blankCheck('txtPassword', 'Password can not be left blank'))
                       return false;
                   if(!checkSpecialChar('txtPassword'))
                           return false;
                    if($('#txtPassword').val().length<=6)	
                    {
                            alert('Password must be greater than 6 character');
                            $('#txtPassword').focus();
                            return false;
                    }	
                    if (!blankCheck('txtConfirmPwd', 'Confirm Password can not be left blank'))
                            return false;
                    if(!checkSpecialChar('txtConfirmPwd'))
                            return false;	
                    if ($("#txtPassword").val() !== $("#txtConfirmPwd").val() )
                     {  
                       alert('Confirm Password must be same as Password.');
                       $('#txtConfirmPwd').focus();
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
                   //$('#imgMsg').css('margin-left', '210px');
               }

               reader.readAsDataURL(input.files[0]);
           }
       }

       function logindiv(ctrl)
       {
           if (ctrl.checked == true)
           {
               $('#displogin').show();

               if ('<?php echo $id; ?>' != '' && '<?php echo $strUserid; ?>' == '')
               {

                   $('#txtUser').val('');
                   $('#txtPassword').val('');
                   $('#chkPrevilige').removeAttr('checked');
               }
               else
               {
                   $('#txtUser').val($('#hiddennuser').val());
                   $('#txtPassword').val($('#hiddennpass').val());
               }

           }
           else
           {
               $('#displogin').hide();
               $('#txtUser').val('');
               $('#txtPassword').val('');
               $('#chkPrevilige').removeAttr('checked');
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
                <a href="<?php echo APP_URL; ?>viewUser/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
          
            <div class="col-xs-12">
                 <h4>Personal Details</h4>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtHeadlineE">Full Name </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtName" name="txtName" maxlength="70" placeholder="" class="form-control" value="<?php echo $strFullname; ?>" onKeyPress="return !isNumberKey(event);">
                        <span class="mandatory">*</span>
                    </div>
                </div>  

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtHeadlineE">Gender </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="radio" name="radGender" id="radGender" value="1"  <?php if ($intGender == 1) { ?>checked="checked" <?php } ?>/>
                        Male
                        &nbsp;
                        <input type="radio" name="radGender" id="radGender" value="0"  <?php if ($intGender == 0) { ?>checked="checked" <?php } ?>/>Female
                    </div>
                </div> 
                 <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtQualification">Qualification </label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="text" id="txtQualification" name="txtQualification" maxlength="100" placeholder="" class="form-control" value="<?php echo $strQualification; ?>">
                       
                    </div>
                </div>  
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="fileDocument">User Photo</label>
                    <div class="col-sm-4">
                        <span class="colon">:</span>
                        <input type="file" id="fileDocument" name="fileDocument" placeholder="" class="form-control" onChange="readImage(this);">
                        <input type="hidden" name="hdnImageFile" id="hdnImageFile" value="<?php echo $strImageFile; ?>"/>
                        
                    </div>
                    <div class="help-inline col-xs-12 col-sm-6">
                            
                        <?php
                      //  if ($id != '') {
                            if ($strImageFile != '') {
                           ?>
                        <img src="<?php echo APP_URL; ?>uploadDocuments/UserProfile/<?php echo $strImageFile; ?>" id="userImage" alt="" width="100" height="80" border="0" align="absmiddle">
                            <?php //} else { ?>
                                        
<!--                                      <img src="<?php echo APP_URL; ?>Images/no-profile-man-medium.jpg" alt="" id="userImage" width="200" height="80" border="0" align="absmiddle">-->
                            <?php //}
                        } 
                        else
                        {
                        ?>
                               <img id="userImage" width="100" height="80" alt="" class="passportPhoto mgnLft_10 mgnTop_10" >
                     <?php } ?>
                    </div>

                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right"></label>
                    <div class="col-sm-4">
                       <span class="red">(jpeg,jpg,png file only and Max size file Size 1 MB)</span>
                    </div>
                </div> 
                
                 <h4>Service Details</h4>
                   <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="DdlLocation"> Select Location</label>
                    <div class="col-sm-4"> <span class="colon">:</span>
                        <select class="form-control" name="DdlLocation" id="DdlLocation" onChange="getDepartments(this.value,'DdlDepartment',0);">
                          <option value="0">-- Select --</option>
                      </select>
                      <span class="mandatory">*</span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="DdlDepartment"> Select Department</label>
                    <div class="col-sm-4"> <span class="colon">:</span>
                        <select class="form-control" name="DdlDepartment" id="DdlDepartment" onChange="getDesignation(this.value,'DdlDesignation',0);">
                          <option value="0">-- Select --</option>
                      </select>
                      <span class="mandatory">*</span> </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="DdlDesignation"> Select Designation</label>
                    <div class="col-sm-4"> <span class="colon">:</span>
                        <select class="form-control" name="DdlDesignation" id="DdlDesignation">
                          <option value="0">-- Select --</option>
                      </select>
                      <span class="mandatory">*</span> </div>
                  </div>
                 <h4>Contact Details</h4>
                   <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="txtOffPh">Office Phone/Ext No.</label>
                    <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="text" id="txtOffPh" name="txtOffPh" maxlength="12" class="form-control" value="<?php echo $strPhno; ?>"  AutoComplete="Off" onKeyPress="return isNumberKeyLandline(event);">
                        
                    </div>
                  </div> 
                 <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="txtMobile">Mobile No.</label>
                    <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="text" id="txtMobile" name="txtMobile" maxlength="10" placeholder="" class="form-control" value="<?php echo $intMobileNo; ?>"  AutoComplete="Off" onKeyPress="return isNumberKey(event);">
                         
                    </div>
                  </div> 
                  <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="txtEmail">Email</label>
                    <div class="col-sm-4">
                          <span class="colon">:</span>
                          <input type="text" id="txtEmail" name="txtEmail" maxlength="50" placeholder="" class="form-control" value="<?php echo $strEmail; ?>" onBlur="checkDuplicateUser('<?php echo ($id!='')?$id:0;?>',this.value,'txtEmail','checkmail','hdnemail',2);">
                          &nbsp;<span id="checkmail" title='eMail Already Exist' data-toggle='tooltip' data-placement='right'></span>
                            <input type="hidden" name="hdnemail" id="hdnemail" value="<?php echo $mailExist; ?>" />
                    </div>
                  </div>  
                <h4><input name="login" id="login" type="checkbox" onClick="logindiv(this);" value="1" <?php if($intPrivilege==1){?> checked="checked" <?php }?>/> &nbsp;Login Details</h4>
                <span  id="displogin" style="display:none">
                <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="fileDocument">User ID</label>
                  <div class="col-sm-4">
                    <span class="colon">:</span>
                    <input type="text" id="txtUser" onBlur="userBlur('txtUser');" name="txtUser"  value="<?php echo $strUserid; ?>" maxlength="50" class="form-control" AutoComplete="Off" <?php echo $readonly; ?>>
                    <input type="hidden" name="hiddennuser" id="hiddennuser" value="<?php echo $strUserid; ?>" /> 
                    <span id="checkId" title='User Already Exist' data-toggle='tooltip' data-placement='right'></span>
                    <input type="hidden" name="hdnuser" id="hdnuser" value="<?php echo $idExist; ?>" />
                    <input type="hidden" name="hdnPassWord" id="hdnPassWord" value="<?php echo $strPassword; ?>" /> 
                    <span class="mandatory">*</span>
                  </div>
                </div>
                <?php if (($id == '') || ($id != '' && $strUserid == '')) { ?>
                <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="txtPassword">Password</label>
                  <div class="col-sm-4">
                    <span class="colon">:</span>
                    <input type="password" id="txtPassword" name="txtPassword" maxlength="50" placeholder="" class="form-control" >
                   &nbsp;<span class="mandatory" id="pass">*</span>  <span id="checkpass"  style="color: red"></span>
                     
                       
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtConfirmPwd">Confirm Password</label>
                    <div class="col-sm-4"><span class="colon">:</span>
		  <input type="password" name="txtConfirmPwd" id="txtConfirmPwd" maxlength="50" placeholder="" class="form-control" >
                    <span class="mandatory">*</span></div>
                </div>
               <?php } 
               if ($adminPrevilegeStatus == 1) { ?>
                 <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="chkPrevilige">Previlage</label>
                    <div class="col-sm-4"><span class="colon">:</span>
	            <input name="chkPrevilige" id="chkPrevilige" type="checkbox" value="1" <?php if ($intPrivilege == 1) { ?> checked="checked" <?php } ?> />Super Admin</div>
                </div>
                <?php } ?>
                </span>
                <div class="form-group">
                    <div class="col-sm-2 no-padding-right"></div>
                    <div class="col-sm-4">
                         <input type="hidden" name="hdnSLNo" id="hdnSLNo" value="<?php echo $maxSL;?>" />
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

  <script type="text/javascript">
     function userBlur(obj)
        {

            if ($('#'+obj).is('[readonly]') ) { }
            else
            {
               checkDuplicateUser('<?php echo ($id!='')?$id:0;?>',$('#'+obj).val(),'txtUser','checkId','hdnuser',1); 
            }
        }
    </script>

