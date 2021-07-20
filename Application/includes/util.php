<div class="utilBox">
<div style="float:right; margin:8px 0px 0px 4px; width:190px; position:relative; text-align:right;" class="mandatory" id="indicate">
	<img src="<?php echo APP_URL;?>img/indicates.gif"  align="absmiddle" />(*) indicates mandatory field
</div>
    <a href="#" title="Delete" id="deleteIcon" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm" onclick="gotoDelete('D');"><i class="icon-white icon-trash"></i></a>
    
    <a href="javascript:PrintPage();void(0)" title="Print" id="printIcon" data-toggle="tooltip" data-placement="top" class="btn btn-inverse btn-sm" ><i class="icon-white icon-print"></i></a>
	
	<a href="javascript:void(0);" title="Download" id="excelIcon" data-toggle="tooltip" data-placement="top" onclick="downloadExcel();" class="btn btn-success btn-sm" ><i class="fa fa-file"></i></a>

    <a href="javascript:void(0)" title="Make Inactive" id="inactiveIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm" onclick="gotoDelete('IN');"><i class="icon-white icon-remove"></i></a>
    
    <a href="javascript:void(0)" title="Make Active" id="activeIcon" data-toggle="tooltip" data-placement="top" class="btn btn-purple btn-sm" onclick="gotoDelete('AC');"><i class="icon-white icon-ok"></i></a>
    
    <a href="javascript:void(0)" title="Disable" id="disableIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm"><i class="icon-white icon-ban-circle" ></i></a>
    
    <a href="javascript:void(0)" title="Enable" id="enableIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm" onclick="gotoDelete('AC');"><i class="icon-white icon-ok-circle"></i></a>
    
    <a href="javascript:void(0)" title="Refresh" id="refreshIcon" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm"><i class="icon-white icon-refresh"></i></a>
    
    <a href="javascript:void(0)" title="Unpublish" id="unpublishIcon" data-toggle="tooltip" data-placement="top" class="btn btn-pink btn-sm" onclick="gotoDelete('IN');"><i class="icon-white icon-volume-off"></i></a>
    
    <a href="javascript:void(0)" title="Publish" id="publishIcon" data-toggle="tooltip" data-placement="top" class="btn btn-purple btn-sm" onclick="gotoDelete('P');"><i class="icon-white icon-volume-up"></i></a>
    
    <a href="javascript:void(0)" title="Archive" id="archiveIcon" data-toggle="tooltip" data-placement="top" class="btn btn-yellow btn-sm" onclick="gotoDelete('AR');"><i class="icon-white icon-book"></i></a>
    
    <a href="javascript:void(0)" onclick="goBack();" title="Back" id="backIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm"><i class="icon-white icon-arrow-left"></i></a>
    
     <a href="javascript:void(0)" title="Update" id="updateIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm"><i class="icon-white icon-upload"></i></a>
     <a href="javascript:void(0)" title="Show in Home" id="showHomeIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-yellow" onclick="gotoDelete('SH');"><i class="icon-white icon-showHome"></i></a>
    
     <a href="javascript:void(0)" title="Hide in Home" id="hideHomeIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm btn-yellow" onclick="gotoDelete('HH');"><i class="icon-white icon-hideHome"></i></a>      
      
    <a href="javascript:void(0)" title="Make Inactive" id="uinactiveIcon" data-toggle="tooltip" data-placement="top" class="btn btn-sm" onclick="gotoDelete('UIN');"><i class="icon-white icon-remove"></i></a>    
    <a href="javascript:void(0)" title="Make Active" id="uactiveIcon" data-toggle="tooltip" data-placement="top" class="btn btn-purple btn-sm" onclick="gotoDelete('UAC');"><i class="icon-white icon-ok"></i></a>
     
</div>    

<script language="javascript" type="text/javascript">

$(document).ready(function(){
		//$("#deleteIcon").tooltip();
		checkStatus();
});

function goBack()
	{
		var path= backPath;
		if(typeof(path)=='undefined' || path==''){
		var referrer =  document.referrer;
		window.location.href = referrer;
		}
		else		
			window.location.href=APP_URL+'/'+path;
		
	}
	
$("#printIcon").hide();
$("#backIcon").hide();
$("#refreshIcon").hide();
$("#deleteIcon").hide();
$("#activeIcon").hide();
$("#inactiveIcon").hide();
$("#indicate").hide();
$("#disableIcon").hide();
$("#enableIcon").hide();
$("#archiveIcon").hide();
$("#publishIcon").hide();
$("#unpublishIcon").hide();
$("#updateIcon").hide();
$('#showHomeIcon').hide();
$('#hideHomeIcon').hide();
$('#excelIcon').hide();
$('#uinactiveIcon').hide();
$('#uactiveIcon').hide();
function checkStatus(){

if(uinactiveMe=="yes")
	{
		$('#uinactiveIcon').show();
		$("#uinactiveIcon").tooltip();
	}
if(uactiveMe=="yes")
	{
		$('#uactiveIcon').show();
		$("#uactiveIcon").tooltip();
	}    	
if(backMe=="yes")
	{
		$('#backIcon').show();
		$("#backIcon").tooltip();
	}
if(printMe=="yes")
	{
		$('#printIcon').show();
		$("#printIcon").tooltip();
	}

if(refreshMe=="yes")
	{
		$('#refreshIcon').show();
		$("#refreshIcon").tooltip();
	}

if(archiveMe=="yes")
	{
		$('#archiveIcon').show();
		$("#archiveIcon").tooltip();
	}
if(publishMe=="yes")
	{
		$('#publishIcon').show();
		$("#publishIcon").tooltip();
	}
if(unpublishMe=="yes")
	{
		$('#unpublishIcon').show();
		$("#unpublishIcon").tooltip();
	}
if(deleteMe=="yes")
	{
		$('#deleteIcon').show();
		$("#deleteIcon").tooltip();
	}
if(activeMe=="yes")
	{
		$('#activeIcon').show();
		$("#activeIcon").tooltip();
	}
if(inactiveMe=="yes")
	{
		$('#inactiveIcon').show();
		$("#inactiveIcon").tooltip();
	}
if(enableMe=="yes")
	{
		$('#enableIcon').show();
		$("#enableIcon").tooltip();
	}
if(disableMe=="yes")
	{
		$('#disableIcon').show();
		$("#disableIcon").tooltip();
	}
if(indicate=="yes")
	{
		//document.getElementById('indicate').style.display='block'
		$('#indicate').show();
		$("#indicate").tooltip();
	}
	
if(updateMe=="yes")
	{
		//document.getElementById('indicate').style.display='block'
		$('#updateIcon').show();
		$("#updateIcon").tooltip();
	}
if(showHome=="yes")
	{
		//document.getElementById('indicate').style.display='block'
		$('#showHomeIcon').show();
		$("#showHomeIcon").tooltip();
	}
	
if(hideHome=="yes")
	{
		//document.getElementById('indicate').style.display='block'
		$('#hideHomeIcon').show();
		$("#hideHomeIcon").tooltip();
	}
	
if(downloadMe=="yes")
	{
		//document.getElementById('indicate').style.display='block'
		$('#excelIcon').show();
		$("#excelIcon").tooltip();
	}

}
</script>						