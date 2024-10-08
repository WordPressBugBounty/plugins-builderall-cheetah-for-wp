<?php

/**
 * Helper class for font settings.
 *
 * @class   BACheetahFonts

 */
final class BACheetahFonts {

	/**
	 * An array of fonts / weights.
	 * @var array
	 */
	static private $fonts = array();

	static private $enqueued_google_fonts_done = false;

	/**

	 * @return void
	 */
	static public function init() {
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::combine_google_fonts', 10000 );
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_google_fonts', 9999 );
		add_filter( 'wp_resource_hints', __CLASS__ . '::resource_hints', 10, 2 );
	}

	/**
	 * Renders the JavasCript variable for font settings dropdowns.
	 *

	 * @return void
	 */
	static public function js() {
		/**
		 * @see ba_cheetah_font_families_default
		 */
		$default = wp_json_encode( apply_filters( 'ba_cheetah_font_families_default', BACheetahFontFamilies::$default ) );
		/**
		 * @see ba_cheetah_font_families_system
		 */
		$system = wp_json_encode( apply_filters( 'ba_cheetah_font_families_system', BACheetahFontFamilies::$system ) );
		/**
		 * @see ba_cheetah_font_families_google
		 */
		$google = wp_json_encode( apply_filters( 'ba_cheetah_font_families_google', self::prepare_google_fonts( BACheetahFontFamilies::google() ) ) );

		// We didn't escape echo because it already has wp_json_encode
		echo ('var BACheetahFontFamilies = { default: ' . $default . ', system: ' . $system . ', google: ' . $google . ' };');
	}

	static public function prepare_google_fonts( $fonts ) {
		foreach ( $fonts as $family => $variants ) {
			foreach ( $variants as $k => $variant ) {
				if ( 'italic' == $variant || 'i' == substr( $variant, -1 ) ) {
					unset( $fonts[ $family ][ $k ] );
				}
			}
		}
		return $fonts;
	}

	/**
	 * Renders a list of all available fonts.
	 *

	 * @param  string $font The current selected font.
	 * @return void
	 */
	static public function display_select_font( $font ) {
		$system_fonts = apply_filters( 'ba_cheetah_font_families_system', BACheetahFontFamilies::$system );
		$google_fonts = apply_filters( 'ba_cheetah_font_families_google', BACheetahFontFamilies::google() );
		$recent_fonts = get_option( 'ba_cheetah_recent_fonts', array() );

		echo '<option value="Default" ' . selected( 'Default', $font, false ) . '>' . __( 'Default', 'ba-cheetah' ) . '</option>';

		if ( is_array( $recent_fonts ) && ! empty( $recent_fonts ) ) {
			echo '<optgroup label="Recently Used" class="recent-fonts">';
			foreach ( $recent_fonts as $name => $variants ) {
				if ( 'Default' == $name ) {
					continue;
				}
				echo '<option value="' . esc_attr($name) . '">' . wp_kses_post($name) . '</option>';
			}
		}

		echo '<optgroup label="System">';

		foreach ( $system_fonts as $name => $variants ) {
			echo '<option value="' . esc_attr($name) . '" ' . selected( $name, $font, false ) . '>' . wp_kses_post($name) . '</option>';
		}

		echo '<optgroup label="Google">';

		foreach ( $google_fonts as $name => $variants ) {
			echo '<option value="' . esc_attr($name) . '" ' . selected( $name, $font, false ) . '>' . wp_kses_post($name) . '</option>';
		}
	}

	/**
	 * Renders a list of all available weights for a selected font.
	 *

	 * @param  string $font   The current selected font.
	 * @param  string $weight The current selected weight.
	 * @return void
	 */
	static public function display_select_weight( $font, $weight ) {
		if ( 'Default' == $font ) {
			echo '<option value="default" selected="selected">' . __( 'Default', 'ba-cheetah' ) . '</option>';
		} else {
			$system_fonts = apply_filters( 'ba_cheetah_font_families_system', BACheetahFontFamilies::$system );
			$google_fonts = apply_filters( 'ba_cheetah_font_families_google', BACheetahFontFamilies::google() );

			if ( array_key_exists( $font, $system_fonts ) ) {
				foreach ( $system_fonts[ $font ]['weights'] as $variant ) {
					echo '<option value="' . esc_attr($variant) . '" ' . selected( $variant, $weight, false ) . '>' . esc_html(BACheetahFonts::get_weight_string( $variant )) . '</option>';
				}
			} else {
				foreach ( $google_fonts[ $font ] as $variant ) {
					echo '<option value="' . esc_attr($variant) . '" ' . selected( $variant, $weight, false ) . '>' . esc_html(BACheetahFonts::get_weight_string( $variant )) . '</option>';
				}
			}
		}

	}

