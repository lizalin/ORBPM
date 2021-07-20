
/* ================================================
 File Name         	  : loadAjax.js
 Description              : This page is used to load AJAX JSON request.
 Author Name		  : T Ketaki Debadarshini
 Date Created		  : 28-Aug-2015
 Update History		  :
 <Updated by>			<Updated On>		<Remarks>	
 
 
 ==================================================*/
    /*
	Function to get all users
        By:  T Ketaki Debadarshini 
        On: 3-Sep-2015
	*/	
	function getAllUsers(userId)
	{            
            $.ajax({
                   type     : "POST",
                   dataType : "json",
                   url      : APP_URL + '/proxy',
                   data     : {method:"getAllUsers",userId:userId},
                   success  : function(data) 
                   {
                        var res      = data.result;                        
                        /* Load results. */
                        $("#DdlName").html(res);                        
                   }
           });
	} 
        
        /*
	Function to get all users
        By:  T Ketaki Debadarshini 
        On: 3-Sep-2015
	*/	
	function fillPermission(userId)
	{ 
            $(".permissionList input[type='checkbox']").attr('checked',false);
            $(".permissionList input[type='text']").val(0);
            $(".viewTable").slideUp();
            $(".clickDiv").removeClass('active');
            $('#btnSave').val('Submit');
            $('#gl1').hide();
            if(userId!=0)
            {
                $.ajax({
                    type     : "POST",
                    dataType : "json",
                    url      : APP_URL + '/proxy',
                    data     : {method:"getPermission",userId:userId},
                    success  : function(data) 
                    {
                         var result      = data.result;                        
                         /* Load results. */
                        //alert(res);     
                         if(result!='')
                         {
                             var splResult	= result.split('[==]');
                             var priv		= splResult[0];
                             if(priv==1)
                             {
                                     $('#gl1').show();	
                             }
                             else
                             {
                                     $('#gl1').hide();	
                             }
                             var splRes		= splResult[1].split('[=]');
                             for(var i=0;i<splRes.length-1;i++)
                             {
                                 var glResult	= splRes[i];
                                 var glSplit	= glResult.split(',');
                                 var glVal	= glSplit[0];
                                 var plVal	= glSplit[1];
                                 var authorVal	= glSplit[2];
                                 var editorVal	= glSplit[3];
                                 var publisherVal= glSplit[4];
                                 var managerVal	= glSplit[5];

                                 if($('#tab'+glVal).not(":visible"))
                                 {
                                     $('#tab'+glVal).slideDown();	
                                     $('#gl'+glVal).addClass('active');
                                 }
                                 $('#chkBox_'+glVal+'_'+plVal).attr('checked','checked');					
                                 $('#hdnGl_'+glVal).val(1);
                                 $('#hdnPreGl_'+glVal).val(1);
                                 $('#hdn_'+glVal+'_'+plVal).val(1);
                                 $('#hdnPreVal_'+glVal+'_'+plVal).val(1);
                                 if(authorVal==1){$('#chkAuthor_'+glVal+'_'+plVal).attr('checked', true);}
                                 if(editorVal==1){$('#chkEditor_'+glVal+'_'+plVal).attr('checked','checked');}
                                 if(publisherVal==1){$('#chkPublisher_'+glVal+'_'+plVal).attr('checked','checked');}
                                 if(managerVal==1){$('#chkManager_'+glVal+'_'+plVal).attr('checked','checked');}
                                 if($('#btnSave').val()=='Submit')
                                  $('#btnSave').val('Update');
                             }
                         }
                         //
                    }
               });
           }
	} 

/*
 Function to get Page.
 By: T Ketaki Debadarshini 
 On: 28-Aug-2015
 */
function getPublishedPage()
{
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: {method: 'getPublishedPage'},
        success: function (data) {
            var res = data.result;
            var finalRes = res.split('~::~');
            /* Load results. */
            $("#pageListDiv").html(finalRes[0]);
            $("#hdnFldForPageId").val(finalRes[1]);
        }
    });
}

/*
 Function to get assigned menu list.
 By: Chinmayee 
 On: 20-May-2016
 */
