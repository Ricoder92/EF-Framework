jQuery(document).ready(function() {

    $('.ef-cookieconsent-blur-bg').delay(150).fadeIn(200);
    $('.ef-cookieconsent').delay(200).fadeIn(600);
    $('.ef-cookieconsent .content').delay(300).fadeIn(600);

    jQuery('#ef-cookieconsent-accept button').click(function() {

        var data = {
            action: 'enfi_cookieconsent_setcookie'
        };

        jQuery.post(cookie_object.ajax_url, data);

        $('.ef-cookieconsent-blur-bg').fadeOut();
        $('.ef-cookieconsent').fadeOut();

    });

});