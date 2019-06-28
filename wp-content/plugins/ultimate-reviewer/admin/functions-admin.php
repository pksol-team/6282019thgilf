<?php

/**
 * Get site rating meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_site_rating' ) ) {
	function gpur_get_site_rating( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_site_rating', true ) ) { // Plugin
			$output = 'gpur_site_rating';
		} elseif ( get_post_meta( $post_id, 'site_rating', true ) ) { // Huber
			$output = 'site_rating';
		} elseif ( get_post_meta( $post_id, '_gp_site_rating', true ) ) { // Gauge/The Review
			$output = '_gp_site_rating';
		} else {
			$output = 'gpur_site_rating';
		}	
		return esc_attr( $output );
	}
}

/**
 * Get average user rating meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_avg_user_rating' ) ) {
	function gpur_get_avg_user_rating( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_avg_user_rating', true ) ) { // Plugin
			$output = 'gpur_avg_user_rating';
		} elseif ( get_post_meta( $post_id, 'ghostpool_user_rating', true ) ) { // Huber
			$output = 'ghostpool_user_rating';
		} elseif ( get_post_meta( $post_id, '_gp_user_rating', true ) ) { // Gauge/The Review
			$output = '_gp_user_rating';
		} else {
			$output = 'gpur_avg_user_rating';
		}
		return esc_attr( $output );
	}
}

/**
 * Get individual user ratings meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_ind_user_rating' ) ) {
	function gpur_get_ind_user_rating( $post_id ) {
		$output = '';
		if ( get_user_meta( get_current_user_id(), 'gpur_user_rating_' . $post_id, true ) ) { // Plugin
			$output = 'gpur_user_rating_' . $post_id;
		} elseif ( get_user_meta( get_current_user_id(), 'ghostpool_user_rating_' . $post_id, true ) ) { // Huber
			$output = 'ghostpool_user_rating_' . $post_id;
		} elseif ( get_user_meta( get_current_user_id(), '_gp_user_rating_'. $post_id, true ) ) { // Gauge/The Review
			$output = '_gp_user_rating_' . $post_id;
		} else {
			$output = 'gpur_user_rating_' . $post_id;
		}
		return esc_attr( $output );
	}
}

/**
 * Get user votes meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_user_votes' ) ) {
	function gpur_get_user_votes( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_user_votes', true ) ) { // Plugin
			$output = 'gpur_user_votes';
		} elseif ( get_post_meta( $post_id, 'ghostpool_user_votes', true ) ) { // Huber
			$output = 'ghostpool_user_votes';
		} elseif ( get_post_meta( $post_id, '_gp_user_votes', true ) ) { // Gauge/The Review
			$output = '_gp_user_votes';
		} else {
			$output = 'gpur_user_votes';
		}
		return esc_attr( $output );
	}
}

/**
 * Get user sum meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_user_sum' ) ) {
	function gpur_get_user_sum( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_user_sum', true ) ) { // Plugin
			$output = 'gpur_user_sum';
		} elseif ( get_post_meta( $post_id, 'ghostpool_user_sum', true ) ) { // Huber
			$output = 'ghostpool_user_sum';
		} elseif ( get_post_meta( $post_id, '_gp_user_sum', true ) ) { // Gauge/The Review
			$output = '_gp_user_sum';
		} else {
			$output = 'gpur_user_sum';
		}
		return esc_attr( $output );
	}
}

/**
 * Get summary meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_summary' ) ) {
	function gpur_get_summary( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_summary', true ) ) { // Plugin
			$output = 'gpur_summary';
		} elseif ( get_post_meta( $post_id, 'summary', true ) ) { // Huber
			$output = 'summary';
		} elseif ( get_post_meta( $post_id, 'hub_review_summary', true ) ) { // The Review
			$output = 'hub_review_summary';
		} elseif ( get_post_meta( $post_id, 'review_summary', true ) ) { // The Review
			$output = 'review_summary';
		} else {
			$output = 'gpur_summary';
		}
		return esc_attr( $output );
	}
}
	
/**
 * Get excerpt meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_excerpt' ) ) {
	function gpur_get_excerpt( $post_id ) {
		$output = '';		
		if ( get_post_meta( $post_id, 'gpur_excerpt', true ) ) {
			$output = 'gpur_excerpt';
		} elseif ( get_post_meta( $post_id, 'synopsis', true ) ) { // Huber
			$output = 'synopsis';
		} elseif ( get_post_meta( $post_id, 'hub_synopsis', true ) ) { // Gauge/The Review
			$output = 'hub_synopsis';
		} elseif ( get_post_meta( $post_id, 'hub_review_synopsis', true ) ) { // Gauge/The Review
			$output = 'hub_review_synopsis';
		} else {
			$output = 'gpur_excerpt';
		}
		return esc_attr( $output );
	}
}
				
/**
 * Get good points meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_good_points' ) ) {
	function gpur_get_good_points( $post_id ) {
		$output = '';
		if ( count( array_filter( (array) get_post_meta( get_the_ID(), 'gpur_good_points', true ) ) ) != 0 ) { // Plugin
			$output = 'gpur_good_points';
		} elseif ( count( array_filter( (array) get_post_meta( get_the_ID(), 'good_points', true ) ) ) != 0 ) { // Huber
			$output = 'good_points';
		} elseif ( count( array_filter( (array) get_post_meta( get_the_ID(), 'hub_review_good_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'hub_review_good_points';
		} elseif ( count( array_filter( (array) get_post_meta( get_the_ID(), 'review_good_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'review_good_points';
		} else {
			$output = 'gpur_good_points';
		}		
		return esc_attr( $output );
	}
}

/**
 * Get bad points meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_bad_points' ) ) {
	function gpur_get_bad_points( $post_id ) {
		$output = '';
		if ( count( array_filter( (array) get_post_meta( $post_id, 'gpur_bad_points', true ) ) ) != 0 ) { // Plugin
			$output = 'gpur_bad_points';
		} elseif ( count( array_filter( (array) get_post_meta( $post_id, 'bad_points', true ) ) ) != 0 ) { // Huber
			$output = 'bad_points';
		} elseif ( count( array_filter( (array) get_post_meta( $post_id, 'hub_review_bad_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'hub_review_bad_points';
		} elseif ( count( array_filter( (array) get_post_meta( $post_id, 'review_bad_points', true ) ) ) != 0 ) { // Gauge/The Review
			$output = 'review_bad_points';
		} else {
			$output = 'gpur_bad_points';
		}
		return esc_attr( $output );
	}
}

/**
 * Get up votes meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_up_votes' ) ) {
	function gpur_get_up_votes( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_up_votes', true ) ) { // Plugin
			$output = 'gpur_up_votes';
		} elseif ( get_post_meta( $post_id, 'ghostpool_voting_up', true ) ) { // Aardvark/Huber
			$output = 'ghostpool_voting_up';
		} else {
			$output = 'gpur_up_votes';
		}
		return esc_attr( $output );
	}
}

/**
 * Get down votes meta key
 *
 */ 
