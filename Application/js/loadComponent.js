var printMe
var indicate
var backMe
var refreshMe
var archiveMe
var publishMe
var unpublishMe
var deleteMe
var activeMe
var inactiveMe
var enableMe
var disableMe
var updateMe
var showHome
var hideHome
var downloadMe
var uactiveMe
var uinactiveMe

var pageHeader
var strFirstLink
var strLastLink

// *** Script for get Absolute path and Updated by Sudam Chandra Panda on 28th Jun 2012 ****//
	var host 		= window.location.host;
	
	var pathInfo	= window.location.pathname;
	//var path		= pathInfo.split("/");
	var FN1			= pathInfo.split('/')[1];
	var FN2			= pathInfo.split('/')[2];
	
	const ENV_APP = 'D';
	if(ENV_APP == 'L')
		var aUrl = "http://"+host;
	else
		var aUrl = "http://"+host+'/'+FN1;
	
	var APP_URL		= aUrl+"/Application";
	var siteUrl 	= aUrl;//"http://"+host+"/";


// *** Script for display Page Title and Updated by Sudam Chandra Panda on 22nd Aug 2012 ****//
	function configTitleBar()
	{
		if($("#title"))
		{
			$("#title").html(pageHeader);
		}
		
		var FirstLink = strFirstLink;
		var LastLink = strLastLink;
		var pageTitle = pageHeader;
                var totLink ="";
		if(FirstLink=="")
		{
                    //FirstLink = "";
                    totLink=" <li class='active'> " +  LastLink + "</li>";
		}
		else
		{
                    //FirstLink = "<li>" +  FirstLink + " </li>";//FirstLink+"&nbsp;/";
                    totLink="<li>" +  FirstLink + " </li><li>" + LastLink + "</li>";
		}
                
                $('#title').html(pageTitle);
		$('#navigation').html('<li><a href="'+APP_URL+'/dashboard" alt="Home" title="" data-original-title="Dashboard" ><i class="ace-icon fa fa-home home-icon"></i></a></li>'+ totLink);
		//$("#navigation").html("<a href='"+url+"/dashboard/' class='home'>Home</a>&nbsp;/&nbsp;"+FirstLink+" "+LastLink+"&nbsp;/&nbsp;<strong>"+ pageTitle+"</strong>")
	}
        
$(document).ready(function() {
		//$('[data-rel=tooltip]').tooltip();
		//bindHeader('header','footertext','footerUrl');
		//history.forward(1);
		if($('.chkAll').length>0)
		{
			$('.chkAll').on('click',function(){
				if($(this).is(':checked'))
					$('.chkItem').attr('checked',true);
				else
					$('.chkItem').attr('checked',false);
			});
		}
		if($('.chkItem').length>0)
		{			
			$('.chkItem').on('click',function(){
				var chkAllFlag	= 0;
				$('.chkItem').each(function(){
					if($(this).is(':checked'))
						chkAllFlag++;
				});
				if(Number(chkAllFlag)==Number($('.chkItem').length))
					$('.chkAll').attr('checked',true);
				else
					$('.chkAll').attr('checked',false);
			});
		}
                
                
               // if($('.chkAll2').length>0)
		//{
			$('.chkAll2').on('click',function(){
				if($(this).is(':checked'))
					$('.chkItem2').attr('checked',true);
				else
					$('.chkItem2').attr('checked',false);
			});
		//}
                //if($('.chkItem2').length>0)
		//{			
			$('.chkItem2').on('click',function(){ 
				var chkAllFlag	= 0;
				$('.chkItem2').each(function(){
					if($(this).is(':checked'))
						chkAllFlag++;
				});
				if(Number(chkAllFlag)==Number($('.chkItem2').length))
					$('.chkAll2').attr('checked',true);
				else
					$('.chkAll2').attr('checked',false);
			});
		//}

	});
function loadNavigation(fLink) 
	{		
		var totLink = '';
		var glName	= (getCookie("GlName")!='' && fLink!='Dashboard')?getCookie("GlName"):'Dashboard';
		var plName	= (getCookie("PlName")!='' && fLink!='Dashboard')?getCookie("PlName"):'';
		if(plName!='')
			totLink="<li>" +  glName + " </li><li>" + plName + "</li>";
		else
			totLink=" <li class='active'> " +  glName + "</li>";
		
		$('#navigation').html('<li><a href="'+APP_URL+'/dashboard" alt="Home" title="" data-original-title="Dashboard" ><i class="ace-icon fa fa-home home-icon"></i></a></li>'+ totLink);
		$('#title').html(fLink);
		
	}

