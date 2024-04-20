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
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/settings-page.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/settings-page-validation.php');
require_once(plugin_dir_path(__FILE__) . 'includes/data.php');


// Enqueue plugin scripts and styles for the admin area
function wdm_enqueue_admin_scripts() {
    // Register and enqueue admin styles
    wp_register_style('wdm-admin-style', plugins_url('/assets/css/wdm_style.css', __FILE__));
    wp_enqueue_style('wdm-admin-style');

    // Register and enqueue admin scripts
    wp_register_script('wdm-admin-script', plugin_dir_url(__FILE__) . '/includes/admin/js/wdm_admin.js', array('jquery'));
    wp_enqueue_script('wdm-admin-script');

    // Register and enqueue common script
    wp_register_script('wdm-common-script', plugin_dir_url(__FILE__) . '/assets/js/wdm_common.js', array('jquery'));
    wp_enqueue_script('wdm-common-script');
}
add_action('admin_enqueue_scripts', 'wdm_enqueue_admin_scripts');

// Enqueue plugin scripts and styles for the front-end
function wdm_enqueue_scripts() {
    // Register and enqueue front-end styles
    wp_register_style('wdm-style', plugins_url('/assets/css/wdm_style.css', __FILE__));
    wp_enqueue_style('wdm-style');

    // Register and enqueue front-end scripts
    wp_register_script('wdm-script', plugins_url('/public/js/wdm_frontend.js', __FILE__), array('jquery'));
    wp_enqueue_script('wdm-script');

    // Register and enqueue common script
    wp_register_script('wdm-common-script', plugin_dir_url(__FILE__) . '/assets/js/wdm_common.js', array('jquery'));
    wp_enqueue_script('wdm-common-script');
}
add_action('wp_enqueue_scripts', 'wdm_enqueue_scripts');
