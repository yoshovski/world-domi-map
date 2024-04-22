<?php
/*
 * This file is used to retrieve data from the database and prepare it for the map
 */

function wdm_get_map_data() {
    // Retrieve data
    $completed_projects = wdm_get_completed_projects();
    $country_paths = wdm_get_country_paths();
    $world_domination_percentage = wdm_get_world_domination_percentage();

    // Prepare the map data
    $map_data = array(
        'completedProjects' => $completed_projects,
        'countryPaths' => $country_paths,
        'worldDominationPercentage' => $world_domination_percentage,
    );

    // Return the map data as a JSON response
    wp_send_json($map_data);
}

function wdm_get_summary_cards(){
    $total_completed_projects = get_total_completed_projects();
    $total_active_countries = get_total_active_countries();
    $country_max_sales = wdm_get_country_max_sales();
    $sales_distribution = get_sales_distribution();

    $summary_cards = array(
        'totalCompletedProjects' => $total_completed_projects,
        'totalActiveCountries' => $total_active_countries,
        'countryMaxSales' => $country_max_sales,
        'salesDistribution' => $sales_distribution,
    );

    wp_send_json($summary_cards);

}

function wdm_get_countries() {
    $country_paths = wdm_get_country_paths();
    $country_names = array_keys($country_paths);
    return $country_names;
}

function readJsonFile($filePath)
{
    // Construct the full path to the JSON file
    $jsonFilePath = __DIR__ . '/../' . $filePath;

    // Read the JSON file
    $jsonContent = file_get_contents($jsonFilePath);

    // Decode the JSON content into an associative array
    $data = json_decode($jsonContent, true);

    // Initialize an empty array to store the converted data
    $result = array();

    // Iterate over each key-value pair in the original data
    foreach ($data as $key => $value) {
        // Extract the country name from the key
        $country = str_replace('_', ' ', $key);
        $country = ucwords(strtolower($country));

        // Add the country and value to the result array with single quotes
        $result[$country] = $value;
    }

    // Return the converted data
    return $result;
}

function wdm_get_completed_projects() {
    $completed_projects = get_option('wdm_completed_projects', array());
    return $completed_projects;
}

function wdm_get_country_paths() {
    $resultArray = readJsonFile('resources/country_paths.json');
    return $resultArray;
}

function is_project_completed($country, $completed_projects) {
    $country_slug = sanitize_title($country);
    return isset($completed_projects[$country_slug]) && $completed_projects[$country_slug] > 0;
}

function get_total_completed_projects() {
    $completed_projects = get_option('wdm_completed_projects', array());
    $total = 0;
    foreach ($completed_projects as $project) {
        if (is_numeric($project)) {
            $total += $project;
        }
    }
    return $total;
}

function get_total_active_countries() {
    $countries = wdm_get_countries();
    $completed_projects = get_option('wdm_completed_projects', array());
    $active_countries = 0;
    foreach ($countries as $country) {
        if (is_project_completed($country, $completed_projects)) {
            $active_countries++;
        }
    }

    return $active_countries;
}

function wdm_get_world_domination_percentage() {
    $countries = wdm_get_countries();
    $active_countries = get_total_active_countries();

    $world_domination_percentage = ($active_countries / count($countries)) * 100;
    return ceil($world_domination_percentage).'%';
}

function wdm_get_country_max_sales() {
    $completed_projects = get_option('wdm_completed_projects', array());
    $max_sales = 0;
    $max_sales_country = '';

    foreach ($completed_projects as $country_slug => $project) {
        if (is_numeric($project) && $project > $max_sales) {
            $max_sales = $project;
            $max_sales_country = $country_slug;
        }
    }

    // Convert the country slug back to a readable country name
    $max_sales_country = str_replace('-', ' ', $max_sales_country);
    $max_sales_country = ucwords($max_sales_country);

    return array('country' => $max_sales_country, 'sales' => $max_sales);
}

function avarage_sales() {
    $total = get_total_completed_projects();
    $count = get_total_active_countries();
    return $count > 0 ? $total / $count : 0;
}

// Calculate the median of the sales distribution
function get_sales_distribution() {
    $completed_projects = get_option('wdm_completed_projects', array());
    $sales = array();
    foreach ($completed_projects as $project) {
        if (is_numeric($project)) {
            $sales[] = $project;
        }
    }
    sort($sales);
    $count = count($sales);
    $mid = floor(($count - 1) / 2);
    return $count % 2 == 0 ? ($sales[$mid] + $sales[$mid + 1]) / 2 : $sales[$mid];
}
