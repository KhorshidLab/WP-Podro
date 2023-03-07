jQuery(document).ready(function(){
	const data = {
		action:'get_podro_cities_by_province',

	};
	let billing_element = jQuery('#billing_state');
	let shipping_element = jQuery('#shipping_state');

	ajaxRequest(data, function(response){

		billing_element.find('option').remove();
		shipping_element.find('option').remove();

		Object.keys(response).forEach(function(key) {
			
			billing_element.append(`<option value='${key}'>${response[key].name}</option>`);
			shipping_element.append(`<option value='${key}'>${response[key].name}</option>`);
		})

	});

	function ajaxRequest(data, callback){

		jQuery.ajax({
			url: woocommerce_params.ajax_url,
			type: 'post',
			data: data,

			success: function( response ) {
				callback(response);
			}
		}).fail( function( response ) {
			console.log(response);
		})

	}

});
