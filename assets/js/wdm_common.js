// Fetch data from the server
async function fetchData() {
    const response = await fetch(wdm_rest_object.get_map_data_url);
    const data = await response.json();
    return data;
}

// Generate the map
function generateMap(data) {
    const activeColor = "#62646a";
    const inactiveColor = "#e4e5e7";

    let output = '<div class="wdm-map-container">';
    output += '<h2 class="section-header tbody-4">World Domination ' + data.worldDominationPercentage + '</h2>';
    output += '<svg><g class="countries">';

    for (let country in data.countryPaths) {
        const path = data.countryPaths[country];
        const className = isProjectCompleted(country, data.completedProjects) ? 'active' : 'inactive';
        const fillColor = className == 'active' ? activeColor : inactiveColor;

        output += '<path class="map-geography map-geography-with-value ' + className + '" tabindex="0" d="' + path + '" fill="' + fillColor + '" title="' + country + '"></path>';
    }

    output += '</g></svg></div>';

    const mapContainers = document.querySelectorAll('.wdm-map-container');
    // Generate the map for each container
    mapContainers.forEach(container => {
        container.innerHTML = output;
    });
}

// Check if a project is completed
function isProjectCompleted(country, completedProjects) {
    const countrySlug = country.replace(/\s+/g, '-').toLowerCase();
    return completedProjects[countrySlug] && completedProjects[countrySlug] > 0;
}

// Fetch the data and generate the map
fetchData().then(data => {
    generateMap(data);
});
