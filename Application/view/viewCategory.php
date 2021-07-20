<?php
/* ================================================
  File Name         	  : viewCategory.php
  Description		  : This is used for view the Page details.
  Author Name		  : Bishnu Charan Sahoo
  Date Created		  : 17-Aug-2015
  Update History		  : <Updated by>		<Updated On>		<Remarks>

  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js,loadAjax.js
  includes              : header.php, navigation.php, util.php, footer.php,viewCategoryInner.php

  ================================================== */
require("viewCategoryInner.php");
?>
<script src="<?php echo APP_URL; ?>js/loadAjax.js"></script>
<script src="<?php echo APP_URL; ?>js/modal.js"></script>
<script language="javascript">
    $(document).ready(function () {
        loadNavigation('View Category');
         $('[data-rel=tooltip]').tooltip(); 
	 <?php  if($adminConsole_Privilege==0|| $adminConsole_Privilege==1 ||$intPermission==3) { ?>
		 deleteMe     = "yes";
                 <?php }?>
		printMe		= "yes";
                 <?php  if($adminConsole_Privilege==0|| $adminConsole_Privilege==1 ||$intPermission!=1) { ?>		                
		 inactiveMe     = "yes";
                 activeMe       = "yes";
                showHome        = "no"
                hideHome        = "no"
                <?php }?>
                    
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
            <?php  if($adminConsole_Privilege==0|| $adminConsole_Privilege==1 ||$intPermission!=2) { ?>
                    <a href="<?php echo APP_URL ?>addCategory" class="btn btn-info">Add</a> 
              <?php }?>
              <a href="javascript:void(0);" class="btn btn-info active">View</a>
            </div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
			
          <div class="legandBox">			
                <span class="greenLegend">&nbsp;</span>Published Category&nbsp;			
                <span class="yellowLegend">&nbsp;</span> Unpublished Category &nbsp;
            </div>
             <div id="viewTable">
                <?php if (($result->num_rows) > 0) {
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
                                 <th>Image</th> 
                                <th>Description</th> 
                                <th>Created On </th>
                                <th width="30" class="noPrint">Edit</th>
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
<!--                                 <td> <?php  //echo htmlspecialchars_decode($row['VCH_CATEGORY_CLASS'],ENT_NOQUOTES);?> </td>-->
                                <td align="center" width="200">
                                    <?php if($row['VCH_IMG']!=''){ ?>
                                    <a href="<?php echo APP_URL ?>uploadDocuments/category/<?php echo $row['VCH_IMG'];?>" target="_blank" title="Category Photo"><img src="<?php echo APP_URL ?>uploadDocuments/category/<?php echo $row['VCH_IMG'];?>" alt="<?php echo $row['VCH_CATEGORY_NAME']; ?>" width="150" height="80" /></a>
                                    <?php }else echo '&nbsp;';?>
                                </td>
                                <td> <?php  echo htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_NOQUOTES);?> </td>  
                            
                                <td><?php echo date("d-M-Y",strtotime($row['DTM_CREATED_ON']))?></td>
                                <td align="center" valign="middle" class="noPrint"><a href="<?php echo APP_URL?>addCategory/<?php echo $row['INT_CATEGORY_ID'] ?>" data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
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
            <?php if (($result->num_rows) > 0) { ?>
                <div class="row noPrint">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?> 
    <?php echo $objCat->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>
                        </div>
                    </div>
    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
        <?php echo $objCat->getPaging($intTotalRec, $intCurrPage, $intPgSize, isPaging); ?>                    
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
