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
add_action('wp_ajax_wdm_update_country_sales', 'wdm_update_country_sales');
