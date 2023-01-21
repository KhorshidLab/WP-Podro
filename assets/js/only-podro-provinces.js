jQuery(document).ready(function(){
	const data = {
		action:'get_podro_cities_by_province',

	};
	let billing_element = jQuery('#billing_state');
	let shipping_element = jQuery('#shipping_state');

	ajaxRequest(data, function(response){

		billing_element.find('option').remove();
		shipping_element.find('option').remove();
		for(let i=0; i< response.length; i++){

			billing_element.append(`<option value='${response[i].code}'>${response[i].name}</option>`);
			shipping_element.append(`<option value='${response[i].code}'>${response[i].name}</option>`);

		}

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
