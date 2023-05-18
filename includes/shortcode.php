<?php
// Display the map using a shortcode
function wdm_display_map($atts) {
    // Extract the shortcode attributes
    extract(shortcode_atts(array(
        'width' => '100%',
    ), $atts));

    // Generate the map HTML code using the map generator function
    $map_html = wdm_generate_map();

    // Return the HTML code wrapped in a div with the specified width and height
    return '<div style="width: ' . $width . '; height: auto;">' . $map_html . '</div>';
}
add_shortcode('wdm_map', 'wdm_display_map');