function getAssignedMenuList(parentId, menuType)
{

        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "getAssignedMenuList", parentId: parentId, menuType: menuType},
            success: function (data)
            {
                var res = data.result;
                /* Load results. */
                if (menuType == 1)
                     $("#portletMenu").html(res);
               else if (menuType == 3)
                    $("#bottomMenu").html(res);                        
                else if (menuType == 2)                
                    $("#topMenu").html(res);                    
                else if (menuType == 6)                
                    $("#lkMenu").html(res);
               
                    showHideChkBox(menuType);
            }
        });
    }
    
    
    /*
 Function to get assigned Portlet menu list.
 By: Chinmayee 
 On: 20-May-2016
 */
function getAssignedPortletMenuList(parentId, menuType)
{

        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "getAssignedPortletMenuList", parentId: parentId, menuType: menuType},
            success: function (data)
            {
                var res = data.result;
                /* Load results. */
                if (menuType == 1)
                     $("#portletMenu").html(res);
               
                    showHideChkBox(menuType);
            }
        });
    }
    
 

/*
 Function to fill assigned menu list.
 By:  T Ketaki Debadarshini 
 On: 14-Aug-2015
 */
function fillMenuList(parentId, menuType, linkType, fillCtrlId)
{    
	$.ajax({
		type: "POST",
		url: APP_URL + '/proxy',
		dataType: "json",
		data: {method: "getAssignedMenuList", parentId: parentId, menuType: menuType, linkType: linkType},
		success: function (data)
		{
			var res = data.result;
			$("#"+fillCtrlId).html(res);			
		}
	});
    
}

/*
 Function to get global menu list.
 By: T Ketaki Debadarshini 
 On: 14-Aug-2015
 */
function getGlobalMenuList(menuType, linkType)
{
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: {method: "getGlobalMenuList", menuType: menuType, linkType: linkType},
        success: function (data)
        {
            var res = data.result;
            /* Load results. */
            $("#selGlobalMenu").append(res);
        }
    });
}
/*
 Function to delete menu list.
 By: T Ketaki Debadarshini 
 On: 13-Aug-2015
 */
function deleteMenu(id)
{
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: {method: 'deleteMenu', PID: id},
        success: function (data) {
           
            getTotalMenuRecords();	
        }
    });
}
/*
	Function to delete main menu.
	By: T Ketaki Debadarshini 
	On: 13-Aug-2015
	*/
        function deleteFromMainMenu(menuId,pageId)
        { 
            if (!confirm('Are you sure to remove the menu'))
                return false; 
            $.ajax({
                   type: "POST",
                   url: APP_URL + '/proxy',
                    dataType: "json",
                   data     : {method:'deleteFromMainMenu',menuId:menuId,pageId:pageId},
                   success  : function(data) {                   
                          var res = data.result;		
                          if(res == 1)
                          {
                            alert('Can not delete this global link as primary links present under this menu.');
                          }
                          else if(res == 2)
                          {                              
                            $("#mainMenuItem"+pageId).remove();
                            showHideChkBox(2);
                            displayEmptyText(2);
                            getTotalMenuRecords();	
                          }
                   }
           });
        }
        
        
        
        
        /*
	Function to delete main menu.
	By: T Ketaki Debadarshini 
	On: 13-Aug-2015
	*/
        function deleteFromPortetMenu(menuId,pageId)
        { 
            if (!confirm('Are you sure to remove the menu'))
                return false; 
            $.ajax({
                   type: "POST",
                   url: APP_URL + '/proxy',
                    dataType: "json",
                   data     : {method:'deleteFromPortetMenu',menuId:menuId,pageId:pageId},
                   success  : function(data) {                   
                          var res = data.result;		
                          if(res == 1)
                          {
                            alert('Can not delete this global link as primary links present under this menu.');
                          }
                          else if(res == 2)
                          {                              
                            $("#poartletMenuItem"+pageId).remove();
                            showHideChkBox(1);
                            displayEmptyText(1);
                            getTotalMenuRecords();	
                          }
                   }
           });
        }
        
        
/*
 Function to get Page Content.
 By: T Ketaki Debadarshini 
 On: 13-Aug-2015
 */
