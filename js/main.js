
jQuery(document).ready(function($) { 

    var formfield = null;

    $('#upload_video_button').click(function() {
        $('html').addClass('Image');
        formfield = $('#fv_video').attr('name');
        tb_show('', 'media-upload.php?type=video&TB_iframe=true');
        return false;
    });


    // user inserts file into post.
    // only run custom if user started process using the above process
    // window.send_to_editor(html) is how wp normally handle the received data

    window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function(html){

        var filestring;
        var filestring_handle;
        var filehref;

        if (formfield != null) {

            //fileurl = $('img',html).attr('src');
            filestring = $('button .urlfile', html).context;
            filestring_handle = filestring.split("'");
            filehref = filestring_handle[1];

            $('#fv_video').val(filehref);

            tb_remove();

            $('html').removeClass('Image');
            formfield = null;
        } else {
            window.original_send_to_editor(html);
        }
    };
}); 