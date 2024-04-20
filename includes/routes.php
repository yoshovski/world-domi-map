<?php

function wdm_register_rest_routes() {
    register_rest_route(WDM_API_VERSION, GET_MAP_ROUTE, array(
        'methods' => 'GET',
        'callback' => 'wdm_get_map_data',
    ));


    register_rest_route(WDM_API_VERSION, UPDATE_MAP_ROUTE, array(
        'methods' => 'POST',
        'callback' => 'wdm_update_map_data',
    ));

    // Register additional routes here
}

add_action('rest_api_init', 'wdm_register_rest_routes');