function getPageContent(id, lang)
{
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: {method: 'getPageContent', PID: id},
        success: function (data) {
            var pageNameE = data[0].titelE;
            var PageNameH = data[0].titleH;
            var contentE = data[0].contentE;
            var contentH = data[0].ContentH;
            if (lang == 1)
            {
                $('#myModalLabel').html(pageNameE);
                $('#divContent').html(contentE);
            }
            else
            {
                $('#myModalLabelH').html(PageNameH);
                $('#divContentH').html(contentH);
            }
        }
    });
}


/*
	Function to get all records.
	By: T Ketaki Debadarshini 
	On: 13-Aug-2015
	*/	
    function getTotalMenuRecords()
    {
             $.ajax({
                    type: "POST",
                    url: APP_URL + '/proxy',
                    dataType: "json",
                    data     : {method:"getTotalMenuRecords"},
                    success  : function(data) 
                    {
                            var res      = data.result;	
                           
                            /* Load results. */
                            $("#hdnTotalMenuRecords").val(res);                                
                    }
            });
    }
	
    
/*
	Function to get Page content
	By: T Ketaki Debadarshini 
	On: 13-Aug-2015
	*/	
    function getContent(controlID,PID,PAGEID,page)
    { 
        
             $.ajax({
                    type: "POST",
                    url: APP_URL + '/proxy',
                    dataType: "json",
                    data     : {method:"content",PID:PID,PNO:PAGEID},
                    success  : function(data) 
                    {
                       
                            var res         = data.content.strContentE;
                            var pageTitle   = data.content.pageTitle;
                           // alert(data.content.strContentE);
                            /* Load results. */ 
                            //$("#txtContentE").val(res); alert($("#txtContentE").val());
                            if(page==1)
                            CKEDITOR.instances['txtContentE'].setData(res);
                        else
                        {
                            $('#myModalLabel').html(pageTitle);
                            $('#divContent').html(res);
                        }
                    }
            });
    }
    
    /*
	Function to read Page content
	By: T Ketaki Debadarshini 
	On: 13-Aug-2015
	*/
        var arrcontent = new Array();
        var validFlag   = '0';
      function readPageContent(pageId)
       { 
             $.ajax({
                    type: "POST",
                    url: APP_URL + '/proxy',
                    dataType: "json",
                    data     : {method:"redContent",PID:pageId},
                    success  : function(data) 
                    {
                        var totalRecord = data.contentResult.length;
			var pageID		= '0';	
			var hdnContentId	= '0';
			var hdnPagevalue	= '';
			$('#hdnPageId1').val(pageID);
			$('#hdnContentId1').val(hdnContentId);	
			$('#hdnPagevalue1').val(hdnPagevalue); 
			var activeBtn	= 1;
                        if(totalRecord>0){
                            for(var i=1;i<=totalRecord;i++)
                            {
                                
                                pageID		= data.contentResult[i-1].intPageNo;
                                //hdnContentId	= data.contentResult[i-1].intContentId;
                                hdnPagevalue	= data.contentResult[i-1].strContent;
                                    
                                    $('#hdnPageId'+i).val(pageID);
                                    $('#hdnContentId'+i).val(pageId);	
                                    $('#hdnPagevalue'+i).val(hdnPagevalue);
                                    CKEDITOR.instances['txtContentE'].setData(hdnPagevalue);
                                    arrcontent.push(hdnPagevalue);
                                    validFlag=1; 
                                    if(i<totalRecord)
                                    	$('.addMore').click();
                                    validFlag=0;									 
                            }
							activeBtn=totalRecord;
                        }						
                    }
            });

    }
    
/*
     Function to read Page hindi content
     By: Sukanta kumar mishra
     On: 16-Apr-2015
     */
    var arrcontentO = new Array();
    var validFlagO = '0';
    function readPageContentH(pageId)
    {
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "redContentH", PID: pageId},
            success: function (data)
            {
                var totalRecord = data.contentResultH.length;
               
                var pageID = '0';
                var hdnContentId = '0';
                var hdnPagevalue = '';
                $('#hdnPageIdO1').val(pageID);
                $('#hdnContentIdO1').val(hdnContentId);
                $('#hdnPagevalueO1').val(hdnPagevalue);
                var activeBtn = 1;
               //  alert(hdnPagevalue);
                if (totalRecord > 0) {
                    for (var i = 1; i <= totalRecord; i++)
                    {

                        pageID = data.contentResultH[i - 1].intPageNo;
                        hdnContentId = data.contentResultH[i - 1].intContentId;
                        hdnPagevalue = data.contentResultH[i - 1].strContent;
                  //alert(hdnPagevalue);
                        $('#hdnPageIdO' + i).val(pageID);
                        $('#hdnCurrentIdO' + i).val(hdnContentId);
                        $('#hdnPagevalueO' + i).val(hdnPagevalue);
                        CKEDITOR.instances['txtContentO'].setData(hdnPagevalue);
                        arrcontentO.push(hdnPagevalue);
                        validFlag = 1;
                        if (i < totalRecord)
                            $('.addMoreO').click();
                        validFlag = 0;
                    }
                    activeBtn = totalRecord;
                }
            }
        });
    }
   
   /*
 Function to fillpage.
 By: T Ketaki Debadarshini 
 On: 13-Aug-2015
 */
