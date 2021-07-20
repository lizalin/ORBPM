  <div class="page-navigator">
  	<div class="container">

  		<h2>Former Secretaries</h2>

  		<ul class="breadcrumb">
  			<li><a href="<?php echo SITE_URL; ?>"><i class="fa fa-home"></i></a></li>
  			<li>His Excellency The Governor</li>
  			<li>Former Secretaries</li>

  		</ul>




  	</div>
  </div>
  <?php 
$objProfile  = new clsOfficers;
$officerType=2;//former Secretary
$result = $objProfile->manageOfficer('V', 0, $officerType, '', '', '', '', 2, 0,0);
?>
  <!--=== Content Section ===-->
  <div class="container">
  	<div class="content-sec">



  		<!--=== Content ===-->

  		<div class="content-inner">
  			<h5>Incumbency Chart of Secretaries to Governor, Odisha</h5>
  			<div class="table-responsive">
  				<table class="table table1">
  					<tr>
  						<th>Sl.No.</th>
  						<th>NAME</th>
  						<th>FROM</th>
  						<th>TO</th>
  					</tr>
					<?php 
						if (($result->num_rows) > 0) { 
							$i=0;
							while ($row = $result->fetch_array()) { $i++;
					?>  
  					<tr>
  						<td><?php echo $i;?></td>
  						<td><?php echo $row['vchOfficerName']; ?></td>
  						<td><?php if($row['dtJoiningDate'] !=""){ echo date("d-M-Y", strtotime(htmlspecialchars_decode($row['dtJoiningDate'], ENT_NOQUOTES))); }?></td>
  						<td><?php if($row['dtRetireDate'] !=""){echo date("d-M-Y", strtotime(htmlspecialchars_decode($row['dtRetireDate'], ENT_NOQUOTES))); } ?><br />
  						</td>
  					</tr>
  					<?php }
					}?>
  					
  				</table>

  			</div>
  		</div>
  	</div>
  </div>
