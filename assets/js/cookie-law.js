/* jQuery(document).ready(function() {

    $('.ef-cookieconsent-blur-bg').delay(150).fadeIn(200);
    $('.ef-cookieconsent').delay(200).fadeIn(600);
    $('.ef-cookieconsent .content').delay(300).fadeIn(600);


    $( "#ef-cookieconsent-set-choosen" ).click(function(event) {

      event.preventDefault();
      var id = 'teststringderübermitteltwerdensoll';

      if ($('#analyse_cookies').is(':checked')) {
        id = 1;
      } else {
        id = 0
      }

      //$('#analyse_cookies').prop('checked', true);

    $.ajax({
      type: 'POST',
      url: cookie_object.ajax_url,
      data: {'action' : 'ef_cookie_law_setcookie', 'id': id},
      dataType: 'json',
      success: function(data) {
        console.log(data);

      }
    });     
    $('.ef-cookieconsent-blur-bg').fadeOut();
    $('.ef-cookieconsent').fadeOut();

   

});


$( "#ef-cookieconsent-set-all" ).click(function(event) {

  event.preventDefault();

  $('#analyse_cookies').prop('checked', true);

  var id = 1;

$.ajax({
  type: 'POST',
  url: cookie_object.ajax_url,
  data: {'action' : 'ef_cookie_law_setcookie', 'id': id},
  dataType: 'json',
  success: function(data) {
    console.log(data);
    
  }
});     
$('.ef-cookieconsent-blur-bg').fadeOut();
$('.ef-cookieconsent').fadeOut();


});

});

*/