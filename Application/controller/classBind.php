<?php

/* ================================================
  File Name         	  : classBind.php
  Description		  : Page to manage class bind.
  Date Created		  : 28-Aug-2015
  Designed By		  : T Ketaki Debadarshini 
  Update History		  :
  <Updated by>		<Updated On>		<Remarks>

  Javscript Functions   :
  includes              :

  ================================================== */
include_once("model/customModel.php");

class clsClassBind extends Model {
    
      /*
        Function to get all users
        By: T Ketaki Debadarshini 
        On: 03-Sep-2015
        */
	public function getAllUsers($userId)
	{            
            $data      = "<option value='0'>--Select--</option>";
            $selUserId = $userId;             
           // $sql       = "CALL USP_USER_PROFILE('XM',0,0,0,0,0,'','0','','','','','','','','','','','','','0',0,'0','0','0','0','0',@out);";
            $objUser   = new clsUserProfile;
            $result    = $objUser->manageUser('XM',0,0,0,0,0,'',0,'','','','','','','','','','','','',0,'0',0,0,0,0,0); 
            while($row = $result->fetch_array())
            {
                $userId     = $row['INT_ID'];
                $userName   = $row['VCH_FULL_NAME'];
                if($userId == $selUserId)
                    $selected = "selected";
                else                     
                    $selected = "";
                $data       .= '<option value="'.$userId.'" '.$selected.'>'.$userName.'</option>';
            }
            echo json_encode(array('result'=>$data));  
	}   
    
     /*
        Function to get users permission details
        By: T Ketaki Debadarshini 
        On: 03-Sep-2015
        */
	public function getPermission()
	{                    
            $objUser    = new clsUserProfile;
           // $result    = $objUser->manageUser('XM',0,0,0,0,0,'',0,'','','','','','','','','','','','',0,'0',0,0,0,0,0); 
            $userId     = $_REQUEST['userId'];
            $result     = '';
            $userRes    = $objUser->manageUser('R',$userId,0,0,0,0,'',0,'','','','','','','','','','','','',0,'0',0,0,0,0,0); 
            $userres	= mysqli_fetch_array($userRes);
            $useprivilege = $userres['INT_ADMIN_PRIVILEGE'];

          //  $permissionSql	= "CALL USP_USER_PERMISSION('DG','0','$userId','0','0','0','0','0','0','0','0',@out);";
           // $perResult		= $obj->ExecuteQuery($permissionSql);
            $objPermission    = new clsUserPermission;
            $perResult	= $objPermission->managePermission('DG','0',$userId,0,0,0,0,0,0,0,0);
            if(mysqli_num_rows($perResult)>0)
            {		
                while($perRow	= mysqli_fetch_array($perResult))
                {
                    $ctr	= 0;
                    $adminGl		= $perRow['GL_ID'];
                   // $adminPLSql		= "CALL USP_USER_PERMISSION('S','0','$userId','$adminGl','0','0','0','0','0','0','0',@out);";
                    $adminPLResult	= $objPermission->managePermission('S','0',$userId,$adminGl,0,0,0,0,0,0,0);;
                    if(mysqli_num_rows($adminPLResult)>0)
                    {
                        while($adminPLRow	= mysqli_fetch_array($adminPLResult))
                        {
                                $adminPL		= $adminPLRow['INT_PL_ID'];
                                $author			= $adminPLRow['INT_AUTHOR'];
                                $editor			= $adminPLRow['INT_EDITOR'];
                                $publisher		= $adminPLRow['INT_PUBLISHER'];
                                $manager		= $adminPLRow['INT_MANAGER'];
                                $privilege		= $adminPLRow['INT_PRIVILEGE'];
                                $result			.= $adminGl.','.$adminPL.','.$author.','.$editor.','.$publisher.','.$manager.','.$privilege.'[=]';										
                        }
                    }		
                }		
            }	
            $res= $useprivilege.'[==]'.$result;
           // echo $res;
            echo json_encode(array('result'=>$res));  
	}   
    /*
    Function to fill all circularSectors.
    By: sonali
    On: 29-sept-2016
    */
        public function fillcircularSection() { 
	$selVal 	        = $_REQUEST['SID'];
        
        $sql	                = "CALL USP_CIRCULAR_MASTER('RC',0,0,'', @OUT)";
        $result = Model::executeQry($sql);
        //print_r($result);
        $opts = '<option value="0">--Select--</option>';
        
        if ($result->num_rows > 0) {
            while ($Row = $result->fetch_array()) {
				$intNodeId = $Row["intCircularId"];
                $intValueId = $Row["intmId"];
                $strValueName = $Row["vchCirculaName"];
                
                
                $select = ($intValueId == $selVal) ? 'selected="selected"' : '';
                $opts .= '<option value="' . $intValueId . '" title="' . $strValueName . '" ' . $select . '>' . $strValueName . '</option>';
            }
        }
        //echo(json_encode($opts));
        echo json_encode(array('circulars' => $opts));
    }
     /*
    Function to fill all circularSectors.
    By: sonali
    On: 29-sept-2016
    */
        public function fillServiceCategory() { 
	$selVal 	        = $_REQUEST['SID'];
        
        $sql	                = "CALL USP_SERVICE_MASTER('RA',0,'', @OUT)";
        $result = Model::executeQry($sql);
        //print_r($result);
        $opts = '<option value="0">--Select--</option>';
        
        if ($result->num_rows > 0) {
            while ($Row = $result->fetch_array()) {
		
                $intValueId = $Row["intCatId"];
                $strValueName = $Row["vchService"];
                
                
                $select = ($intValueId == $selVal) ? 'selected="selected"' : '';
                $opts .= '<option value="' . $intValueId . '" title="' . $strValueName . '" ' . $select . '>' . $strValueName . '</option>';
            }
        }
        //echo(json_encode($opts));
        echo json_encode(array('serviceCategory' => $opts));
    }
    /*
      Function to get published page.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */

