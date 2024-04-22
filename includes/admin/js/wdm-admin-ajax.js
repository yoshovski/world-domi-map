jQuery(document).ready(function($) {
    let timeout = null;
    let loadingTimeout = null;
    const delay = 100;
    const loadingDelay = 1000;
    const loadingElement = jQuery('.wdm-loading-icon');

    $('.completed-projects-input').on('input', function() {
        clearTimeout(timeout);
        clearTimeout(loadingTimeout);

        if (!loadingElement.is(':visible'))
            loadingElement.show();

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
                updateSummaryCards();
            });
        }, delay);

        loadingTimeout = setTimeout(function() {
            loadingElement.hide();
        }, loadingDelay);
    });
});

function updateSummaryCards() {
        jQuery.ajax({
            url: wdm_admin_ajax_object.ajax_url,
            data: {
                'action': 'wdm_get_summary_cards',
                'nonce': wdm_admin_ajax_object.nonce
            },
            success: function (data) {
                for (let card in data) {
                    if (card === 'countryMaxSales' && typeof data[card] === 'object') {
                        const prettyNumber = prettyPrint(data[card].sales);
                        jQuery(`[data-card="${card}"] h1`).text(prettyNumber);
                        jQuery(`[data-card="${card}"] p`).text('Sales in ' + data[card].country);
                    } else {
                        const prettyNumber = prettyPrint(data[card]);
                        jQuery(`[data-card="${card}"] h1`).text(prettyNumber);
                    }                }
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
}

updateSummaryCards();

function sanitizeInputNumber(input, maxDigits = 10) {
    let sanitizedInput = input;

    // Check if the input is a positive integer within the maximum number of digits
    if (!new RegExp(`^[1-9]\\d{0,${maxDigits - 1}}$`).test(sanitizedInput))
        sanitizedInput = sanitizedInput.length > maxDigits ? sanitizedInput.slice(0, maxDigits) : '';

    if (sanitizedInput % 1 !== 0)
       sanitizedInput = Math.abs(parseInt(sanitizedInput.replace(',', ''), 10));

    return sanitizedInput;
}
