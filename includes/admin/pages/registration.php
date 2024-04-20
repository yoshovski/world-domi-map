<?php
/*
 * This file is used to register the settings page and the settings fields
 */

// Register the settings and fields
function wdm_register_settings() {
    // Register a new setting
    register_setting('wdm_settings_group', 'wdm_selected_countries');
    register_setting('wdm_settings_group', 'wdm_completed_projects');

    // Add a settings section
    add_settings_section(
        'wdm_section',
        'Client Projects',
        'wdm_section_callback',
        'wdm_settings'
    );

    // Add settings fields
    add_settings_field(
        'wdm_projects_field',
        'Completed Projects',
        'wdm_projects_field_callback',
        'wdm_settings',
        'wdm_section'
    );
}

add_action('admin_init', 'wdm_register_settings');


// Field callback function
function wdm_projects_field_callback() {
    // This field callback is not needed anymore
    // The projects fields are rendered within wdm_render_settings_page()
}

// Section callback function
function wdm_section_callback() {
    // Section description goes here
}
