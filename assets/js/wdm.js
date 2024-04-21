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
        const className = isProjectCompleted(country, completedProjects) ? 'active' : 'inactive';
        const fillColor = className === 'active' ? activeColor : inactiveColor;
        const projects = completedProjects[countrySlug];

        let tooltipText;
        if (projects > 0) {
            tooltipText = `${country}: ${projects} sales`;
        } else {
            tooltipText = `${country}`;
        }

        output += `<path class="map-geography map-geography-with-value ${className}"
                        tabindex="0" d="${path}" fill="${fillColor}" data-tooltip="${tooltipText}">
                    </path>`;
    }

    output += '</g></svg><div class="tooltiptext" id="mapTooltip"></div></div>';

    const mapContainers = document.querySelectorAll('.wdm-map-container');

    mapContainers.forEach(container => {
        container.innerHTML = output;
    });

    const paths = document.querySelectorAll('.map-geography');
    const tooltip = document.getElementById('mapTooltip');

    //TODO: Fix wrong y position of tooltip
    paths.forEach(path => {
        path.addEventListener('mouseover', function(e) {
            tooltip.style.visibility = 'visible';
            tooltip.style.opacity = '1';
            tooltip.textContent = e.target.dataset.tooltip;
        });

        path.addEventListener('mousemove', function(e) {
            const containerRect = document.querySelector('.wdm-map-container').getBoundingClientRect();
            const tooltipLeft = e.pageX - containerRect.left;
            const tooltipTop = e.pageY - containerRect.top;

            tooltip.style.left = tooltipLeft + 'px';
            tooltip.style.top = tooltipTop + 'px';
        });

        path.addEventListener('mouseout', function() {
            tooltip.style.visibility = 'hidden';
            tooltip.style.opacity = '0';
        });
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


