jQuery(document).ready(function($){

    var mediaUploader;

    $('#upload-button').on('click', function(e){
        e.preventDefault();
        if(mediaUploader) {
            mediaUploader.open();
            return;
        }
        
        mediaUploader = wp.media.frames.file_name = wp.media({
            title: 'Valitse Profiili kuva',
            button: {
                text: 'Valitse kuva'
            },
            multiple: false
        });

        mediaUploader.on('select', function(){
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile-picture').val(attachment.url);
            $('#profile-picture-preview').css('background-image', 'url(' + attachment.url + ')');
        });

        mediaUploader.open();

    });

    $('#remove-picture').on('click', function(e) {
        e.preventDefault();
        var answer = confirm("Oletko varma että haluat poistaa profiilikuvan?");
        if( answer == true ) {
            $('#profile-picture').val('');
            $('.ewp-general-form').submit();
        }
        return;
    });

});