function fillPageList(selval,fillCtrlId)
{    
	$.ajax({
		type: "POST",
		url: APP_URL + '/proxy',
		dataType: "json",
		data: {method: "getPage", SelVal: selval},
		success: function (data)
		{
			var res = data.page.pagename;
			$("#"+fillCtrlId).html(res);			
		}
	});
    
}

 /*
 Function to fillCategory.
 By: T Ketaki Debadarshini 
 On: 17-Aug-2015
 */

    function fillCategory(selval,fillCtrlId,selType)
    {    
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "getCategory", SelVal: selval, selType: selType},
            success: function (data)
            {
                var res = data.category;
                $("#"+fillCtrlId).html(res);			
            }
        });

    }

	 /*
    Function to fill all circularSectors.
    By: sonali
    On: 29-sept-2016
    */
    function fillcircularSection(controllerid,seval)
    {    
        
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "fillcircularSection", SID:seval},
            success: function (data)
            {
                var res = data.circulars;
                $("#"+controllerid).html(res);			
            }
        });

    }
    	 /*
    Function to fill all Service Category.
    By: sonali
    On: 29-sept-2016
    */
    function fillServiceCategory(controllerid,seval)
    {    
        
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "fillServiceCategory", SID:seval},
            success: function (data)
            {
                var res = data.serviceCategory;
                $("#"+controllerid).html(res);			
            }
        });

    }
        /*
       Function to fill all Web-DIrectory Category.
       By: Ashis Kumar Patra
       On: 14-Oct-2016
       */
       function fillWebCategory(controllerid,seval)
       {    

           $.ajax({
               type: "POST",
               url: APP_URL + '/proxy',
               dataType: "json",
               data: {method: "fillWebCategory", SID:seval},
               success: function (data)
               {
                   var res = data.webCategory;
                   //alert(controllerid);
                   $("#"+controllerid).html(res);			
               }
           });

       }
/*
 Function to fillCategory.
 By: T Ketaki Debadarshini 
 On: 18-Aug-2015
 */
function fillCategorynames(selval,fillCtrlId)
{    
	$.ajax({
		type: "POST",
		url: APP_URL + '/proxy',
		dataType: "json",
		data: {method: "getCategoryname", SelVal: selval},
		success: function (data)
		{
			var res = data.category.catname;
			$("#"+fillCtrlId).html(res);			
		}
	});
    
}


    
   /*
    Function to fill Primary Link
    By: T Ketaki Debadarshini 
    On: 04-Sept-2015
    */
$.fillPrimaryLink = function(controlId,glId,sval)
{	
	$.ajax({
		type: "POST",
		 url: APP_URL + '/proxy',
		 dataType: "json",
                 data     : {method:"getPrimary",selVal:sval,glID:glId},
		success: function(data) {
			$('#'+controlId).html(data.plLink);	
		},
	});
} 
 /*
    Function to fill Primary Link
    By: T Ketaki Debadarshini 
    On: 13-Aug-2015
    */
