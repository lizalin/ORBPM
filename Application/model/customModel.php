<?php
	/* ================================================
	File Name         	  : customModel.php
	Description	          : This is to manage model class and its function. This also used to maintain connection to database.
	Author Name		  : T Ketaki Debadarshini
	Date Created		  : 28-Aug-2015
	Update History		  :
						<Updated by>		<Updated On>		<Remarks>
						
	includes			  : config.php

	==================================================*/
//require("config.php");

class Model {
	public $conn	= null;
	public $db = null;
	public $crypKey 	= "OMVD07122020CSM";
    public $cipher 	  	= "AES-128-CBC";
	function __construct() 
	{
        try 
		{ 
			if(strtolower(basename($_SERVER['PHP_SELF'])) != 'index.php')
				exit();
			
        } 
		catch (Exception $e) 
		{
            exit('Exception occured.');
        }
    }
	/*================function to create connection ====================
			By      :T Ketaki Debadarshini
			ON	:28-Aug-2015
	===================================================================*/	
	private function createConnection()
	{
		$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME,DB_PORT);                
		if ($this->db->connect_errno) {
			echo "Failed to connect!!! Wrong user id, password or database name";
			exit();
		}
	}	
	/*================function to execute query ====================
			By	:T Ketaki Debadarshini
			ON	:28-Aug-2015
	================================================================*/
	public function executeQry($sql)
	{
		$this->createConnection();
		$result	= $this->db->query($sql);
		$this->db->close();
		return $result;
	}
	
	public function executeQryAnalyzer($sql)
	{
		$this->createConnection();
		$result	= $this->db->query($sql) or $result = mysqli_error($this->db);
		$this->db->close();
		return $result;
	}
	//========= Check Special Character ==============
	public function isSpclChar($strToCheck)
	{	
		$arrySplChar	= explode(',',SPLCHRS);		
		$errFlag		= 0;
		for ($i=0; $i<count($arrySplChar); $i++)
		{
			$intPos=substr_count($strToCheck,trim($arrySplChar[$i]));
			if ($intPos>0)
				$errFlag++;	
		}
		return $errFlag;
	}
	/*==============function to check blank value ==================
			By  : T Ketaki Debadarshini
			ON  : 28-Aug-2015
	================================================================*/
	public function isBlank($strToCheck)
	{	
		$errFlag		= 1;
		if($strToCheck!='')
			$errFlag	= 0;
		return $errFlag;
	}
	/*======== function to check Max, Min or Equal length ==========
			By  :T Ketaki Debadarshini
			ON  : 28-Aug-2015
	================================================================*/
	public function chkLength($flag, $strToCheck, $length)
	{	
		//======= $flag= 'MAX'/'MIN'/'EQ' for Maximum Minimum or Equal length
		$errFlag		= 0;
		if($strToCheck!='')
		{
			if(strtolower($flag)=='max')
			{
				if(strlen($strToCheck)>$length)
					$errFlag		= 1;
			}
			else if(strtolower($flag)=='min')
			{
				if(strlen($strToCheck)<$length)
					$errFlag		= 1;
			}
			else if(strtolower($flag)=='eq')
			{
				if(strlen($strToCheck)!=$length)
					$errFlag		= 1;
			}	
		}	
		return $errFlag;
	}
	/*============== function to check dropdown field ==============
			By  : T Ketaki Debadarshini
			ON  : 28-Aug-2015
	================================================================*/
	public function chkDropdown($drpVal)
	{	
		$errFlag		= 1;
		if($drpVal>0 && $drpVal!='')
			$errFlag		= 0;
		return $errFlag;
	}
	/*============ function to check only numeric data =============
			By  : T Ketaki Debadarshini
			ON  : 28-Aug-2015
	================================================================*/
	public function isNumericData($data)
	{	
		$errFlag		= 1;
		if(preg_match('/^\d+$/',$data))
		   $errFlag		= 0;
		return $errFlag;
	}
	/*============ function to check only character data =============
			By  : T Ketaki Debadarshini
			ON  : 28-Aug-2015
	================================================================*/
	public function isCharData($data)
	{	
		$errFlag		= 1;
		if(preg_match('/^[a-zA-Z.,-\s]+$/i',$data))
		   $errFlag		= 0;
		return $errFlag;
	}
	/*============ function to check decimal data =============
			By  : T Ketaki Debadarshini
			ON  : 28-Aug-2015
	================================================================*/
	public function isDecimal($data,$afterDecimal=2)
	{			
		$errFlag		= 1;
		if(preg_match('/^[0-9]+(\.[0-9]{1,'.$afterDecimal.'})?$/',$data))
		   $errFlag		= 0;
		return $errFlag;
	}
	//=========== Function to get paging ===============
	public function getPaging($intTotalRec,$intCurrPage,$intPgSize,$isPaging)
	{
		$paging	= $this->ShowPaging($intTotalRec,$intCurrPage,$intPgSize,$isPaging);
		return $paging[1];
	}
	//============ Function to get page number ==========
	public function getPageNumbers($intTotalRec,$intCurrPage,$intPgSize,$isPaging)
	{
		$paging	= $this->ShowPaging($intTotalRec,$intCurrPage,$intPgSize,$isPaging);
		return $paging[0];
	}
	
	//================= Function for pagination =============================
	public function ShowPaging($intTotalRec,$intCurrPage,$intPgSize,$isPaging)
	{	
            
		$intPagecount		= ceil($intTotalRec/$intPgSize); // Total no of pages
	
		if($intCurrPage>$intPagecount)
			$intCurrPage 	= $intPagecount;
		$intMaxPage			= $intCurrPage+10;
		$intPrevPgno 		= $intCurrPage-1;
		$intRecPrev	 		= ($intCurrPage-2) * $intPgSize;
		$intNextPgno 		= $intCurrPage+1;
		$intRecNext 		= $intCurrPage * $intPgSize;
		
		// set max page number to show ===============
		if($intMaxPage > $intPagecount)
			$intMaxPage=$intPagecount;
	
		// First Page Link ====================================
		if($intCurrPage>1)
		$strPages.="<li class='prev'><a class='button btn-sm btn-info' onclick='DoPaging(1,0)' href='javascript:void(0);' title='First'><i class='fa fa-angle-double-left'></i></a></li>";
		
		// set previous page link ========================
		if($intPrevPgno>0)
			$strPages.="<li class='prev'><a class='button btn-sm btn-info' onclick='DoPaging(".$intPrevPgno.",".$intRecPrev.")' href='javascript:void(0);' title='Previous'>Prev</a></li>";
		// Create page number links =======================
		$intStartPg=1;
		$intEndPg=10;
		if($intCurrPage<=10)
		{
			$intStartPg=1;
			$intEndPg=10;
		}
		else
		{
			$intStartPg	= floor($intCurrPage/10)*$intPgSize;
			$intEndPg	= ceil($intCurrPage/10)*$intPgSize;
		}
		if($intEndPg>$intPagecount)
			$intEndPg	= $intPagecount;
			
		for($intCtr=$intStartPg; $intCtr<=$intEndPg; $intCtr++)
		{	
			if($intCtr>=1)
				$intRec=$intPgSize*($intCtr-1);
			if($intCurrPage==$intCtr)	
				@$strPages.="<li class='active'><a class='button btn-sm btn-info' href='javascript:void(0)'>".$intCtr."</a></li>";
			else
					$strPages.="<li><a class='button btn-sm btn-info' onclick='DoPaging(".$intCtr.",".$intRec.")' href='#' title='".$intCtr."'>".$intCtr."</a></li>";		
		}
		// set next page link ========================
		if($intCurrPage < $intPagecount)
			$strPages	.= "<li class='next'><a class='button btn-sm btn-info' onclick='DoPaging(".$intNextPgno.",".$intRecNext.")' href='#' title='Next'>Next</a></li>";
			
		// Last Page Link ====================================
		$intLastPageRec	= ($intPagecount-1)*$intPgSize;
		if($intCurrPage<$intPagecount)
			$strPages	.= "<li><a class='button btn-sm btn-info' onclick='DoPaging(".$intPagecount.",".$intLastPageRec.")' href='#' title='Last'>&raquo;</a></li>";
		//================================================
		$intStartRec	= ($intCurrPage-1)*$intPgSize+1;
		$intEndRec		= $intRecNext;
		if($intEndRec>$intTotalRec)
			$intEndRec	= $intTotalRec;
			
		$strShowing		= ($isPaging==0)?"Showing ".$intStartRec."&nbsp;to&nbsp;".$intEndRec." of ".$intTotalRec." entries":"Showing ".$intStartRec."&nbsp;to&nbsp;".$intTotalRec." of ".$intTotalRec." entries";
		$ArrPaging[0]	= $strShowing;
		$ArrPaging[1]	= $strPages;
		return $ArrPaging;
	}
	
	/* ============= Fill dropdown select option ## By  : T Ketaki Debadarshini
			ON  : 28-Aug-2015
           ========================================================================*/
	public function FillDropdown($sqlResult,$strSelVal)
	{
		$strOption 	= "";
		$strOption	.='<option value="0">--Select--</option>';	
		if($sqlResult->num_rows>0)	
		{
			while($row=$sqlResult->fetch_array())
			{
				$selected	=($row[0]==$strSelVal)?'selected="selected"':'';			
				$strOption.='<option value="'.$row[0].'" '.$selected.' title="'.$row[1].'">'.$row[1].'</option>';
			}
		}
		return $strOption;
	}
	
	//==================== Function to format date ## By T Ketaki Debadarshini ## 28-Aug-2015 ========================
	public function dbDateFormat($date)
	{
			$explDate	= explode('-',$date);
			return $explDate[2].'-'.$explDate[1].'-'.$explDate[0];
	}
	//======== Function to generate random password By : Ashis Kumar Patra On : 14-Dec-2015	========================//
         
          public  function generate_password( $length = 8 ) {
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
                $password = substr( str_shuffle( $chars ), 0, $length );
                return $password;
          }
            
	// ======================Function to send mail ## By T Ketaki Debadarshini ## 28-Aug-2015==========================	
	function Sendmail($strTo,$strFrom,$strSubject,$strMessage,$name='')
	{			
		$MailMessage	= "";
		$headers		= "";
		$name			= ($name!='')?$name:'Sir / Madam';
		if($strTo!="")
		{
			$mailTo		 = $strTo;
			$MailMessage.="<table cellspacing='0' cellpadding='2' border='0' bgcolor='#cccccc'>";
			$MailMessage.="<tr bgcolor='#FFFFFF'>";
			$MailMessage.="<td>Dear ".ucwords(strtolower($name)).",<br></td>";
			$MailMessage.="</tr>";		
			$MailMessage.="<tr bgcolor='#FFFFFF'>";
			$MailMessage.="<td>".$strMessage."</td>";
			$MailMessage.="</tr>";
			$MailMessage.="<tr>";			
			$MailMessage.="</tr>";
			$MailMessage.="</table>";
			$headers.= "FROM:".$strFrom."\n";
			$headers.= "CC:ashok.samal@csm.co.in\n";
			$headers.= 'MIME-Version: 1.0' . "\n";
			$headers.= "Content-Type: text/html; charset=ISO-8859-1\n";
			@mail($mailTo, $strSubject, $MailMessage, $headers); 
		}
	}
        // ======================Function to send mail with attachment ## By T Ketaki Debadarshini ## 28-Aug-2015==========================
        function mail_attachment($filename, $path, $mailto, $from_mail, $from_name,$subject, $message) {
        $MailMessage	= "";
	$headers	= "";  
        if($mailto!="")
	{
        $MailMessage.="<table cellspacing='0' cellpadding='2' border='0' bgcolor='#cccccc'>";
	$MailMessage.="<tr bgcolor='#FFFFFF'>";
	$MailMessage.="<td>".$message."</td>";
	$MailMessage.="</tr>";
	$MailMessage.="<tr>";			
	$MailMessage.="</tr>";
	$MailMessage.="</table>";
        if($filename!=''){
            $file = $path.$filename;
            $file_size = filesize($file);
            $handle = fopen($file, "r");
            $content = fread($handle, $file_size);
            fclose($handle);
            $content = chunk_split(base64_encode($content));
            $uid = md5(uniqid(time()));
            $name = basename($file);
         }
        $header = "From: ".$from_name." <".$from_mail.">\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
        $header .= "This is a multi-part message in MIME format.\r\n";
        if($filename!=''){
            $header .= "--".$uid."\r\n";
            $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
            $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $header .= "--".$uid."\r\n";
            $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
            $header .= "Content-Transfer-Encoding: base64\r\n";
            $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
            $header .= $content."\r\n\r\n";
            $header .= "--".$uid."--";
          } 
          mail($mailTo, $strSubject, $MailMessage, $header); 
        }
        
        }
        // Function to get Max Val
	function getMaxVal($colName,$tableName,$deletedFlag)
	{
		$sql	= "SELECT MAX(".$colName.") AS MAXNO FROM ".$tableName;
		if($deletedFlag!='')
			$sql.= ' WHERE '.$deletedFlag.'=0 ';		
		$result=$this->executeQry($sql);
		$row=$result->fetch_array();
		return $row[0]+1;
	}
        // Function to get Max Val
	function getMaxValdir($colName,$tableName,$catid,$deletedFlag)
	{
		$sql	= "SELECT MAX(".$colName.") AS MAXNO FROM ".$tableName;
		if($deletedFlag!='')
			$sql.= ' WHERE '.$deletedFlag.'=0  AND INT_PLUGIN_ID ='.$catid;		
		$result=$this->executeQry($sql);
		$row=$result->fetch_array();
		return $row[0]+1;
	}	
	
	// Function to get number of unpublished data on CMS dashboard
    function getDashboardCount($tableName)
	{
		 $sql 		= "CALL USP_CMS_DASHBOARD('V','0',0,0,'$tableName');";                 
         $result	= $this->executeQry($sql);
         if ($result->num_rows > 0) 
		 {
			$row	= $result->fetch_array();
			return $row[0];
		 }
	}
	
	
	
	//============ Function to view in money format By ## By Rasmi Ranjan Swain ##  13-Aug-2015=========
	function custom_money_format($n, $d = 2) 
	{
		$n	= str_replace(",","",$n);
		$n = number_format((double)$n, $d, '.', '');
		$n = strrev($n);
	
		if ($d) $d++;
		$d += 3;
	
		if (strlen($n) > $d)
			$n = substr($n, 0, $d) . ','. implode(',', str_split(substr($n, $d), 2));
		return strrev($n);
	}
	//============ Function to Get name by ## By Rasmi Ranjan Swain ## 13-Aug-2015=========
	public function getName($colName,$tableName,$colId,$id,$deletedFlag)
	{		
		$sql	= "SELECT ".$colName." FROM ".$tableName." WHERE ".$colId."='".$id."'";
		if($deletedFlag!='')
			$sql.= ' AND '.$deletedFlag.'=0 ';		
		$result=$this->executeQry($sql);
		$row=$result->fetch_array();
		return $row[0];
	}
	//===========Function to create image from Bite code ## By Rasmi Ranjan Swain ## 13-Aug-2015
	public function getImage($imgCode,$height,$width,$imagePath,$file)
		{		
			$data = base64_decode($imgCode);			
			$im = imagecreatefromstring($data);
			// assign new width/height for resize purpose
			$newwidth 	= $height;
			$newheight  = $width;
			// Create a new image from the image stream in the string
			$thumb = imagecreatetruecolor($newwidth, $newheight); 
			if ($im !== false) {
				// alter or save the image  
				$imgName	= $file.date('ymdhis').'.png';
				$fileName = $imagePath.$imgName; // path to png image
				imagealphablending($im, false); // setting alpha blending on
				imagesavealpha($im, true); // save alphablending setting (important)
				// Generate image and print it
				$resp = imagepng($im, $fileName);
				// resizing png file
				imagealphablending($thumb, false); // setting alpha blending on
				imagesavealpha($thumb, true); // save alphablending setting (important)
				$source = imagecreatefrompng($fileName); // open image
				imagealphablending($source, true); // setting alpha blending on
				list($width, $height, $type, $attr) = getimagesize($fileName);
				imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				$newFilename = $imagePath.$imgName;
				$resp = imagepng($thumb,$newFilename);
				// frees image from memory
				imagedestroy($im);
				imagedestroy($thumb);
				return $imgName;
			}
			
		}
    // function to get file comments
  function getFileComments($file)
    {
        $tokens = token_get_all(file_get_contents($file));
        $comments = array();
        foreach($tokens as $token) {
            if($token[0] == T_COMMENT || $token[0] == T_DOC_COMMENT) {
                $comments[] = $token[1];
            }
        }
        return $comments;
    }

   
   //======== Function to view as number By Sunil Kumar Parida On 13-Aug-2015
   function viewNumber($decimalVal)
   {
   		$lastval	= substr($decimalVal, strpos($decimalVal, ".") + 1);
		if($lastval==0)
		{
			$decimalExpl	= explode('.',$decimalVal);
			$decimalVal		= $decimalExpl[0];
		}
		return $decimalVal;
   }
  
   //======== Function to get designation Name ======
   function getDesgName($desgId)
   {
   		$desgSql	= "CALL USP_DESIGNATION('R',$desgId,'','','', 0, 0, @out);";
		$desgResult	= $this->executeQry($desgSql);
		if ($desgResult->num_rows > 0) 
		{
			$row	= $desgResult->fetch_array();
			return $row['VCH_DESG_NAME'];
		}
   }
  
	//========= Function to get all parent nodes of an Id ===
	function getAllNodes($hierarchyId)	
	{
		$sql        = "SELECT FN_ALL_PARENT($hierarchyId);"; 
		$idResult   = $this->executeQry($sql); 
		$ids   		= $idResult->fetch_array(); 
		return $ids[0];
	}
	//======== Function to convert number to word ======	
	function convert_number_to_words($number) {
		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'one',
			2                   => 'two',
			3                   => 'three',
			4                   => 'four',
			5                   => 'five',
			6                   => 'six',
			7                   => 'seven',
			8                   => 'eight',
			9                   => 'nine',
			10                  => 'ten',
			11                  => 'eleven',
			12                  => 'twelve',
			13                  => 'thirteen',
			14                  => 'fourteen',
			15                  => 'fifteen',
			16                  => 'sixteen',
			17                  => 'seventeen',
			18                  => 'eighteen',
			19                  => 'nineteen',
			20                  => 'twenty',
			30                  => 'thirty',
			40                  => 'fourty',
			50                  => 'fifty',
			60                  => 'sixty',
			70                  => 'seventy',
			80                  => 'eighty',
			90                  => 'ninety',
			100                 => 'hundred',
			1000                => 'thousand',
			1000000             => 'million',
			1000000000          => 'billion',
			1000000000000       => 'trillion',
			1000000000000000    => 'quadrillion',
			1000000000000000000 => 'quintillion'
		);
	
		if (!is_numeric($number)) {
			return false;
		}
	
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}
	
		if ($number < 0) {
			return $negative . $this->convert_number_to_words(abs($number));
		}
	
		$string = $fraction = null;
	
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
	
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . $this->convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= $this->convert_number_to_words($remainder);
				}
				break;
		}
	
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
	
		return $string;
	}
	
	//=========== Function to get json file data ========
	function get_json_value($json, $nodeName, $checkId, $valueNode, $textNode)
	{
		//$strJsonfile   	= file_get_contents($fileName);
		//$json		   	= json_decode($strJsonfile, true); 
		$counter		= 0;
		$types			= '';
		foreach($json[$nodeName] as $type)
		{
			$userTypes	= $json[$nodeName][$counter][$valueNode];
			if($userTypes==$checkId)
			{
				$types	= $json[$nodeName][$counter][$textNode];
				break;
			}
			$counter++;
		}
		return $types;
	} 
        
	// ***function to Get address from Latitude and Longitude Coordinates **BY**RASMI RANJAN SWAIN ON 13-Aug-2015 *** 
	function getAddress($lat, $lon){
	   $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".
				$lat.",".$lon."&sensor=false";
	   $json = @file_get_contents($url);
	   $data = json_decode($json);
	   $status = $data->status;
	   $address = '';
	   if($status == "OK"){
		  $address = $data->results[0]->formatted_address;
		}
	   return $address;
           //====== Function to get user and architach commom ids =========
	
        }
 
	
	function sendSMS($username,$api_password,$sender,$mobile,$message)
	{
		 $route="T";
		 $username=urlencode($username);
		 $api_password=urlencode($api_password);
		 $sender=urlencode($sender);
		 $mobile=$mobile;
		 $message=urlencode($message);
		 $parameters="http://smsideatechnosolutions.info/sendsms?uname=".$username."&pwd=".$api_password."&senderid=".$sender."&to=".$mobile."&msg=".$message."&route=T";
		 $response = fopen($parameters, "r");
		 $RqResponse = stream_get_contents($response);
		 fpassthru($response);
		 fclose($response);
		 if(ctype_digit($RqResponse))
			$messageId	= $RqResponse;
		 else
			$errorMsg	= $RqResponse;
	}
        function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
	}
        function GetResizeImage($objCusModel,$folderPath,$reqWidth,$fieldName,$txtTempName)
		{
           
			$errors=0;
			$errMsg="";
			$image = $fieldName;
			$uploadedfile = $txtTempName;	
	        if ($image) 
				{
                                        $filename = stripslashes($fieldName);
					$extension = $objCusModel->getExtension($filename);
					$extension = strtolower($extension);
					if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
	  					{
							$errMsg=' Unknown Image extension ';
							$errors=1;
	  					}
			else
	 			{
					$size=filesize($txtTempName);
                                        //echo "size".$size;exit();
			if($extension=="jpg" || $extension=="jpeg" )
				{
					$uploadedfile = $txtTempName;
					$src = imagecreatefromjpeg($uploadedfile);
				}
			else if($extension=="png")
				{
					$uploadedfile = $txtTempName;
						//$src = imagecreatefrompng($uploadedfile);
					move_uploaded_file($folderPath,$uploadedfile);
				}
			else 
				{
					$src = imagecreatefromgif($uploadedfile);
				}

			list($width,$height)=getimagesize($uploadedfile);		
			$newwidth=$reqWidth;
			$newheight=($height/$width)*$newwidth;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
                        
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);                              
			$filename = $folderPath. $fieldName;                                                
			imagejpeg($tmp,$filename,100);		
			imagedestroy($src);
			imagedestroy($tmp);
			}
		}
               
		return $errors;//."==".$errMsg;
				
	}
      
    function GetResizeImages($folderPath, $reqWidth, $reqHight, $fieldName, $txtTempName) {
        
            $errors = 0;
            $errMsg = "";
            $image = $fieldName;
            $uploadedfile = $txtTempName;
            if ($image) {
                $filename = stripslashes($fieldName);
                $extension = $this->getExtension($filename);
                $extension = strtolower($extension);
                    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                            $errMsg = ' Unknown Image extension ';
                            $errors = 1;
                    } else {
                            $size = filesize($txtTempName);
                            if ($extension == "jpg" || $extension == "jpeg") {
                                    $uploadedfile = $txtTempName;
                                    $src = imagecreatefromjpeg($uploadedfile);
                            } else if ($extension == "png") {
                                    $uploadedfile = $txtTempName;
                                    //$src = imagecreatefrompng($uploadedfile);
                                    move_uploaded_file($folderPath, $uploadedfile);
                                    } 
                            else {
                            $src = imagecreatefromgif($uploadedfile);
                            }
                            list($width, $height) = getimagesize($uploadedfile);
                            $maxwidth = 800;
                            if ($reqWidth == 0) {
                            if ($width > $maxwidth)
                            $newwidth = $maxwidth;
                            else
                            $newwidth = $width;
                            } else
                            $newwidth = $reqWidth;
                            $newheight = ($height / $width) * $newwidth;
                            if ($reqHight > 0 && $reqHight != '')
                            $newheight = $reqHight;
                            $tmp = imagecreatetruecolor($newwidth, $newheight);
                            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                            $filename = $folderPath . $fieldName;
                            imagejpeg($tmp, $filename, 100);
                            imagedestroy($src);
                            imagedestroy($tmp);
                        }
                }
                    return $errors; //."==".$errMsg;
        }
        
        function wardWrap($ward, $minNum) {
            $returnWard = $ward;
            if (strlen($ward) > $minNum) {
                $remainText = substr($ward, 0, $minNum);
                $string = $remainText;
                $string = explode(' ', $string);
                array_pop($string);
                $string = implode(' ', $string);
                $returnWard = $string . ' ...';
            }
            return $returnWard;
        }
        
        function webPath() {
            if (basename($_SERVER['PHP_SELF']) == 'index.php')
                $strPath = "";
            else
                $strPath = "../";

            $strQS = $_SERVER['QUERY_STRING'];
            $intQSCount = count(explode("&", $strQS));
            //echo $intQSCount."<br>";
            if ($intQSCount > 0) {
                for ($i = 1; $i < $intQSCount; $i = $i + 1) {
                    $strPath = "../" . $strPath;
                }
            }
            return $strPath;
        }
       // ***function to Get previlage details **BY**T Ketaki Debadarshini ON 31-Aug-2015 ***  
       public function checkPrivilege($userId, $glId, $plId, $pagename, $pagetype)
        {
            $strPath = $this->webPath();
            $flag = 0;
            if ($_SESSION['adminPrivilege'] == 1) {
                return array('edit' => '', 'delete' => 'yes', 'active' => 'yes', 'add' => '', 'publish' => 'yes');
            } else {
                //assign $page as 'A' for Add&View, 'V' for view&edit
                $sql = "CALL USP_USER_PERMISSION('S',0,$userId,$glId,$plId,'0','0','0','0','0','0',@out);";
              //  echo $sql;
                $result = $this->executeQry($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_array();
                    $relatedPage = $row['RELATED_PAGES'];
                    $explPage = explode(",", $relatedPage);
                    for ($i = 0; $i < count($explPage); $i++) {
                        if ($explPage[$i] == $pagename) {
                            $flag = 1;
                        }
                    }
                    if ($flag == 0) {
                        header('location: ' . $strPath . 'dashboard/');
                    }
                    
                    $noEdit = '';
                    $noDelete = 'yes';
                    $noActive = 'yes';
                    $noAdd = '';
                    $nopublish = '';
                    if ($pagetype == 'V') {
                        if ($row['INT_MANAGER'] != 1) {
                            if ($row['INT_AUTHOR'] == 1) {
                                $noEdit = 'display:none ';
                                $noDelete = 'No';
                                $noActive = 'No';
                            }
                            if ($row['INT_EDITOR'] == 1) {
                                $noEdit = '';
                                $noDelete = 'No';
                                if ($row['INT_AUTHOR'] == 1)
                                    $noAdd = '';
                                else
                                    $noAdd = '1';
                            }
                            if ($row['INT_PUBLISHER'] == 1) {
                                $noEdit = '';
                                $noDelete = "yes";
                                $noAdd = '1';
                                $nopublish = "yes";
                            }
                            if ($row['INT_PUBLISHER'] == 1) {
                                if ($row['INT_AUTHOR'] == 1)
                                    $noAdd = '';
                                else
                                    $noAdd = '1';
                                $noDelete = 'yes';
                                $noActive = 'yes';
                            }
                        }
                        else {
                            $nopublish = "yes";
                        }
                    }
                    if ($pagetype == 'A') {
                        if ($row['INT_MANAGER'] != 1) {
                            if ($row['INT_AUTHOR'] == 1 && $row['INT_EDITOR'] != 1) {
                                if (isset($_REQUEST['ID'])) {
                                    unset($_REQUEST['ID']);
                                }
                                $noAdd = '';
                            }
                            if ($row['INT_EDITOR'] == 1 && $row['INT_AUTHOR'] != 1) {
                                $noAdd = '1';
                            }
                        }
                    }
                    return array('edit' => $noEdit, 'delete' => $noDelete, 'active' => $noActive, 'add' => $noAdd, 'publish' => $nopublish);
                } else {
                    header('location: ' . $strPath . 'dashboard/');
                }
            }
        }
          public function checkHtmlTags($string, $tags) {
            $flags = 0;
            $tagArr = explode(',', $tags);
            $count = count($tagArr);
            for ($i = 0; $i < $count; $i++) {
                $matchString = strtolower($tagArr[$i]);
                if (strpos($string, $matchString) !== false) {
                    $flags++;
                }
            }
            return $flags;
        }
       /*Function to strip vulnerable tags from ckeditor content by Ashish Kumar Patra*/ 
        public function strip_editor_tag_content($string,$tags){

	if(is_array($tags) AND count($tags) > 0) { 

		foreach ( $tags as $key => $val ) {
			if ( ! is_array( $val ) ) {
			$string = preg_replace( '/<' . $val . '[^>]*>([\s\S]*?)<\/' . $val . '[^>]*>/', '', $string );
			} /*else {
			$string = preg_replace( '/<' . $val[0] . ' ' . $val[1] . '[^>]*>([\s\S]*?)<\/' . $val[0] . '[^>]*>/', '', $string );
			}*/
			$string=preg_replace('/<'.$val.'[^>]*>/i', '', $string);
    		$string=preg_replace('/<\/'.$val.'>/i', '', $string);
		} 
		}
        return $string;
  
     }
   
     /*==============function to check malicious files ==================
			By  : Ashis Kumar Patra
			ON  : 14-Dec-2016
	================================================================*/
	public function isValidFile($filename,$allow_files)
	{
            $exts= array();
            $exts   = explode('.',$filename);
            $flag = 0;
            $blck_files = array('exe','bat','com','pif','php','lnk','msi','msp','hta','cpl','conf','msc','cmd','js','jsp','aspx','asp','ps1','scf','inf','reg','vb','vbs');
            if(count($exts)==2){
                if(in_array(strtolower($exts[1]),$allow_files)){
                    $flag++; 
                }
            }
            if(count($exts)>2){
                for($i=1;$i<count($exts);$i++){
                    if(in_array(strtolower($exts[$i]),$blck_files)){
                      $flag++;
                      $flag++;
                    }
                }
            }
		return $flag;
	}
      /*==============function to check valid Urls ==================
			By  : Ashis Kumar Patra
			ON  : 14-Dec-2016
	================================================================*/  
        public function isValidURL($url) {
            $flags = 0;
            $url = filter_var($url, FILTER_SANITIZE_URL);
            if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
               
            } else {
                $flags++;
            }
            return $flags;
        }

    //======== Function to encrypt data file BY:: Indrani Biswas ON 07-12-2020 ======
     public function encrypt($data)
		{

    		if (version_compare(PHP_VERSION, '7.0.0') >= 0)
    	 {// if server php version >7.0.0 then returns 1 else -1;
            $cipher                 = $this->cipher;
            $ivlen                  = openssl_cipher_iv_length($cipher);
            $iv                       = openssl_random_pseudo_bytes($ivlen);
            $ciphertext_raw = openssl_encrypt($data, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
            $hmac                     = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
            $ciphertext         = base64_encode($iv.$hmac.$ciphertext_raw);

            $replacedStr    = str_replace("/","-",$ciphertext);
            $replacedStr    = str_replace("=","_",$replacedStr);
            $replacedStr    = str_replace("+","$",$replacedStr);
            return $replacedStr;
        }
        else
        {
        	$encrKey	= $this->crypKey;
			$encData	= base64_encode(
				mcrypt_encrypt(
				MCRYPT_RIJNDAEL_128,
				$encrKey,
				$data,
				MCRYPT_MODE_CBC,
				"\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
				)
			);
			$newString	= $data.'|'.$encData;
			$newEncStr	= base64_encode(
				mcrypt_encrypt(
				MCRYPT_RIJNDAEL_128,
				$encrKey,
				$newString,
				MCRYPT_MODE_CBC,
				"\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
				)
			);
			$replacedStr	= str_replace("/","-",$newEncStr);
			$replacedStr	= str_replace("=","_",$replacedStr);
			$replacedStr	= str_replace("+","$",$replacedStr);
			return $replacedStr;
        }
    }
    
    //======== Function to decrypt data file BY:: Indrani Biswas ON 07-12-2020 ======

    public function decrypt($data)
		{
			if (version_compare(PHP_VERSION, '7.0.0') >= 0) 
			{
				$replacedStr    = str_replace("-","/",$data);
            $replacedStr    = str_replace("_","=",$replacedStr);
            $replacedStr    = str_replace("$","+",$replacedStr);

            $decryptTxt                    = '';
            $cipher                         = $this->cipher;
            $c                                     = base64_decode($replacedStr);
            $ivlen                             = openssl_cipher_iv_length($cipher);
            $iv                                 = substr($c, 0, $ivlen);
            $hmac                             = substr($c, $ivlen, $sha2len=32);
            $ciphertext_raw         = substr($c, $ivlen+$sha2len);
            $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
            $calcmac                         = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);


            if($replacedStr!='')
            {
                if (hash_equals($hmac, $calcmac))
                {
                    $decryptTxt = $original_plaintext;
                }
            }

            return $decryptTxt;
        }
        else
        {
        	$replacedStr	= str_replace("-","/",$data);
			$replacedStr	= str_replace("_","=",$replacedStr);
			$replacedStr	= str_replace("$","+",$replacedStr);
			$decrKey	= $this->crypKey;
			$decode 	= base64_decode($replacedStr);
			$decrData	= mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128,
			$decrKey,
			$decode,
			MCRYPT_MODE_CBC,
			"\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
			);
			$explDecrData	= explode('|',$decrData);
			$decrData1	 	= base64_decode($explDecrData[1]);		
			$decrData2		= mcrypt_decrypt(
			MCRYPT_RIJNDAEL_128,
			$decrKey,
			$decrData1,
			MCRYPT_MODE_CBC,
			"\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
			);		
			if(trim($explDecrData[0]) == trim($decrData2))
			{
				return trim($decrData2);
			}
			else
			{
				return '';
			}
        }
     }

     
}
?>