// *** Script for Print page and Updated by Sudam Chandra Panda on 22nd Aug 2012 ****//
	function PrintPage(printDivid='viewTable') {
		 var windowName = "PrintPage";
		 var wOption 	= "width=1000,height=600,menubar=yes,scrollbars=yes,location=no,left=100,top=100";
		 var cloneTable 	= $("#"+printDivid).clone();
		 cloneTable.find('input[type=text],select,textarea').each(function(){
			var elementType	= $(this).prop('tagName');	
			if(elementType=='SELECT')
				var textVal	= $(this).find("option:selected").text();
			else
				var textVal	= $(this).val();
			$(this).replaceWith('<label>'+ textVal +'</label>');
		 });
		 cloneTable.find('a').each(function(){
			var anchorVal	= $(this).html();
			$(this).replaceWith('<label>'+anchorVal+'</label>');
		 });
		 	var pageTitle	= $("#title").text();
		 	var wWinPrint 	= window.open("",windowName,wOption);
			wWinPrint.document.open();
			wWinPrint.document.write("<html><head><link href='"+APP_URL+"/css/Print.css' rel='stylesheet'><title></title></head><body>");
			wWinPrint.document.write("<div id='header'><div class='pull-left text_logo'><img src='"+APP_URL+"/img/Logoblack.png' alt='Logo'>RAJ BHAVAN<small>ODISHA</small></div><div class='clear'>&nbsp;</div></div>")
			wWinPrint.document.write("<div id='printHeader'>" + pageTitle + "</div>");		
			wWinPrint.document.write("<div id='printContent'>"+cloneTable.html()+"</div>");
			wWinPrint.document.write("<div id='printFooter'>&copy; 2021- All Rights Reserved - Raj Bhavan, Odisha</div>");
			wWinPrint.document.write("</body></html>");
			wWinPrint.document.close();
			wWinPrint.focus();
		return wWinPrint;
}

//===================== Function to print modal content By Sunil Kumar Parida On 3-Jan-2015 ==========
function printModal(title,content)
{	
	 var windowName = "PrintPage";
	 var wOption 	= "width=1000,height=600,menubar=yes,scrollbars=yes,location=no,left=100,top=100";
	 var cloneTable 	= $("#"+content).clone();
	 cloneTable.find('input[type=text],select,textarea').each(function(){
		var elementType	= $(this).prop('tagName');	
		if(elementType=='SELECT')
			var textVal	= $(this).find("option:selected").text();
		else
			var textVal	= $(this).val();
		$(this).replaceWith('<label>'+textVal+'</label>');
	 });
	 cloneTable.find('a').each(function(){
		var anchorVal	= $(this).html();
		$(this).replaceWith('<label>'+anchorVal+'</label>');
	 });
		var pageTitle	= $("#"+title).text();
		var wWinPrint 	= window.open("",windowName,wOption);
		wWinPrint.document.open();
		wWinPrint.document.write("<html><head><link href='"+APP_URL+"/css/print.css' rel='stylesheet'><title></title></head><body>");
		wWinPrint.document.write("<div id='header'><div class='pull-left text_logo'><h1 class='logo'>OMVD</h1></div><div class='clear'>&nbsp;</div></div>")
		wWinPrint.document.write("<div id='printHeader'>" + pageTitle + "</div>");		
		wWinPrint.document.write("<div id='printContent'>"+cloneTable.html()+"</div>");
		wWinPrint.document.write("<div id='printFooter'>&copy; 2015, OMVD, All Rights Reserved.</div>");
		wWinPrint.document.write("</body></html>");
		wWinPrint.document.close();
		wWinPrint.focus();
		return wWinPrint;
	
}

