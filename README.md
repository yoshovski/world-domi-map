# World Domi Map WordPress Plugin

## Table of Contents
- [Description](#description)
- [Key Features](#key-features)
- [Usage](#usage)
- [Translation and Multi-language](#translation-and-multi-language)
- [Local Installation](#local-installation)
- [Development Tools](#development-tools)
- [Project Structure](#project-structure)
- [Screenshots](#screenshots)

## Description
**World Domi Map** provides a **visual representation** of your projects across the globe. It allows you to track the total number of **completed projects** for every country. It automatically calculates the total number of countries you've reached, the country with the maximum sales, and the sales distribution. It is useful to showcase your global presence, increasing credibility.

## Key Features
* **Global Visualization**: See your project presence worldwide on an interactive map, with automatic highlighting of reached countries.
* **Country-wise Tracking**: Track completed projects for each country.
* **Dynamic Tooltip**: Hover over a country to see the number of projects completed.
* **Pretty Numbers**: Automatically display the number of projects in a visually appealing way. (e.g., 1.2K, 3.5M, 1B)
* **Shortcode & Gutenberg Block**: Easily display the map on any page or post using the shortcode `[world-domi-map]` or the Gutenberg block "World Domi Map".
* **Automatic Calculations**: Automatically calculates total reached countries, identifies top-selling country, and provides sales distribution breakdown.
* **Credibility Boost**: Showcase your global presence, enhancing credibility and trustworthiness.
* **Mobile Responsive**: Fully responsive design for mobile, tablet, and desktop.

## Usage
1. Upload the plugin to your website
    - Download the repository as a zip file and upload it to your WordPress website
2. Activate the plugin
3. Go to the World Domi Map menu in the admin dashboard to add your projects and track them on the map
4. To display the map on any page or post, you have two options:
    - Use the shortcode `[world-domi-map]`
    - Use the Gutenberg block "World Domi Map"

## Translation and Multi-language
The plugin is available in more than 13 languages. The language will be automatically set based on your website's language settings. The currently officially supported languages are: Arabic, Bulgarian, German, Greek, Spanish, French, Italian, Japanese, Korean, Dutch, Polish, Portuguese, Russian, and Chinese. To add a new language, you can add a custom translation file (.po) or use Loco Translate.

## Local Installation
1. Have a local WordPress installation
   - Install `XAMPP` or any other local server environment
   - Download `WordPress` (https://wordpress.org/download/). The plugin was tested with `WordPress 6.5.2`
   - Install WordPress on your local server (to the `htdocs` folder in XAMPP)
   - Clone the repository to the plugins folder in the WordPress installation `/wordpress/wp-content/plugins`
2. Run XAMPP and start the Apache and MySQL services
3. Open your browser and go to `http://localhost/wordpress/` to access your local WordPress installation
4. Activate the plugin in the WordPress admin dashboard. Now you can develop and see the changes in real-time.

## Development Tools
- The `world_map_scraper` directory contains a Python script to convert svg to world map data. 
- The `wp-cli.phar` file is used to generate a `.pot` file for translations.
  - Make sure you have PHP installed on your local machine (at least version 7.0)
  - To generate a `.pot` file, run the following command:
    ```bash
    php wp-cli.phar i18n make-pot . languages/my.pot
    ``` 
    P.S. You might need to specify the path to the `wp-cli.phar` file or add php folder to the system path.
- Plugin Check is a WP plugin to check the code quality of a specific plugin
- Loco Translate is a plugin to add custom translations to the plugin

## Project Structure
- `world-domi-map.php`: Main plugin file
- `/assets`: CSS, JS, and images used both in the admin and frontend
- `/includes`: PHP files for the plugin functionality
- `/includes/admin`: PHP files for the admin dashboard
- `/includes/public`: PHP files for the frontend
- `/languages`: Translation files for the plugin
- `/resources`: SVG map and other resources
- `readme.txt`: WordPress plugin readme

## Screenshots
![Screenshot 1](/assets/images/snapshots/1_dashboard.jpeg)
![Screenshot 2](/assets/images/snapshots/2_map.png)
![Screenshot 3](/assets/images/snapshots/3_gutenberg_block.png)
![Screenshot 4](/assets/images/snapshots/4_tooltip_info.png)
![Screenshot 5](/assets/images/snapshots/5_dynamic_country.png)
![Screenshot 6](/assets/images/snapshots/6_dynamic_search.png)
![Screenshot 7](/assets/images/snapshots/7_multilanguage.jpeg)
![Screenshot 8](/assets/images/snapshots/8_mobile_view.jpeg)

1. Admin dashboard to add projects and track them on the map
2. Interactive map with highlighted reached countries
3. Gutenberg block "World Domi Map"
4. Tooltip with country information
5. Process of adding a project to a country
6. Find a specific country (type the country name or use the dropdown menu)
7. Multilanguage support
8. Mobile view of the dashboard
