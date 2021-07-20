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
    require 'arhiveNotificationInner.php';
?>
<script language="javascript">
	$(document).ready(function () {
		$('.showsector').hide();
                pageHeader = "View Tender";
                strFirstLink = "Manage Application";
                strLastLink = "Tender";
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
                 fillcircularSection('noticeType',0);
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
                    <a href="<?php echo APP_URL?>addNotification/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                <a href="<?php echo APP_URL;?>viewNotification/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info ">View</a> 
                <a href="javascript:void(0);" class="btn btn-info active">Archive</a></div>

                 <?php include('includes/util.php'); ?>
                <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">

                       <!-- <label class="col-sm-2  col-lg-1 control-label no-padding-right" for="selCategory">Link Type</label> -->
                        <!-- <div class="col-sm-3 col-lg-2"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="linkType" id="linkType" onchange="showdivsection(this.value);">
                             <option value="0" >-select-</option>
                                <option value="1" <?php if($intlinkType==1){?>selected="selected"<?php }?>>Circular & Notifications</option>
                                <option value="2" <?php if($intlinkType==2){?>selected="selected"<?php }?>>Tender</option>
                                <option value="3" <?php if($intlinkType==3){?>selected="selected"<?php }?>>Route Rationalization</option>
                                <option value="4" <?php if($intlinkType==4){?>selected="selected"<?php }?>>Guideline for Public</option>
                            </select>
                        </div> -->
                      
                        <label class="col-sm-2  col-lg-1 control-label no-padding-right showsector" for="selCategory" style="display:none;">Section</label>
                        <div class="col-sm-3 col-lg-2 showsector"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="noticeType" id="noticeType">
                     
                            </select>
                        </div>
                        <label class="col-sm-2  col-lg-1 control-label no-padding-right" for="selCategory">Headline</label>
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
                                <tr>
                                <td>
                                    <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </td>
                                <td>
                                    2
                                </td>
                                <td>
                                    TN8546002
                                </td>
                                <td>
                                    Quotation
                                </td>
                                <td>
                                    Quotation call notice for Health and Sanitation -2020
                                </td>
                                <td>
                                    18-08-2020
                                </td>
                                <td>
                                    20-03-2020
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
                              $ctr = $intRecno; ?>
                    <table class="table  table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                               <th width="20">Sl.#</th>
                                <th>Link Type</th>
                                <th>Headlines in English</th>   
                                <th>Headlines in Odia</th>   
                                <th>Section</th>
                                
                                <th>Code</th>
                                <th>Document</th>
                                <th>Open Date </th>
                                <th>Close Date </th>
                              
                            </tr>
                        </thead>
                        <tbody>
                           <?php                             
                        while ($row = mysqli_fetch_array($result)) {
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
                            if($row['INT_PUBLISH_STATUS']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                                ?>
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_NOTIFICATION_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_NOTIFICATION_ID'];?>" name="hdnPubStatus<?php echo $row['INT_NOTIFICATION_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                   </label>
                                </td>
                                <td><?php  echo $ctr;?></td>
                                <td><?php  echo $linkType;?></td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_NOQUOTES);?></td>
                                 <td><?php   echo $sector; ?></td>  
                                <!--td> <a href="<?php echo APP_URL; ?>uploadDocuments/Notification/<?php echo $row['VCH_DOCUMENT']; ?>" target="_blank"  data-rel="tooltip" title="" data-original-title="Open Pdf" >
                                        <img src="<?php echo URL ?>img/pdf.png" alt="Image One"  /></a></td-->
                                <td>  <?php  echo date("d-M-Y", strtotime($row['DTM_CREATED_ON'])); ?></td>
                               <td><?php echo $code;?></td>
                                <td>
                                    <?php $fileExp = explode(',',$row['VCH_DOCUMENT']);
                                        $tot = count($fileExp);
                                        for($i=1; $i<= $tot ; $i++){
                                            $j = $i-1;
                                        $fileName = $fileExp[$j];
                                        $fileName = str_replace('"', '',$fileName);?>
                                    <span><a href="<?php echo APP_URL; ?>uploadDocuments/Notification/<?php echo $fileName; ?>" target="_blank"  data-rel="tooltip" title="" data-original-title="Open Pdf" >
                                        <img src="<?php echo URL ?>img/pdf.png" alt="pdf document"  /></a><span>
                                        <?php }?>
                                </td>
                                <td>  <?php  echo $startDt; ?></td>
                                <td>  <?php  echo $endDt; ?></td>
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
            <?php  }*/ ?>
            
            </div>
                <!-- PAGE CONTENT ENDS -->
                                   <?php if ($result->num_rows > 0) { ?>
                <div class="row noPrint">
                <div class="col-xs-6 backToWebsite">
                    <a href="https://www.rajbhavanodisha.gov.in/view/index.php">Back to Website</a>
                </div>
                    <div class="col-xs-6 float-right">
                        <div class="dataTables_info text-right" id="sample-table-2_info">
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