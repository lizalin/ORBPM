<?php
    /* ================================================
    File Name         	  : viewSchemecategory.php
    Description		  : This is used for view Scheme Category details.
    Author Name           : T Ketaki Debadarshini
    Date Created          : 
    Devloped On           : 17-Aug-2015
    Devloped By           : T Ketaki Debadarshini
    Update History	  : <Updated by>		<Updated On>		<Remarks>

    Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
    includes		  : header.php, navigation.php, util.php, footer.php,viewSchemecategoryInner.php

    ==================================================*/
    require 'viewSchemecategoryInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script src="<?php echo APP_URL; ?>js/loadAjax.js"></script>

<script language="javascript">
	$(document).ready(function () {
		//loadNavigation('View Scheme Category');
                pageHeader = "View Scheme Category";
                strFirstLink = "Manage Application";
                strLastLink = "Scheme Category";
                <?php  //if($adminConsole_Privilege==0|| $adminConsole_Privilege==1 ||$intPermission==3) { ?>
		 deleteMe     = "<?php echo $deletePriv; ?>";
                 <?php //}?>
		printMe		= "yes";
                 <?php  //if($adminConsole_Privilege==0|| $adminConsole_Privilege==1 ||$intPermission!=1) { ?>		                
		 inactiveMe     = "<?php echo $noActive; ?>";
                 activeMe       = "<?php echo $noActive; ?>";
                showHome        = "no"
                hideHome        = "no"
                <?php //}?>
		
		
                if('<?php echo $outMsg;?>'!='')                
                   alert('<?php echo $outMsg;?>');
                    
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
                    <a href="<?php echo APP_URL?>addSchemecategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a> </div>
                <?php include('includes/util.php'); ?>
                <div class="hr hr-solid"></div>
                
                <div class="legandBox">			
                    <span class="greenLegend">&nbsp;</span>Active Scheme Category&nbsp;			
                    <span class="yellowLegend">&nbsp;</span> Inactive Scheme Category &nbsp;
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
                                <th>Category </th>                            
                                <th>Description</th> 
<!--                                <th class="noPrint">Show on Home Page</th>-->
                                <th>Created On </th>
                                <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                            </tr>
                        </thead>
              		<tbody>
                        <?php while ($row = mysqli_fetch_array($result)) {
                            if($row['INT_PUBLISH_STATUS']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                                ?>
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_CATEGORY_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_CATEGORY_ID'];?>" name="hdnPubStatus<?php echo $row['INT_CATEGORY_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                    </label>
                                </td>
                                <td><?php echo $ctr; ?></td>
                                <td> <?php  echo htmlspecialchars_decode($row['VCH_CATEGORY_NAME'],ENT_NOQUOTES);?> </td>                            
                                <td> <?php  echo htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_NOQUOTES);?> </td>  
<!--                                <td align="center" width="70" class="noPrint">
                                    <?php 
                                    //if($row['INT_SHOW_HOME']==1){?>
                                    <i class="icon-ok" title="Show on Home page"></i>		
                                    <?php /*} else
                                    echo '&nbsp;';*/
                                    ?>
                                </td>-->
                                <td><?php echo date("d-M-Y",strtotime($row['DTM_CREATED_ON']))?></td>
                                <td align="center" valign="middle" class="noPrint" style="<?php echo $editPriv; ?>"><a href="<?php echo APP_URL?>addSchemecategory/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_CATEGORY_ID'] ?>" data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
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
    <?php echo $objSchemeCat->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
                        </div>
                    </div>
    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
        <?php echo $objSchemeCat->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>                    
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
         

