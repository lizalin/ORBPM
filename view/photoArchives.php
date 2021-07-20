  
   



<div class="page-navigator">
   <div class="container">
   
   <h2>Photo Archives </h2>
      
      <ul class="breadcrumb">
          <li><a href="../"><i class="fa fa-home"></i></a></li>
              <li>Media</li>
              <li>Photo Archives </li>
          
      </ul>
   
  
  
 
</div>
</div>
<!--=== Content Section ===-->
<div class="container">
    <div class="content-sec">
         
           
           
            <!--=== Content ===-->
            
             <div class="content-inner">
              <div class="photoarchives">
  <div class="row">
    <div class="col-md-2 mb-3">
        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Event 1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Event 2</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Event 3</a>
  </li>
</ul>
    </div>
    <!-- /.col-md-4 -->
        <div class="col-md-10">
      <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <h2>Profile</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <h2>Contact</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>
  
  </div>
</div>
    </div>
    <!-- /.col-md-8 -->
  </div>
</div>
               
              </div>
            </div>
          </div>

<!--=== Content Section ===-->
  <?php include("../include/footer.php");?>

  <script type="text/javascript">
    $(document).ready(function(){
       $(".culturalev").click(function (){
        $("#culturalevent").show() ;  
        $("#officialevents").hide() ;  
       });
         $(".officialev").click(function (){
        $("#culturalevent").hide() ;  
        $("#officialevents").show() ;  
       });
    });
  </script>
  </body>
