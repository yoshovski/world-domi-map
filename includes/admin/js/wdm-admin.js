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

// Call the function
handleCountrySelection();
