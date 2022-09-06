(function( $ ) {
	'use strict';

	var delivery_options = [];
	var has_delivery_date = false;

	$('#get_order_pdf, .get_order_pdf').on('click', function(e) {
		e.preventDefault();
		var order_id = $(this).attr('data-order_id');

		const data = {
			'action': 'pod_token',
			security: wp_podro_ajax_object.security,
			'order_id': order_id
		};

		pod_ajax( data, _callback_pdf );
	})

	$('#pod-cancel-order, .pod-cancel-order').on('click', function(e) {
		e.preventDefault();
		var order_id = $(this).attr('data-order_id');

		const data = {
			'action': 'cancel_order',
			security: wp_podro_ajax_object.security,
			'order_id': order_id
		};

		pod_ajax( data, _callback_cancel_order );
	})

	function _callback_cancel_order( response ) {
		location.reload();
	}

	function _callback_pdf( response ) {
		var myHeaders = new Headers();
		myHeaders.append("Content-Type", "application/json");
		myHeaders.append("Accept", "application/json");
		myHeaders.append("Authorization", "Bearer " + response.data.token);

		var requestOptions = {
		method: 'GET',
		headers: myHeaders,
		redirect: 'follow'
		};
		fetch("https://portal.podro.com/api/v1/orders/"+ response.data.order_id +"/pdf", requestOptions)
		// Retrieve its body as ReadableStream
		.then(response => response.body)
		.then(rs => {
			const reader = rs.getReader();

			return new ReadableStream({
			async start(controller) {
				while (true) {
				const { done, value } = await reader.read();

				// When no more data needs to be consumed, break the reading
				if (done) {
					break;
				}

				// Enqueue the next data chunk into our target stream
				controller.enqueue(value);
				}

				// Close the stream
				controller.close();
				reader.releaseLock();
			}
			})
		})
		// Create a new response out of the stream
		.then(rs => new Response(rs))
		// Create an object URL for the response
		.then(response => response.arrayBuffer())
		.then(arrayBuffer => {
			var file = new Blob([arrayBuffer], { type: 'application/pdf;charset-UTF-8' });
				var fileURL = URL.createObjectURL(file);
				window.open(fileURL);
		});
	}

	$(document).on('click', '.pod-delivery-step-1', function(e) {
		e.preventDefault()


		const data = {
			action: 'pod_delivery_step_1',
			security: wp_podro_ajax_object.security,
			weight: $('input[name=pod_weight]').val(),
			totalprice: $('input[name=pod_totalprice]').val(),
			width: $('input[name=pod_width]').val(),
			height: $('input[name=pod_height]').val(),
			depth: $('input[name=pod_depth]').val(),
			order_id: $('input[name=pod_order_id]').val(),
		};

		if ( pod_validate_step_1( data ) ) {
			pod_ajax( data, _callback_step_1 );
		}
	})

	$(document).on('click', '.pod-delivery-step-2', function(e) {
		e.preventDefault()
		const data = {
			action: 'pod_delivery_step_2',
			security: wp_podro_ajax_object.security,
			weight: $('input[name=pod_weight]').val(),
			totalprice: $('input[name=pod_totalprice]').val(),
			width: $('input[name=pod_width]').val(),
			height: $('input[name=pod_height]').val(),
			depth: $('input[name=pod_depth]').val(),
			provider_code: $('input[name=pod_delivery_option]:checked').val(),
			provider_name: $('input[name=pod_delivery_option]:checked + label > .pod_delivery_option > span').html(),
			provider_delivery_time: $('input[name=pod_delivery_option]:checked + label > .description span').html(),
			order_id: $('input[name=pod_order_id]').val(),
		};

		if ( pod_validate_step_2( data ) ) {
			pod_ajax( data, _callback_step_2 );
		} else {
			alert('لطفا یک روش ارسال انتخاب کنید');
		}
	})

	$(document).on('click', '.pod-delivery-step-3', function(e) {
		e.preventDefault()
		var data = {
			action: 'pod_delivery_step_3',
			security: wp_podro_ajax_object.security,
			delivery_order_id: $('input[name=pod_delivery_order_id]').val(),
			order_id: $('input[name=pod_order_id]').val(),
		};

		pod_ajax( data, _callback_step_3 );
	})

	$(document).on('click', '.pod-delivery-step-4', function(e) {
		e.preventDefault()

		let pickup_date = $('input[name=pod_pickup_option]').val();
		pickup_date = pickup_date.split(':');

		const data = {
			action: 'pod_delivery_step_4',
			security: wp_podro_ajax_object.security,
			delivery_order_id: $('input[name=pod_delivery_order_id]').val(),
			pickup_date: pickup_date[0],
			option_id: pickup_date[1],
			payment_approach: 'CASH',
			pod_order_id: $('input[name=pod_order_id]').val(),
		}

		if ( has_delivery_date ) {
			let delivery_date = $('input[name=pod_delivery_option]').val();
			delivery_date = delivery_date.split(':');
			data.delivery_date = delivery_date[0];
			data.delivery_option_id = delivery_date[1];
		}

		if ( pod_validate_step_4( data ) ) {
			pod_ajax( data, _callback_step_4 );
		} else {
			alert('لطفا زمان تحویل را انتخاب کنید')
		}
	})

	$(document).on('click', '.pod-delivery-cancel', function(e) {
		e.preventDefault()
		location.reload();
	})

	$(document).on('change', 'select[name=pod_delivery_option_day]', function(e) {
		$('.pod-delivery-step-3-wrapper .pod-pickup.pod-hide').removeClass('pod-hide').addClass('pod-show')
		$(this).removeClass('pod-error')

		$('input[name=pod_pickup_option]').prop('checked', false);

		let options = ''
		let d = this.value

		if ( d == '' || d == '0' || d == null ) {
			$('.pod-delivery-step-3-wrapper .pod-pickup.pod-show').removeClass('pod-show').addClass('pod-hide')
			$('fildset.pod-pickup-step-3-option-wrapper').html('')
			return;
		}

		let index = delivery_options.available_options.findIndex(function(item) {
			return item.date == d
		})


		delivery_options.available_options[index].option_ids.forEach(function(item) {
			delivery_options.options.forEach(function(option) {
				if (option.option_id == item) {
					options += `<div class="pod-pickup-step-3-option">
									<input type="radio" name="pod_pickup_option" value="${d}:${option.option_id}" />
									<label>${option.title}</label>
								</div>`
				}
			})
		})

		$('fildset.pod-pickup-step-3-option-wrapper').html( options )
	})

	$(document).on('click', '.pod-delivery-step-2-option', function(e) {
		$(this).find('input[type=radio]').prop('checked', true)
		$(this).find('input[type=radio]').trigger('change')

		$(this).addClass('active').siblings().removeClass('active')
	})

	$(document).on('click', '.pod-delivery-step-3-option', function(e) {
		$(this).find('input[type=radio]').prop('checked', true)
		$(this).find('input[type=radio]').trigger('change')

		$(this).addClass('active').siblings().removeClass('active')
	})

	$(document).on('click', '.pod-pickup-step-3-option', function(e) {
		$(this).find('input[name="pod_pickup_option"]').prop('checked', true)
		$(this).find('input[name="pod_pickup_option"]').trigger('change')


		if ( has_delivery_date ) {
			$('.pod-delivery-step-3-wrapper .pod-delivery').removeClass('pod-hide').addClass('pod-show');

			const $delivery_wrapper = $('.pod-delivery-step-3-wrapper .pod-delivery-step-3-option-wrapper');

			let current_pickup_option = $(this).find('input[name="pod_pickup_option"]').val()
			current_pickup_option = current_pickup_option.split(':');

			let html = '';

			let index = delivery_options.available_options.findIndex(function(item) {
				return item.date == current_pickup_option[0]
			})

			delivery_options.available_options[index].deliveries.forEach(function(item) {
				delivery_options.options.forEach(function(option) {
					if (option.option_id == item.option_id) {
						let persian_time = (new Date( item.date )).toLocaleDateString('fa-IR', {
							weekday: 'long',
							year: 'numeric',
							month: 'long',
							day: 'numeric',
						})
						html += `<div class="pod-delivery-step-3-option">
										<input type="radio" name="pod_delivery_option" value="${item.date}:${option.option_id}" />
										<label>${ persian_time + ' - ' + option.title}</label>
									</div>`
					}
				})
			})

			$delivery_wrapper.html( html )

		}

		$('.pod-pickup-step-3-option.active').removeClass('active')
		$(this).addClass('active')
	})

	function podro_show_loader() {
		$('#woocommerce-order-podro #lock-modal').show()
		$('#woocommerce-order-podro #loading-circle').show()
	}

	function podro_hide_loader() {
		$('#woocommerce-order-podro #lock-modal').hide()
		$('#woocommerce-order-podro #loading-circle').hide()
	}

	function pod_ajax( data, callback, error_callback = null ) {
		podro_show_loader();
		$.ajax({
			url: wp_podro_ajax_object.ajax_url,
			type: 'POST',
			data: data,
			responseType: 'arraybuffer',
			success: function( response ) {
				callback( response )
			podro_hide_loader();
			}
		}).fail( function( response ) {
			if ( error_callback ) {
				error_callback( response )
			}
			podro_hide_loader();
		})
	}

	function _callback_step_4( response ) {

		$('#woocommerce-order-podro .inside .pod-delivery-step-3-wrapper').remove()
		$('#woocommerce-order-podro .inside button').remove()

		$('#woocommerce-order-podro .inside').prepend('<h3 style="text-align=center;">ثبت سفارش با موفقیت انجام شد.</h3>')

		setTimeout(function() {
			location.reload();
		}, 3000);

	}

	function _callback_step_3( response ) {
		delivery_options = response.data
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

		has_delivery_date = delivery_options.available_options[0].deliveries != undefined;

		select_html += '</select>'


		let html = `<div class="pod-delivery-step-3-wrapper">
			<h4>لطفا روز پیکاپ را انتخاب کنید</h4>
			${select_html}
			<h4 class="pod-pickup pod-hide">لطفا زمان پیکاپ را انتخاب کنید</h4>
			<fildset class="pod-pickup-step-3-option-wrapper">
			</fildset>
			${has_delivery_date ? '<h4 class="pod-delivery pod-hide">لطفا زمان تحویل را انتخاب کنید</h4>' : ''}
			<fildset class="pod-delivery-step-3-option-wrapper">
			</fildset>
			<input type="hidden" name="pod_delivery_order_id" value="${response.data.order_id}" />
		</div>`

		$('#woocommerce-order-podro .inside').prepend( html )

		$('.pod-delivery-step-button').removeClass('pod-delivery-step-3').addClass('pod-delivery-step-4').html('تایید نهایی')
		$('.pod-delivery-cancel').remove()
	}

	function _callback_step_2( response ) {
		$('.pod-delivery-step-2-wrapper').remove()
		let html = `<div class="pod-delivery-step-2-wrapper">
			<h3>آیا سفارش زیر مورد تایید است؟</h3>
			<div class="pod-delivery-details">
				<ul>
					<li>
						<span>روش ارسال: </span>
						<span>${response.data.provider_name}</span>
					</li>
					<li>
					<span>زمان تحویل: </span>
						<span>${response.data.provider_delivery_time} ساعت بعد از جمع آوری</span>
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
						<span>${response.data.parcels[0].dimension.width}x${response.data.parcels[0].dimension.depth}x${response.data.parcels[0].dimension.height}</span>
					</li>
				</ul>
			</div>
		`
		html += `<input type="hidden" name="pod_delivery_order_id" value="${response.data.podro_order_id}">`;
		$('#woocommerce-order-podro .inside').prepend( html )

		$('.pod-delivery-step-button').removeClass('pod-delivery-step-2').addClass('pod-delivery-step-3').html('تایید سفارش')
		$('.pod-delivery-step-button').after('<button class="pod-delivery-cancel">لغو</button>')

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
							<span>${delivery_options[i].provider_name}</span> <small> (${delivery_options[i].service_type_label})</small>
						</div>
						<p class="price">
							<strong>قیمت: </strong>
							${price} تومان
						</p>
						<p class="description">
							<strong>زمان تحویل: </strong>
							<span>${delivery_options[i].from_hours} تا ${delivery_options[i].to_hours} ساعت</span>
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

	function pod_validate_step_1( data ) {
		let valid = true;
		if ( data.weight == '' ) {
			valid = false;
			$('input[name=pod_weight]').addClass('pod-error');
		}
		if ( data.totalprice == '' ) {
			valid = false;
			$('input[name=pod_totalprice]').addClass('pod-error');
		}
		if ( data.width == '') {
			valid = false;
			$('input[name=pod_width]').addClass('pod-error');
		}
		if ( data.height == '') {
			valid = false;
			$('input[name=pod_height]').addClass('pod-error');
		}
		if ( data.depth == '') {
			valid = false;
			$('input[name=pod_depth]').addClass('pod-error');
		}
		return valid;
	}

	function pod_validate_step_2( data ) {
		let valid = true;
		if ( data.provider_code == '' || data.provider_code == undefined ) {
			valid = false;
		}
		return valid;
	}

	function pod_validate_step_4( data ) {
		let valid = true;
		if ( data.pickup_date == '' || data.pickup_date == undefined ) {
			valid = false;
			$('select[name=pod_delivery_option_day]').addClass('pod-error');
		}
		if ( data.option_id == '' || data.option_id == undefined ) {
			valid = false;
		}
		if ( has_delivery_date && ( data.delivery_date == '' || data.delivery_date == undefined ) ) {
			valid = false;
		}
		return valid;
	}

	$(document).on('change', 'input.pod-error', function(e) {
		$(this).removeClass('pod-error');
	})

})( jQuery );
