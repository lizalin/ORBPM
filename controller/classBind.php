<?php
/* ================================================
  File Name         	  : classBind.php
  Description		  : Page to manage class bind.
  Date Created		  : 24-May-2016
  Designed By		  : Chinmayee 
  Update History          :
  <Updated by>		<Updated On>		<Remarks>

  Javscript Functions   :
  includes              :

  ================================================== */
include_once("Application/model/customModel.php");
//include "Application/controller/controller.php";
class clsClassPortal extends Model {
   
    
     /*
            Function to get portlet menu for transport
            Created by     : Chinmayee
            Created On     : 24-May-2016
        */   
        public function getTransportPortlet()
        { 
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
           $objtrMenu	    = new clsGlobalLink();
           $result	    = $objtrMenu->manageGL('VP', 0, 0, 2, 1, 0, '', '');
           $totalTrmenu     = $result->num_rows;
           $arrList         = array();
           $pageArr         = array();
           if($totalTrmenu>0)
            {
                $cnt=0;
                while($TrRow	= $result-> fetch_array())
                {
                    $cnt++;
                  $pageArr['intPageId']          = $TrRow['intPageId']; 
                  $pageArr['vchName']            = htmlspecialchars_decode($TrRow['vchName'], ENT_NOQUOTES);
                  $pageArr['vchNameO']            = htmlspecialchars_decode($TrRow['vchNameO'], ENT_NOQUOTES);
                  $pageArr['vchUrl']             = htmlspecialchars_decode($TrRow['vchUrl'], ENT_NOQUOTES);
                  $pageArr['pageName']           = htmlspecialchars_decode($TrRow['pageName'], ENT_NOQUOTES);
                  $pageArr['vchTitle']           = htmlspecialchars_decode($TrRow['vchTitle'], ENT_NOQUOTES);
                  $pageArr['intLinkType']        = $TrRow['intLinkType'];
                  $pageArr['intTemplateType']    = $TrRow['intTemplateType'];
                  $pageArr['intWindowStatus']    = $TrRow['intWindowStatus'];
                  $pageArr['iconClass']          = $TrRow['vchMetaImage'];
                  $pageArr['anchorClass']        = $TrRow['vchFeaturedImage'];
                  $pageArr['cildid']             = $TrRow['cildid'];
                 
                   array_push($arrList, $pageArr);
                }
            }
            }   
            echo json_encode(array('result'=>$arrList));

        }
    
     /*
            Function to get portlet menu for commerce
            Created by     : Chinmayee
            Created On     : 24-May-2016
        */   
        public function getCommercePortlet()
        { 
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
           $objtrMenu	    = new clsGlobalLink();
           $result	    = $objtrMenu->manageGL('VP', 0, 0, 1, 1, 0, '', '');
           $totalTrmenu     = $result->num_rows;
           $arrList         = array();
           $pageArr         = array();
           if($totalTrmenu>0)
            {
                $cnt=0;
                while($TrRow	= $result-> fetch_array())
                {
                    $cnt++;
                  $pageArr['intPageId']          = $TrRow['intPageId']; 
                  $pageArr['vchName']            = htmlspecialchars_decode($TrRow['vchName'], ENT_NOQUOTES);
                  $pageArr['vchNameO']            = htmlspecialchars_decode($TrRow['vchNameO'], ENT_NOQUOTES);
                  $pageArr['vchUrl']             = htmlspecialchars_decode($TrRow['vchUrl'], ENT_NOQUOTES);
                  $pageArr['pageName']           = htmlspecialchars_decode($TrRow['pageName'], ENT_NOQUOTES);
                  $pageArr['vchTitle']           = htmlspecialchars_decode($TrRow['vchTitle'], ENT_NOQUOTES);
                  $pageArr['intLinkType']        = $TrRow['intLinkType'];
                  $pageArr['intTemplateType']    = $TrRow['intTemplateType'];
                  $pageArr['intWindowStatus']    = $TrRow['intWindowStatus'];
                  $pageArr['iconClass']          = $TrRow['vchMetaImage'];
                  $pageArr['anchorClass']        = $TrRow['vchFeaturedImage'];
                  $pageArr['cildid']             = $TrRow['cildid'];
                 
                   array_push($arrList, $pageArr);
                }
            }
               }
            echo json_encode(array('result'=>$arrList));

        }
    
        
         /*
            Function to get portlet menu for commerce
            Created by     : Chinmayee
            Created On     : 24-May-2016
        */   
        public function getPageherf()
        {  
           $pageid          = $_REQUEST['id'];
           //echo $pageid;
           $objtrMenu	    = new clsGlobalLink();
           $result	    = $objtrMenu->manageGL('VC', 0, 0, $pageid, 1, 0, '', '');
           $totalTrmenu     = $result->num_rows;
           $arrList         = array();
           $pageArr         = array();
           if($totalTrmenu>0)
            {
                $cnt=0;
                while($TrRow	= $result-> fetch_array())
                {
                    $cnt++;
                  $pageArr['intPageId']          = $TrRow['intPageId']; 
                  $pageArr['vchName']            = htmlspecialchars_decode($TrRow['vchName'], ENT_NOQUOTES);
                  $pageArr['vchUrl']             = htmlspecialchars_decode($TrRow['vchUrl'], ENT_NOQUOTES);
                  $pageArr['pageName']           = htmlspecialchars_decode($TrRow['pageName'], ENT_NOQUOTES);
                  $pageArr['vchTitle']           = htmlspecialchars_decode($TrRow['vchTitle'], ENT_NOQUOTES);
                  $pageArr['intLinkType']        = $TrRow['intLinkType'];
                  $pageArr['intTemplateType']    = $TrRow['intTemplateType'];
                                           
                   array_push($arrList, $pageArr);
                }
            }
            echo json_encode(array('result'=>$arrList));

        }  
        
               /*
            Function to get portlet menu for commerce
            Created by     : Chinmayee
            Created On     : 24-May-2016
        */   
        public function getPageherf1()
        {  
           $pageid          = $_REQUEST['id'];
           //echo $pageid;
           $objtrMenu	    = new clsGlobalLink();
           $result	    = $objtrMenu->manageGL('VC', 0, 0, $pageid, 1, 0, '', '');
           $totalTrmenu     = $result->num_rows;
           $arrList         = array();
           $pageArr         = array();
           if($totalTrmenu>0)
            {
                  $TrRow	                 = $result-> fetch_array();
                  $pageArr['intPageId']          = $TrRow['intPageId']; 
                  $pageArr['vchName']            = htmlspecialchars_decode($TrRow['vchName'], ENT_NOQUOTES);
                  $pageArr['vchUrl']             = htmlspecialchars_decode($TrRow['vchUrl'], ENT_NOQUOTES);
                  $pageArr['pageName']           = htmlspecialchars_decode($TrRow['pageName'], ENT_NOQUOTES);
                  $pageArr['vchTitle']           = htmlspecialchars_decode($TrRow['vchTitle'], ENT_NOQUOTES);
                  $pageArr['intLinkType']        = $TrRow['intLinkType'];
                  $pageArr['intTemplateType']    = $TrRow['intTemplateType'];
                  $pageArr['intWindowStatus']    = $TrRow['intWindowStatus'];
                           
                   array_push($arrList, $pageArr);
               
            }
            echo json_encode(array('Pageherfresult'=>$arrList));

        }  
        
          /*Function to show External link details on home page
		By: Chinmayee
		On: 24-05-2016	
	 */
         public function getImplink($linkType) {
            $objLink         = new clsLink;
            $arrList         = array();
            $pageArr         = array();
            switch ($linkType) {
                case 1:
                 $result  = $objLink->manageLink('V', 0, '', '', '','', 2,0, 0,0,1,'');

                    break;
                case 2:
                 $result  = $objLink->manageLink('V', 0, '', '', '','', 2,0, 0,0,2,'');

                    break;
                case 3:
                 $result  = $objLink->manageLink('V', 0, '', '', '','', 2,0, 0,0,3,'');

                    break;
                case 4:
                 $result  = $objLink->manageLink('V', 0, '', '', '','', 2,0, 0,0,4,'');
                    break;

                default:
                    break;
            }
            //$result  = $objLink->manageLink('V', 0, '', '', '','', 2,0, 0,0,3,''); 
            //manageLink('V',0,$strHeadlineE,'','','',0,0,0,0,$strlinkcatType,'');
            if($result->num_rows>0) 
            {	
                $Links           = ($_SESSION['languageType']=='O')?'Govt. Driving Training School':'Govt. Driving Training School';
                $cnt=0;
                while($row	= $result->fetch_array())
                {   
                    //print_r($row); exit;
                    $cnt++;
                    $pageArr['intLinkId']         = $row["intLinkId"];
                    $strLinkNameE	= htmlspecialchars_decode($row["vchLinkNameE"],ENT_QUOTES);
                    $strLinkNameO	= htmlspecialchars_decode($row["VchLinknameH"],ENT_QUOTES);
                    $pageArr['vchUrl']     	= $row["vchUrl"];
                    $pageArr['vchimg']     	= $row["vchImage"];
                    $pageArr['vchDocument']    	= $row["vchDocument"];
                    
                    $strLinkName        = ($_SESSION['languageType']=='O' && $strLinkNameO!='')?$strLinkNameO:$strLinkNameE;
                    $lanclass           = ($_SESSION['languageType']=='O' && $strLinkNameO!='' )?'akrutiorisarala':'';
                    $pageArr['strLinkName']    	= $strLinkName;
                    $pageArr['lanclass']    	= $lanclass;
                array_push($arrList, $pageArr);
                }				
            }
          
            echo json_encode(array('govtLinks'=>$arrList));
         } 
         
         /*Function to show Important Services Link
		By: Ashis Kumar Patra
		On: 07-Oct-2016	
	 */
      
         public function getImpServices() {
            $objLink        = new clsImpServices;
            $arrList         = array();
            $pageArr         = array();
            $pageArr1        = array();
            $result  = $objLink->manageImpServices('V',0,0,'','','','','','',0,2,0,0);
            $totrows    = $result->num_rows;
            $divideRows = ceil($totrows/2);
            $ctr=0;
            $count = 0;
            $count2 = 0;
            //manageLink('V',0,$strHeadlineE,'','','',0,0,0,0,$strlinkcatType,'');
           if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {

                    if($ctr < $divideRows){
                    $pageArr[$count]['intServiceId']         = $row["intServiceId"];
                    $strHeadlineE	= htmlspecialchars_decode($row["vchServiceNameE"],ENT_QUOTES);
                    $strHeadlineO	= htmlspecialchars_decode($row["vchServiceNameO"],ENT_QUOTES);
                    $pageArr[$count]['strUrl']     	= $row["vchUrl"];
                    $pageArr[$count]['strDocument']    	= $row["vchDocument"];
                    
                    $strLinkName        = ($_SESSION['languageType']=='O' && $strHeadlineO!='')?$strHeadlineO:$strHeadlineE;
                    $lanclass           = ($_SESSION['languageType']=='O' && $strHeadlineO!='' )?'akrutiorisarala':'';
                    $pageArr[$count]['strLinkName']    	= ucfirst($strLinkName);
                    $pageArr[$count]['lanclass']    	= $lanclass;  
                    //array_push($arrList, $pageArr);
                    $count++;
                    }
                    if($ctr >= $divideRows){
                   $pageArr1[$count2]['intServiceId']         = $row["intServiceId"];
                    $strHeadlineE	= htmlspecialchars_decode($row["vchServiceNameE"],ENT_QUOTES);
                    $strHeadlineO	= htmlspecialchars_decode($row["vchServiceNameO"],ENT_QUOTES);
                    $pageArr1[$count2]['strUrl']     	= $row["vchUrl"];
                    $pageArr1[$count2]['strDocument']    	= $row["vchDocument"];
                    
                    $strLinkName        = ($_SESSION['languageType']=='O' && $strHeadlineO!='')?$strHeadlineO:$strHeadlineE;
                    $lanclass           = ($_SESSION['languageType']=='O' && $strHeadlineO!='' )?'akrutiorisarala':'';
                   $pageArr1[$count2]['strLinkName']    	= ucfirst($strLinkName);
                   $pageArr1[$count2]['lanclass']    	= $lanclass;  
                    //array_push($arrList, $pageArr1);
                    $count2++;
                    }
                     $ctr++;

                }
                $arrList['first']		= $pageArr;
                $arrList['second']		= $pageArr1;
                //echo count($arrList['first']).count($arrList['second']);
             }
          
            echo json_encode(array('govtImpService'=>$arrList));
         } 
           
          /*Function to show logo
		By: Chinmayee
		On: 01-06-2016	
	 */
         public function getlogo() {
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
             
            $obj             = new clsLogo;
            $result          = $obj->manageLogo('VA', 0, '','','','','', 0,0,0,0,0);
            $arrList         = array();
            $pageArr         = array();
            if($result->num_rows>0)
            {	
                while($row	= $result->fetch_array())
                {
                    $pageArr['strlogoName']	= htmlspecialchars_decode($row["VCH_LOGO_TITLE"],ENT_QUOTES);
                    $pageArr['vchhomelogo']	= $row["VCH_IMAGE_H"];
                 array_push($arrList, $pageArr);        
                }				
            }
               }
           
            echo json_encode(array('result'=>$arrList));
         }  
        
        
        
        
        
        
        
  
    
    
         /*
        Function to get Banner Images.
        Created by     : Chinmayee
        Created On     : 01-Jun-2016	
      */
        public function getBanners() {
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
            $arrList        = array();
            $pageArr        = array();

            $objBnr        = new clsBanner;
            $bannerResult  = $objBnr->manageBanner('V',0,0,'',2,0);
               // return $result;        
            $totalResult = mysqli_num_rows($bannerResult);            

            if($totalResult > 0)            
            {   

                while ($row = mysqli_fetch_array($bannerResult)) {
                    $pageArr['strImage']         = $row['VCH_IMAGE']; 
                    $pageArr['strCaption']       =  htmlspecialchars_decode($row['VCH_CAPTIONS'], ENT_QUOTES);

                    array_push($arrList, $pageArr);

                } 

            } 
               }
            echo(json_encode(array('banner'=>$arrList)));
         }
        
          /*Function to show gallery Category details 
		By: T Ketaki Debadarshini
		On: 16-Sept-2015	
	 */
         public function fillCategory() {
                             $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
             
            $objBnr        = new clsGalleryCategory;
            $result  = $objBnr->manageGalleryCategory('V',0,'','',2,0);
          
            $arrList= array();
            if(mysqli_num_rows($result)>0)
            {							
                while($row	= mysqli_fetch_array($result))
                {
                    $pageArr['intCatId']	= $row["INT_CATEGORY_ID"];
                    $pageArr['strCatName']	= htmlspecialchars_decode($row["VCH_CATEGORY_NAME"],ENT_QUOTES);
                   
                    array_push($arrList, $pageArr);
                }				
            }
               }
            
            echo json_encode(array('category'=>$arrList));
         }  
         
        
    
         /*
        Function to get Gallery Images.
        By: T Ketaki Debadarshini
        On: 16-Sept-2015	
      */
        public function getGallerydetails($categoryId) {
                            $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
            $arrList        = array();
            $pageArr        = array();
            
            $objGallery        = new clsGallery;
            $galleryResult  = $objGallery->manageGallery('V', 0,$categoryId,'', '','',2, 0, 0,0,0);
           
            $totalResult = mysqli_num_rows($galleryResult);   
            if($totalResult > 0)            
            {   

                while ($row = mysqli_fetch_array($galleryResult)) {
                    
                    $strCaption      = htmlspecialchars_decode($row['VCH_CAPTION'], ENT_QUOTES);
                    $pageArr['strImage']         = $row['VCH_IMAGE'];                              
                    $pageArr['intGalleryId']     = $row['INT_GALLERY_ID'];
                    $pageArr['strDesc']          = htmlspecialchars_decode($row['VCH_DESCRIPTION'], ENT_QUOTES);
                    $pageArr['strCaption']       = $strCaption;

                    array_push($arrList, $pageArr);

                } 

            } 
               }
            echo(json_encode(array('gallery'=>$arrList)));
         }
        
    
        
     /*Function to get all the plugin contents 
            By: T Ketaki Debadarshini
            On: 18-Sept-2015	
     */
     public function getpluginDetails2() {
                         $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 

        $pageArr        = array();
        $arrList        = array();
        
        $divContent ='';
        $intfuntionId	= $_REQUEST['intfuntionId'];    
        $objPlugin      = new clsPlugin;
       
        $SubCatRes      = $objPlugin->managePlugin('FNT',0,$intfuntionId,0,'','',0,0,0,'0000-00-00','0000-00-00','0000-00-00');
        $intSubCatnum   = mysqli_num_rows($SubCatRes);
        if($intSubCatnum > 0)
        {
            while($subcatRow	= mysqli_fetch_array($SubCatRes))
            {
                
                $intsFunctionid   = $subcatRow["INT_FN_ID"];
                $intsSubcatid    = $subcatRow['INT_SUBCAT_ID'];                              
              
                $divContent .='<tr><th align="left">'.$subcatRow['VCH_SUBCATEGORY'].'</th></tr>';
                $pluginsubResult   = $objPlugin->managePlugin('V',0,$intsFunctionid,$intsSubcatid,'','',2,0,0,'0000-00-00','0000-00-00','0000-00-00');
                $pluginsubrcds= $pluginsubResult->num_rows;
               
                if($pluginsubrcds>0)
                {   
                   // echo $pluginsubrcds;
                    //$divContent .='<tbody>';
                    while($pluginsubRow	= mysqli_fetch_array($pluginsubResult))
                    {
                        $divContent .='<tr><td><a href="'.URL.'uploadDocuments/plugin/'.$pluginsubRow['VCH_DOCFILE'].'" target="_blank">'.$pluginsubRow["VCH_HEADLINE"].'</a></td> </tr>';
                    }
                   // $divContent .='</tbody>';
                }
               else
                  $divContent .=$pluginsubrcds.'<tr><td>No Details available.</td></tr>'; 
               
                 
            } //end of while loop
            
            
        }
       else
       {
           $pluginResult   = $objPlugin->managePlugin('V',0,$intfuntionId,0,'','',2,0,0,'0000-00-00','0000-00-00','0000-00-00'); 
           $pluginrcds= $pluginResult->num_rows;
            if($pluginrcds>0)
            {           
               // $divContent .='<tbody>';
                while($pluginRow	= mysqli_fetch_array($pluginResult))
                {
                    $divContent .='<tr><td><a href="'.URL.'uploadDocuments/plugin/'.$pluginRow['VCH_DOCFILE'].'" target="_blank">'.$pluginRow["VCH_HEADLINE"].'</a></td> </tr>';
                }
               //  $divContent .='</tbody>';         
            }
       }
               }
        
         echo(json_encode(array('pluginDetails'=>$divContent)));

     }  
     
     
      /*Function to get all the plugin contents 
            By: T Ketaki Debadarshini
            On: 18-Sept-2015	
     */
     public function getpluginDetails() {
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
        $arrList        = array();
        
        $divContent ='';
        $intfuntionId	= $_REQUEST['intfuntionId'];    
        $objPlugin      = new clsPlugin;
        
        $SubCatRes      = $objPlugin->managePlugin('FNT',0,$intfuntionId,0,'','',0,0,0,'0000-00-00','0000-00-00','0000-00-00');
        $intSubCatnum   = mysqli_num_rows($SubCatRes);
        if($intSubCatnum > 0)
        {
            $arrList['status'] = 1;
            $subcatdetails = array();
            $arrList['docdetails'] = array();
            
            while($subcatRow	= mysqli_fetch_array($SubCatRes))
            {
                
                $intsFunctionid   = $subcatRow["INT_FN_ID"];
                $intsSubcatid    = $subcatRow['INT_SUBCAT_ID'];   
                
                $subcatdetails['subcatname'] = $subcatRow['VCH_SUBCATEGORY'];
                $subcatdetails['subcatid'] = $intsSubcatid;
                $pluginsubResult   = $objPlugin->managePlugin('V',0,$intsFunctionid,$intsSubcatid,'','',2,0,0,'0000-00-00','0000-00-00','0000-00-00');
                $pluginsubrcds= $pluginsubResult->num_rows;
                
                $subcatdetails['docs'] = array();
                $docdetails = array();
                if($pluginsubrcds>0)
                {                     
                    while($pluginsubRow	= mysqli_fetch_array($pluginsubResult))
                    {
                        $docdetails['url'] = URL.'uploadDocuments/plugin/'.$pluginsubRow['VCH_DOCFILE'];
                        $docdetails['headline'] = $pluginsubRow["VCH_HEADLINE"];
                        
                        if (empty($pluginsubRow["DTM_MEETING_DATE"]) || $pluginsubRow["DTM_MEETING_DATE"] =='0000-00-00' || $pluginsubRow["DTM_MEETING_DATE"] == '0000-00-00 00:00:00')
                             $docdetails['meetingdate'] = '';
                        else
                           $docdetails['meetingdate'] = date("d-M-Y",strtotime($pluginsubRow["DTM_MEETING_DATE"]));
                       
                        
                        array_push($subcatdetails['docs'], $docdetails);
                    }
                  
                }
             
                array_push($arrList['docdetails'], $subcatdetails);
            } //end of while loop
           
        }
       else
       {
           $arrList['status']=0;
           $arrList['docdetails']= array();
           $pluginResult   = $objPlugin->managePlugin('V',0,$intfuntionId,0,'','',2,0,0,'0000-00-00','0000-00-00','0000-00-00'); 
           $pluginrcds= $pluginResult->num_rows;
          
            if($pluginrcds>0)
            {           
              
                $docs = array();
                while($pluginRo = mysqli_fetch_array($pluginResult))
                {
                     $docs['url'] = URL.'uploadDocuments/plugin/'.$pluginRow['VCH_DOCFILE'];
                     $docs['headline'] = $pluginRow["VCH_HEADLINE"];
                    // $docs['meetingdate'] = date("d-M-Y",strtotime($pluginRow["DTM_MEETING_DATE"]));
                      if (empty($pluginRow["DTM_MEETING_DATE"]) || $pluginRow["DTM_MEETING_DATE"] =='0000-00-00' || $pluginRow["DTM_MEETING_DATE"] == '0000-00-00 00:00:00')
                        $docs['meetingdate'] = '';
                      else
                        $docs['meetingdate'] = date("d-M-Y",strtotime($pluginRow["DTM_MEETING_DATE"]));
                     
                     array_push($arrList['docdetails'], $docs);
                }
             
            }
       }
               }
      
       echo(json_encode(array('pluginDetails'=>$arrList)));
        
        
     } //end of getpluginDetails function
     
  

      

    
     /*
      Function to get Officer Profille.
      Created by     : Chinmayee
      Created On     : 01-Jun-2016
     */
    public function getOfficerProfile() {
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
        $arrList        = array();
        $pageArr        = array();
        $objProfile        = new clsOfficerProfile;
        $profileResult     = $objProfile->manageOffProfile('V',0,0,'','','','','','','','',2,0,0,0,'','0000-00-00','0000-00-00');            
        $totalProfile = $profileResult->num_rows;            
        if($totalProfile > 0)            
        {   
            $i=0;
            while ($row = $profileResult->fetch_array()) {
                $pageArr['strMinisterNameE']   = htmlspecialchars_decode($row['vchMinisterNameE'], ENT_QUOTES);
                $pageArr['strMinisterNameO']   = htmlspecialchars_decode($row['vchMinisterNameH'], ENT_QUOTES);
                $pageArr['strDesignationE']    = htmlspecialchars_decode($row['vchDesignationE'], ENT_QUOTES);
                $pageArr['strDesignationO']    = htmlspecialchars_decode($row['vchDesignationH'], ENT_QUOTES);
                $pageArr['strQulificationE']   = htmlspecialchars_decode($row['vchQulificationE'], ENT_QUOTES);
                $pageArr['strQulificationO']   = htmlspecialchars_decode($row['vchQulificationH'], ENT_QUOTES);
                $pageArr['intLinkType']       = $row['intLinkType'];
                $pageArr['strUrl']            = $row['vchUrl'];
                $pageArr['strImage']          = $row['vchImage'];
                array_push($arrList, $pageArr);
                $i++;
             
            }
        } 
               }
         echo json_encode(array('OfficerProfile'=>$arrList));
    }
    
    /*
     Function to get notification at home page .
     Created by     : Sonali
     Created On     : 04-OCT-2016
     */
    public function getRouteNotification() {
        $newSessionId   = session_id();
        $arrList        = array();
        $pageArr        = array();
        $obj            = new clsNotification;
        $Result         = $obj->manageNotification('V',0,3,0,0,0,0,0,'','','','','','','','0000-00-00','0000-00-00',2,2,0,0,0);  
       
        $totalResult    = $Result->num_rows;  
            if($totalResult > 0)            
            {   
                $i=0;
                while ($row = $Result-> fetch_array()) {
                    
                    $pageArr['strNotificationId']       = $row['INT_NOTIFICATION_ID'];
                    $pageArr['strHeadlinesE']           = htmlspecialchars_decode($row['VCH_HEADLINE'], ENT_QUOTES);
                    $pageArr['strHeadlinesO']           = htmlspecialchars_decode($row['VCH_HEADLINE_O'], ENT_QUOTES);
                    $pageArr['strDocument']             = $row['VCH_DOCUMENT'] ;
                    $pageArr['Date']                    = date('d-M-Y',  strtotime($row['DTM_NOTICE_START']));
                    $pageArr['intblinkstatus']          = $row['INT_BLINK_STATUS'] ;
                    array_push($arrList, $pageArr);
                    $i++;
                   
                } 
            }
               
           echo json_encode(array('Notification'=>$arrList));

    }
    
    /* public function getData($action) {
        
                
          echo file_get_contents("http://192.168.11.120/IGRSService/PRMDashboardService.svc/GetEquipmentDetail?Action=P");  
          // echo json_encode(array('Notification'=>$arrList));

    }*/
    /*
    Function to fill all circularSectors.
    By: sonali
    On: 03-Oct-2016
    */
        public function fillcircularSection() { 
	$selVal 	        = $_REQUEST['SID'];
        $sql	                = "CALL USP_CIRCULAR_MASTER('RC',0,0,'', @OUT)";
        //echo $sql;
        $result = Model::executeQry($sql);
        //print_r($result);
        $arrList        = array();
        $arrLists       = array();
        $arrList1 = array();
        $pageArr        = array();
        $pageArr1        = array();
        $totrows    = $result->num_rows;
        $divideRows = ceil($totrows/2);
        $ctr=0;
        $count = 0;
        $count2 = 0;
        if ($result->num_rows > 0) {
            while ($Row = $result->fetch_array()) {
                
                if($ctr < $divideRows){
		$pageArr[$count]['circularType'] = $Row["intCircularId"];
                $pageArr[$count]['circularId'] = $Row["intmId"];
                $pageArr[$count]['circularName'] = $Row["vchCirculaName"];
                //array_push($arrList, $pageArr);
                $count++;
                }
                if($ctr >= $divideRows){
		$pageArr1[$count2]['circularType'] = $Row["intCircularId"];
                $pageArr1[$count2]['circularId'] = $Row["intmId"];
                $pageArr1[$count2]['circularName'] = $Row["vchCirculaName"];
                //array_push($arrList, $pageArr1);
                $count2++;
                }
                 $ctr++;
                 
            }
            $arrList['first']		= $pageArr;
            $arrList['second']		= $pageArr1;
        }
        //array_push($arrLists, $arrList);
        //array_push($arrLists, $arrList1);
        echo json_encode(array('circularNotice' => $arrList));
        
    }
    
    

        
         /*Function to show External link details on home page
		By: Chinmayee
		On: 24-05-2016	
	 */
         public function getleftImplink() {
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
            $objLink        = new clsLink;
            $result  = $objLink->manageLink('V',0,'','','',2,0,0);   
            $data='';
            if($result->num_rows>0)
            {	
               $data.= '<h4>Important Links <span><a href="'.SITE_PATH.'importantlinks" title="More Links" class="pull-right">View all</a></span></h4>';
                while($row	= $result->fetch_array())
                {
                    $intLinkId          = $row["intLinkId"];
                    $strLinkName	= htmlspecialchars_decode($row["vchLinkNameE"],ENT_QUOTES);
                    $vchUrl     	= $row["vchUrl"];
                 $data.= '<div class="col-md-6 col-sm-12 col-xs-12 padding-right-15">
                          <div class="imp-link screenReader"> 
                          <a href="'.$vchUrl.'" target="_blank" title="'.$strLinkName.'">'.$strLinkName.'</a>
                          </div>
                          </div>';
             
                }				
            }
            else {
             $data.='No data found..';
            }
               }
            echo json_encode(array('extLinks'=>$data));
         }  
       /* Function to get the pages of Directory plugin
        By: Chinmayee
        On: 30-May-2016
        */
	public function fillDirplugin()
	{  
                $newSessionId           = session_id();
                $hdnPrevSessionId       = $_POST['Sesid'];
               if ($newSessionId == $hdnPrevSessionId) { 
            $selplugin =$_REQUEST['selplugin'];
            $data      = "<option value='0'>  --Select--  </option>";
            $objUser   = new clsPages;
            $result    = $objUser->managePage('V', 0, '', '', '', 0, '', 0, '', '', '', 0, 0, 0,0,'0000-00-00','0000-00-00','','','','','','','0','',14); 
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
               }
            echo json_encode(array('result'=>$data));  
	}
        
        
        
       /* Function to get data from Webservice File
        By: Ashis Kumar Patra
        On: 07-Oct-2016
        */ 
       public function getComplainData() { 
           //define('SERVICE_URL','http://csmbhul177/IGRSService/CGRCService.svc?wsdl');
           define('SERVICE_URL','http://sta.odishatransport.gov.in/staportal_service/CGRCService.svc?wsdl');
           $tokParams1 = array('UserId' => 1,'intStatus'=>0,'intYear'=>'2016','strUserType'=>'super') ;
           $tokParams2 = array('UserId' => 1,'intStatus'=>3,'intYear'=>'2016','strUserType'=>'super') ;
       
           //$obj1              = $this->convertToObject($tokParams1);
           //$obj2              = $this->convertToObject($tokParams2);
          // print_r($obj);
           
           try {     
                $client = new SoapClient(SERVICE_URL, array('exceptions' => true));
//$client = new SoapClient(SERVICE_URL, array('exceptions' => true,'proxy_host'=> "tcp://10.150.9.191",'proxy_port'=> 8080)); 
                $ViewComplainresult1 = $client->GetComplaintCount($tokParams1);
                $ViewComplainresult2 = $client->GetComplaintCount($tokParams2);
               
                $totcomplain        = $ViewComplainresult1->GetComplaintCountResult;
                $rescomplain         = $ViewComplainresult2->GetComplaintCountResult;
                 $sql      = "CALL USP_VEHICLE_COUNT('UC',0,0,0,0,0,'0000-00-00',$totcomplain,$rescomplain,@OUT)";
                 $result   =  Model::executeQry($sql);
               } catch (SoapFault $e) {
                       $qsql      = "CALL USP_VEHICLE_COUNT('RC',0,0,0,0,0,'0000-00-00',0,0,@OUT)";
                       $qresult   =  Model::executeQry($qsql);
                        if($qresult->num_rows > 0)            
                        {
                            $conRows = mysqli_fetch_array($qresult);
                            $totcomplain        = $conRows['INT_TOT_COMPLAINT'];
                            $rescomplain        = $conRows['INT_RES_COMPLAINT'];
                        }
                     $msg = 'Sorry...This service is down. Please visit after some time';      
                   }
          echo json_encode(array('totComplain' => $totcomplain,'resComplain'=>$rescomplain,'ermsg'=>$msg));          // return $msg;    }
       }
       
       /* Function to get Asset Page data from Webservice File
        By: Ashis Kumar Patra
        On: 24-Oct-2016
        */ 
       public function getAssetData() { 
           define('SERVICE_URL','http://sta.odishatransport.gov.in/staportal_service/PRM_Service.svc?wsdl');
              //$tokParams1 = array('pEquip'=>array('Action' => "P")) ;
              //$obj              = $this->convertToObject($tokParams1);
         $rarray =array();
         $resultdata =array();
           try {     
               $client = new SoapClient(SERVICE_URL, array('exceptions' => true,'proxy_host'=> "tcp://10.150.9.191",'proxy_port'=> 8080)); 
               $ViewComplainresult = $client->View_Itil_EquipmentList();
               //print_r($ViewComplainresult);
               $resultdata = $ViewComplainresult->View_Itil_EquipmentListResult->ITIL_Equipment;
               $count= count($resultdata);
                for($i=0;$i<$count;$i++){
                  $rarray[$i]['ofcname']  = $resultdata[$i]->vchOfficeName; 
                  $rarray[$i]['equipqty']  = $resultdata[$i]->NOF_EQUIPMENT; 
                  $rarray[$i]['category']  = $resultdata[$i]->vchSubCatgName;

                }
             
              // print_r($rarray);
               } catch (SoapFault $e) {
                   
                   $msg = 'Sorry...This service is down. Please visit after some time'; 
                    //echo $msg;
                   }
              echo json_encode(array('assetresult' =>$rarray));
       }
       /* Function to convert array to stdClass Object
        By: Ashis Kumar Patra
        On: 07-Oct-2016
        */ 
       public function convertToObject($array) {
           $object = new stdClass();
           foreach ($array as $key => $value) { 
               if (is_array($value)) { 
                   $value = $this->convertToObject($value);
                   } 
                   $object->$key = $value; 
                   } 
                   return $object;
        }
       
       /* Function to get Complain STatus 
        By: Ashis Kumar Patra
        On: 24-Oct-2016
        */ 
       public function getComplainStatus($tokenparam,$mobile) { 
            //http://192.168.11.120/IGRSService/PRMDashboardService.svc/GetEquipmentDetail
           
           define('SERVICE_URL','http://sta.odishatransport.gov.in/staportal_service/CGRCService.svc?wsdl');  
            try {
               
                    $client = new SoapClient(SERVICE_URL, array('exceptions' => true)); 
//$client = new SoapClient(SERVICE_URL, array('exceptions' => true,'proxy_host'=> "tcp://10.150.9.191",'proxy_port'=> 8080)); 
                    $params =array('strToken' =>$tokenparam,'strMobile'=>$mobile);
                    $complainstatus = $client->SearchTokenNo($params);
                    $comp=$complainstatus->SearchTokenNoResult->Complaint->INTCOMPLIANTID ;
                    $objcomp = $this->convertToObject(array('INTCOMPLIANTID'=>$comp));
                    $params1 =array('strUserType' =>'super','intStatus'=>0,'comp'=>$objcomp);
                    $complainresult = $client->ViewComplaint($params1);
                    $complaintdata = $complainresult->ViewComplaintResult->Complaint;
                   
             
                    /*
                  $client = new SoapClient(SERVICE_URL, array('exceptions' => true)); 
                  $params = array('objComplaint'=>array('strTokenNo' =>$tokenparam));
                  $objparams      = $this->convertToObject($params);
                  $complainstatus = $client->GetComplaintDetails($objparams); 
                  $complainresult = $complainstatus->GetComplaintDetailsResult;
                  //print_r($complainresult);*/
//print_r($complainresult);
                    $complaindate  = date('d-M-Y',strtotime($complaintdata->DTMCREATEDON));
                    $tokenno       = $complaintdata->VCHTOKENNO;
                    $compliantname  = $complaintdata->NVCHCOMPLIANTANTNAME;
                    $email           = $complaintdata->VCHEMAIL;
                    $gender          = $complaintdata->VCHGENDER;
                    $phone           = $complaintdata->VCHMOBILE;
                    $callId          = $complaintdata->VCH_CALLID;
                    $address         = $complaintdata->NVCHADDRESS;
                    $landmark        = $complaintdata->NVCHLANDMARK;
                    $complainremark  = $complaintdata->VCHREMARK;
                    $complainstatus  = $complaintdata->VCH_COMPLIANT_STATUS;
                    $pending         = $complaintdata->VCHFULLNAME;

                    $complaindetails = $complaintdata->NVCHCOMPLIANTDETAILS;
                    $dist            = $complaintdata->VCH_DIST;
                    $vehicleno       = '';
                    $complaincat     = $complaintdata->VCH_CATEGORY;
                    $complainsubcat  = $complaintdata->NVCH_SUB_CATEGORY;
               } catch (SoapFault $e) {
                   $msg = 'Sorry...This service is down. Please visit after some time';
                   $msg = $e->getMessage();        
                   }
          echo json_encode(array('ComplainStatus' =>array('Token'=>$tokenno,'Name'=>$compliantname,'Date'=>$complaindate,'Status'=>$complainstatus,'Detail'=>$complaindetails,'Email'=>$email,'Gender'=>$gender,'Mobile'=>$phone,'CallId'=>$callId,'Email'=>$email,'Address'=>$address,'Land'=>$landmark,'Remark'=>$remark,'Email'=>$email,'Dist'=>$dist,'VechNo'=>$vehicleno,'Category'=>$complaincat,'SubCat'=>$complainsubcat,'Pending'=>$pending,'errmsg'=>$msg))); 
       }
       
       /* Function to get Vechicle Information
        By: Ashis Kumar Patra
        On: 24-Oct-2016
        */ 
       public function getVechileData() { 
           
           $sql      = "CALL USP_VEHICLE_COUNT('RC',0,0,0,0,0,'0000-00-00',0,0,@OUT)";
                  $result   =  Model::executeQry($sql);
                   if($result->num_rows > 0)            
                    {
                         $conRows = mysqli_fetch_array($result);
                         $intregCount = $conRows['INT_REG_COUNT'];
                         $intpermitCount = $conRows['INT_PERMIT_COUNT'];
                         $intfitCount = $conRows['INT_FITNESS_COUNT'];
                         $intChalanCount = $conRows['INT_CHALLAN_COUNT'];
                    }
                        
              echo json_encode(array('reg' => $intregCount,'permit'=>$intpermitCount,'fit'=>$intfitCount,'chalan'=>$intChalanCount));
       }
        
    /*Function to fill all Service category.
    By: Ashis Kumar Patra
    On: 17-Oct-2016
    */
        public function fillServiceCategory() { 
	$selVal 	        = $_REQUEST['SID'];
        
        $sql	                = "CALL USP_SERVICE_MASTER('RC',0,'', @OUT)";
        $result = Model::executeQry($sql);
        //print_r($result);
        $opts = '';
        $opt1 = '';
        
        if ($result->num_rows > 0) {
                $ctr=1;
            while ($Row = $result->fetch_array()) {
		
                $intValueId = $Row["intCatId"];
                $strValueName = $Row["vchService"];
                $strLinkNameE        = ($_SESSION['languageType']=='O')?$strValueName:$strValueName;
                $lanclass           = ($_SESSION['languageType']=='O')?'akrutiorisarala':'';
               
               
                $opts .='<li><a href="'.SITE_PATH.'/importantServices/'.$intValueId.'" id="'.$intValueId .'" class="'.$lanclass.'">'.$strLinkNameE.'</a></li>';
                if($ctr==1){
                $opt1 .='<a href="#" id="'.$intValueId .'" class="list-group-item active text-center '.$lanclass.'">'.$strLinkNameE.'</a>'; 
                }else{
                  $opt1 .='<a href="#" id="'.$intValueId .'" class="list-group-item text-center '.$lanclass.'">'.$strLinkNameE.'</a>'; 
                   }
                //$select = ($intValueId == $selVal) ? 'selected="selected"' : '';
                //$opts .= '<option value="' . $intValueId . '" title="' . $strValueName . '" ' . $select . '>' . $strValueName . '</option>';
           $ctr++;
           }
        }
        //echo(json_encode($opts));
        echo json_encode(array('serviceCategoryA' => $opt1,'serviceCategoryList'=>$opts));
    }
    
    /*
     Function to get notification at home page .
     Created by     : shweta
     Created On     : 31-OCT-2017
     */
     public function getTopRouteNotification() {
        $newSessionId   = session_id();
        $arrList        = array();
        $pageArr        = array();
        $obj            = new clsNotification;
        $Result         = $obj->manageNotification('VI',0,3,0,0,0,0,0,'','','','','','','','0000-00-00','0000-00-00',2,2,0,0,0);  
       
        $totalResult    = $Result->num_rows;  
            if($totalResult > 0)            
            {   
                $i=0;
                while ($row = $Result-> fetch_array()) {
                    
                    $pageArr['strNotificationId']       = $row['INT_NOTIFICATION_ID'];
                    $pageArr['strHeadlinesE']           = htmlspecialchars_decode($row['VCH_HEADLINE'], ENT_QUOTES);
                    $pageArr['strHeadlinesO']           = htmlspecialchars_decode($row['VCH_HEADLINE_O'], ENT_QUOTES);
                    $pageArr['strDocument']             = $row['VCH_DOCUMENT'] ;
                    $pageArr['Date']                    = date('d-M-Y',  strtotime($row['DTM_NOTICE_START']));
                    $pageArr['intblinkstatus']          = $row['INT_BLINK_STATUS'] ;
                    array_push($arrList, $pageArr);
                    $i++;
                   
                } 
            }
               
           echo json_encode(array('Notification'=>$arrList));

    }
	
	public function fillDistricts() {
        
        include_once(APP_PATH . 'controller/clsDistrict.php');

        $intDistId = (isset($_POST['intDistId']) && $_POST['intDistId'] != '') ? $_POST['intDistId'] : 0;
        $strSearchtxt = (isset($_POST['strSearchtxt']) && $_POST['strSearchtxt'] != '') ? trim($_POST['strSearchtxt']) : '';
        $intCourseId = (isset($_POST['intCourseId']) && $_POST['intCourseId'] != '') ? $_POST['intCourseId'] : 0;
        $piaStatus = (isset($_POST['piaStatus']) && $_POST['piaStatus'] != '') ? $_POST['piaStatus'] : 0;

        $distVal = (isset($_POST['distVal']) && $_POST['distVal'] != '') ? htmlspecialchars(trim($_POST['distVal'])) : '';
        $objDist = new clsDistrict;
       
            $errDistval = $objDist->isSpclChar($_POST['distVal']);
            if ($errDistval > 0) {
                echo json_encode(array('error' => 'Please remove special characters'));
                exit();
            } else
               $result = $objDist->manageDistrict('VP', 0, $distVal, '', '', '', 0, 0, 0);
      
        $count = $result->num_rows;
        $arrList = array();
        $pageArr = array();
        if ($count > 0) {
            while ($row = $result->fetch_array()) {

                $pageArr['intDistId'] = $row['intDistrictid'];
                $pageArr['strDistName'] = ($_SESSION['languageType'] == 'O' && $row['vchDistrictnameO'] != '') ? $row['vchDistrictnameO'] : htmlspecialchars_decode($row['vchDistrictname'], ENT_QUOTES);
                $pageArr['strClass']    = ($_SESSION['languageType'] == 'O' && $row['vchDistrictnameO'] != '') ? 'odia' : '';
                array_push($arrList, $pageArr);
            }
            echo(json_encode(array('result' => $arrList)));
        } else {

            $pageArr['strNorecordlbl'] = $strNorecordlbl;
            $pageArr['strLangCls'] = ($_SESSION['languageType'] == 'O' && $row['vchDistrictnameO'] != '') ? 'odia' : '';;

            echo(json_encode(array('noRecord' => $pageArr)));
        }
    }
    