if ( ! function_exists( 'gpur_get_down_votes' ) ) {
	function gpur_get_down_votes( $post_id ) {
		$output = '';
		if ( get_post_meta( $post_id, 'gpur_down_votes', true ) ) { // Plugin
			$output = 'gpur_down_votes';
		} elseif ( get_post_meta( $post_id, 'ghostpool_voting_down', true ) ) { // Aardvark/Huber
			$output = 'ghostpool_voting_down';
		} else {
			$output = 'gpur_down_votes';
		}
		return esc_attr( $output );
	}
}					

/**
 * Get all classes and add spacing
 *
 */ 
if ( ! function_exists( 'gpur_custom_css_class' ) ) { 
	function gpur_custom_css_class( $param_value, $prefix = '' ) {
		$css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';
		return $css_class;
	}
}

/**
 * Get styles
 *
 */ 
if ( ! function_exists( 'gpur_rating_styles' ) ) {
	function gpur_rating_styles( $style, $empty_icon, $filled_icon ) {

		$output = '';

		if ( 'style-stars' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'fa fa-star-o',
				'filled' => 'fa fa-star',
				'linear_class' => 'gpur-linear',
			);	
		} elseif ( 'style-hearts' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'fa fa-heart-o',
				'filled' => 'fa fa-heart',
				'linear_class' => 'gpur-linear',
			);		
		} elseif ( 'style-squares' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);	
		} elseif ( 'style-circles' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);		
		} elseif ( 'style-bars' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);
		} elseif ( 'style-icon' === $style ) {	
			$output = array(
				'class' => $style,
				'empty' => $empty_icon,
				'filled' => $filled_icon,
				'linear_class' => 'gpur-linear',
			);				
		} elseif ( 'style-image' === $style ) {
			$output = array(
				'class' => $style,
				'empty' => 'gpur-symbol gpur-symbol-empty',
				'filled' => 'gpur-symbol gpur-symbol-filled',
				'linear_class' => 'gpur-linear',
			);		
		} else {
			$output = array(
				'class' => $style,
				'empty' => '',
				'filled' => '',
				'linear_class' => 'gpur-non-linear',
			);		
		}

		return $output;

	}
}

