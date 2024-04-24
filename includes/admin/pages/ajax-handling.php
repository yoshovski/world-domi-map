<?php

/*
 * This file is used to handle AJAX requests
 * (CRUD operations that are performed without reloading the page)
 */

function wdm_update_country_sales() {

    // Check if our nonce is set.
    if(!wdm_check_nonce_admin()) {
        echo 'No permission to update settings';
        die();
    }

    // Check if the request is valid
    if (isset($_POST['name']) && isset($_POST['value'])) {
        // Sanitize and validate the input
        $name = sanitize_text_field($_POST['name']);
        $value = sanitize_text_field($_POST['value']);

        // Update the setting
        $completed_projects = get_option('wdm_completed_projects', array());
        $completed_projects[$name] = $value;
        $update_status = update_option('wdm_completed_projects', $completed_projects);

        // Check if the update was successful
        if ($update_status) {
            echo 'Setting updated successfully';
        } else {
            error_log('Failed to update option: ' . print_r($completed_projects, true));
            http_response_code(500);
            echo 'Failed to update setting';
        }
    } else {
        error_log('Invalid request: ' . print_r($_POST, true));
        http_response_code(400);
        echo 'Invalid request';
    }

    // Always die in functions echoing AJAX response
    die();
}
add_action('wp_ajax_wdm_update_country_sales', 'wdm_update_country_sales');
