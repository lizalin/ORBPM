<?php
	/* ================================================
	File Name         	  : viewUser.php
	Description		  : This page is used to view User Details.
	Author Name		  : 
	Date Created		  : 
	Designed By		  :	
        Developed On		  : 29-Aug-2015
	Developed By		  : T Ketaki Debadarshini
	Update History		  :
						<Updated by>		<Updated On>		<Remarks>

	Style sheet           : style.php                                             
	Javscript Functions   : jquery-1.4.1.min.js, loadComponent.js, jquery.mousewheel.js, jquery.jscrollpane.min.js,modal.js
	includes			  : header.php,leftmenu.php,navigation.php,util.php,footer.php

	==================================================*/
	include('viewUserInner.php');
?>

 <script type="text/javascript" src="<?php echo APP_URL; ?>js/modal.js"></script>
<script language="javascript">
        pageHeader ="View User";
	strFirstLink ="Manage User";
	strLastLink  ="User Profile";
	printMe   ="yes";
        
	uactiveMe       = "yes";
        uinactiveMe     = "yes";
	deleteMe="<?php echo $deletePriv;?>";
        
    $(document).ready(function () {
	
        if('<?php echo $outMsg;?>'!='')                
             alert('<?php echo $outMsg;?>');
             
             fillLocation('<?php echo $intLocation;?>','ddlLocation');   
             getDepartments('<?php echo $intLocation;?>','ddlDepartment','<?php echo $intDepartment;?>');
             
       });         
    function validSl()
	{
		var flag	= 0;
		$('.txtSerialNo').each(function(){
			if(this.value==0 || this.value=='')
			{
				alert('Serial number must be greater than zero');
				this.focus();
				flag	= 1;
				return false;
			}
			
		});
		if(flag==0)
			gotoDelete('US');
	}
