<?php
/*
 * This file is used to render the settings page
 */

// Add the settings page to the admin menu
function wdm_add_settings_page()
{
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

function wdm_add_how_to_use_submenu() {
    add_submenu_page(
        'wdm_settings', // parent slug
        'How to Use', // page title
        'How to Use', // menu title
        'manage_options', // capability
        'wdm_how_to_use', // menu slug
        'wdm_render_how_to_use_page' // function that renders the page
    );
}

add_action('admin_menu', 'wdm_add_settings_page');
add_action('admin_menu', 'wdm_add_how_to_use_submenu');

function wdm_render_how_to_use_page() {
    $shortcode = WDM_Shortcode::getInstance()->get_shortcode_name();
    ?>
    <div class="wrap">
        <h1>How to Use</h1>
        <p>Display an interactive global map showcasing tracked projects completed in various countries.</p>
        <p>"To utilize the plugin, choose the 'World DomiMap' block in the Gutenberg editor. As an alternative, you can simply insert the provided shortcode into any post or page:"</p>
        <code>[<?php echo $shortcode; ?>]</code>
    </div>
    <div class="wdm-how-to-use">
        <div class="wdm-map-container"></div>
    </div>
    <?php
}

function wdm_render_settings_page()
{
    $wdm_data = WDM_Data::getInstance();
    $wdm_shortcode = WDM_Shortcode::getInstance();

    $countries = $wdm_data->get_countries();
    $completed_projects = get_option('wdm_completed_projects', array());

    // Summary Card Sdata
    $total_completed_projects = 0;
    $total_active_countries = 0;
    $sales_distribution = 0;
    $max_sales_info = 0;
    $max_sales = 0;
    $country_with_max_sales = "";

    ?>

    <div class="wdm-wrap">
        <h1>World DomiMap</h1>
        <div class="wdm-country-picker-wrap">
            <div class="country-and-project-container">
                <div class="country-select">
                    <label for="country-select" class="label select-box1">
                        <span class="label-desc">Choose your country</span>
                    </label>
                    <select id="country-select" class="select">
                        <option value="" disabled selected class="default-option">Choose your country</option>
                        <?php foreach ($countries as $country): ?>
                            <option value="<?php echo sanitize_title($country); ?>"><?php echo $country; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php
                // Render the list of countries and project fields
                foreach ($countries as $country) {
                    $country_slug = sanitize_title($country);
                    $country_value = isset($completed_projects[$country_slug]) ? $completed_projects[$country_slug] : 0;

                    if ($country_value == 0 || $country_value == '')
                        $country_value = '';

                    ?>
                    <div id="project-field-<?php echo $country_slug; ?>" style="display: none;">
                        <div class="sales-input-container"><span>Number of Sales</span>
                            <input type="number" id="wdm_project_<?php echo $country_slug; ?>"
                                   name="wdm_completed_projects[<?php echo $country_slug; ?>]"
                                   value="<?php echo $country_value; ?>" min="0" step="1"
                                   class="completed-projects-input" placeholder="0">
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="wdm-loading-icon-placeholder">
            <div class="wdm-loading-icon">
                <img src="<?php echo plugins_url('../../assets/images/load_spinner.gif', dirname(__FILE__)); ?>" alt="Loading..." />
            </div>
            </div>
        </div>

        <div class="wdm-summary-cards">
            <div class="mt-6 col">
                <!-- Card 1: Sales (Projects) -->
                <div class="card" data-card="totalCompletedProjects">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h4 class="mb-0">Sales</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <span class="dashicons dashicons-yes"></span>
                            </div>
                        </div>
                        <div>
                            <h1 class="fw-bold"><?php echo $total_completed_projects; ?></h1>
                            <p class="mb-0">Completed Projects</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 col">
                <!-- Card 2: Active Countries -->
                <div class="card" data-card="totalActiveCountries">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h4 class="mb-0">Countries</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <span class="dashicons dashicons-admin-site-alt"></span>
                            </div>
                        </div>
                        <div>
                            <h1 class="fw-bold"><?php echo $total_active_countries; ?></h1>
                            <p class="mb-0">Reached Countries</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 col">
                <!-- Card 3: World Domination -->
                <div class="card" data-card="countryMaxSales">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h4 class="mb-0">Most Sales</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <span class="dashicons dashicons-chart-pie"></span>
                            </div>
                        </div>
                        <div>
                            <h1 class="fw-bold"><?php echo $max_sales; ?></h1>
                            <p class="mb-0">Sales at <?php echo $country_with_max_sales; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 col">
                <!-- Card 4: Average Sales Per Country -->
                <div class="card" data-card="salesDistribution">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h4 class="mb-0">Average Distribution</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <span class="dashicons dashicons-chart-line"></span></div>
                        </div>
                        <div>
                            <h1 class="fw-bold"><?php echo $sales_distribution; ?></h1>
                            <p class="mb-0">Average Completed Projects Per Country</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php echo $wdm_shortcode->wdm_map_container_shortcode(); ?>

    </div>


    <?php
}
