<?php

function fv_add_fields_metabox(){
    add_meta_box(
       'fv_video_fields',
        __('Video Fields'),
        'fv_video_fields_callback',
        'factory-videos',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'fv_add_fields_metabox');

//Display Meta Box content
function fv_video_fields_callback(){

    global $post;

    wp_nonce_field(basename(__FILE__), 'fv_videos_nonce');

    //retrieve the metadata value if it exists
    $fv_video = get_post_meta( $post->ID, '_fv_video', true );

    ?>
        <div class="wrap video-form">
            <div class="form-group">
                Video <input id="fv_video" type="text" size="75" name="fv_video"
                value=" <?php if(isset($fv_video)) echo esc_url( $fv_video ); ?> " />
                <input id="upload_video_button" type="button"
                value="Media Library Video" class="button-secondary" />
                <p> Enter an video URL or use an video from the video Library </p>

            </div>
            <?php if(!empty($fv_video)): ?>
            <div class="form-group">
                <video width="320" height="240" controls>
                    <source src="<?php echo $fv_video; ?>" type="video/mp4">
                    <source src="<?php echo $fv_video; ?>" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            </div>
          <?php endif; ?>
        </div>
    <?php
}

function fv_video_save($post_id){
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['fv_videos_nonce']) && wp_verify_nonce($_POST['fv_videos_nonce'], basename(__FILE__))) ? 'true' : 'false';

    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    if(isset($_POST['fv_video'])){
        update_post_meta($post_id, '_fv_video', sanitize_text_field($_POST['fv_video']));
    }

}

add_action('save_post', 'fv_video_save');