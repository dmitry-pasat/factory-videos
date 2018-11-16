<?php
/**
 * Plugin name: Factory Videos
 * Description: Add Factory Videos to your website
 * Version: 1.0
 * Author: Dumitru Pasat
 * Author URI: http://example.com
 */

//exit if accesed directly
if(!defined('ABSPATH')){
    exit;
}

//Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/factory-videos-scripts.php');

//Load Shortcodes
require_once(plugin_dir_path(__FILE__).'/includes/factory-videos-shortcodes.php');

//Check if Admin
if(is_admin()){
    //Load custom Post types
    require_once(plugin_dir_path(__FILE__).'/includes/factory-videos-cpt.php');

    //Load Custom Fields
    require_once(plugin_dir_path(__FILE__).'/includes/factory-videos-fields.php');

}
