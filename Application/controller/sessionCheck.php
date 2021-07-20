<?php
	if($_SESSION['adminConsole_userID']==''&& !(isset($_SESSION['loggedin'])))
	{
		unset($_SESSION['adminConsole_userID']);
		unset($_SESSION['adminConsole_UserName']);
		unset($_SESSION['adminConsole_FullName']);
		unset($_SESSION['adminConsole_EMail']);
		unset($_SESSION['adminConsole_Desg']);
		unset($_SESSION['adminConsole_Desg_Id']);
		unset($_SESSION['adminConsole_Grade']);
		unset($_SESSION['adminConsole_Node']);
		unset($_SESSION['expire']);
                session_destroy();
                header("Location:".APP_URL."sessionExpire");
                exit;

	}
	$_SESSION['start'] = time();	
    if(!isset($_SESSION['expire'])){
        $_SESSION['expire'] = $_SESSION['start']+ (1200) ;
    }
    
	$now = time();
    if($now > $_SESSION['expire'])
    {
        session_destroy();
        unset($_SESSION['expire']);
        header("Location:".APP_URL."sessionExpire");exit;
		
    }
	else 
		$_SESSION['expire'] = $_SESSION['start']+ (1200) ;
?>