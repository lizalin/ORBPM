<?php 
/* ================================================
	File Name         	  : tenderInner.php
	Description		  : Manage functions in tender	
	Date Created		  : 08-06-2021
	Designed By		  : Ashok Kumar Samal    
	Update History		  :
	<Updated by>		<Updated On>		<Remarks>

	==================================================*/

	$objTender      = new clsTender();
	$isPaging      = 0;
    $pgFlag	   = 0;
    $intPgno	   = 1;
    $intRecno	   = 0;
    $ctr	   = 0;
	if(@$_REQUEST['hdn_IsPaging']!="" && @$_REQUEST['hdn_IsPaging'] >0)
		$isPaging=1;
	if(@$_REQUEST['hdn_PageNo']!=""  && @$_REQUEST['hdn_PageNo'] >0)
	{
		$intPgno=$_REQUEST['hdn_PageNo'];
		$pgFlag	= 1;
	}
	if(@$_REQUEST['hdn_RecNo']!=""  && @$_REQUEST['hdn_RecNo'] >0)
	{	
		$intRecno=$_REQUEST['hdn_RecNo'];
		$pgFlag	= 1;
	}
	if($isPaging==0 && @$_REQUEST['hdn_PageNo']=='' && @$_REQUEST['ID']>0)
	{
		$intRecno	= (isset($_SESSION['paging']['recNo']) && $_SESSION['paging']['recNo']>0)?$_SESSION['paging']['recNo']:$intRecno;
		$intPgno	= (isset($_SESSION['paging']['pageNo']) && $_SESSION['paging']['pageNo']>0)?$_SESSION['paging']['pageNo']:$intPgno;		
	}
	else	
		unset($_SESSION['paging']);
	if(isset($_REQUEST['hdn_qs'])&& $_REQUEST['hdn_qs']!='' )
	    {
            $qs	= $_REQUEST['hdn_qs'];
            $ids	= $_REQUEST['hdn_ids'];
            $outMsg	= $objTender->deleteTender($qs,$ids);
	    }
        if($isPaging==0)	
            $result		= $objTender->manageTender('PGF',$intRecno,$strTenderNo,$strHeadline,'0000-00-00','0000-00-00','','',0,0,0,0);
		  
	    else
	    {
            $intPgno	= 1;
            $intRecno	= 0;
            $result                 = $objTender->manageTender('VF',0,$strTenderNo,$strHeadline,'0000-00-00','0000-00-00','','',0,0,0,0);
	    }
       $totalResult                 = $objTender->manageTender('VF',0,$strTenderNo,$strHeadline,'0000-00-00','0000-00-00','','',0,0,0,0);
       $intTotalRec                 = mysqli_num_rows($totalResult); 
       $intCurrPage                 = $intPgno;
       $intPgSize                   = 10;
       $_SESSION['paging']['recNo'] = $intRecno;
       $_SESSION['paging']['pageNo']= $intPgno;

?>