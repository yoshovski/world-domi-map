function renderMap() {
    fetchData().then(function (response) {
        generateMap(response);
    }).catch(function (error) {
        console.log(error);
    });
}

function countryToSlug(country) {
    return country.toLowerCase().replace(/\s+/g, '-');
}

function generateMap(data) {
    const {worldDominationPercentage, countryPaths, completedProjects} = data;
    const activeColor = "#62646a";
    const inactiveColor = "#e4e5e7";

    let output = `<div class="wdm-map-container">
                            <h2 class="section-header tbody-4">World Domination ${worldDominationPercentage}</h2>
                            <svg><g class="countries">`;

    for (let country in countryPaths) {
        const countrySlug = countryToSlug(country);
        const path = countryPaths[country];
        const countryStatusClassName = isProjectCompleted(country, completedProjects) ? 'active' : 'inactive';
        const fillColor = countryStatusClassName === 'active' ? activeColor : inactiveColor;
        const projects = completedProjects[countrySlug];

        let tooltipText;
        if (projects > 0)
            tooltipText = `${country} - ${projects} Sales`;
        else
            tooltipText = `${country}`;

        output += `<path class="map-geography map-geography-with-value ${countryStatusClassName} tooltip" tabindex="0" d="${path}" fill="${fillColor}">`;

        if (countryStatusClassName === 'active')
            output += `<title>${tooltipText}</title>`;

        output += `</path>`;
    }

    output += '</g></svg></div>';

    const mapContainers = document.querySelectorAll('.wdm-map-container');

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
    if (svgContainerWidth === undefined || svgContainerWidth === 0 || svgContainerWidth < widthThreshold * parentWidth) {
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


window.onload = function ($) {
    renderMap();
};

jQuery(window).resize(rescaleSvg);


