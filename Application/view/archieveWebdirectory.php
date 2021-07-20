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
     require 'archieveWebdirectoryInner.php';
?>

<script language="javascript">
	$(document).ready(function () {
		
		pageHeader   = "View Web Directory";
                strFirstLink = "Manage Application";
                strLastLink  = "Web Directory"; 
             
	          
		 deleteMe    = "<?php echo $deletePriv; ?>";
                 enableMe    = "<?php echo $noActive; ?>";
                 printMe     = "yes"; 
                
                
                if('<?php echo $outMsg;?>'!='')              
                    viewAlert('<?php echo $outMsg;?>');

            $('[data-rel=tooltip]').tooltip();                   
	   fillDirplugin('selCategory','<?php echo $selplugintype;?>');                	
	});
</script>
   <div class="page-content">
      <div class="page-header">
        <h1 id="title" class="col-sm-5"></h1>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
            <div class="srvc_hdr_nav " style="right:170px;">
              <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Web Directory" >Web Directory</a>
              <a href="<?php echo APP_URL; ?>viewDirectorycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm" data-rel="tooltip" title="" data-original-title="Category" >Category</a>
             
           </div>
          <div class="clearfix"></div>
          
          
          <div class="top_tab_container">
              <?php if ($noAdd != '1') { ?>
              <a href="<?php echo APP_URL?>addWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
              <?php }?>
               <a href="<?php echo APP_URL;?>viewWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?> " class="btn btn-info ">View</a> <a href="javascript:void(0);" class="btn btn-info active">Archive</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">

                      
                        <label class="col-sm-1 control-label no-padding-right" for="selCategory">Section</label>
                        <div class="col-sm-2"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="selCategory" id="selCategory">
                    
                              
                            </select>
                        </div>
                        <label class="col-sm-1 control-label no-padding-right" for="selCategory">Name</label>
                        <div class="col-sm-2"> 
                            <span class="colon">:</span>
                            <input type="text" name="txthead" class="form-control" value="<?php echo $txthead; ?>">
                        </div>
                          <label class=" col-lg-1 col-sm-2 control-label no-padding-right" for="selCategory">Designation</label>
                        <div class="col-sm-2"> 
                            <span class="colon">:</span>
                            <input type="text" name="txtdesg" class="form-control" value="<?php echo $txtdesg; ?>">
                        </div>
                        <div class="col-sm-1">
                            <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                        </div>
                    </div>
                </div>
              
            <div id="viewTable">
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
                                <th>Name</th>   
                                <th>Section</th>
                                 <th>Designation</th>   
                               <th >Telephone Number</th>
                                <th >Mobile Number</th>
                                 <th>Email Id</th>
                                 <th >Fax</th>
                             
                            </tr>
                        </thead>
                        <tbody>
 <?php                             
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['INT_PUB_STATUS']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                                $sql1     = $obj->manageDirectory('VM',$row['INT_DIR_ID'],0,'','','','','','','','','','',0,0,0,0,0);
                                $sql2     = $obj->manageDirectory('VT',$row['INT_DIR_ID'],0,'','','','','','','','','','',0,0,0,0,0);
                                ?>  
                            <tr <?php echo $style;?>>
                                <td class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_DIR_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_DIR_ID'];?>" name="hdnPubStatus<?php echo $row['INT_DIR_ID'];?>" value="<?php echo $row['INT_PUB_STATUS'];?>"/>
                                   </label>
                                </td>
                                <td> <?php  echo $ctr;?></td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_NAME'],ENT_NOQUOTES);?></td>
                                <td><?php   $name =$obj->getName('vchTitle', 't_pages', 'intPageId', $row['INT_PLUGIN_ID'], 'bitDeletedFlag'); 
                                echo  htmlspecialchars_decode($name,ENT_NOQUOTES);?></td>  
                               
                                <td><?php echo htmlspecialchars_decode($row['VCH_DESIGNATION'],ENT_NOQUOTES);?></td>
                                <td><?php   
                                      
                                       while($m1= $sql2->fetch_array())
                                         {     
                                         echo $m1['VCH_TEL_NO'].'<br/>';}
                                        ?></td>
                                <td><?php   
                                      
                                       while($m1= $sql1->fetch_array())
                                         {     
                                         echo $m1['VCH_MOBILE_NO'].'<br/>';}
                                        ?></td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_EMAIL'],ENT_NOQUOTES);?></td>
                                 <td><?php echo htmlspecialchars_decode($row['INT_FAX'],ENT_NOQUOTES);?></td>
                                
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
         
 