	/**
	 * Returns a font weight name for a respective weight.
	 *

	 * @param  string $weight The selected weight.
	 * @return string         The weight name.
	 */
	static public function get_weight_string( $weight ) {

		$weight_string = self::get_font_weight_strings();

		return $weight_string[ $weight ];
	}

	/**
	 * Return font weight strings.
	 */
	static public function get_font_weight_strings() {
		/**
		 * Array of font weights
		 * @see ba_cheetah_font_weight_strings
		 */
		return apply_filters( 'ba_cheetah_font_weight_strings', array(
			'default'   => __( 'Default', 'ba-cheetah' ),
			'regular'   => __( 'Regular', 'ba-cheetah' ),
			'italic'    => __( 'Italic', 'ba-cheetah' ),
			'100'       => __( 'Thin', 'ba-cheetah' ),
			'100i'      => __( 'Thin Italic', 'ba-cheetah' ),
			'100italic' => __( 'Thin Italic', 'ba-cheetah' ),
			'200'       => __( 'Extra-Light', 'ba-cheetah' ),
			'200i'      => __( 'Extra-Light Italic', 'ba-cheetah' ),
			'200italic' => __( 'Extra-Light Italic', 'ba-cheetah' ),
			'300'       => __( 'Light', 'ba-cheetah' ),
			'300i'      => __( 'Light Italic', 'ba-cheetah' ),
			'300italic' => __( 'Light Italic', 'ba-cheetah' ),
			'400'       => __( 'Normal', 'ba-cheetah' ),
			'400i'      => __( 'Normal Italic', 'ba-cheetah' ),
			'400italic' => __( 'Normal Italic', 'ba-cheetah' ),
			'500'       => __( 'Medium', 'ba-cheetah' ),
			'500i'      => __( 'Medium Italic', 'ba-cheetah' ),
			'500italic' => __( 'Medium Italic', 'ba-cheetah' ),
			'600'       => __( 'Semi-Bold', 'ba-cheetah' ),
			'600i'      => __( 'Semi-Bold Italic', 'ba-cheetah' ),
			'600italic' => __( 'Semi-Bold Italic', 'ba-cheetah' ),
			'700'       => __( 'Bold', 'ba-cheetah' ),
			'700i'      => __( 'Bold Italic', 'ba-cheetah' ),
			'700italic' => __( 'Bold Italic', 'ba-cheetah' ),
			'800'       => __( 'Extra-Bold', 'ba-cheetah' ),
			'800i'      => __( 'Extra-Bold Italic', 'ba-cheetah' ),
			'800italic' => __( 'Extra-Bold Italic', 'ba-cheetah' ),
			'900'       => __( 'Ultra-Bold', 'ba-cheetah' ),
			'900i'      => __( 'Ultra-Bold Italic', 'ba-cheetah' ),
			'900italic' => __( 'Ultra-Bold Italic', 'ba-cheetah' ),
		) );
	}

	/**
	 * Helper function to render css styles for a selected font.
	 *

	 * @param  array $font An array with font-family and weight.
	 * @return void
	 */
	static public function font_css( $font ) {

		$system_fonts = apply_filters( 'ba_cheetah_font_families_system', BACheetahFontFamilies::$system );
		$google       = BACheetahFontFamilies::get_google_fallback( $font['family'] );

		$css = '';

		if ( array_key_exists( $font['family'], $system_fonts ) ) {

			$css .= 'font-family: "' . $font['family'] . '",' . $system_fonts[ $font['family'] ]['fallback'] . ';';

		} elseif ( $google ) {
			$css .= 'font-family: "' . $font['family'] . '", ' . $google . ';';
		} else {
			$css .= 'font-family: "' . $font['family'] . '", sans-serif;';
		}

		if ( 'regular' == $font['weight'] ) {
			$css .= 'font-weight: normal;';
		} else {
			if ( 'i' == substr( $font['weight'], -1 ) ) {
				$css .= 'font-weight: ' . substr( $font['weight'], 0, -1 ) . ';';
				$css .= 'font-style: italic;';
			} elseif ( 'italic' == $font['weight'] ) {
				$css .= 'font-style: italic;';
			} else {
				$css .= 'font-weight: ' . $font['weight'] . ';';
			}
		}

		echo $css;
	}

