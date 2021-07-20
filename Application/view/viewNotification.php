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
    require 'viewNotificationInner.php';
?>
<script language="javascript">
	$(document).ready(function () {
		$('.showsector').hide();
                pageHeader = "View Tender";
                strFirstLink = "Manage Application";
                strLastLink = "Tender";
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
                 fillcircularSection('noticeType',<?php echo $intSection;?>);
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
                    <a href="<?php echo APP_URL?>addNotification/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a> <a href="<?php echo APP_URL;?>arhiveNotification/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a></div>

                 <?php include('includes/util.php'); ?>
                <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">
                        <!-- <label class="col-sm-2  col-lg-1 control-label no-padding-right" for="selCategory">Link Type</label> -->
                        
                        <label class="col-sm-2  col-lg-1 control-label no-padding-right showsector" for="selCategory" style="display:none;">Section</label>
                        <div class="col-sm-3 col-lg-2 showsector"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="noticeType" id="noticeType">
                     
                            </select>
                        </div>
                        
                        <label class="col-sm-2  col-lg-1 control-label no-padding-right" for="selCategory">Tender Number</label>
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
                    <span class="greenLegend">&nbsp;</span>Published Tender(s)&nbsp;			
                    <span class="yellowLegend">&nbsp;</span> Unpublished Tender(s) &nbsp;
                </div>
                <div id="viewTable">
                 <div class="table-responsive">
                 <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="40">
                                    <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                                <th width="40">
                                    Sl.#
                                </th>
                                <th width="150">
                                    Tender No.
                                </th>
                                <th width="300">
                                    Tender Title
                                </th>
                                <th>
                                    Tender Description
                                </th>
                                <th>
                                    Last Submission Date
                                </th>
                                <th>
                                    Opening Date
                                </th>
                                <th width="100">
                                    Take Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    TN8546001
                                </td>
                                <td>
                                    Quotation
                                </td>
                                <td>
                                    Quotation call notice for flower seeds and vegetable seeds -2020
                                </td>
                                <td>
                                    15-10-2020
                                </td>
                                <td>
                                    15-03-2020
                                </td>
                                <td>
                                    <a href="javascript:void(0);" data-rel="tooltip" title="Edit" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a>
                                    <a href="javascript:void(0);" data-rel="tooltip" title="delete" data-original-title="Delete" class="btn btn-xs btn-danger"> 
                                    <i class="icon-white icon-trash"></i> </a>
                                </td>
                            </tr>
                        </tbody>
                     </table>
 <?php /* if ($result->num_rows > 0) {
    print_r($result);
                              $ctr = $intRecno; ?>
                    <table class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                                <th width="20">Sl.#</th>
                                <th width="200">Tender No.</th>
                                <!-- <th>Link Type</th> -->
                                <th>Tender Title</th>   
                                <!-- <th>Headlines in Odia</th> -->   
                                <th>Tender Description</th>
                                <!-- <th width="100">Document</th> -->
                                <th>Last Submission Date</th>
                                <th>Opening Date </th>
                                <!-- <th>Url</th> -->
                                <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php                             
                        while ($row = $result->fetch_array()) {
                            if($row['INT_LINK_TYPE']==1){
                                $linkType= "Circular & Notifications";
                            }elseif($row['INT_LINK_TYPE']==2){
                                 $linkType= "Tender";
                            }elseif($row['INT_LINK_TYPE']==3){
                                 $linkType= "Route Rationalization";
                            }elseif($row['INT_LINK_TYPE']==4){
                                 $linkType= "Guideline for Public";
                            }else{
                                 $linkType= "--";
                            }
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
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_NOTIFICATION_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_NOTIFICATION_ID'];?>" name="hdnPubStatus<?php echo $row['INT_NOTIFICATION_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                        <input name="hdnId<?php echo $intCount;?>" id="hdnId<?php echo $intCount;?>" type="hidden" value="<?php echo $row['intSlNo'];?>" />
                                   </label>
                                </td>
                                <td><?php  echo $ctr;?></td>
                              
                                <td><?php if($row['INT_LINK_TYPE']==3){?>
                                
                                   <input type="text" class="updtslno" onkeypress="return isNumberKey(event);" name="txtSLNo<?php echo $row['INT_NOTIFICATION_ID'];?>" id="txtSLNo<?php echo $row['INT_NOTIFICATION_ID'];?>" value="<?php echo $row['INT_SLNO'];?>" style="width:100%" maxlength="2" class="noPrint"/>
                                 <?php }else{?>
                                 <?php   echo $row['INT_NOTIFICATION_ID'];}?>
                                </td> 
                               <!--  <td><?php  echo $linkType;?></td> -->
                                <td><?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_NOQUOTES);?></td>
                                <!-- <td class="akrutiorisarala"><?php echo htmlspecialchars_decode($row['VCH_HEADLINE_O'],ENT_NOQUOTES);?></td> -->
                                <td><?php   echo $sector; ?></td>
                                
                                <td>
                                    <?php $fileExp = explode(',',$row['VCH_DOCUMENT']);
                                        $tot = count($fileExp);
                                        if($tot > 1){
                                        for($i=1; $i<= $tot ; $i++){
                                            $j = $i-1;
                                        $fileName = $fileExp[$j];
                                        $fileName = str_replace('"', '',$fileName);?>
                                    <span><a href="<?php echo APP_URL; ?>uploadDocuments/Notification/<?php echo $fileName; ?>" target="_blank"  data-rel="tooltip" title="" data-original-title="Open Pdf" >
                                        <img src="<?php echo URL ?>img/pdf.png" alt="pdf document"  /></a><span>
                                        <?php }
                                        
                                        }else{
                                            echo "N/A";
                                        } ?>
                                </td>
                                <td><?php echo $code;?></td>
                                <td>  <?php  echo $startDt; ?></td>
                                <!-- <td>  <?php  echo $strUrl; ?></td> -->
                                <td align="center" valign="middle" class="noPrint" style=""><a href="<?php echo APP_URL; ?>addNotification/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_NOTIFICATION_ID'];?>"  data-rel="tooltip" title="" data-original-title="Edit"  class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
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
            <?php  } */ ?>
                <!-- PAGE CONTENT ENDS -->
                       <?php /*if ($result->num_rows > 0) { ?>
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
<?php }*/ ?>
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