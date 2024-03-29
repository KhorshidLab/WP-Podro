jQuery(document).ready(function(){

	setTimeout(reload_for_cities, 1000);

	function reload_for_cities(){

		let country_field = jQuery('#billing_country').length;
		if(country_field <= 0){
			jQuery('input#billing_city').replaceWith('<select id="billing_city" name="billing_city"></select>');
			jQuery('input#shipping_city').replaceWith('<select id="shipping_city" name="shipping_city"></select>');
			jQuery('select#billing_city').selectWoo();
			jQuery('select#shipping_city').selectWoo();

			jQuery('select#billing_state').selectWoo();
			jQuery('select#shipping_state').selectWoo();
			getCities();
		}


		if(jQuery('#billing_state option').length > 0){
			jQuery('#billing_state').trigger('change', 'IR');
			return;
		}

		// const city_count = jQuery('#billing_city option').length;
		// if(city_count >0){
		// 	jQuery('#billing_state').trigger('change');
		// }
	}

	jQuery('body').on('country_to_state_changed', function(p1,country){

		if( 'IR' == country ){
			//
			jQuery('input#billing_city').replaceWith('<select id="billing_city" name="billing_city"></select>');
			jQuery('input#shipping_city').replaceWith('<select id="shipping_city" name="shipping_city"></select>');
			jQuery('select#billing_city').selectWoo();
			jQuery('select#shipping_city').selectWoo();

			jQuery('select#billing_state').selectWoo();
			jQuery('select#shipping_state').selectWoo();
			getCities();
		}else{
			jQuery('#billing_city').parent().find('.select2').remove();
			jQuery('#shipping_city').parent().find('.select2').remove();
			jQuery('#billing_city').replaceWith('<input type="text" name="billing_city" id="billing_city" class="input-text "/>');
			jQuery('#shipping_city').replaceWith('<input type="text" name="shipping_city" id="shipping_city" class="input-text "/>');
		}
	});



	function getCities(){


		jQuery('#billing_state').change(function(){

			const province_code = jQuery(this).find('option:selected').text();
			const element = jQuery('#billing_city');

			if(!province_code)
				return;
			const data = {
				action:'get_podro_cities_by_province',

				province: province_code
			};

			ajaxRequest(data, callbackGetCities, element);

		});

		jQuery('#shipping_state').change(function(){
			const province_code = jQuery(this).find('option:selected').text();
			const element = jQuery('#shipping_city');
			if(!province_code)
				return;
			const data = {
				action:'get_podro_cities_by_province',

				province: province_code
			};

			ajaxRequest(data, callbackGetCities, element);
		});

	}


	jQuery('div.woocommerce-billing-fields#billing_state').trigger('change');
	jQuery('div.woocommerce-billing-fields#shipping_state').trigger('change');



	function callbackGetCities(response, element){

		const provinces = JSON.parse(response);

		element.find('option').remove();

		let cities = provinces.cities;

		Object.keys(cities).forEach(function(key) {

			element.append(`<option value='${cities[key]}'>${cities[key]}</option>`);

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
