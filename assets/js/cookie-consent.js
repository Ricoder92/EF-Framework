window.addEventListener('DOMContentLoaded', function() { (function($) {

    /* show cookie banner*/
    show_cookie_banner();
    
    /* click just set choosen cokkies */
    $( "#ef-cookieconsent-set-choosen" ).click(function(event) {
    
        event.preventDefault();
        var analyse_cookies;

        if ($('#analyse_cookies').is(':checked'))
            analyse_cookies = 1;
        else 
            analyse_cookies = 0;

        $.ajax({
            type: 'POST',
            url: cookie_object.ajax_url,
            data: {
                'action' : 'ef_cookie_law_setcookie', 
                'analyse_cookies': analyse_cookies
            },
            dataType: 'json',
            success: function(data) {
                remove_cookie_banner()
            }
        });
    });

    /* click set all cookies */
    
    $( "#ef-cookieconsent-set-all" ).click(function(event) {
    
        event.preventDefault();
        
        $('#analyse_cookies').prop('checked', true);
        
        var analyse_cookies = true;

        $.ajax({
            type: 'POST',
            url: cookie_object.ajax_url,
            data: {
                'action' : 'ef_cookie_law_setcookie', 
                'analyse_cookies': analyse_cookies
            },
            dataType: 'json',
            success: function(data) {

                if(analyse_cookies)
                    prepared_analytics_code();

                remove_cookie_banner()
            }
        });     

    });

    /* remove chookie banner */

    function show_cookie_banner() {
        $('.ef-cookie-consent .background').delay(150).fadeIn(200);
        $('.ef-cookie-consent .box').delay(200).fadeIn(600);
        $('.ef-cookie-consent .content').delay(300).fadeIn(600);
    }
    
    function remove_cookie_banner() {
        $('.ef-cookie-consent .background').fadeOut();
        $('.ef-cookie-consent .box').fadeOut('', function() {
            $('.ef-cookie-consent').remove();
        });
    }

    
})(jQuery);});

