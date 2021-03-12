$(document).ready(function(){
  $(window).scroll(function() {
        if ($("#menu").offset().top > 56) {
            $("#menu").css("opacity", "0.9")
                      .css("")
        } else {
            $("#menu").css("opacity", "1");
        }
      });

  	
$('.owl-carousel').owlCarousel({
    rtl:true,
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:6
        }
    }
})
})