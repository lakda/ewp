(function($) {

    $('figure.wp-caption.aligncenter').removeAttr('style');
    $('img.aligncenter').wrap('<figure class="centered-image" />');


    // Admin sivupalkki

    $('.js-toggle-sidebar').on('click', function(e){
         e.preventDefault();

        $( '.ewp-admin-sidebar' ).toggleClass( 'sidebar-closed' );
    });



    /*
    $(document).on('click', '.js-close-sidebar', function() {
    	$( '.ewp-admin-sidebar' ).addClass( 'sidebar-closed' );
    });
    */

    // Yhteydenotto lomakkeen lähetys
   $('#js-ewp-contact-form').on('submit', function(e){

    e.preventDefault();

    var form = $(this);
    var name = form.find('#name').val(),
        email = form.find('#email').val(),
        message = form.find('#message').val(),
        ajaxurl = form.data('url');

    if( name === '' ){
        $('.form-name-control-message').css('display', 'block');
        return;
    }
    if( email === '') {
        $('.form-email-control-message').css('display', 'block');
        return;
    }
    if( message === '' ){
        $('.form-message-control-message').css('display', 'block');        
        //console.log('Rquired inputs are empyty');
        //alert('Täytä kaikki kentät');

        return;
    }

        $.ajax({
            url     : ajaxurl,
            type    : 'post',
            data    : {
                name    : name,
                email   : email,
                message : message,
                action  : 'ewp_save_user_contact_form'
            },
            error   : function( response ){
                console.log(response);
            },
            success : function( response ){
                if( response == 0){
                // Kun viestin lähetys epäonnistuu
                } else {
                    // Kun viesti lähetetään onnistuneest
                    alert('Viesti lähetetty');
                    form.find('input, button, textarea').attr('disabled', 'disabled');
                    form.find('input, textarea').val('');
                    $('.form-control-messag').css('display', 'none');
                }
            }

            
        });
    


   });



})(jQuery);