function viewPrimary(controlId,glId)
{	
	$.ajax({
		type: "POST",
		 url: APP_URL + '/proxy',
		 dataType: "json",
                 data     : {method:"viewPrimary",glID:glId},
		success: function(data) {
                    var totalRecoed = data.plLinkVal.length;
                    var tabDiv ='';
                    if(totalRecoed>0){
                    for (var i=0;i<totalRecoed;i++)
                    {
                        var plid     = data.plLinkVal[i].pageId;
                        var pageName = data.plLinkVal[i].menuName;
                        tabDiv+='<div class="portletCategoryClass">'
                        tabDiv+='<div class="innerPortletPl">';
                        tabDiv+='<h4><input type="checkbox" class="glPortlet" name="chkPLId[]" id="chkPLId'+plid+'" value="'+plid+'" />'+pageName+'</h4>';
                        tabDiv+='<div class="scrollable">';
			tabDiv+='<div id="GLMenu'+plid+'" class="ui-sortable"></div>';
			tabDiv+='</div>';
                        tabDiv+='</div>';                       
                        tabDiv+='</div>';  
                        fillMenuList(plid, 1, 'secondaryLink', 'GLMenu'+plid+'');
                       setTimeout(function(){ $("#GLMenu"+plid).sortable({revert: true}); }, 1000);
                    }
                   // tabDiv+='<div class="clearfix"></div>';
                    tabDiv+='<input type="submit" name="btnSaveMainMenu" id="btnSaveMainMenu" value="Publish Menu" class="btn btn-sm btn-success pull-right" style="margin-right:6px;" onClick="return menuValidator(1);" />';
                   }
                   else
                       tabDiv ="No Primary link Available"
			$('#'+controlId).html(tabDiv);	
		},
	});
}

/*
Function to Show FeedBack/Complain Remark details
By: T Ketaki Debadarshini 
On: 13-Aug-2015
*/
$.viewFeedBackRemarks	= function(controlId, feedBackId)
{
    $('#'+controlId).html('');
    $.ajax({
    type: "POST",
    url: APP_URL + '/proxy',
    dataType: "json",
    data: {method:'viewFeedBackDetails',FID:feedBackId},
    success: function(data){
            var tabDiv ='';
            var subject			= data.strSubject;
            var message			= data.strMessage;
            var remark                  = data.strRemark;
            var remarkDate		= data.remarkDate;
            tabDiv       +='<div class="form-group">';
            tabDiv       +='<label class="col-sm-2 control-label no-padding-right">Subject</label>';
            tabDiv       +='<label class="col-sm-10 control-label no-padding-right">: '+subject+'</label></div>';
            tabDiv       +='<div class="form-group">';
            tabDiv       +='<label class="col-sm-2 control-label no-padding-right">Message</label>';
            tabDiv       +='<label class="col-sm-10 control-label no-padding-right">: '+message+'</label></div>';
            tabDiv       +='<div class="form-group">';
            if(remark != null) {
                tabDiv       +='<label class="col-sm-2 control-label no-padding-right">Remark</label>';
                tabDiv       +='<label class="col-sm-10 control-label no-padding-right">: '+remark+'</label></div>';
                tabDiv       +='<div class="form-group">';
                tabDiv       +='<label class="col-sm-2 control-label no-padding-right">Remark Date</label>';
                tabDiv       +='<label class="col-sm-10 control-label no-padding-right">: '+remarkDate+'</label></div>';
            }
            $('#'+controlId+'1').html(tabDiv);
            $('#'+controlId+'2').html(tabDiv);
            $('#'+controlId+'3').html(tabDiv);
        }
    });
}


/*
        Function to get Tender Details.
        By: T Ketaki Debadarshini 
        On: 14-Sept-2015
 */
function getTenderDetails(id)
{
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: {method: 'getTenderDetails', ID: id},
        success: function (data) {

            var strDescription = data.tender.strDescription;
            var strTenderNo = data.tender.strTenderNo;
            var strHeadLine = data.tender.strHeadLine;
            
            $('#myModalLabel').html(strHeadLine+' :('+strTenderNo+')');
            $('#divContent').html(strDescription);
           

        }
    });
}

/*
     Function to get  logo.
     Created by     : Chinmayee
     Created On     : 18-Aug-2015
 */
