jQuery(document).ready(function($) {
    // When the value of a project field changes
    $('.wdm-ajax-trigger').change(function() {
        // Get the country name from the field's id
        const countryName = $(this).attr('id').replace('wdm_project_', '');

        // Get the number of projects from the field's value
        const numberOfProjects = $(this).val();

        // Create an object to hold the data
        let data = {
            'action': 'wdm_update_setting',
            'name': countryName,
            'value': numberOfProjects
        };

        // Send the AJAX request
        $.post(wdm_ajax_object.ajax_url, data, function(response) {
            console.log(response);
            updateMap();
        });
    });
});
