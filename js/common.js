
/**
 * Retrieve an array of country names from the list of countries and their SVG paths.
 * 
 * @returns {Promise<string[]>} A Promise that resolves to an array of country names.
 */
async function wdmGetCountryNames() {
    var countries = await wdmGetCountries();
    var countryNames = Object.keys(countries);
    return countryNames;
  }
  
/**
 * Read a JSON file from the specified file path.
 * 
 * @param {string} filePath - The path to the JSON file.
 * @returns {Promise<object|null>} A Promise that resolves to the parsed JSON data or null if an error occurs.
 */
async function readJsonFile(filePath) {
    return new Promise((resolve, reject) => {
        fetch(filePath)
          .then(response => response.json())
          .then(data => resolve(data))
          .catch(error => {
            console.error(error);
            reject(null);
          });
      });
}

/**
 * Retrieve the list of countries and their SVG paths from a JSON file.
 * 
 * @returns {Promise<object>} A Promise that resolves to an object containing country names as keys and SVG paths as values.
 */
async function wdmGetCountries() {
    var jsonFilePath = '../wp-content/plugins/world-domi-map/resources/country_paths.json';
    var resultObject = await readJsonFile(jsonFilePath);
    return resultObject;
}
  
 async function wdmGenerateMapSvg() {
    // Retrieve the list of countries and their SVG paths
    var countries = await wdmGetCountries();
  
    // Generate the SVG code by iterating over the countryPaths object
    var svgCode = '<svg width="2000" height="850" data-tip="true" currentItem="false" aria-describedby="ta3f93b00-9063-4635-9b34-ec7bdc67d1bc">';
    svgCode += '<g class="countries">';
  
    for (var country in countries) {
        console.log("country: " + country);
      if (countries.hasOwnProperty(country)) {
        var path = countries[country];
        svgCode += '<path class="map-geography map-geography-with-value" tabindex="0" d="' + path + '" fill="#62646a" title="' + country + '"></path>';
      }
    }
  
    svgCode += '</g>';
    svgCode += '</svg>';
  
    // Return the generated SVG code
    return svgCode;
  }
  