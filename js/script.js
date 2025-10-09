$(document).ready(function() {

  // Navbar toggle
  $('.hamburger').on('click', function(){
    $('.nav-links').toggleClass('active');
  });

  const carousel = $(".film-carousel");

  $(".carousel-btn.next").click(function () {
    carousel.animate({ scrollLeft: "+=300" }, 400);
  });

  $(".carousel-btn.prev").click(function () {
    carousel.animate({ scrollLeft: "-=300" }, 400);
  });

});
