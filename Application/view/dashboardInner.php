<?php
/* ================================================
	File Name         	  : dashboardInner.php
	Description		  : This is for Dashboard.	
	Date Created		  : 13-Aug-2015
	Created By	          : T Ketaki Debadarshini
	Update History		  :	<Updated by>				<Updated On>		<Remarks>
	
	Include Functions	  : 
	==================================================*/
	$userType		= $_SESSION['adminConsole_UserType'];
	$userId			= $_SESSION['adminConsole_userID'];
	$userPrivilege	= $_SESSION['adminConsole_Privilege'];
	
	$objDashboard	= new clsDashboard;
	$dataResult		= $objDashboard->viewApplicationGraph();
	$totalApplicant	= '';
	$totalApproved	= '';
	$totalCertified	= '';
	foreach($dataResult as $data)
	{
		$totalApplicant	.= '["'.$data['DistName'].'",'.$data['totalApplied'].'],';
		$totalApproved	.= '["'.$data['DistName'].'",'.$data['Approved'].'],';
		$totalCertified	.= '["'.$data['DistName'].'",'.$data['Certified'].'],';
	}
	$totalApplicant	= substr($totalApplicant,0,-1);
	$totalApproved	= substr($totalApproved,0,-1);
	$totalCertified	= substr($totalCertified,0,-1);
?>