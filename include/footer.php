<?php 
$objGlmenu   = new clsGlobalLink;
$FootermenuRes = $objGlmenu->manageGL('VP', 0, 0, 0 , 4, 0,'', '');
$objLink     = new clsLink;
$impLink     = $objLink->manageLink('V',0,'','','','',0,0,0,0,0,'');

?>
 <!--Start of Footer-->
<div class="footercontainer">
<footer class="page-footer font-small mdb-color pt-4">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div>
      <div class="row text-center text-md-left mt-3 pb-3">
        <?php
          while ($glrow = $FootermenuRes->fetch_array()) {
                $glpageid   = $glrow['intPageId'];
                $glpageName = htmlspecialchars_decode($glrow['vchTitle'],ENT_NOQUOTES);

        $FooterSubmenuRes = $objGlmenu->manageGL('VP', 0, 0, $glpageid , 4, 0,'', '');
          
        ?>
        <div class="col-md-3 col-lg-3 col-xl-3 mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold"><?php echo $glpageName?></h6>
        <ul class="footerlink">
        <?php 
        while ($glsubrow = $FooterSubmenuRes->fetch_array()) {
            $glpageid   = $glsubrow['intPageId'];
            $glpageName = htmlspecialchars_decode($glsubrow['vchTitle'],ENT_NOQUOTES);
            $iconClass  = $glsubrow['vchMetaImage'];
            $menuGlUrl          = htmlspecialchars_decode($glsubrow['vchUrl'],ENT_NOQUOTES);
            $pluginGlName       = htmlspecialchars_decode($glsubrow['pageName'],ENT_NOQUOTES);
            $intLinkGLType      = $glsubrow['intLinkType'];
            $intTemplateGLType  = $glsubrow['intTemplateType'];
            $intGlWindownStatus = $glsubrow['intWindowStatus'];
            $gliconClass        = $glsubrow['vchMetaImage'];
            $exglodegl      = explode(' ',$gliconClass); 
            $glicon=$exglodegl[0];
            $strglDocFile   = $glsubrow['vchLinkImage'];
            $glPageAlias    = $glsubrow['vchPageAlias']; 
            
            if($intLinkGLType == 1)
            {
                if($intTemplateGLType == 1 || $intTemplateGLType == 3)
                {
                    $ghref = SITE_URL.'content/'.$glPageAlias;
                }
                else if($intTemplateGLType == 2)
                {
                    $ghref = SITE_URL.$pluginGlName.'/'.$glPageAlias;
                }
                else if($intTemplateGLType == 4)
                {
                    $ghref = APP_URL.'uploadDocuments/LinkDoc/'.$strglDocFile;
                }
            }else if($intLinkGLType == 2)
            {
                $ghref = $menuGlUrl;
            }  
            if($intGlWindownStatus == 1)
            {
                $glTargetBlank = '';
            }
            else
            {
                $glTargetBlank = 'target="_blank"';
            }
        ?>
        
          <li><a href="<?php echo $ghref ?>"><?php echo $glpageName?></a></li>
          <?php }?> 
        </ul> 
      </div>
    <?php }?>
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
        <ul class="footerlink">
          <?php 
            while ($row = mysqli_fetch_array($impLink)) {?>
              <li><a href="<?php  echo htmlspecialchars_decode($row['vchUrl'],ENT_NOQUOTES);?>" target="_blank"><?php  echo htmlspecialchars_decode($row['vchLinkNameE'],ENT_NOQUOTES);?></a></li>
            <?php }
          ?> 
        </ul>
      </div>
    </div>
     
  </div>
   
    <!-- Footer links -->

   


  </div>
  <!-- Footer Links -->

</footer>

   
    <section class="copy_right"> 
      <div class="container">
     <div class="row d-flex align-items-center">

      <div class="col-md-12 col-lg-12">
        <div class="footer-list">
        <ul>
          <li><a href="<?php echo SITE_URL;?>index">Home</a></li>
          <li><a href="<?php echo SITE_URL;?>contactUs">Contact Us</a></li>
          <li><a href="<?php echo SITE_URL;?>feedBack">Feedback</a></li>
        </ul>
        </div>
        <!--Copyright-->
        <div class="text-center">Copyright © 2019 - All Rights Reserved - Raj Bhavan, Odisha | 
          <a href="javascript:void(0)" class="text-dark">
            Terms of use
          </a>
        </div>

      </div>
    

    </div>
    </div>
  </section>
  
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

     
  <script src="<?php echo SITE_URL;?>js/popper.min.js" ></script> 
    <script src="<?php echo SITE_URL;?>js/spotlight.bundle.js" type="text/javascript" defer></script> 
 
   <!--End of Footer-->
  <script type="text/javascript">
    $(document).ready(function () {
    $(".pageSearch a").click(function(){
    $(this).find("i").toggleClass("lni-search lni-close");
    $(".searchBar").slideToggle();
  });
     });

      function viewAlert(msg, ctrlId,redLoc)
  { 
    
            $('#btnAlertOk').off('click');
    if(typeof(ctrlId)=='undefined')
    {
      ctrlId  = '';
    }
    if(typeof(redLoc)=='undefined')
    {
      redLoc  = '';
    }
    $('#alertModal').modal({backdrop: 'static', keyboard: false});
    $('.alertMessage').html(msg);
    $('#btnAlertOk').on('click',function(){
      if(ctrlId !='')
      {
        $('#'+ctrlId).focus();
      }
      if(redLoc!='')
      {
        window.location.href =redLoc;
      }
    });
    
  }
  function confirmAlert(msg)
  {
    $('#confirmModal').modal({backdrop: 'static', keyboard: false});
    $('.confirmMessage').html(msg);
                //$('#btnConfirmOk').removeAttr('data-dismiss');
  }
  </script>
  </html>