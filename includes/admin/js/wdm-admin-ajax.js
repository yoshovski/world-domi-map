jQuery(document).ready(function($) {
    let timeout = null;

    $('.completed-projects-input').on('input', function() {
        clearTimeout(timeout);

        const countryName = $(this).attr('id').replace('wdm_project_', '');
        let numberOfProjects = sanitizeInputNumber($(this).val());
        $(this).val(numberOfProjects);

        let data = {
            'action': 'wdm_update_country_sales',
            'name': countryName,
            'value': numberOfProjects,
            'nonce': wdm_admin_ajax_object.nonce
        };

        timeout = setTimeout(function() {
            $.post(wdm_admin_ajax_object.ajax_url, data, function(response) {
                console.log(response);
                renderMap();
            });
        }, 100);
    });
});


function sanitizeInputNumber(input, maxDigits = 10) {
    let sanitizedInput = input;

    // Check if the input is a positive integer within the maximum number of digits
    if (!new RegExp(`^[1-9]\\d{0,${maxDigits - 1}}$`).test(sanitizedInput))
        sanitizedInput = sanitizedInput.length > maxDigits ? sanitizedInput.slice(0, maxDigits) : '';

    if (sanitizedInput % 1 !== 0)
       sanitizedInput = Math.abs(parseInt(sanitizedInput.replace(',', ''), 10));

    return sanitizedInput;
}
