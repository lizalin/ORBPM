<?php
	/* ================================================
	File Name         	  : viewPlugindetails.php
	Description		  : This is used to view plugin details.
	Author Name               :  T Ketaki Debadarshini
	Date Created		  : 09-Sept-2015
        Devloped On               : 09-Sept-2015
        Devloped By               :  T Ketaki Debadarshini
	Update History		  : <Updated by>		<Updated On>		<Remarks>
	
	Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
	Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
	includes              : header.php, navigation.php, util.php, footer.php,viewPlugindetailsInner.php

	==================================================*/
     require 'viewPlugindetailsInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script src="<?php echo APP_URL; ?>js/modal.js"></script>
<script language="javascript">
	$(document).ready(function () {
		 
                pageHeader   = "View <?php echo $_SESSION['sessPageName'];?>";
                strFirstLink = "Manage Application";
                strLastLink  = "<?php echo $_SESSION['sessPageName'];?>"; 
             
		archiveMe	= "<?php echo $deletePriv; ?>";          
		printMe		= "yes";                     
		publishMe       = "<?php echo $noPublish; ?>"
                unpublishMe     = "<?php echo $noPublish; ?>"
                showHome        = "no"
                hideHome        = "no"
             
		//enableMe	= "yes";
		
                if('<?php echo $outMsg;?>'!='')
                   alert('<?php echo $outMsg;?>');
                $('.showModal').click(function () {
                    $('#myModal1').modal();
                });   
                
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
              <a href="<?php echo APP_URL?>addPlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a> 
              <?php }?>
              <a href="javascript:void(0);" class="btn btn-info active">View</a> <a href="<?php echo APP_URL;?>archievePlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archieve</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
          <div class="searchTable">
            <div class="form-group">
                
	        <label class="col-sm-1 control-label no-padding-right" for="txtHeadLineE">Headline</label>
                <div class="col-sm-4"> <span class="colon">:</span>
                  <input type="text" id="txtHeadLineE" name="txtHeadLineE" class="form-control" value="<?php echo $strHeadlineE; ?>">
                </div>
                <?php if($_SESSION['sessFuncId'] == 9){?>
                <label class="col-sm-2 control-label no-padding-right" for="type">Select Category</label>
                <div class="col-sm-4"> <span class="colon">:</span>
                    <select name="ddlPluginType" id="ddlPluginType" class="form-control"><?php echo $objPlugin->fillSchemeCat($intPlugintype);?></select>
                </div>
                <?php } ?>
                <?php if($_SESSION['sessFuncId'] == 13){?>
                <label class="col-sm-2 control-label no-padding-right" for="type">Select Type</label>
                <div class="col-sm-4"> <span class="colon">:</span>
                    <select name="ddlPluginType" id="ddlPluginType" class="form-control">
                        <option value="0">- Select -</option>
                        <option value="1" <?php if($intPlugintype==1){echo 'selected="selected"';}?>>Office Orders</option>
                        <option value="2" <?php if($intPlugintype==2){echo 'selected="selected"';}?>>Circulars</option>
                    </select>
                </div>
                <?php } ?>
                <div class="col-sm-1">
                      <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                </div>
            </div>
              
            </div>
           <div class="legandBox">			
            <span class="greenLegend">&nbsp;</span>Published Document&nbsp;			
            <span class="yellowLegend">&nbsp;</span> Unpublished Document &nbsp;
          </div>
            <div id="viewTable">
                <?php if ($result->num_rows  > 0) {
                    $ctr = $intRecno; ?>
            	<table class="table  table-bordered table-hover">
                	<thead>
                          <tr>
                            <th width="20" class="noPrint">
                            	<label class="position-relative">
                            <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                   </th>
                            <th width="20">Sl.#</th>
                            <th>Headline</th>
                            <th>Document</th>
                            <?php if($_SESSION['sessFuncId'] == 9){?>
                            <th>Category</th>
                            <?php } ?>
                            <?php if($_SESSION['sessFuncId'] == 13){?>
                            <th>Type</th>
                            <?php } ?>
                            <th>Created On </th>
                            <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                          </tr>
                      </thead>
                    <tbody>
                   <?php while ($row = mysqli_fetch_array($result)) {

                    if($row['INT_PUBLISH_STATUS']==2)
                         $style	= 'class="greenBorder"';
                    else
                            $style	= 'class="yellowBorder"'; 
                    $ctr++; 
                    ?>
                          <tr <?php echo $style;?>>
                            <td class="noPrint">
                            	<label class="position-relative">
                      		<input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_PLUGIN_ID'];?>"><span class="lbl"></span>  
                                </label>
                                <input type="hidden" id="hdnPubStatus<?php echo $row['INT_PLUGIN_ID'];?>" name="hdnPubStatus<?php echo $row['INT_PLUGIN_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                            </td>
                            <td><?php echo $ctr; ?></td>
                            <td>
                             <?php if($row['VCH_DESCRIPTION'] != ''){?>
                                        <a href="#myModal<?php echo $row['INT_PLUGIN_ID']; ?>" role="button" data-toggle="modal"><?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_QUOTES); ?></a>
                                        
                                        <div class="modal fade" id="myModal<?php echo $row['INT_PLUGIN_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">Contents</h4>
                                                </div>
                                                  <div class="modal-body" id="divContent">
                                                    <?php echo htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_QUOTES);?>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                        <?php }else{ ?>
                                        <?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_NOQUOTES);?>
                                        <?php } ?>   
                             
                            </td>
                            <td align="center">
                                <?php if($row['VCH_DOCFILE']!=''){ ?>
                                <a href="<?php echo APP_URL ?>/uploadDocuments/plugin/<?php echo $row['VCH_DOCFILE'];?>" target="_blank"><img src="<?php echo APP_URL;?>img/pdf.png" alt="<?php echo $row['VCH_HEADLINE']; ?>" width="16" height="16" /></a>
                                <?php }else echo '&nbsp;';?>
                            </td>   
                             <?php if($_SESSION['sessFuncId'] == 9){?>
                            <td><?php echo $objPlugin->getName('VCH_CATEGORY_NAME', 't_scheme_category', 'INT_CATEGORY_ID', $row['INT_SUBCAT_ID'], '0');?></td>
                            <?php } ?>
                            <?php if($_SESSION['sessFuncId'] == 13){?>
                            <td><?php echo ($row['INT_SUBCAT_ID'] == 1)?'Office Orders':'Circulars';?></td>
                            <?php } ?>
                            <td><?php echo date("d-M-Y",strtotime($row['DTM_CREATED_ON']))?></td>
                            <td align="center" valign="middle" class="noPrint" style="<?php echo $editPriv; ?>"><a href="<?php echo APP_URL?>addPlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_PLUGIN_ID'] ?>" title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
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
            <?php if ($result->num_rows  > 0) { ?>
                <div class="row noPrint">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?> 
                            <?php echo $objPlugin->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
                        </div>
                    </div>
                    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                                 <?php echo $objPlugin->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>                    
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
         
 
