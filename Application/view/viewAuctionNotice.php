<?php
    /* ================================================
    File Name         	  : viewNotification.php
    Description		  : This is used for view Notification.
    Author Name           : Chinmayee
    Date Created          : 25-May-2016
    Devloped On           : 
    Devloped By           : 
    Update History	  : <Updated by>		<Updated On>		<Remarks>
     
    Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
    includes		  : header.php, navigation.php, util.php, footer.php,viewGalleryInner.php

    ==================================================*/
    require 'viewAuctionNoticeInner.php';
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>css/datepicker.css"/>
<script type="text/javascript" src="<?php echo APP_URL; ?>js/bootstrap-datepicker.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
    pageHeader   = "View Auction Notice";
    strFirstLink = "Manage Application";
    strLastLink  = "Auction Notice";
           $('[data-rel=tooltip]').tooltip();  
            	archiveMe	= "<?php echo $deletePriv; ?>";
		printMe		= "yes";       
		publishMe       = "<?php echo $noPublish; ?>"
                unpublishMe     = "<?php echo $noPublish; ?>"
             	
                if('<?php echo $outMsg;?>'!='')                
                   viewAlert('<?php echo $outMsg;?>');
                   
                 $('.showModal').click(function(){
			$('#myModal1').modal();			
		});
                fillRTOOfficeName('RTOType','<?php echo $strlinkType;?>');
                 showdivsection(<?php echo $intlinkType;?>,<?php echo $intSection;?>);
              
	});
            function showdivsection(id,sectionid){
                if(id==1){
                    fillcircularSection('noticeType',sectionid);
                    $('.showsector').show(); 
                }else{
                    $('.showsector').hide();   
                }
                }
             function validSl(totalVal)
            {
		var flag	= 0;
		$('.updtslno').each(function(){
                        //console.log(Number(this.value));
			if(this.value==0)
			{
				viewAlert('Serial number must be greater than zero');
				this.focus();
				flag	= 1;
				return false;
			}
			if(Number(this.value) > Number(totalVal))
			{
				viewAlert('Serial number can not greater than total records');
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
          
				<div class="clearfix"></div>
            <div class="top_tab_container">
                <?php if ($noAdd != '1'){ ?>
                    <a href="<?php echo APP_URL?>addAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a> <a href="<?php echo APP_URL;?>archiveAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a></div>

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
                            <input class="btn btn-success" name="btnSearch" type="submit"  value="Show"/>
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
                                <th width="20">View Order</th>
                                <th>RTO Office</th>
                                <th>Auction Notice in English</th>   
                                <th>Auction Notice in Odia</th>   
                                <!--<th>Section</th>-->
                                <th width="100">Document</th>
                                <th>Code</th>
                                <th>Date </th>
                                <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php                             
                        while ($row = $result->fetch_array()) {
                            
                            if($row['INT_PLUGIN_TYPE']!=0){
                               $sector =   htmlspecialchars_decode($row['sectorName'],ENT_NOQUOTES);
                              
                            }else{
                                $sector =  '--';
                            }
                            $code = ($row['VCH_CODE']!='')?$row['VCH_CODE']:'--';
                            $startDt = ($row['DTM_NOTICE_START']!='0000-00-00 00:00:00' && $row['DTM_NOTICE_START']!='1970-01-01 00:00:00')?date("d-m-Y",strtotime($row['DTM_NOTICE_START'])):'--';
                            $endDt = ($row['DTM_NOTIFICATION_DATE']!='0000-00-00 00:00:00' && $row['DTM_NOTIFICATION_DATE']!='1970-01-01 00:00:00')?date("d-m-Y",strtotime($row['DTM_NOTIFICATION_DATE'])):'--';
                            $strUrl = htmlspecialchars_decode($row['VCH_URL'],ENT_NOQUOTES);
                            if($row['INT_PUBLISH_STATUS']==2)
                            {
                                $style	= 'class="greenBorder"';
                            }
                            else{
                                $style	= 'class="yellowBorder"'; 
                            }
                                $ctr++; 
                                ?>
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                   <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_AUCTION_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_AUCTION_ID'];?>" name="hdnPubStatus<?php echo $row['INT_AUCTION_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                        <input name="hdnId<?php echo $intCount;?>" id="hdnId<?php echo $intCount;?>" type="hidden" value="<?php echo $row['intSlNo'];?>" />
                                   </label>
                                </td>
                                <td><?php  echo $ctr;?></td>
                              
                                <td>
                                
                                   <input type="text" class="updtslno" onkeypress="return isNumberKey(event);" name="txtSLNo<?php echo $row['INT_AUCTION_ID'];?>" id="txtSLNo<?php echo $row['INT_AUCTION_ID'];?>" value="<?php echo $row['INT_SLNO'];?>" style="width:100%" maxlength="2" class="noPrint"/>
                                  <input name="hdncatid<?php echo $row['INT_AUCTION_ID'];?>" id="hdncatid<?php echo $row['INT_AUCTION_ID'];?>" type="hidden"  value="<?php echo $row['INT_PLUGIN_ID'];?>"/>
                                </td>
                                <td><?php  echo htmlspecialchars_decode($row['sectorName'],ENT_NOQUOTES);?></td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_NOQUOTES);?></td>
                                <td class="akrutiorisarala"><?php echo htmlspecialchars_decode($row['VCH_HEADLINE_O'],ENT_NOQUOTES);?></td>
                                <td>
                                    <?php $fileExp = explode(',',$row['VCH_DOCUMENT']);
                                        $tot = count($fileExp);
                                       
                                        if($tot >=1){
                                        for($i=1; $i<= $tot ; $i++){
                                            $j = $i-1;
                                           
                                        $fileName = $fileExp[$j];
                                        $fileName = str_replace('"', '',$fileName);
                                        if($fileName!="")
                                        {
                                       ?>
                                    <span><a href="<?php echo APP_URL; ?>uploadDocuments/AuctionNotice/<?php echo $fileName; ?>" target="_blank"  data-rel="tooltip" title="" data-original-title="Open Pdf" >
                                        <img src="<?php echo URL ?>img/pdf.png" alt="pdf document"  /></a><span>
                                        <?php }
                                        else{
                                            echo "N/A";
                                        }}
                                        
                                        }else{
                                            echo "N/A";
                                        } ?>
                                </td>
                                <td><?php echo $code;?></td>
                                <td>  <?php  echo $startDt; ?></td>
                               
                                <td align="center" valign="middle" class="noPrint" style=""><a href="<?php echo APP_URL; ?>addAuctionNotice/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_AUCTION_ID'];?>"  data-rel="tooltip" title="" data-original-title="Edit"  class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                     <input type="button" name="btnUpdateSl" id="btnUpdateSl" class="btn btn-success noPrint" value="Update Serial Number" onClick="return validSl('<?php echo $totRecords;?>');"/>
                     <input name="hdn_PageNo" id="hdn_PageNo" type="hidden" value="<?php echo $intPgno; ?>" />
                    <input name="hdn_RecNo" id="hdn_RecNo" type="hidden" value="<?php echo $intRecno; ?>" />
                    <input name="hdn_IsPaging" id="hdn_IsPaging" type="hidden" value="<?php echo $isPaging; ?>" />
                    <input name="hdn_ids" id="hdn_ids" type="hidden" />
                    <input name="hdn_qs" id="hdn_qs" type="hidden" />
                </div>
 <?php } else { ?>
                    <div class="noRecord">No record found</div>
            <?php  } ?>
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