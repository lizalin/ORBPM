<?php

	if(!isset($_SESSION['ORSSD']['dealerloggedin']) || !isset($_SESSION['ORSSD']['roadSafety_DealerUserid']) || $_SESSION['ORSSD']['roadSafety_DealerUserid']=='' )
	{
	// echo('ar2');exit();	
	
		unset($_SESSION['ORSSD']['dealertoken_id']);
		unset($_SESSION['ORSSD']['roadSafety_DealerID']);
		unset($_SESSION['ORSSD']['roadSafety_DealerUserid']);
		unset($_SESSION['ORSSD']['roadSafety_DealerCode']);
		unset($_SESSION['ORSSD']['roadSafety_DealerRegdNo']);
		unset($_SESSION['ORSSD']['roadSafety_DealerName']);
		unset($_SESSION['ORSSD']['roadSafety_DealerEmail']);
		unset($_SESSION['ORSSD']['roadSafety_DealerContact']);
		unset($_SESSION['ORSSD']['dealerloggedin']);
		unset($_SESSION['ORSSD']['expire']);
        session_destroy();
        header("Location:".SITE_PATH.'road-safety');
        exit;

	}
	// echo('arg12222');exit();	
	$_SESSION['ORSSD']['start'] = time();	
    if(!isset($_SESSION['expire'])){
        $_SESSION['ORSSD']['expire'] = $_SESSION['ORSSD']['start']+ (1200) ;
    }
    
	$now = time();
    if($now > $_SESSION['ORSSD']['expire'])
    {
        session_destroy();
        unset($_SESSION['ORSSD']['expire']);
        header("Location:".SITE_PATH.'road-safety');exit;
		
    }
	else{
		$_SESSION['expire'] = $_SESSION['start']+ (12000) ;
	} 
?>
