<?php
/*======================================================
	File Name         	  : leftmenu.php
	Description	          : This page is used to view the left sidebar menu.	
	Developed By		  : T Ketaki Debadarshini
        Developed On		  : 31-Aug-2015
	Update History		  :
	<Updated by>		<Updated On>		<Remarks>
			
	=======================================================*/
include_once(APP_CLASS_PATH . "clsUserPermission.php");
include_once(APP_CLASS_PATH . "clsAdminLinks.php");
$sessUserId  = $_SESSION['adminConsole_userID'];
if (isset($_SESSION['userPrivilege'])) {
	$intPreviligeStatus = $_SESSION['userPrivilege'];
	$adminPrevilegeStatus = $_SESSION['adminPrivilege'];
}
?>
<script type="text/javascript" language="javascript">
	$(document).ready(function() {

		$('.submenu').click(function(e) {
			e.stopImmediatePropagation();
		});
		$('.hsub').live("click", function() {
			if ($(this).find('li').hasClass('active') && $(this).find('ul').is(':visible')) {
				$(this).find('ul').hide();
				return false;
			}
			$('.active ul').hide();
		});
		//var gLink=(getCookie("GLink")!='' && getCookie("GLink")>0)?getCookie("GLink"):0;
		//var pLink=(getCookie("PLink")!='' && getCookie("PLink")>0)?getCookie("PLink"):0;	
		$('.mainLi').each(function() {
			var dataVal = $(this).data('val');
			if (dataVal == '<?php echo $glId; ?>') {
				$(this).addClass('open');
				$(this).find('.submenu').addClass('nav-show');
				$(this).find('.submenu').show();
				$(this).find('li').each(function() {
					var dataSubVal = $(this).data('subval');
					if (dataSubVal == '<?php echo $plId; ?>') {
						$(this).addClass('active');
					}
				});
			}
		});

		if ('<?php echo strtolower($page); ?>' == 'dashboard') {
			gLink = 0;
			pLink = 0;
			removeCookie("GLink");
			removeCookie("PLink");
		}
	});
</script>

