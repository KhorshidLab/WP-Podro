<?php
namespace WP_PODRO\Engine;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check if WooCommerce is active
if ( ( is_multisite() && array_key_exists( 'woocommerce/woocommerce.php', get_site_option( 'active_sitewide_plugins', array() ) ) ) ||
	in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	class WC_City_Select {

		private $cities;
		private $dropdown_cities;

		public function billing_fields( $fields, $country ) {
			$fields['billing_city']['type'] = 'city';

			return $fields;
		}

		public function shipping_fields( $fields, $country ) {
			$fields['shipping_city']['type'] = 'city';

			return $fields;
		}

		public function get_cities( $cc = null ) {
			if ( empty( $this->cities ) ) {
				$this->load_country_cities();
			}

			if ( ! is_null( $cc ) ) {
				return isset( $this->cities[ $cc ] ) ? $this->cities[ $cc ] : false;
			} else {
				return $this->cities;
			}
		}

		public function load_country_cities() {
			global $cities;

			// Load only the city files the shop owner wants/needs.
			$allowed = array_merge( WC()->countries->get_allowed_countries(), WC()->countries->get_shipping_countries() );

			foreach ( Location::get_cities() as $state_id => $cities_in_state ) {
				$provinces = Location::get_provinces();
				$state_Code = '';

				foreach ( $provinces as $province ) {
					if ( $province['id'] == $state_id ) {
						$state_Code = $province['code'];
						break;
					}
				}
				foreach ( $cities_in_state as $city ) {
					$cities[ 'IR' ][$state_Code][] = $city['name'];
				}
			}

			$this->cities = apply_filters( 'wc_city_select_cities', $cities );
		}

		private function add_to_dropdown($item) {
			$this->dropdown_cities[] = $item;
		}

		public function form_field_city( $field, $key, $args, $value ) {

			// Do we need a clear div?
			if ( ( ! empty( $args['clear'] ) ) ) {
				$after = '<div class="clear"></div>';
			} else {
				$after = '';
			}

			// Required markup
			if ( $args['required'] ) {
				$args['class'][] = 'validate-required';
				$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
			} else {
				$required = '';
			}

			// Custom attribute handling
			$custom_attributes = array();

			if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
				foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
					$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
				}
			}

			// Validate classes
			if ( ! empty( $args['validate'] ) ) {
				foreach( $args['validate'] as $validate ) {
					$args['class'][] = 'validate-' . $validate;
				}
			}

			// field p and label
			$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';
			if ( $args['label'] ) {
				$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
			}

			// Get Country
			$country_key = $key == 'billing_city' ? 'billing_country' : 'shipping_country';
			$current_cc  = WC()->checkout->get_value( $country_key );

			$state_key = $key == 'billing_city' ? 'billing_state' : 'shipping_state';
			$current_sc  = WC()->checkout->get_value( $state_key );

			// Get country cities
			$cities = $this->get_cities( $current_cc );

			if ( is_array( $cities ) ) {

				$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="city_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
					<option value="">'. __( 'Select an option&hellip;', 'woocommerce' ) .'</option>';

				if ( $current_sc && $cities[ $current_sc ] ) {
					$this->dropdown_cities = $cities[ $current_sc ];
				} else {
					$this->dropdown_cities = [];
					array_walk_recursive( $cities, array( $this, 'add_to_dropdown' ) );
					sort( $this->dropdown_cities );
				}

				foreach ( $this->dropdown_cities as $city_name ) {
					$field .= '<option value="' . esc_attr( $city_name ) . '" '.selected( $value, $city_name, false ) . '>' . $city_name .'</option>';
				}

				$field .= '</select>';

			} else {

				$field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
			}

			// field description and close wrapper
			if ( $args['description'] ) {
				$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
			}

			$field .= '</p>' . $after;

			return $field;
		}
	}
}
