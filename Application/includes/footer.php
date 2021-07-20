	  <!-- /.main-content -->
    </div>
    <!-- /.main-container -->
</div>
<div class="modal fade in" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="alertMessage center"></h4>
        <div class="form-group">
          <div class="center"> <a class=" btn btn-danger btn-sm" id="btnAlertOk" data-dismiss="modal" style="width:100px; margin-top:30px;">Ok</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade in" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="confirmMessage center"></h4>
        <div class="form-group">
          <div class="center"> 
		  <a class=" btn btn-success btn-sm" id="btnConfirmOk" data-dismiss="modal" style="width:100px; margin-top:30px;">Yes</a> 
		  <a class=" btn btn-danger btn-sm" id="btnConfirmCancel" data-dismiss="modal" style="width:100px; margin-top:30px;">No</a> 
		  
		  </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="footer footer-fixed">
    <div class="footer-inner">
      <div class="footer-content"> <span class="bigger-120" id="footertext" >&copy <?php echo date('Y');?>-  All Rights Reserved - Raj Bhavan, Odisha</span>
      <!--<span class="pull-right">Visit : <a href="http://bmsicl.gov.in" title="bmsicl.gov.in" target="_blank">bmsicl.gov.in</a></span>-->
      </div>
    </div>
  </div>
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a>
<!-- basic scripts -->

</form>
<script>
    $(document).ready(function(){
      configTitleBar();	
	
    });
</script>

		<script src="<?php echo APP_URL;?>js/bootstrap.min.js"></script>
<!-- page specific plugin scripts -->
<!--[if lte IE 8]>
		<script src="<?php echo APP_URL;?>js/excanvas.min.js"></script>
<![endif]-->
		<script src="<?php echo APP_URL;?>js/jquery-ui.custom.min.js"></script>
<!-- ace scripts -->
		<script src="<?php echo APP_URL;?>js/ace-elements.min.js"></script>
		<script src="<?php echo APP_URL;?>js/ace.min.js"></script>
<!-- inline scripts related to this page -->
</body>
</html>