<?php
/**
 * Plugin Name: World DomiMap
 * Version: 1.0.0
 * Author: Stefan Yoshovski
 * Description: This plugin shows a map of the world and tracks completed projects in different countries.
 */

// Include the countries.php file
require_once(plugin_dir_path(__FILE__) . 'countries.php');

// Plugin activation hook
register_activation_hook(__FILE__, 'wdm_activate_plugin');

function wdm_activate_plugin() {
    // Set default options
    add_option('wdm_selected_countries', []);
    add_option('wdm_completed_projects', []);
}

// Enqueue plugin scripts and styles
function wdm_enqueue_scripts() {
    // Enqueue scripts and styles here
    // You might need to enqueue a library like Leaflet.js for the map functionality
}
add_action('wp_enqueue_scripts', 'wdm_enqueue_scripts');

// Generate the map and display project information
function wdm_display_map() {
    // Code to generate the map and display project information goes here
    // Retrieve the selected countries and completed projects from options using get_option()
    // Use a library like Leaflet.js to render the map and highlight the selected countries
    // Display the number of completed projects for each country
}
add_shortcode('world_domi_map', 'wdm_display_map');


// Add the settings page to the admin menu
function wdm_add_settings_page() {
    add_menu_page(
        'World DomiMap Settings',
        'World DomiMap',
        'manage_options',
        'wdm_settings',
        'wdm_render_settings_page',
        'dashicons-admin-plugins',
        80
    );
}
add_action('admin_menu', 'wdm_add_settings_page');

// Render the settings page
function wdm_render_settings_page() {
    // Retrieve the list of countries from countries.php
    $countries = wdm_get_countries();
    
    // Retrieve the country paths array
    $country_paths = wdm_get_country_paths();

    // Retrieve the selected countries and completed projects from options
    $selected_countries = get_option('wdm_selected_countries', array());
    $completed_projects = get_option('wdm_completed_projects', array());

    ?>
    <div class="wrap">
        <h1>World Domi Map Settings</h1>
        <form method="post" action="options.php">
            <?php
            // Output security fields for the registered setting
            settings_fields('wdm_settings_group');
            // Output setting sections and their fields
            do_settings_sections('wdm_settings');

            // Render the list of countries and project fields
            foreach ($countries as $country) {
                $country_slug = sanitize_title($country);
                $country_value = isset($completed_projects[$country_slug]) ? $completed_projects[$country_slug] : 0;
                ?>
                <h3><?php echo $country; ?></h3>
                <label for="wdm_project_<?php echo $country_slug; ?>">
                    Number of Projects:
                    <input type="number" id="wdm_project_<?php echo $country_slug; ?>" name="wdm_completed_projects[<?php echo $country_slug; ?>]" value="<?php echo $country_value; ?>" min="0" step="1">
                </label>
                <?php
            }

            // Submit button
            submit_button();
            ?>
        </form>
    </div>

    <?php
// Assume $country_paths is the array of country names and SVG paths

?>
<div class="stats-section world-domination">
    <header>
        <h2 class="section-header tbody-4">World Domination 18%</h2>
    </header>
    <div class="world-map-wrapper">
        <script>
            var countryPaths = <?php echo json_encode($country_paths); ?>; // Assuming $country_paths is the array of country names and SVG paths

            // Generate the SVG code by iterating over the countryPaths array
            var svgCode = '<svg width="1270" height="600" data-tip="true" currentItem="false" aria-describedby="ta3f93b00-9063-4635-9b34-ec7bdc67d1bc">';
            svgCode += '<g class="countries">';

            console.log(countryPaths);

            for (country in countryPaths) {
                var path = countryPaths[country];
                console.log("My country:"+country)
                svgCode += `<path class="map-geography map-geography-with-value" tabindex="0" d="${path}" fill="#62646a" title="${country}"></path>`;
            }

            svgCode += '</g>';
            svgCode += '</svg>';

            // Output the generated SVG code
            document.write(svgCode);

            // Initialize tooltips using react-tooltip library
            ReactTooltip.rebuild();
        </script>

        <script src="<https://cdnjs.cloudflare.com/ajax/libs/react-tooltip/3.11.7/react-tooltip.min.js>"></script>
        <link rel="stylesheet" href="<https://cdnjs.cloudflare.com/ajax/libs/react-tooltip/3.11.7/react-tooltip.min.css>" />
        <script>
            ReactTooltip.defaultOptions = {
                place: 'top',
                effect: 'solid'
            };
        </script>
    </div>
</div>


<?php


}



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

// Field callback functions
function wdm_countries_field_callback() {
    // Code to render the countries field goes here
}