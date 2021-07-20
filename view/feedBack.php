<?php
require 'feedbackInner.php';
?>       

<div class="page-navigator">
   <div class="container">   
   <h2>Feedback</h2>      
      <ul class="breadcrumb">
          <li><a href="<?php echo SITE_URL;?>"><i class="fa fa-home"></i></a></li>
              <li>Feedback</li>          
      </ul>
   
  
  
 
</div>
</div>
<!--=== Content Section ===-->
<div class="container">
    <div class="content-sec">  
            <!--=== Content ===-->
            
             <div class="content-inner">
            <div class="feedback">
            <form name="frmFeedback" method="post" id="frmFeedback">
              <div class="form-group">
              <label for="txtFeedbackUserName">Name</label>
              <input type="text" class="form-control" id="txtFeedbackUserName" name="txtFeedbackUserName" maxlength="100" placeholder="">
              </div>
              <div class="form-group">
              <label for="txtFeedbackUserName">Mobile No.</label>
              <input type="text" class="form-control" id="txtFeedbackUserName" name="txtFeedbackUserName" maxlength="10" placeholder="">
              </div>
              <div class="form-group">
              <label for="txtFeedbackEmail">Email Id</label>
              <input type="text" class="form-control" id="txtFeedbackEmail" name="txtFeedbackEmail" placeholder="" maxlength="200">
              </div>
              <div class="form-group">
              <label for="txtFeedbackMessage">Message</label>
              <textarea type="text" class="form-control" id="txtFeedbackMessage" name="txtFeedbackMessage" placeholder="" rows="4" cols="50" maxlength="500"></textarea>
              </div>
                          <button type="submit" name="btnFeedbackSubmit" id="btnFeedbackSubmit" class="btnsrtyle2" onclick="return validateFeedback();" value="submitFeedback">Submit</button>
              </form>
              
              </div>

                </div>
              </div>
            </div>
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
            <script type="text/javascript">
  $(document).ready(function(){
    <?php if(!empty($outMsg)){?>
      viewAlert('<?php echo $outMsg;?>');
    <?php }?>
  });
  function validateFeedback()
  {
    if (!blankCheck('txtFeedbackUserName', 'Name can not be left blank'))
            return false;
        if (!checkSpecialChar('txtFeedbackUserName'))
            return false;
        if (!maxLength('txtFeedbackUserName',100, 'Name'))
            return false;

        if (!blankCheck('txtFeedbackMob', 'Mobile No. can not be left blank'))
            return false;
        // if (!validMobileNo('txtFeedbackMob','Please enter a valid mobile no.'))
        //     return false;
      

        if (!blankCheck('txtFeedbackEmail', 'Email Id can not be left blank'))
            return false;
        if (!validEmail('txtFeedbackEmail'))
            return false;
        if (!maxLength('txtFeedbackEmail',200, 'Email Id'))
            return false;

        if (!blankCheck('txtFeedbackMessage', 'Message can not be left blank'))
            return false;
        if (!checkSpecialChar('txtFeedbackMessage'))
            return false;
        if (!maxLength('txtFeedbackMessage',500, 'Message'))
            return false;
        $('#frmFeedback').submit();
  }
</script>

<!--=== Content Section ===-->
  <?php include("../include/footer.php");?>
  
  </body>