<div id="sidebar" class="sidebar responsive">
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse"> <i class="ace-icon fa fa-outdent" data-icon1="ace-icon fa fa-outdent" data-icon2="ace-icon fa fa-indent"></i> </div>
	<ul class="nav nav-list" style="top: 0px;">
		<li id="dashboard" class="mainLi" data-val="0"> <a href="javascript:void(0);" onclick="goToPage('<?php echo APP_URL; ?>dashboard',0,0,'Dashboard','Dashboard');" title="Dashboard"> <i class="menu-icon fa fa-tachometer"></i> <span class="menu-text"> Dashboard </span> </a> <b class="arrow"></b> </li>

		<?php

		$obj            = new clsUserPermission;

		if ($adminPrevilegeStatus != 1) //If not  admin user 
		{
			$perResult    = $obj->managePermission('DG', '0', $sessUserId, '0', '0', '0', '0', '0', '0', '0', '0');
			if ($perResult->num_rows > 0) {
				while ($perRow  = $perResult->fetch_array()) {
					$adminGl    = $perRow['GL_ID'];
					?>
					<li class="hsub mainLi <?php if ($_REQUEST["GL"] == $adminGl) { ?> open<?php } ?>" id="manageUser" data-val="<?php echo $adminGl; ?>"> <a href="javascript:void(0);" title="<?php echo $perRow['GL_NAME']; ?>" class="dropdown-toggle"> <i class="menu-icon fa <?php echo $perRow['GL_IMAGE']; ?>"></i> <span class="menu-text"> &nbsp;<?php echo $perRow['GL_NAME']; ?></span> <b class="arrow fa fa-angle-down"></b></a> <b class="arrow"></b>
						<?php
						$adminPLResult  = $obj->managePermission('S', '0', $sessUserId, $adminGl, '0', '0', '0', '0', '0', '0', '0');
						if ($adminPLResult->num_rows > 0) {
						?>
							<ul class="submenu <?php if ($_REQUEST["GL"] == $adminGl) { ?> nav-show<?php } ?>">
								<?php
								while ($adminPLRow  = $adminPLResult->fetch_array()) {
									$adminPL    = $adminPLRow['INT_PL_ID'];
									$intFunctionId  = $adminPLRow['INT_FUNCTION_ID'];
									$vchUrl     = $adminPLRow['PL_URL'];
									$href       = $vchUrl;

									if ($intFunctionId > 0)
										$redirectUrl = APP_URL . 'redirectPage' . '/' . $adminGl . '/' . $adminPL;
									else
										$redirectUrl = APP_URL . $href . '/' . $adminGl . '/' . $adminPL;

									// echo $redirectUrl;

								?>
									<li id="addUser" data-subval="<?php echo $adminPL; ?>" <?php if ($_REQUEST["GL"] == $adminGl && $_REQUEST["PL"] == $adminPL) { ?> class="active" <?php } ?>> <a href="<?php echo $redirectUrl; ?>" title="<?php echo $adminPLRow['PL_NAME']; ?>"> <i class="menu-icon fa fa-caret-right"></i> <?php echo $adminPLRow['PL_NAME']; ?></a> <b class="arrow"></b> </li>
								<?php
								}
								?>
							</ul>
						<?php
						}
						?>

					<?php
				}
			}
		} else {
			$objLeftMLinks = new clsAdminLinks;
			//$leftGlSql	= "CALL USP_ADMIN_GL('S','0','',@OUT);";
			$leftGlResult  = $objLeftMLinks->manageAdminGLinks('S', '0', '');
			while ($perRow  = mysqli_fetch_array($leftGlResult)) {
				$adminGl = $perRow['INT_ADMIN_GL_ID'];
					?>
					<li class="hsub mainLi <?php if ($_REQUEST["GL"] == $adminGl) { ?> open<?php } ?>" id="manageUser" data-val="<?php echo $adminGl; ?>"> <a href="javascript:void(0);" title="<?php echo $perRow['VCH_GL_NAME']; ?>" class="dropdown-toggle"> <i class="menu-icon fa <?php echo $perRow['VCH_IMAGE']; ?>"></i> <span class="menu-text"> &nbsp;<?php echo $perRow['VCH_GL_NAME']; ?></span> <b class="arrow fa fa-angle-down"></b></a> <b class="arrow"></b>
						<?php
						// $adminPLSql	= "CALL USP_ADMIN_PL('S','0','$adminGl','','',@OUT);";
						$adminPLResult  = $objLeftMLinks->manageAdminPLinks('S', '0', $adminGl, '', '');
						if (mysqli_num_rows($adminPLResult) > 0) {

						?>
							<ul class="submenu <?php if ($_REQUEST["GL"] == $adminGl) { ?>nav-show<?php } ?>">
								<?php
								while ($adminPLRow  = mysqli_fetch_array($adminPLResult)) {
									$adminPL  = $adminPLRow['INT_ADMIN_PL_ID'];
									$intFunctionId  = $adminPLRow['INT_FUNCTION_ID'];
									$vchUrl     = $adminPLRow['VCH_URL'];
									$href       = $vchUrl;

									if ($intFunctionId > 0)
										$redirectUrl = APP_URL . 'redirectPage' . '/' . $adminGl . '/' . $adminPL;
									else
										$redirectUrl = APP_URL . $href . '/' . $adminGl . '/' . $adminPL;
								?>
									<li id="addUser" data-subval="<?php echo $adminPL; ?>"> <a href="<?php echo $redirectUrl; ?>" title="<?php echo $adminPLRow['VCH_PL_NAME']; ?>" <?php if ($_REQUEST["GL"] == $adminGl && $_REQUEST["PL"] == $adminPL) { ?> class="active" <?php } ?>> <i class="menu-icon fa fa-caret-right"></i> <?php echo $adminPLRow['VCH_PL_NAME']; ?></a> <b class="arrow"></b> </li>
								<?php
								}
								?>
							</ul>
						<?php
						}
						?>
					</li>
			<?php
			}
		}
			?>

	</ul>
	<!-- /.nav-list -->
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {}
	</script>
</div>