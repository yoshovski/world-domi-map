<?php
/*
 * This file is used to retrieve data from the database and prepare it for the map
 */

class WDM_Data {

    private static $instance = null;

    private function __construct() {
    }

    public static function getInstance() {
        if (self::$instance == null)
            self::$instance = new WDM_Data();

        return self::$instance;
    }

    public function get_map_data() {
        // Retrieve data
        $completed_projects = $this->get_completed_projects();
        $country_paths = $this->get_country_paths();
        $world_domination_percentage = $this->get_world_domination_percentage();

        // Prepare the map data
        $map_data = array(
            'completedProjects' => $completed_projects,
            'countryPaths' => $country_paths,
            'worldDominationPercentage' => $world_domination_percentage,
        );

        // Return the map data as a JSON response
        wp_send_json($map_data);
    }

    public function get_summary_cards(){
        $total_completed_projects = $this->get_total_completed_projects();
        $total_active_countries = $this->get_total_active_countries();
        $country_max_sales = $this->get_country_max_sales();
        $sales_distribution = $this->get_sales_distribution();

        $summary_cards = array(
            'totalCompletedProjects' => $total_completed_projects,
            'totalActiveCountries' => $total_active_countries,
            'countryMaxSales' => $country_max_sales,
            'salesDistribution' => $sales_distribution,
        );

        wp_send_json($summary_cards);
    }

    public function get_countries() {
        $country_paths = $this->get_country_paths();
        $country_names = array_keys($country_paths);
        return $country_names;
    }

    public function readJsonFile($filePath) {
        $jsonFileUrl = plugin_dir_url(__FILE__) . '../' . $filePath;
        $response = wp_remote_get($jsonFileUrl);

        if (is_wp_error($response)) {
            error_log('Failed to get file: ' . $jsonFileUrl);
            return array();
        }

        $jsonContent = wp_remote_retrieve_body($response);
        $data = json_decode($jsonContent, true);
        $result = array();

        foreach ($data as $key => $value) {
            $country = str_replace('_', ' ', $key);
            $country = ucwords(strtolower($country));
            $result[$country] = $value;
        }

        return $result;
    }

    public function get_completed_projects() {
        $completed_projects = get_option('wdm_completed_projects', array());
        return $completed_projects;
    }

    public function get_country_paths() {
        $resultArray = $this->readJsonFile('resources/country_paths.json');
        return $resultArray;
    }

    public function is_project_completed($country, $completed_projects) {
        $country_slug = sanitize_title($country);
        return isset($completed_projects[$country_slug]) && $completed_projects[$country_slug] > 0;
    }

    public function get_total_completed_projects() {
        $completed_projects = get_option('wdm_completed_projects', array());
        $total = 0;
        foreach ($completed_projects as $project) {
            if (is_numeric($project)) {
                $total += $project;
            }
        }
        return $total;
    }

    public function get_total_active_countries() {
        $countries = $this->get_countries();
        $completed_projects = get_option('wdm_completed_projects', array());
        $active_countries = 0;
        foreach ($countries as $country) {
            if ($this->is_project_completed($country, $completed_projects)) {
                $active_countries++;
            }
        }

        return $active_countries;
    }

    public function get_world_domination_percentage() {
        $countries = $this->get_countries();
        $active_countries = $this->get_total_active_countries();

        $world_domination_percentage = ($active_countries / count($countries)) * 100;
        return ceil($world_domination_percentage).'%';
    }

    public function get_country_max_sales() {
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

    public function avarage_sales() {
        $total = $this->get_total_completed_projects();
        $count = $this->get_total_active_countries();
        return $count > 0 ? $total / $count : 0;
    }

    /**
     * Get the median of the sales distribution
     * @return float|int
     */
    public function get_sales_distribution() {
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

}
