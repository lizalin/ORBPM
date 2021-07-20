<div class="page-navigator">
    <div class="container">
        <h2>Former Governors </h2>

        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL;?>"><i class="fa fa-home"></i></a></li>
            <li>His Excellency The Governor</li>
            <li>Former Governors </li>

        </ul>

    </div>
</div>
<?php 
$objProfile  = new clsOfficers;
$officerType=1;//former Governer
$result = $objProfile->manageOfficer('V', 0, $officerType, '', '', '', '', 2, 0,0);
?>
<!--=== Content Section ===-->
<div class="container">
    <div class="content-sec">
        <!--=== Content ===-->

        <div class="content-inner">
            <p>The illustrious Governors of Odisha who stayed at Raj Bhavan, Bhubaneswar:</p>

            <div class="row">
            <?php 
				if (($result->num_rows) > 0) { 
					while ($row = $result->fetch_array()) {
			?>
                <div class="col-12 col-sm-6 col-md-3">

                    <div class="card governers-list">

                        <div class="card-body">

                            <img src="<?php echo APP_URL; ?>uploadDocuments/offProfile/<?php echo $row['vchImage']; ?>" alt="<?php echo $row['vchOfficerName']; ?>" >

                            <h4><?php echo $row['vchOfficerName']; ?><span>(<?php if($row['dtJoiningDate'] !=""){ echo date("d-M-Y", strtotime(htmlspecialchars_decode($row['dtJoiningDate'], ENT_NOQUOTES))); }?> – <?php if($row['dtRetireDate'] !=""){echo date("d-M-Y", strtotime(htmlspecialchars_decode($row['dtRetireDate'], ENT_NOQUOTES))); } ?>)</span></h4>

                        </div>
                    </div>
                </div>
            <?php }
            } ?>
               

            </div>

        </div>
    </div>
</div>
