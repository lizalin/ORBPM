 $(".btn-group, .dropdown").hover(
                        function () {
                            $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                            $(this).addClass('open');
                        },
                        function () {
                            $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                            $(this).removeClass('open');
                        });

  // innercontainer div  height
  //$(function () {
            // var windowheight = $(window).height();
            // var headerheight = $(".headercontainer").height();
            // var footerheight = $(".footercontainer").height();
           //  var bannerheight = $(".pagenavigator").height();
            // var pageconheight = windowheight - (headerheight + footerheight + bannerheight);
            // $('.content-inner').css("min-height", pageconheight + "px");
        // });


// innercontainer div  height
 $(function () {
  $('.navbar-nav .nav-item').click(function(){
    $('.navbar-nav .nav-item').removeClass('active');
    $(this).addClass('active');
});
});


