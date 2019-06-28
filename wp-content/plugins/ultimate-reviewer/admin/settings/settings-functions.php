<?php

/**
 * Save default settings upon theme activation
 *
 */
if ( ! function_exists( 'gpur_save_default_options' ) ) {
	function gpur_save_default_options() {
		$framework = gpur_framework_data();
		if ( '' == get_option( $framework['option_name'] ) ) {
			$settings = gpur_global_settings( $framework['theme_slug'] );
			if ( $settings ) {
				foreach( $settings as $setting ) {
					$default = isset( $setting['default'] ) ? $setting['default'] : '';
					$defaults[$setting['id']] = $default;
				}
			}				
			update_option( $framework['option_name'], $defaults );
		}
	}
}
add_action( 'after_setup_theme', 'gpur_save_default_options' );

/**
 * Load options function
 *
 */
if ( ! function_exists( 'gpur_option' ) ) {
	function gpur_option( $id, $id2 = false ) {
		$framework = gpur_framework_data();
		$options = get_option( $framework['option_name'] );
		if ( $id2 ) {
			if ( isset( $options[$id][$id2] ) ) {
				return $options[$id][$id2];
			}
		} else {
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}
	}
}

/**
 * Enqueue styles and scripts
 *
 */
 if ( ! function_exists( 'ghostpool_framework_enqueue_framework_scripts' ) ) {
	function ghostpool_framework_enqueue_framework_scripts() {
	
		$framework = gpur_framework_data();
		
		// Global scripts
		wp_register_style( 'ghostpool-framework-settings', $framework['directory_uri'] . 'settings/assets/framework-settings.css', array(), $framework['the_version'] );
		wp_register_script( 'ghostpool-framework-global', $framework['directory_uri'] . 'settings/assets/framework-global.js', array( 'jquery' ), $framework['the_version'], false );		
			
		// Metaboxes scripts
		wp_register_style( 'ghostpool-framework-settings', $framework['directory_uri'] . 'settings/assets/framework-settings.css', array(), $framework['the_version'] );	
		wp_register_script( 'ghostpool-framework-metaboxes', $framework['directory_uri'] . 'settings/assets/framework-metaboxes.js', array( 'jquery' ), $framework['the_version'], false );		
		wp_register_script( 'ghostpool-framework-dependencies', $framework['directory_uri'] . 'settings/assets/framework-dependencies.js', array( 'jquery' ), $framework['the_version'], false );	
		if ( is_ssl() ) { $scheme = 'https'; } else { $scheme = 'http'; }
		wp_localize_script( 'ghostpool-framework-metaboxes', 'ghostpool_framework', array(
			'ajaxurl' => admin_url( 'admin-ajax.php', $scheme ),
		) );
			
		// Field styling	
		wp_register_style( 'jquery-ui-theme-smoothness', sprintf( '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.css', wp_scripts()->registered['jquery-ui-core']->ver ) );

		// Select2 scripts
		wp_register_style( 'select2css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' );
		wp_register_script( 'select2js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array( 'jquery' ) );

		// Ace editor field scripts
		wp_register_script( 'ace-editor', $framework['directory_uri'] . 'settings/assets/ace.js', array(), $framework['the_version'] );
		wp_register_script( 'ace-editor-mode-css', $framework['directory_uri'] . 'settings/assets/mode-css.js', array( 'ace-editor' ), $framework['the_version'] );
		wp_register_script( 'ace-editor-mode-javascript', $framework['directory_uri'] . 'settings/assets/mode-javascript.js', array( 'ace-editor' ), $framework['the_version'] );
		wp_register_script( 'ghostpool-ace-editor-field', $framework['directory_uri'] . 'settings/assets/ace-editor.js', array( 'jquery', 'ace-editor' ), $framework['the_version'] );

		// Color field scripts
		wp_register_script( 'wp-color-picker-alpha', $framework['directory_uri'] . 'settings/assets/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), $framework['the_version'], false );
		wp_register_script( 'ghostpool-color-field', $framework['directory_uri'] . 'settings/assets/color.js', array( 'jquery', 'wp-color-picker' ), $framework['the_version'], false );

		// Gallery field scripts
		wp_register_script( 'ghostpool-gallery-field', $framework['directory_uri'] . 'settings/assets/gallery.js', array( 'jquery' ), $framework['the_version'], false );

		// Icon field scripts
		if ( file_exists( plugin_dir_url( 'js_composer' ) . 'assets/lib/bower/font-awesome/css/font-awesome.min.css' ) ) {
			$font_url = plugin_dir_url( 'js_composer' ) . 'assets/lib/bower/font-awesome/css/font-awesome.min.css';
		} else {
			$font_url = $framework['font_uri'] . 'font-awesome/css/font-awesome.min.css';
		}
		wp_enqueue_style( 'font-awesome', $font_url, array(), $framework['the_version'], 'all' );
		wp_register_script( 'ghostpool-icon-field', $framework['directory_uri'] . 'settings/assets/icon.js', array( 'jquery' ), $framework['the_version'], false );

		// Image select field scripts
		wp_register_script( 'ghostpool-image-select-field', $framework['directory_uri'] . 'settings/assets/image-select.js', array( 'jquery' ), $framework['the_version'], false );

		// Media field scripts
		wp_register_script( 'ghostpool-media-field', $framework['directory_uri'] . 'settings/assets/media.js', array( 'jquery' ), $framework['the_version'], false );

		// Multi text field scripts
		wp_register_script( 'ghostpool-multi-text-field', $framework['directory_uri'] . 'settings/assets/multi-text.js', array( 'jquery' ), $framework['the_version'], false );

		// Slider field scripts
		wp_register_script( 'ghostpool-slider-field', $framework['directory_uri'] . 'settings/assets/slider.js', array( 'jquery', 'jquery-ui-slider' ), $framework['the_version'], false );

		// Spinner field scripts
		wp_register_script( 'ghostpool-spinner-field', $framework['directory_uri'] . 'settings/assets/spinner.js', array( 'jquery', 'jquery-ui-spinner' ), $framework['the_version'], false );
			
		// Typography field scripts
		wp_register_script( 'ghostpool-typography-field', $framework['directory_uri'] . 'settings/assets/typography.js', array( 'jquery' ), $framework['the_version'], false );
	
	}
}	
add_action( 'admin_enqueue_scripts', 'ghostpool_framework_enqueue_framework_scripts' );

/**
 * Load default setting fields
 *
 */
if ( ! function_exists( 'ghostpool_default_setting_fields' ) ) {	
	function ghostpool_default_setting_fields( $setting = array() ) {
					
		$defaults = array(
			'id' => '',
			'title' => '',
			'section',
			'desc' => '',
			'type' => '',
			'format' => '',
			'units' => 'px',
			'styling' => '',
			'options' => array(),
			'data' => '',
			'select2' => false,
			'default' => '',
			'step' => 1,
			'min' => 0,
			'max' => 10,
			'validate' => '',
			'class' => 'gp-setting',
			'important' => '',
			'media_query' => '',
			'rtl' => false,
			'output' => '',
		);
		
		$output = wp_parse_args( $setting, $defaults );	
		
		return $output;
				
	}
}
							
/**
 * Load field types
 *
 */
if ( ! function_exists( 'ghostpool_settings_field_types' ) ) {	
	function ghostpool_settings_field_types( $name, $value, $settings ) {
	
		$framework = gpur_framework_data();
					
		if ( $settings && is_array( $settings ) ) {
			extract( $settings );
		}
		
		// Clean IDs
		if ( false === strpos( $id, '_customize-input-' ) ) {
			$id = 'gp-' . str_replace( '_', '-', $id );
		}
		
		// Get value
		if ( 'checkbox' !== $type ) {
			if ( $value ) {
				$value = $value;
			} elseif ( isset( $default ) && '' !== $default ) {
				$value = $default;
			} elseif ( ( isset( $options ) && ! empty( $options ) ) OR ( isset( $data ) && ! empty( $data ) ) ) {
				$value = array();
			} else {
				$value = '';
			}
		}
		
		// Data variable
		if ( isset( $data ) && '' !== $data ) {

			if ( 'post_types' === $data ) {

				$post_types = get_post_types( 
					array(
						'public'              => true,
						'exclude_from_search' => false,
					), 
					'names', 
					'and'
				);
			
				foreach ( $post_types as $post_type ) {
					if ( 'attachment' !== $post_type && 'gpur-template' !== $post_type ) {
						$options[ $post_type ] = $post_type;
					}
				}
		
			} elseif ( 'categories' === $data ) {
	
				$options[] = esc_html__( 'All categories', 'gpur' );
	
				$cats = get_categories();
				if ( ! empty ( $cats ) ) {
					foreach ( $cats as $cat ) {
						$options[ $cat->term_id ] = $cat->name;
					}
				}

			} elseif ( 'roles' === $data ) {

				$data = array();
				global $wp_roles;
				$roles = $wp_roles->get_names();
				foreach ( $roles as $role ) {
					$role = str_replace( ' ', '_', $role );
					$role = strtolower( $role );
					$options[ $role ] = $role;
				}

			} elseif ( 'sidebars' === $data ) {
		 
				global $wp_registered_sidebars;
				
				if ( 'default' === $default ) {
					$options['default'] = esc_html__( 'Default', 'gpur' );		
				}
				
				foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
					$options[ $sidebar_id ] = $sidebar['name'];
				}

			} elseif ( 'pages' === $data ) {
		
				$options['default'] = '';		
                $pages = get_pages();
                if ( ! empty ( $pages ) ) {
                	foreach ( $pages as $page ) {
                    	$options[ $page->ID ] = $page->post_title;
                    }
                }

			}
	
		}

		if ( 'ace_editor' === $type ) {
					
			include( $framework['directory_path'] . 'settings/fields/standard-ace-editor.php' );
	
		} elseif ( 'background' === $type ) {
					
			include( $framework['directory_path'] . 'settings/fields/standard-background.php' );

		} elseif ( 'border' === $type ) {
					
			include( $framework['directory_path'] . 'settings/fields/standard-border.php' );

		} elseif ( 'checkbox' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-checkbox.php' );
	
		} elseif ( 'color' === $type ) {	
			
			include( $framework['directory_path'] . 'settings/fields/standard-color.php' );	

		} elseif ( 'color_gradient' === $type ) {	
			
			include( $framework['directory_path'] . 'settings/fields/standard-color-gradient.php' );	
		
		} elseif ( 'color_rgba' === $type ) {	
			
			include( $framework['directory_path'] . 'settings/fields/standard-color-rgba.php' );	

		} elseif ( 'dimensions' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-dimensions.php' );	

		} elseif ( 'export' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-export.php' );

		} elseif ( 'import' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-import.php' );
			
		} elseif ( 'gallery' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-gallery.php' );
	
		} elseif ( 'image_select' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-image-select.php' );
			
		} elseif ( 'link_color' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-link-color.php' );
	
		} elseif ( 'media' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-media.php' );
	
		} elseif ( 'multi_text' === $type ) {
		
			include( $framework['directory_path'] . 'settings/fields/standard-multi-text.php' );
	
		} elseif ( 'radio' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-radio.php' );				

		} elseif ( 'select' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-select.php' );				
	
		} elseif ( 'slider' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-slider.php' );	
		
		} elseif ( 'spacing' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-spacing.php' );	
						
		} elseif ( 'spinner' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-spinner.php' );	
			
		} elseif ( 'styling' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-styling.php' );	
			
		} elseif ( 'text' === $type ) {
	
			include( $framework['directory_path'] . 'settings/fields/standard-text.php' );	
			
		} elseif ( 'textarea' === $type ) {
			
			include( $framework['directory_path'] . 'settings/fields/standard-textarea.php' );	
		
		} elseif ( 'typography' === $type ) {

			include( $framework['directory_path'] . 'settings/fields/standard-typography.php' );

		}	
		
		if ( isset( $desc ) && 'section-header' !== $type ) {
			echo '<p class="description">' . wp_kses_post( $desc ) . '</p>';
		}

	}	
}

/**
 * Backup fonts
 *
 */
if ( ! function_exists( 'ghostpool_backup_fonts_array' ) ) {
	function ghostpool_backup_fonts_array() {
		
		//delete_transient( 'ghostpool_backup_fonts_array' );
	
		$output = get_transient( 'ghostpool_backup_fonts_array' );
	
		if ( false === $output ) {

			$backup_fonts = array(
				"Arial, Helvetica, sans-serif",
				"'Arial Black', Gadget, sans-serif",
				"'Bookman Old Style', serif",
				"'Comic Sans MS', cursive",                             
				"Courier, monospace",                                  
				"Garamond, serif",                                      
				"Georgia, serif",                         
				"Impact, Charcoal, sans-serif",      
				"'Lucida Console', Monaco, monospace",    
				"'Lucida Sans Unicode', 'Lucida Grande', sans-serif", 
				"'MS Sans Serif', Geneva, sans-serif",                  
				"'MS Serif', 'New York', sans-serif",                   
				"'Palatino Linotype', 'Book Antiqua', Palatino, serif", 
				"Tahoma,Geneva, sans-serif",                            
				"'Times New Roman', Times,serif",                      
				"'Trebuchet MS', Helvetica, sans-serif" ,               
				"Verdana, Geneva, sans-serif",                       
			);
	
			// Create key of same name as value
			foreach( $backup_fonts as $backup_font ) {
				$output[$backup_font] = $backup_font;
			}		

			set_transient( 'ghostpool_backup_fonts_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}
        
/**
 * Google fonts
 *
 */
if ( ! function_exists( 'ghostpool_google_fonts_array' ) ) {
	function ghostpool_google_fonts_array() {	
			
		//delete_transient( 'ghostpool_google_fonts_array' );

		$output = get_transient( 'ghostpool_google_fonts_array' );
		
		if ( false === $output ) {	

			$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAVYztkPt5uXNl8LuJ2nFJW0CZTKdbmaSM' ), array( 'sslverify' => false ) );
		
			if ( ! is_wp_error( $result ) && $result['response']['code'] == 200 ) {
			
				$fonts = json_decode( $result['body'] );
				$fonts = $fonts->items;
				if ( $fonts ) { 
					foreach( $fonts as $font ) {
						$google_fonts_array[$font->family] = $font->family;
					}
				}
			
				if ( is_array( ghostpool_backup_fonts_array() ) ) {
					$output = array_merge( ghostpool_backup_fonts_array(), $google_fonts_array );	
				} else {			
					$output = $google_fonts_array;
				}
				
			} else {
		
				$output = ghostpool_backup_fonts_array();
			}
		
			set_transient( 'ghostpool_google_fonts_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}		

/**
 * Google font variants
 *
 */
if ( ! function_exists( 'ghostpool_google_font_variants_array' ) ) {
	function ghostpool_google_font_variants_array( $font_family = '' ) {	
			
		//delete_transient( 'ghostpool_google_font_variants_array' );

		$output = get_transient( 'ghostpool_google_font_variants_array' );
		
		if ( false === $output ) {	

			$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAVYztkPt5uXNl8LuJ2nFJW0CZTKdbmaSM' ), array( 'sslverify' => false ) );
		
			if ( ! is_wp_error( $result ) && $result['response']['code'] == 200 ) {
			
				$fonts = json_decode( $result['body'] );
				$fonts = $fonts->items;

				foreach( $fonts as $font ) {
					if ( $font->family === $font_family ) {
						foreach( $font->variants as $font_variant ) {
							if ( 'regular' === $font_variant ) {
								$font_variant_value = '400';
								$font_variant_name = '400';
							} elseif ( 'italic' === $font_variant ) {
								$font_variant_value = '400italic';
								$font_variant_name = '400 Italic';	
							} else {
								$font_variant_value = $font_variant;
								$font_variant_name = ucwords( preg_replace('/(\d+)/', '${1} ', $font_variant ) );
							}
							$output[$font_variant_name] = $font_variant_value;
						}
					}
				}										
				
			}
					
			set_transient( 'ghostpool_google_font_variants_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}		

/**
 * Google font subsets
 *
 */
if ( ! function_exists( 'ghostpool_google_font_subsets_array' ) ) {
	function ghostpool_google_font_subsets_array( $font_family = '' ) {	
			
		//delete_transient( 'ghostpool_google_font_subsets_array' );

		$output = get_transient( 'ghostpool_google_font_subsets_array' );
		
		if ( false === $output ) {	

			$result = @wp_remote_get( apply_filters( 'ghostpool_google_fonts_api_url', 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAVYztkPt5uXNl8LuJ2nFJW0CZTKdbmaSM' ), array( 'sslverify' => false ) );
		
			if ( ! is_wp_error( $result ) && $result['response']['code'] == 200 ) {
			
				$fonts = json_decode( $result['body'] );
				$fonts = $fonts->items;

				foreach( $fonts as $font ) {
					if ( $font->family === $font_family ) {
						foreach( $font->subsets as $font_subset ) {
							$output[$font_subset] = ucwords( $font_subset );
						}
					}
				}										
				
			}
					
			set_transient( 'ghostpool_google_font_subsets_array', $output, 7 * DAY_IN_SECONDS );
			
		}	
		
		return $output;
		
	}	
}		

/**
 * Ajax typography values
 *
 */
if ( ! function_exists( 'ghostpool_typography_ajax' ) ) {
	function ghostpool_typography_ajax() {		

		$font_family = $_GET['fontFamily'];

		if ( ghostpool_google_font_variants_array( $font_family ) ) {
			//delete_transient( 'ghostpool_google_font_variants_array' );		
			$current_weight = $_GET['fontWeight'];
			foreach( ghostpool_google_font_variants_array( $font_family ) as $title => $key ) {
				if ( $key === $current_weight ) {
					$checked = ' selected="selected"';
				} else {
					$checked = '';
				}
				$weights[] = '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
			}	
		}		
		
		if ( ghostpool_google_font_subsets_array( $font_family ) ) {
			//delete_transient( 'ghostpool_google_font_subsets_array' );		
			$current_subset = $_GET['fontSubset'];		
			foreach( ghostpool_google_font_subsets_array( $font_family ) as $key => $title ) {
				if ( $key === $current_subset ) {
					$checked = ' selected="selected"';
				} else {
					$checked = '';
				}
				$subsets[] = '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
			}
		}
	
		echo json_encode( array( 'subsets' => $subsets, 'weights' => $weights ) );

		die();

	}
}
add_action( 'wp_ajax_ghostpool_typography_ajax', 'ghostpool_typography_ajax' );
add_action( 'wp_ajax_nopriv_ghostpool_typography_ajax', 'ghostpool_typography_ajax' );

/**
 * Icon selection
 *
 */
if ( ! function_exists( 'ghostpool_icons' ) ) {
	function ghostpool_icons() {

		return array( '', 'fa-500px', 'fa-adjust', 'fa-adn', 'fa-align-center', 'fa-align-justify', 'fa-align-left', 'fa-align-right', 'fa-amazon', 'fa-ambulance', 'fa-american-sign-language-interpreting', 'fa-anchor', 'fa-android', 'fa-angellist', 'fa-angle-double-down', 'fa-angle-double-left', 'fa-angle-double-right', 'fa-angle-double-up', 'fa-angle-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-apple', 'fa-archive', 'fa-area-chart', 'fa-arrow-circle-down', 'fa-arrow-circle-left', 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-left', 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-up', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-arrows', 'fa-arrows-alt', 'fa-arrows-h', 'fa-arrows-v', 'fa-asl-interpreting', 'fa-assistive-listening-systems', 'fa-asterisk', 'fa-at', 'fa-audio-description', 'fa-automobile', 'fa-backward', 'fa-balance-scale', 'fa-ban', 'fa-bank', 'fa-bar-chart', 'fa-bar-chart-o', 'fa-barcode', 'fa-bars', 'fa-battery-0', 'fa-battery-1', 'fa-battery-2', 'fa-battery-3', 'fa-battery-4', 'fa-battery-empty', 'fa-battery-full', 'fa-battery-half', 'fa-battery-quarter', 'fa-battery-three-quarters', 'fa-bed', 'fa-beer', 'fa-behance', 'fa-behance-square', 'fa-bell', 'fa-bell-o', 'fa-bell-slash', 'fa-bell-slash-o', 'fa-bicycle', 'fa-binoculars', 'fa-birthday-cake', 'fa-bitbucket', 'fa-bitbucket-square', 'fa-bitcoin', 'fa-black-tie', 'fa-blind', 'fa-bluetooth', 'fa-bluetooth-b', 'fa-bold', 'fa-bolt', 'fa-bomb', 'fa-book', 'fa-bookmark', 'fa-bookmark-o', 'fa-braille', 'fa-briefcase', 'fa-btc', 'fa-bug', 'fa-building', 'fa-building-o', 'fa-bullhorn', 'fa-bullseye', 'fa-bus', 'fa-buysellads', 'fa-cab', 'fa-calculator', 'fa-calendar', 'fa-calendar-check-o', 'fa-calendar-minus-o', 'fa-calendar-o', 'fa-calendar-plus-o', 'fa-calendar-times-o', 'fa-camera', 'fa-camera-retro', 'fa-car', 'fa-caret-down', 'fa-caret-left', 'fa-caret-right', 'fa-caret-square-o-down', 'fa-caret-square-o-left', 'fa-caret-square-o-right', 'fa-caret-square-o-up', 'fa-caret-up', 'fa-cart-arrow-down', 'fa-cart-plus', 'fa-cc', 'fa-cc-amex', 'fa-cc-diners-club', 'fa-cc-discover', 'fa-cc-jcb', 'fa-cc-mastercard', 'fa-cc-paypal', 'fa-cc-stripe', 'fa-cc-visa', 'fa-certificate', 'fa-chain', 'fa-chain-broken', 'fa-check', 'fa-check-circle', 'fa-check-circle-o', 'fa-check-square', 'fa-check-square-o', 'fa-chevron-circle-down', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-down', 'fa-chevron-left', 'fa-chevron-right', 'fa-chevron-up', 'fa-child', 'fa-chrome', 'fa-circle', 'fa-circle-o', 'fa-circle-o-notch', 'fa-circle-thin', 'fa-clipboard', 'fa-clock-o', 'fa-clone', 'fa-close', 'fa-cloud', 'fa-cloud-download', 'fa-cloud-upload', 'fa-cny', 'fa-code', 'fa-code-fork', 'fa-codepen', 'fa-codiepie', 'fa-coffee', 'fa-cog', 'fa-cogs', 'fa-columns', 'fa-comment', 'fa-comment-o', 'fa-commenting', 'fa-commenting-o', 'fa-comments', 'fa-comments-o', 'fa-compass', 'fa-compress', 'fa-connectdevelop', 'fa-contao', 'fa-copy', 'fa-copyright', 'fa-creative-commons', 'fa-credit-card', 'fa-credit-card-alt', 'fa-crop', 'fa-crosshairs', 'fa-css3', 'fa-cube', 'fa-cubes', 'fa-cut', 'fa-cutlery', 'fa-dashboard', 'fa-dashcube', 'fa-database', 'fa-deaf', 'fa-deafness', 'fa-dedent', 'fa-delicious', 'fa-desktop', 'fa-deviantart', 'fa-diamond', 'fa-digg', 'fa-dollar', 'fa-dot-circle-o', 'fa-download', 'fa-dribbble', 'fa-dropbox', 'fa-drupal', 'fa-edge', 'fa-edit', 'fa-eject', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-empire', 'fa-envelope', 'fa-envelope-o', 'fa-envelope-square', 'fa-envira', 'fa-eraser', 'fa-eur', 'fa-euro', 'fa-exchange', 'fa-exclamation', 'fa-exclamation-circle', 'fa-exclamation-triangle', 'fa-expand', 'fa-expeditedssl', 'fa-external-link', 'fa-external-link-square', 'fa-eye', 'fa-eye-slash', 'fa-eyedropper', 'fa-fa', 'fa-facebook', 'fa-facebook-f', 'fa-facebook-official', 'fa-facebook-square', 'fa-fast-backward', 'fa-fast-forward', 'fa-fax', 'fa-feed', 'fa-female', 'fa-fighter-jet', 'fa-file', 'fa-file-archive-o', 'fa-file-audio-o', 'fa-file-code-o', 'fa-file-excel-o', 'fa-file-image-o', 'fa-file-movie-o', 'fa-file-o', 'fa-file-pdf-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-powerpoint-o', 'fa-file-sound-o', 'fa-file-text', 'fa-file-text-o', 'fa-file-video-o', 'fa-file-word-o', 'fa-file-zip-o', 'fa-files-o', 'fa-film', 'fa-filter', 'fa-fire', 'fa-fire-extinguisher', 'fa-firefox', 'fa-first-order', 'fa-flag', 'fa-flag-checkered', 'fa-flag-o', 'fa-flash', 'fa-flask', 'fa-flickr', 'fa-floppy-o', 'fa-folder', 'fa-folder-o', 'fa-folder-open', 'fa-folder-open-o', 'fa-font', 'fa-font-awesome', 'fa-fonticons', 'fa-fort-awesome', 'fa-forumbee', 'fa-forward', 'fa-foursquare', 'fa-frown-o', 'fa-futbol-o', 'fa-gamepad', 'fa-gavel', 'fa-gbp', 'fa-ge', 'fa-gear', 'fa-gears', 'fa-genderless', 'fa-get-pocket', 'fa-gg', 'fa-gg-circle', 'fa-gift', 'fa-git', 'fa-git-square', 'fa-github', 'fa-github-alt', 'fa-github-square', 'fa-gitlab', 'fa-gittip', 'fa-glass', 'fa-glide', 'fa-glide-g', 'fa-globe', 'fa-google', 'fa-google-plus', 'fa-google-plus-circle', 'fa-google-plus-official', 'fa-google-plus-square', 'fa-google-wallet', 'fa-graduation-cap', 'fa-gratipay', 'fa-group', 'fa-h-square', 'fa-hacker-news', 'fa-hand-grab-o', 'fa-hand-lizard-o', 'fa-hand-o-down', 'fa-hand-o-left', 'fa-hand-o-right', 'fa-hand-o-up', 'fa-hand-paper-o', 'fa-hand-peace-o', 'fa-hand-pointer-o', 'fa-hand-rock-o', 'fa-hand-scissors-o', 'fa-hand-spock-o', 'fa-hand-stop-o', 'fa-hard-of-hearing', 'fa-hashtag', 'fa-hdd-o', 'fa-header', 'fa-headphones', 'fa-heart', 'fa-heart-o', 'fa-heartbeat', 'fa-history', 'fa-home', 'fa-hospital-o', 'fa-hotel', 'fa-hourglass', 'fa-hourglass-1', 'fa-hourglass-2', 'fa-hourglass-3', 'fa-hourglass-end', 'fa-hourglass-half', 'fa-hourglass-o', 'fa-hourglass-start', 'fa-houzz', 'fa-html5', 'fa-i-cursor', 'fa-ils', 'fa-image', 'fa-inbox', 'fa-indent', 'fa-industry', 'fa-info', 'fa-info-circle', 'fa-inr', 'fa-instagram', 'fa-institution', 'fa-internet-explorer', 'fa-intersex', 'fa-ioxhost', 'fa-italic', 'fa-joomla', 'fa-jpy', 'fa-jsfiddle', 'fa-key', 'fa-keyboard-o', 'fa-krw', 'fa-language', 'fa-laptop', 'fa-lastfm', 'fa-lastfm-square', 'fa-leaf', 'fa-leanpub', 'fa-legal', 'fa-lemon-o', 'fa-level-down', 'fa-level-up', 'fa-life-bouy', 'fa-life-buoy', 'fa-life-ring', 'fa-life-saver', 'fa-lightbulb-o', 'fa-line-chart', 'fa-link', 'fa-linkedin', 'fa-linkedin-square', 'fa-linux', 'fa-list', 'fa-list-alt', 'fa-list-ol', 'fa-list-ul', 'fa-location-arrow', 'fa-lock', 'fa-long-arrow-down', 'fa-long-arrow-left', 'fa-long-arrow-right', 'fa-long-arrow-up', 'fa-low-vision', 'fa-magic', 'fa-magnet', 'fa-mail-forward', 'fa-mail-reply', 'fa-mail-reply-all', 'fa-male', 'fa-map', 'fa-map-marker', 'fa-map-o', 'fa-map-pin', 'fa-map-signs', 'fa-mars', 'fa-mars-double', 'fa-mars-stroke', 'fa-mars-stroke-h', 'fa-mars-stroke-v', 'fa-maxcdn', 'fa-meanpath', 'fa-medium', 'fa-medkit', 'fa-meh-o', 'fa-mercury', 'fa-microphone', 'fa-microphone-slash', 'fa-minus', 'fa-minus-circle', 'fa-minus-square', 'fa-minus-square-o', 'fa-mixcloud', 'fa-mobile', 'fa-mobile-phone', 'fa-modx', 'fa-money', 'fa-moon-o', 'fa-mortar-board', 'fa-motorcycle', 'fa-mouse-pointer', 'fa-music', 'fa-navicon', 'fa-neuter', 'fa-newspaper-o', 'fa-object-group', 'fa-object-ungroup', 'fa-odnoklassniki', 'fa-odnoklassniki-square', 'fa-opencart', 'fa-openid', 'fa-opera', 'fa-optin-monster', 'fa-outdent', 'fa-pagelines', 'fa-paint-brush', 'fa-paper-plane', 'fa-paper-plane-o', 'fa-paperclip', 'fa-paragraph', 'fa-paste', 'fa-pause', 'fa-pause-circle', 'fa-pause-circle-o', 'fa-paw', 'fa-paypal', 'fa-pencil', 'fa-pencil-square', 'fa-pencil-square-o', 'fa-percent', 'fa-phone', 'fa-phone-square', 'fa-photo', 'fa-picture-o', 'fa-pie-chart', 'fa-pied-piper', 'fa-pied-piper-alt', 'fa-pied-piper-pp', 'fa-pinterest', 'fa-pinterest-p', 'fa-pinterest-square', 'fa-plane', 'fa-play', 'fa-play-circle', 'fa-play-circle-o', 'fa-plug', 'fa-plus', 'fa-plus-circle', 'fa-plus-square', 'fa-plus-square-o', 'fa-power-off', 'fa-print', 'fa-product-hunt', 'fa-puzzle-piece', 'fa-qq', 'fa-qrcode', 'fa-question', 'fa-question-circle', 'fa-question-circle-o', 'fa-quote-left', 'fa-quote-right', 'fa-ra', 'fa-random', 'fa-rebel', 'fa-recycle', 'fa-reddit', 'fa-reddit-alien', 'fa-reddit-square', 'fa-refresh', 'fa-registered', 'fa-remove', 'fa-renren', 'fa-reorder', 'fa-repeat', 'fa-reply', 'fa-reply-all', 'fa-resistance', 'fa-retweet', 'fa-rmb', 'fa-road', 'fa-rocket', 'fa-rotate-left', 'fa-rotate-right', 'fa-rouble', 'fa-rss', 'fa-rss-square', 'fa-rub', 'fa-ruble', 'fa-rupee', 'fa-safari', 'fa-save', 'fa-scissors', 'fa-scribd', 'fa-search', 'fa-search-minus', 'fa-search-plus', 'fa-sellsy', 'fa-send', 'fa-send-o', 'fa-server', 'fa-share', 'fa-share-alt', 'fa-share-alt-square', 'fa-share-square', 'fa-share-square-o', 'fa-shekel', 'fa-sheqel', 'fa-shield', 'fa-ship', 'fa-shirtsinbulk', 'fa-shopping-bag', 'fa-shopping-basket', 'fa-shopping-cart', 'fa-sign-in', 'fa-sign-language', 'fa-sign-out', 'fa-signal', 'fa-signing', 'fa-simplybuilt', 'fa-sitemap', 'fa-skyatlas', 'fa-skype', 'fa-slack', 'fa-sliders', 'fa-slideshare', 'fa-smile-o', 'fa-snapchat', 'fa-snapchat-ghost', 'fa-snapchat-square', 'fa-soccer-ball-o', 'fa-sort', 'fa-sort-alpha-asc', 'fa-sort-alpha-desc', 'fa-sort-amount-asc', 'fa-sort-amount-desc', 'fa-sort-asc', 'fa-sort-desc', 'fa-sort-down', 'fa-sort-numeric-asc', 'fa-sort-numeric-desc', 'fa-sort-up', 'fa-soundcloud', 'fa-space-shuttle', 'fa-spinner', 'fa-spoon', 'fa-spotify', 'fa-square', 'fa-square-o', 'fa-stack-exchange', 'fa-stack-overflow', 'fa-star', 'fa-star-half', 'fa-star-half-empty', 'fa-star-half-full', 'fa-star-half-o', 'fa-star-o', 'fa-steam', 'fa-steam-square', 'fa-step-backward', 'fa-step-forward', 'fa-stethoscope', 'fa-sticky-note', 'fa-sticky-note-o', 'fa-stop', 'fa-stop-circle', 'fa-stop-circle-o', 'fa-street-view', 'fa-strikethrough', 'fa-stumbleupon', 'fa-stumbleupon-circle', 'fa-subscript', 'fa-subway', 'fa-suitcase', 'fa-sun-o', 'fa-superscript', 'fa-support', 'fa-table', 'fa-tablet', 'fa-tachometer', 'fa-tag', 'fa-tags', 'fa-tasks', 'fa-taxi', 'fa-television', 'fa-tencent-weibo', 'fa-terminal', 'fa-text-height', 'fa-text-width', 'fa-th', 'fa-th-large', 'fa-th-list', 'fa-themeisle', 'fa-thumb-tack', 'fa-thumbs-down', 'fa-thumbs-o-down', 'fa-thumbs-o-up', 'fa-thumbs-up', 'fa-ticket', 'fa-times', 'fa-times-circle', 'fa-times-circle-o', 'fa-tint', 'fa-toggle-down', 'fa-toggle-left', 'fa-toggle-off', 'fa-toggle-on', 'fa-toggle-right', 'fa-toggle-up', 'fa-trademark', 'fa-train', 'fa-transgender', 'fa-transgender-alt', 'fa-trash', 'fa-trash-o', 'fa-tree', 'fa-trello', 'fa-tripadvisor', 'fa-trophy', 'fa-truck', 'fa-try', 'fa-tty', 'fa-tumblr', 'fa-tumblr-square', 'fa-turkish-lira', 'fa-tv', 'fa-twitch', 'fa-twitter', 'fa-twitter-square', 'fa-umbrella', 'fa-underline', 'fa-undo', 'fa-universal-access', 'fa-university', 'fa-unlink', 'fa-unlock', 'fa-unlock-alt', 'fa-unsorted', 'fa-upload', 'fa-usb', 'fa-usd', 'fa-user', 'fa-user-md', 'fa-user-plus', 'fa-user-secret', 'fa-user-times', 'fa-users', 'fa-venus', 'fa-venus-double', 'fa-venus-mars', 'fa-viacoin', 'fa-viadeo', 'fa-viadeo-square', 'fa-video-camera', 'fa-vimeo', 'fa-vimeo-square', 'fa-vine', 'fa-vk', 'fa-volume-control-phone', 'fa-volume-down', 'fa-volume-off', 'fa-volume-up', 'fa-warning', 'fa-wechat', 'fa-weibo', 'fa-weixin', 'fa-whatsapp', 'fa-wheelchair', 'fa-wheelchair-alt', 'fa-wifi', 'fa-wikipedia-w', 'fa-windows', 'fa-won', 'fa-wordpress', 'fa-wpbeginner', 'fa-wpforms', 'fa-wrench', 'fa-xing', 'fa-xing-square', 'fa-y-combinator', 'fa-y-combinator-square', 'fa-yahoo', 'fa-yc', 'fa-yc-square', 'fa-yelp', 'fa-yen', 'fa-yoast', 'fa-youtube', 'fa-youtube-play', 'fa-youtube-square' );		
	}
}