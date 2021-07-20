<?php
 /* ================================================
	File Name         	  : proxy.php
	Description		  : This page is to manage AJAX requests	
	Date Created		  : 13-Aug-2015
	Designed By		  : T Ketaki Debadarshini 
	Update History		  :
	<Updated by>		<Updated On>		<Remarks>

	Javscript Functions   : 
	includes              : classBind.php

	==================================================*/

require ("classBind.php");
$objClassBind	= new clsClassBind;
switch($_POST['method']){    
    case "getAllUsers":
        $userId	= $_REQUEST['userId'];                
        $objClassBind->getAllUsers($userId);
    break;
    case "getPermission":
        $objClassBind->getPermission();
    break;
    case "getPublishedPage":            
            $objClassBind->getPublishedPage();
    break;    
    case "getAssignedMenuList":
            $parentId	= $_REQUEST['parentId'];
            $menuType	= $_REQUEST['menuType'];
           
            $objClassBind->getAssignedMenuList($parentId,$menuType);
    break;  
// get assigned portlet menu By: Chinmayee On: 20-May-2016
    case "getAssignedPortletMenuList":
            $parentId	= $_REQUEST['parentId'];
            $menuType	= $_REQUEST['menuType'];
          
            $objClassBind->getAssignedPortletMenuList($parentId,$menuType);
    break;
    case "getGlobalMenuList":
            $menuType	= $_REQUEST['menuType'];
            $linkType	= $_REQUEST['linkType'];
            $objClassBind->getGlobalMenuList($menuType,$linkType);
    break;
    case "getPageContent":
            $pageId	= $_REQUEST['PID'];                
            $objClassBind->getPageContent($pageId);
    break;
    case "deleteMenu":
        $pageId	= $_REQUEST['PID'];                
        $objClassBind->deleteMenu($pageId);
    break;
    case "deleteFromMainMenu":                
        $menuId	= $_REQUEST['menuId'];
        $pageId	= $_REQUEST['pageId'];
        $objClassBind->deleteFromMainMenu($menuId,$pageId);
    break;
    case "userVal":                    
        $objClassBind->fillUserDeatils();
    break;
     case "userProfile":                    
        $objClassBind->showUserDeatils();
     break;
  case "fillcircularSection":                    
        $objClassBind->fillcircularSection();
     break;
    case "getTotalMenuRecords":                                
    	$objClassBind->getTotalMenuRecords();
    break;
    case "content":                                
    	$objClassBind->showContent();
    break;
   case "redContent":                                
    	$objClassBind->readPageContent();
    break;
    case "getPage":
        $SelVal	= $_REQUEST['SelVal'];
    	$objClassBind->getPage($SelVal);
    break;
    case "getPrimary":
    	$objClassBind->fillPrimaryLink();
    break;
    case "viewPrimary":
    	$objClassBind->viewPrimaryLink();
    break;
    case "fillServiceCategory":
    	$objClassBind->fillServiceCategory();
    break;
//===================Case for filling Category for web-directory By Ashis Kumar Patra On 14-Oct-2016=================
    case "fillWebCategory":
    	$objClassBind->fillWebCategory();
    break;
    
//===================Case for showing feedBack Details By T Ketaki Debadarshini On 13-Aug-2015=================
    case "viewFeedBackDetails":
    	$objClassBind->viewFeedBackDetail();
    break;

//===================Case for showing Tender Details By T Ketaki Debadarshini On 13-Sept-2015=================
    case "getTenderDetails":                    
        $objClassBind->getTenderDetails();
    break;
    case "getCategory":
        $SelVal	= $_REQUEST['SelVal'];
    	$objClassBind->getCategory($SelVal);
    break;

//===================Case for showing Logo By Chinmayee On 18-Aug-2015=================
    case "getLogo":                    
        $objClassBind->getLogo();
    break;
    case "getCategoryname":
        $SelVal	= $_REQUEST['SelVal'];
    	$objClassBind->getCategoryname($SelVal);
    break;
     case "resetPassword":
        $userId	= $_REQUEST['userId'];
    	$objClassBind->resetPassword($userId);
    break;
    
    case "checkDuplicateUser": 
        $userId	     = $_REQUEST['userId'];
        $controlVal  = $_REQUEST['controlVal'];
        $flag	     = $_REQUEST['flag'];

        $objClassBind->checkDuplicateUser($userId,$controlVal,$flag); 
    break; 
    case "fillPlugins":
        
        //$SelVal	= $_REQUEST['SelVal'];
    	$objClassBind->fillPlugins();
    break;
    case "getPluginTypes":
            $funcId	= $_REQUEST['funcId'];                
            $objClassBind->getPluginTypes($funcId);
    break;
    case "fillLocation":                    
        $objClassBind->fillLocation();
    break;
    case "getDepartments":
            $intLocid	= $_REQUEST['intLocid'];                
            $objClassBind->getDepartments($intLocid);
    break;
    case "getDesignation":
            $intDeptid	= $_REQUEST['intDeptid'];                
            $objClassBind->getDesignation($intDeptid);
    break;
    case "fillTender":
    	$objClassBind->fillTender();
    break;
//===================Case for showing plugin at gallery By: Chinmayee On: 26-May-2016=================
    case "fillgalleryplugin":
    	$objClassBind->fillgalleryplugin();
    break;
    case "fillpluginCategory":
        $SelVal	= $_REQUEST['SelVal'];
    	$objClassBind->fillpluginCategory($SelVal);
    break;
//===================Case for showing plugin at gallery By: Chinmayee On: 27-May-2016=================
    case "fillNotifplugin":
    	$objClassBind->fillNotifplugin();
    break;
//===================Case for showing plugin at act rule By: Chinmayee On: 30-May-2016=================
    case "fillActplugin":
    	$objClassBind->fillActplugin();
    break;
//===================Case for showing plugin at act rule By: Chinmayee On: 30-May-2016=================
    case "fillDirplugin":
    	$objClassBind->fillDirplugin();
    break;
    case "redContentH":                                
    	$objClassBind->readPageContentH();
    break;
    case "fillRTOOfficeName":                                
    	$objClassBind->fillRTOOfficeName();
    break;
//====================Case for Showing Feedback By: Ajmal Akhtar On : 24-Dec-2020===========
    case "fillFeedback":
        $fid  = $_POST['fid'];
        $objClassBind->fillFeedback($fid);
    break;
//====================Case for Showing Compliment By: Ajmal Akhtar On : 24-Dec-2020=========
    case "fillCompliment":
        $cid  = $_POST['cid'];
        $objClassBind->fillCompliment($cid);
    break;    
   
}

?>
