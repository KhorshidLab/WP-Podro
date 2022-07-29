(function( $ ) {
	'use strict';

	$(document).ready(function() {
		$('.pod-delivery-step-1').on('click', function(e) {
			e.preventDefault()
			var data = {
				action: 'pod_delivery_step_1',
				security: wp_podro_ajax_object.security,
				weight: $('input[name=pod_weight]').val(),
				totalprice: $('input[name=pod_totalprice]').val(),
				width: $('input[name=pod_width]').val(),
				height: $('input[name=pod_height]').val(),
				depth: $('input[name=pod_depth]').val(),
				order_id: $('input[name=pod_order_id]').val(),
			};

			pod_ajax( data, _callback_step_1 );
		})

	})

	$(document).on('click', '.pod-delivery-step-2', function(e) {
		e.preventDefault()
		var data = {
			action: 'pod_delivery_step_2',
			security: wp_podro_ajax_object.security,
			weight: $('input[name=pod_weight]').val(),
			order_id: $('input[name=pod_order_id]').val(),
		};

		pod_ajax( data, _callback_step_2 );
	})

	$(document).on('click', '.pod-delivery-step-2-option', function(e) {
		$(this).find('input[type=radio]').prop('checked', true)
		$(this).find('input[type=radio]').trigger('change')

		$(this).addClass('active').siblings().removeClass('active')
	})

	function pod_ajax( data, callback, error_callback = null ) {
		$.ajax({
			url: wp_podro_ajax_object.ajax_url,
			type: 'POST',
			data: data,
			success: function( response ) {
				callback( response )
			}
		}).fail( function( response ) {
			if ( error_callback ) {
				error_callback( response )
			}
		})
	}

	function _callback_step_2( response ) {
		console.log(response)
	}

	function _callback_step_1( response ) {
		if ( response.success ) {
			$('.pod-delivery-step').remove()
			$('.pod-delivery-step-button').removeClass('pod-delivery-step-1').addClass('pod-delivery-step-2').html('ثبت درخواست')

			const delivery_options = response.data.quotes;

			let html = '<fildset class="pod-delivery-step-2">';
			for ( let i = 0; i < delivery_options.length; i++ ) {
				let price = delivery_options[i].price
				price = price.toString().replace(/\D/g, '').slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
				html += `<div class="pod-delivery-step-2-option">
					<input type="radio" name="pod_delivery_option" value="${delivery_options[i].provider_code}" id="pod_delivery_option_${delivery_options[i].provider_code}">
					<label for="pod_delivery_option_${delivery_options[i].provider_code}">
						<div class="pod_delivery_option">
							<img src="${delivery_options[i].provider_logo}" alt="${delivery_options[i].provider_name}">
							${delivery_options[i].provider_name} <small> (${delivery_options[i].service_type_label})</small>
						</div>
						<p class="price">
							<strong>قیمت: </strong>
							${price} تومان
						</p>
						<p class="description">
							<strong>زمان تحویل: </strong>
							${delivery_options[i].from_hours} تا ${delivery_options[i].to_hours} ساعت
						</p>
					</label>
					</div>`
			}

			html += '</fildset>'

			$('#woocommerce-order-podro .inside').prepend( html )
		}
	}
})( jQuery );
