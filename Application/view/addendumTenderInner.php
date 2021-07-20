<?php
    /* ================================================
    File Name         	: addendumTenderInner.php
    Description		: This page is used to add Addendum Tender Details.
    Developed By	: T Ketaki Debadarshini
    Developed On	: 14-Sept-2015
    Update History	:
    <Updated by>		<Updated On>		<Remarks>

    Class Used		: clsTender
    Functions Used	: manageTender()
    ==================================================*/	
	//========== create object of clsTender class===============	
	$objTender      = new clsTender;	
        $id             = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strSubmit      = ($id>0)?'Update':'Submit';
	$strReset       = ($id>0)?'Cancel':'Reset';
	$strTab         = 'Addendum Tenders';
        $strclick       = ($id>0)?"window.location.href='". APP_URL."viewTender/".$glId."/".$plId."';":"";
        //========== Permission ===============	
        $glId          = $_REQUEST['GL'];
        $plId          = $_REQUEST['PL'];
        $pageName      = $_REQUEST['PAGE'].'.php';
        $userId        = $_SESSION['adminConsole_userID'];
        $explPriv      = $objTender->checkPrivilege($userId, $glId, $plId, $pageName, 'A');
        $noAdd         = $explPriv['add'];
        
        if ($noAdd == 1 && $id==0)
           echo "<script>location.href = '".APP_URL."viewTender/".$glId."/".$plId."'</script>";                     
               
	//========== Default variable ===============				
	$intWinStatus    = 1;
	$flag            = 0;  
        $errFlag         = 0;
        $intLinkType     = 1;
        $intTempletType  = 1;	
	$outMsg          = '&nbsp;';	

	//============ Button Submit ===================
	if(isset($_POST['btnSubmit']))
	{
            $ddlTenderId		= $_POST['ddlTenderno'];
         
            $txtAddendumFile		= $_FILES['fileAddendum']['name'];
            $txtAddendumFile2		= $_FILES['fileAddendum2']['name'];
            $txtAddendumFile3		= $_FILES['fileAddendum3']['name'];
            
            $prevAddendumFile		= $_POST['hdnAddendumFile'];
            $prevAddendumFile2          = $_POST['hdnAddendumFile2'];
            $prevAddendumFile3          = $_POST['hdnAddendumFile3'];
           
            $addendumSize		= $_FILES['fileAddendum']['size'];
            $addendumTemp		= $_FILES['fileAddendum']['tmp_name'];
            $ext 			= pathinfo($txtAddendumFile, PATHINFO_EXTENSION);	

            $addendumSize2		= $_FILES['fileAddendum2']['size'];
            $addendumTemp2		= $_FILES['fileAddendum2']['tmp_name'];
            $ext2 			= pathinfo($txtAddendumFile2, PATHINFO_EXTENSION);	
            $addendumSize3		= $_FILES['fileAddendum3']['size'];
            $addendumTemp3		= $_FILES['fileAddendum3']['tmp_name'];
            $ext3 			= pathinfo($txtAddendumFile3, PATHINFO_EXTENSION);	
            
            $addendumFile               = ($txtAddendumFile!='')?'addendumFile_'.date("Ymd_His").'.'.$ext:'';
            $addendumFile2		= ($txtAddendumFile2!='')?'addendumFile_2'.date("Ymd_His").'.'.$ext2:'';
            $addendumFile3		= ($txtAddendumFile3!='')?'addendumFile_3'.date("Ymd_His").'.'.$ext3:'';
       
       
             $outMsg = '';
         
             $errFlag            = 0 ;
             if (($addendumSize > size5MB) || ($addendumSize2 > size5MB) || ($addendumSize3 > size5MB)) {
                 $errFlag               = 1;
                 $flag                  = 1;
                 $outMsg = 'File size can not more than 5 MB';
             }
            
           if($txtAddendumFile=='' && $ddlTenderId!='')
              $addendumFile=$prevAddendumFile;
             if($txtAddendumFile2=='' && $ddlTenderId!='')
              $addendumFile2=$prevAddendumFile2;
            if($txtAddendumFile3=='' && $ddlTenderId!='')
              $addendumFile3=$prevAddendumFile3;
            if($errFlag!=1) 
            {
                    $result = $objTender->manageTender('AD',$ddlTenderId,'','','0000-00-00','0000-00-00','',$addendumFile,'','','','',0,0,0,0,$userId,'','',$addendumFile2,$addendumFile3,'','');

                     if ($result)
                     {
                         $outMsg = 'Addendum details added successfully ';

                       if($txtAddendumFile!='')
                            {
                                    if(file_exists("uploadDocuments/Tender/Addendum/".$prevAddendumFile) && $prevAddendumFile!='')
                                    {
                                            unlink("uploadDocuments/Tender/Addendum/".$prevAddendumFile);
                                    }
                                    move_uploaded_file($addendumTemp,"uploadDocuments/Tender/Addendum/".$addendumFile);
                            }
                            if($txtAddendumFile2!='')
                            {
                                    if(file_exists("uploadDocuments/Tender/Addendum/".$prevAddendumFile2) && $prevAddendumFile2!='')
                                    {
                                            unlink("uploadDocuments/Tender/Addendum/".$prevAddendumFile2);
                                    }
                                    move_uploaded_file($addendumTemp2,"uploadDocuments/Tender/Addendum/".$addendumFile2);
                            }
                            if($txtAddendumFile3!='')
                            {
                                    if(file_exists("uploadDocuments/Tender/Addendum/".$prevAddendumFile3) && $prevAddendumFile3!='')
                                    {
                                            unlink("uploadDocuments/Tender/Addendum/".$prevAddendumFile3);
                                    }
                                    move_uploaded_file($addendumTemp3,"uploadDocuments/Tender/Addendum/".$addendumFile3);
                            }
                     }
            }
              
          
	}
        ?>