<?php
/**
 * Plugin Name: World DomiMap
 * Version: 1.0.0
 * Author: Stefan Yoshovski
 * Description: This plugin shows a map of the world and tracks completed projects in different countries.
 */

// Include the necessary files
require_once(plugin_dir_path(__FILE__) . 'includes/activation.php');
require_once(plugin_dir_path(__FILE__) . 'includes/scripts.php');
require_once(plugin_dir_path(__FILE__) . 'includes/map-generator.php');
require_once(plugin_dir_path(__FILE__) . 'includes/shortcode.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/settings-page.php');
require_once(plugin_dir_path(__FILE__) . 'includes/admin/settings-page-validation.php');
require_once(plugin_dir_path(__FILE__) . 'countries.php');