/* Function to get events in load more of event-detail page of home page by indrani on::15-12-2020 */
public function getmoreevents() {
      include_once(APP_PATH . 'controller/clsEvents.php');
        $newSessionId   = session_id();
        $lasteventId    = $_REQUEST['lasteventId'];
        $decryptId      = $_REQUEST['decryptId'];
        $arreventList   = array();
        $eventArr       = array();
        $obj            = new clsEvents;
        $Result         = $obj->manageEvents('VLE',$lasteventId,'','','','','','','','','','','',2,0,0,'','',0,0); 
       
        $totalResult    = $Result->num_rows;  
            if($totalResult > 0)            
            {   
                $i=0;
                while ($rows = $Result->fetch_array()) {
                    $i++;
                    $eventArr['eId'] = $rows['INT_EVENT_ID'];
                    $eventArr['encryptedId'] = Model::encrypt($eventArr['eId']);
                    $eventArr['eTitleE'] = htmlspecialchars_decode($rows['VCH_TITLE_E'],ENT_NOQUOTES);
                    $eventArr['eTitleO'] = htmlspecialchars_decode($rows['VCH_TITLE_O'],ENT_NOQUOTES);
                    $eventArr['eTitle']  = ($_SESSION['languageType']=='O' && $eventArr['eTitleO']!='')?$eventArr['eTitleO']:$eventArr['eTitleE'];
                    $eventArr['eStartDate'] = date("d-M-Y",strtotime($rows['DTM_START_DATE']));
                    $eventArr['eStartTime'] = date("g:i A", strtotime($rows['START_TIME']));
                    $eventArr['eImg']       = htmlspecialchars_decode($rows['VCH_IMAGE'],ENT_NOQUOTES);
                    $eventArr['activeCls']  = ($decryptId==$eventArr['eId'])?'active':'';
                    $eventdiv ='';
                    $eimgPath   = ($eventArr['eImg']!='' && file_exists(APP_PATH.'uploadDocuments/Events/'.$eventArr['eImg']))?URL.'uploadDocuments/Events/'.$eventArr['eImg']:SITE_PATH.'images/avatar.png';
                    $eventdiv .= '<img src="'.$eimgPath.'" alt="'.$eventArr['eImg'].'">';

                    $eventArr['eventdiv']  = $eventdiv;
                    array_push($arreventList, $eventArr);                
                }  
            }
               
           echo json_encode(array('allEvents'=>$arreventList));

    }//End of getmoreevents function 