//===================== Function to print modal content By Sunil Kumar Parida On 3-Jan-2015 ==========
function printReceiptModal(title,content)
{	
	 var windowName = "PrintPage";
	 var wOption 	= "width=1000,height=600,menubar=yes,scrollbars=yes,location=no,left=100,top=100";
	 var cloneTable 	= $("#"+content).clone();
	 cloneTable.find('input[type=text],select,textarea').each(function(){
		var elementType	= $(this).prop('tagName');	
		if(elementType=='SELECT')
			var textVal	= $(this).find("option:selected").text();
		else
			var textVal	= $(this).val();
		$(this).replaceWith('<label>'+textVal+'</label>');
	 });
	 cloneTable.find('a').each(function(){
		var anchorVal	= $(this).html();
		$(this).replaceWith('<label>'+anchorVal+'</label>');
	 });
		var pageTitle	= $("#"+title).text();
		var wWinPrint 	= window.open("",windowName,wOption);
		wWinPrint.document.open();
		wWinPrint.document.write("<html><head><link href='"+siteUrl+"/css/bootstrap.min.css' rel='stylesheet'><link href='"+siteUrl+"/css/dashboard.css' rel='stylesheet'><link href='"+APP_URL+"/css/print.css' rel='stylesheet'><title></title></head><body onload='window.print();'>");
		wWinPrint.document.write("<div id='header'><div class='pull-left text_logo'><h1 class='logo'>OMVD</h1></div><div class='clear'>&nbsp;</div></div>")
		wWinPrint.document.write("<div id='printHeader'>" + pageTitle + "</div>");		
		wWinPrint.document.write("<div id='printContent'>"+cloneTable.html()+"</div>");
		wWinPrint.document.write("<div id='printFooter'>&copy; 2015, OMVD, All Rights Reserved.</div>");
		wWinPrint.document.write("</body></html>");
		wWinPrint.document.close();
		wWinPrint.focus();
		return wWinPrint;
	
}


