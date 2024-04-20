<?php
/*
 * This file is used to render the settings page
 */

// Add the settings page to the admin menu
function wdm_add_settings_page() {
    add_menu_page(
        'World DomiMap Settings',
        'World DomiMap',
        'manage_options',
        'wdm_settings',
        'wdm_render_settings_page',
        'dashicons-admin-site-alt',
        80
    );
}
add_action('admin_menu', 'wdm_add_settings_page');

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
        <h1>World DomiMap Settings</h1>
        <select id="country-select">
            <?php foreach ($countries as $country): ?>
                <option value="<?php echo sanitize_title($country); ?>"><?php echo $country; ?></option>
            <?php endforeach; ?>
        </select>

        <?php
        // Render the list of countries and project fields
        foreach ($countries as $country) {
            $country_slug = sanitize_title($country);
            $country_value = isset($completed_projects[$country_slug]) ? $completed_projects[$country_slug] : 0;
            ?>
            <div id="project-field-<?php echo $country_slug; ?>" style="display: none;">
                <h3><?php echo $country; ?></h3>
                <label for="wdm_project_<?php echo $country_slug; ?>">
                    Number of Sales:
                    <input type="number" id="wdm_project_<?php echo $country_slug; ?>" name="wdm_completed_projects[<?php echo $country_slug; ?>]" value="<?php echo $country_value; ?>" min="0" step="1" class="wdm-ajax-trigger">
                </label>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="wdm-map-container"></div>

    <?php
}