	/**
	 * Add fonts to the $font array for a module.
	 *

	 * @param  object $module The respective module.
	 * @return void
	 */
	static public function add_fonts_for_module( $module ) {
		$fields = BACheetahModel::get_settings_form_fields( $module->form );

		// needed for italics.
		$google = BACheetahFontFamilies::google();

		foreach ( $fields as $name => $field ) {
			if ( 'font' == $field['type'] && isset( $module->settings->$name ) ) {
				self::add_font( $module->settings->$name );
			} elseif ( 'typography' == $field['type'] && ! empty( $module->settings->$name ) && isset( $module->settings->{ $name }['font_family'] ) && isset( $module->settings->{ $name }['font_weight'] ) ) {
				$fname  = $module->settings->{ $name }['font_family'];
				$weight = $module->settings->{ $name }['font_weight'];

				// handle google italics.
				if ( isset( $google[ $fname ] ) ) {
					$selected_weight = $module->settings->{ $name }['font_weight'];
					$italic          = ( isset( $module->settings->{ $name }['font_style'] ) ) ? $module->settings->{ $name }['font_style'] : '';

					if ( in_array( $selected_weight . 'i', $google[ $fname ] ) && 'italic' == $italic ) {
						$weight = $selected_weight . 'i';
					}
					if ( ( '400' == $selected_weight || 'regular' == $selected_weight ) && 'italic' == $italic && in_array( 'italic', $google[ $fname ] ) ) {
						$weight = '400i';
					}
				}

				self::add_font( array(
					'family' => $module->settings->{ $name }['font_family'],
					'weight' => $weight,
				) );
			} elseif ( isset( $field['form'] ) ) {
				$form = BACheetahModel::$settings_forms[ $field['form'] ];
				self::add_fonts_for_nested_module_form( $module, $form['tabs'], $name );
			}
		}
	}

	/**
	 * Add fonts to the $font array for a nested module form.
	 *

	 * @access private
	 * @param object $module The module to add for.
	 * @param array $form The nested form.
	 * @param string $setting The nested form setting key.
	 * @return void
	 */
	static private function add_fonts_for_nested_module_form( $module, $form, $setting ) {
		$fields = BACheetahModel::get_settings_form_fields( $form );

		foreach ( $fields as $name => $field ) {
			if ( 'font' == $field['type'] && isset( $module->settings->$setting ) ) {
				foreach ( $module->settings->$setting as $key => $val ) {
					if ( isset( $val->$name ) ) {
						self::add_font( (array) $val->$name );
					} elseif ( $name == $key && ! empty( $val ) ) {
						self::add_font( (array) $val );
					}
				}
			}
		}
	}

	/**
	 * Enqueue the stylesheet for fonts.
	 *

	 * @return void
	 */
	static public function enqueue_styles() {
		return false;
	}

	/**

	 */
	static public function enqueue_google_fonts() {
		/**
		 * Google fonts domain
		 * @see ba_cheetah_google_fonts_domain
		 */
		$google_fonts_domain = apply_filters( 'ba_cheetah_google_fonts_domain', '//fonts.googleapis.com/' );
		$google_url          = $google_fonts_domain . 'css?family=';

		/**
		 * Allow users to control what fonts are enqueued by modules.
		 * Returning array() will disable all enqueues.
		 * @see ba_cheetah_google_fonts_pre_enqueue
		 */
		if ( count( apply_filters( 'ba_cheetah_google_fonts_pre_enqueue', self::$fonts ) ) > 0 ) {

			foreach ( self::$fonts as $family => $weights ) {
				$google_url .= $family . ':' . implode( ',', $weights ) . '|';
			}

			$google_url = substr( $google_url, 0, -1 );

			wp_enqueue_style( 'ba-cheetah-google-fonts-' . md5( $google_url ), $google_url, array() );

			self::$fonts = array();
		}
	}

	/**
	 * Adds data to the $fonts array for a font to be rendered.
	 *

	 * @param  array $font an array with the font family and weight to add.
	 * @return void
	 */
	static public function add_font( $font ) {

		$recent_fonts_db = get_option( 'ba_cheetah_recent_fonts', array() );
		$recent_fonts    = array();

		if ( is_array( $font ) && isset( $font['family'] ) && isset( $font['weight'] ) && 'Default' != $font['family'] ) {

			$system_fonts = apply_filters( 'ba_cheetah_font_families_system', BACheetahFontFamilies::$system );

			// check if is a Google Font
			if ( ! array_key_exists( $font['family'], $system_fonts ) ) {

				// check if font family is already added
				if ( array_key_exists( $font['family'], self::$fonts ) ) {

					// check if the weight is already added
					if ( ! in_array( $font['weight'], self::$fonts[ $font['family'] ] ) ) {
						self::$fonts[ $font['family'] ][] = $font['weight'];
					}
				} else {
					// adds a new font and weight
					self::$fonts[ $font['family'] ] = array( $font['weight'] );

				}
			}
			if ( ! isset( $recent_fonts_db[ $font['family'] ] ) ) {
				$recent_fonts[ $font['family'] ] = $font['weight'];
			}
		}

		$recent = array_merge( $recent_fonts, $recent_fonts_db );

		if ( ( isset( $_GET['ba_cheetah'] ) || isset( $_GET['ba_builder'] ) ) && ! empty( $recent ) && serialize( $recent ) !== serialize( $recent_fonts_db ) ) {
			update_option( 'ba_cheetah_recent_fonts', array_slice( $recent, -11 ) );
		}

	}

