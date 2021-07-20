<?php
    /* ================================================
    File Name           : addGLInner.php
    Description     : This page is used to assign menus to global link.
    Author Name     : T Ketaki Debadarshini 
    Date Created        : 29-Aug-2015
    Update History      :
    <Updated by>        <Updated On>        <Remarks>

    Class Used      : 
    Functions Used      : webPath()
    ==================================================*/
    $objGl          = new clsGlobalLink;       
    $parentId       = 0;
    $linkType       = 'globalLink';
    $pageNavigation = '';
    
    $glId       = $_REQUEST['GL'];
    $plId       = $_REQUEST['PL'];
    $pageName   = $_REQUEST['PAGE'].'.php';
    $explPriv   = $objGl->checkPrivilege($_SESSION['adminConsole_userID'],$glId,$plId,$pageName,'V');
    $editPriv   = $explPriv['edit'];
    $deletePriv = $explPriv['delete'];
    $noAdd      = $explPriv['add']; 
    $noActive   = $explPriv['active'];
    $noPublish  = $explPriv['publish'];
    $portletRes     = $objGl->manageGL('V', 0, 0, 0, 1, 0, '', '');
    if(isset($_REQUEST['hdnAction']) && $_REQUEST['hdnAction']!='')
    {
        $strId      = $_REQUEST['hdnId'];
        $strAction  = $_REQUEST['hdnAction'];
        $strpageid  = $_REQUEST['hdnpageId'];
        $intMenuType  = $_REQUEST['hdnmenuType'];
        //echo $strId; exit;
        $outMsg         = $objGl->DeleteMenu($strAction,$strId,$strpageid,$intMenuType);     
    }

    /* For portlet menu */
    if(isset($_POST['chkPortletMenu']))
    {            
        $menuType = 1;
        $outMsg = $objGl->tagMenuList();
                    
    }

    /* For Footer menu */
    if(isset($_POST['chkPortletFooterMenu']))
    {            
        $menuType = 4;
        $outMsg = $objGl->tagFooterMenuList();
                    
    }

    /* For bottom menu */
        if(isset($_POST['chkBottomMenu']))
    {                       
        $menuType = 3;
        $outMsg  = $objGl->saveMenuItems($parentId,$menuType,$linkType,$pageNavigation);            
    }
        
    /* For top menu */
    if(isset($_POST['chkTopMenu']))
    {                      
        $menuType = 2;
        $outMsg  = $objGl->saveMenuItems($parentId,$menuType,$linkType,$pageNavigation);            
    }

    /* For Looking for menu 
    if(isset($_POST['chkLkMenu']))
    {                           
        $menuType = 6;
        $outMsg  = $objGl->saveMenuItems($parentId,$menuType,$linkType,$pageNavigation);   
    }*/

    /* For Looking For menu Draggable By: Indrani Biswas :: On: 12-01-2021 */
    if(isset($_POST['chkPortletMenu_lk']))
    {           
        $menuType = 7;
        $outMsg = $objGl->tagMenuList_lk();           
    }