/**
 * Put criteria and weights into an array
 *
 */
if ( ! function_exists( 'gpur_criteria' ) ) {
	function gpur_criteria( $criteria = '' ) {
		if ( $criteria && ! is_array( $criteria ) ) {
			if ( false === strpos( $criteria, ',' ) ) {						
				$criteria = explode( "\n", $criteria );
				$criteria = implode( ",", $criteria );
			}
			$criteria_trim = rtrim( $criteria, ',' );
			$criteria_data = str_replace( ',,', ',', $criteria_trim );
			preg_match_all( '/([^:]+)\:([^,]+),?/', $criteria_data, $m ) ? list( , $criteria, $weights ) = $m : $criteria = explode( ',', $criteria );
			$weights = isset( $weights ) ? $weights : '';
			$output = array(
				'fields' => $criteria,
				'weights' => $weights,
				'count' => count( $criteria ),
				'class' => 'gpur-multi-rating',
				'multi' => 'yes',
			);	
		} else {
			$output = array(
				'fields' => '',
				'count' => 1,
				'class' => 'gpur-single-rating',
				'multi' => 'no',
			);	
		}
		return $output;
	}		
}


/**
 * Call a shortcode function by tag name
 *
 */
if ( ! function_exists( 'gpur_do_shortcode_func' ) ) { 
	function gpur_do_shortcode_func( $tag, array $atts = array(), $content = null ) {
		global $shortcode_tags;
		if ( ! isset( $shortcode_tags[ $tag ] ) ) {
			return false;
		}
		return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}
}

/**
 * Get permissions
 *
 */
if ( ! function_exists( 'gpur_permissions' ) ) {
	function gpur_permissions( $permissions, $permission_roles ) {
		$output = 'disallowed';
		if ( 'all-users' === $permissions ) {
			$output = 'allowed';
		} elseif ( 'logged-in-users' === $permissions && is_user_logged_in() ) {
			$output = 'allowed';
		} elseif ( 'specific-roles' === $permissions ) {
			if ( $permission_roles ) {
				if ( ! is_array( $permission_roles ) ) {
					$permission_roles = explode( ',', $permission_roles );
				}
				$current_user = wp_get_current_user();
				foreach( $permission_roles as $permission_role ) {		
					if ( in_array( $permission_role, $current_user->roles ) ) {
						$output = 'allowed';
						break;
					}
				}
			}
		}
		return $output;
	}
}

/**
* Review template dropdown field values
*
*/	
function gpur_templates_dropdown_values() {

	$args = array(
		'post_status' 	 => 'publish',
		'post_type'	 	 => 'gpur-template',
		'orderby'	  	 => 'title',
		'order'		  	 => 'asc',	
		'posts_per_page' => '-1',
		'offset'         => 0,
	);

	$args = apply_filters( 'gpur_templates_dropdown_values_query', $args );

	$posts = get_posts( $args );

	$output = array();

	foreach( $posts as $post ) {

		$title = $post->post_title;
		$id = $post->ID;
		$output[ $title ] = $id;

	}

	return $output;

	wp_reset_postdata();

}

