<?php if ( ! class_exists( 'GPUR_Add_User_Ratings' ) ) {
	class GPUR_Add_User_Ratings {

		public function __construct() {}

		public static function gpur_add_user_ratings( $post_id, $meta, $args ) {
		
			$defaults = array(
				'title' => esc_html__( 'Add Rating', 'gpur' ),	
				'permissions' => 'all-users',
				'permission_roles' => '',		
				'criteria' => '',
				'min_rating' => 0,
				'max_rating' => 5,
				'step' => 1,
				'fractions' => 1,
				'format' => 'format-column',
				'style' => 'style-stars',	
				'criterion_boxes' => '',	
				'position' => 'position-left',
				'text_position' => 'position-text-bottom',
				'show_avg_user_rating_text' => 1,
				'show_your_user_rating_text' => 1,
				'show_maximum_rating_text' => 1,
				'show_user_votes_text' => 1,
				'show_submit_button' => '',
				'criterion_boxes_padding' => '',
				'criterion_boxes_bg_color_1' => '',
				'criterion_boxes_bg_color_2' => '',
				'criterion_boxes_border_width' => '',
				'criterion_boxes_border_color' => '',
				'criterion_boxes_extra_css' => '',
				'title_size' => '',
				'title_color' => '',
				'title_extra_css' => '',
				'criteria_title_size' => '',
				'criteria_title_color' => '',
				'criteria_title_extra_css' => '',
				'avg_user_rating_text_size' => '',
				'avg_user_rating_text_color' => '',
				'avg_user_rating_text_extra_css' => '',
				'your_user_rating_text_size' => '',
				'your_user_rating_text_color' => '',
				'your_user_rating_text_extra_css' => '',
				'user_votes_text_size' => '',
				'user_votes_text_color' => '',
				'user_votes_text_extra_css' => '',
				'submit_button_text_color' => '',
				'submit_button_text_hover_color' => '',
				'submit_button_border_color' => '',
				'submit_button_border_hover_color' => '',
				'submit_button_bg_color' => '',
				'submit_button_bg_hover_color' => '',
				'submit_button_css' => '',
				'rating_image' => '',
				'empty_icon' => 'fa fa-star',
				'empty_icon_color' => '',
				'filled_icon' => 'fa fa-star',
				'filled_icon_color' => '',
				'icon_width' => '',
				'icon_height' => '',
				'avg_user_rating_label' => esc_html__( 'Average User Rating:', 'gpur' ),
				'your_user_rating_label' => esc_html__( 'Your Rating:', 'gpur' ),
				'singular_vote_label' => esc_html__( 'vote', 'gpur' ),
				'plural_vote_label' => esc_html__( 'votes', 'gpur' ),
				'submit_button_label' => esc_html__( 'Submit Rating', 'gpur' ),
				'logged_in_to_vote_label' => esc_html__( 'You must be logged in to vote.', 'gpur' ),
				'single_success_message' => esc_html__( 'Thanks for submitting your rating!', 'gpur' ),
				'single_error_message' => esc_html__( 'Please give a rating.', 'gpur' ),
				'multi_success_message' => esc_html__( 'Thanks for submitting your ratings!', 'gpur' ),
				'multi_error_message' => esc_html__( 'Please give a rating for each criterion.', 'gpur' ),
				'css' => '',
			);		
			
			$args = wp_parse_args( $args, $defaults );
			
			extract( $args );

			// Unique ID
			$unique_id = 'gpur_' . uniqid();
			
			// Container tag
			if ( 'comment' === $meta ) {
				$container_tag = 'span';			
			} else {
				$container_tag = 'div';
			}
			
			// Get correct meta keys
			$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
			$user_votes_meta_key = gpur_get_user_votes( $post_id );
			$ind_user_rating_meta_key = gpur_get_ind_user_rating( $post_id );

			// Load style function
			$style = gpur_rating_styles( $style, $empty_icon, $filled_icon );
		
			// Load criteria function
			$criteria = gpur_criteria( $criteria );
		
			// Show different messages depending on single or multi rating
			if ( 'yes' === $criteria['multi'] ) {
				$success_message = $multi_success_message;
				$error_message = $multi_error_message;
			} else {
				$success_message = $single_success_message;
				$error_message = $single_error_message;
			}
	
			// Display maximum rating
			$display_max_rating = '';
			if ( 1 == $show_maximum_rating_text ) {
				$display_max_rating = '<' . esc_attr( $container_tag ) . ' class="gpur-max-rating">' . $max_rating . '</' . esc_attr( $container_tag ) . '>';
			}
		
			// Get average user rating value
			if ( get_post_meta( $post_id, $avg_user_rating_meta_key, true ) ) {
				$avg_user_rating_value = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
			} else {
				$avg_user_rating_value = 0;
			}

			// Display average user rating
			$display_avg_user_rating = '';
			if ( 1 == $show_avg_user_rating_text && 'post' === $meta ) {
				$avg_user_rating_label = $avg_user_rating_label != '' ? '<' . esc_attr( $container_tag ) . ' class="gpur-avg-user-rating-label">' . $avg_user_rating_label . '</' . esc_attr( $container_tag ) . '>' : '';
				$display_avg_user_rating = $avg_user_rating_label . '<' . esc_attr( $container_tag ) . ' class="gpur-avg-user-rating"><' . esc_attr( $container_tag ) . ' class="gpur-rating-value">' . $avg_user_rating_value . '</' . esc_attr( $container_tag ) . '>' . $display_max_rating . '</' . esc_attr( $container_tag ) . '>';
			}

			// Display user votes
			$display_user_votes = '';
			if ( 1 == $show_user_votes_text && 'post' === $meta ) {
				$user_votes = (int) get_post_meta( $post_id, $user_votes_meta_key, true );
				if ( '' === $user_votes ) {
					$user_votes =  '0 ' . $plural_vote_label;
				} elseif ( 1 == $user_votes ) {
					$user_votes = $user_votes . ' ' . $singular_vote_label;
				} else {
					$user_votes = $user_votes . ' ' . $plural_vote_label;
				}	
				$display_user_votes = '<' . esc_attr( $container_tag ) . ' class="gpur-user-votes">' . $user_votes . '</' . esc_attr( $container_tag ) . '>';
			}	
			
			// Get your user rating value
			if ( 'comment' === $meta ) {
				$your_user_rating_value = 0;
				$is_rated = 'no';
			} elseif ( get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) {
				$your_user_rating_value = get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true );
				$is_rated = 'yes';
			} elseif ( isset( $_COOKIE['gpur_user_rating_' . $post_id] ) && ! is_user_logged_in() ) {
				$your_user_rating_value = $_COOKIE['gpur_user_rating_' . $post_id];
				$is_rated = 'yes';
			} else {
				$your_user_rating_value = 0;
				$is_rated = 'no';
			}
			
			// Convert rating values to an array				
			if ( is_array( $your_user_rating_value ) ) {
				$your_user_rating_value = is_array( $your_user_rating_value[0] ) ? array_values( $your_user_rating_value[0] ) : $your_user_rating_value[0];
			} elseif ( ! is_array( $your_user_rating_value ) && false !== strpos( $your_user_rating_value, ',' ) ) {
				$your_user_rating_value = explode( ',', $your_user_rating_value );
			} else {
				$your_user_rating_value = array( $your_user_rating_value );
			}
			
			// Loop through multi ratings
			for( $i = 0; $i < $criteria['count']; $i++ ) {
		
				// Set all criteria values to zero
				if ( ! isset ( $your_user_rating_value[$i] ) ) {
					$your_user_rating_value[$i] = 0;
				}
				
				// Display your user rating
				$display_your_user_rating = '';
				if ( 1 == $show_your_user_rating_text ) {
					$display_your_user_rating_label = $your_user_rating_label != '' ? '<' . esc_attr( $container_tag ) . ' class="gpur-your-user-rating-label">' . $your_user_rating_label . '</' . esc_attr( $container_tag ) . '>' : '';
					$display_your_user_rating = $display_your_user_rating_label . '<' . esc_attr( $container_tag ) . ' class="gpur-your-user-rating"><' . esc_attr( $container_tag ) . ' class="gpur-rating-value">' . $your_user_rating_value[$i] . '</' . esc_attr( $container_tag ) . '>' . $display_max_rating . '</' . esc_attr( $container_tag ) . '>';
				}
	
				// Output rating data
				$display_rating[$i] = '';
				if ( 'yes' === $criteria['multi'] && $display_your_user_rating ) {
					$display_rating[$i] = '<' . esc_attr( $container_tag ) . ' class="gpur-rating-data">' . $display_your_user_rating . '</' . esc_attr( $container_tag ) . '>';
				} elseif ( 'no' === $criteria['multi'] && ( $display_avg_user_rating OR $display_user_votes OR $display_your_user_rating ) ) {
					if ( $display_avg_user_rating && $display_your_user_rating && 'position-text-bottom' === $text_position ) {
						$divider = '<' . esc_attr( $container_tag ) . ' class="gpur-clear"></' . esc_attr( $container_tag ) . '>';
					} else {
						$divider = '';
					}				
					$display_rating[$i] = '<' . esc_attr( $container_tag ) . ' class="gpur-rating-data">' . $display_avg_user_rating . $display_user_votes . $divider . $display_your_user_rating . '</' . esc_attr( $container_tag ) . '>';
				}
			
			}
		
			// Inline CSS
			$inline_css = '';

			// Rating image
			if ( $rating_image ) { 
				$rating_image_data = wp_get_attachment_image_src( $rating_image );
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-image .gpur-symbol-empty, #' . esc_attr( $unique_id ) . '.gpur-style-image .gpur-symbol-filled {background-image:url(' . esc_attr( $rating_image_data[0] ) . '); width: ' . esc_attr( $rating_image_data[1] ) . 'px; height: ' . esc_attr( $rating_image_data[2] / 2 ) . 'px;
				}';
			} 				

			// Rating icons
			if ( $empty_icon_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .rating-symbol-background {color: ' . esc_attr( $empty_icon_color ) . ';}#' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol-empty, #' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol-empty, #' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol-empty {background-color: ' . esc_attr( $empty_icon_color ) . ';}';
			}
			if ( $filled_icon_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .rating-symbol-foreground {color: ' . esc_attr( $filled_icon_color ) . ';}#' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol-filled, #' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol-filled, #' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol-filled {background-color: ' . esc_attr( $filled_icon_color ) . ';}';
			}
			if ( $icon_width ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .rating-symbol {font-size: ' . ghostpool_add_units( $icon_width ) . ';}';
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol, #' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol {width: ' . ghostpool_add_units( $icon_width ) . ';}';
			}			
			if ( $icon_height ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-bars .gpur-symbol, #' . esc_attr( $unique_id ) . '.gpur-style-circles .gpur-symbol, #' . esc_attr( $unique_id ) . '.gpur-style-squares .gpur-symbol {height: ' . ghostpool_add_units( $icon_height ) . ';}';
			}

			// Criterion boxes
			if ( $criterion_boxes_padding ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {padding: ' . ghostpool_add_units( $criterion_boxes_padding ) . ';}';
			}	
			if ( $criterion_boxes_bg_color_1 ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion:nth-child(odd) {background-color: ' . esc_attr( $criterion_boxes_bg_color_1 ) . ';}';
			}	
			if ( $criterion_boxes_bg_color_2 ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion:nth-child(even) {background-color: ' . esc_attr( $criterion_boxes_bg_color_2 ) . ';}';
			}	
			if ( $criterion_boxes_border_width ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {border-top-width: ' . ghostpool_add_units( $criterion_boxes_border_width ) . ';}';
			}	
			if ( $criterion_boxes_border_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {border-color: ' . esc_attr( $criterion_boxes_border_color ) . ';}';
			}		
			if ( $criterion_boxes_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-criterion-boxes .gpur-criterion {' . esc_attr( $criterion_boxes_extra_css ) . '}';
			}				
			
			// Title
			if ( $title_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {font-size: ' . ghostpool_add_units( $title_size ) . ';}';
			} 
			if ( $title_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {color: ' . esc_attr( $title_color ) . ';}';
			} 
			if ( isset( $title_extra_css ) && $title_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {' . esc_attr( $title_extra_css ) . '}';
			} 

			// Criteria Title
			if ( $criteria_title_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-criterion-title {font-size: ' . ghostpool_add_units( $criteria_title_size ) . ';}';
			} 
			if ( $criteria_title_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-criterion-title {color: ' . esc_attr( $criteria_title_color ) . ';}';
			} 
			if ( $criteria_title_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-criterion-title {' . esc_attr( $criteria_title_extra_css ) . '}';
			} 

			// Average user rating text
			if ( $avg_user_rating_text_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label, #' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating {font-size: ' . ghostpool_add_units( $avg_user_rating_text_size ) . ';}';
			}
			if ( $avg_user_rating_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label, #' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating {color: ' . esc_attr( $avg_user_rating_text_color ) . ';}';
			}
			if ( $avg_user_rating_text_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating-label, #' . esc_attr( $unique_id ) . ' .gpur-avg-user-rating {' . esc_attr( $avg_user_rating_text_extra_css ) . '}';
			}

			// Your user rating text
			if ( $your_user_rating_text_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-your-user-rating-label, #' . esc_attr( $unique_id ) . ' .gpur-your-user-rating {font-size: ' . ghostpool_add_units( $your_user_rating_text_size ) . ';}';
			}
			if ( $your_user_rating_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-your-user-rating-label, #' . esc_attr( $unique_id ) . ' .gpur-your-user-rating {color: ' . esc_attr( $your_user_rating_text_color ) . ';}';
			}
			if ( $your_user_rating_text_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-your-user-rating-label, #' . esc_attr( $unique_id ) . ' .gpur-your-user-rating {' . esc_attr( $your_user_rating_text_extra_css ) . '}';
			}

			// User votes text
			if ( $user_votes_text_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-user-votes {font-size: ' . ghostpool_add_units( $user_votes_text_size ) . ';}';
			}
			if ( $user_votes_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-user-votes {color: ' . esc_attr( $user_votes_text_color ) . ';}';
			}
			if ( $user_votes_text_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-user-votes {' . esc_attr( $user_votes_text_extra_css ) . '}';
			}

			// Submit button
			if ( $submit_button_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-submit-rating {color: ' . esc_attr( $submit_button_text_color ) . ';}';
			}			
			if ( $submit_button_text_hover_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-submit-rating:hover {color: ' . esc_attr( $submit_button_text_hover_color ) . ';}';
			}
			if ( $submit_button_border_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-submit-rating {border-color: ' . esc_attr( $submit_button_border_color ) . ';}';
			}
			if ( $submit_button_border_hover_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-submit-rating:hover {border-color: ' . esc_attr( $submit_button_border_hover_color ) . ';}';
			}
			if ( $submit_button_bg_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-submit-rating {background-color: ' . esc_attr( $submit_button_bg_color ) . ';}';
			}
			if ( $submit_button_bg_hover_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-submit-rating:hover {background-color: ' . esc_attr( $submit_button_bg_hover_color ) . ';}';
			}
			if ( $submit_button_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-submit-rating {' . esc_attr( $submit_button_css ) . ';}';
			}

			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );

			// Classes
			$css_classes = array(
				'gpur-element-wrapper',
				'gpur-add-user-ratings-wrapper',
				'gpur-' . $style['class'],
				( 1 == $criterion_boxes ) ? 'gpur-criterion-boxes' : '',
				'gpur-' . $format,
				'gpur-' . $position,
				'gpur-' . $text_position,
				'gpur-in-' . $meta,
				$style['linear_class'],
				$criteria['class'],
				( 1 == $show_submit_button OR 'yes' === $criteria['multi'] ) ? 'gpur-has-submit-button' : 'gpur-no-submit-button',
			);
			$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
			$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $args );
				
			ob_start();
			
			echo '<' . esc_attr( $container_tag ) . ' id="' . esc_attr( $unique_id ) . '" class="' . esc_attr( $css_classes ) . '">';
			
				if ( $title ) {
					if ( 'comment' === $meta ) {
						echo '<label for="rating">' . esc_attr( $title ) . '</label>';
					} else {
						echo '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
					}
				}
			
				if ( 'allowed' === gpur_permissions( $permissions, $permission_roles ) ) {
		
					// Set counter to 0
					$i = 0;
		
					if ( 'yes' === $criteria['multi'] ) {
			
						foreach( $criteria['fields'] as $criterion ) {
					
							include( plugin_dir_path( __FILE__ ) . 'templates/add-user-ratings-template.php' );
							
						}

					} else {
			
						include( plugin_dir_path( __FILE__ ) . 'templates/add-user-ratings-template.php' );
				
					}
			
					if ( 'yes' === $criteria['multi'] && 'post' === $meta && ( $display_avg_user_rating OR $display_user_votes ) ) {
						echo '<' . esc_attr( $container_tag ) . ' class="gpur-rating-data gpur-average-data">' . wp_kses_post( $display_avg_user_rating . $display_user_votes ) . '</' . esc_attr( $container_tag ) . '>';
					}
										
					if ( 'post' === $meta && 'no' === $is_rated && ( 'yes' === $criteria['multi'] OR ( 1 == $show_submit_button && 'no' === $criteria['multi'] ) ) ) {
						echo '<' . esc_attr( $container_tag ) . ' class="gpur-clear"></' . esc_attr( $container_tag ) . '>
						<' . esc_attr( $container_tag ) . ' class="gpur-submit-rating">' . esc_attr( $submit_button_label ) . '</' . esc_attr( $container_tag ) . '>
						<' . esc_attr( $container_tag ) . ' class="gpur-success">' . esc_attr( $success_message ) . '</' . esc_attr( $container_tag ) . '>
						<' . esc_attr( $container_tag ) . ' class="gpur-error">' . esc_attr( $error_message ) . '</' . esc_attr( $container_tag ) . '>';
					}	
					
				} else {
			
					echo esc_attr( $logged_in_to_vote_label );
			
				}
								
			echo '</' . esc_attr( $container_tag ) . '>';
    			
			$output = ob_get_contents();
			ob_end_clean();
			return $output;

		}

	}	
} 
new GPUR_Add_User_Ratings();