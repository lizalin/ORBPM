<?php
    /* ================================================
    File Name         	  : arhiveNotification.php
    Description		  : This is used for view Notification.
    Author Name           : Chinmayee
    Date Created          : 25-May-2016
    Devloped On           : 28-May-2016
    Devloped By           : Chinmayee
    Update History	  : <Updated by>		<Updated On>		<Remarks>
     
    Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
    includes		  : header.php, navigation.php, util.php, footer.php,arhiveNotificationInner.php

    ==================================================*/
    require 'archiveAuctionNoticeInner.php';
?>
<script language="javascript">
	$(document).ready(function () {
		$('.showsector').hide();
                pageHeader   = "Auction Notice";
                strFirstLink = "Manage Application";
                strLastLink = "Auction Notice";
                 deleteMe        = "yes";  
           $('[data-rel=tooltip]').tooltip();  
            
             	 deleteMe    = "<?php echo $deletePriv; ?>";
                 enableMe    = "<?php echo $noActive; ?>";
                 printMe     = "yes"; 
                if('<?php echo $outMsg;?>'!='')                
                   viewAlert('<?php echo $outMsg;?>');
                   
                 $('.showModal').click(function(){
			$('#myModal1').modal();			
		});
                 fillRTOOfficeName('RTOType',0);
	});
        function showdivsection(id){
                if(id==1){
                    fillcircularSection('noticeType',0);
                    $('.showsector').show(); 
                }else{
                    $('.showsector').hide();   
                }
                }
</script>
    <div class="page-content">
        <div class="page-header">
            <h1 id="title" class="col-sm-5"></h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
          
				<div class="clearfix"></div>
            <div class="top_tab_container">
                <?php if ($noAdd != '1'){ ?>
                    <a href="<?php echo APP_URL?>addAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                <a href="<?php echo APP_URL;?>viewAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info ">View</a> 
                <a href="javascript:void(0);" class="btn btn-info active">Archive</a></div>

                 <?php include('includes/util.php'); ?>
                <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">

                       <label class="col-sm-2  col-lg-1 control-label no-padding-right" for="selCategory">RTO Office</label>
                        <div class="col-sm-3 col-lg-2"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="RTOType" id="RTOType">
                             
                            </select>
                        </div>
                      
                        
                        <label class="col-sm-2  col-lg-1 control-label no-padding-right" for="selCategory">Auction Notice</label>
                        <div class="col-sm-3 col-lg-2"> 
                            <span class="colon">:</span>
                            <input type="text" name="txthead" class="form-control" value="<?php echo $txthead;?>">
                        </div>
                        <div class="col-sm-2  col-lg-1">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                        </div>
                    </div>
                </div>
                <div class="legandBox">			
                    <span class="greenLegend">&nbsp;</span>Published Media(s)&nbsp;			
                    <span class="yellowLegend">&nbsp;</span> Unpublished Media(s) &nbsp;
                </div>
                <div id="viewTable">
                <div class="table-responsive">
 <?php if ($result->num_rows > 0) {
                              $ctr = $intRecno; ?>
                    <table class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                               <th width="20">Sl#</th>
                                <th>RTO Office</th>
                                <th>Auction Notice in English</th>   
                                <th>Auction Notice in Odia</th>   
                                <th>Document</th>
                                <th>Code</th>
                                <th>Date </th>
<!--                                <th>Close Date </th>-->
                              
                            </tr>
                        </thead>
                        <tbody>
                           <?php                             
                        while ($row = mysqli_fetch_array($result)) {
                            
                            if($row['INT_PLUGIN_TYPE']!=0){
                               $sector =   htmlspecialchars_decode($row['sectorName'],ENT_NOQUOTES);
                              
                            }else{
                                $sector =  '--';
                            }
                            $code = ($row['VCH_CODE']!='')?$row['VCH_CODE']:'--';
                            $startDt = ($row['DTM_NOTICE_START']!='0000-00-00 00:00:00' && $row['DTM_NOTICE_START']!='1970-01-01 00:00:00')?date("d-m-Y",strtotime($row['DTM_NOTICE_START'])):'--';
                            $endDt = ($row['DTM_NOTICE_DATE']!='0000-00-00 00:00:00' && $row['DTM_NOTICE_DATE']!='1970-01-01 00:00:00')?date("d-m-Y",strtotime($row['DTM_NOTICE_DATE'])):'--';
                            if($row['INT_PUBLISH_STATUS']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                                ?>
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_AUCTION_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_AUCTION_ID'];?>" name="hdnPubStatus<?php echo $row['INT_AUCTION_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                   </label>
                                </td>
                                <td><?php  echo $ctr;?></td>
                                <td><?php  echo $sector;?></td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_NOQUOTES);?></td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_HEADLINE_O'],ENT_NOQUOTES); ?></td>  
                                <td>
                                    <?php $fileExp = explode(',',$row['VCH_DOCUMENT']);
                                        $tot = count($fileExp);
                                        for($i=1; $i<= $tot ; $i++){
                                            $j = $i-1;
                                        $fileName = $fileExp[$j];
                                        $fileName = str_replace('"', '',$fileName);
                                        if($fileName !=""){
                                        ?>
                                    <span><a href="<?php echo APP_URL; ?>uploadDocuments/AuctionNotice/<?php echo $fileName; ?>" target="_blank"  data-rel="tooltip" title="" data-original-title="Open Pdf" >
                                        <img src="<?php echo URL ?>img/pdf.png" alt="pdf document"  /></a><span>
                                        <?php }}?>
                                </td>
                                <td><?php echo $code;?></td>
                                 <td>  <?php  echo $startDt; ?></td>
                                <!--<td>  <?php  //echo $endDt; ?></td>-->
                            </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                     <input name="hdn_PageNo" id="hdn_PageNo" type="hidden" value="<?php echo $intPgno; ?>" />
                    <input name="hdn_RecNo" id="hdn_RecNo" type="hidden" value="<?php echo $intRecno; ?>" />
                    <input name="hdn_IsPaging" id="hdn_IsPaging" type="hidden" value="<?php echo $isPaging; ?>" />
                    <input name="hdn_ids" id="hdn_ids" type="hidden" />
                    <input name="hdn_qs" id="hdn_qs" type="hidden" />
                </div>
 <?php } else { ?>
                    <div class="noRecord">No record found</div>
            <?php  } ?>
            
            </div>
                <!-- PAGE CONTENT ENDS -->
                                   <?php if ($result->num_rows > 0) { ?>
                <div class="row noPrint">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?> 
    <?php echo $obj->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
                        </div>
                    </div>
    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
        <?php echo $obj->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>                    
                                </ul>
                            </div>
                        </div>
                <?php } ?>
                </div>
<?php } ?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" id="divContent">

                </div>

            </div>
        </div>
    </div>