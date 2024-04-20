<?php
/*
 * This file is used to verify nonces in AJAX requests
 * Nonces are used to verify that the request is coming from the correct source
 * and that the request is not a CSRF attack
 */

// Check if our nonce is set and verify that it is valid
function check_nonce($context) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['nonce'] ) ) {
        return false;
    }

    // Decide which nonce action to verify based on the context
    $action = $context === 'admin' ? 'wdm-admin-ajax-nonce' : 'wdm-ajax-nonce';

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['nonce'], $action ) ) {
        return false;
    }

    return true;
}

function check_nonce_admin() {
    return check_nonce('admin');
}

function check_nonce_other() {
    return check_nonce('other');
}
