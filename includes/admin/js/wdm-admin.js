function handleCountrySelection() {
    jQuery(document).ready(function($) {
        // When the selected option of the country dropdown changes
        $('#country-select').change(function() {
            // Hide all project fields
            $('[id^=project-field-]').hide();

            const selectedCountry = $(this).val();

            // Show the project field for the selected country
            $('#project-field-' + selectedCountry).show();

            // Update the label description with the selected country
            var labelFor = $(this).attr("id"),
            label = $("[for='" + labelFor + "']");
            label.find(".label-desc").html(slugToCountry(selectedCountry));

        }).change(); // Trigger the change event manually

        // When the country dropdown is clicked
        $("select").on("click" , function() {
            $(this).parent(".country-select").toggleClass("open");
        });

        // When clicking outside the country dropdown
        $(document).mouseup(function (e) {
            var container = $(".country-select");
            if (container.has(e.target).length === 0) {
                container.removeClass("open");
            }
        });
    });
}

handleCountrySelection();


