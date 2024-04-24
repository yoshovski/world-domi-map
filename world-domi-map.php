<?php
/**
 * Plugin Name: World Domi Map
 * Version: 1.0.0
 * Contributors: @syoshovski
 * Author: Stefan Yoshovski
 * Description: This plugin shows a map of the world and tracks completed projects in different countries.
 * Donate link: https://paypal.me/yoshovski
 * Tags: world-map, project-tracking, sales-tracking, country-sales, shortcode, admin-dashboard, map-plugin, project-map, sales-map, world-domination
 * Requires at least: 4.7
 * Tested up to: 6.5.2
 * License: GPLv2
 */

// Include the necessary files
require_once(plugin_dir_path(__FILE__) . 'includes/shortcode.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/ajax-handling.php');
require_once(plugin_dir_path(__FILE__) . 'includes/data.php');
require_once(plugin_dir_path(__FILE__) . 'includes/activation.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/settings-page.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/pages/registration.php');

define('WDM_VERSION', '1.0.0');

$wdm_data = WDM_Data::getInstance();
$wdm_shortcode = WDM_Shortcode::getInstance();

// Enqueue plugin scripts and styles for the common area
function wdm_enqueue_common_scripts() {
    // Register and enqueue front-end styles
    wp_register_style('wdm-style', plugins_url('/assets/css/wdm_style.css', __FILE__), array(), WDM_VERSION);
    wp_enqueue_style('wdm-style');

    wp_register_script('wdm-ajax', plugin_dir_url(__FILE__) . '/assets/js/wdm-ajax.js', array('jquery'), WDM_VERSION, true);
    wp_enqueue_script('wdm-ajax');
    wp_localize_script('wdm-ajax', 'wdm_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wdm-ajax-nonce')
    ));

    // Register and enqueue common script
    wp_register_script('wdm-common-script', plugin_dir_url(__FILE__) . '/assets/js/wdm.js', array('jquery'), WDM_VERSION, true);
    wp_enqueue_script('wdm-common-script');

}

// Enqueue plugin scripts and styles for the admin area
function wdm_enqueue_admin_scripts() {
    wdm_enqueue_common_scripts();

    // Register and enqueue admin styles
    wp_register_style('wdm-admin-style', plugins_url('/includes/admin/css/wdm-admin-style.css', __FILE__), array(), WDM_VERSION);
    wp_enqueue_style('wdm-admin-style');


    // Register and enqueue admin ajax script
    wp_register_script('wdm-admin-ajax', plugin_dir_url(__FILE__) . '/includes/admin/js/wdm-admin-ajax.js', array('jquery'), WDM_VERSION, true);
    wp_enqueue_script('wdm-admin-ajax');
    wp_localize_script('wdm-admin-ajax', 'wdm_admin_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wdm-admin-ajax-nonce')
    ));

    // Register and enqueue admin scripts
    wp_register_script('wdm-admin-script', plugin_dir_url(__FILE__) . '/includes/admin/js/wdm-admin.js', array('jquery'), WDM_VERSION, true);
    wp_enqueue_script('wdm-admin-script');
}

// Enqueue plugin scripts and styles for the public area
function wdm_enqueue_public_scripts() {
    wdm_enqueue_common_scripts();

    // Register and enqueue front-end scripts
    wp_register_script('wdm-script', plugin_dir_url(__FILE__) . '/includes/public/js/wdm_frontend.js', array('jquery'), WDM_VERSION, true);
    wp_enqueue_script('wdm-script');

}

// Register the Gutenberg block script
function wdm_block_scripts() {
    wp_register_script(
        'wdm-block-render-map',
        plugins_url( '/assets/js/wdm.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' ),
        WDM_VERSION,
        true
       );

    wp_register_script(
        'wdm-block-map',
        plugins_url( 'includes/admin/js/wdm-admin-block.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' ),
        WDM_VERSION,
        true
    );

    wp_localize_script('wdm-block-map', 'wdm_block_map_data',
        array('wdmPreviewImage' => plugins_url( '/assets/images/preview.jpg', __FILE__ ))
    );

    wp_enqueue_script('wdm-block-map');


}

// Register new Gutenberg block
function wdm_register_block() {
    $wdm_shortcode = WDM_Shortcode::getInstance();
    register_block_type( 'world-domi-map/world-domination-map', array(
        'editor_script' => 'wdm-block-map',
        'render_callback' => 'wdm_render_block'
    ));
}

// This function will generate the block's output
function wdm_render_block($attributes, $content) {
    return '<div class="wdm-map-container"></div>';
}

// Add Gutenberg block script actions
add_action( 'admin_enqueue_scripts', 'wdm_block_scripts' );
add_action( 'init', 'wdm_register_block' );


// Add the necessary actions
add_action('admin_enqueue_scripts', 'wdm_enqueue_admin_scripts');
add_action('wp_enqueue_scripts', 'wdm_enqueue_public_scripts');

add_action('wp_ajax_wdm_get_map_data', array($wdm_data, 'get_map_data'));
add_action('wp_ajax_nopriv_wdm_get_map_data', array($wdm_data, 'get_map_data'));

add_action('wp_ajax_wdm_get_summary_cards', array($wdm_data, 'get_summary_cards'));
add_action('wp_ajax_nopriv_wdm_get_summary_cards', array($wdm_data, 'get_summary_cards'));