    public function getPublishedPage() {
        $data = '';
        $ids = '';
        
        $objPages        = new clsPages;
        $result = $objPages->managePage('PL','0','','','','',0,'','0','','','',0,0,0,0,'0000-00-00','0000-00-00','','','','','','','0','',0);
        while ($row = mysqli_fetch_array($result)) {
            $pageId = $row['intPageId'];
            $pageTitle = htmlspecialchars_decode($row['vchTitle'], ENT_NOQUOTES);
            $data .= '<div class="published-list" id="pageNameById' . $pageId . '">';
            $data .= '<input type="checkbox" name="chkPageName[]" id="chkPageId' . $pageId . '" class="checkBoxForPage" value="' . $pageId . '" />';
            $data .= '  ' . $pageTitle;
            $data .= '</div>';

            $ids .= ',' . $pageId;
        }
        $result = $data . '~::~' . $ids;

        echo json_encode(array('result' => $result));
    }

    /*
      Function to get published page.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */

    public function getAssignedMenuList($parentId, $menuType) {
        $data = '';
        $closeBtn = '';
        $divId = '';
      // echo $menuType;
        $objPages        = new clsGlobalLink;
        $result          = $objPages->manageGL('V',0,0,$parentId, $menuType, 0, '', '');
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $menuId = $row['intId'];
                $pageId = $row['intPageId'];
                $pageTitle = htmlspecialchars_decode($row['vchTitle'], ENT_NOQUOTES);
                /* For Portlet menu */
                if ($menuType == 1) { 
                    
                    $onChangeFunction = 'onclick="deleteFromPortetMenu('.$menuId.','.$pageId.');"';    
                    $divId            = 'poartletMenuItem' . $pageId . '';
                    $divClasss        = 'dd-handle poartletMenuItem';
		    $hdnFld           = '<input type="hidden" name="poartletMenuArr[]" id="hdnpoartletMenuId' . $pageId . '" class="poartletMenuClass" value="' . $pageId . '">';
                    $closeBtn         = '<span style="float:right;cursor:pointer;" data-rel="tooltip" data-original-title="Delete" title=""><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" '.$onChangeFunction.'"></span>';
                    $data .= '<li class="dd-item" data-id="'. $pageId . '">  <div class="'.$divClasss.'" id="poartletMenuItem' . $pageId . '"> ' . $pageTitle . $hdnFld . $closeBtn . '</div> </li>';  
                }
//                

                

                /* For bottom menu */  if ($menuType == 3) {
                    $divId = 'bottomMenuItem' . $pageId . '';
                     $divClass    = 'ui-sortable-handle bottomMenuItem';
                    $hdnFld = '<input type="hidden" name="bottomMenuArr[]" id="hdnBottomMenuId' . $pageId . '" class="bottomMenuClass" value="' . $pageId . '">';
                    $closeBtn = '<span style="float:right;cursor:pointer;"  data-rel="tooltip" data-original-title="Delete" title=""><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" onclick="removeFromBottomMenu(' . $pageId . ');deleteMenu(' . $menuId . ');"></span>';
                   $data .= '<div class="'.$divClass.'" id="' . $divId . '">' . $pageTitle . $hdnFld . $closeBtn . '</div>';
                    }

                /* For top menu */ else if ($menuType == 2) {
                    $divId = 'topMenuItem' . $pageId . '';
                     $divClass    = 'ui-sortable-handle topMenuItem';
                    $hdnFld = '<input type="hidden" name="topMenuArr[]" id="hdnTopMenuId' . $pageId . '" class="topMenuClass" value="' . $pageId . '">';
                    $closeBtn = '<span style="float:right;cursor:pointer;"  data-rel="tooltip" data-original-title="Delete" title=""><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" onclick="removeFromTopMenu(' . $pageId . ');deleteMenu(' . $menuId . ');"></span>';
                    $data .= '<div class="'.$divClass.'" id="' . $divId . '">' . $pageTitle . $hdnFld . $closeBtn . '</div>';   
                    }
//
//                /* For home portlet */  if ($menuType == 4) {
//                    $divId       = 'homePortletItem' . $pageId . '';
//                    $divClass    = 'ui-sortable-handle homePortletItem';
//                    $hdnFld = '<input type="hidden" name="homePortletArr[]" id="hdnHomePortletId' . $pageId . '" class="homePortletClass" value="' . $pageId . '">';
//                    $closeBtn = '<span style="float:right;cursor:pointer;" data-rel="tooltip" data-original-title="Delete" title=""><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" onclick="removeFromHomePortlet(' . $pageId . ');deleteMenu(' . $menuId . ');"></span>';
//                    $data .= '<div class="'.$divClass.'" id="' . $divId . '">' . $pageTitle . $hdnFld . $closeBtn . '</div>';
//                }

                /* For Looking for menu */ else if ($menuType == 6) {
                    $divId = 'lkMenuItem' . $pageId . '';
                     $divClass    = 'ui-sortable-handle lkMenuItem';
                    $hdnFld = '<input type="hidden" name="LkMenuArr[]" id="hdnLkMenuId' . $pageId . '" class="LkMenuClass" value="' . $pageId . '">';
                    $closeBtn = '<span style="float:right;cursor:pointer;"  data-rel="tooltip" data-original-title="Delete" title=""><img src="' . APP_URL . 'img/close-btn.png" width="16" height="16" alt="Close" onclick="removeFromLkMenu(' . $pageId . ');deleteMenu(' . $menuId . ');"></span>';
                    $data .= '<div class="'.$divClass.'" id="' . $divId . '">' . $pageTitle . $hdnFld . $closeBtn . '</div>';   
                    }
            }
        } else
            {
            
              /* For portlet menu */
                    if($menuType == 1)
                        $data = '<div id="emptyTextpoartletMenu" style="margin-left: 7px;">No menus assigned</div>';
                    
                                    /* For bottom menu */
                    else if($menuType == 3)
                       $data = '<div id="emptyTextBottomMenu" style="margin-left: 7px;">No menus assigned</div>';
                    
                    /* For top menu */
                    else if($menuType == 2)
                        $data = '<div id="emptyTextTopMenu" style="margin-left: 7px;">No menus assigned</div>';
                    
                    /* For home portlet */
                    else if($menuType == 5)
                        $data = '<div id="emptyTextHomePortlet" style="margin-left: 7px;">No menus assigned</div>';

                    /* For Looking for menu */
                    else if($menuType == 6)
                        $data = '<div id="emptyTextLkMenu" style="margin-left: 7px;">No menus assigned</div>';
                    
            }

        echo json_encode(array('result' => $data));
    }
    
    
    
    
    
      /*
      Function to get published page.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */

    public function getAssignedPortletMenuList($parentId, $menuType) {
        $data = '';
        $closeBtn = '';
        $divId = '';
      // echo $menuType;
        $objPages        = new clsGlobalLink;
        $result          = $objPages->manageGL('V',0,0,$parentId, $menuType, 0, '', '');
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $menuId = $row['intId'];
                $pageId = $row['intPageId'];
                $pageTitle = htmlspecialchars_decode($row['vchTitle'], ENT_NOQUOTES);
                 
            }
        } else
            {
            
              /* For portlet menu */
                    if($menuType == 1)
                        $data = '<div id="emptyTextpoartletMenu" style="margin-left: 7px;">No menus assigned</div>';
         
            }

        echo json_encode(array('result' => $data));
    }
    
    
    
    

    /*
      Function to get global/SSA and RSMA menu  page.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */

    public function getGlobalMenuList($menuType, $linkType) {
        $data = '';
      
        $objPages        = new clsGlobalLink;
        $result = $objPages->manageGL('VA',0,0,0, $menuType, 0, $linkType, '');
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $pageId = $row['intPageId'];
                $pageTitle = htmlspecialchars_decode($row['vchTitle'], ENT_NOQUOTES);
                $data .= '<option value="' . $pageId . '">' . $pageTitle . '</option>';
            }
        } else {
             $data = '<div class="center">No menus assigned</div>';
        }
        echo json_encode(array('result' => $data));
    }

    /*
      Function to delete Menu.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */

    public function deleteMenu($id) {
        $data = '';
        $objPages        = new clsGlobalLink;
        $result          = $objPages->manageGL('D',$id,0,0, 0, 0, 0,'');
    }