function getLogo()
{
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: {method: 'getLogo'},
        success: function (data) {
            var res=data.result;
            //console.log(res);
            //alert(res);
          $("#homePageLogo").html(res);
      
              
            }
        
    });
}



       
        /*
    Function to reset password.
    By: T Ketaki Debadarshini 
    On: 21-Aug-2015
    */
       function resetPassword(userId)
       {    
          if(confirm("Are you sure to reset the password ?"))   
          {
                $.ajax({
                       type: "POST",
                       url: APP_URL + '/proxy',
                       dataType: "json",
                       data: {method: "resetPassword", userId: userId},
                       success: function (data)
                       {
                               var res = data.user;
                              // 
                               var divMsg='Password has been changed successfully.<br>';
                               divMsg+='User Id : '+res.strEmailid+'<br>';
                               divMsg+='Change Password : '+res.strPassword+'<br>';
                               //alert(divMsg);
                               $("#divReset").html(divMsg);			
                       }
                  });
           }

       }
    

     
       
        /*
        Function to get check unique user/EMail-id.
        By: T Ketaki Debadarshini
        On: 01-AUG-2015	
        */
       function checkDuplicateUser(userId,controlVal,controlName,spanName,hiddenName,flag)
       {
          if(controlVal=='')
               {
                   $('#'+spanName).html('');
                   return false;
               }
              // alert(userId+controlVal);
              // if()

           $.ajax({
               type: "POST",
               url: APP_URL + '/proxy',
               dataType: "json",
               data: {method: 'checkDuplicateUser', userId: userId, controlVal: controlVal, flag:flag },
               success: function (data) {

                   var res = data.result;
                   var num = Number(res);
                  // alert(Number(res));
                   $('#'+hiddenName).val(num);
                   if(num>0)
                    {	
                            if(flag==1)
                                    $('#'+spanName).html("<i class='icon-user'></i>&nbsp;User ID Already Exist");
                            else
                                    $('#'+spanName).html("<i class='icon-envelope'></i>&nbsp;email Already Exist");
                            $('#'+controlName).focus();
                    }
                    else
                    {
                            $('#'+spanName).html("");
                    }
               }
           });

       }
       
    /*
    Function to fill Plugins.
    By: T Ketaki Debadarshini 
    On: 09-Sept-2015
    */
       function fillPlugins(fillCtrlId,intSelval)
       {   
           var tabDiv='<option value="0">--Select--</option>';
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "fillPlugins"},
                 success: function (data)
                 {
                    var res = data.plLinkVal;
                    var totalRecord = data.plLinkVal.length;
                    var strSelected = '';
                    if(totalRecord>0){
                         for (var i=0;i<totalRecord;i++)
                         {                           
                            strSelected = (res[i].intfunId==intSelval)?'selected="selected"':'';
                             
                            tabDiv+='<option '+strSelected+' value="'+res[i].intplId+'_'+res[i].intfunId+'">';
                            tabDiv+= res[i].strplName;
                            tabDiv+='</option>'; 
                         }
                    }
                    
                    $("#"+fillCtrlId).html(tabDiv);			
                 }
            });

       }
       
    /*
    Function to fill Plugins types.
    By: T Ketaki Debadarshini 
    On: 09-Sept-2015
    */
       function getPluginTypes(funcId,fillCtrlId)
       { 
           var tabDiv='<option value="0">--Select--</option>';
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "getPluginTypes",funcId: funcId},
                 success: function (data)
                 {
                    var res = data.fnCategory;
                    var totalRecord = data.fnCategory.length;
                    
                    if(totalRecord>0){
                         for (var i=0;i<totalRecord;i++)
                         {                            
                             tabDiv+='<option value="'+res[i].intsubCatId+'">';
                             tabDiv+= res[i].strsubcatName;
                             tabDiv+='</option>'; 
                         }
                    }
                    
                     $("#"+fillCtrlId).html(tabDiv);				
                 }
            });

       }
       
       /*
    Function to fill Location.
    By: T Ketaki Debadarshini 
    On: 10-Sept-2015
    */
       function fillLocation(selVal,fillCtrlId)
       { 
           var tabDiv='<option value="0">--Select--</option>';
           var selected='';
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "fillLocation"},
                 success: function (data)
                 {
                    var res = data.result;
                    var totalRecord = data.result.length;
                    
                    if(totalRecord>0){
                         for (var i=0;i<totalRecord;i++)
                         {                            
                            if(selVal==res[i].intLocId)
                              selected='selected="selected"';
                            else
                              selected='';
                             tabDiv+='<option value="'+res[i].intLocId+'" '+selected+'>';
                             tabDiv+= res[i].strLocName;
                             tabDiv+='</option>'; 
                         }
                    }
                    
                     $("#"+fillCtrlId).html(tabDiv);				
                 }
            });

       }

         /*
    Function to fill Department.
    By: T Ketaki Debadarshini 
    On: 11-Sept-2015
    */
       function getDepartments(intLocid,fillCtrlId,selVal)
       { 
           var tabDiv='<option value="0">--Select--</option>';
           var selected='';
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "getDepartments",intLocid: intLocid},
                 success: function (data)
                 {
                    var res = data.result;
                    var totalRecord = data.result.length;
                    
                    if(totalRecord>0){
                         for (var i=0;i<totalRecord;i++)
                         {                            
                            if(selVal==res[i].intDeptId)
                              selected='selected="selected"';
                            else
                              selected='';
                             tabDiv+='<option value="'+res[i].intDeptId+'" '+selected+'>';
                             tabDiv+= res[i].strDeptName;
                             tabDiv+='</option>'; 
                         }
                    }
                    
                     $("#"+fillCtrlId).html(tabDiv);				
                 }
            });

       }
        /*
    Function to fill Designation.
    By: T Ketaki Debadarshini 
    On: 11-Sept-2015
    */
       function getDesignation(intDeptid,fillCtrlId,selVal)
       { 
           var tabDiv='<option value="0">--Select--</option>';
           var selected='';
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "getDesignation",intDeptid: intDeptid},
                 success: function (data)
                 {
                    var res = data.result;
                    var totalRecord = data.result.length;
                    
                    if(totalRecord>0){
                         for (var i=0;i<totalRecord;i++)
                         {                            
                            if(selVal==res[i].intDesgId)
                              selected='selected="selected"';
                            else
                              selected='';
                             tabDiv+='<option value="'+res[i].intDesgId+'" '+selected+'>';
                             tabDiv+= res[i].strDesgName;
                             tabDiv+='</option>'; 
                         }
                    }
                    
                     $("#"+fillCtrlId).html(tabDiv);				
                 }
            });

       }
    
     /*
    Function to fill Tender No.
    By: T Ketaki Debadarshini 
    On: 14-Sept-2015
    */
       function fillTender(fillCtrlId,tenderType)
       { 
           var tabDiv='<option value="0">--Select--</option>';
          
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "fillTender",tenderType: tenderType},
                 success: function (data)
                 {
                    var res = data.result;
                    var totalRecord = data.result.length;
                    
                    if(totalRecord>0){
                         for (var i=0;i<totalRecord;i++)
                         {                            
                           
                             tabDiv+='<option value="'+res[i].intTenderId+'" >';
                             tabDiv+= res[i].strTenderno;
                             tabDiv+='</option>'; 
                         }
                    }
                    
                     $("#"+fillCtrlId).html(tabDiv);				
                 }
            });

       }
       
       /*
    Function to fill Tender Fields .
    By: T Ketaki Debadarshini 
    On: 14-Sept-2015
    */
       function fillTenderfields(tenderId,tenderType)
       { 
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "fillTender",tenderId: tenderId,tenderType: tenderType},
                 success: function (data)
                 {
                    var res = data.result;
                    var totalRecord = data.result.length;
                    
                    if(tenderId!=0){
                         for (var i=0;i<totalRecord;i++)
                         {                                                      
                            $('#hdnTenderNo').val(res[i].strTenderNo);
                            $('#txtHeadline').val(res[i].strHeadline);
                            $('#txtOpeningDate').val(res[i].strOpeningDate);
                            $('#txtClosingDate').val(res[i].strClosingDate);
                            $('#txtOpeningTime').val(res[i].strOpeningTime);
                            $('#txtClosingTime').val(res[i].strClosingTime);
                            
                            $('#txtDetails').val(res[i].strDescription);
                            if(tenderType==0)
                            {
                                $('#hdnAddendumFile').val(res[i].strAddendumFile);
                                $('#hdnAddendumFile2').val(res[i].strAddendumFile2);
                                $('#hdnAddendumFile3').val(res[i].strAddendumFile3);
                            }   
                            else
                            {
                                $('#hdnCorrigdnumFile').val(res[i].strCorrigdmFile);
                                $('#hdnCorrigdnumFile2').val(res[i].strCorrigdmFile2);
                                $('#hdnCorrigdnumFile3').val(res[i].strCorrigdmFile3);
                            }
                         }
                    }
                   else
                   {
                        $('#hdnTenderNo').val('');
                        $('#txtHeadline').val('');
                        $('#txtOpeningDate').val('');
                        $('#txtClosingDate').val('');
                        $('#txtOpeningTime').val('');
                        $('#txtClosingTime').val('');
                       
                        $('#txtDetails').val('');
                        if(tenderType==0)
                        {
                            $('#hdnAddendumFile').val('');
                            $('#hdnAddendumFile2').val('');
                            $('#hdnAddendumFile3').val('');
                        }
                        else
                        {
                            $('#hdnCorrigdnumFile').val('');
                            $('#hdnCorrigdnumFile2').val('');
                            $('#hdnCorrigdnumFile3').val('');
                        }
                            
                   }  
                    
                    	
                 }
            });

       }
       
       
       
        /*
 Function to fill Gallery plugin pages.
 By: Chinmayee
 On: 26-May-2016
 */

    function fillgalleryplugin(fillCtrlId,selplugin)
    {    
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "fillgalleryplugin",selplugin:selplugin},
            success: function (data)
            {
                var res = data.result;
                $("#"+fillCtrlId).html(res);			
            }
        });

    }   
    /*
 Function to fill Gallery plugin pages category.
 By: Chinmayee
 On: 26-May-2016
 */
    
    function fillpluginCategorys(fillCtrlId,selType,selval)
    {    
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "fillpluginCategory", SelVal: selval, selType: selType},
            success: function (data)
            {
                var res = data.category;
                $("#selCategory").html(res);			
            }
        });

    }
    
            /*
 Function to fill Notification plugin pages.
 By: Chinmayee
 On: 27-May-2016
 */
        function fillNotifplugin(fillCtrlId,selplugin)
    {    
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "fillNotifplugin",selplugin:selplugin},
            success: function (data)
            {
                var res = data.result;
                $("#"+fillCtrlId).html(res);			
            }
        });

    }
            /*
 Function to fill Act and rule plugin pages.
 By: Chinmayee
 On: 30-May-2016
 */
        function fillActplugin(fillCtrlId,selplugin)
    {    
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "fillActplugin",selplugin:selplugin},
            success: function (data)
            {
                var res = data.result;
                $("#"+fillCtrlId).html(res);			
            }
        });

    }
                /*
 Function to fill webdirectory plugin pages.
 By: Chinmayee
 On: 31-May-2016
 */
        function fillDirplugin(fillCtrlId,selplugin)
    {    
        $.ajax({
            type: "POST",
            url: APP_URL + '/proxy',
            dataType: "json",
            data: {method: "fillDirplugin",selplugin:selplugin},
            success: function (data)
            {
                var res = data.result;
                $("#"+fillCtrlId).html(res);			
            }
        });

    }
    
    /* Function For fill all RTO office Name.
     * By:Shweta Choudhury
     * on:27-oct-2017
     */
    function fillRTOOfficeName(fillCtrlId,ctrlId)
       {   
           var tabDiv='<option value="0">--All--</option>';
            $.ajax({
                 type: "POST",
                 url: APP_URL + '/proxy',
                 dataType: "json",
                 data: {method: "fillRTOOfficeName",id:ctrlId},
                 success: function (data)
                 {
                    var res = data.result;
                                       
                    $("#"+fillCtrlId).html(res);			
                 }
            });

       }

/*
 Function to get Feedback.
 By: Ajmal Akhtar
 On: 24-Dec-2020
 */
function fillFeedback(fid)
{ 
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: { method: 'fillFeedback',fid:fid},
        success: function (res) {
         
if(res.status='ok')
{
    $('#infoAreamodal').modal('show');
      $("#filldata").html(res.result);
}
}
});
}

/*
 Function to get Compliment.
 By: Ajmal Akhtar
 On: 24-Dec-2020
 */
function fillCompliment(cid)
{ 
    $.ajax({
        type: "POST",
        url: APP_URL + '/proxy',
        dataType: "json",
        data: { method: 'fillCompliment',cid:cid},
        success: function (res) {
if(res.status='ok')
{  
    $('#infoAreamodal').modal('show');
      $("#filldata").html(res.result);
}
}
});
}




