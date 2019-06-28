<?php if ( ! class_exists( 'GPUR_Show_Rating' ) ) {
	class GPUR_Show_Rating {

		public function __construct() {}

		public static function gpur_show_rating( $post_id, $meta, $args ) {

			$defaults = array( 
				'title' => '',
				'data' => 'site-rating',
				'value' => '',
				'criteria' => '',
				'max_rating' => 5,
				'step' => 1,
				'rating_ranges' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
				'rich_snippets' => '',
				'format' => 'format-rows',
				'style' => 'style-plain-singular',	
				'criterion_boxes' => '',
				'position' => 'position-left',
				'text_position' => 'position-text-bottom',
				'show_avg_user_rating_text' => 1,
				'show_your_user_rating_text' => 1,
				'show_maximum_rating_text' => '',
				'show_user_votes_text' => 1,
				'show_ranges_text' => 1,
				'show_zero_rating' => 1,
				'rating_image' => '',
				'empty_icon' => 'fa fa-star',
				'empty_icon_color' => '',
				'filled_icon' => 'fa fa-star',
				'filled_icon_color' => '',
				'icon_width' => '',
				'icon_height' => '',
				'rating_width' => '',
				'rating_height' => '',
				'rating_text_size' => '',
				'rating_text_color' => '',	
				'rating_background_color' => '',			
				'rating_border_width' => '',	
				'rating_border_color' => '',
				'rating_container_extra_css' => '',	
				'rating_text_extra_css' => '',	
				'gauge_width' => '',
				'gauge_filled_color_1' => '',
				'gauge_filled_color_2' => '',
				'gauge_empty_color' => '',
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
				'maximum_rating_text_size' => '',
				'maximum_rating_text_color' => '',
				'maximum_rating_text_extra_css' => '',
				'user_votes_text_size' => '',
				'user_votes_text_color' => '',
				'user_votes_text_extra_css' => '',
				'ranges_text_size' => '',
				'ranges_text_color' => '',
				'ranges_text_extra_css' => '',
				'avg_user_rating_label' => esc_html__( 'Average User Rating:', 'gpur' ),
				'your_user_rating_label' => esc_html__( 'Site Rating:', 'gpur' ),
				'singular_vote_label' => esc_html__( 'vote', 'gpur' ),
				'plural_vote_label' => esc_html__( 'votes', 'gpur' ),		
				'css' => ''
			);
			
			$args = wp_parse_args( $args, $defaults );
			
			extract( $args );

			// Unique ID
			if ( 'comment-rating' === $data ) {	
				$comment_post_id = isset( $_GET['post_id'] ) ? $_GET['post_id'] : get_the_ID();
				$unique_id = 'gpur_' . $comment_post_id;
			} else {
				$unique_id = 'gpur_' . uniqid();
			}
			
			// Get correct meta keys
			$site_rating_meta_key = gpur_get_site_rating( $post_id );
			$avg_user_rating_meta_key = gpur_get_avg_user_rating( $post_id );
			$user_votes_meta_key = gpur_get_user_votes( $post_id );
			$user_sum_meta_key = gpur_get_user_sum( $post_id );
			$summary_meta_key = gpur_get_summary( $post_id );
			$excerpt_meta_key = gpur_get_excerpt( $post_id );
						
			// Load style function
			$style = gpur_rating_styles( $style, $empty_icon, $filled_icon );
		
			// Load criteria function
			$criteria = gpur_criteria( $criteria );

			// Rating data 
			$avg_user_rating_value = 0;
			if ( 'site-rating' === $data ) {
				$rating_value = get_post_meta( $post_id, $site_rating_meta_key, true );
			} elseif ( 'user-rating' === $data ) {
				$rating_value = get_post_meta( $post_id, $avg_user_rating_meta_key, true );
				$avg_user_rating_value = $rating_value;
			} elseif ( 'comment-rating' === $data ) {
				if ( 'yes' === $criteria['multi'] ) {
					$rating_value = get_comment_meta( $post_id, 'gpur_rating', true );		
					$rating_value = array_map( 'intval', explode(',', $rating_value ) );
				} else {
					$rating_value = get_comment_meta( $post_id, 'gpur_avg_rating', true );
				}
			} elseif ( 'custom' === $data ) {
				if ( strpos( $value, ',' ) ) {
					$rating_value = array_map( 'intval', explode( ',', $value ) );
				} else {
					$rating_value = $value;
				}
			}
			if ( ! is_array( $rating_value ) ) {
				$rating_value = array( $rating_value );
			}
  				
			// End here if item has no rating value and zero ratings disabled
			if ( 1 != $show_zero_rating && empty( $rating_value ) && 'no' === $criteria['multi'] ) {
				return;
			}
	
			// Display maximum rating
			$display_max_rating = '';
			if ( 1 == $show_maximum_rating_text ) {
				$display_max_rating = '<div class="gpur-max-rating">' . $max_rating . '</div>';
			}

			// Display your user rating label
			$display_your_user_rating_label = '';
			if ( 1 == $show_your_user_rating_text && 'gpur-linear' === $style['linear_class'] ) {
				$your_user_rating_label = $your_user_rating_label != '' ? '<span class="gpur-your-user-rating-label">' . $your_user_rating_label . '</span>' : '';
				$display_your_user_rating_label = $your_user_rating_label;
			}
				
			// Display user votes
			$display_user_votes = '';
			if ( 1 == $show_user_votes_text && 'user-rating' === $data ) {
				$user_votes = (int) get_post_meta( $post_id, $user_votes_meta_key, true );
				if ( '' === $user_votes ) {
					$user_votes =  '0 ' . $plural_vote_label;
				} elseif ( 1 == $user_votes ) {
					$user_votes = $user_votes . ' ' . $singular_vote_label;
				} else {
					$user_votes = $user_votes . ' ' . $plural_vote_label;
				}	
				$display_user_votes = '<div class="gpur-user-votes">' . $user_votes . '</div>';
			}

			// Ranges text
			if ( 1 == $show_ranges_text && $rating_ranges ) {
				$ranges = str_replace( '-', ',', $rating_ranges );
				$ranges = str_replace( ':', ',', $ranges );
				$ranges_array = explode( ',',  $ranges );
				$ranges_chunks = array_chunk( $ranges_array, 3 );
			}
				
			// Loop through multi ratings
			$each_rating_value = 0;
			for( $i = 0; $i < $criteria['count']; $i++ ) {		

				// Multi rating data		
				if ( 'yes' === $criteria['multi'] && $criteria['fields'] && ( 'site-rating' === $data OR 'custom' === $data ) ) {
					$criterion_slug = sanitize_title_with_dashes( $criteria['fields'][$i] );
					$weight = isset( $criteria['weights'][$i] ) ? $criteria['weights'][$i] : 1;
					if ( get_post_meta( $post_id, 'gpur_criterion_' . $criterion_slug, true ) ) {
						$rating = get_post_meta( $post_id, 'gpur_criterion_' . $criterion_slug, true );
					} elseif ( isset( $rating_value[$i] ) && '' !== $rating_value[$i] )  {
						$rating = $rating_value[$i];
					} else {
						$rating = 0;
					}
					$each_rating_value += $rating * $weight;
					$rating_value[$i] = $rating;
				}
			
				// Show rating if has no value
				if ( 1 != $show_zero_rating && empty( $rating_value[$i] ) && 'yes' === $criteria['multi'] ) {
					return;
				} elseif ( 1 == $show_zero_rating && ( empty( $rating_value[$i] ) OR 0 === $rating_value[$i] ) ) {
					$rating_value[$i] = 0;
				}
			
				// Rating gauge circle degrees class
				$degrees_class[$i] = '';	
				if ( 'style-gauge-circles-singular' === $style['class'] ) {

					// Value
					$degrees[$i] = 0;
					if ( '' !== $rating_value[$i] && $max_rating ) {
						$degrees[$i] = ( 360 * ( $rating_value[$i] / $max_rating ) );
					}
	
					// Class
					if ( $degrees[$i] < 180 ) {
						$degrees_class[$i] = ' gpur-small-rating';
					} elseif ( 360 === $degrees[$i] ) {
						$degrees_class[$i] = ' gpur-large-rating gpur-full-gauge-rating';	
					} else {
						$degrees_class[$i] = ' gpur-large-rating';
					}

				}			

				// Ranges text
				$range_text[$i] = '';
				if ( 1 == $show_ranges_text && is_array( $ranges_chunks ) ) {
					foreach( $ranges_chunks as $ranges_chunk ) {
						if ( $rating_value[$i] >= $ranges_chunk[0] && $rating_value[$i] <= $ranges_chunk[1] ) {
							$range_text[$i] = $ranges_chunk[2];
						}
					}
				}

				// Display your user rating
				$display_your_user_rating = '';
				if ( ( 1 == $show_your_user_rating_text && 'gpur-linear' === $style['linear_class'] ) OR ( 'gpur-non-linear' === $style['linear_class'] ) && 'user-rating' !== $data ) {
					$your_user_rating_label = $your_user_rating_label != '' ? '<span class="gpur-your-user-rating-label">' . $your_user_rating_label . '</span>' : '';
					$display_your_user_rating = $display_your_user_rating_label . '<div class="gpur-your-user-rating"><div class="gpur-rating-value">' . $rating_value[$i] . '</div>' . $display_max_rating . '</div>';
				}
			
				// Display average user rating
				$display_avg_user_rating = '';
				if ( ( 1 == $show_avg_user_rating_text OR 1 == $show_avg_user_rating_text ) && 'user-rating' === $data && 'gpur-linear' === $style['linear_class'] ) {
					$display_avg_user_rating = '<div class="gpur-avg-user-rating-label">' . $avg_user_rating_label . '</div><div class="gpur-avg-user-rating"><div class="gpur-rating-value">' . $rating_value[$i] . '</div>' . $display_max_rating . '</div>';
				} elseif ( 'user-rating' === $data ) {
					$display_avg_user_rating = '<div class="gpur-avg-user-rating"><div class="gpur-rating-value">' . $rating_value[$i] . '</div>' . $display_max_rating . '</div>';
				}
			
				// Display ranges text
				$display_ranges_text = '';
				if ( 1 == $show_ranges_text ) {		
					$display_ranges_text = '<div class="gpur-ranges-text">' . esc_attr( $range_text[$i] ) . '</div>';
				}
								
				// Output rating data
				$display_rating[$i] = '';
				if ( 'yes' === $criteria['multi'] && ( ( $display_your_user_rating OR $display_ranges_text ) && 'user-rating' !== $data ) ) {
					$display_rating[$i] = '<div class="gpur-rating-data">' . $display_your_user_rating . $display_ranges_text . '</div>';
				} elseif ( $display_avg_user_rating OR $display_user_votes OR $display_your_user_rating OR $display_ranges_text ) {
					$display_rating[$i] = '<div class="gpur-rating-data">' . $display_avg_user_rating . $display_user_votes . $display_your_user_rating . $display_ranges_text . '</div>';
				}

			}
			
			// Get an average of all multi ratings 
			if ( $each_rating_value > 0 && $criteria['count'] > 0 && 1 != get_post_meta( $post_id, 'gpur_manually_add_overall_rating', true ) ) {
				$updated_avg_rating_value = $each_rating_value / $criteria['count'];
				$updated_avg_rating_value = round( ( $updated_avg_rating_value / $step ), 1 ) * $step;		
				$old_avg_rating_value = get_post_meta( $post_id, $site_rating_meta_key, true );
				update_post_meta( $post_id, $site_rating_meta_key, $updated_avg_rating_value, $old_avg_rating_value );
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
			
			// Rating container
			if ( $rating_width ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-outer {width: ' . ghostpool_add_units( $rating_width ) . ';}';
			}	
			if ( $rating_height ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-outer {height: ' . ghostpool_add_units( $rating_height ) . ';}';
			}
			if ( $rating_text_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-value {font-size: ' . ghostpool_add_units( $rating_text_size ) . ';}';
			} 
			if ( $rating_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-value {color: ' . esc_attr( $rating_text_color ) . ';}';
			} 
			if ( $rating_background_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-inner {background-color: ' . esc_attr( $rating_background_color ) . ';}';
			}			
			if ( $rating_border_width ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-inner {border-width: ' . ghostpool_add_units( $rating_border_width ) . ';}';
			}			
			if ( $rating_border_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-inner {border-color: ' . esc_attr( $rating_border_color ) . ';}';
			}
			if ( $rating_container_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-outer {' . esc_attr( $rating_container_extra_css ) . '}';
			}
			if ( $rating_text_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-rating-outer .gpur-rating-value {' . esc_attr( $rating_text_extra_css ) . '}';
			}
			
			// Gauge
			if ( 'style-gauge-circles-singular' === $style['class'] ) {
			
				if ( $gauge_width ) {
					$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-gauge-circles-singular .gpur-rating-inner {top: ' . ghostpool_add_units( $gauge_width ) . '; bottom: ' . ghostpool_add_units( $gauge_width ) . '; left: ' . ghostpool_add_units( $gauge_width ) . '; right: ' . ghostpool_add_units( $gauge_width ) . ';}';
				} 
				if ( $gauge_filled_color_1 OR $gauge_filled_color_2 ) {
					$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-small-rating .gpur-gauge-spinner {background: ' . esc_attr( $gauge_filled_color_1 ) . '; background:-webkit-linear-gradient(' . esc_attr( $gauge_filled_color_1 ) . ' 0%,' . esc_attr( $gauge_filled_color_2 ) . ' 70%); background:linear-gradient(' . esc_attr( $gauge_filled_color_1 ) . ' 0%,' . esc_attr( $gauge_filled_color_2 ) . ' 70%);}#' . esc_attr( $unique_id ) . ' .gpur-large-rating .gpur-gauge-spinner {background: ' . esc_attr( $gauge_filled_color_1 ) . ';}#' . esc_attr( $unique_id ) . ' .gpur-gauge-filler {background: ' . esc_attr( $gauge_filled_color_1 ) . '; background:-webkit-linear-gradient(' . esc_attr( $gauge_filled_color_2 ) . ' 0%,' . esc_attr( $gauge_filled_color_1 ) . ' 70%); background:linear-gradient(' . esc_attr( $gauge_filled_color_2 ) . ' 0%,' . esc_attr( $gauge_filled_color_1 ) . ' 70%);}#' . esc_attr( $unique_id ) . '.gpur-style-gauge-circles-singular .gpur-rating-outer.gpur-full-gauge-rating {background: ' . esc_attr( $gauge_filled_color_1 ) . ';}';
				}
				if ( $gauge_empty_color ) {
					$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-gauge-circles-singular .gpur-rating-outer {background: ' . esc_attr( $gauge_empty_color ) . ';}';
				}
				if ( $rating_width ) {
					$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-small-rating .gpur-gauge-1 {clip: rect(0, ' . ghostpool_add_units( $rating_width ) . ', ' . ghostpool_add_units( $rating_width ) . ', ' . ghostpool_add_units( ghostpool_remove_units( $rating_width ) / 2 ) . ');}';
					$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-small-rating .gpur-gauge-2 {clip: rect(0, ' . ghostpool_add_units( ghostpool_remove_units( $rating_width ) / 2 ) . ', ' . ghostpool_add_units( $rating_width ) . ', 0);}';
				}
			
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

			// Maximum rating text
			if ( $maximum_rating_text_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-max-rating {font-size: ' . ghostpool_add_units( $maximum_rating_text_size ) . ';}';
			}
			if ( $maximum_rating_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-max-rating {color: ' . esc_attr( $maximum_rating_text_color ) . ';}';
			}
			if ( $maximum_rating_text_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-max-rating {' . esc_attr( $maximum_rating_text_extra_css ) . '}';
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

			// Ranges text
			if ( $ranges_text_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-ranges-text {font-size: ' . ghostpool_add_units( $ranges_text_size ) . ';}';
			}
			if ( $ranges_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-ranges-text {color: ' . esc_attr( $ranges_text_color ) . ';}';
			}
			if ( $ranges_text_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-ranges-text {' . ghostpool_add_units( $ranges_text_extra_css ) . '}';
			}
			
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
			// Rich snippets
			if ( 1 == $rich_snippets ) {
			
				$excerpt = '';
				if ( get_post_meta( $post_id, $summary_meta_key, true ) ) { 
					$excerpt = get_post_meta( $post_id, $summary_meta_key, true ); 
				} elseif ( get_post_meta( $post_id, $excerpt_meta_key, true ) ) { 
					$excerpt = get_post_meta( $post_id, $excerpt_meta_key, true );
				}
				
				$rich_snippets_js = gpur_rich_snippets( $data, array(
					'url' => esc_url( get_permalink( $post_id ) ),
					'title' => the_title_attribute( array( 'post' => $post_id, 'echo' => false ) ),
					'author' => get_the_author_meta( 'display_name' ),
					'description' => $excerpt,
					'image' => esc_url( get_the_post_thumbnail_url( 'thumbnail' ) ),
					'rating_value' => isset( $updated_avg_rating_value ) ? $updated_avg_rating_value : $rating_value[0],
					'user_votes' => get_post_meta( $post_id, $user_votes_meta_key, true ),
					'max_rating' => $max_rating,
				 ) );
				 
				add_action( 'wp_footer', function() use ( $rich_snippets_js ) { //
					echo '<script type="application/ld+json">' . wp_kses_post( $rich_snippets_js ) .'</script>';
				});

			}
																														
			// Classes
			$css_classes = array(
				'gpur-element-wrapper',
				'gpur-show-rating-wrapper',
				'gpur-' . $style['class'],
				( 1 == $criterion_boxes ) ? 'gpur-criterion-boxes' : '',
				'gpur-' . $position,
				'gpur-' . $text_position,
				$style['linear_class'],
				'gpur-' . $format,
				$criteria['class'],
			);
			$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
			$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $args );

			ob_start();
			
			echo '<div id="' . esc_attr( $unique_id ) . '" class="' . esc_attr( $css_classes ) . '">';
			
				if ( $title ) {
					echo '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
				}
			
				// Set counter to 0
				$i = 0;

				if ( 'yes' === $criteria['multi'] ) {
	
					foreach( $criteria['fields'] as $criterion ) {
					
						include( plugin_dir_path( __FILE__ ) . 'templates/show-rating-template.php' );
					}	

				} else { 
			
					include( plugin_dir_path( __FILE__ ) . 'templates/show-rating-template.php' );
			
				}
			
			echo '</div><div class="gpur-clear"></div>';
			
			$output = ob_get_contents();
			ob_end_clean();
			return $output;

		}

	}		
} 
new GPUR_Show_Rating();