<?php
	/* ================================================
	File Name         	  : viewactandrules.php
	Description		  : This is used for view Act and Rules .
	Author Name               :  T Ketaki Debadarshini
	Date Created		  :25-May-2016
        Devloped On               : 04-Sept-2015
        Devloped By               :  T Ketaki Debadarshini
	Update History		  : <Updated by>		<Updated On>		<Remarks>
						
	Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
	Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
	includes			  : header.php, navigation.php, util.php, footer.php,viewLinkInner.php

	==================================================*/
     require 'archieveactandrulesInner.php';
?>

<script language="javascript">
	$(document).ready(function () {
		
		pageHeader   = "Archive Whats New";
                strFirstLink = "Manage Application";
                strLastLink  = "Whats New"; 
          
		 deleteMe    = "<?php echo $deletePriv; ?>";
                 enableMe    = "<?php echo $noActive; ?>";
                 printMe     = "yes"; 
                
                if('<?php echo $outMsg;?>'!='')              
                   viewAlert('<?php echo $outMsg;?>');

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
              <a href="<?php echo APP_URL?>addactandrules/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
              <?php }?>
               <a href="<?php echo APP_URL;?>viewactandrules/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info ">View</a> <a href="javascript:void(0);" class="btn btn-info active">Archieve</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">

                        <label class="col-sm-2 col-lg-1 control-label no-padding-right" for="selCategory">Headline</label>
                        <div class="col-sm-3"> 
                            <span class="colon">:</span>
                            <input type="text" name="txthead" class="form-control" value="<?php echo $txthead;?>">
                        </div>
                        <div class="col-sm-1">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
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
                                <th width="20">Sl.#</th>
                                <th>Headlines</th>   
                                <th>URL</th>
                                <th width="100">Document</th>
                                <th>Created On </th>
                               
                            </tr>
                        </thead>
                        <tbody>
    <?php                             
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['INT_PUBLISH_STATUS']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                                ?>
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                  <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_RULE_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_RULE_ID'];?>" name="hdnPubStatus<?php echo $row['INT_RULE_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                   </label>
                                </td>
                                <td> <?php  echo $ctr;?></td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_HEADLINE'],ENT_NOQUOTES);?> </td>
                                <td> <?php   $name =$obj->getName('vchTitle', 't_pages', 'intPageId', $row['INT_PLUGIN_TYPE'], 'bitDeletedFlag'); 
                                echo  htmlspecialchars_decode($name,ENT_NOQUOTES);?></td>  
                                <td> <a href="<?php echo APP_URL; ?>uploadDocuments/Notification/<?php echo $row['VCH_DOCUMENT']; ?>" target="_blank"  data-rel="tooltip" title="" data-original-title="Open Pdf" >
                                        <img src="<?php echo URL ?>img/pdf.png" alt="Image One"  /></a></td>
                                <td><?php  echo date("d-M-Y", strtotime($row['DTM_CREATED_ON'])); ?></td>
         
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
            <?php  } ?>
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
          <!-- PAGE CONTENT ENDS -->
        </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
         
 