function handleCountrySelection() {
    jQuery(document).ready(function($) {
        // When the selected option of the country dropdown changes
        $('#country-select').change(function() {
            // Hide all project fields
            $('[id^=project-field-]').hide();

            // Get the selected country
            const selectedCountry = $(this).val();

            // Show the project field for the selected country
            $('#project-field-' + selectedCountry).show();
        }).change(); // Trigger the change event manually
    });
}
//TODO: Improve auto scaling
function updateSvgScale() {

    /*.wdm-map-container svg {*/
    /*    transform: scale(0.6);*/
    /*    transform-origin: 0% 0%;*/
    /*    viewBox: 0 0 2000 850;*/
    /*    width: 2000px;*/
    /*    height: 850px;*/
    /*}*/

    // Get the width of the SVG's container
    var containerWidth = jQuery('.wdm-map-container svg').width();

    // Calculate the new scale. This is just an example, you might need to adjust the calculation.
    var newScale = containerWidth / 2000;

    // Calculate the height based on the aspect ratio
    var newHeight = containerWidth * 0.425; // 0.425 is the aspect ratio (850/2000)
    console.log("containerWidth: " + containerWidth+ " newScale: " + newScale + " newHeight: " + newHeight);

    // Apply the new scale and height to the SVG
    jQuery('.wdm-map-container svg').css({
        'transform': 'scale(' + newScale + ')',
        'transform-origin': '0% 0%',
        'width': '100%',
        'height': newHeight + 'px'
    });

    // Set the viewBox attribute
    jQuery('.wdm-map-container svg').attr('viewBox', '0 0 2000 850');
}

// Call the function once to set the initial scale
updateSvgScale();

// Add the event listener to update the scale whenever the window is resized
jQuery(window).resize(updateSvgScale);

// Call the function
handleCountrySelection();


