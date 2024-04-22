<?php

define ('WDM_SHORTCODE', 'world-domi-map');

function wdm_map_container_shortcode($atts = [], $content = null) {
    return '<div class="wdm-map-container"></div>';
}

function get_shortcode_name() {
    return WDM_SHORTCODE;
}

add_shortcode(WDM_SHORTCODE, 'wdm_map_container_shortcode');
