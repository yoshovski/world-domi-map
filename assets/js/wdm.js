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

function slugToCountry(slug) {
    if (slug)
        return slug.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
}

function generateMapHTML(data) {
    const {worldDominationPercentage, countryPaths, completedProjects, displayCountryNames} = data;
    const activeColor = "#62646a";
    const inactiveColor = "#e4e5e7";
    const titleMessage = wdm_text.map_title;

    let output = `<h2 class="section-header tbody-4">${titleMessage} ${worldDominationPercentage}</h2>
                         <svg><g class="countries">`;

    for (let country in countryPaths) {
        const countrySlug = countryToSlug(country);
        const path = countryPaths[country];
        const countryData = completedProjects[countrySlug];
        let projectCount = 0;
        if (countryData) {  // Check if countryData is not undefined
            const displayCountryName = Object.keys(countryData)[0];
            projectCount = countryData[displayCountryName];
        }

        const countryStatusClassName = projectCount > 0 ? 'active' : 'inactive';
        const fillColor = countryStatusClassName === 'active' ? activeColor : inactiveColor;
        const countProjects = completedProjects[countrySlug];
        const prettyCountProjects = prettyPrint(countProjects);
        const displayCountryName = displayCountryNames[countrySlug];

        let tooltipText;
        if (countProjects > 0) {
            let salesText = countProjects > 1 ? wdm_text.sales : wdm_text.sale;
            tooltipText = `${displayCountryName} - ${prettyCountProjects} ${salesText}`;
        }
        else
            tooltipText = displayCountryName;

        output += `<path class="map-geography map-geography-with-value ${countryStatusClassName} tooltip" tabindex="0" d="${path}" fill="${fillColor}">`;

        if (countryStatusClassName === 'active')
            output += `<title>${tooltipText}</title>`;

        output += `</path>`;
    }

    output += '</g></svg>';

    return output;
}

function generateMap(data) {
    const mapContainers = document.querySelectorAll('.wdm-map-container');

    mapContainers.forEach(container => {
        container.innerHTML = generateMapHTML(data);
    });

    rescaleSvg();
}

function isProjectCompleted(country, completedProjects) {
    const countrySlug = country.replace(/\s+/g, '-').toLowerCase();
    return completedProjects[countrySlug] && completedProjects[countrySlug] > 0;
}

function prettyPrint(number) {

    if (number > 999999999) {
        let result = (number / 1000000000).toFixed(1);
        return result.endsWith('.0') ? result.slice(0, -2) + 'B' : result + 'B';
    }

    if (number > 999999) {
        let result = (number / 1000000).toFixed(1);
        return result.endsWith('.0') ? result.slice(0, -2) + 'M' : result + 'M';
    }

    if (number > 999) {
        let result = (number / 1000).toFixed(1);
        return result.endsWith('.0') ? result.slice(0, -2) + 'K' : result + 'K';
    }

    let result = (1* number).toFixed(1);
    return result.endsWith('.0') ? result.slice(0, -2) : result;
}


function rescaleSvg() {
    const widthThreshold = 0.9; // percentage (1 = 100%)
    const viewBoxWidth = 2000;
    const viewBoxHeight = 850;
    const aspectRatio = viewBoxHeight / viewBoxWidth;
    const svgElement = jQuery('.wdm-map-container svg');
    let svgContainerWidth = svgElement.width();
    const wdmMapContainer = jQuery('.wdm-map-container');

    if (wdmMapContainer.length === 0)
        return;

    const parentElement = wdmMapContainer.parent();
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
