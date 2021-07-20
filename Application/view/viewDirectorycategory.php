<?php
	/* ================================================
	File Name         	  : viewWebdirectory.php
	Description		  : This is used for view webdirectory Details .
	Author Name               :  T Ketaki Debadarshini
	Date Created		  :25-May-2016
        Devloped On               : 04-Sept-2015
        Devloped By               :  T Ketaki Debadarshini
	Update History		  : <Updated by>		<Updated On>		<Remarks>
						
	Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
	Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
	includes			  : header.php, navigation.php, util.php, footer.php,viewLinkInner.php

	==================================================*/
     require 'viewDirectorycategoryInner.php';
?>

<script language="javascript">
	$(document).ready(function () {
		
		pageHeader   = "View Web Directory";
                strFirstLink = "Manage Application";
                strLastLink  = "Web Directory"; 
             
		deleteMe	= "<?php echo $deletePriv; ?>";          
		printMe		= "yes";                     
		publishMe       = "<?php echo $noPublish; ?>";
                unpublishMe     = "<?php echo $noPublish; ?>";
                
                if('<?php echo $outMsg;?>'!='') {             
                   viewAlert('<?php echo $outMsg;?>');
                   document.location.href = "<?php echo $redirectPage; ?>";
        }       
        $('[data-rel=tooltip]').tooltip();                   
	              	
	});
        
        
  function validate()
{
     if(!blankCheck('txtHistory',' History Should not be left balnk'))
            return false; 
            if(!checkSpecialChar('txtHistory'))
               return false; 
            if(!maxLength('txtHistory',100,'History'))
               return false;  
}
  
                        
function Updatecategory(intCatid,vchHistory,intSlNo,publish)
{
    $("#txtslno").val(intSlNo);
   $("#txtHistory").val(vchHistory);
   $("#hdnCatid").val(intCatid);
   $("#hdnpublish").val(publish);
// alert(intCatid);
 
}
</script>
   <div class="page-content">
      <div class="page-header">
        <h1 id="title" class="col-sm-5"></h1>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
                          <div class="srvc_hdr_nav " style="right:170px;">
              <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Category" >Category</a>
              <a href="<?php echo APP_URL; ?>viewWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm" data-rel="tooltip" title="" data-original-title="Web Directory" >Web Directory</a>
             
           </div>
          <div class="clearfix"></div>
          <div class="top_tab_container">
              <?php if ($noAdd != '1') { ?>
              <a href="<?php echo APP_URL?>addDirectorycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
              <?php }?>
               <a href="javascript:void(0);" class="btn btn-info active">View</a> </div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">

                     
                        <label class="col-sm-2 control-label no-padding-right" for="selCategory">Category Name</label>
                        <div class="col-sm-2"> 
                            <span class="colon">:</span>
                            <input type="text" name="txthead" class="form-control" value="<?php echo $txthead; ?>">
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
                    <table class="table  table-bordered table-hover table-tesponsive">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                                <th width="20">Sl.#</th>
                                <th>Category Name</th>   
                                <th width="30" class="noPrint" >Edit</th>
                            </tr>
                        </thead>
                        <tbody>
 <?php                             
                        while ($row = $result->fetch_array()) {
                            if($row['intPublishStatus']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                                
                                ?>  
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['intcatId'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['intcatId'];?>" name="hdnPubStatus<?php echo $row['intcatId'];?>" value="<?php echo $row['intPublishStatus'];?>"/>
                                   </label>
                                </td>
                                <td> <?php  echo $ctr;?></td>
                                <td><?php echo htmlspecialchars_decode($row['vchcatName'],ENT_NOQUOTES);?></td>
                                <td align="center" valign="middle" class="noPrint" style="">
                                    <a title="Edit" href="javascript:void(0);" title="view" data-toggle="modal" data-target="#myModal-assign" class="btn btn-xs btn-success" onClick="Updatecategory('<?php echo $row['intcatId'] ; ?>','<?php echo $row['vchcatName'] ; ?>','<?php echo $row['intSlNo'] ; ?>','<?php echo $row['intPublishStatus'] ; ?>');"><i class="fa fa-pencil" data-rel="tooltip" data-placement="top" data-original-title="Edit"></i></a></td>
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
</div>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
         
 <div class="modal fade" id="myModal-assign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Category </h4> 
      </div>
      <div class="modal-body">

      <div class="col-sm-12">
     <div class="table-responsive">
       
       <table class="table table-bordered" id="view-history"  >
       <tr>
       <td width="120">Sl No</td>
       <td width="5">:</td>
        <td> <input  type="text" id="txtslno" name="txtslno" class="form-control"/></td>
       </tr>
        <tr>
       <td width="120">Category Name</td>
       <td width="5">:</td>
        <td> <input  type="text" id="txtHistory" name="txtCategory" class="form-control"/></td>
       </tr>
         <input type="hidden" name="hdnCatid"  id="hdnCatid"  value=""  >
           <input type="hidden" name="hdnpublish"  id="hdnpublish"  value=""  >
       </table>
       </div>
       
        <div class="button-box">
            <button type="submit" class="btn btn-success" id="modalSubmit" name="modalSubmit" onclick="return validate();" >Update</button>
          <button class="btn btn-danger">Cancel</button>
        </div>
      </div>

      <div class="clearfix"></div>
      </div>
     
      
    </div>
  </div>
</div>