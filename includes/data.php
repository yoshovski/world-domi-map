<?php  


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

function wdm_get_country_paths() {
    $resultArray = readJsonFile('resources/country_paths.json');
    return $resultArray;
}