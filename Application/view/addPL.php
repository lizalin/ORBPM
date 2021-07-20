<?php
/* ================================================
  File Name         	  : addPL.php
  Description	          : This is used for add the Primary Link details.
  Designed By		  : 
  Devloped By             : T Ketaki Debadarshini 
  Devloped On             : 29-Aug-2015
  Designed On		  :	
  Update History          :	
  <Updated by>			<Updated On>		<Remarks>
  
  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js,loadAjax.js,jqueryOrdering.js,validatorchklist.js
  includes			  :	header.php, navigation.php, util.php, footer.php,addPLInner.php

  ================================================== */

require 'addPLInner.php';
?>

<script src="<?php echo APP_URL; ?>js/jqueryOrdering.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
    $(document).ready(function () {
	$('[data-rel=tooltip]').tooltip();
                
        //loadNavigation('Primary Link');
        pageHeader   = "Primary Link";
        strFirstLink = "Manage Link";
        strLastLink  = "Primary Link";  
        
        indicate = 'yes';
        getPublishedPage();
        getGlobalMenuList(1, 'globalLink');
       // $('#btnSaveMainMenu').hide();
        
		
        <?php 
         foreach($viewGl as $row2)
          {
       ?>
                fillMenuList(<?php echo $row2['pageId'];?>, 1, 'primaryLink', 'GLMenu<?php echo $row2['pageId'];?>')
                $("#GLMenu<?php echo $row2['pageId'];?>").sortable({revert: true});
        <?php
          }
        ?>
        if ('<?php echo $outMsg != '' ?>')
            alert('<?php echo $outMsg; ?>');
    });
    /* Function to add page to menu list */
    function addToList()
    {
	var glIds		= $('#selGlobalMenu').val();		
        var allPageIds          = $("#hdnFldForPageId").val();
        allPageIds 		= allPageIds.substring(1);
        var idArrs 		= allPageIds.split(',');
        var arrCount            = idArrs.length;
        var flag	 	= 0;
        var errflag 	= 0;
        var totalCount	= 0;
        for (var i = 0; i < arrCount; i++)
        {
            if ($("#chkPageId" + idArrs[i]).is(':checked'))
            {
                flag++;
                $(".mainMenuClass"+glIds).each(function () {
                    totalCount++;
                    var hdnVal = $(this).val();
                    var checkedVal = $("#chkPageId" + idArrs[i]).val();
                    if (hdnVal == checkedVal)
                    {
                        errflag = 1;
                    }
                });
                var menuText = $("#pageNameById" + idArrs[i]).text();
                if (errflag > 0)
                {
                    alert('' + menuText + ' already exists under Primary link.');
                    return false;
                }
                else {
                    var closeBtn = '<span style="float:right;cursor:pointer;"><img src="<?php echo APP_URL; ?>img/close-btn.png" width="16" height="16" alt="Close" title="Remove" onClick="removeFromMainMenu(' + idArrs[i] + ');"></span>';
                    var hdnFld = '<input type="hidden" name="mainMenuArr'+glIds+'[]" id="hdnMainMenuId' + idArrs[i] + '" class="mainMenuClass'+glIds+'" value="' + idArrs[i] + '" />';
                    var menuItem = '<div class="ui-sortable-handle mainMenuItem" id="mainMenuItem' + idArrs[i] + '">' + menuText + hdnFld + closeBtn + '</div>';
                    $("#GLMenu"+glIds).append(menuItem);
		    $('#btnSaveMainMenu').show();
                }
            }
        }
        if (flag == 0)
        {
            alert('Please select record.');
        }
        $(".checkBoxForPage").removeAttr('checked');
    }
    function removeFromMainMenu(id)
    {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#mainMenuItem" + id).remove();
        var noOfmainMenu = $('div.mainMenuItem').length;
        if (noOfmainMenu == 0)
        {
            //$("#mainMenu").html('No menus assigned');
            $('#btnSaveMainMenu').hide();
        }
    }

    function menuValidator(menuType)
    {       
		if($('.glPortlet:checked').size() == 0)
		{
			alert('Select the portlet checkbox to update');
			$('.glPortlet:first').focus();
			return false;
		}		
        
                var flag 		= 0;  
		$(".glPortlet:checked").each(function () {
			var glId	= $(this).val();
			if ($(".mainMenuClass"+glId).length == 0)
			{				
				alert('Please add page from list.');
				flag++;
				$(this).focus();
				return false;
			}  
		}); 
		if(flag>0)   
		   return false;		
    }
</script>

<div class="page-content">
    <div class="page-header">
        <h1 id="title"></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active">Primary Link</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
                <input type="hidden" name="hdnFldForPageId" id="hdnFldForPageId" value="" />
                    <div class="portletCategoryClass">
                        <div class="innerPortletPage">
                            <h4>Pages</h4>
                             &nbsp; Select Global Link
                            <select name="selGlobalMenu" id="selGlobalMenu" style="width:160px; margin-left:5px;" class="selectdrop">
                                <option value="0">- Select -</option>                                          
                            </select>
                            <div class="scrollable" id="scrollablePages">
                                <div id="pageListDiv" style="margin:5px;"></div>
                            </div>
                        <div class="center">
                            <input type="button" name="btnAdd" id="btnAdd" style="margin:5px;" onClick="return addToList();" value="Add Link" class="btn btn-sm btn-success" />
                        </div>
                        </div>
                    </div>
					
                    <?php 
                    $ctr	= 0;
                    foreach($viewGl as $row)
                      {
                            $ctr++;
                            $menuName = htmlspecialchars_decode($row['menuName'], ENT_QUOTES);
                    ?>
                    <div class="portletCategoryClass">
                        <div class="innerPortletPl">
                            <h4><input type="checkbox" class="glPortlet" name="chkGLId[]" id="chkGLId<?php echo $row['pageId'];?>" value="<?php echo $row['pageId'];?>" />&nbsp;<?php echo $menuName;?></h4>
                            <div class="scrollable">
                                <div id="GLMenu<?php echo $row['pageId'];?>" class="ui-sortable"></div>
                            </div>
                        </div>                        
                    </div>   
                    <?php 
                            if($ctr%4==0){ }
                        
                        }
                    ?>
					
		<input type="submit" name="btnSaveMainMenu" id="btnSaveMainMenu" value="Publish Menu" class="btn btn-sm btn-success pull-right" style="margin-right:6px;" onClick="return menuValidator(1);" />
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.page-content -->
<script type="text/javascript">
jQuery(function ($) {
// scrollables
	$('#scrollablePages').each(function () {
		var $this = $(this);
		$(this).ace_scroll({
			size: $this.data('size') || 360,
			//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
		});
	});
	$('.scrollable').each(function () {
		var $this = $(this);
		$(this).ace_scroll({
			size: $this.data('size') || 190,
			//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
		});
	});
});
</script>