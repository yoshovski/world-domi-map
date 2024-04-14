<?php

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

