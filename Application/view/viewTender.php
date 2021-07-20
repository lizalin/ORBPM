<?php
/* ================================================
    File Name         	  : viewTender.php
    Description		  : This is used for view Tender.
    Author Name           : T Ketaki Debadarshini
    Date Created          : 11-Sept-2015
    Devloped On           : 11-Sept-2015
    Devloped By           : T Ketaki Debadarshini
    Update History	  : <Updated by>		<Updated On>		<Remarks>

    Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
    includes		  : header.php, navigation.php, util.php, footer.php,viewTenderInner.php

    ==================================================*/
    /* error_reporting(E_ALL);
    ini_set('display_errors', '1'); */
require 'viewTenderInner.php';

?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function() {

        pageHeader = "View Tender";
        strFirstLink = "Manage Application";
        strLastLink = "Tender";

        archiveMe = "<?php echo $deletePriv; ?>";

        printMe = "yes";
        publishMe = "<?php echo $noPublish; ?>"
        unpublishMe = "<?php echo $noPublish; ?>"


        $('.showModal').click(function() {
            $('#myModal1').modal();
        });
        $('.showModal2').click(function() {
            $('#myModal2').modal();
        });
        if ('<?php echo $outMsg; ?>' != '')
        viewAlert('<?php echo $outMsg; ?>');


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
                <?php if ($noAdd != '1') { ?>
                    <a href="<?php echo APP_URL ?>addTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php } ?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a>
                <a href="<?php echo APP_URL; ?>archieveTender/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a>
            </div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="searchTable">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="txtHeadLineE">Tender Headline</label>
                    <div class="col-sm-3"> <span class="colon">:</span>
                        <input type="text" id="txtHeadLineE" name="txtHeadLineE" class="form-control" maxlength="50" value="<?php echo $strHeadline; ?>">
                    </div>
                    <label class="col-sm-2 control-label no-padding-right" for="txtStartDt">Tender Number</label>
                    <div class="col-sm-3"> <span class="colon">:</span>
                        <div class="input-group">
                            <input class="form-control" id="txtTenderno" name="txtTenderno" type="text" maxlength="50" value="<?php echo $strTenderNo; ?>">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <input class="btn btn-success" name="btnSearch" type="submit" value="Show" />
                    </div>
                </div>
            </div>
            <div class="legandBox">
                <span class="greenLegend">&nbsp;</span>Published Tender&nbsp;
                <span class="yellowLegend">&nbsp;</span> Unpublished Tender &nbsp;
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
                                <th>Tender Headline </th>
                                <th>Tender No.</th>
                                <th>Tender </th>
                                <th>Opening Date </th>
                                <th>Closing Date </th>
                                <th>Created On </th>
                                <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($result)) {
                                if ($row['INT_PUBLISH_STATUS'] == 2)
                                    $style    = 'class="greenBorder"';
                                else
                                    $style    = 'class="yellowBorder"';
                                $ctr++;
                            ?>
                                <tr <?php echo $style; ?>>
                                    <td class="noPrint">
                                        <label class="position-relative">
                                            <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_TENDER_ID']; ?>"><span class="lbl"></span>
                                            <input type="hidden" id="hdnPubStatus<?php echo $row['INT_TENDER_ID']; ?>" name="hdnPubStatus<?php echo $row['INT_TENDER_ID']; ?>" value="<?php echo $row['INT_PUBLISH_STATUS']; ?>" />
                                        </label>
                                    </td>
                                    <td><?php echo $ctr; ?></td>
                                    <td> <?php if ($row['VCH_DESCRIPTION_E'] != '') { ?>
                                            <a href="javascript:void(0);" title="Tender Details" class="showModal" onclick="getTenderDetails('<?php echo $row['INT_TENDER_ID']; ?>')"><?php echo htmlspecialchars_decode($row['VCH_HEAD_LINE_E'], ENT_NOQUOTES); ?></a>
                                        <?php } else {
                                                echo htmlspecialchars_decode($row['VCH_HEAD_LINE_E'], ENT_NOQUOTES);
                                            } ?>
                                    </td>
                                    <td><?php echo htmlspecialchars_decode($row['VCH_REF_NO'], ENT_NOQUOTES); ?></td>

                                    <td>
                                        <?php
                                        $fileExt = pathinfo($row['VCH_DOCUMENT_NAME'], PATHINFO_EXTENSION); ?>
                                        <a href="<?php echo APP_URL; ?>uploadDocuments/Tender/<?php echo $row['VCH_DOCUMENT_NAME']; ?>" target="_blank"><?php if ($fileExt == 'pdf') { ?><img src="<?php echo APP_URL; ?>img/pdf.png" alt="" width="16" height="16" border="0" align="absmiddle"><?php } else { ?><img src="<?php echo APP_URL; ?>img/wordIcon.jpg" alt="" width="20" height="20" border="0" align="absmiddle"><?php } ?></a>

                                    </td>
                                    <td><?php echo date("d-M-Y, h:i A", strtotime(htmlspecialchars_decode($row['DTM_OPENING_DATETIME'], ENT_NOQUOTES))); ?></td>
                                    <td><?php echo date("d-M-Y, h:i A", strtotime(htmlspecialchars_decode($row['DTM_CLOSING_DATETIME'], ENT_NOQUOTES))); ?></td>

                                    <td><?php echo date("d-M-Y", strtotime($row['DTM_CREATED_ON'])) ?></td>
                                    <td align="center" valign="middle" class="noPrint" style="<?php echo $editPriv; ?>"><a href="<?php echo APP_URL ?>addTender/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_TENDER_ID'] ?>" data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
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
                            <?php echo $objTender->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
                        </div>
                    </div>
                    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                                    <?php echo $objTender->getPaging($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
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