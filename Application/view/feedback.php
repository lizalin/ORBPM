<?php
/* ================================================
  File Name         	  : viewNews.php
  Description	          : This is used for view News.
  Author Name	          : Sunil Kumar Parida
  Date Created		  : 13-Aug-2015
 
  Devloped By		  : T Ketaki Debadarshini
  Devloped On		  : 13-Aug-2015
  Update History		  :
  <Updated by>		<Updated On>		<Remarks>
  Madhulita Sahoo       23-Feb-2015             Add Code to Take Action and view remarks using Json.        
  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
  includes			  : header.php, navigation.php, util.php, footer.php, complaintInner.php

  ================================================== */
require("feedbackInner.php");
?>
<script src="<?php echo APP_URL; ?>js/loadAjax.js"></script>
<script language="javascript">
    $(document).ready(function() {
        // loadNavigation('View Feedback');
        pageHeader = "View Feedback";
        strFirstLink = "Manage Application";
        strLastLink = "Feedback";

        deleteMe = "<?php echo $deletePriv; ?>";
        printMe = "yes";
        //activeMe	= "yes";
        //inactiveMe	= "yes";
        //enableMe	= "yes";

        //        viewSearchPannel('', 'searchPanel', 'chkSearch');
        if ('<?php echo $outMsg; ?>' !== '')
            alert('<?php echo $outMsg; ?>');

    });

    function validator() {
        if (!blankCheck('txtRemarks', 'Remark should not be blank'))
            return false;
        if (!maxLength('txtRemarks', 250, 'Remark'))
            return false;
    }
</script>
<div class="page-content">
    <div class="page-header">
        <h1 id="title" class="col-sm-5"></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="top_tab_container"><a href="<?php echo APP_URL; ?>feedback/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info active">View</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="searchTable">
                <div class="form-group">

                    <label class="col-sm-2 col-lg-1 control-label no-padding-right" for="selSubj">Feedback</label>
                    <div class="col-sm-3"> <span class="colon">:</span>
                        <input type="text" class="form-control" name="selSubj" id="selSubj" value="<?php echo $txtSubj; ?>" />
                    </div>
                    <div class="col-sm-1">
                        <input class="btn btn-success" name="btnSearch" type="submit" value="Show" />
                    </div>
                </div>
            </div>
            <!--            <div class="center"><a href="#" class="btn btn-xs btn-info btnSearch" id="chkSearch"></a></div>-->
            <div id="viewTable">

                <?php if (count($result) > 0) {
                    $ctr = $intRecno;
                    ?>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkAll"><span class="lbl"></span>
                                    </label>
                                </th>
                                <th width="20">Sl.#</th>
                                <th>Name</th>
                                <th>Mobile No </th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Posted On </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $row) {
                                $ctr ++;
                                ?>
                                <tr>
                                    <td class="noPrint">
                                        <label class="position-relative">
                                            <input type="checkbox" class="ace chkItem" value="<?php echo $row['feedBackId']; ?>"><span class="lbl"></span></label></td>
                                    <td><?php echo $ctr; ?></td>
                                   <td><?php echo htmlspecialchars_decode($row['strName'].' '.$row['strNameL'], ENT_QUOTES); ?></td>
                                    <td><?php echo htmlspecialchars_decode($row['strTelNo'], ENT_QUOTES); ?></td>
                                    <td><a href="mailto:<?php echo $row['strEmail'];?>" title="<?php echo $row['strEmail'];?>"><?php echo htmlspecialchars_decode($row['strEmail'], ENT_QUOTES); ?></a></td>
                                    
                                    <td>

                                        <?php echo ucfirst(htmlspecialchars_decode($row['strMessage'], ENT_QUOTES)); ?>

                                    </td>
                                    <td><?php echo date('d-M-Y', strtotime($row['strCreatedOn'])); ?></td>
                             
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <input name="hdn_PageNo" id="hdn_PageNo" type="hidden" value="<?php echo $intPgno; ?>" />
                    <input name="hdn_RecNo" id="hdn_RecNo" type="hidden" value="<?php echo $intRecno; ?>" />
                    <input name="hdn_IsPaging" id="hdn_IsPaging" type="hidden" value="<?php echo $isPaging; ?>" />
                    <input name="hdn_ids" id="hdn_ids" type="hidden" />
                    <input name="hdn_qs" id="hdn_qs" type="hidden" />
                    <input type="hidden" id="hdnFid" name="hdnFid" value="">
            <?php } else { ?>
                    <div class="noRecord">No record found</div>
            <?php } ?>

            </div>
            <?php if (count($result) > 0) {
            ?>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();">
                                    <?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a> /
                            <?php }
                            echo $objFeedBack->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, $isPaging);
                            ?>
                        </div>
                    </div>
                    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                                    <?php echo $objFeedBack->getPaging($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
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