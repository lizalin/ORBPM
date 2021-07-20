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
    require 'viewGallerycategoryInner.php';
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
		
		uinactiveMe     = "<?php echo $noActive; ?>";
        activeMe       = "<?php echo $noActive; ?>";
               
        if('<?php echo $outMsg;?>'!='')                
        viewAlert('<?php echo $outMsg;?>');
                   
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
                <a href="<?php echo APP_URL; ?>viewGallery/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-success btn-sm " data-rel="tooltip" title="" data-original-title="Gallery" >Gallery</a>
                <a href="javascript:void(0);" class="btn btn-success btn-sm active" data-rel="tooltip" title="" data-original-title="Category">Category</a>
            </div>
            <div class="clearfix"></div>
            <div class="top_tab_container">
                <?php if ($noAdd != '1') { ?>
                    <a href="<?php echo APP_URL ?>addGallerycategory/<?php echo $glId; ?>/<?php echo $plId; ?>" class="btn btn-info">Add</a>
                <?php } ?>
                <a href="javascript:void(0);" class="btn btn-info active">View</a> </div>

            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            
            <div class="legandBox">			
                <span class="greenLegend">&nbsp;</span>Active Category&nbsp;			
                <span class="yellowLegend">&nbsp;</span> Inactive Category &nbsp;
            </div>
            <div id="viewTable">
                <?php if ($result->num_rows > 0) {
                         $ctr = $intRecno;?>

                <table class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="20" class="noPrint">
                                <label class="position-relative">
                                    <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                            </th>
                            <th width="20">Sl.#</th>
                            <th>Category Name</th>   
                            <!-- <th>Category Description</th> -->                              
                            <th>Created On </th>
                            <th width="120" class="noPrint" style="<?php echo $editPriv; ?>">Take ACtion</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr>
                            <td>
                                <label class="position-relative">
                                <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                            </td>
                            <td>
                                1
                            </td>
                            <td>
                                Cultural Event
                            </td>
                            <td>
                                This event is being organised by Govt. of Odisha. 
                            </td>
                            <td>
                                23-12-2020
                            </td>
                            <td>
                                <a href="javascript:void(0);" data-rel="tooltip" title="Edit" data-original-title="Edit" class="btn btn-xs btn-info"> 
                                    <i class="ace-icon fa fa-pencil bigger-120"></i> 
                                </a>
                                <a href="javascript:void(0);" data-rel="tooltip" title="delete" data-original-title="Delete" class="btn btn-xs btn-danger"> 
                                    <i class="icon-white icon-trash"></i> 
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="position-relative">
                                <input type="checkbox" class="ace chkAll"><span class="lbl"></span></label>
                            </td>
                            <td>
                                2
                            </td>
                            <td>
                                Officer Event
                            </td>
                            <td>
                                This event is being organised by Govt. of Odisha. 
                            </td>
                            <td>
                                28-12-2020
                            </td>
                            <td>
                                <a href="javascript:void(0);" data-rel="tooltip" title="Edit" data-original-title="Edit" class="btn btn-xs btn-info"> 
                                    <i class="ace-icon fa fa-pencil bigger-120"></i> 
                                </a>
                                <a href="javascript:void(0);" data-rel="tooltip" title="delete" data-original-title="Delete" class="btn btn-xs btn-danger"> 
                                    <i class="icon-white icon-trash"></i> 
                                </a>
                            </td>
                        </tr>
                    </tbody> -->
                    <tbody>
                        <?php 
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['INT_PUBLISH_STATUS']==2)
                                $style	= 'class="greenBorder"';
                            else
                                $style	= 'class="yellowBorder"'; 
                                $ctr++; 
                         
                        ?>

                        <tr <?php echo $style;?> >
                            <td class="noPrint">
                                <label class="position-relative">
                                        <input type="checkbox" class="ace chkItem" value="<?php echo $row['INT_CATEGORY_ID'];?>"><span class="lbl"></span>
                                        <input type="hidden" id="hdnPubStatus<?php echo $row['INT_CATEGORY_ID'];?>" name="hdnPubStatus<?php echo $row['INT_CATEGORY_ID'];?>" value="<?php echo $row['INT_PUBLISH_STATUS'];?>"/>
                                </label>
                            </td>
                            <td><?php echo $ctr;?></td>
                            <td> <?php  echo htmlspecialchars_decode($row['VCH_CATEGORY_NAME'],ENT_NOQUOTES);?>   </td>
                            
              
                            <td>  <?php echo date("d-m-Y",strtotime($row['DTM_CREATED_ON'])); ?></td>
                            <td align="center" valign="middle" class="noPrint">
                                <a href="<?php echo APP_URL ?>addGallerycategory/<?php echo $glId; ?>/<?php echo $plId; ?>/<?php echo $row['INT_CATEGORY_ID'] ?>" data-rel="tooltip" title="" data-original-title="Edit" class="btn btn-xs btn-info"> <i class="ace-icon fa fa-pencil bigger-120"></i> </a>
                                <!-- <a href="javascript:void(0);" data-rel="tooltip" title="Delete" data-original-title="Delete" class="btn btn-xs btn-danger"><i class="icon-white icon-trash"></i> </a> -->
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