	/**
	 * Combines all enqueued google font HTTP calls into one URL.
	 *

	 * @return void
	 */
	static public function combine_google_fonts() {
		global $wp_styles;

		// Check for any enqueued `fonts.googleapis.com` from BB theme or plugin
		if ( isset( $wp_styles->queue ) ) {

			/**
			 * @see ba_cheetah_combine_google_fonts_domain
			 */
			$google_fonts_domain   = apply_filters( 'ba_cheetah_combine_google_fonts_domain', '//fonts.googleapis.com/css' );
			$enqueued_google_fonts = array();
			$families              = array();
			$subsets               = array();
			$font_args             = array();

			// Collect all enqueued google fonts
			foreach ( $wp_styles->queue as $key => $handle ) {

				if ( ! isset( $wp_styles->registered[ $handle ] ) || strpos( $handle, 'ba-cheetah-google-fonts-' ) === false ) {
					continue;
				}

				$style_src = $wp_styles->registered[ $handle ]->src;

				if ( strpos( $style_src, 'fonts.googleapis.com/css' ) !== false ) {
					$url = wp_parse_url( $style_src );

					if ( is_string( $url['query'] ) ) {
						parse_str( $url['query'], $parsed_url );

						if ( isset( $parsed_url['family'] ) ) {

							// Collect all subsets
							if ( isset( $parsed_url['subset'] ) ) {
								$subsets[] = urlencode( trim( $parsed_url['subset'] ) );
							}

							$font_families = explode( '|', $parsed_url['family'] );
							foreach ( $font_families as $parsed_font ) {

								$get_font = explode( ':', $parsed_font );

								// Extract the font data
								if ( isset( $get_font[0] ) && ! empty( $get_font[0] ) ) {
									$family  = $get_font[0];
									$weights = isset( $get_font[1] ) && ! empty( $get_font[1] ) ? explode( ',', $get_font[1] ) : array();

									// Combine weights if family has been enqueued
									if ( isset( $enqueued_google_fonts[ $family ] ) && $weights != $enqueued_google_fonts[ $family ]['weights'] ) {
										$combined_weights                            = array_merge( $weights, $enqueued_google_fonts[ $family ]['weights'] );
										$enqueued_google_fonts[ $family ]['weights'] = array_unique( $combined_weights );
									} else {
										$enqueued_google_fonts[ $family ] = array(
											'handle'  => $handle,
											'family'  => $family,
											'weights' => $weights,
										);

									}
									// Remove enqueued google font style, so we would only have one HTTP request.
									wp_dequeue_style( $handle );
								}
							}
						}
					}
				}
			}

			// Start combining all enqueued google fonts
			if ( count( $enqueued_google_fonts ) > 0 ) {

				foreach ( $enqueued_google_fonts as $family => $data ) {
					// Collect all family and weights
					if ( ! empty( $data['weights'] ) ) {
						$families[] = $family . ':' . implode( ',', $data['weights'] );
					} else {
						$families[] = $family;
					}
				}

				if ( ! empty( $families ) ) {
					$font_args['family'] = implode( '|', $families );

					if ( ! empty( $subsets ) ) {
						$font_args['subset'] = implode( ',', $subsets );
					}

					/**
					 * Array of extra args passed to google fonts.
					 * @see ba_cheetah_google_font_args
					 */
					$font_args = apply_filters( 'ba_cheetah_google_font_args', $font_args );

					$src = add_query_arg( $font_args, $google_fonts_domain );

					// Enqueue google fonts into one URL request
					wp_enqueue_style(
						'ba-cheetah-google-fonts-' . md5( $src ),
						$src,
						array()
					);
					self::$enqueued_google_fonts_done = true;
					// Clears data
					$enqueued_google_fonts = array();
				}
			}
		}
	}