/* Function to get more news for loadmore in news-detail page in homepage by indrani on::17-12-2020 */
public function getmorenews() {
      include_once(APP_PATH . 'controller/clsNewsMedia.php');
        $newSessionId  = session_id();
        $lastnewsId    = $_REQUEST['lastnewsId'];
        $decryptId     = $_REQUEST['decryptId'];
        $arrnewsList   = array();
        $newsArr       = array();
        $obj            = new clsNewsMedia;
        $Result         = $obj->manageNewsMedia('VLN',$lastnewsId,'','','','','','','','',0,'','',2,0,0,'','',0,0); 
       
        $totalResult    = $Result->num_rows;  
            if($totalResult > 0)            
            {   
                $i=0;
                while ($rows = $Result->fetch_array()) {
                    $i++;
                    $newsArr['nId'] = $rows['INT_NEWSMEDIA_ID'];
                    $newsArr['encryptedId'] = Model::encrypt($newsArr['nId']);
                    $newsArr['nTitleE']     = htmlspecialchars_decode($rows['VCH_TITLE_E'],ENT_NOQUOTES);
                    $newsArr['nTitleO']     = htmlspecialchars_decode($rows['VCH_TITLE_O'],ENT_NOQUOTES);
                    $newsArr['nTitle']      = ($_SESSION['languageType']=='O' && $newsArr['nTitleO']!='')?$newsArr['nTitleO']:ucfirst($newsArr['nTitleE']);
                    $newsArr['nPublishDate'] = date("d-M-Y",strtotime($rows['DTM_PUBLISH_DATE']));
                    $newsArr['nTypeId']     = $rows['INT_TYPE_ID'];
                    $newsArr['nImg']        = htmlspecialchars_decode($rows['VCH_IMAGE'],ENT_NOQUOTES);
                    $newsArr['nVideo']      = htmlspecialchars_decode($rows['VCH_VIDEO_FILE'],ENT_NOQUOTES);
                    $newsArr['activeCls']   = ($decryptId==$newsArr['nId'])?'active':'';
                    $mediadiv='';
                    if($rows['INT_TYPE_ID']==1)
                    {
                      $imgPath   = ($newsArr['nImg']!='' && file_exists(APP_PATH.'uploadDocuments/NewsMedia/'.$newsArr['nImg']))?URL.'uploadDocuments/NewsMedia/'.$newsArr['nImg']:SITE_PATH.'images/avatar.png';
                      $mediadiv .= '<img src="'.$imgPath.'" alt="'.$newsArr['nImg'].'">';
                    }
                    else if($rows['INT_TYPE_ID']==2)
                    {
                      if($newsArr['nVideo']!='' && file_exists(APP_PATH.'uploadDocuments/NewsMedia/'.$newsArr['nVideo']))
                      {
                        $mediadiv .= '<iframe class="" width="100" height="100" src="'.URL.'uploadDocuments/NewsMedia/'.$newsArr['nVideo'] .'" frameborder="0" allowfullscreen></iframe>';
                      }else
                      {
                        $mediadiv .= '<img src="'.SITE_PATH.'images/avatar.png'.'" alt="'.$newsArr['nVideo'].'">';
                      }
                    }
                    $newsArr['mediadiv']  = $mediadiv;
                    array_push($arrnewsList, $newsArr);                
                }  
            }
               
           echo json_encode(array('allNews'=>$arrnewsList));

    }//End of getmorenews function 


