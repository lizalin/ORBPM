<?php
/* ================================================
	File Name         	  : viewLink.php
	Description		  : This is used for view link.
	Author Name               : T Ketaki Debadarshini
	Date Created		  : 10-Jan-2015
        Devloped On               : 10-Jan-2015
        Devloped By               : T Ketaki Debadarshini
	Update History		  : <Updated by>		<Updated On>		<Remarks>
						
	Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
	Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
	includes			  : header.php, navigation.php, util.php, footer.php,archiveLinkInner.php

	==================================================*/
require 'archiveLinkInner.php';
?>

<script language="javascript">
	$(document).ready(function() {
		//loadNavigation('Archieve Important Link');

		pageHeader = "Archieve Important Link";
		strFirstLink = "Manage Application";
		strLastLink = "Important Link";

		deleteMe = "<?php echo $deletePriv; ?>";
		enableMe = "<?php echo $noActive; ?>";


		if ('<?php echo $outMsg; ?>' != '')
			viewAlert('<?php echo $outMsg; ?>');


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
					<a href="<?php echo APP_URL ?>addLink/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
				<?php } ?>
				<a href="<?php echo APP_URL ?>viewLink/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info ">View</a> <a href="javascript:void(0);" class="btn btn-info active">Archive</a>
			</div>
			<?php include('includes/util.php'); ?>
			<div class="hr hr-solid"></div>
			<div class="searchTable">
				<div class="form-group">
					<label class="col-sm-2 col-lg-1 control-label no-padding-right" for="selCategory">Link Name </label>
					<div class="col-sm-3">
						<span class="colon">:</span>
						<input type="text" name="txthead" class="form-control" value="<?php echo $strHeadlineE; ?>">
					</div>
					<div class="col-sm-1">
						<input class="btn btn-success" name="btnSearch" type="submit" value="Show" />
					</div>
				</div>
			</div>
			<div class="legandBox">
				<span class="greenLegend">&nbsp;</span>Published Link&nbsp;
				<span class="yellowLegend">&nbsp;</span> Unpublished Link &nbsp;
			</div>
			<div id="viewTable">
				<div class="table-responsive">
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
									
									<th>Link Name</th>
									<th>URL</th>
									<th>Updated On</th>
									
								</tr>
							</thead>
							<tbody>
								<?php while ($row = mysqli_fetch_array($result)) {
									if ($row['tinPublishStatus'] == 2)
										$style = 'class="greenBorder"';
									else
										$style  = 'class="yellowBorder"';
									$ctr++;
								?>
									<tr <?php echo $style; ?>>
										<td class="noPrint">
											<label class="position-relative">
												<input type="checkbox" class="ace chkItem" value="<?php echo $row['intLinkId']; ?>"><span class="lbl"></span> </label>
										</td>
										<td><?= $ctr?></td>
										<td><?php  echo htmlspecialchars_decode($row['vchLinkNameE'],ENT_NOQUOTES);?></td>
										<td>
										<a href="<?php  echo htmlspecialchars_decode($row['vchUrl'],ENT_NOQUOTES);?>" >
							  				<?php  echo htmlspecialchars_decode($row['vchUrl'],ENT_NOQUOTES);?>
                              			</a>
										</td>
										<td>
										<?php echo date("d-m-Y",strtotime($row['stmCreatedOn'])); ?>
										</td>
										
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
			<?php if (($result->num_rows) > 0) { ?>
				<div class="row noPrint">
					<div class="col-xs-6">
						<div class="dataTables_info text-right" id="sample-table-2_info">
							<?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?>
							<?php echo $objLink->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
						</div>
					</div>
					<?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
						<div class="col-xs-6">
							<div class="dataTables_paginate paging_bootstrap">
								<ul class="pagination">
									<?php echo $objLink->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
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