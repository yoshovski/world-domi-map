<?php
// Generate the map HTML code

function wdm_generate_map() {
    // Define the colors for the active and inactive states
    $activeColor = "#62646a";
    $inactiveColor = "#e4e5e7";

    // Retrieve the completed projects
    $completed_projects = get_option('wdm_completed_projects', array());
    error_log(print_r($completed_projects, true));

    // Retrieve the list of countries and their SVG paths
    $country_paths = wdm_get_country_paths();

    // Generate the SVG code by iterating over the countryPaths array
    $svg_code = '<div class="wdm-map-container" style="padding: 20px; background-color: white; margin: 0; box-sizing: border-box;">';
    $svg_code .= '<svg viewBox="0 0 2000 850" width="2000" height="850" data-tip="true" currentItem="false" aria-describedby="ta3f93b00-9063-4635-9b34-ec7bdc67d1bc" style="transform: scale(0.5); transform-origin: 0% 0%;">';
    $svg_code .= '<g class="countries">';

    foreach ($country_paths as $country => $path) {
        $country_slug = sanitize_title($country);
        $class = isset($completed_projects[$country_slug]) && $completed_projects[$country_slug] > 0 ? 'active' : 'inactive';
        // Set the fill color based on the status of the country
        $fillColor = $class == 'active' ? $activeColor : $inactiveColor;
        $svg_code .= '<path class="map-geography map-geography-with-value ' . $class . '" tabindex="0" d="' . $path . '" fill="'  . $fillColor . '"style="outline: none;" title="' . $country . '"></path>';
    }

    $svg_code .= '</g>';
    $svg_code .= '</svg>';
    $svg_code .= '</div>';

    // Return the generated SVG code
    return $svg_code;
}
