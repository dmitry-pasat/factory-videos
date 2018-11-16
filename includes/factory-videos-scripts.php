<?php
//Check if Admin
if(is_admin()){
    //Add Admin scripts
    function fv_add_admin_scripts(){
        wp_enqueue_style('fv-main-admin-style', plugins_url() .'/factory-videos/css/style-admin.css');
        wp_enqueue_script('fv-main-script', plugins_url() .'/factory-videos/js/main.js', array('jquery', 'media-upload', 'thickbox' ));
    }
    add_action('admin_init', 'fv_add_admin_scripts');
}

if(is_admin()){
    //Add Admin scripts
    function fv_add_admin_thickbox_scripts(){
        wp_enqueue_style( 'thickbox' );
    }
    add_action('admin_init', 'fv_add_admin_thickbox_scripts');
}

//Add scripts
function fv_add_script(){
    wp_enqueue_style('fv-main-style', plugins_url() .'/factory-videos/css/style.css');
    wp_enqueue_script('fv-main-script', plugins_url() .'/factory-videos/js/main.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'fv_add_script');

//Add bootstrap scripts
function fv_add_bootstrap_script(){
    wp_enqueue_style('fv-bootstrap-style', plugins_url() .'/factory-videos/css/bootstrap.css');
    wp_enqueue_script('fv-bootstrap-script', plugins_url() .'/factory-videos/js/bootstrap.js');
}

add_action('wp_enqueue_scripts', 'fv_add_bootstrap_script');