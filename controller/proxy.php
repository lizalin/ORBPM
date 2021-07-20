<?php
 /* ================================================
	File Name         	  : proxy.php
	Description		  : Manage Classbind in proxy	
	Date Created		  : 24-May-2016
	Designed By		  : Chinmayee    
	Update History		  :
	<Updated by>		<Updated On>		<Remarks>

	Javscript Functions   : 
	includes              : classBind.php

	==================================================*/

require ("classBind.php");
$objClassBind	= new clsClassPortal;
switch($_POST['method']){	  
    case "getTransportPortlet":            
            $objClassBind->getTransportPortlet();
    break;
    case "getCommercePortlet":            
            $objClassBind->getCommercePortlet();
    break;
    case "getImplink": 
            $objClassBind->getImplink($_POST['linkType']);
    break;
    case "getImpServices":            
            $objClassBind->getImpServices();
    break;
    case "getfooterScroll":            
            $objClassBind->getfooterScroll();
    break;
    case "getPageherf":            
            $objClassBind->getPageherf();
    break;
    case "getPageherf1":            
            $objClassBind->getPageherf1();
    break;
    case "getlogo":            
            $objClassBind->getlogo();
    break;
    case "gethomePageSlider":            
            $objClassBind->getBanners();
    break;
    case "getOffProfile":            
            $objClassBind->getOfficerProfile();
    break;
    case "getRouteNotification":            
            $objClassBind->getRouteNotification();
    break;
case "fillcircularSection":                    
        $objClassBind->fillcircularSection();
     break;
//===================Case for showing plugin at act rule By: Chinmayee On: 02-Jun-2016=================
    case "fillDirplugin":
    	$objClassBind->fillDirplugin();
    break;
    case "fillServiceCategory":
    	$objClassBind->fillServiceCategory();
    break;
    case "getComplainData":
    	$objClassBind->getComplainData();
    break;
    case "getComplainStatus":                                
    	$objClassBind->getComplainStatus($_POST['token'],$_POST['mobile']);
     break;
    case "getVechileData":                                
    	$objClassBind->getVechileData();
     break;
    case "getAssetData":                                
    	//$objClassBind->getAssetData();
     break;
    case "getTopRouteNotification":            
            $objClassBind->getTopRouteNotification();
    break;
	case "fillDistricts":            
                $objClassBind->fillDistricts();
    break;
    case "getmoreevents":
            $objClassBind->getmoreevents();
    break;
    case "getmorenews":
            $objClassBind->getmorenews();
    break; 
    case "viewCustomerReceiptModel":
            $objClassBind->viewCustomerReceiptModel();
    break; 
    case "viewCustomerReportModel":
            $objClassBind->viewCustomerReportModel();
    break; 
    case "getChartData":
            $objClassBind->getChartData();
    break;    
}

//comments1
?>
