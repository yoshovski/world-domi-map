<?php
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
$map_shortcode = '[wdm_map width="100%"]';
$map_html = do_shortcode($map_shortcode);
echo $map_html;
?>

<?php
}