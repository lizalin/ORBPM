<?php
/* ================================================
	File Name         	  : indexInner.php
	Description		  : Manage functions in Index	
	Date Created		  : 08-06-2021
	Designed By		  : Ashok Kumar Samal    
	Update History		  :
	<Updated by>		<Updated On>		<Remarks>

	==================================================*/

		$objRBofficer 	= new clsOfficerRajBhavan();
		$getListOfficer = $objRBofficer->manageOfficer('VCW', 0, 0, '', '','','', 2, 0, 0);
		if($getListOfficer->num_rows>0){
            
            $arrData=array();
          while ($fetchData = $getListOfficer->fetch_assoc()) 
          {
            //echo "<pre>";print_r($fetchData);exit;            
            $offcrCat = $fetchData['VCH_CATEGORY_NAME'];
           
            $arrData[$offcrCat][]= $fetchData;
          }//end while
          //echo "<pre>";print_r($arrData);exit;

        }//end if
      ?>