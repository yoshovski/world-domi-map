// Fetch data from the server
function fetchData() {
    return new Promise((resolve, reject) => {
        jQuery.ajax({
            url: wdm_ajax_object.ajax_url,
            data: {
                'action': 'wdm_get_map_data',
                'nonce': wdm_ajax_object.nonce
            },
            success: function(response) {
                // Generate the map with the response data
                resolve(response);
            },
            error: function(error) {
                // Handle the error
                console.log(error);
                reject(error);
            }
        });
    });
}
