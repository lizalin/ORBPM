<?php
	/* ================================================
	File Name         	: addDirectorycategoryInner.php
	Description		: This page is used to add Directory category .
	Developed By		: Chinmayee
	Developed On		: 03-06-2016
	Update History		:
	<Updated by>		<Updated On>		<Remarks>
     
	Class Used		: clsDircategory
	Functions Used		: addUpdateDircategory()
	==================================================*/	
	
	$obj                = new clsDircategory;
        $id                 = (isset($_REQUEST['ID']))?$_REQUEST['ID']:0;
        $strclick           =($id>0)?"window.location.href='". APP_URL."viewDirectorycategory/".$glId."/".$plId."';":"";
        $intStatus          = 2;
// ========= On form submit ========================
	if(isset($_POST['btnSubmit']))
	{
           $result          = $obj->addUpdateDircategory($id);
           $outMsg          =  $result['msg']; 
         //  echo $outMsg;
           $flag            =  $result['flag'];
            
        }
       
?>