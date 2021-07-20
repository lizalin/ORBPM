<?php 
/* ================================================
  File Name             : indexInner.php
  Description     : Manage functions in Index 
  Date Created      : 08-06-2021
  Designed By     : Ashok Kumar Samal    
  Update History      :
  <Updated by>    <Updated On>    <Remarks>

  ==================================================*/
$objLocation=new clsLocation();
$locationRes=$objLocation->manageLocation('VF',0,'','','','','','',1);

?>  
   





<div class="page-navigator">
   <div class="container">
   
   <h2>Contact Us</h2>
      
      <ul class="breadcrumb">
          <li><a href="../"><i class="fa fa-home"></i></a></li>
              <li>Contact Us</li>
          
      </ul>
   
  
  
 
</div>
</div>
<!--=== Content Section ===-->
<div class="container">
    <div class="content-sec">
         
           
           
            <!--=== Content ===-->
            
             <div class="content-inner">
                <div class="contactustext">
                  <div class="row">

                    <?php if (($locationRes->num_rows) > 0) { ?>

                      <?php 
        $i=0;
        while ($row = $locationRes->fetch_array()) {
          $i++;
        ?>
                      <div class="col-12 col-sm-6 col-md-6">
                      <div class="contact-list">
                      <div class="card">
                          <div class="card-header">
                           <h5 class="card-title"><?php  echo htmlspecialchars_decode($row['VCH_LOCATION'],ENT_NOQUOTES);?></h5>
                          </div>
                          <div class="card-body">                         
                           <p><?php  echo htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_NOQUOTES);?></p>

                           <?php if($row['VCH_OFFICE_NO1'] !="" || $row['VCH_OFFICE_NO2'] !="" || $row['VCH_OFFICE_EMAIL']!=""){?>
          <ul class="contacticon">
            <li><a><i class="fa fa-phone-square"></i><?php  echo htmlspecialchars_decode($row['VCH_OFFICE_NO1'],ENT_NOQUOTES);?></a></li>
            <li><a><i class="fa fa-fax"></i><a href="javascript:void(0)"><?php  echo htmlspecialchars_decode($row['VCH_OFFICE_NO2'],ENT_NOQUOTES);?></a></li>
            <li><a><i class="fa fa-envelope"></i><a href="javascript:void(0)"><?php  echo htmlspecialchars_decode($row['VCH_OFFICE_EMAIL'],ENT_NOQUOTES);?></a></li>
          </ul>
          <?php }?>
                             <?php //if($i == $locationRes->num_rows){?>
                             <ul class="puricontact">
                                <li><a href="https://www.facebook.com/GovernorOdisha/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/GovernorOdisha" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                              </ul>
                            <?php //}?>
                          </div>
                        </div>
                          </div>
                       </div>
                     <?php }?>
                    <?php }else{?>
                       <div class="col-12 col-sm-12 col-md-12 noRecord">
                        NO records found.
                       </div>
                    <?php }?>

                    

                    
                  </div>
                </div>
              </div>
            </div>
</div>
<!--=== Content Section ===-->
  <?php include("../include/footer.php");?>
  
  </body>