	/**
	 * Preconnect to fonts.gstatic.com to speed up google fonts.

	 */
	static public function resource_hints( $urls, $relation_type ) {
		if ( true == self::$enqueued_google_fonts_done && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}
		return $urls;
	}

	/**
	 * Find font fallback, used by BACheetahCSS

	 */
	static public function get_font_fallback( $font_family ) {
		$fallback = 'sans-serif';
		$default  = apply_filters( 'ba_cheetah_font_families_default', BACheetahFontFamilies::$default );
		$system   = apply_filters( 'ba_cheetah_font_families_system', BACheetahFontFamilies::$system );
		$google   = apply_filters( 'ba_cheetah_font_families_google', BACheetahFontFamilies::google() );
		foreach ( $default as $font => $data ) {
			if ( $font_family == $font && isset( $data['fallback'] ) ) {
				$fallback = $data['fallback'];
			}
		}
		foreach ( $system as $font => $data ) {
			if ( $font_family == $font && isset( $data['fallback'] ) ) {
				$fallback = $data['fallback'];
			}
		}
		foreach ( $google as $font => $data ) {
			if ( $font_family == $font ) {
				$fallback = BACheetahFontFamilies::get_google_fallback( $font );
			}
		}
		return $fallback;
	}

}

BACheetahFonts::init();

/**
 * Font info class for system and Google fonts.
 *
 * @class BACheetahFontFamilies

 */
final class BACheetahFontFamilies {

	/**
	 * Cache for google fonts
	 */
	static private $_google_json  = array();
	static private $_google_fonts = false;
	static private $_google_run   = 0;

	/**
	 * Array with a list of default font weights.
	 * @var array
	 */
	static public $default = array(
		'Default' => array(
			'default',
			'100',
			'200',
			'300',
			'400',
			'500',
			'600',
			'700',
			'800',
			'900',
		),
	);

	/**
	 * Array with a list of system fonts.
	 * @var array
	 */
	static public $system = array(
		'Helvetica' => array(
			'fallback' => 'Verdana, Arial, sans-serif',
			'weights'  => array(
				'300',
				'400',
				'700',
			),
		),
		'Verdana'   => array(
			'fallback' => 'Helvetica, Arial, sans-serif',
			'weights'  => array(
				'300',
				'400',
				'700',
			),
		),
		'Arial'     => array(
			'fallback' => 'Helvetica, Verdana, sans-serif',
			'weights'  => array(
				'300',
				'400',
				'700',
			),
		),
		'Times'     => array(
			'fallback' => 'Georgia, serif',
			'weights'  => array(
				'300',
				'400',
				'700',
			),
		),
		'Georgia'   => array(
			'fallback' => 'Times, serif',
			'weights'  => array(
				'300',
				'400',
				'700',
			),
		),
		'Courier'   => array(
			'fallback' => 'monospace',
			'weights'  => array(
				'300',
				'400',
				'700',
			),
		),
	);

	/**
	 * Parse fonts.json to get all possible Google fonts.

	 * @return array
	 */
	static function google() {

		if ( false !== self::$_google_fonts ) {
			return self::$_google_fonts;
		}

		$fonts = array();
		$json  = self::_get_json();

		foreach ( $json as $k => $font ) {

			$name = key( $font );

			foreach ( $font[ $name ]['variants'] as $key => $variant ) {
				if ( 'italic' !== $variant ) {
					if ( stristr( $variant, 'italic' ) ) {
						$font[ $name ]['variants'][ $key ] = str_replace( 'talic', '', $variant );
					}
				}
				if ( 'regular' == $variant ) {
					$font[ $name ]['variants'][ $key ] = '400';
				}
			}
			$fonts[ $name ] = $font[ $name ]['variants'];
		}
		// only cache after 1st run to save rams.
		if ( self::$_google_run > 0 ) {
			self::$_google_fonts = $fonts;
		}
		self::$_google_run++;
		return $fonts;
	}

	/**

	 */
	static private function _get_json() {
		if ( ! empty( self::$_google_json ) ) {
			$json = self::$_google_json;
		} else {
			$json               = (array) json_decode( file_get_contents( trailingslashit( BA_CHEETAH_DIR ) . 'json/fonts.json' ), true );
			self::$_google_json = $json;
		}
		/**
		 * Filter raw google json data
		 * @see ba_cheetah_get_google_json
		 */
		return apply_filters( 'ba_cheetah_get_google_json', $json );
	}


	/**

	 */
	static public function get_google_fallback( $font ) {
		$json = self::_get_json();
		foreach ( $json as $k => $google ) {
			$name = key( $google );
			if ( $name == $font ) {
				return $google[ $name ]['fallback'];
			}
		}
		return false;
	}
}