/*
        Function to delete main Menu.
        By: T Ketaki Debadarshini 
        On: 31-Aug-2015
        */
        public function deleteFromMainMenu($menuId,$pageId) 
        {            
            $objPages        = new clsGlobalLink;
            $result = $objPages->manageGL('R',0,0,$pageId, 0, 0, 0,'');
            
            $row    = mysqli_fetch_array($result);
            $total  = $row['TOTAL'];
            if($total > 0)
            {
                echo json_encode(array('result'=>1));
            }
            else
            {
                $this->deleteMenu($menuId);
                echo json_encode(array('result'=>2));
            }
        }
        
        
        /*
        Function to delete main Menu.
        By: T Ketaki Debadarshini 
        On: 31-Aug-2015
        */
        public function deleteFromPortetMenu($menuId,$pageId) 
        {            
            $objPages        = new clsGlobalLink;
            $result = $objPages->manageGL('R',0,0,$pageId, 0, 0, 0,'');
            
            $row    = mysqli_fetch_array($result);
            $total  = $row['TOTAL'];
            if($total > 0)
            {
                echo json_encode(array('result'=>1));
            }
            else
            {
                $this->deleteMenu($menuId);
                echo json_encode(array('result'=>2));
            }
        }
        
     /*
        Function to get total menu records.
        By: T Ketaki Debadarshini 
        On: 31-Aug-2015
        */
        public function getTotalMenuRecords() 
        {                    
            $objPages        = new clsGlobalLink;
            $result = $objPages->manageGL('CN',0,0,0,0,0,0,'');
            
            $row    = mysqli_fetch_array($result);
            $total  = $row['TOTAL'];
            echo json_encode(array('result'=>$total));
        }
    /*
      Function to Display Page content.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */

    public function getPageContent($id) {
        $arrList = array();
        $pageArr = array();
       
        $objPages        = new clsPages;
        $result = $objPages->managePage('R',$id,'','','',0,'','0','','','',0,0,0,0,'0000-00-00','0000-00-00','','','','','','','0','',0);
        while ($row = mysqli_fetch_array($result)) {
            $pageArr['titelE'] = htmlspecialchars_decode($row['vchTitle_E'], ENT_QUOTES);
            $pageArr['titleH'] = htmlspecialchars_decode($row['vchTitle_H'], ENT_QUOTES);
            $pageArr['contentE'] = htmlspecialchars_decode(str_replace('&quot;','"',$row["vchPageContent_E"]),ENT_NOQUOTES);
            $pageArr['ContentH'] = htmlspecialchars_decode($row['vchPageContent_H'], ENT_QUOTES);
            array_push($arrList, $pageArr);
        }
        echo(json_encode($arrList));
    }
      
  
	