</script>

 <div class="page-content">
        <div class="page-header">
            <h1 id="title" class="col-sm-5"></h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="top_tab_container">
                <?php  if ($noAdd != '1') { ?>
                    <a href="<?php echo APP_URL?>addUser/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                    
                <a href="javascript:void(0);" class="btn btn-info active">View</a>
            </div>
                <?php include('includes/util.php'); ?>
                <div class="hr hr-solid"></div>
                
                   <div class="searchTable">
                    <div class="form-group">
                        <label class="col-sm-1 control-label no-padding-right" for="ddlLocation" >Location</label>
                        <div class="col-sm-3"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="ddlLocation" id="ddlLocation" onChange="getDepartments(this.value,'ddlDepartment',0);">
                                <option value="0">- Select -</option>  
                            </select>
                         </div>
                       <label class="col-sm-1 control-label no-padding-right" for="ddlDepartment">Department</label>
                        <div class="col-sm-3"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="ddlDepartment" id="ddlDepartment">
                                <option value="0">- Select -</option>  
                            </select>
                         </div>
                        
                        <label class="col-sm-1 control-label no-padding-right" for="txtHeadLineE">Name </label>
                        <div class="col-sm-2"> <span class="colon">:</span>
                            <input type="text" id="txtUserName" name="txtUserName" class="form-control" value="<?php echo $strUserName; ?>">
                        </div>

                        <div class="col-sm-1">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                        </div>
                    </div>
                </div>
                
                
		 <div id="viewTable">
                <?php if (mysqli_num_rows($result) > 0) {
                    $ctr = $intRecno; 
                    $intCount=0;
                    ?>
                <table class="table  table-bordered table-hover">
                   <thead>
                       <tr>
                           <th width="20" class="noPrint">
                               <label class="position-relative">
                               <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                           </th>
                            <th width="40">SL No</th>
                            <th>User Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Location </th>        
                            <th>Mobile No</th>
                            <th>Privilage</th>
                            <th>Status</th>
                            <th>SL No</th>
                            <th>Created on</th>
                            <th width="30" class="noPrint" style="<?php echo $editPriv;?>"> Edit </th>
                          </tr>
                     </thead>
		   <tbody>
                    <?php 
                    while ($row = mysqli_fetch_array($result)) 
                     {
                        $intCount++;
                        if($row['INT_PUBLISH_STATUS']==1)
                            $style	= 'class="greenBorder"';
                        else
                            $style	= 'class="yellowBorder"'; 
                            $ctr++; 
                            ?>
                           <tr <?php echo $style;?>>
                            <td class="noPrint">
                                <label class="position-relative">
                                    <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_ID'];?>"><span class="lbl"></span>
                                    <input type="hidden" id="hdnPubStatus<?php echo $row['INT_ID'];?>" name="hdnPubStatus<?php echo $row['INT_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                </label>
                            </td>
                           <td><?php echo $intCount;?></td>
                            <td >
                            <?php if($row['VCH_USER_ID']!='') {?>
                            	<a href="#myModal<?php echo $intCount; ?>" role="button" data-target="#myModal<?php echo $intCount; ?>"  data-toggle="modal"><?php echo $row['VCH_FULL_NAME'];?></a><?php if($row['INT_PUBLISH_STATUS']==1) {?>&nbsp;<i class="icon-user"></i>
                                <?php }}else{?>
                           	<a href="#myModal<?php echo $intCount; ?>" role="button" data-target="#myModal<?php echo $intCount; ?>" data-toggle="modal"><?php echo $row['VCH_FULL_NAME'];?></a>
                                <?php }?>
                            </td>
                            <td><?php echo $objUser->getName('VCH_DEPARTMENT_NAME','m_department_master','INT_DEPARTMENT_ID',$row['INT_DEPARTMENT_ID'],'BIT_DELETED_FLAG');?></td>
							
                            <td><?php echo $objUser->getName('VCH_DESIGNATION_NAME','m_designation_master','INT_DESIGNATION_ID',$row['INT_DESIGNATION_ID'],'BIT_DELETED_FLAG');?></td>
                            <td><?php
                                   echo $objUser->getName('VCH_LOCATION', 'm_location_master', 'INT_LOCATION_ID', $row['INT_LOCATION_ID'],'0');
                                ?></td>
                            <td><?php echo $row['VCH_MOBILE_NO'];?></td>
                             <td>
                            <?php 
                                   if($row['VCH_USER_ID']!='')
                                   {
                                           if($row['INT_PREVILIGE_STATUS']==1)
                                                   echo 'Supper Admin';
                                           else if($row['INT_PREVILIGE_STATUS']==2)
                                                   echo 'User';	
                                   }
                            ?></td>
                             <td> <?php if($row['VCH_USER_ID']!='') {
                                if ($row['INT_PUBLISH_STATUS'] == 1) { ?>
                                      Active
                                    <?php } else { ?>
                                      InActive
                                    <?php
                                    }
                                           
                                 }?>
                             </td>
                             <td><input type="text"  onkeypress="return isNumberKey(event);" name="txtSLNo<?php echo $row['INT_ID'];?>" id="txtSLNo<?php echo $row['INT_ID'];?>" value="<?php echo $row['INT_SLNO'];?>" style="width:50px" class="txtSerialNo" Autocomplete="off"/></td>
                          
                            <td><?php echo date("d-M-Y",strtotime($row['DTM_CREATED_ON']));?></td>
                            <td align="center" valign="middle" class="noPrint" style="<?php echo $editPriv;?>"><a href="<?php echo APP_URL;?>addUser/<?php echo $glId;?>/<?php echo $plId;?>/<?php echo $row['INT_ID'];?>" title="Edit"><i class="icon-edit"></i></a></td>
                          </tr>
                          <input type="hidden" id="hdnFullname<?php echo $intCount;?>" value="<?php echo $row['VCH_FULL_NAME'];?>">
                          <input type="hidden" id="hdnimage<?php echo $intCount;?>" value="<?php echo($row['VCH_IMAGE'])?APP_URL.'uploadDocuments/UserProfile/'.$row['VCH_IMAGE']:APP_URL.'img/noPhptoPassport.jpg';?>">

                           <input type="hidden" id="hdnGender<?php echo $intCount;?>" value="
                           <?php
                                   if( $row['VCH_GENDER']==1)
                                         echo 'Male';
                                   else
                                         echo 'Female';
                           ?>">
                           <input type="hidden" id="hdnDob<?php echo $intCount;?>" value="<?php echo date("d-m-Y",strtotime($row['VCH_DATE_OF_BIRTH']));?>">
                           <input type="hidden" id="hdnQualification<?php echo $intCount;?>" value="<?php echo ($row['VCH_QUALIFICATION']!='')?$row['VCH_QUALIFICATION']:'NA';?>">
                           <input type="hidden" id="hdnAddress<?php echo $intCount;?>" value="<?php echo ($row['VCH_ADDRESS']!='')?$row['VCH_ADDRESS']:'NA';?>">
                           <input type="hidden" id="hdnSpecialisation<?php echo $intCount;?>" value="<?php echo ($row['VCH_SPECIALIZATION']!='')?$row['VCH_SPECIALIZATION']:'NA';?>">
                            <input type="hidden" id="hdnHobby<?php echo $intCount;?>" value="<?php echo ($row['VCH_HOBBY']!='')?$row['VCH_HOBBY']:'NA';?>">
                            <input type="hidden" id="hdnLocation<?php echo $intCount;?>" value="<?php //echo $obj->getName('VCH_LOCATION','m_location_master','INT_LOCATION_ID',$row['INT_LOCATION_ID'],'BIT_DELETED_FLAG');?>">
                            <input type="hidden" id="hdnDept<?php echo $intCount;?>" value="<?php //echo $obj->getName('VCH_DEPARTMENT_NAME','m_department_master','INT_DEPARTMENT_ID',$row['INT_DEPARTMENT_ID'],'BIT_DELETED_FLAG');?>">
                            <input type="hidden" id="hdnDesignation<?php echo $intCount;?>" value="<?php //echo $obj->getName('VCH_DESIGNATION_NAME','m_designation_master','INT_DESIGNATION_ID',$row['INT_DESIGNATION_ID'],'BIT_DELETED_FLAG');?>">

                            <input type="hidden" id="hdnDoj<?php echo $intCount;?>" value="<?php echo date("d-m-Y",strtotime($row['VCH_DATE_OF_JOIN']));?>">

                            <input type="hidden" id="hdnOfficeNo<?php echo $intCount;?>" value="<?php echo ($row['VCH_PH_NO']!='')?$row['VCH_PH_NO']:'NA';?>">
                            <input type="hidden" id="hdnMobileNo<?php echo $intCount;?>" value="<?php echo ($row['VCH_MOBILE_NO']!='')?$row['VCH_MOBILE_NO']:'NA';?>">
                            <input type="hidden" id="hdnemail<?php echo $intCount;?>" value="<?php echo ($row['VCH_EMAIL']!='')?$row['VCH_EMAIL']:'NA';?>">
                           <!-- <input type="hidden" id="hdnAddress<?//php echo $intCount;?>" value="<?//php echo ($row['VCH_ADDRESS']!='')?$row['VCH_ADDRESS']:'NA';?>">-->
                             <input type="hidden" id="hdnUserId<?php echo $intCount;?>" value="<?php echo ($row['VCH_USER_ID'])?$row['VCH_USER_ID']:'NA';?>">
                              <input type="hidden" id="hdnPrevilige<?php echo $intCount;?>" value="<?php if($row['INT_PREVILIGE_STATUS']==1)
                                                  echo 'Supper Admin';
                                          else if($row['INT_PREVILIGE_STATUS']==2)
                                                  echo 'User';	
                                        
                                   ?>">
                  <?php } ?>
                         </tbody>
                        </table>
            <input name="hdn_PageNo" id="hdn_PageNo" type="hidden" value="<?php echo $intPgno; ?>" />
            <input name="hdn_RecNo" id="hdn_RecNo" type="hidden" value="<?php echo $intRecno; ?>" />
            <input name="hdn_IsPaging" id="hdn_IsPaging" type="hidden" value="<?php echo $isPaging; ?>" />
            <input name="hdn_ids" id="hdn_ids" type="hidden" />
            <input name="hdn_qs" id="hdn_qs" type="hidden" />
            <input type="button" name="btnUpdateSl" id="btnUpdateSl" class="btn btn-success" value="Update Serial Number" onClick="validSl();"/>
                <?php } else { ?>
                    <div class="noRecord">No record found</div>
            <?php } ?>
        </div>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <div class="row noPrint">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?> 
                            <?php echo $objUser->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
                        </div>
                    </div>
                <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                             <?php echo $objUser->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>                    
                                </ul>
                            </div>
                        </div>
                <?php } ?>
                </div>
        <?php } ?>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

