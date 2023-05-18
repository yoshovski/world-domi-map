<?php
// Enqueue plugin scripts and styles
function wdm_enqueue_scripts() {
    // Enqueue scripts and styles here
    // You might need to enqueue a library like Leaflet.js for the map functionality
    wp_enqueue_style('wdm-style', plugins_url('css/style.css', __FILE__));
    wp_enqueue_script('wdm-script', plugins_url('js/script.js', __FILE__), array('jquery'));
}
add_action('wp_enqueue_scripts', 'wdm_enqueue_scripts');