/*
      Function to show Page Content.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */
	public function showContent()
	{
		$objPage			= new clsPages;
		$pageId				= $_REQUEST['PID'];
                $pageNo				= $_REQUEST['PNO'];
		$result				= $objPage->viewPageContent($pageId,$pageNo);
                //echo 'sss';
		echo json_encode(array('content'=>$result));
	}
     /*
      Function to Read Page Content.
      By: T Ketaki Debadarshini 
      On: 31-Aug-2015
     */
	public function readPageContent()
	{
		$objPage			= new clsPages;
		$pageId				= $_REQUEST['PID'];
		$result				= $objPage->readPageContent($pageId);
		echo json_encode(array('contentResult'=>$result));
	}
    
		public function readPageContentH()
	{
		$objPage			= new clsPages;
		$pageId				= $_REQUEST['PID'];
		$result				= $objPage->managePageContent('V2',0,$pageId,0,'','','');
                $arrRow = array();
                if($result->num_rows>0)
                {
                    $ctr	= 0;
                    while($row=$result->fetch_array())
                    {
                        $arrRow[$ctr]['intContentId']	= $row['intContentId'];
                        $arrRow[$ctr]['intPageId']		= $row['intPageId'];
                        $arrRow[$ctr]['intPageNo']		= $row['intPageNo'];
                        $arrRow[$ctr]['strContent']		= htmlspecialchars_decode(str_replace('&quot;','"',$row["vchContentH"]),ENT_NOQUOTES); 
                        $ctr++;
                    }
                }
                echo json_encode(array('contentResultH'=>$arrRow));     
		
	}
       
        /*Function to show page details 
		By: T Ketaki Debadarshini
		On: 31-Aug-2015
	 */
         public function getPage($selVal) {
           
            $objPages        = new clsPages;
            $result = $objPages->managePage('PL','0','','','',0,'','0','','','',0,0,0,0,'0000-00-00','0000-00-00','','','','','','','0','',0);
            
            $opt	= '<option value="0">--Select--</option>';
            $opt	.= '<option value="H">Home</option>';
            if(mysqli_num_rows($result)>0)
            {							
                    while($row	= mysqli_fetch_array($result))
                    {
                            $intPageId	= $row["intPageId"];
                            $strPageName	= ucwords(strtolower (htmlspecialchars_decode($row["vchTitle_E"],ENT_QUOTES)));
                            $select		= ($intPageId==$selVal)?'selected="selected"':'';
                            $opt .= '<option value="'.$intPageId.'" title="'.$strPageName.'" '.$select.'>'.$strPageName.'</option>';
                    }				
            }
            $link_arr["pagename"] = $opt;
            echo json_encode(array('page'=>$link_arr));
         }
         /*Function to fill Primary Link 
		By: T Ketaki Debadarshini
		On: 31-Aug-2015
	 */
         public function fillPrimaryLink()
	{
		$objGL	= new  clsGlobalLink();
		$selVal		= $_REQUEST['selVal'];
                $glID		= $_REQUEST['glID'];
		$result		= $objGL->fillPrimaryLink($glID,$selVal);
		echo json_encode(array('plLink'=>$result));
	}
        /*Function to fill Primary Link 
		By: T Ketaki Debadarshini
		On: 31-Aug-2015
	 */
         public function viewPrimaryLink()
	{
		$objGL	= new  clsGlobalLink();
                $glID		= $_REQUEST['glID'];
		$result		= $objGL->viewPL($glID);
		echo json_encode(array('plLinkVal'=>$result));
	}
        /*Function to View FeedBack Detail
               By: T Ketaki Debadarshini
               On: 31-Aug-2015
        */
        public function viewFeedBackDetail()
        { 
            $feeBackId		= (isset($_REQUEST['FID']) && $_REQUEST['FID']>0)?$_REQUEST['FID']:0;
            $objFeedBack	= new ClsMangePortalFeedBack();
            $result		= $objFeedBack->viewFeedBack('V', $feeBackId, '0', '');
            $Subject		= $result[0]['strSubject'];
            $Message		= $result[0]['strMessage'];
            $Remark		= $result[0]['strRemarks'];
            $remarkDate		= date("d-M-Y",strtotime($result[0]['strUpdatedOn']));
            echo json_encode(array('strSubject'=>$Subject,'strMessage'=>$Message,'strRemark'=>$Remark,'remarkDate'=>$remarkDate));
        }
       
     
	
	
        /*
        Function to Display Tender content.
        By: T Ketaki Debadarshini
        On: 14-Sept-2015
       */
	public function getTenderDetails()
	{
            $objTender			= new clsTender;
            $tenderId			= $_REQUEST['ID'];
            $result			= $objTender->readTender($tenderId);
            echo json_encode(array('tender'=>$result));
	}
      
      
        /*Function to show Category details 
		By: Chinmayee
		On: 27-May-2016
	 */

              public function getCategory($SelVal) {
             
            $intType	= $_REQUEST['selType']; 
            $objGallerycat	= new clsGalleryCategory();
            
           // echo $sql;
           $result = $objGallerycat->manageGalleryCategory('F',0,$intType,0,'','','','',0,0);
         
           $opt	= '<option value="0">--Select--</option>';
           
            if($result->num_rows>0)
            {               
                while($row	= $result->fetch_array())
                {
                    
                    $intCatId	= $row["INT_PLUGIN_TYPE"];
                   
                    $strCatNameE	= Model::getName('vchTitle','t_pages','intPageId',$intCatId,'bitDeletedFlag');
                   

                    $select		= ($intCatId==$SelVal)?'selected="selected"':'';

                    $opt .= '<option value="'.$intCatId.'" title="'.$strCatNameE.'" '.$select;
                   
                    $opt .= '>'.$strCatNameE.'</option>';

                }
                
            }
           
            echo json_encode(array('category'=>$opt));
         } 

         
 /*
     Function to get home page logo.
     Created by     : T Ketaki Debadarshini
     Created On     : 31-Aug-2015
 */   

    
     public function getLogo() { 
    
           $objLogo	= new clsLogo();
           $result	= $objLogo->manageLogo('V',0,'','','','','',0,0,0,0);
            
           $row	= mysqli_fetch_array($result);            
           $data       = '<img height="80" src="'.APP_URL.'uploadDocuments/Logo/'.$row['VCH_IMAGE'].'" alt="'.$row['VCH_LOGO_TITLE'].'" title="'.$row['VCH_LOGO_TITLE'].'" class="pull-left" />';  
          
            echo json_encode(array('result'=>$data));

        }

        /*
            Function to check Duplicate User Id/EMail-Id.
            By: T Ketaki Debadarshini
            On: 31-Aug-2015
           */

          public function checkDuplicateUser($userId,$contrlval,$flag) {

               $objUser			= new clsUserProfile;
              if($flag==1) //1 for user id, 2- for Email-id
                $result                 = $objUser->manageUser('S',$userId,0,0,0,0,'','0','','','','','','','','','','',$contrlval,'','0',0,'0','0','0','1','0'); 
              else
                $result                 = $objUser->manageUser('S',$userId,0,0,0,0,'','0','','','','','','','','',$contrlval,'','','','0',0,'0','0','0','1','0'); 

              $data           = mysqli_num_rows($result);
//echo $sql;
           
              echo json_encode(array('result' =>$data));
          }
         
        
         
          /*
            Function to change the password 
            By: T Ketaki Debadarshini
            On: 21-Aug-2015
           */
            public function resetPassword($userId)
            {
                $objUser	        = new clsMangeUsers;
                
                $randompwd = bin2hex(openssl_random_pseudo_bytes(4));
                $encrypted_pass     = md5($randompwd);
                $result			= $objUser->manageUsers('UPW',$userId,'','','','','','',$encrypted_pass,0,0,0);
                if(mysqli_num_rows($result)>0)
                {							
                        while($row	= mysqli_fetch_array($result))
                        {
                            $arr['intuserId']	= $row["INT_USER_ID"];
                            $arr['strEmailid']	= $row["VCH_EMAIL"];
                            $arr['strPassword']	= $randompwd;
                            
                             if(sendMail==Y)
                              {
                                $MailMessageuser='';
                                $Subjectuser    = "Change Password .";
                                $strTo          = $arr['strEmailid'];
                                $strFrom	= portalEmail;
                                $MailMessageuser.= "Your Password has been changed. Find your Log-in Details below </br>";
                                $MailMessageuser.="<div>";
                                $MailMessageuser.="<strong>User-id &nbsp; &nbsp; &nbsp; : </strong>";
                                $MailMessageuser.=$arr['strEmailid']."<br/>";
                                $MailMessageuser.="<strong>Password &nbsp; &nbsp; &nbsp; : </strong>";
                                $MailMessageuser.=$randompwd."<br/>";
                                $MailMessageuser.="</div>";
                                //Mail to user
                                Model::Sendmail($strFrom,$strTo,$Subjectuser,$MailMessageuser);
                                 
                             }
                        }				
                }
                echo json_encode(array('user'=>$arr));
            }
            
       /*Function to fill Plugins
		By: T Ketaki Debadarshini
		On: 09-Sept-2015
	 */
         public function fillPlugins()
	    {
            $objPL	= new  clsAdminLinksnew;
            $result	= $objPL->manageAdminPLinks('VPL',0,0,'','');
            $count      = mysqli_num_rows($result);
            
            $arrList        = array();
            $pageArr        = array();
            
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    
                     $pageArr['intplId']  = $row['INT_ID']; 
                    $pageArr['intfunId'] = $row['INT_FN_ID'];
                    $pageArr['strplName']  = htmlspecialchars_decode($row['VCH_NAME'], ENT_NOQUOTES);
                    
                    array_push($arrList, $pageArr);
                }
            } 
            echo (json_encode(array('plLinkVal'=>$arrList)));
            
	    }
        
       /*Function to fill Plugin types
		By: T Ketaki Debadarshini
		On: 09-Sept-2015
	 */
         public function getPluginTypes($funcId)
	{
            $objPlugin	= new clsPlugin;
            $result	= $objPlugin->managePlugin('FNT',0,$funcId,0,'','',0,0,0,'0000-00-00','0000-00-00');
            $count      = mysqli_num_rows($result);
            
            $arrList        = array();
            $pageArr        = array();
            
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    
                    $pageArr['intsubCatId']  = $row['INT_SUBCAT_ID']; 
                    $pageArr['intfunId'] = $row['INT_FN_ID'];
                    $pageArr['strsubcatName']  = htmlspecialchars_decode($row['VCH_SUBCATEGORY'], ENT_NOQUOTES);
                    
                    array_push($arrList, $pageArr);
                }
            } 
            echo(json_encode(array('fnCategory'=>$arrList)));
            
	} 
        
        /*Function to fill location details
		By: T Ketaki Debadarshini
		On: 10-Sept-2015
	 */
         public function fillLocation()
	{
            $objLoc	= new clsLocation;
            $result	= $objLoc->manageLocation('V',0,'','','',0);
            $count      = mysqli_num_rows($result);
            
            $arrList        = array();
            $pageArr        = array();
            
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    
                    $pageArr['intLocId']  = $row['INT_LOCATION_ID']; 
                    $pageArr['strLocName']  = htmlspecialchars_decode($row['VCH_LOCATION'], ENT_NOQUOTES);                   
                    array_push($arrList, $pageArr);
                }
            } 
            echo(json_encode(array('result'=>$arrList)));
            
	}
         /*Function to fill Department details
		By: T Ketaki Debadarshini
		On: 11-Sept-2015
	 */
         public function getDepartments($intLocid)
	{
            $objDept	= new clsDepartment;
            $result	= $objDept-> manageDepartment('V',0,$intLocid,'','','',0,0);          
            $count      = mysqli_num_rows($result);
            
            $arrList        = array();
            $pageArr        = array();
            
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    
                    $pageArr['intDeptId']  = $row['INT_DEPARTMENT_ID']; 
                    $pageArr['strDeptName']  = htmlspecialchars_decode($row['VCH_DEPARTMENT_NAME'], ENT_NOQUOTES);                   
                    array_push($arrList, $pageArr);
                }
            } 
            echo(json_encode(array('result'=>$arrList)));
            
	}
        
      /*Function to fill Designation details
		By: T Ketaki Debadarshini
		On: 11-Sept-2015
	 */
         public function getDesignation($intDeptid)
	{
            $objDesg	= new clsDesignation;
            $result	= $objDesg->manageDesignation('V',0,0,$intDeptid,'','',0,0);         
            $count      = mysqli_num_rows($result);
            
            $arrList        = array();
            $pageArr        = array();
            
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    
                    $pageArr['intDesgId']  = $row['INT_DESIGNATION_ID']; 
                    $pageArr['strDesgName']  = htmlspecialchars_decode($row['VCH_DESIGNATION_NAME'], ENT_NOQUOTES);                   
                    array_push($arrList, $pageArr);
                }
            } 
            echo(json_encode(array('result'=>$arrList)));
            
	}  
        
        /*Function to fill Tender No
		By: T Ketaki Debadarshini
		On: 14-Sept-2015
	 */
         public function fillTender()
	{
            $objTender	= new clsTender;
            $tenderId	= $_REQUEST['tenderId'];
            $tenderType	= $_REQUEST['tenderType']; //0-addendum, 1-corrigdnm
            if($tenderId=='')
                $tenderId=0;
            $result	= $objTender->manageTender('V',$tenderId,'','','0000-00-00','0000-00-00','','','','','','',0,0,0,$tenderType,0,'','','','','','');      
            $count      = mysqli_num_rows($result);
            
            $arrList        = array();
            $pageArr        = array();
            
            if ($count > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    
                    $pageArr['intTenderId']  = $row['INT_TENDER_ID']; 
                    $pageArr['strTenderno']  = htmlspecialchars_decode($row['VCH_REF_NO'], ENT_NOQUOTES);   
                    $pageArr['strHeadline']  = htmlspecialchars_decode($row['VCH_HEAD_LINE_E'], ENT_NOQUOTES);   
                    $pageArr['strOpeningDate']  =  date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_OPENING_DATETIME'],ENT_NOQUOTES)));
                    $pageArr['strClosingDate']	= date("d-m-Y",strtotime(htmlspecialchars_decode($row['DTM_CLOSING_DATETIME'],ENT_NOQUOTES)));
                    $pageArr['strOpeningTime']	= date("h:i A",strtotime(htmlspecialchars_decode($row['DTM_OPENING_DATETIME'],ENT_NOQUOTES)));
                    $pageArr['strClosingTime'] 	= date("h:i A",strtotime(htmlspecialchars_decode($row['DTM_CLOSING_DATETIME'],ENT_NOQUOTES)));
                    
                    $pageArr['strDescription']	= htmlspecialchars_decode($row['VCH_DESCRIPTION_E'],ENT_NOQUOTES);
                    $pageArr['strAddendumFile']	= $row['VCH_ADDENDUM_FILE'];
                    $pageArr['strAddendumFile2']	= $row['VCH_ADDENDUM_FILE2'];
                    $pageArr['strAddendumFile3']	= $row['VCH_ADDENDUM_FILE3'];
                    
                    $pageArr['strCorrigdmFile']         = $row['VCH_CORRIGENDUM_FILE'];
                    $pageArr['strCorrigdmFile2']	= $row['VCH_CORRIGENDUM_FILE2'];
                    $pageArr['strCorrigdmFile3']	= $row['VCH_CORRIGENDUM_FILE3'];
                    
                    array_push($arrList, $pageArr);
                }
            } 
            echo(json_encode(array('result'=>$arrList)));
            
	}  
     
            /*
        Function to get the pages of gallery plugin
        By: Chinmayee
        On: 26-May-2016
        */
	public function fillgalleryplugin()
	{   
            $selplugin =$_REQUEST['selplugin'];
            $data      = "<option value='0'>--Select--</option>";
            $objUser   = new clsPages;
            $result    = $objUser->managePage('V', 0, '', '', '', 0, '', 0, '', '', '', 0, 0, 0,0,'0000-00-00','0000-00-00','','','','','','','0','',15); 
            while($row = $result->fetch_array())
            {
                $pageId     = $row['intPageId'];
                $pageName   =  htmlspecialchars_decode($row["vchTitle"],ENT_NOQUOTES);
                 if($pageId == $selplugin)
                    $selected = "selected";
                else                     
                    $selected = "";
                $data       .= '<option value="'.$pageId.'"'.$selected.' >'.$pageName.'</option>';
            }
            echo json_encode(array('result'=>$data));  
	}  
     /*Function to show Category details 
		By: Chinmayee
		On: 27-May-2016
	 */

            public function fillpluginCategory($selVal) {
            $intType	= $_REQUEST['SelVal']; 
            //$pluginType	= $_REQUEST['selplgin'];
            $objGallerycat	= new clsGalleryCategory();
           // echo $intType.','.$pluginType;
           
           $result = $objGallerycat->manageGalleryCategory('FA',0,$intType,0,'','','','',0,0);
           $opt	= '<option value="0">--Select--</option>';
           
            if($result-> num_rows >0)
            {               
                while($row	= $result->fetch_array())
                {
                    $intCatId	= $row["INT_CATEGORY_ID"];
                   
                    $strCatNameE	= htmlspecialchars_decode($row["VCH_CATEGORY_NAME"],ENT_NOQUOTES);
                   

                    $select		= ($intCatId==$selVal)?'selected="selected"':'';

                    $opt .= '<option value="'.$intCatId.'" title="'.$strCatNameE.'" '.$select;
                   
                    $opt .= '>'.$strCatNameE.'</option>';

                }
                
            }
           
            echo json_encode(array('category'=>$opt));
         }    
         
         
         
                     /*
        Function to get the pages of gallery plugin
        By: Chinmayee
        On: 26-May-2016
        */
	public function fillNotifplugin()
	{   
            $selplugin =$_REQUEST['selplugin'];
            $data      = "<option value='0'>--Select--</option>";
            $objUser   = new clsPages;
            $result    = $objUser->managePage('V', 0, '', '', '','', 0, '', 0, '', '', '', 0, 0, 0,0,'0000-00-00','0000-00-00','','','','','','','0','',3); 
            while($row = $result->fetch_array())
            {
                $pageId     = $row['intPageId'];
                $pageName   =  htmlspecialchars_decode($row["vchTitle"],ENT_NOQUOTES);
                 if($pageId == $selplugin)
                    $selected = "selected";
                else                     
                    $selected = "";
                $data       .= '<option value="'.$pageId.'"'.$selected.' >'.$pageName.'</option>';
            }
            echo json_encode(array('result'=>$data));  
	} 
         
                         /*
        Function to get the pages of Act rule plugin
        By: Chinmayee
        On: 30-May-2016
        */
	public function fillActplugin()
	{   
            $selplugin =$_REQUEST['selplugin'];
            $data      = "<option value='0'>--Select--</option>";
            $objUser   = new clsPages;
            $result    = $objUser->managePage('V', 0, '', '', '', '', 0, '', 0, '', '', '', 0, 0, 0,0,'0000-00-00','0000-00-00','','','','','','','0','',2); 
                               
            while($row = $result->fetch_array())
            {
                $pageId     = $row['intPageId'];
                $pageName   =  htmlspecialchars_decode($row["vchTitle"],ENT_NOQUOTES);
                 if($pageId == $selplugin)
                    $selected = "selected";
                else                     
                    $selected = "";
                $data       .= '<option value="'.$pageId.'"'.$selected.' >'.$pageName.'</option>';
            }
            echo json_encode(array('result'=>$data));  
	}     
         
                             /*
        Function to get the pages of Directory plugin
        By: Chinmayee
        On: 30-May-2016
        */
	public function fillDirplugin()
	{   
            $selplugin =$_REQUEST['selplugin'];
            $data      = "<option value='0'>--Select--</option>";
            $objUser   = new clsDircategory;
            $result    = $objUser->manageDircategory('V', 0, '', 0, '', 0,2);
            while($row = $result->fetch_array())
            {
                $pageId     = $row['intcatId'];
                $pageName   =  htmlspecialchars_decode($row["vchcatName"],ENT_NOQUOTES);
                 if($pageId == $selplugin)
                    $selected = "selected";
                else                     
                    $selected = "";
                $data       .= '<option value="'.$pageId.'"'.$selected.' >'.$pageName.'</option>';
            }
            echo json_encode(array('result'=>$data));  
	}     
              
     /*
    Function to fill Web-directory-Category.
    By: Ashis Kumar Patra
    On: 14-Oct-2016
    */
        public function fillWebCategory() { 
	$selVal 	        = $_REQUEST['SID'];
        
        $sql	                = "CALL USP_DIRECTORY_CATEGORY('RC',0,'','',0,0,2,@OUT)";
        $result = Model::executeQry($sql);
        //print_r($result);
        $opts = '<option value="0">--Select--</option>';
        $intCategory=0;
        if ($result->num_rows > 0) {
            while ($Row = $result->fetch_array()) {
	
                $intValueId = $Row["intCatId"];
                $strValueName = $Row["vchCatName"];
                
                
                $select = ($intValueId == $selVal) ? 'selected="selected"' : '';
                $opts .= '<option  value="' . $intValueId . '" title="' . $strValueName . '" ' . $select . '>' . $strValueName . '</option>';
            }
        }
        //echo(json_encode($opts));
        echo json_encode(array('webCategory' => $opts));
    }
    
    /*
     * Function to fill RTOOffice Name
     * By:shweta Choudhury
     * On:27-oct-2017
     */
        public function fillRTOOfficeName()
	{       
            $selVal 	        = $_REQUEST['id'];
            $status 	        = $_REQUEST['status'];
            if($status==1)
            {
                $data      = "<option value='0'>--All--</option>";
            }
            else {
                $data      = "<option value='0'>--Select--</option>";
            }
            $objRto    = new clsAuctionNotice;
           
            $result    = $objRto->manageAuctionNotice('RT',0,0,0,0,0,0,0,'','','','','','','','0000-00-00','0000-00-00',0,0,0,0,0);
            while($row = $result->fetch_array())
            {
                 //print_r($row);
            
                $officeId     = $row['INT_M_ID'];
                $officeName   = $row['VCH_RTO_OFFICENAME'];
               if($officeId == $selVal)
                    $selected = "selected";
                else                     
                    $selected = "";
                
                $data       .= '<option value="'.$officeId.'" '.$selected.'>'.$officeName.'</option>';
            }
            echo json_encode(array('result'=>$data));  
	}

     /*     Function to Get Feedback Data
            By : Ajmal Akhtar
            On : 24-12-2020
    */
     public function fillFeedback($fid)
      {
     
      $res    = (Model::executeQry('Select INT_FEEDBACK_ID, VCH_NAME, VCH_EMAIL, VCH_MOBILENO, VCH_SUBJECT, VCH_FEEDBACK from t_user_feedback  Where  INT_FEEDBACK_ID="'.$fid.'"'));
      $result = $res->fetch_array();
      $div    = '<div class="form-group" >';
      $name = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext" value="'.$result['VCH_NAME'].'">
            </div>
        </div>';
        
      $email = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">E-mail</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext"  value="'.$result['VCH_EMAIL'].'" >
            </div>
        </div>';

      $mobile = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Phone No.</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext"  value="'.$result['VCH_MOBILENO'].'">
            </div>
        </div>';

      $subject = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Subject</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext"  value="'.$result['VCH_SUBJECT'].'" >
            </div>
        </div>';

      $feedback = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">FeedBack</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <textarea class="form-control-plaintext" row="5" readonly>'.$result['VCH_FEEDBACK'].'</textarea>
            </div>
        </div>';
        $div .= '</div>';

        $data = "<div style='border: 15px solid skyblue;padding: 40px;margin: 10px;'>".$name.$email.$mobile.$subject.$feedback."</div>";
            
          echo json_encode(array('status'=>'ok','result'=> $data));
       
  }

  /*  Function to Get Compliment Data
      By : Ajmal Akhtar
      On : 24-12-2020
 */
     public function fillCompliment($cid)
      { 
        $res    = (Model::executeQry('Select intId, vchName, vchPhoneNo, vchEmail, intRadVal, dtmCreatedOn,vchCompliment from t_compliment  Where  intId="'.$cid.'"'));
      $result = $res->fetch_array();
      $intRadVal = $result['intRadVal'];
      if($intRadVal == '1'){
      $div    = '<div class="form-group" >';
      $date = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Date</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext" value="'.date("d-M-Y",strtotime($result['dtmCreatedOn'])).'">
            </div>
        </div>';
        $div .= '</div>';
      $name = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext" value="'.$result['vchName'].'">
            </div>
        </div>';
      $mobile = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Phone No.</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext"  value="'.$result['vchPhoneNo'].'">
            </div>
        </div>';       
      $email = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">E-mail</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext"  value="'.$result['vchEmail'].'" >
            </div>
        </div>';
      $Compliment = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Compliment</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <textarea class="form-control-plaintext" row="5" readonly>'.$result['vchCompliment'].'</textarea>
            </div>
        </div>';
        $data = "<div style='border: 15px solid skyblue;padding: 40px;margin: 10px;'>".$date.$name.$mobile.$email.$Compliment."</div>";       
      }else if($intRadVal == '2')
      {
       $div    = '<div class="form-group" >';
      $date = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Date</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <input type="text" readonly class="form-control-plaintext" value="'.date("d-M-Y",strtotime($result['dtmCreatedOn'])).'">
            </div>
        </div>';
        $div .= '</div>';      
        $Compliment = '<div class="form-group row">
            <label class="col-sm-4 col-form-label">Compliment</label>
            <div class="col-sm-8"> <span class="colon">:</span>
                <textarea class="form-control-plaintext" row="5" readonly>'.$result['vchCompliment'].'</textarea>
            </div>
        </div>';
        $data = "<div style='border: 15px solid skyblue;padding: 40px;margin: 10px;'>".$date.$Compliment."</div>";          
      }
          echo json_encode(array('status'=>'ok','result'=> $data));        
  }


}

?>