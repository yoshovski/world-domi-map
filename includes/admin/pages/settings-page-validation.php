<?php
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

function wdm_update_setting() {
    // Check if the request is valid
    if (isset($_POST['name']) && isset($_POST['value'])) {
        // Update the setting
        $completed_projects = get_option('wdm_completed_projects', array());
        $completed_projects[$_POST['name']] = $_POST['value'];
        $update_status = update_option('wdm_completed_projects', $completed_projects);

        // Check if the update was successful
        if ($update_status) {
            echo 'Setting updated successfully';
        } else {
            error_log('Failed to update option: ' . print_r($completed_projects, true));
            echo 'Failed to update setting';
        }
    } else {
        error_log('Invalid request: ' . print_r($_POST, true));
        echo 'Invalid request';
    }

    // Always die in functions echoing AJAX response
    die();
}
add_action('wp_ajax_wdm_update_setting', 'wdm_update_setting');

// Field callback function
function wdm_projects_field_callback() {
    // This field callback is not needed anymore
    // The projects fields are rendered within wdm_render_settings_page()
}

// Section callback function
function wdm_section_callback() {
    // Section description goes here
}
