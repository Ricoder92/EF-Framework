/* navigation submenu animation */
$(".header-menu-default .menu-item-has-children").hover(
    function () {
        $(this).find('.sub-menu').stop(true, true).show().animate({
            opacity: 1,
            margin: "0 0 0 0"
          }, 150, function() {
            // Animation complete.
          });
    },
    function (event) {
        $(this).find('.sub-menu').stop(true, true).animate({
            opacity: "",
            margin: "25px 0 0 0"
          }, 150, function() {
            $(this).hide();
          });
    }
);

$(".header-menu-default-mobile .menu-item-has-children").hover(
  function () {
    $(this).find('.sub-menu').stop(true, true).slideToggle();
},
function (event) {
    $(this).find('.sub-menu').stop(true, true).slideToggle();
  }
);

/* sticky header */
if (window.innerWidth >= 991 && window.innerWidth > window.innerHeight) {

  var scrolled = false;
  var scrolled2 = false;

  $(window).scroll(function() {
      if ($(window).scrollTop() > 401 && scrolled == false) {
          $('.toggle-header-sticky').fadeToggle('200')   
          scrolled = true;
          scrolled2 = false;
      }
      if ($(window).scrollTop() < 400 && scrolled == true && scrolled2 == false) {
          $('.toggle-header-sticky').fadeToggle('200')
          
          scrolled = false;
          scrolled2 = true;
      }
  });


} else {

}

/* toggle mobile-navigation */
$("#mobile-menu-toggle").on('click', function() {
  $(".header-default-mobile-content").slideToggle('50');
});