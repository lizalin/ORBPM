<?php
    /* ================================================
    File Name         	  : viewGallery.php
    Description		  : This is used for view Gallery details.
    Author Name           : Chinmayee
    Date Created          : 24-May-2016
    Devloped On           : 27-MAy-2016
    Devloped By           : Chinmayee
    Update History	  : <Updated by>		<Updated On>		<Remarks>
     
    Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
    includes		  : header.php, navigation.php, util.php, footer.php,viewGalleryInner.php

    ==================================================*/
    require 'viewGalleryInner.php';
?>
<script language="javascript">
	$(document).ready(function () {
		pageHeader = "View Gallery";
        strFirstLink = "Manage Application";
        strLastLink = "Manage Gallery";
				
        $('[data-rel=tooltip]').tooltip();  
               
        archiveMe	= "<?php echo $deletePriv; ?>";
		printMe		= "yes";       
		publishMe       = "<?php echo $noPublish; ?>"
        unpublishMe     = "<?php echo $noPublish; ?>"
             	
        if('<?php echo $outMsg;?>'!='')                
            viewAlert('<?php echo $outMsg;?>');
            
            $('.showModal').click(function(){
			$('#myModal1').modal();			
		    });
                
             //fillCategory('<?php echo $intplugintype; ?>','ddlPlugin','<?php echo $intCattype; ?>');
            // fillpluginCategorys('<?php echo $intCattype; ?>','selCategory','<?php echo $intplugintype; ?>','<?php echo $intCategory; ?>');
            
	});
        
            
         function fillpluginCategory(catfldid , pluginid){
           
                    var typeid=$("#selType").val();
                   fillpluginCategorys(typeid,catfldid,pluginid,0);
            }
</script>
    <div class="page-content">
        <div class="page-header">
            <h1 id="title" class="col-sm-5"></h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
           <div class="srvc_hdr_nav" style="right:170px;">
                    <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Gallery" >Gallery</a>
                      <a href="<?php echo APP_URL; ?>viewGallerycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm " data-rel="tooltip" title="" data-original-title="Category">Category</a>
                </div>
				<div class="clearfix"></div>
            <div class="top_tab_container">
                <?php if ($noAdd != '1'){ ?>
                    <a href="<?php echo APP_URL?>addGallery/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php }?>
                <a href="javascript:void(0);"  class="btn btn-info active">View</a> <a href="<?php echo APP_URL;?>archieveGallery/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Archive</a></div>

                <?php include('includes/util.php'); ?>
                <div class="hr hr-solid"></div>
                <div class="searchTable">
                    <div class="form-group">
                    <label class="col-sm-2   col-lg-1  control-label no-padding-right" for="selCategory">Category</label>
                        <div class="col-sm-3  col-lg-2"> 
                            <span class="colon">:</span>
                            <select class="form-control" name="selCategory" id="selCategory">
                            <option value="">- Select -</option>
                            <?php while ($row = mysqli_fetch_array($galleryCatList)) { ?>
                            <option value="<?php echo $row['INT_CATEGORY_ID']?>" ><?php  echo htmlspecialchars_decode($row['VCH_CATEGORY_NAME'],ENT_NOQUOTES);?></option>
                            <?php }?>  
                            </select>
                        </div>
                        
                        <div class="col-sm-2">
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
                    <table class="table  table-bordered table-hover galleryViewTable">
                        <thead>
                            <tr>
                                <th width="20" class="noPrint">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                                </th>
                                <th width="20">Sl.#</th>
                                <th>Category</th>
                                <th>Caption</th>
                                <th width="180">Main Image</th>
                                <th width="100">Created On</th>
                               
                                <th width="130" class="noPrint" style="<?php echo $editPriv; ?>">Take Action</th>
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
                                            <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_GALLERY_ID'];?>"><span class="lbl"></span>
                                            <input type="hidden" id="hdnPubStatus<?php echo $row['INT_GALLERY_ID'];?>" name="hdnPubStatus<?php echo $row['INT_GALLERY_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                    </label>
                                    </td>
                                    <td><?php  echo $ctr;?></td>
                                    <td><?php   echo $objGallery->getName('VCH_CATEGORY_NAME', 't_gallery_category', 'INT_CATEGORY_ID', $row['INT_CATEGORY_ID'], 'BIT_DELETED_FLAG'); ?></td>
                                    <td> <?php echo htmlspecialchars_decode($row['VCH_HEADLINE_E'],ENT_NOQUOTES);?></td>
                                      
                                    <td align="center" width="200">
                                        <?php if($row['VCH_LARGE_IMAGE']!=''){ ?>
                                        
                                        <figure class="effect-milo">
                                        <a href="<?php echo APP_URL ?>uploadDocuments/gallery/<?php echo $row['VCH_LARGE_IMAGE']; ?>"  class="html5lightbox" data-group="set1"  title="Image">
                                            <img src="<?php echo APP_URL ?>uploadDocuments/gallery/<?php echo $row['VCH_LARGE_IMAGE']; ?>" alt="img03" width="150" height="80">
                                            </a>			
                                        </figure>                                    
                                    
                                        <?php }else echo '&nbsp;';?>
                        
                                    </td>
                                    <td> <?php echo date("d-M-Y", strtotime($row['DTM_CREATED_ON'])); ?></td>
                                    <td align="center" valign="middle" class="noPrint" style="<?php echo $editPriv; ?>">
                                    <a href="<?php echo APP_URL; ?>addGallery/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_GALLERY_ID'] ?>"  data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a>
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
                </div>
               <?php } else { ?>
                    <div class="noRecord">No record found</div>
            <?php  } ?>
                <!-- PAGE CONTENT ENDS -->
                
                
                
                
                
           <?php if ($result->num_rows > 0) { ?>
                <div class="row noPrint">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a> <?php } ?> 
                                <?php echo $objGallery->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
                        </div>
                    </div>
                    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-xs-6">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                                <?php echo $objGallery->getPaging($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>                    
                                </ul>
                            </div>
                        </div>
                <?php } ?>
                </div>
<?php } ?>
                
                
                
              </div>  
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