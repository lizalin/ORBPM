<?php
    /* ================================================
    File Name         	  : viewDesignation.php
    Description		  : This is used for view Department details.
    Author Name           : T Ketaki Debadarshini
    Date Created          : 
    Devloped On           : 11-Sept-2015
    Devloped By           : T Ketaki Debadarshini
    Update History	  : <Updated by>		<Updated On>		<Remarks>

    Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
    includes		  : header.php, navigation.php, util.php, footer.php,viewDesignationInner.php

    ==================================================*/
    require 'viewDesignationInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
	$(document).ready(function () {
		
            pageHeader = "View Designation";
            strFirstLink = "Manage Application";
            strLastLink = "Designation";
            
            deleteMe     = "<?php echo $deletePriv; ?>";          
            printMe		= "yes";            
		
            if('<?php echo $outMsg;?>'!='')                
               alert('<?php echo $outMsg;?>');
               
             fillLocation('<?php echo $intLocation;?>','ddlLocation');   
             getDepartments('<?php echo $intLocation;?>','ddlDepartment','<?php echo $intDepartment;?>');
	});
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
                    <a href="<?php echo APP_URL?>addDesignation/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a> </div>
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
                        <div class="col-sm-1">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                        </div>
                    </div>
                </div>
               
                <div id="viewTable">
                <?php if (mysqli_num_rows($result) > 0) {
                    $ctr = $intRecno; ?>
                    <table class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                                <th width="20">Sl.#</th>
                                <th>Designation </th>    
                                <th>Department </th>  
                                <th>Location </th>         
                                <th>Created On </th>
                                <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                            </tr>
                        </thead>
              		<tbody>
                        <?php while ($row = mysqli_fetch_array($result)) {
                           
                                $ctr++; 
                                ?>
                            <tr>
                                <td class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_DESIGNATION_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_DESIGNATION_ID'];?>" name="hdnPubStatus<?php echo $row['INT_DESIGNATION_ID'];?>" value=""/>
                                    </label>
                                </td>
                                <td><?php echo $ctr; ?></td>
                                 <td> <?php  echo htmlspecialchars_decode($row['VCH_DESIGNATION_NAME'],ENT_NOQUOTES);?> </td>  
                                <td> <?php   echo $objDesg->getName('VCH_DEPARTMENT_NAME', 'm_department_master', 'INT_DEPARTMENT_ID', $row['INT_DEPARTMENT_ID'],'0');?> </td>                            
                               
                                <td><?php
                                   echo $objDesg->getName('VCH_LOCATION', 'm_location_master', 'INT_LOCATION_ID', $row['INT_LOCATION'],'0');
                                ?></td>
                                <td><?php echo date("d-M-Y",strtotime($row['DTM_CREATED_ON']))?></td>
                                <td align="center" valign="middle" class="noPrint" style="<?php echo $editPriv; ?>"><a href="<?php echo APP_URL?>addDesignation/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_DESIGNATION_ID'] ?>" data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
                            </tr>
                        <?php } ?>
                         </tbody>
                    </table>
                    <input name="hdn_PageNo" id="hdn_PageNo" type="hidden" value="<?php echo $intPgno; ?>" />
                    <input name="hdn_RecNo" id="hdn_RecNo" type="hidden" value="<?php echo $intRecno; ?>" />
                    <input name="hdn_IsPaging" id="hdn_IsPaging" type="hidden" value="<?php echo $isPaging; ?>" />
                    <input name="hdn_ids" id="hdn_ids" type="hidden" />
                    <input name="hdn_qs" id="hdn_qs" type="hidden" />
                <?php } else { ?>
                    <div class="noRecord">No record found</div>
            <?php } ?>
        </div>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <div class="row noPrint">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?> 
    <?php echo $objDesg->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
                        </div>
                    </div>
    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
        <?php echo $objDesg->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>                    
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
         

