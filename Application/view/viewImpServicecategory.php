<?php
    /* ================================================
    File Name         	  : viewGallerycategory.php
    Description		  : This is used for view Gallery Category details.
    Author Name           : Chinmayee
    Date Created          : 25-May-2016
    Devloped On           : Chinmayee
    Devloped By           : 26-May-2016
    Update History	  : <Updated by>		<Updated On>		<Remarks>

    Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js, loadcomponent.js
    includes		  : header.php, navigation.php, util.php, footer.php,viewGallerycategoryInner.php
    ==================================================*/
    require 'viewImpServicecategoryInner.php';
?>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>

<script language="javascript">
	$(document).ready(function () {
		pageHeader = "View  Category";
                strFirstLink = "Manage Application";
                strLastLink = " Category";
                deleteMe     = "<?php echo $deletePriv; ?>";
		printMe		= "yes";
		    $('[data-rel=tooltip]').tooltip();  
		
		inactiveMe     = "<?php echo $noActive; ?>";
                activeMe       = "<?php echo $noActive; ?>";
               
                if('<?php echo $outMsg;?>'!='')                
                   alert('<?php echo $outMsg;?>');
                   
                   $('.showModal').click(function(){
			$('#myModal1').modal();			
		});
                    
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
                <a href="<?php echo APP_URL; ?>viewImpServices/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm " data-rel="tooltip" title="" data-original-title="Gallery" >Important Service</a>
                <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Category">Category</a>
            </div>
            <div class="clearfix"></div>
            <div class="top_tab_container">
                <?php if ($noAdd != '1') { ?>
                    <a href="<?php echo APP_URL ?>addImportantServicescategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php } ?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a> </div>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <div class="searchTable">
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right" for="selType"> Category Name </label>
                    <div class="col-sm-2"> 
                        <span class="colon">:</span>
                        <input type="text" name="catName" id="catName"/>
                    </div>
                    <div class="col-sm-1">
                        <input class="btn btn-success" name="btnSearch" type="submit" value="Show"/>
                    </div>
                </div>
            </div>
            <div class="legandBox">			
                <span class="greenLegend">&nbsp;</span>Active Category&nbsp;			
                <span class="yellowLegend">&nbsp;</span> Inactive Category &nbsp;
            </div>
            <div id="viewTable">
                <?php if ($intTotalRec > 0) {
                         $ctr = 0;?>

                <table class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="20" class="noPrint">
                                <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                            </th>
                            <th width="20">Sl.#</th>
                            <th>Category in English</th>   
                            <th>Category in Odia</th>  
                            <th>Created On </th>
                            <th width="30" class="noPrint" style="<?php echo $editPriv; ?>">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php 
                          while ($row = mysqli_fetch_array($totalResult)) {
                              //print_r($row);
                            if($row['INT_PUBLISH_STATUS']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                         
                                ?>

                        <tr <?php echo $style;?> >
                            <td class="noPrint">
                                <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['intCatId'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['intCatId'];?>" name="hdnPubStatus<?php echo $row['intCatId'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                </label>
                            </td>
                            <td><?php echo $ctr;?></td>
                            <td> <?php  echo htmlspecialchars_decode($row['vchService'],ENT_NOQUOTES);?>   </td>
                            <td class="akrutiorisarala"> <?php  echo htmlspecialchars_decode($row['VCH_CATEGORY_NAME_O'],ENT_NOQUOTES);?>   </td>
                                          
                            <td>  <?php echo date("d-m-Y",strtotime($row['DTM_CREATED_ON'])); ?></td>
                            <td align="center" valign="middle" class="noPrint"><a href="<?php echo APP_URL ?>addImportantServicescategory/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['intCatId'] ?>" data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a></td>
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

            <!-- PAGE CONTENT ENDS -->
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