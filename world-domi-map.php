<?php
/**
 * Plugin Name: World DomiMap
 * Version: 1.0.0
 * Author: Stefan Yoshovski
 * Description: This plugin shows a map of the world and tracks completed projects in different countries.
 */

// Include the necessary files
require_once(plugin_dir_path(__FILE__) . 'includes/activation.php');
require_once(plugin_dir_path(__FILE__) . 'includes/map-generator.php');
require_once(plugin_dir_path(__FILE__) . 'includes/shortcode.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/settings-page.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/settings-page-validation.php');
require_once(plugin_dir_path(__FILE__) . 'includes/data.php');

// Enqueue plugin scripts and styles for the admin area
function wdm_enqueue_admin_scripts() {
    // Enqueue admin scripts and styles here
    wp_enqueue_style('wdm-admin-style', plugins_url('css/style.css', __FILE__));
    wp_enqueue_script( 'wdm-admin-script', plugin_dir_url( __FILE__ ) . 'js/admin.js', array(), '1.0', true );

    // Enqueue common script
    wp_enqueue_script('wdm-common-script', plugin_dir_url(__FILE__) . 'js/common.js', array(), '1.0', true);

}
add_action('admin_enqueue_scripts', 'wdm_enqueue_admin_scripts');

// Enqueue plugin scripts and styles for the front-end
function wdm_enqueue_scripts() {
    // Enqueue front-end scripts and styles here
    wp_enqueue_style('wdm-style', plugins_url('css/style.css', __FILE__));
    wp_enqueue_script('wdm-script', plugins_url('js/frontend.js', __FILE__), array('jquery'), '1.0.0', true);
    
    // Enqueue common script
    wp_enqueue_script('wdm-common-script', plugin_dir_url(__FILE__) . 'js/common.js', array(), '1.0', true);

}
add_action('wp_enqueue_scripts', 'wdm_enqueue_scripts');
