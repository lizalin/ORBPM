<?php
	/* ================================================
	File Name         	  	: viewCompliment.php
	Description		  		: This is used for view Compliment .
    Devloped On         	: 23-Dec-2020
    Devloped By         	:  Ajmal Akhtar
	Update History		  	: <Updated by>		<Updated On>		<Remarks>
						
	Style sheet           	: bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
	Javscript Functions   	: jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
	includes			  	: util.php,viewComplimentInner.php

	==================================================*/

     require 'viewComplimentInner.php';
?>

<script language="javascript">
	$(document).ready(function () {
		
		        pageHeader   = "View Feedback";
                strFirstLink = "Manage Contact";
                strLastLink  = "Feedback"; 
			    printMe	     = "yes";  
                deleteMe     = "yes";  
               
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
             <a href="javascript:void(0);" class="btn btn-info active">View</a> 
         </div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">
                        <label class="col-sm-2 col-lg-1 control-label no-padding-right" for="selCategory">Name</label>
                        <div class="col-sm-3"> 
                            <span class="colon">:</span>
                            <input type="text" name="txtName" class="form-control" value="<?php echo $txtName;?>">
                        </div>
                        <div class="col-sm-1">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                        </div>
                    </div>
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
                                <th>Date</th> 
                                <th>Name</th>
                                <th>Compliment</th>
                            </tr>
                        </thead>
                        <tbody>
    					<?php                             
                        while ($row = mysqli_fetch_array($result)) {
                                $ctr++; 
                                ?>
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                  <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['intId'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['intId'];?>" name="hdnPubStatus<?php echo $row['intId'];?>" value="<?php echo $row['tinPublishStatus'];?>"/>
                                   </label>
                                </td>
                                <td> <?php  echo $ctr;?></td>
                                <td><?php  echo date("d-M-Y", strtotime($row['dtmCreatedOn'])); ?> </td>
                                <td><?php echo htmlspecialchars_decode($row['vchName'],ENT_NOQUOTES);?> </td>
                                <td><a title="View Compliment" href="javascript:void(0);" onclick="fillCompliment(<?php echo $row['intId'];?>)"><?php echo htmlspecialchars_decode($row['vchCompliment'],ENT_NOQUOTES);?></a></td>  
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
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onclick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?> 
    <?php echo $obj->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
                        </div>
                    </div>
    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
        <?php echo $obj->getPaging($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>                    
                                </ul>
                            </div>
                        </div>
                <?php } ?>
                </div>
<?php } ?>
<div id="infoAreamodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md text-center">
        <div class="modal-content info-modal-content">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#infomodal">&times;</button>
                <div class="modaldata" id="filldata" >
                   
                </div>
        </div>
    </div>
</div>
</div>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
         
 