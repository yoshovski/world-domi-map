<?php

/*
 * This file is used to activate the plugin
 * It sets the default options when the plugin is activated
 */

function wdm_activate_plugin() {
    // Set default options
    add_option('wdm_selected_countries', []);
    add_option('wdm_completed_projects', []);
}

// Plugin activation hook
register_activation_hook(__FILE__, 'wdm_activate_plugin');
