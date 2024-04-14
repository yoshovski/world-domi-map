<?php
function is_project_completed($country, $completed_projects) {
    $country_slug = sanitize_title($country);
    return isset($completed_projects[$country_slug]) && $completed_projects[$country_slug] > 0;
}

function calculate_world_domination_percentage($countries, $completed_projects) {
    $completed_countries = 0;
    foreach ($countries as $country) {
        if (is_project_completed($country, $completed_projects)) {
            $completed_countries++;
        }
    }

    $world_domination_percentage = ($completed_countries / count($countries)) * 100;
    return ceil($world_domination_percentage);
}

function wdm_generate_map() {
    $active_color = "#62646a";
    $inactive_color = "#e4e5e7";

    $completed_projects = get_option('wdm_completed_projects', array());
    $country_paths = wdm_get_country_paths();

    ob_start();
    ?>
    <div class="wdm-map-container">
        <h2 class="section-header tbody-4">World Domination <?php echo wdm_get_world_domination_percentage() ?></h2>
        <svg>
            <g class="countries">
                <?php foreach ($country_paths as $country => $path): ?>
                    <?php
                    $class = is_project_completed($country, $completed_projects) ? 'active' : 'inactive';
                    $fillColor = $class == 'active' ? $active_color : $inactive_color;
                    ?>
                    <path class="map-geography map-geography-with-value <?php echo $class; ?>" tabindex="0" d="<?php echo $path; ?>" fill="<?php echo $fillColor; ?>" title="<?php echo $country; ?>"></path>
                <?php endforeach; ?>
            </g>
        </svg>
    </div>
    <?php
    return ob_get_clean();
}

function wdm_get_world_domination_percentage() {
    $countries = wdm_get_countries();
    $completed_projects = get_option('wdm_completed_projects', array());

    $world_domination_percentage = calculate_world_domination_percentage($countries, $completed_projects);
    error_log("PERCENTAGE: " . $world_domination_percentage);

    return $world_domination_percentage . '%';
}
