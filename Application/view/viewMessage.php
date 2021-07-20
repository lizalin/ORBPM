<?php
/* ================================================
  File Name         : viewMessage.php
  Description		: This page is used to view messages for contactus pages.
  Developed By	    : Indrani
  Developed On	    : 23-Dec-2020
  Update History	:
  <Updated by>	<Updated On>		<Remarks>

  Style sheet           : style.php
  Javscript Functions   : jquery.js,loadComponent.js
  includes		    : header.php,leftmenu.php,navigation.php,util.php,footer.php,viewMessageInner.php
  ================================================== */
include('viewMessageInner.php');
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script src="<?php echo APP_URL; ?>js/loadAjax.js"></script>
<script language="javascript">
    $(document).ready(function () {
        pageHeader   = "View Message";
        strFirstLink = "Manage Application";
        strLastLink = "Message";
        deleteMe    = "<?php echo $deletePriv; ?>";
        publishMe       = "<?php echo $noPublish; ?>";
        unpublishMe     = "<?php echo $noPublish; ?>";
        printMe     = "yes";     
 
        if ('<?php echo $outMsg; ?>' != '')
            alert('<?php echo $outMsg; ?>');

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
                    <a href="<?php echo APP_URL ?>addMessage/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php } ?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a> </div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
             <div class="searchTable">
                <div class="form-group">
                    <label class="col-sm-2  col-lg-1 control-label no-padding-right" for="selPageType">Page Type</label>
                        <div class="col-sm-3 col-lg-2"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="selPageType" id="selPageType">
                               <option value="0" <?php if ($selPageType == 0) echo 'selected="selected"'; ?> >- Select -</option>  
                               <option value="1" <?php if ($selPageType == 1) echo 'selected="selected"'; ?>>Compliment</option>
                               <option value="2" <?php if ($selPageType == 2) echo 'selected="selected"'; ?>>Complaint</option>
                               <option value="3" <?php if ($selPageType == 3) echo 'selected="selected"'; ?>>Feedback</option>
                            </select>
                        </div>
                        <div class="col-sm-2  col-lg-1">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                        </div>
                </div>
            </div>
            <div class="legandBox">			
<!--                    <span class="greenLegend">&nbsp;</span>Published &nbsp;			-->
<!--                    <span class="yellowLegend">&nbsp;</span> Unpublished &nbsp;-->
            </div>
            <div id="viewTable">
            <div class="table-responsive">
                <?php
                if (($result->num_rows) > 0) {

                    $ctr = $intRecno;
                
                ?>
                <table class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="20" class="noPrint">
                                <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                            </th>
                            <th width="20">Sl.#</th>
                            <th>Page Type</th>                            
                            <th>Message In English</th>
                            <th>Message In Odiya</th>  
                            <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                        </tr>
                    </thead>

                    <?php
                    
                    while ($row = mysqli_fetch_array($result)) {
                        if ($row['INT_PUBLISH_STATUS'] == 2)
                            $style = 'class="greenBorder"';
                        else
                            $style = 'class="yellowBorder"';
                        $ctr++;
                        ?>                
                        <tbody>
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_ID']; ?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_ID']; ?>" name="hdnPubStatus<?php echo $row['INT_ID']; ?>" value="<?php echo $row['INT_PUBLISH_STATUS']; ?>"/>
                                    </label>
                                </td>
                                <td><?php echo $ctr; ?></td>
                                <td> 
                                    <?php 
                                        if($row['INT_PAGETYPE_ID']==1)
                                            $pagename = "Compliment";
                                        else if($row['INT_PAGETYPE_ID']==2)
                                            $pagename = "Complaint";
                                        else if($row['INT_PAGETYPE_ID']==3)
                                            $pagename = "Feedback";

                                    echo $pagename; ?>
                                </td>
                                <td> 
                                    <?php echo htmlspecialchars_decode($row['VCH_CONTENT_E'], ENT_NOQUOTES); ?>
                                </td> 
                                <td class="akrutiorisarala"> 
                                    <?php echo htmlspecialchars_decode($row['VCH_CONTENT_O'], ENT_NOQUOTES); ?>
                                </td>                                                       
                                <td align="center" valign="middle" class="noPrint" style=""><a href="<?php echo APP_URL; ?>addMessage/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_ID'];?>"  data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
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
            </div>
                        <?php if (mysqli_num_rows($result) > 0) { ?>
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
<?php } ?>  </div>

    </div>