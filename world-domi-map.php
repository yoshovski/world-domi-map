<?php
/**
 * Plugin Name: World DomiMap
 * Version: 1.0.0
 * Author: Stefan Yoshovski
 * Description: This plugin shows a map of the world and tracks completed projects in different countries.
 */

// Include the necessary files
require_once(plugin_dir_path(__FILE__) . 'includes/nonce-verification.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/ajax-handling.php');
require_once(plugin_dir_path(__FILE__) . 'includes/data.php');
require_once(plugin_dir_path(__FILE__) . 'includes/activation.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/settings-page.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/registration.php');

// Enqueue plugin scripts and styles for the common area
function wdm_enqueue_common_scripts() {
    // Register and enqueue front-end styles
    wp_register_style('wdm-style', plugins_url('/assets/css/wdm_style.css', __FILE__));
    wp_enqueue_style('wdm-style');

    wp_register_script('wdm-ajax', plugin_dir_url(__FILE__) . '/assets/js/wdm-ajax.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('wdm-ajax');
    wp_localize_script('wdm-ajax', 'wdm_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wdm-ajax-nonce')
    ));

    // Register and enqueue common script
    wp_register_script('wdm-common-script', plugin_dir_url(__FILE__) . '/assets/js/wdm.js', array('jquery'));
    wp_enqueue_script('wdm-common-script');
}

// Enqueue plugin scripts and styles for the admin area
function wdm_enqueue_admin_scripts() {
    wdm_enqueue_common_scripts();

    // Register and enqueue admin styles
    wp_register_style('wdm-admin-style', plugins_url('/assets/css/wdm_style.css', __FILE__));
    wp_enqueue_style('wdm-admin-style');

    // Register and enqueue admin scripts
    wp_register_script('wdm-admin-script', plugin_dir_url(__FILE__) . '/includes/admin/js/wdm-admin.js', array('jquery'));
    wp_enqueue_script('wdm-admin-script');

    // Register and enqueue admin ajax script
    wp_register_script('wdm-admin-ajax', plugin_dir_url(__FILE__) . '/includes/admin/js/wdm-admin-ajax.js', array('jquery'));
    wp_enqueue_script('wdm-admin-ajax');
    wp_localize_script('wdm-admin-ajax', 'wdm_admin_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wdm-admin-ajax-nonce')
    ));
}

// Enqueue plugin scripts and styles for the public area
function wdm_enqueue_public_scripts() {
    wdm_enqueue_common_scripts();

    // Register and enqueue front-end scripts
    wp_register_script('wdm-script', plugin_dir_url(__FILE__) . '/includes/public/js/wdm_frontend.js', array('jquery'));
    wp_enqueue_script('wdm-script');

}

add_action('admin_enqueue_scripts', 'wdm_enqueue_admin_scripts');
add_action('wp_enqueue_scripts', 'wdm_enqueue_public_scripts');

add_action('wp_ajax_wdm_get_map_data', 'wdm_get_map_data');