//Function to view model of customer receipt by indrani on::25-01-2021
 public function viewCustomerReceiptModel()
 {
    include_once(APP_PATH."controller/clsManageDealerDashboard.php");
    $obj    = new clsManageDealerDashboard();
    $customerId = $_REQUEST['custid'];
    $resultRec = $obj->viewDealerDashboard('VCM',0,$customerId,'','',0,'','',0,'','','','','','',0,0);
    $result = $resultRec->fetch_array();
    $recDiv = '<div class="row">
              <div class="col-md-6">
                <h4><strong>PAYMENT RECEIPT</strong> </h4>
                <p><strong>Receipt for Donation to Odisha Road Safety Society</strong></p>
                <div class="report-id">
                <p>Date:'.date('d-M-Y h:i A',strtotime($result['stmCreatedOn'])).'</p>
                <p> <strong>Receipt Id: '.$result['vchReceiptNo'].'</strong></p>
                </div>
               <p class="m-b-1">Received From</p>
               <p class="m-b-1"><strong>'.$result['vchName'].'</strong></p>
               
               <div class="amount-patch">
               <p class=" "> <strong>Amount Donated in Rs. </strong></p>  <p class="border-left"><strong class="ml-6"> '.$result['decAmount'].'/00</strong> (Rupees One Thousand Only/-)</p>
               </div>
               <div class="payment-footer">
               <p class=" text-grey">Pay Mode</p>
               <p class="m-b-1">CCAvenue Payment Gateway(Powered <br>
            By ICICI Bank)</p>
               <p class="">Bank Ref.No. 18909 </p>         
          </div>         
        </div>
        <div class="col-md-6">
          <img src="images/qr-code.png" class="qr-code">        
        </div>
      </div>
        <p class="marked">*No Bank Charges are applicable for Debit and Credit cards and Netbanking. </p>';
        echo json_encode(array('status'=>'0','result'=> $recDiv)); 
 }//End of viewCustomerReceiptModel

