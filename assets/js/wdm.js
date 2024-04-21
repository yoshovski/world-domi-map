function renderMap() {
    // Fetch the updated data
    fetchData().then(function(response) {
        // Update the map with the new data
        generateMap(response);
    }).catch(function(error) {
        // Handle the error
        console.log(error);
    });
}

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

    rescaleSvg();
}

function isProjectCompleted(country, completedProjects) {
    const countrySlug = country.replace(/\s+/g, '-').toLowerCase();
    return completedProjects[countrySlug] && completedProjects[countrySlug] > 0;
}


function rescaleSvg() {
    const widthThreshold = 0.9; // percentage (1 = 100%)
    const viewBoxWidth = 2000;
    const viewBoxHeight = 850;
    const aspectRatio = viewBoxHeight / viewBoxWidth;
    const svgElement = jQuery('.wdm-map-container svg');
    let svgContainerWidth = svgElement.width();
    const parentElement = jQuery('.wdm-map-container').parent();
    const parentWidth = parentElement[0].offsetWidth;

    // Adjust SVG width if it's less than the width threshold of parent's width
    if(svgContainerWidth === undefined || svgContainerWidth === 0 || svgContainerWidth < widthThreshold * parentWidth) {
        svgContainerWidth = parentWidth
    }

    const newScale = svgContainerWidth / parentWidth;
    const newHeight = parentWidth * aspectRatio

    svgElement.css({
        'transform': `scale(${newScale})`,
        'transform-origin': '0% 0%',
        'width': '100%',
        'height': `${newHeight}px`
    });

    svgElement.attr('viewBox', `0 0 ${viewBoxWidth} ${viewBoxHeight}`);
}


window.onload = function($) {
    renderMap();
};

jQuery(window).resize(rescaleSvg);
