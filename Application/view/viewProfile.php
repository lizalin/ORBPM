<?php
/* ================================================
	File Name         	  : viewProfile.php
	Description		  : This is used for view the officer profile.
	Author Name		  : Sunil Kumar Parida
	Date Created		  : 23-Dec-2014
        Devloped By               : Rasmi Ranjan Swain
        Devloped On               : 07-Jan-2015
	Update History		  : <Updated by>		<Updated On>		<Remarks>
						
	Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
	Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
	includes			  : header.php, navigation.php, util.php, footer.php,viewProfileInner.php

	==================================================*/
/* 	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); */
require 'viewProfileInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
	$(document).ready(function() {
		pageHeader = "<?php echo $strTab; ?> Officer Profile";
		strFirstLink = "Manage Application";
		strLastLink = "Officer Profile";
		loadNavigation('View Officer Profile');
		<?php if ($adminConsole_Privilege == 0 || $adminConsole_Privilege == 1 || $intPermission == 3) { ?>
			deleteMe = "yes";
		<?php } ?>
		printMe = "yes";
		<?php if ($adminConsole_Privilege == 0 || $adminConsole_Privilege == 1 || $intPermission != 1) { ?>
			publishMe = "yes"
			unpublishMe = "yes"
		<?php } ?>
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
				<?php if ($adminConsole_Privilege == 0 || $adminConsole_Privilege == 1 || $intPermission != 2) { ?>
					<a href="<?php echo APP_URL ?>addProfile/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
				<?php } ?>
				<a href="javascript:void(0);" class="btn btn-info active">View</a>
			</div>
			<?php include('includes/util.php'); ?>
			<div class="hr hr-solid"></div>
			<div class="legandBox">
				<span class="greenLegend">&nbsp;</span>Published Profile&nbsp;
				<span class="yellowLegend">&nbsp;</span> Unpublished Profile &nbsp;
			</div>
			<div id="viewTable">
				<div class="table-responsive">
					<?php if (($result->num_rows) > 0) {
						$ctr = $intRecno; ?>
						<table class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th width="20" class="noPrint">
										<label class="position-relative">
											<input type="checkbox" class="ace chkAll"><span class="lbl"></span>
										</label>
									</th>
									<th width="50">Sl.#</th>
									<th>Authority </th>
									<th>Name of Authority</th>
									<th>Joining Date</th>
									<th>Leaving Date</th>
									<th>Image</th>
									<th width="30" class="noPrint">Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php while ($row = mysqli_fetch_array($result)) {
									if ($row['tinPublishStatus'] == 2)
										$style	= 'class="greenBorder"';
									else
										$style	= 'class="yellowBorder"';
									$ctr++;
								?>
									<tr <?php echo $style; ?>>
										<td class="noPrint">
											<label class="position-relative">
												<input type="checkbox" class="ace chkItem" value="<?php echo $row['intProfileId']; ?>"><span class="lbl"></span>
											</label>
											<input type="hidden" id="hdnPubStatus<?php echo $row['intProfileId']; ?>" name="hdnPubStatus<?php echo $row['intProfileId']; ?>" value="<?php echo $row['tinPublishStatus']; ?>" />
										</td>
										<td><?php echo $ctr; ?></td>
										<td><?php echo $officerType=($row['intOfficerType']==1)?'Former Governor':'Former Secretary'; ?></td>
										<td><?php echo htmlspecialchars_decode($row['vchOfficerName'], ENT_QUOTES); ?></td>
										<td><?php if($row['dtJoiningDate'] !=""){echo date("d-M-Y", strtotime(htmlspecialchars_decode($row['dtJoiningDate'], ENT_NOQUOTES)));}else {echo 'N/A';} ?></td>
										<td><?php if($row['dtRetireDate'] !=""){ echo date("d-M-Y", strtotime(htmlspecialchars_decode($row['dtRetireDate'], ENT_NOQUOTES)));}else {echo 'N/A';} ?></td>
										<td align="center">
											<?php if ($row['vchImage'] != '') { ?>
												<img src="<?php echo APP_URL; ?>uploadDocuments/offProfile/<?php echo $row['vchImage']; ?>" alt="<?php echo $row['vchOfficerName']; ?>" width="50" height="50" />
											<?php } else echo '&nbsp;'; ?>
										</td>
										<td align="center" valign="middle" class="noPrint">

											<a href="<?php echo APP_URL ?>addProfile/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['intProfileId'] ?>" data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a>
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
						<div class="dataTables_info" id="sample-table-2_info">
							<?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?>
							<?php echo $objProfile->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
						</div>
					</div>
					<?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
						<div class="col-xs-6">
							<div class="dataTables_paginate paging_bootstrap">
								<ul class="pagination">
									<?php echo $objProfile->getPaging($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
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