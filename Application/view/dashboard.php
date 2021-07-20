<?php
	/* ================================================
	File Name         	  : dashboard.php
         Description		  : This is for Dashboard.
        Author Name               : Ramakanta Mishra
	Date Created		  :  13-Aug-2015
	Designed By		  :	Ramakanta Mishra
        Designed On		  :	 13-Aug-2015
	Update History		  :
						<Updated by>		<Updated On>		<Remarks>
						
	Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                            
	Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js
	includes			  :

	==================================================*/
	//require("dashboardInner.php");
	
?>
<script src="<?php echo APP_URL;?>js/jquery.jqChart.min.js"></script>
<script src="<?php echo APP_URL;?>js/excanvas.js"></script>
<script src="<?php echo APP_URL;?>js/loadAjax.js"></script>
<script src="<?php echo APP_URL;?>js/validatorchklist.js"></script>
<script language="javascript">
	$(document).ready(function () {
		//loadNavigation('Dashboard', '', 'Dashboard');
		pageHeader   = "Dashboard";
                strFirstLink = "";
                strLastLink  = "Dashboard";
		//Tooltip
		$('[data-rel=tooltip]').tooltip();
		
		$('#jqChart').jqChart({
                title: { text: '' },
                animation: { duration: 1 },
                shadows: {
                    enabled: true
                },
				border: {
            		padding: 10,
            		lineWidth: 0,
            		strokeStyle: '#fff'
        		},
				tooltips: {
            		background: '#fff'
                },
				legend: {
            		visible: true,
            		location : 'top',
            		allowHideSeries: true,
            	},
                series: [
                    {
                        type: 'column',
                        title: 'Applied',
                        fillStyle: '#2091CF',
                        data: [<?php echo $totalApplicant;?>]
                    },
                    {
                        type: 'column',
                        title: 'Approved',
                        fillStyle: '#f89406',
                        data: [<?php echo $totalApproved;?>]
                    },
                    {
                        type: 'column',
                        title: 'Permission Issued',
                        fillStyle: '#5CB85C',
                        data: [<?php echo $totalCertified;?>]
                    }
                ]
            });
			
			$('#viewChart').hide();
			$('.viewApplicantNum').hide();
			$('#viewDetails').click(function(){
				$('#jqChart').hide('fast');
				$('.viewApplicantNum').show('slow');
				$('#viewDetails').hide();
				$('#viewChart').show();
			});
			$('#viewChart').click(function(){
				$('.viewApplicantNum').hide('fast');
				$('#jqChart').show('slow');
				$('#viewDetails').show();
				$('#viewChart').hide();
			});
			
			$('.scrollable-horizontal').each(function () {
					var $this = $(this);
					$(this).ace_scroll(
					  {
						horizontal: true,
						styleClass: 'scroll-top',//show the scrollbars on top(default is bottom)
						size: $this.attr('data-size') || 500,
						mouseWheelLock: true
					  }
					).css({'padding-top': 0});
				});
			$('.scrollable').each(function () {
				var $this = $(this);
				$(this).ace_scroll({
					size: $this.data('size') || 293,
					//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
				});
			});
			setTimeout(function(){$('.scrollable2').each(function () {
				var $this = $(this);
				$(this).ace_scroll({
					size: $this.data('size') || 253,
					//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
				});
			});},500);
			$(window).scroll(function () {
				if($('#dashboardTable').offset().top <= $(window).scrollTop()){
					$('#scrollable-horizontal').removeClass('scroll-top');
				} else {
					$('#scrollable-horizontal').addClass('scroll-top');			
				}
    		});
				
			$(window).on('resize.scroll_reset', function() {
				$('.scrollable-horizontal').ace_scroll('reset');
			});
	});
	
	function viewUser(flag)
	{		
		if(flag==3)
			$('#txtApplName').val('');
		if (!checkSpecialChar('txtApplName'))
			return false;
		if (!maxLength('txtApplName', 50, 'Applicant Name'))
			return false;
		
		var applName	= $('#txtApplName').val();
		if(flag==1)
		{
			var recNo	= $('#hdnRecNo').val();
			$.fillApplicantDetails(recNo, applName, 'applicantInfo','hdnRecNo','A');
		}
		else
		{
			$.fillApplicantDetails(0, applName, 'applicantInfo','hdnRecNo','');
		}
	}
</script>

   <div class="page-content">
    <div class="page-header">
        <h1 id="title"></h1>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-xs-12">
          <h1 class="text-center welcomeMsg">Welcome Administrator</h1>
        </div>
    </div>

</div>
 