function printModalLogo(title,content)
{	
	 var windowName = "PrintPage";
	 var wOption 	= "width=1000,height=600,menubar=yes,scrollbars=yes,location=no,left=100,top=100";
	 var cloneTable 	= $("#"+content).clone();
	 cloneTable.find('input[type=text],select,textarea').each(function(){
		var elementType	= $(this).prop('tagName');	
		if(elementType=='SELECT')
			var textVal	= $(this).find("option:selected").text();
		else
			var textVal	= $(this).val();
		$(this).replaceWith('<label>'+textVal+'</label>');
	 });
	 cloneTable.find('a').each(function(){
		var anchorVal	= $(this).html();
		$(this).replaceWith('<label>'+anchorVal+'</label>');
	 });
		var pageTitle	= (title!='')?$("#"+title).text():'';
		var wWinPrint 	= window.open("",windowName,wOption);
		wWinPrint.document.open();
		wWinPrint.document.write("<html><head><link href='"+APP_URL+"/css/print.css' rel='stylesheet'><title></title></head><body>");
		//wWinPrint.document.write("<div id='header'><img src='"+APP_URL+"/img/printLogo.png' border='0' align='absmiddle' alt='Department of Town and Country Planning, Himachal Pradesh' class='logo' /><div class='pull-left text_logo'><h1 class='logo'>Department of Town and Country Planning<br /><span>Government of Himachal Pradesh</span></h1></div><div class='clear'>&nbsp;</div></div>")
		wWinPrint.document.write("<div id='printHeader'>" + pageTitle + "</div>");		
		wWinPrint.document.write("<div id='printContent'>"+cloneTable.html()+"</div>");
		//wWinPrint.document.write("<div id='printFooter'>&copy; 2014-15, Department of Town & country Planning, Himachal Pradesh</div>");
		wWinPrint.document.write("</body></html>");
		wWinPrint.document.close();
		wWinPrint.focus();
		return wWinPrint;
	
}
// ******************** function for Date & Time ********************** //
	function dateTime(idVal)
	{
		//Set Weedday against current day in numeric
		var WeekDay	= new Array(7);
		WeekDay[0]	= "Sunday";
		WeekDay[1]	= "Monday";
		WeekDay[2]	= "Tuesday";
		WeekDay[3]	= "Wednesday";
		WeekDay[4]	= "Thursday";
		WeekDay[5]	= "Friday";
		WeekDay[6]	= "Saturday";
		
		//Set month Name against current Month in numeric 
		var monthName = new Array( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec")
		
		var CurDateTime	= new Date();
		//alert(CurDate);
		var curDay		= CurDateTime.getDay();
		var curDate		= CurDateTime.getDate();
		var curMonth	= CurDateTime.getMonth();
		var curYear		= CurDateTime.getFullYear();
		var curHH		= CurDateTime.getHours();
		var curMM		= CurDateTime.getMinutes();
		var curSS		= CurDateTime.getSeconds();
		
		if(curHH>=12)
		{
			curHH=curHH-12;
			var Hour = "PM";
		}
		else
			var Hour = "AM";
			
		if(curMM<10)
			curMM='0'+curMM;
		if(curSS<10)
			curSS='0'+curSS;
		
		var date	 	= "<span class='clock'>"+WeekDay[curDay]+", "+monthName[curMonth]+" "+curDate+", "+curYear+"  "+curHH+":"+curMM+":"+curSS+" "+Hour+"</span>";
		//alert(date)
		$('#'+idVal).html(date);
		setTimeout('dateTime(\''+idVal+'\')',1000);
	}
 //======== Function for set cookie value By Sunil Kumar Parida On 11/09/2014 =========
	function setCookie(cname,cvalue,exdays) 
	{
		removeCookie(cname);
		var d = new Date();
		d.setTime(d.getTime() + (exdays*60*60*1000));
		var expires = "expires=" + d.toGMTString();
		document.cookie = cname+"="+cvalue+"; "+expires;
	}
	//======== Function for get cookie value By Sunil Kumar Parida On 11/09/2014 =========
	function getCookie(cname) 
	{
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) 
		{
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) != -1) 
			{
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	//======== Function for remove cookie By Sunil Kumar Parida On 11/09/2014 =========
	function removeCookie(cname) 
	{    
		document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
	}
	//======== Function for redirect to page By Sunil Kumar Parida On 11/09/2014 =========
	function goToPage(page,Gl,Pl,GlName,PlName)
	{
		setCookie("GLink",Gl,2);
		setCookie("PLink",Pl,2);	
		setCookie("GlName",GlName,2);
		setCookie("PlName",PlName,2);
		window.location.href=page;		
	}
//scripts for popover
$(function () { 
		if($(".popover-html").length>0)
			$(".popover-html").popover({ html : true });		
});


//Function to textcounter.
	function TextCounter(ctlTxtName,lblCouter,numTextSize)
        {
                     var txtName = $('#'+ctlTxtName).val();		
                     var txtNameLength = txtName.length;
                     if (parseInt(txtNameLength) > parseInt(numTextSize)) 
                     {
                            var txtMaxTextSize = txtName.substr(0,numTextSize);
                            $("#"+ctlTxtName).val(txtMaxTextSize);		 
                            alert("Entered Text Exceeds '"+ numTextSize +"' Characters.");
                            $("#"+lblCouter).text(0);		  
                            return false;
                     }
                     else
                     {
                             $("#"+lblCouter).text ( parseInt(numTextSize) -parseInt(txtNameLength));			 
                              return true;

                     }
        }
    // ****************** function for Delete Records ***************** //
	function gotoDelete(action)
	{
           // alert(1);
		var PIds='';
		$('.chkItem').each(function(){
			if($(this).is(':checked'))
				PIds	+= $(this).val()+',';
                           
		});
		if(PIds.length>0)
		{
                            PIds        = PIds.substring(0,PIds.length - 1);
                        var pidVal      =  PIds.split(',');
                        var totalcount  = pidVal.length;
                        for(var i=0;i<totalcount;i++)
                        {
                            var pubStatus	=$('#hdnPubStatus'+pidVal[i]).val();
                            if(pubStatus==1 && action=='SH' )
                            {
                                  viewAlert("First publish record(s) to display on Homepage.");	
                                  $('#hdnPubStatus'+pidVal[i]).focus();
                                    return false;
                            }
							
                            
                        }
                       
                    
			if(action=='D')
			{
				confirmAlert('Are you sure to delete selected Record(s)');	
				
			}
			if(action=='AR')
			{
				confirmAlert('Are you sure to archive selected Record(s)');	
				
			}
			if(action=='UN')
			{
				confirmAlert(' Are you sure to unpublish selected Record(s)');	
					
			}
			if(action=='IN')
			{
				confirmAlert(' Are you sure to unpublish selected Record(s)');	
					
			}
			if(action=='UIN')
			{
				confirmAlert(' Are you sure to deactivate selected Record(s)');	
					
			}
			if(action=='AC')
			{
				confirmAlert('Are you sure to activate selected Record(s)');	
					
			}
			if(action=='P')
			{
				confirmAlert('Are you sure to publish selected Record(s)');	
					
			}
                        if(action=='US')
			{
				confirmAlert('Are you sure to update Serial Numbers of  Record(s)');	
					
			}
                       $('#btnConfirmOk').on('click',function(){
												   
				$("#hdn_ids").val(PIds);
                                $("#hdn_qs").val(action);
                                $('#frmTCP').submit();							
				
			});
			
		}
		else
		{
			viewAlert('Please select a record!');
			return false;
		}		
	}
        
       
	
	function DoPaging(CurrentPage,RecordNo)
	{
		$("#hdn_PageNo").val(CurrentPage);
		$("#hdn_RecNo").val(RecordNo);
		$("form").submit();
	}
	
    function AlternatePaging()
            {
                    if($('#hdn_IsPaging').val()=="0")	
                            $("#hdn_IsPaging").val("1");
                    else	
                            $("#hdn_IsPaging").val("0");
                    $("form").submit();	
            }
        
        function displayCkeditor(id)
        {
            if(CKEDITOR.instances[id])
            {
                CKEDITOR.remove(CKEDITOR.instances[id]);
            }

            CKEDITOR.replace(id,  {			
                filebrowserBrowseUrl : APP_URL+"/controller/browser.php",
                filebrowserUploadUrl :      APP_URL+"/controller/upload.php?type=files",
                filebrowserImageUploadUrl : APP_URL+"/controller/upload.php?type=images",
                filebrowserFlashUploadUrl : APP_URL+"/controller/upload.php?type=flash"
            });
                    CKEDITOR.on( 'dialogDefinition', function( ev ) {
                            // Take the dialog name and its definition from the event data.
                            var dialogName = ev.data.name;
                            var dialogDefinition = ev.data.definition;

                            // Check if the definition is from the dialog window you are interested in (the "Link" dialog window).
                            if ( dialogName == 'image' ) {
                               $('#hdnHttp').val('http://');
                            }
                            else if(dialogName == 'link')
                            {
                             $('#hdnHttp').val('');
                             }
                    });
        }
		
		// *** Script for show hide search pannel by Sunil Kumar Parida on 13/Aug/2015****//
function viewSearchPannel(flag, pannelId, buttonId)
{
	if(flag=='S')
	{
		$('#'+pannelId).show();
		$('#'+buttonId).html('Close Search Panel <i class="bigger-110 fa fa-chevron-circle-up"></i>');
	}
	else
	{
		$('#'+pannelId).hide();
		$('#'+buttonId).html('Open Search Panel <b class="bigger-110 fa fa-chevron-circle-down"></b>');
	}
	$("#"+buttonId).click(function(){
		$("#"+pannelId).slideToggle('slow', function() {
          if ($("#"+pannelId).is(":hidden")) 
			$("#"+buttonId).html('Open Search Panel <i class="bigger-110 fa fa-chevron-circle-down"></i>');
		else
			$('#'+buttonId).html('Close Search Panel <i class="bigger-110 fa fa-chevron-circle-up"></i>');	
        });		
	});
}
// *** Script for function to check duplicate by Rasmi Ranjan Swain on 13/Aug/2015 ****//

function hasDuplicates(array) {
           var valuesSoFar = [];
           var flag =0;
           for (var i = 0; i < array.length; ++i) {
               var value = array[i];
               if (valuesSoFar.indexOf(value) !== -1) {           
                         flag++;
               }
               valuesSoFar.push(value);
           }
        return flag;
       }
       
     // function to scroll to topposition
 function scrollToPosition(id)
{  
    $('html, body').animate({ scrollTop: $('#'+id).offset().top-300 }, 'slow');
    $('#'+id).focus();
}

//function to download excel by indrani on::25-01-2021
function downloadExcel()
    {   
        var actions = "export";
        $("#hdn_qs").val(actions);     
        $('#frmTCP').submit();
         $("#hdn_qs").val('');
       
        //window.location.reload();
    }
