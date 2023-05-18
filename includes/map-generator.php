<?php
// Generate the map HTML code
function wdm_generate_map() {
    // Retrieve the list of countries and their SVG paths
    $country_paths = wdm_get_country_paths();

    // Generate the SVG code by iterating over the countryPaths array
    $svg_code = '<svg width="1270" height="600" data-tip="true" currentItem="false" aria-describedby="ta3f93b00-9063-4635-9b34-ec7bdc67d1bc">';
    $svg_code .= '<g class="countries">';

    foreach ($country_paths as $country => $path) {
        $svg_code .= '<path class="map-geography map-geography-with-value" tabindex="0" d="' . $path . '" fill="#62646a" title="' . $country . '"></path>';
    }

    $svg_code .= '</g>';
    $svg_code .= '</svg>';

    // Return the generated SVG code
    return $svg_code;
}
