<?php
/* ================================================
  File Name                       : addGL.php
  Description             : This is used for add the Global Link details.
  Designed By             :
  Designed On             :
  Devloped By                     : T Ketaki Debadarshini
  Devloped On                      : 29-Aug-2015
  Update History          : <Updated by>        <Updated On>        <Remarks>

  Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css
  Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js,loadAjax.js,jqueryOrdering.js
  includes            : header.php, navigation.php, util.php, footer.php,addGLInner.php           :

  ================================================== */
require 'addGLInner.php';
?>

<style>
    .dd-handle{
        /*width: 90%*/
    }
</style>
<script language="javascript">
    $(document).ready(function() {
        //loadNavigation('Global Link');
        pageHeader = "Manage Menus";
        strFirstLink = "Manage Link";
        strLastLink = "Manage Menus";

        //  indicate = 'yes';
        $('#menuType').focus();
        /* For getting all published pages */
        getPublishedPage();
        /* For getting all portlet menu */
        //getAssignedPortletMenuList(0, 1);
        //   getAssignedMenuList(0, 1);


        /* For getting all bottom menu */
        getAssignedMenuList(0, 3);

        /* For getting all Top Menu */
        getAssignedMenuList(0, 2);

        /* For getting all home portlet */
        getAssignedMenuList(0, 5);

        /* For getting all Looking for menu */
        //getAssignedMenuList(0, 6);

        getTotalMenuRecords();
        $("#portletMenu").sortable({
            revert: true
        });
        $("#portletFooterMenu").sortable({
            revert: true
        });
        $("#mainMenu").sortable({
            revert: true
        });
        $("#bottomMenu").sortable({
            revert: true
        });
        $("#topMenu").sortable({
            revert: true
        });
        $("#homePortlet").sortable({
            revert: true
        });
        $("#lkMenu").sortable({
            revert: true
        });
        $("#portletMenu_lk").sortable({
            revert: true
        });
        if ('<?php echo $outMsg != '' ?>')
            viewAlert('<?php echo $outMsg; ?>');
        //Tooltip
        $('[data-rel=tooltip]').tooltip();
    });
    /* Function to add page to menu list */
    function addToList() {
        var allPageIds = $("#hdnFldForPageId").val();
        var menuType = $("#menuType").val();
        allPageIds = allPageIds.substring(1);
        var idArrs = allPageIds.split(',');
        var arrCount = idArrs.length;
        var flag = 0;
        var errflag = 0;
        // alert(menuType);
        for (var i = 0; i < arrCount; i++) {
            var poartlettotalCount = 0;
            var poartlettotalCountFooter = 0;
            var maintotalCount = 0;
            var totaltopCount = 0;
            var totalbtmCount = 0;
            var totalhomeCount = 0;
            var totallkCount = 0;
            var poartlettotalCount_lk = 0;
            if ($("#chkPageId" + idArrs[i]).is(':checked')) {
                flag++;
                var menuText = $("#pageNameById" + idArrs[i]).text();
                /* For main menu */
                if (menuType == 1) {
                    $(".poartletMenuClass").each(function() {

                        poartlettotalCount++;
                        var hdnVal = $(this).val();
                        var checkedVal = $("#chkPageId" + idArrs[i]).val();
                        if (hdnVal == checkedVal) {
                            errflag = 1;
                        }

                    });
                    if (errflag > 0) {
                        viewAlert('' + menuText + ' already exists under Main menu.');
                        $(".checkBoxForPage").removeAttr('checked');
                        return false;
                    } else {

                        var closeBtn = '<span style="float:right;cursor:pointer;padding:10px" data-rel="tooltip" data-original-title="Delete"><a href="#" onclick="removepoartletMenu(' + idArrs[i] + ');"><img src="<?php echo APP_URL; ?>img/close-btn.png" width="16" height="16" alt="Close" ></a></span>';
                        var hdnFld = '<input type="hidden" name="poartletMenuArr[]" id="hdnpoartletMenuId' + idArrs[i] + '" class="poartletMenuClass" value="' + idArrs[i] + '" />';
                        var menuItem = '<li class="dd-item dd-item_main" id="liId' + idArrs[i] + '" data-id="' + idArrs[i] + '">  <div class="row"><div class="dd-handle poartletMenuItem col-md-10" id="poartletMenuItem' + idArrs[i] + '"> ' + menuText + hdnFld + '</div><div class="col-md-1 pull-right" id="poartletMenuItemcls' + idArrs[i] + '">' + closeBtn + '</div> </div></li>';

                        $("#emptyTextpoartletMenu").remove();
                        $("#nestable").append(menuItem);
                        // alert(menuItem);
                    }
                }

                /* For top menu */
                else if (menuType == 2) {
                    $(".topMenuClass").each(function() {
                        //totalCount++;
                        totaltopCount++;
                        var hdnVal = $(this).val();
                        var checkedVal = $("#chkPageId" + idArrs[i]).val();
                        if (hdnVal == checkedVal) {
                            errflag = 1;
                        }

                    });

                    if (totaltopCount > 5) {
                        viewAlert('Maximum 5 Top menus can be added.');
                        return false;
                    } else if (errflag > 0) {
                        viewAlert('' + menuText + ' already exists under Top menu.');
                        return false;
                    } else {
                        var closeBtn = '<span style="float:right;cursor:pointer;"><img src="<?php echo APP_URL; ?>img/close-btn.png" width="16" height="16" alt="Close" title="Remove" onClick="removeFromTopMenu(' + idArrs[i] + ');"></span>';
                        var hdnFld = '<input type="hidden" name="topMenuArr[]" id="hdnTopMenuId' + idArrs[i] + '" class="topMenuClass" value="' + idArrs[i] + '" />';
                        var menuItem = '<div class="ui-sortable-handle topMenuItem" id="topMenuItem' + idArrs[i] + '">' + menuText + hdnFld + closeBtn + '</div>';
                        $("#emptyTextTopMenu").remove();
                        $("#topMenu").append(menuItem);

                    }
                }


                /* For bottom menu */
                else if (menuType == 3) {

                    $(".bottomMenuClass").each(function() {
                        totalbtmCount++;
                        var hdnVal = $(this).val();
                        var checkedVal = $("#chkPageId" + idArrs[i]).val();
                        if (hdnVal == checkedVal) {
                            errflag = 1;
                        }

                    });

                    if (totalbtmCount > 7) {
                        viewAlert('Maximum 7 buttom menus can be added.');
                        return false;
                    } else if (errflag > 0) {
                        viewAlert('' + menuText + ' already exists under Bottom menu.');
                        return false;
                    } else {
                        var closeBtn = '<span style="float:right;cursor:pointer;"><img src="<?php echo APP_URL; ?>img/close-btn.png" width="16" height="16" alt="Close" title="Remove" onClick="removeFromBottomMenu(' + idArrs[i] + ');"></span>';
                        var hdnFld = '<input type="hidden" name="bottomMenuArr[]" id="hdnBottomMenuId' + idArrs[i] + '" class="bottomMenuClass" value="' + idArrs[i] + '" />';
                        var menuItem = '<div class="ui-sortable-handle bottomMenuItem" id="bottomMenuItem' + idArrs[i] + '">' + menuText + hdnFld + closeBtn + '</div>';
                        $("#emptyTextBottomMenu").remove();
                        $("#bottomMenu").append(menuItem);

                    }
                }


                /* For Footer menu */
                if (menuType == 4) {
                    $(".poartletFooterMenuClass").each(function() {

                        poartlettotalCountFooter++;
                        var hdnVal = $(this).val();
                        var checkedVal = $("#chkPageId" + idArrs[i]).val();
                        if (hdnVal == checkedVal) {
                            errflag = 1;
                        }

                    });
                    if (errflag > 0) {
                        viewAlert('' + menuText + ' already exists under Footer menu.');
                        $(".checkBoxForPage").removeAttr('checked');
                        return false;
                    } else {

                        var closeBtn = '<span style="float:right;cursor:pointer;padding:10px;" data-rel="tooltip" data-original-title="Delete"><a href="#" onclick="removepoartletFooterMenu(' + idArrs[i] + ');"><img src="<?php echo APP_URL; ?>img/close-btn.png" width="16" height="16" alt="Close" ></a></span>';
                        var hdnFld = '<input type="hidden" name="poartletMenuFooterArr[]" id="hdnpoartletFooterMenuId' + idArrs[i] + '" class="poartletFooterMenuClass" value="' + idArrs[i] + '" />';
                        var menuItem = '<li class="dd-item dd-item_footer" id="liId' + idArrs[i] + '" data-id="' + idArrs[i] + '">  <div class="row"><div class="dd-handle poartletFooterMenuItem col-md-10" id="poartletFooterMenuItem' + idArrs[i] + '"> ' + menuText + hdnFld + '</div><div class="col-md-1 pull-right" id="poartletFooterMenuItemcls' + idArrs[i] + '">' + closeBtn + '</div> </div></li>';

                        $("#emptyTextpoartletMenu").remove();
                        $("#nestableFooter").append(menuItem);
                    }
                }


                /* For Looking for menu */
                /* else if (menuType == 6)
                {
                    $(".LkMenuClass").each(function () {
                        //totalCount++;
                        totallkCount++;
                        var hdnVal = $(this).val();
                        var checkedVal = $("#chkPageId" + idArrs[i]).val();
                        if (hdnVal == checkedVal)
                        {
                            errflag = 1;
                        }

                    });

                    if (totallkCount > 30)
                    {
                        viewAlert('Maximum 30 Looking For menus can be added.');
                        return false;
                    }
                    else if (errflag > 0)
                    {
                        viewAlert('' + menuText + ' already exists under Looking For Menu.');
                        return false;
                    }
                    else {
                        var closeBtn = '<span style="float:right;cursor:pointer;"><img src="<?php echo APP_URL; ?>img/close-btn.png" width="16" height="16" alt="Close" title="Remove" onClick="removeFromLkMenu(' + idArrs[i] + ');"></span>';
                        var hdnFld = '<input type="hidden" name="LkMenuArr[]" id="hdnLkMenuId' + idArrs[i] + '" class="LkMenuClass" value="' + idArrs[i] + '" />';
                        var menuItem = '<div class="ui-sortable-handle lkMenuItem" id="lkMenuItem' + idArrs[i] + '">' + menuText + hdnFld + closeBtn + '</div>';
                        $("#emptyTextLkMenu").remove();
                        $("#lkMenu").append(menuItem);

                    }
                }*/
                else if (menuType == 7) {
                    $(".poartletMenuClass_lk").each(function() {
                        //totalCount++;
                        poartlettotalCount_lk++;
                        var hdnVal = $(this).val();
                        var checkedVal = $("#chkPageId" + idArrs[i]).val();
                        if (hdnVal == checkedVal) {
                            errflag = 1;
                        }

                    });

                    if (errflag > 0) {
                        viewAlert('' + menuText + ' already exists under Looking for menu.');
                        $(".checkBoxForPage").removeAttr('checked');
                        return false;
                    } else {

                        var closeBtn = '<span style="float:right;cursor:pointer;" data-rel="tooltip" data-original-title="Delete"><a href="#" onclick="removepoartletMenu_lk(' + idArrs[i] + ');"><img src="<?php echo APP_URL; ?>img/close-btn.png" width="16" height="16" alt="Close" ></a></span>';
                        var hdnFld = '<input type="hidden" name="poartletMenuArr_lk[]" id="hdnpoartletMenuId_lk' + idArrs[i] + '" class="poartletMenuClass_lk" value="' + idArrs[i] + '" />';
                        var menuItem = '<li class="dd-item dd-item_lk" id="liId' + idArrs[i] + '" data-id="' + idArrs[i] + '">  <div class="dd-handle poartletMenuItem_lk" id="poartletMenuItem_lk' + idArrs[i] + '"> ' + menuText + hdnFld + '</div><div id="poartletMenuItemcls_lk' + idArrs[i] + '">' + closeBtn + '</div> </li>';

                        $("#emptyTextpoartletMenu_lk").remove();
                        $("#nestable_lk").append(menuItem);

                    }
                }

                showHideChkBox(menuType);
            }
        }
        if (flag == 0) {
            viewAlert('Please select record.');
        }
        $(".checkBoxForPage").removeAttr('checked');
    }


    /* For main menu */
    function removeFromMainMenu(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#mainMenuItem" + id).remove();
        showHideChkBox(2);
        displayEmptyText(2);
    }



    /* For Portlet menu */
    function removepoartletMenu(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#item_main" + id).remove();
        $("#poartletMenuItem" + id).remove();
        $("#poartletMenuItemcls" + id).remove();
        $("#poartletMainMenuItemrmv" + id).remove();
        $("#liId" + id).remove();
        showHideChkBox(1);
        displayEmptyText(1);
    }

    /* For Footer menu */
    function removepoartletFooterMenu(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#item_footer" + id).remove();
        $("#poartletFooterMenuItem" + id).remove();
        $("#poartletFooterMenuItemcls" + id).remove();
        $("#poartletFooterMenuItemrmv" + id).remove();
        $("#liId" + id).remove();
        showHideChkBox(4);
        displayEmptyText(4);
    }

    /* For Portlet menu */
    function removepoartletMenu_lk(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#poartletMenuItem_lk" + id).remove();
        $("#poartletMenuItemcls_lk" + id).remove();
        $("#liId" + id).remove();
        showHideChkBox(1);
        displayEmptyText(1);
    }



    function removeFrompoartletMenu(id, pageid, menuType) {
        if (!confirm("Are you sure to delete this record!"))
            return false;
        $('#hdnAction').val('DP');
        $('#hdnId').val(id);
        $('#hdnpageId').val(pageid);
        $('#hdnmenuType').val(menuType);
        // $('form').submit();
    }



    /* For bottom menu */
    function removeFromBottomMenu(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#bottomMenuItem" + id).remove();
        showHideChkBox(3);
        displayEmptyText(3);
    }

    /* For top menu */
    function removeFromTopMenu(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#topMenuItem" + id).remove();
        showHideChkBox(4);
        displayEmptyText(4);
    }

    /* For home portlet */
    function removeFromHomePortlet(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#homePortletItem" + id).remove();
        showHideChkBox(5);
        displayEmptyText(5);
    }
    /* For Looking for menu */
    function removeFromLkMenu(id) {
        if (!confirm('Are you sure to remove the menu'))
            return false;
        $("#lkMenuItem" + id).remove();
        showHideChkBox(6);
        displayEmptyText(6);
    }

    function validateMenus() {
        var arrMainMenu = new Array();
        var arrPortletMenu = new Array();
        var arrPortletFooterMenu = new Array();
        var arrBottomMenu = new Array();
        var arrTopMenu = new Array();
        var arrHomePortlet = new Array();
        var arrLkMenu = new Array();
        var arrPortletMenu_lk = new Array();
        var flag = 0;
        var totalCount = 0;
        var totalMenuRecord = $("#hdnTotalMenuRecords").val();
        if (totalMenuRecord == 0) {
            if ($('.clsPoartletMenu').css('display') == 'inline-block') {
                $('.clsPoartletMenu').attr('checked', 'checked');
            }

            if ($('.clsPoartletFooterMenu').css('display') == 'inline-block') {
                $('.clsPoartletFooterMenu').attr('checked', 'checked');
            }

            if ($('.clsMainMenu').css('display') == 'inline-block') {
                $('.clsMainMenu').attr('checked', 'checked');
            }
            if ($('.clsBottomMenu').css('display') == 'inline-block') {
                $('.clsBottomMenu').attr('checked', 'checked');
            }
            if ($('.clsTopMenu').css('display') == 'inline-block') {
                $('.clsTopMenu').attr('checked', 'checked');
            }
            if ($('.clsHomePortlet').css('display') == 'inline-block') {
                $('.clsHomePortlet').attr('checked', 'checked');
            }
            if ($('.clsLkMenu').css('display') == 'inline-block') {
                $('.clsLkMenu').attr('checked', 'checked');
            }
            /*For Looking for menu draggable By : indrani Biswas :: on: 12-01-2021*/
            if ($('.clsPoartletMenu_lk').css('display') == 'inline-block') {
                $('.clsPoartletMenu_lk').attr('checked', 'checked');
            }
        }
        if ($(".checkBoxClass").is(':checked')) {


            /* For main menu */
            if ($(".clsPoartletMenu").is(':checked')) {

                var arrMain = new Array();
                var parentVal = 0;
                var parentRank = 0;
                var childRank = 0;

                if ($(".poartletMenuClass").length > 0)

                {

                    $(".dd-item_main").each(function(e) {
                        var dataVal = $(this).attr("data-id");
                        var rank = 0;
                        // alert('dfghj');
                        //var checkedVal=0;
                        if ($("dd-item_main").has("dd-list")) {
                            // alert('dfghj');
                            var grandparent = $(this).parent().parent();

                            var grandparentId = grandparent.attr("data-id");
                            //alert(grandparentId);
                            if (typeof grandparentId == "undefined") {
                                grandparentId = 0;
                                parentRank++;
                                rank = parentRank;
                            } else {
                                grandparentId = grandparent.attr("data-id");
                                childRank++;
                                rank = childRank;
                            }
                        }

                        var custom_id = '1_' + dataVal + '_' + grandparentId + '_' + rank;
                        // alert(custom_id);
                        arrMain.push(custom_id);
                    });
                    $('#hdnMain').val(arrMain);
                }
                // 

                if ($(".poartletMenuClass").length > 0) {
                    var totalCount = 0;
                    $(".poartletMenuClass").each(function() {
                        totalCount++;

                        var hdnVal = $(this).val();
                        arrPortletMenu.push(hdnVal);
                    });
                    arrPortletMenu.sort();
                    var last = arrPortletMenu[0];
                    for (var i = 1; i < arrPortletMenu.length; i++) {
                        if (arrPortletMenu[i] == last) {
                            flag++;
                        }
                        last = arrPortletMenu[i];
                    }
                    //                if (totalCount > 7)
                    //                {
                    //                    alert('Maximum 7 main menus can be added.');
                    //                    return false;
                    //                }
                    //                    if (flag > 0)
                    //                    {
                    //                        alert('Duplicate menus added under main menu.');
                    //                        return false;
                    //                    }
                } else {
                    viewAlert('Please add page from list.');
                    return false;
                }
            }


            /* For Footer menu */
            if ($(".clsPoartletFooterMenu").is(':checked')) {

                var arrMainFooter = new Array();
                var parentVal = 0;
                var parentRank = 0;
                var childRank = 0;

                if ($(".poartletFooterMenuClass").length > 0)

                {

                    $(".dd-item_footer").each(function(e) {
                        var dataVal = $(this).attr("data-id");
                        var rank = 0;
                        // alert('dfghj');
                        //var checkedVal=0;
                        if ($("dd-item_footer").has("dd-list")) {
                            // alert('dfghj');
                            var grandparent = $(this).parent().parent();

                            var grandparentId = grandparent.attr("data-id");
                            //alert(grandparentId);
                            if (typeof grandparentId == "undefined") {
                                grandparentId = 0;
                                parentRank++;
                                rank = parentRank;
                            } else {
                                grandparentId = grandparent.attr("data-id");
                                childRank++;
                                rank = childRank;
                            }
                        }

                        var custom_id = '4_' + dataVal + '_' + grandparentId + '_' + rank;
                        // alert(custom_id);
                        arrMainFooter.push(custom_id);
                    });
                    $('#hdnMainFooter').val(arrMainFooter);
                }
                // 

                if ($(".poartletFooterMenuClass").length > 0) {
                    var totalCount = 0;
                    $(".poartletFooterMenuClass").each(function() {
                        totalCount++;

                        var hdnVal = $(this).val();
                        arrPortletFooterMenu.push(hdnVal);
                    });
                    arrPortletFooterMenu.sort();
                    var last = arrPortletFooterMenu[0];
                    for (var i = 1; i < arrPortletFooterMenu.length; i++) {
                        if (arrPortletFooterMenu[i] == last) {
                            flag++;
                        }
                        last = arrPortletFooterMenu[i];
                    }
                    //                if (totalCount > 7)
                    //                {
                    //                    alert('Maximum 7 main menus can be added.');
                    //                    return false;
                    //                }
                    //                    if (flag > 0)
                    //                    {
                    //                        alert('Duplicate menus added under main menu.');
                    //                        return false;
                    //                    }
                } else {
                    viewAlert('Please add page from list.');
                    return false;
                }
            }


            // }

            /* For main menu */
            if ($(".clsMainMenu").is(':checked')) {
                if ($(".mainMenuClass").length > 0) {
                    var totalCount = 0;
                    $(".mainMenuClass").each(function() {
                        totalCount++;
                        var hdnVal = $(this).val();
                        arrMainMenu.push(hdnVal);
                    });
                    arrMainMenu.sort();
                    var last = arrMainMenu[0];
                    for (var i = 1; i < arrMainMenu.length; i++) {
                        if (arrMainMenu[i] == last) {
                            flag++;
                        }
                        last = arrMainMenu[i];
                    }
                    if (totalCount > 7) {
                        viewAlert('Maximum 7 main menus can be added.');
                        return false;
                    }
                    if (flag > 0) {
                        viewAlert('Duplicate menus added under main menu.');
                        return false;
                    }
                } else {
                    viewAlert('Please add page from list.');
                    return false;
                }
            }

            /* For bottom menu */
            if ($(".clsBottomMenu").is(':checked')) {
                var totalCount = 0;
                if ($(".bottomMenuClass").length > 0) {
                    $(".bottomMenuClass").each(function() {
                        totalCount++;
                        var hdnVal = $(this).val();
                        arrBottomMenu.push(hdnVal);
                    });
                    arrBottomMenu.sort();
                    var last = arrBottomMenu[0];
                    for (var i = 1; i < arrBottomMenu.length; i++) {
                        if (arrBottomMenu[i] == last) {
                            flag++;
                        }
                        last = arrBottomMenu[i];
                    }
                    if (totalCount > 7) {
                        viewAlert('Maximum 7 bottom  menus can be added.');
                        return false;
                    }
                    if (flag > 0) {
                        viewAlert('Duplicate menus added under bottom menu.');
                        return false;
                    }
                } else {
                    viewAlert('Please add page from list.');
                    return false;
                }
            }

            /* For top menu */
            if ($(".clsTopMenu").is(':checked')) {
                var totalCount = 0;
                if ($(".topMenuClass").length > 0) {
                    $(".topMenuClass").each(function() {
                        totalCount++;
                        var hdnVal = $(this).val();
                        arrTopMenu.push(hdnVal);
                    });
                    arrTopMenu.sort();
                    var last = arrTopMenu[0];
                    for (var i = 1; i < arrTopMenu.length; i++) {
                        if (arrTopMenu[i] == last) {
                            flag++;
                        }
                        last = arrTopMenu[i];
                    }
                    if (totalCount > 5) {
                        viewAlert('Maximum 5 Top Menus can be added.');
                        return false;
                    }
                    if (flag > 0) {
                        viewAlert('Duplicate menus added under Top Menu.');
                        return false;
                    }
                } else {
                    viewAlert('Please add page from list.');
                    return false;
                }
            }

            /* For Looking for menu */
            if ($(".clsLkMenu").is(':checked')) {
                var totalCount = 0;
                if ($(".LkMenuClass").length > 0) {
                    $(".LkMenuClass").each(function() {
                        totalCount++;
                        var hdnVal = $(this).val();
                        arrLkMenu.push(hdnVal);
                    });
                    arrLkMenu.sort();
                    var last = arrLkMenu[0];
                    for (var i = 1; i < arrLkMenu.length; i++) {
                        if (arrLkMenu[i] == last) {
                            flag++;
                        }
                        last = arrLkMenu[i];
                    }
                    if (totalCount > 30) {
                        viewAlert('Maximum 30 Looking For Menus can be added.');
                        return false;
                    }
                    if (flag > 0) {
                        viewAlert('Duplicate menus added under Looking For Menu.');
                        return false;
                    }
                } else {
                    viewAlert('Please add page from list.');
                    return false;
                }
            }

            /*For Looking For menu with draggable By: Indrani :: ON: 12-01-2021*/
            if ($(".clsPoartletMenu_lk").is(':checked')) {
                var arrMain_lk = new Array();
                var parentVal = 0;
                var parentRank = 0;
                var childRank = 0;

                if ($(".poartletMenuClass_lk").length > 0) {

                    $(".dd-item_lk").each(function(e) {

                        var dataVal = $(this).attr("data-id");
                        var rank = 0;

                        if ($(".dd-item_lk").has("dd-list")) {
                            var grandparent = $(this).parent().parent();
                            var grandparentId = grandparent.attr("data-id");

                            if (typeof grandparentId == "undefined") {
                                grandparentId = 0;
                                parentRank++;
                                rank = parentRank;
                            } else {
                                grandparentId = grandparent.attr("data-id");
                                childRank++;
                                rank = childRank;
                            }
                        }

                        var custom_id = '7_' + dataVal + '_' + grandparentId + '_' + rank;
                        // alert(custom_id);
                        arrMain_lk.push(custom_id);
                    });
                    $('#hdnMain_lk').val(arrMain_lk);
                }

                if ($(".poartletMenuClass_lk").length > 0) {
                    var totalCount = 0;
                    $(".poartletMenuClass_lk").each(function() {
                        totalCount++;
                        var hdnVal = $(this).val();
                        arrPortletMenu_lk.push(hdnVal);
                    });
                    arrPortletMenu_lk.sort();
                    var last = arrPortletMenu_lk[0];
                    for (var i = 1; i < arrPortletMenu_lk.length; i++) {
                        if (arrPortletMenu_lk[i] == last) {
                            flag++;
                        }
                        last = arrPortletMenu_lk[i];
                    }

                } else {
                    viewAlert('Please add page from list.');
                    return false;
                }
            }



        } else {
            viewAlert('Please check menu');
            return false;
        }


    }
    /* For displaying empty text */
    function displayEmptyText(menuType) {
        /* For portlet menu */
        if (menuType == 1) {
            if ($(".poartletMenuClass").length > 0) {
                $("#emptyTextpoartletMenu").remove();
            } else {
                $("#portletMenu").html('<div id="emptyTextpoartletMenu" style="margin-left: 7px;">No menus assigned</div>');
            }
        }

        /* For Footer menu */
        if (menuType == 4) {
            if ($(".poartletFooterMenuClass").length > 0) {
                $("#emptyTextpoartletMenu").remove();
            } else {
                $("#portletFooterMenu").html('<div id="emptyTextpoartletMenu" style="margin-left: 7px;">No menus assigned</div>');
            }
        }

        /* For bottom menu */
        else if (menuType == 3) {
            if ($(".bottomMenuClass").length > 0) {
                $("#emptyTextBottomMenu").remove();
            } else {
                $("#bottomMenu").html('<div id="emptyTextBottomMenu" style="margin-left: 7px;">No menus assigned</div>');
            }
        }
        /* For top menu */
        else if (menuType == 2) {
            if ($(".topMenuClass").length > 0) {
                $("#emptyTextTopMenu").remove();
            } else {
                $("#topMenu").html('<div id="emptyTextTopMenu" style="margin-left: 7px;">No menus assigned</div>');
            }
        }
        /* For Looking For menu */
        /*else if (menuType == 6)
        {
            if ($(".LkMenuClass").length > 0)
            {
                $("#emptyTextLkMenu").remove();
            }
            else
            {
                $("#lkMenu").html('<div id="emptyTextLkMenu" style="margin-left: 7px;">No menus assigned</div>');
            }
        }*/
        /* For Looking For menu dragable */
        else if (menuType == 7) {
            if ($(".poartletMenuClass_lk").length > 0) {
                $("#emptyTextpoartletMenu_lk").remove();
            } else {
                $("#portletMenu_lk").html('<div id="emptyTextpoartletMenu_lk" style="margin-left: 7px;">No menus assigned</div>');
            }
        }

    }
    /* For show hide check box */
    function showHideChkBox(menuType) {
        /* For portlet menu */
        if (menuType == 1) {
            if ($(".poartletMenuClass").length > 0) {

                $("#chkPortletMenu").show();
            } else {
                $("#chkPortletMenu").hide();
            }
        }

        /* For Top menu */
        if (menuType == 2) {
            if ($(".topMenuClass").length > 0) {
                $("#chkTopMenu").show();
            } else {
                $("#chkTopMenu").hide();
            }
        }

        /* For Bottom menu */
        if (menuType == 3) {
            if ($(".bottomMenuClass").length > 0) {
                $("#chkBottomMenu").show();
            } else {
                $("#chkBottomMenu").hide();
            }
        }

        if (menuType == 4) {
            if ($(".poartletFooterMenuClass").length > 0) {

                $("#chkPortletFooterMenu").show();
            } else {
                $("#chkPortletFooterMenu").hide();
            }
        }

        /* For Looking For menu */
        /*if (menuType == 6)
        {
            if ($(".LkMenuClass").length > 0)
            {
                $("#chkLkMenu").show();
            }
            else
            {
                $("#chkLkMenu").hide();
            }
        }*/

        /* For Looking For menu draggable */
        if (menuType == 7) {
            if ($(".poartletMenuClass_lk").length > 0) {

                $("#chkPortletMenu_lk").show();
            } else {
                $("#chkPortletMenu_lk").hide();
            }
        }

    }
