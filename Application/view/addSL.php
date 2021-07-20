<?php
/* 
 * File Name         	: addSL.php.
 * Description		: This is used to add Secondary Link .
 * Devloped By          : Rasmi Ranjan Swain
 * Devloped On		: 20-Frb-2015
 *          Update History		  : <Updated by>		<Updated On>		<Remarks>
 * Style sheet          : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css,ace-skins.min.css,ace-rtl.min.css
 * Javscript Functions  : jquery-1.8.2.min.js, bootstrap.min.js,ace-extra.min.js,custom.js,loadComponent.js,clock.js,validatorchklist.js
 * includes		: addSlInner.php,header.php, navigation.php, util.php, footer.php
 */
require 'addSlInner.php';
?>
<script src="<?php echo APP_URL; ?>js/jqueryOrdering.js"></script>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script language="javascript">
	$(document).ready(function () {
		//loadNavigation('Secondary Link');
		//indicate = 'yes';
                pageHeader   = "Secondary Link";
                strFirstLink = "Manage Link";
                strLastLink  = "Secondary Link";  
                
                getPublishedPage();
                getGlobalMenuList(1, 'globalLink');
                 if ('<?php echo $outMsg != '' ?>')
            alert('<?php echo $outMsg; ?>');
            $('#selGlobalMenu').live('change',function(){
                    viewPrimary('divPrimary',this.value);
                    setTimeout(function(){
                    <?php foreach($viewPl as $row2){?>
                        $("#GLMenu<?php echo $row2['pageId'];?>").sortable({revert: true});
		<?php }?>
                    }, 1000);
                });
                
                
	});
        
                    
</script>
<div class="page-content">
    <div class="page-header">
        <h1 id="title"></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active">Secondary Link</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
                <input type="hidden" name="hdnFldForPageId" id="hdnFldForPageId" value="" />
                    <div class="portletCategoryClass">
                        <div class="innerPortletPage">
                            <h4>Pages</h4>
                             &nbsp; Select Global Link
                             <select name="selGlobalMenu" id="selGlobalMenu" style="width:160px; margin-left:5px;" class="selectdrop" onchange="$.fillPrimaryLink('selPrimaryMenu',this.value,0);">
                                <option value="0">- Select -</option>                                          
                            </select>
                             &nbsp; &nbsp;&nbsp;Select Primary Link
                            <select name="selPrimaryMenu" id="selPrimaryMenu" style="width:160px; margin-left:5px;" class="selectdrop">
                                <option value="0">- Select -</option>                                          
                            </select>
                            <div class="scrollable" id="scrollablePages">
                            <div id="pageListDiv" style="margin:5px;"></div>
                            </div>
                        
                        </div>
                        <div class="center">
                            <input type="button" name="btnAdd" id="btnAdd" style="margin:5px;" onClick="return addToList();" value="Add Link" class="btn btn-sm btn-success" />
                        </div>
                    </div>
                <div id="divPrimary"></div>		
					
					
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
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
  function addToList()
    { 
	var glIds	= $('#selGlobalMenu').val();
        var plids       = $('#selPrimaryMenu').val();
        if(plids==0)
        {
            alert("Please select Primary Link");
            $('#selPrimaryMenu').focus();
            return false;
        }
        var allPageIds 	= $("#hdnFldForPageId").val();
        allPageIds 	= allPageIds.substring(1);
        var idArrs 	= allPageIds.split(',');
        var arrCount 	= idArrs.length;
        var flag	= 0;
        var errflag 	= 0;
        var totalCount	= 0;
        for (var i = 0; i < arrCount; i++)
        {
            if ($("#chkPageId" + idArrs[i]).is(':checked'))
            {
                flag++;
                $(".mainMenuClass"+plids).each(function () {
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
                    var hdnFld = '<input type="hidden" name="mainMenuArr'+plids+'[]" id="hdnMainMenuId' + idArrs[i] + '" class="mainMenuClass'+plids+'" value="' + idArrs[i] + '" />';
                    var menuItem = '<div class="ui-sortable-handle mainMenuItem" id="mainMenuItem' + idArrs[i] + '">' + menuText + hdnFld + closeBtn + '</div>';
                    $("#GLMenu"+plids).append(menuItem);
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
 
