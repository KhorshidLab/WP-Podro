(function( $ ) {
	'use strict';

	var delivery_options = [];

	$(document).on('click', '.pod-delivery-step-1', function(e) {
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

	$(document).on('click', '.pod-delivery-step-2', function(e) {
		e.preventDefault()
		var data = {
			action: 'pod_delivery_step_2',
			security: wp_podro_ajax_object.security,
			weight: $('input[name=pod_weight]').val(),
			totalprice: $('input[name=pod_totalprice]').val(),
			width: $('input[name=pod_width]').val(),
			height: $('input[name=pod_height]').val(),
			depth: $('input[name=pod_depth]').val(),
			provider_code: $('input[name=pod_delivery_option]:checked').val(),
			order_id: $('input[name=pod_order_id]').val(),
		};

		pod_ajax( data, _callback_step_2 );
	})

	$(document).on('click', '.pod-delivery-step-3', function(e) {
		e.preventDefault()
		var data = {
			action: 'pod_delivery_step_3',
			security: wp_podro_ajax_object.security,
			delivery_order_id: $('input[name=pod_delivery_order_id]').val(),
		};

		pod_ajax( data, _callback_step_3 );
	})

	$(document).on('click', '.pod-delivery-step-4', function(e) {
		e.preventDefault()
		alert('under construction')
	})

	$(document).on('change', 'select[name=pod_delivery_option_day]', function(e) {
		$('.pod-delivery-step-3-wrapper + h4.pod-hide').removeClass('pod-hide').addClass('pod-show')

		$('input[name=pod_delivery_option]').prop('checked', false);

		let options = ''
		let d = this.value

		if ( d == '' || d == '0' || d == null ) {
			$('.pod-delivery-step-3-wrapper + h4.pod-show').removeClass('pod-show').addClass('pod-hide')
			$('fildset.pod-delivery-step-3-option-wrapper').html('')
			return;
		}

		let index = delivery_options.available_options.findIndex(function(item) {
			return item.date == d
		})


		delivery_options.available_options[index].option_ids.forEach(function(item) {
			delivery_options.options.forEach(function(option) {
				if (option.option_id == item) {
					options += `<div class="pod-delivery-step-3-option">
									<input type="radio" name="pod_delivery_option" value="${d}:${option.option_id}" />
									<label>${option.title}</label>
								</div>`
				}
			})
		})

		$('fildset.pod-delivery-step-3-option-wrapper').html( options )
	})

	$(document).on('click', '.pod-delivery-step-2-option', function(e) {
		$(this).find('input[type=radio]').prop('checked', true)
		$(this).find('input[type=radio]').trigger('change')

		$(this).addClass('active').siblings().removeClass('active')
	})

	$(document).on('click', '.pod-delivery-step-3-option', function(e) {
		$(this).find('input[type=radio]').prop('checked', true)
		$(this).find('input[type=radio]').trigger('change')

		$('.pod-delivery-step-3-option.active').removeClass('active')
		$(this).addClass('active')
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

	function _callback_step_3( response ) {
		delivery_options = response.data
		console.log(response)
		$('.pod-delivery-step-2-wrapper').remove()



		let select_html = '<select name="pod_delivery_option_day">'
		select_html += '<option value="">انتخاب</option>'

		delivery_options.available_options.forEach( function( time ) {
			let persian_time = (new Date( time.date )).toLocaleDateString('fa-IR', {
				weekday: 'long',
				year: 'numeric',
				month: 'long',
				day: 'numeric',
			  })
			select_html += '<option value="' + time.date + '">' + persian_time + '</option>'
		})

		select_html += '</select>'


		let html = `<div class="pod-delivery-step-3-wrapper">
			<h4>لطفا روز تحویل را انتخاب کنید</h4>
			${select_html}
			<h4 class="pod-hide">لطفا زمان پیکاپ را انتخاب کنید</h4>
			<fildset class="pod-delivery-step-3-option-wrapper">
			</fildset>
		</div>`

		$('#woocommerce-order-podro .inside').prepend( html )

		$('.pod-delivery-step-button').removeClass('pod-delivery-step-3').addClass('pod-delivery-step-4').html('تایید نهایی')
		$('.pod-delivery-step-3-cancel').remove()
	}

	function _callback_step_2( response ) {
		$('.pod-delivery-step-2-wrapper').remove()
		let html = `<div class="pod-delivery-step-2-wrapper">
			<h3>آیا سفارش زیر مورد تایید است؟</h3>
			<div class="pod-delivery-details">
				<ul>
					<li>
						<span>روش ارسال: </span>
						<span>${response.data.provider_code}</span>
					</li>
					<li>
						<span>زمان ارسال: </span>
						<span>${response.data.delivery_time}</span>
					</li>
					<li>
						<span>مبلغ کل: </span>
						<span>${response.data.parcels[0].value}</span>
					</li>
					<li>
						<span>وزن: </span>
						<span>${response.data.parcels[0].weight}</span>
					</li>
					<li>
						<span>ابعاد: </span>
						<span>${response.data.parcels[0].dimension.width}x${response.data.parcels[0].dimension.height}x${response.data.parcels[0].dimension.depth}</span>
					</li>
				</ul>
			</div>
		`
		html += `<input type="hidden" name="pod_delivery_order_id" value="${response.data.podro_order_id}">`;
		$('#woocommerce-order-podro .inside').prepend( html )

		$('.pod-delivery-step-button').removeClass('pod-delivery-step-2').addClass('pod-delivery-step-3').html('تایید سفارش')
		$('.pod-delivery-step-button').after('<button class="pod-delivery-step-3-cancel">لغو</button>')

	}

	function _callback_step_1( response ) {
		if ( response.success ) {
			let data = {
				weight: $('input[name=pod_weight]').val(),
				totalprice: $('input[name=pod_totalprice]').val(),
				width: $('input[name=pod_width]').val(),
				height: $('input[name=pod_height]').val(),
				depth: $('input[name=pod_depth]').val(),
				order_id: $('input[name=pod_order_id]').val(),
			};

			$('.pod-delivery-step').remove()
			$('.pod-delivery-step-button').removeClass('pod-delivery-step-1').addClass('pod-delivery-step-2').html('مرحله بعد')

			const delivery_options = response.data.quotes;

			let html = '<fildset class="pod-delivery-step-2-wrapper">';
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

			html += `
			<input type="hidden" name="pod_weight" value="${data.weight}">
			<input type="hidden" name="pod_totalprice" value="${data.totalprice}">
			<input type="hidden" name="pod_width" value="${data.width}">
			<input type="hidden" name="pod_height" value="${data.height}">
			<input type="hidden" name="pod_depth" value="${data.depth}">
			<input type="hidden" name="pod_order_id" value="${data.order_id}">
			`

			$('#woocommerce-order-podro .inside').prepend( html )
		}
	}
})( jQuery );
