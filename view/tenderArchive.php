  <script type="text/javascript">
 function DoPaging(CurrentPage,RecordNo)
  {
    $("#hdn_PageNo").val(CurrentPage);
    $("#hdn_RecNo").val(RecordNo);
    $("form").submit();
  }
  
  function AlternatePaging()
  {
          if($('#hdn_IsPaging').val()=="0") 
                  $("#hdn_IsPaging").val("1");
          else  
                  $("#hdn_IsPaging").val("0");
          $("form").submit(); 
  }
</script>
<style>
  .content-sec .content-inner {min-height: 350px;}
  .content-inner table tr td, .content-inner table tr th{    font-size: 0.89rem;}
  .tabactive {
    background:#144bbd!important;
    color: #fff!important;
}
.maintab-right{margin-bottom:7px;}
.maintab-right a {
    background: #c1cbe0bf;
    border-radius: 0;
    border: 0;
    color: #333;
    padding: 10px 8px;
}
.btn-warning:hover {
    color: #212529;
    background-color: #d9e5ff;
    border-color: #d39e00;
}
</style>


<div class="page-navigator">
   <div class="container">
   
   <h2>Officers of RAJ BHAVAN</h2>
      
      <ul class="breadcrumb">
          <li><a href="../"><i class="fa fa-home"></i></a></li>
              <li>
      Tender
        </li>
             <!--  <li></li> -->
          
      </ul>
   
  
  
 
</div>
</div>
<!--=== Content Section ===-->
<div class="container">
    <div class="content-sec">
         
           
           
            <!--=== Content ===-->
            
             <div class="content-inner">
             <div class="maintab-right">
							<a href="<?php echo SITE_URL;?>tender" class="custom-btn btn btn-warning ">Latest Tenders</a>
	      						<a href="<?php echo SITE_URL;?>tenderArchive" class="custom-btn btn btn-warning tabactive">Archive Tenders</a>
	      						
	    					</div>
               <div class="table-responsive">
                <form method="post" >
            <?php if (($result->num_rows) > 0) {
            $ctr = $intRecno; ?>
            <table class="table table1">
                <thead>
                  <tr>
                    <th>Tender No.</th>
                    <th>Tender Description</th>
                   <th>Opening Date</th>
                    <th>Closing Date</th> 
                    <th>Download</th>                   
                  </tr>
                </thead>
                <tbody>
    <?php while ($row = mysqli_fetch_array($result)) {
    
        $ctr++; 
        ?>
            <tr>
         <td><?php echo htmlspecialchars_decode($row['VCH_REF_NO'],ENT_NOQUOTES);?></td>
         <td><?php echo htmlspecialchars_decode($row['VCH_DESCRIPTION_E'],ENT_NOQUOTES);?></td>
         <td><?php echo date("d-M-Y, h:i A",strtotime(htmlspecialchars_decode($row['DTM_OPENING_DATETIME'],ENT_NOQUOTES)));?></td>
       <td><?php echo date("d-M-Y, h:i A",strtotime(htmlspecialchars_decode($row['DTM_CLOSING_DATETIME'],ENT_NOQUOTES)));?></td>
        <td><?php $fileExt =pathinfo($row['VCH_DOCUMENT_NAME'], PATHINFO_EXTENSION);?>        
            <a href="<?php echo APP_URL;?>uploadDocuments/Tender/<?php echo $row['VCH_DOCUMENT_NAME'];?>" target="_blank">Download</a>
        </td>
        
      </tr>

                            <?php }// end while?>
                </tbody>
            </table>

            <input name="hdn_PageNo" id="hdn_PageNo" type="hidden" value="<?php echo $intPgno; ?>" />
            <input name="hdn_RecNo" id="hdn_RecNo" type="hidden" value="<?php echo $intRecno; ?>" />
            <input name="hdn_IsPaging" id="hdn_IsPaging" type="hidden" value="<?php echo $isPaging; ?>" />
            <input name="hdn_ids" id="hdn_ids" type="hidden" />
            <input name="hdn_qs" id="hdn_qs" type="hidden" />

            <?php }//end if
            else { ?>
                    <div class="noRecord">No record found</div>
            <?php } ?>





        </form>
       </div>

       <?php if ($result->num_rows > 0) {?>
       <div class="row">
       <div class="col-md-12">
                    <div class="col-md-6 pull-left">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <?php if ($intTotalRec > $intPgSize) { ?><a href="#" onClick="AlternatePaging();"><?php echo ($isPaging == 0) ? "Show All" : "Show Paging"; ?></a>/ <?php } ?>
                            <?php echo $objTender->getPageNumbers($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
                        </div>
                    </div>
                    <?php if ($isPaging == 0 && $intTotalRec > $intPgSize) { ?>
                        <div class="col-md-6 pull-right text-right">
                            <div class="dataTables_paginate paging_bootstrap">
                                <ul class="pagination">
                                    <?php echo $objTender->getPaging($intTotalRec, $intCurrPage, $intPgSize, $isPaging); ?>
                                </ul>
                            </div>
                        </div>
                    <?php }// paging block ?>
                 </div>
               </div>
               <?php }// end if for paging?>
                </div>
              </div>
            </div>

<!--=== Content Section ===-->
  <?php include("../include/footer.php");?>
  
  </body>
