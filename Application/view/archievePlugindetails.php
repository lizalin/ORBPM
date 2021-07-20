<?php
	/* ================================================
	File Name         	  : archivePlugindetails.php
	Description		  : This is used for view plugin details.
	Author Name               : T Ketaki Debadarshini
	Date Created		  : 10-Sept-2015
        Devloped On               : 10-Sept-2015
        Devloped By               : T Ketaki Debadarshini
	Update History		  : <Updated by>		<Updated On>		<Remarks>
						
	Style sheet               : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
	Javscript Functions       : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
	includes		  : header.php, navigation.php, util.php, footer.php,archivePlugindetailsInner.php

	==================================================*/
     require 'archievePlugindetailsInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<link rel="stylesheet" href="<?php echo APP_URL; ?>css/datepicker.css">
<script src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript">
	$(document).ready(function () {
		//loadNavigation('View Act & Rule');
                pageHeader = "Archieve <?php echo $_SESSION['sessPageName'];?>";
                strFirstLink = "Manage Application";
                strLastLink = "<?php echo $_SESSION['sessPageName'];?>";
		
		deleteMe	= "<?php echo $deletePriv; ?>";
                enableMe	= "<?php echo $noActive; ?>";
              
		printMe		= "yes"; 
		
                $('.date-picker').datepicker({
                 autoclose: true,
                 todayHighlight: true
                });
                
                if('<?php echo $outMsg;?>'!='')                
                    viewAlert('<?php echo $outMsg;?>');

                
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
            <?php if ($noAdd != '1') { ?>
             <a href="<?php echo APP_URL?>addPlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
              <?php }?>
             
              <a href="<?php echo APP_URL?>viewPlugindetails/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info ">View</a> <a href="javascript:void(0);" class="btn btn-info active">Archieve</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
          <div class="searchTable">
            <div class="form-group">
		<label class="col-sm-1 control-label no-padding-right" for="txtHeadLineE">Headline</label>
              <div class="col-sm-3"> <span class="colon">:</span>
                  <input type="text" id="txtHeadLineE" name="txtHeadLineE" class="form-control" value="<?php echo $strHeadlineE; ?>">
	     </div>
            <label class="col-sm-1 control-label no-padding-right" for="txtStartDt">Date From</label>
              <div class="col-sm-2"> <span class="colon">:</span>
                  <div class="input-group">
                      <input class="form-control date-picker" id="txtStartDt" name="txtStartDt" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $strDate;?>">
                      <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i> </span> 
                  </div>
              </div>

              <label class="col-sm-1 control-label no-padding-right" for="txtEndDt">Date To</label>
              <div class="col-sm-2"> <span class="colon">:</span>
                  <div class="input-group">
                      <input class="form-control date-picker" id="txtEndDt" name="txtEndDt" type="text" data-date-format="dd-mm-yyyy" value="<?php echo $endDatee;?>">
                      <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i> </span> 
                  </div>
              </div>
            <div class="col-sm-1">
                  <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
            </div>
            </div>
            </div>
            <div id="viewTable">
                <?php if (($result->num_rows) > 0) {
                    $ctr = $intRecno; ?>
            	<table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th width="20" class="noPrint">
                            <label class="position-relative">
                            <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                        </th>
                        <th width="20">Sl.#</th>
                        <th>Headline</th>                           
                        <th>Document</th>
                        
                        <th>Created On </th>                          
                      </tr>
                  </thead>
                      <tbody>
                            <?php while ($row = mysqli_fetch_array($result)) {

                        if($row['INT_PUBLISH_STATUS']==2)
                                $style	= 'style="background-color:#ecf8e6"';
                        else
                                $style	= 'style=""'; 
                        $ctr++; 
                        ?>
                          <tr <?php echo $style;?>>
                            <td class="noPrint">
                            	<label class="position-relative">
                      		<input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_PLUGIN_ID'];?>"><span class="lbl"></span></label>                            
                            </td>
                            <td><?php echo $ctr; ?></td>
                            
                            <td>
                                 <?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_NOQUOTES);?>
                            </td>
                             
                            
                            <td align="center">
                                <?php if($row['VCH_DOCFILE']!=''){ ?>
                                <a href="<?php echo APP_URL ?>/uploadDocuments/plugin/<?php echo $row['VCH_DOCFILE'];?>" target="_blank"><img src="<?php echo APP_URL;?>img/pdf.png" alt="<?php echo $row['VCH_HEADLINE']; ?>" width="16" height="16" /></a>
                                <?php }else echo '&nbsp;';?>
                            </td>                            
                            <td><?php echo date("d-M-Y",strtotime($row['DTM_CREATED_ON']))?></td>                            
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
         
 