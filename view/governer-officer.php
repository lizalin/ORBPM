<style>
  .content-inner table tr td,
  .content-inner table tr th {
    font-size: 0.89rem;
  }
</style>

<div class="page-navigator">
  <div class="container">

    <h2>Officers of RAJ BHAVAN</h2>

    <ul class="breadcrumb">
      <li><a href="../"><i class="fa fa-home"></i></a></li>
      <li>
        His Excellency The Governor
      </li>
      <li>Officers of RAJ BHAVAN</li>

    </ul>

  </div>
</div>
<!--=== Content Section ===-->
<div class="container">
  <div class="content-sec">
    <!--=== Content ===-->

    <div class="content-inner">
      <div class="officeraddress">
        <p>GOVERNOR’S SECRETARIAT, BHUBANESWAR </p>
        <p>EPABX-0674-2397581/2397853/2536584/2536704/2536709, FAX-2536582</p>
        <p>RAJ BHAVAN, PURI-06752-222068</p>
      </div>
      <div class="table-responsive">
        <?php if(count($arrData)>0){?>
          <table class="table table1">
          <thead>
            <tr>
              <th>Name</th>
              <th>Office</th>
              <th>Residence</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($arrData as $catName => $catData){ ?>
            <tr>
              <td colspan="4">
                <h5><?php echo $catName;?></h5>
              </td>
              
            </tr>
            <?php foreach ($catData as $ofcData){ ?>
              <tr>
                <td> <?php echo $ofcData['vchOfficername'];?> </td>
                <td> <?php echo $ofcData['vchofficeno'];?></td>
                <td><?php echo $ofcData['vchResno'];?> </td>
                <td><?php echo $ofcData['txtAddress'];?></td>
              </tr>
            <?php }//end foreach2 ?>
            

          <?php }//end foreach1 ?>

          </tbody>
        </table>

        <?php }//end if?>

      </div>
    </div>
  </div>
</div>