//Function to view customer receipt in report by indrani on::27-01-2021 
 public function viewCustomerReportModel()
 {
    include_once(APP_PATH."controller/clsManageDealerDashboard.php");
    $obj    = new clsManageDealerDashboard();
    $customerId = $_REQUEST['custid'];
    $resultRec = $obj->viewDealerDashboard('VRM',0,$customerId,'','',0,'','',0,'','','','','','',0,0);
    $result = $resultRec->fetch_array();
    $recDiv = '<div class="row">
              <div class="col-md-6">
                <h4><strong>PAYMENT RECEIPT</strong> </h4>
                <p><strong>Receipt for Donation to Odisha Road Safety Society</strong></p>
                <div class="report-id">
                <p>Date:'.date('d-M-Y h:i A',strtotime($result['stmCreatedOn'])).'</p>
                <p> <strong>Receipt Id: '.$result['vchReceiptNo'].'</strong></p>
                </div>
               <p class="m-b-1">Received From</p>
               <p class="m-b-1"><strong>'.$result['vchName'].'</strong></p>
               
               <div class="amount-patch">
               <p class=" "> <strong>Amount Donated in Rs. </strong></p>  <p class="border-left"><strong class="ml-6"> '.$result['decAmount'].'/00</strong> (Rupees One Thousand Only/-)</p>
               </div>
               <div class="payment-footer">
               <p class=" text-grey">Pay Mode</p>
               <p class="m-b-1">CCAvenue Payment Gateway(Powered <br>
            By ICICI Bank)</p>
               <p class="">Bank Ref.No. 18909 </p>         
          </div>         
        </div>
        <div class="col-md-6">
          <img src="images/qr-code.png" class="qr-code">        
        </div>
      </div>
        <p class="marked">*No Bank Charges are applicable for Debit and Credit cards and Netbanking. </p>';
        echo json_encode(array('status'=>'0','result'=> $recDiv)); 
 }//End of fucntion viewCustomerReportModel  

 //Function to view graph in dashboard by indrani on::25-01-2021
 public function getChartData()
 {
    include_once(APP_PATH."controller/clsDealer.php");
    $objCht       = new clsDealer();
    $intYear      = $_REQUEST['intYear'];
    $intMonth     = $_REQUEST['intMonth'];
    $selYear      = $_REQUEST['selYear'];
    $selMonth     = $_REQUEST['selMonth'];
    if($intYear>0 && $intMonth>0)
      $action = 'VGM';
    elseif($intYear>0 && $intMonth==0)
      $action = 'VGY';
    elseif($intYear==0 && $intMonth==0)
      $action = 'VGA';

    $resultGraph    = $objCht->viewGraphDet($action,0,0,$intYear,$intMonth,0,0,'',0); 
    if($resultGraph->num_rows>0)
    {
      $grpData   = '[';

      while($rows = $resultGraph->fetch_array()){
        $years     = (!empty($rows['years']))?$rows['years']:0;
        $monthName = (!empty($rows['monthname']))?$rows['monthname']:'';
        $dayNo     = (!empty($rows['dayno']))?$rows['dayno']:0;
        $totAmt    = $rows['totamount'];
        if($intYear>0 && $intMonth>0){
          $grpData .= '['.'"'.$dayNo.'"'.','.$totAmt.']'.',';
        }
        elseif($intYear>0 && $intMonth==0){
          $grpData .= '['.'"'.$monthName.'"'.','.$totAmt.']'.',';
        }
        elseif($intYear==0 && $intMonth==0){
          $grpData .= '['.'"'.$years.'"'.','.$totAmt.']'.',';
        }
      }
      $grpData = rtrim($grpData, ',');
      $grpData .= ']';
    }    

    $paramIn ='';

    $title ='';

    if(!empty($intYear) && !empty($intMonth))
    {
      $paramIn = "Month-".date('F', mktime(0, 0, 0, $intMonth, 10)).','.$intYear;
      $title = 'Date(s)';
    }
    else if(!empty($intYear) && empty($intMonth))
    {
      $paramIn = "Year-".$intYear;
      $title = 'Month(s)';
    }
    else if(empty($intYear) && empty($intMonth))
    {
      $paramIn = "Till Date";
      $title ='Year(s)';
    }

      echo json_encode(array('status'=>'0','result'=> $grpData,'title'=>$title, 'paramIn'=>$paramIn)); 
 }//End of getChartData   



        
} //End of class classbind




?>