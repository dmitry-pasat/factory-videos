<?php

//List Videos
function fv_list_videos($atts, $content = null){

    global $post;

    $atts = shortcode_atts(array(
        'title' => 'Video Gallery',
        'count' => 20,
        'category' => 'all'
    ), $atts);

    //Check category
    if($atts['category'] == 'all'){
        $terms = '';
    } else {
        $terms = array(array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $atts['category']
        ));
    }

    //Query Args
    $args = array(
        'post_type' => 'factory-videos',
        'post_status' => 'publish',
        'orderby' => 'created',
        'order' => 'DESC',
        'posts_per_page' => $atts['count'],
        'tax_query' => $terms
    );

    //Check for Videos
    $videos = new WP_Query($args); //return print_r($videos); exit;
    if($videos->have_posts()){

        $category = str_replace('-', ' ', $atts['category']);

        //Init output
        $output = '';

        //Build the output
        $output .= '<div class="video-list">';
        $output .= '<div class="container">';
        $output .= '<div class="row">';

        while($videos->have_posts()){

            $videos->the_post();

            $upload = wp_upload_dir();
            $upload_url = $upload['url'];

            //Get File Name values
            $video_url = get_post_meta($post->ID, '_fv_video', true );

            $output .= '
                <div class="col-md-4 video">
                    <video width="400" height="470" loop>
                    <source src="' . $video_url. '" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>
                </div>
            ';

        }

        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        //Reset Post Data
        wp_reset_postdata();

        return $output;

    }else{
        return '<p>No videos found</p>';
    }
}

//Video List Shortcode
add_shortcode('factory-videos', 'fv_list_videos');