/**
 * Insert review template into selected items automatically
 *
 */
function gpur_get_review_templates( $post_id ) {

	// Is this review template disabled on this post

	$template_id = array();		
	$continue = true;

	$args = array(
		'post_status' 	      => 'publish',
		'post_type'           => array( 'gpur-template' ),
		'meta_key'   		  => 'gpur_review_template_automatic_insertion',
		'orderby'             => 'date',
		'order'               => 'desc',
		'no_found_rows'		  => true,
	);
	
	$templates = get_posts( $args );
	
	if ( ! empty( $templates ) ) {
	
		foreach( $templates as $template ) {
			setup_postdata( $template );

			// If it's not the main query bail
			if ( ! is_main_query() ) {
				$continue = false;
			}

			// Does this review template have this post type
			if ( $post_types = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion', true ) ) {
				if ( ! in_array( get_post_type( $post_id ), $post_types ) ) {
					$continue = false;
				}	
			}
			
			// Does this review template have this post ID
			if ( $ids = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion_ids', true ) ) {
				$ids = explode( ',', $ids );
				if ( ! in_array( $post_id, $ids ) ) {
					$continue = false;
				}
			}

			// Does this review template have these categories
			if ( $cats = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion_cats', true ) ) {
				$cats = explode( ',', $cats );
				$current_cats = get_the_category( $post_id );
				if ( $current_cats ) {
					foreach( $current_cats as $current_cat ) {
						if ( in_array( $current_cat->slug, $cats ) ) {
							$cat_continue = true;
							break;
						}
					}
				}	
				if ( isset( $cat_continue ) ) {
					$continue = true;
				} else {
					$continue = false;
				}
			}

			// Does this review template have these tags		
			if ( $tags = get_post_meta( $template->ID, 'gpur_review_template_automatic_insertion_tags', true ) ) {
				$tags = explode( ',', $tags );
				$current_tags = get_the_tags( $post_id );
				if ( $current_tags ) {
					foreach( $current_tags as $current_tag ) {
						if ( in_array( $current_tag->slug, $tags ) ) {
							$tag_continue = true;
							break;
						}
					}
				}	
				if ( isset( $tag_continue ) ) {
					$continue = true;
				} else {
					$continue = false;
				}
			}

			if ( true === $continue ) {
				$template_id[] = $template->ID;
			}	
		
		}
	
	}
	
	$template_ids = $template_id;

	return $template_ids;
	
	//wp_reset_postdata();

}

/**
 * Insert review template into selected items automatically
 *
 */
if ( ! function_exists( 'gpur_automatically_insert_review_template' ) ) {
	function gpur_automatically_insert_review_template( $content ) {
	
		$top_templates = '';
		$bottom_templates = '';
		
		if ( 'enabled' === get_post_meta( get_the_ID(), 'gpur_show_review_template', true ) ) {
	
			// Get auto inserted templates
			$template_ids = gpur_get_review_templates( get_the_ID() );
		
			if ( $template_ids ) {
			
				$top_templates = '';
				$bottom_templates = '';
			
				foreach( $template_ids as $template_id ) {
				
					$post = get_post( $template_id );
					
					$position = get_post_meta( $post->ID, 'gpur_review_template_position', true );
					if ( 'top' === $position ) {
						$top_templates .= '';	
					} elseif ( 'bottom' === $position ) {
						$bottom_templates .= '';
					}
  
				}
	
			}	

		}
		
		return $top_templates . $content . $bottom_templates;		
					
	}
}
add_filter( 'the_content', 'gpur_automatically_insert_review_template' );

/**
 * Get review template data for current post
 *
 */	
