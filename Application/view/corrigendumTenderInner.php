<?php
    /* ================================================
    File Name         	: corrigendumTenderInner.php
    Description		: This page is used to add corrigendum Tender Details.
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
	$strTab         = 'Corrigendum Tenders';
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
         
            $txtCorrigdnumFile		= $_FILES['fileCorrigdnum']['name'];
            $txtCorrigdnumFile2		= $_FILES['fileCorrigdnum2']['name'];
            $txtCorrigdnumFile3		= $_FILES['fileCorrigdnum3']['name'];
            
            $prevCorrigdnumFile		= $_POST['hdnCorrigdnumFile'];
            $prevCorrigdnumFile2        = $_POST['hdnCorrigdnumFile2'];
            $prevCorrigdnumFile3        = $_POST['hdnCorrigdnumFile3'];
           
            $corrigdnumSize		= $_FILES['fileCorrigdnum']['size'];
            $corrigdnumTemp		= $_FILES['fileCorrigdnum']['tmp_name'];
            $ext 			= pathinfo($txtCorrigdnumFile, PATHINFO_EXTENSION);	

            $corrigdnumSize2		= $_FILES['fileCorrigdnum2']['size'];
            $corrigdnumTemp2		= $_FILES['fileCorrigdnum2']['tmp_name'];
            $ext2 			= pathinfo($txtCorrigdnumFile2, PATHINFO_EXTENSION);	
            $corrigdnumSize3		= $_FILES['fileCorrigdnum3']['size'];
            $corrigdnumTemp3		= $_FILES['fileCorrigdnum3']['tmp_name'];
            $ext3 			= pathinfo($txtCorrigdnumFile3, PATHINFO_EXTENSION);	
            
            $corrigdnumFile             = ($txtCorrigdnumFile!='')?'corrigendumFile_'.date("Ymd_His").'.'.$ext:'';
            $corrigdnumFile2		= ($txtCorrigdnumFile2!='')?'corrigendumFile_2'.date("Ymd_His").'.'.$ext2:'';
            $corrigdnumFile3		= ($txtCorrigdnumFile3!='')?'corrigendumFile_3'.date("Ymd_His").'.'.$ext3:'';
       
       
             $outMsg = '';
         
             $errFlag            = 0 ;
             if (($corrigdnumSize > size5MB) || ($corrigdnumSize2 > size5MB) || ($corrigdnumSize3 > size5MB)) {
                 $errFlag               = 1;
                 $flag                  = 1;
                 $outMsg = 'File size can not more than 5 MB';
             }
            
           if($txtCorrigdnumFile=='' && $ddlTenderId!='')
              $corrigdnumFile= $prevCorrigdnumFile;
             if($txtCorrigdnumFile2=='' && $ddlTenderId!='')
              $corrigdnumFile2= $prevCorrigdnumFile2;
            if($txtCorrigdnumFile3=='' && $ddlTenderId!='')
              $corrigdnumFile3= $prevCorrigdnumFile3;
            if($errFlag!=1) 
            {
                    $result = $objTender->manageTender('CR',$ddlTenderId,'','','0000-00-00','0000-00-00','','',$corrigdnumFile,'','','',0,0,0,0,$userId,'','','','',$corrigdnumFile2,$corrigdnumFile3);

                     if ($result)
                     {
                         $outMsg = 'Corrigendum details added successfully ';

                       if($txtCorrigdnumFile!='')
                            {
                                    if(file_exists("uploadDocuments/Tender/Corrigendum/".$prevCorrigdnumFile) && $prevCorrigdnumFile!='')
                                    {
                                            unlink("uploadDocuments/Tender/Corrigendum/".$prevCorrigdnumFile);
                                    }
                                    move_uploaded_file($corrigdnumTemp,"uploadDocuments/Tender/Corrigendum/".$corrigdnumFile);
                            }
                            if($txtCorrigdnumFile2!='')
                            {
                                    if(file_exists("uploadDocuments/Tender/Corrigendum/".$prevCorrigdnumFile2) && $prevCorrigdnumFile2!='')
                                    {
                                            unlink("uploadDocuments/Tender/Corrigendum/".$prevCorrigdnumFile2);
                                    }
                                    move_uploaded_file($corrigdnumTemp2,"uploadDocuments/Tender/Corrigendum/".$corrigdnumFile2);
                            }
                            if($txtCorrigdnumFile3!='')
                            {
                                    if(file_exists("uploadDocuments/Tender/Corrigendum/".$prevCorrigdnumFile3) && $prevCorrigdnumFile3!='')
                                    {
                                            unlink("uploadDocuments/Tender/Corrigendum/".$prevCorrigdnumFile3);
                                    }
                                    move_uploaded_file($corrigdnumTemp3,"uploadDocuments/Tender/Corrigendum/".$corrigdnumFile3);
                            }
                     }
            }
              
          
	}
        ?>