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
     require 'viewWebdirectoryInner.php';
?>

<script language="javascript">
	$(document).ready(function () {
		
		pageHeader   = "View Web Directory";
                strFirstLink = "Manage Application";
                strLastLink  = "Web Directory"; 
             
		archiveMe	= "<?php echo $deletePriv; ?>";          
		printMe		= "yes";                     
		publishMe       = "<?php echo $noPublish; ?>";
                unpublishMe     = "<?php echo $noPublish; ?>";
                
                fillWebCategory('selCat','<?php echo $selCat;?>');
                if('<?php echo $outMsg;?>'!='')              
                   viewAlert('<?php echo $outMsg;?>');

            $('[data-rel=tooltip]').tooltip();                   
	   fillDirplugin('selCategory','<?php echo $selplugintype;?>');                	
	});
        
           function validSl(totalVal)
	   {
               
		var flag	= 0;
                 
		$('.updtslno').each(function(){
         
			if(this.value==0)
			{
				viewAlert('Serial number must be greater than zero');
				this.focus();
				flag	= 1;
				return false;
			}
			if(Number(this.value) > Number(totalVal))
			{
				viewAlert('Serial number can not greater than total records');
				this.focus();
				flag	= 1;
				return false;
			}
		});
                if(flag==0)
        
			gotoDelete('US');
	           
                    	
	}
        
        
</script>
   <div class="page-content">
      <div class="page-header">
        <h1 id="title" class="col-sm-5"></h1>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
                          <!--div class="srvc_hdr_nav " style="right:170px;">
              <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Web Directory" >Web Directory</a>
              <a href="<?php echo APP_URL; ?>viewDirectorycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm" data-rel="tooltip" title="" data-original-title="Category" >Category</a>
             
           </div-->
          <div class="clearfix"></div>
          <div class="top_tab_container">
              <?php if ($noAdd != '1') { ?>
              <a href="<?php echo APP_URL?>addWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
              <?php }?>
               <a href="javascript:void(0);" class="btn btn-info active">View</a> <a href="<?php echo APP_URL;?>archieveWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a></div>
          <?php include('includes/util.php'); ?>
          <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">

                      
                          <label class="col-sm-1 control-label no-padding-right" for="selCat">Category</label>
                        <div class="col-sm-2"> 
                            <span class="colon">:</span>
                            <select name="selCat" id="selCat" class="form-control">
                                <option value="0" >-select- </option>
                               
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
                                <th width="40">View Order</th>
                                <th>Name</th>   
                                <!--th>Section</th-->
                                <th>Designation</th>   
                                <th >Telephone Number</th>
                                <th >Mobile Number</th>
                                <th >E-mail</th>
                                <th >Fax</th>
                                <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
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
                                <td><?php echo $ctr;?></td>
                                <td>
                                <input type="text"  onkeypress="return isNumberKey(event);" name="txtSLNo<?php echo $row['INT_DIR_ID'];?>" id="txtSLNo<?php echo $row['INT_DIR_ID'];?>" value="<?php echo $row['intSlNo'];?>" style="width:100%" maxlength="2" class="noPrint updtslno"/>
                                <input name="hdncatid<?php echo $row['INT_DIR_ID'];?>" id="hdncatid<?php echo $row['INT_DIR_ID'];?>" type="hidden"  value="<?php echo $row['INT_PLUGIN_ID'];?>"/>
                                </td>
                                <td><?php echo htmlspecialchars_decode($row['VCH_NAME'],ENT_NOQUOTES);?></td>
                                <!--td><?php   $name =$obj->getName('vchcatName', 'm_dir_category', 'intcatId', $row['INT_PLUGIN_ID'], 'bitDeletedFlag'); 
                                echo  htmlspecialchars_decode($name,ENT_NOQUOTES);?></td-->  
                               
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
                                 <td><?php  echo $row['VCH_EMAIL']; ?></td>
                                 <td><?php echo htmlspecialchars_decode($row['INT_FAX'],ENT_NOQUOTES);?></td>
                                <td align="center" valign="middle" class="noPrint" style=""><a href="<?php echo APP_URL; ?>addWebdirectory/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_DIR_ID'];?>"  data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
                            </tr>
                               <?php } ?>
                        </tbody>
                    </table>
                 <input type="button" name="btnUpdateSl" id="btnUpdateSl" class="btn btn-success noPrint" value="Update View Order" onClick="return validSl('<?php echo $intTotalRec;?>');"/>
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
         
 