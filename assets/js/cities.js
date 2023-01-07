jQuery(document).ready(function(){


	const data = {
		action:'get_podro_cities',
		method:'post'
	}
	ajaxRequest(data, podro_cities_callback, null);
	let cities = [];
	function podro_cities_callback(response, element){
		cities = response;

	}

	jQuery('#billing_city').on('change', function(){

		if( !is_this_podro_city(cities,jQuery(this).find('option:selected').text())){
			jQuery("[id*='podro_method']").prop('disabled', true);
			jQuery("[id*='podro_method']").prop('checked',false);
			jQuery("[id*='podro_method']").removeAttr('checked');
			const count = jQuery(this).find('#shipping_method input[type=radio]:checked').length;
			if(count > 0)
				return;
			if(!jQuery('#shipping_method input[type=radio]:checked').attr('id'))
				jQuery("[id*='podro_method']").parent().next('li').find("input[type=radio]").prop('checked',true);
		}else{
			jQuery("[id*='podro_method']").prop('disabled',false);

		}
	});

	jQuery('body').on('updated_checkout', function() {
		if( !is_this_podro_city(cities,jQuery('#billing_city').find('option:selected').text())){

			jQuery("[id*='podro_method']").prop('disabled', true);
			jQuery("[id*='podro_method']").prop('checked',false);
			jQuery("[id*='podro_method']").removeAttr('checked');
			const count = jQuery(this).find('#shipping_method input[type=radio]:checked').length;
			if(count > 0)
				return;


			if(!jQuery('#shipping_method input[type=radio]:checked').attr('id'))
				jQuery("[id*='podro_method']").parent().next('li').find("input[type=radio]").prop('checked',true);
		}else{
			jQuery("[id*='podro_method']").prop('disabled',false);


		}
	});


	function is_this_podro_city(city_list, name){

		let result = false;
		Object.keys(city_list).forEach(key => {

			if(  city_list[key] === name ){
				result = true;
				return result;
			}


		});
		return result;
	}


	function callbackGetCities(response, element){

		const provinces = JSON.parse(response);

		element.find('option').remove();

		let cities = provinces.cities;

		Object.keys(cities).forEach(function(key) {

			element.append(`<option value='${key}'>${cities[key]}</option>`);

		});

	}

	function ajaxRequest(data, callback, element){

		jQuery.ajax({
			url: woocommerce_params.ajax_url,
			type: 'post',
			data: data,

			success: function( response ) {
				callback(response, element);
			}
		}).fail( function( response ) {
			console.log(response);
		})

	}

});
