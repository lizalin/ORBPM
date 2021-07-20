<?php
	/* ================================================
	File Name         	  : config.php
	Description               : This is to set default data, configuration datas.
	Author Name		  : T Ketaki Debadarshini
	Date Created		  : 15-Sept-2015	
	Update History		  :	<Updated by>			<Updated On>		<Remarks>
                           Ashis Kumar Patra                 13 Dec 2016           Allow Specific url for $_SERVER['HTTP_HOST']to prevent from host header attack
                           Ashok Kumar Samal            09-12-2020          Optimized lines of code 
	includes			  : dbConfig.php
	==================================================*/
	@session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
    @define('TITLE', 'Welcome ::Raj Bhavan Odisha ');
    @define('HOME_ENV', 'D') ;// D: development :: L: Live
    $conType    = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://';
    $host       = (isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost');
        $url        = 'http'.(isset($_SERVER['HTTPS'])?'s':'').'://'.$host.$_SERVER['REQUEST_URI'];
        $details    = parse_url($url);;
        $dir        = explode("/",$details["path"]);
        $dirName    = ( HOME_ENV =='D') ? $dir[1]."/": '';
        
    @define('SITE_URL', $conType.$host .'/'.$dirName);
    @define('APP_URL', SITE_PATH.'Application/');
    @define('SITE_PATH',$_SERVER['DOCUMENT_ROOT'].'/'.$dirName);
    @define('APP_PATH',SITE_PATH.'Application/');
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
    
?>