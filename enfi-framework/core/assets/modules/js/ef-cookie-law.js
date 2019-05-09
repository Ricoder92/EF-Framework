jQuery(document).ready(function() {

    $('.enfi-cookieconsent').delay(200).fadeIn(200);

    jQuery('#enfi-cookieconsent-accept button').click(function(){

        var data = {
            action: 'enfi_cookieconsent_setcookie' 
        };

        jQuery.post(cookie_object.ajax_url, data);
        
        $('.enfi-cookieconsent').fadeOut();

    });

});