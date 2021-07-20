<?php
/* ================================================
  File Name         	  : archievePage.php
  Description		  : This is used for view the archieve Page details.
  Author Name		  : T Ketaki Debadarshini
  Date Created		  :  14-Aug-2015
  Update History		  : <Updated by>		<Updated On>		<Remarks>

  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css,datepicker.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js,loadAjax.js,bootstrap-datepicker.min.js,validatorchklist.js
  includes              : header.php, navigation.php, util.php, footer.php,archievePageInner.php

  ================================================== */
require("archievePageInner.php");
?>
<script src="<?php echo APP_URL; ?>js/loadAjax.js"></script>
<script src="<?php echo APP_URL; ?>js/modal.js"></script>
<script language="javascript">
    $(document).ready(function () {
       // loadNavigation('Archive Pages');
            pageHeader   = "Archive Pages";
            strFirstLink = "Manage Link";
            strLastLink  = "Pages";   
            
            deleteMe    = "<?php echo $deletePriv; ?>";
            enableMe    = "<?php echo $noActive; ?>";

            printMe		= "yes";  
                
         $('.showModal').click(function () {
            $('#myModal1').modal();
        });
        
        if('<?php echo $outMsg;?>'!='')
        	viewAlert('<?php echo $outMsg;?>');
                
         $('[data-rel=tooltip]').tooltip();  
                
        
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
                    <a href="<?php echo APP_URL ?>addPage/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a> 
              <?php }?>
                <a href="<?php echo APP_URL; ?>viewPage/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">View</a> <a href="javascript:void(0);" class="btn btn-info active">Archive</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div> 
            <div class="searchTable">
                <div class="form-group">
			  <label class="col-sm-2 control-label no-padding-right" for="txtHeadLineE">Page Name</label>
                  <div class="col-sm-4"> <span class="colon">:</span>
                  <input type="text" id="txtHeadLineE" name="txtHeadLineE" class="form-control" value="<?php echo $strHeadlineE; ?>">
			  </div>			  
			  <div class="col-sm-1">
				<input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
			  </div>
                </div>
            </div>
            <div id="viewTable">
                <?php if (($result->num_rows) > 0) {
                    $ctr = $intRecno; ?>
                   <table class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                                <th width="20">Sl.#</th>
                                <th>Page Title</th>                                
                                <th>Page Name </th> 
                                <th>Link Type </th>                                
                                <th>URL </th>
                                <th>Windows Status</th>
                                <th>Created on</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($result)) {
                               
                                if($row['intPublishStatus']==2)
                                  $style	= 'class="greenBorder"';
                                else
                                   $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                                ?>
                                <tr <?php echo $style;?>>
                                    <td class="noPrint">
                                        <label class="position-relative">
                                            <input type="checkbox" class="ace chkItem" value="<?php echo $row['intPageId'];?>"><span class="lbl"></span></label></td>
                                    <td><?php echo $ctr; ?></td>
                                    <?php 
                                        $pageContent    = "";                                                                   
                                        $pageId         = $row['intPageId']; 
                                        if($row['TOTAL'] > 0)
                                        {
                                            //$subSql1        = "CALL USP_PAGE_CONTENT('V1','','$pageId','0');";
                                            $subSql1        = $objPages->managePageContent('V1',0, $pageId,0,'','','');
                                            //$subResult1     =  Model::executeQry($subSql1);

                                            while($subRow1 = mysqli_fetch_array($subSql1))
                                            {
                                                $pageContent .= ($subRow1['vchContentE'] != "")?htmlspecialchars_decode(str_replace('&quot;','"',$subRow1["vchContentE"]),ENT_NOQUOTES):'';                                                                                
                                                }
                                        ?>
                                    <td>
                                        
                                        <a href="#myModal<?php echo $pageId; ?>" role="button" data-toggle="modal"><?php echo htmlspecialchars_decode($row['vchTitle'],ENT_QUOTES); ?></a>
                                        
                                        <div class="modal fade" id="myModal<?php echo $pageId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">Page Contents</h4>
                                                </div>
                                                  <div class="modal-body" id="divContent">
                                                    <?php echo $pageContent;?>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                        <?php }else{ ?>
                                        <?php echo htmlspecialchars_decode($row['vchTitle'],ENT_QUOTES); ?>
                                        <?php } ?>
                                    </td>  
                                    <td>
                                        <?php  echo htmlspecialchars_decode($row['vchName'],ENT_QUOTES);?>
                                    </td> 
                                   
                                                                       
                                    <td><?php 
                                    $linkType = $row['intLinkType'];
                                    if($linkType==1)
                                        echo 'Internal';
                                     else 
                                        echo 'External';
                                    ?></td>
                                    
                                    <td><?php echo ($linkType==2)? $row['vchURL']:''; ?></td>
                                    <td>
                                        <?php  echo ($row['intWindowStatus']=='1' )?'Same':'New'; ?>
                                    </td> 
<!--                                     <td><?php //echo ($row['vchPluginName']!='0' )? $row['vchPluginName']:''; ?></td>-->
                                     
                                    <td><?php echo date("d-M-Y",strtotime($row['dtmCreatedOn']))?></td>
                                   
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
<?php if (($result->num_rows) > 0) { ?>
                <div class="row noPrint">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?> 
    <?php echo $objPages->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
                        </div>
                    </div>
    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
        <?php echo $objPages->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>                    
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