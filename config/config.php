<?php
	/* ================================================
	File Name         	  : config.php
	Description           : This is to set default data, configuration datas.
	Author Name		  	  : Dharashree Mohapatra
	Date Created		  : 10-02-2021
	Update History		  :	<Updated by>			<Updated On>		<Remarks>
                           
	includes			  : dbConfig.php
	==================================================*/
	@session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 0);
    @define('TITLE', 'Welcome ::Raj Bhavan Odisha ');
    @define('HOME_ENV', 'D') ;// D: development :: L: Live
    $conType    = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://';
    $host       = (isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost');
        $url        = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$host.$_SERVER['REQUEST_URI'];
        $details    = parse_url($url);;
        $dir        = explode("/",$details["path"]);
        $dirName    = ( HOME_ENV =='D') ? $dir[1]."/": '';
        
    @define('SITE_URL', $conType.$host .'/'.$dirName);
    @define('APP_URL', SITE_URL.'Application/');
    @define('SITE_PATH',$_SERVER['DOCUMENT_ROOT'].'/'.$dirName);
    @define('APP_PATH',SITE_PATH.'Application/');
    @define('APP_CLASS_PATH',APP_PATH.'controller/');
	@define('EXCEL_APP_PATH',APP_PATH);
	
	include(APP_PATH."includes/dbConfig.php");
	@define('DB_HOST', $dbHost);
	@define('DB_NAME', $dbName);
	@define('DB_USER', $dbUser);
	@define('DB_PASS', $dbPass);
    @define('DB_PORT', $dbPort);	
	@define('SPLCHRS',"',<,>,%");
    @define('sendMail','N');
    @define('portalEmail','csmphpdepartment@gmail.com');
        
    @define('ADMIN_SPLCHRS',"<,>,%,',|,+,;,\"");	
    /*@define('DESG_ID',$_SESSION['adminConsole_Desg_Id']);
    @define('USER_ID',$_SESSION['adminConsole_userID']);
    @define('ADMIN_PRIVILEGE',$_SESSION['adminConsole_Privilege']);
    @define('ADMIN_HIERARCHY',$_SESSION['adminConsole_HierarchyId']);*/
    @define("size1MB","1000000");
    @define("size2MB","2000000");
    @define("size10MB","10000000");
    @define("size70MB","7.34e+7");
    @define("size5MB","5242880");
    
    @define('BLANKERRMSG','Mandatory fields should not left blank');
    @define('SPCLCHARERRMSG','Special Characters are not allowed');
    @define('LENERRMSG','Field length should be appropriate');
?>