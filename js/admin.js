jQuery(document).ready(function ($) {

    // Initialize Color Picker
    $('.my-color-field').wpColorPicker();

    // Media Uploader Logic
    var mediaUploader;

    $('#upload_logo_button').click(function (e) {
        e.preventDefault();

        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Logo',
            button: {
                text: 'Choose Logo'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it as the value of the input field
        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#custom_logo').val(attachment.id);
            $('#logo-preview').attr('src', attachment.url).show();
            $('#remove_logo_button').show();
        });

        // Open the uploader dialog
        mediaUploader.open();
    });

    $('#remove_logo_button').click(function (e) {
        e.preventDefault();
        $('#custom_logo').val('');
        $('#logo-preview').attr('src', '').hide();
        $(this).hide();
    });
});