</script>

<div class="page-content">
    <div class="page-header">
        <h1 id="title"></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="srvc_hdr_nav " style="right:20px;">
                <input type="submit" name="btnPublishMenu" id="btnPublishMenu" value="Publish Menu" class="btn btn-sm btn-success" onClick="return validateMenus();" />
                <!--For Looking For menu with draggable By: Indrani :: ON: 12-01-2021-->
                <input type="hidden" name="hdnMain_lk" id="hdnMain_lk" />
                <input type="hidden" name="hdnMain" id="hdnMain" />
                <input type="hidden" name="hdnMainFooter" id="hdnMainFooter" />
                <input type="hidden" name="hdnAction" id="hdnAction" />
                <input type="hidden" name="hdnId" id="hdnId" />
                <input type="hidden" name="hdnpageId" id="hdnpageId" />
                <input type="hidden" name="hdnmenuType" id="hdnmenuType" />

            </div>
            <div class="clearfix"></div>


            <div class="top_tab_container"> <a href="javascript:void(0);" class="btn btn-info active">Global Link</a></div>
            <?php include('includes/util.php'); ?>
            <div class="hr hr-solid"></div>
            <input type="hidden" name="hdnFldForPageId" id="hdnFldForPageId" value="" />
            <input type="hidden" name="hdnTotalMenuRecords" id="hdnTotalMenuRecords" value="" />
            <div class="row margin-top10">
                <div class="col-lg-4  col-md-6 col-sm-6 col-xs-12 no-padding-right margin-bottom10">
                    <div class="innerPortlet">
                        <h4>Pages</h4>
                        <div class="menu-type-search">
                              Select Menu Type <select name="menuType" id="menuType" style="width:160px; margin-left:5px;" class="selectdrop">
                                <option value="1">Main Menu</option>
                                <option value="3">Bottom</option>
                                <option value="2">Top</option>
                                <option value="4">Footer Menu</option>
                                <!-- <option value="6">Looking For Menu</option> -->
                                <!-- <option value="7">Looking For Menu</option> -->
                            </select>
                        </div>
                        <div class="scrollable" id="scrollablePages">
                            <div id="pageListDiv" class="" style="margin:5px;"></div>
                        </div>
                        <div class="center">
                            <input type="button" name="btnAdd" id="btnAdd" onClick="return addToList();" style="margin:5px;" value="Add Menu" class="btn btn-sm btn-success" />
                        </div>
                    </div>
                </div>

                <!-- Top Menu -->
                <div class="col-lg-4  col-md-6  col-sm-6 col-xs-12 no-padding-right margin-bottom10">
                    <div class="innerPortlet">
                        <h4>
                            <input type="checkbox" name="chkTopMenu" id="chkTopMenu" value="2" class="clsTopMenu checkBoxClass" />
                            &nbsp;
                            Top Menu
                        </h4>
                        <div class="scrollable">
                            <div id="topMenu" class="ui-sortable"></div>
                        </div>
                    </div>
                </div>
                <!--End Top Menu -->

                <!-- Bottom Menu -->
                <div class="col-lg-4  col-md-6  col-sm-6  col-xs-12 no-padding-right margin-bottom10">
                    <div class="innerPortlet">
                        <h4>
                            <input type="checkbox" name="chkBottomMenu" id="chkBottomMenu" value="3" class=" clsBottomMenu checkBoxClass" />
                            &nbsp;
                            Bottom Menu
                        </h4>
                        <div class="scrollable">
                            <div id="bottomMenu" class="ui-sortable bottomMenu"></div>
                        </div>
                    </div>
                </div>
                <!-- End Bottom Menu -->

                <!-- Main Menu -->
                <div class="col-lg-5  col-md-6  col-sm-6  col-xs-12 no-padding-right margin-bottom10">
                    <div class="innerPortlet">
                        <h4>
                            <input type="checkbox" name="chkPortletMenu" id="chkPortletMenu" value="1" class="clsPoartletMenu checkBoxClass" />
                            &nbsp;
                            Main Menu
                        </h4>
                        <div class="scrollable">
                            <div class="col-sm-12">
                                <div class="dd nestable" id="nestable">
                                    <span id="portletMenu"> </span>
                                    <?php
                                    $res = $objGl->viewMenuList(1, 0);
                                    //echo $cnt =count($res);
                                    foreach ($res as $r) {
                                        echo  $r;
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main  Menu -->


                <!-- Footer Menu -->
                <div class="col-lg-5  col-md-6  col-sm-6  col-xs-12 no-padding-right margin-bottom10">
                    <div class="innerPortlet">
                        <h4>
                            <input type="checkbox" name="chkPortletFooterMenu" id="chkPortletFooterMenu" value="4" class="clsPoartletFooterMenu checkBoxClass" />
                            &nbsp;
                            Footer Menu
                        </h4>
                        <div class="scrollable">
                            <div class="col-sm-12">
                                <div class="dd nestable" id="nestableFooter">
                                    <span id="portletFooterMenu"> </span>
                                    <?php
                                    $res = $objGl->viewFooterMenuList(4, 0);
                                    //echo $cnt =count($res);
                                    foreach ($res as $r) {
                                        echo  $r;
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Footer  Menu -->


                <!--  <div class="col-lg-4  col-md-6  col-sm-6 col-xs-12 no-padding-right margin-bottom10">
                 <div class="innerPortlet">
                        <h4>                    
                           <input type="checkbox" name="chkLkMenu" id="chkLkMenu" value="6" class="clsLkMenu checkBoxClass" />
                            &nbsp;
                            Looking For Menu </h4>
                        <div class="scrollable">
                            <div id="lkMenu" class="ui-sortable"></div>
                        </div>
                </div>
            </div>  -->

                <!-- Looking For menu with draggable By: Indrani :: ON: 12-01-2021-->
                <!-- <div class="col-lg-4  col-md-6  col-sm-6 col-xs-12 no-padding-right margin-bottom10">
                    <div class="innerPortlet">
                        <h4>
                            <input type="checkbox" name="chkPortletMenu_lk" id="chkPortletMenu_lk" value="7" class="clsPoartletMenu_lk checkBoxClass" />
                            &nbsp;Looking For Menu
                        </h4>
                        <div class="scrollable">
                            <div class="col-sm-12">
                                <div class="dd nestable" id="nestable_lk">
                                    <span id="portletMenu_lk"> </span>
                                    <?php
                                    $res = $objGl->viewLkMenuList(7, 0);
                                    //echo $cnt =count($res);
                                    foreach ($res as $r) {
                                        echo  $r;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!--End  Looking For menu with draggable By: Indrani :: ON: 12-01-2021-->


            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.page-content -->

<script type="text/javascript" src="<?php echo APP_URL; ?>js/jquery.nestable.min.js"></script>
<script src="<?php echo APP_URL; ?>js/ace-elements.min.js" type="text/javascript"></script>
<script src="<?php echo APP_URL; ?>js/jqueryOrdering.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        // scrollables
        $('#scrollablePages').each(function() {
            var $this = $(this);
            $(this).ace_scroll({
                size: $this.data('size') || 239,
                //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
            });
        });
        $('.scrollable').each(function() {
            var $this = $(this);
            $(this).ace_scroll({
                size: $this.data('size') || 300,
                //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
            });
        });
    });
</script>

<script type="text/javascript">
    jQuery(function($) {

        $('.dd').nestable();

        // $('.dd-handle a').on('mousedown', function(e) {

        //     e.stopPropagation();
        // });

        // $('.dd-handle .chkbox').on('mousedown', function(e) {
        //     e.stopPropagation();
        // });
        // $('.dd-handle .txt').on('mousedown', function(e) {
        //     e.stopPropagation();
        // });



    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        // PAGE RELATED SCRIPTS
        setTimeout(function() {
            $('.dd').nestable();
        }, 500);

        var updateOutput = function(e) {
            var list = e.length ? e : $(e.target);
            //  console.log(list.data('output'));
            $(list).each(function(i) { //console.log(i);
                var output = list.data('output');
                //console.log(output);
                if (window.JSON) {
                    //console.log(window.JSON.stringify(list.nestable('serialize')));
                    //output.val(window.JSON.stringify(list.nestable('serialize')));
                    //, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            });
        };

        // activate Nestable for list 1
        $('#nestableFooter').nestable({
         group : 1
         }).on('change', updateOutput);

        $('.nestable').nestable({
            group: 1
        }).on('change', updateOutput);


        // output initial serialised data
        updateOutput($('.nestable').data('output', $('#nestable-output')));
        

    })
</script>