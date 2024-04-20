<?php

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
    return array_sum($completed_projects);
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