<?php
	for($i=1;$i<=$intCount;$i++)
	{
?>
        <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<!--<div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >-->
       
          <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">User Profile Details</h4>
                    </div>
                    <div class="modal-body" id="divContent">
                        <table width="500" border="0" cellpadding="0" cellspacing="0" class="FormBorder" style="background-color:#FFFFFF;margin: 15px;">
                             <tr>
                               <th colspan="5"><div align="left">Personal Details</div></th>
                             </tr>
                             <tr>
                               <td style="width:214px;">Full Name</td> 
                               <td><script>document.write($('#hdnFullname<?php echo $i;?>').val());</script></td>
                               <td rowspan="4" valign="top"><script>document.write("<img src='"+$('#hdnimage<?php echo $i;?>').val()+"' height='75' width='75'");</script></td>
                             </tr>
                             <tr>
                               <td>Gender</td>
                               <td><script>document.write($('#hdnGender<?php echo $i;?>').val());</script></td>
                             </tr>
                             
                             <tr>
                               <td>Qualification</td>
                               <td><script>document.write($('#hdnQualification<?php echo $i;?>').val());</script></td>
                             </tr>
                             
                             <tr>
                               <th colspan="3"><div align="left">Service Details</div></th>
                             </tr>
                             <tr>
                               <td> Location </td>
                               <td colspan="2"><script>document.write($('#hdnLocation<?php echo $i;?>').val());</script></td>
                             </tr>
                             <tr>
                               <td> Select Department</td>
                               <td colspan="2"><script>document.write($('#hdnDept<?php echo $i;?>').val());</script></td>
                             </tr>
                             <tr>
                               <td>Designation </td>
                               <td colspan="2"><script>document.write($('#hdnDesignation<?php echo $i;?>').val());</script></td>
                             </tr>
                             
                             <tr>
                               <th colspan="3"><div align="left">Contact Details</div></th>
                             </tr>
                             <tr>
                               <td> Office Phone No./Extn</td>
                               <td colspan="2"><script>document.write($('#hdnOfficeNo<?php echo $i;?>').val());</script></td>
                             </tr>
                             <tr>
                               <td> Mobile No.</td>
                               <td colspan="2"><script>document.write($('#hdnMobileNo<?php echo $i;?>').val());</script></td>
                             </tr>
                             <tr>
                               <td>Email</td>
                               <td colspan="2"><script>document.write($('#hdnemail<?php echo $i;?>').val());</script></td>
                             </tr>
                             <tr>
                               <th colspan="3"><div align="left">Login Details</div></th>
                             </tr>
                             <tr>
                               <td>User ID</td>
                               <td colspan="2"><script>document.write($('#hdnUserId<?php echo $i;?>').val());</script></td>
                             </tr>
                           </table>
                    </div>

                </div>
            </div>
   	
   </div>

<?php }?>
   