if ( ! function_exists( 'gpur_get_review_template_fields' ) ) {		
	function gpur_get_review_template_fields( $post_id ) {	

		if ( 'gpur-template' !== get_post_type( $post_id ) ) {
		
			// Get auto inserted templates
			$template_ids = gpur_get_review_templates( get_the_ID() );

			if ( ! empty( $template_ids ) && 'enabled' === get_post_meta( get_the_ID(), 'gpur_show_review_template', true ) ) {

				// Get first review template ID
				$first_id = true;
				foreach( $template_ids as $template_id ) {
					if ( true === $first_id ) {
						$review_template_id = $template_id;
						$first_id = false;
					}
				}

			} else {
				
				$post = get_post( get_the_ID() );		
				
				if ( isset( $post->post_content ) ) {
									
					// Get review template ID from current post
					preg_match_all( '/' . get_shortcode_regex() . '/s', $post->post_content, $matches );
					if ( isset( $matches[2] ) ) {
						$first_id = true;
						foreach( (array) $matches[2] as $key => $value ) {
							if ( true === $first_id ) {
								if ( 'gpur_review_template' === $value ) {
									$review_template[] = shortcode_parse_atts( $matches[3][$key] );  
									$first_id = false;
								}	
							}	
						}
					}
					$review_template_id = isset( $review_template[0]['id'] ) ? (int) $review_template[0]['id'] : '';
					
				}	
		
			}

			// If post has a review template
			if ( ! empty( $review_template_id ) ) {
			
				// Get review template data
				$template = get_post( $review_template_id );
				
				// Get site rating shortcode
				$shortcode = preg_match_all( "/\[gpur_show_rating(.*?)\]/", $template->post_content, $variables ) ? $variables[1] : '';

				// If site rating shortcode exists
				if ( '' !== $shortcode ) {
		
					if ( is_array( $shortcode ) ) {
						$shortcode = implode( ',', $shortcode );
					}	

					$shortcode_matches = '';
					preg_match_all( '/(\w+)\s*=\s*"(.*?)"/', $shortcode, $shortcode_matches );

					// Get shortcode variables as save as post meta
					if ( '' !== $shortcode_matches ) {						

						$variables = array();
						for( $i = 0; $i < count( $shortcode_matches[1] ); $i++ ) {
							$variables[$shortcode_matches[1][$i]] = $shortcode_matches[2][$i];
						}

					}

				}	
					
				$site_criteria = isset( $variables['criteria'] ) ? explode( ',', $variables['criteria'] ) : '';
				$site_step = isset( $variables['step'] ) ? $variables['step'] : 1;
				$site_min_rating = isset( $variables['min_rating'] ) ? $variables['min_rating'] : 0;
				$site_max_rating = isset( $variables['max_rating'] ) ? $variables['max_rating'] : 5;				

				// Get add user rating shortcode
				$shortcode = preg_match( "/\[gpur_add_user_ratings(.*?)\]/", $template->post_content, $variables ) ? $variables[1] : '';

				// If site rating shortcode exists
				if ( '' !== $shortcode ) {

					$shortcode_matches = '';
					preg_match_all( '/(\w+)\s*=\s*"(.*?)"/', $shortcode, $shortcode_matches );

					// Get shortcode variables as save as post meta
					if ( '' !== $shortcode_matches ) {						

						$variables = array();
						for( $i = 0; $i < count( $shortcode_matches[1] ); $i++ ) {
							$variables[$shortcode_matches[1][$i]] = $shortcode_matches[2][$i];				
						}
						$user_max_rating = isset( $variables['max_rating'] ) ? $variables['max_rating'] : 5;
							
					}

				} else {

					$user_max_rating = gpur_option( 'comment_form_max_rating' );

				}

			}
			
		}	
									
		$output = array(
			'id' => isset( $review_template_id ) ? $review_template_id : '',
			'site_criteria' => isset( $site_criteria ) ? $site_criteria : '',
			'site_step' => isset( $site_step ) ? $site_step : '',
			'site_min_rating' => isset( $site_min_rating ) ? $site_min_rating : '',
			'site_max_rating' => isset( $site_max_rating ) ? $site_max_rating : '',
			'user_max_rating' => isset( $user_max_rating ) ? $user_max_rating : '',
		);

		return $output;
			
	}
}