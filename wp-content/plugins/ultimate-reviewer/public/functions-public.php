<?php

/**
 * Add theme name to body class
 *
 */ 
if ( ! function_exists( 'gpur_add_theme_name_to_body_class' ) ) {
	function gpur_add_theme_name_to_body_class( $classes ) {
		if ( defined( 'AARDVARK_THEME_VERSION' ) ) {
			$classes[] = 'gpur-aardvark-theme';
		} elseif ( defined( 'HUBER_THEME_VERSION' ) ) {
			$classes[] = 'gpur-huber-theme';
		} elseif ( defined( 'GAUGE_THEME_VERSION' ) ) {
			$classes[] = 'gpur-gauge-theme';
		} elseif ( defined( 'THE_REVIEW_THEME_VERSION' ) ) {
			$classes[] = 'gpur-the-review-theme';
		} else {
			$classes[] = 'gpur-other-theme';
		}
		return $classes;
	}
}
add_filter( 'body_class', 'gpur_add_theme_name_to_body_class' );

/**
 * Get hub ID for Huber, Gauge and The Review themes
 *
 */ 
if ( ! function_exists( 'gpur_get_hub_id' ) ) {
	function gpur_get_hub_id( $post_id ) {
		if ( function_exists( 'get_hub_association_id' ) ) { // Huber
			$output = get_hub_association_id( $post_id );
		} elseif ( function_exists( 'ghostpool_get_hub_id' ) ) { // Gauge/The Review
			$output = ghostpool_get_hub_id( $post_id );
		} else {
			$output = $post_id;
		}
		return $output;
	}
}

/**
 * Add units to values if left empty
 *
 */
if ( ! function_exists( 'ghostpool_add_units' ) ) {
	function ghostpool_add_units( $value = '', $units = 'px' ) {
		if ( is_numeric( $value ) ) {
			$value = $value . $units;
		}
		return $value;	
	}
}

/**
 * Remove px from values
 *
 */
if ( ! function_exists( 'ghostpool_remove_units' ) ) {
	function ghostpool_remove_units( $value = '', $units = 'px' ) {
		if ( ! is_numeric( $value ) ) {
			$value = str_replace( $units, '', $value );
		}
		return (int) $value;	
	}
}

/**
 * Sorting
 *
 */
function gpur_sorting( $sorting ) {

	if ( 'post-date-desc' === $sorting ) {
		$meta_key = '';
		$order_by = 'date';
		$order = 'desc';
	} elseif ( 'post-date-asc' === $sorting ) {
		$meta_key = '';
		$order_by = 'date';
		$order = 'asc';			
	} elseif ( 'post-title-desc' === $sorting ) {
		$meta_key = '';
		$order_by = 'title';
		$order = 'desc';	
	} elseif ( 'post-title-asc' === $sorting ) {
		$meta_key = '';
		$order_by = 'title';
		$order = 'asc';			
	} elseif ( 'site-rating-desc' === $sorting ) {
		$meta_key = 'gpur_site_rating';
		$order_by = 'meta_value_num';
		$order = 'desc';
	} elseif ( 'site-rating-asc' === $sorting ) {
		$meta_key = 'gpur_site_rating';
		$order_by = 'meta_value_num';
		$order = 'asc';			
	} elseif ( 'user-rating-desc' === $sorting ) {
		$meta_key = 'gpur_avg_user_rating';
		$order_by = 'meta_value_num';
		$order = 'desc';
	} elseif ( 'user-rating-asc' === $sorting ) {
		$meta_key = 'gpur_avg_user_rating';
		$order_by = 'meta_value_num';
		$order = 'asc';
	} elseif ( 'user-votes-desc' === $sorting ) {
		$meta_key = 'gpur_user_votes';
		$order_by = 'meta_value_num';
		$order = 'desc';
	} elseif ( 'user-votes-asc' === $sorting ) {
		$meta_key = 'gpur_user_votes';
		$order_by = 'meta_value_num';
		$order = 'asc';		
	} elseif ( 'likes-desc' === $sorting ) {
		$meta_key = 'gpur_up_votes';
		$order_by = 'meta_value_num';
		$order = 'desc';
	} elseif ( 'likes-asc' === $sorting ) {
		$meta_key = 'gpur_up_votes';
		$order_by = 'meta_value_num';
		$order = 'asc';			
	} elseif ( 'dislikes-desc' === $sorting ) {
		$meta_key = 'gpur_down_votes';
		$order_by = 'meta_value_num';
		$order = 'desc';
	} elseif ( 'dislikes-asc' === $sorting ) {
		$meta_key = 'gpur_down_votes';
		$order_by = 'meta_value_num';
		$order = 'asc';
	} elseif ( 'random' === $sorting ) {
		$meta_key = '';
		$order_by = 'rand';
		$order = 'asc';
	} elseif ( 'post-page-order' === $sorting ) {
		$meta_key = '';
		$order_by = 'post__in';
		$order = 'asc';	
	} else {
		$meta_key = '';
		$order_by = 'date';
		$order = 'desc';	
	}
	
	return array(
		'meta_key' => $meta_key,
		'order_by' => $order_by,
		'order' => $order,
	);

}

/**
 * Comparison table sort icons
 *
 */
function gpur_sort_icons( $field_1, $field_2, $field_3, $atts ) {

	$slug = $field_1;
	$label = $field_2;
	$user_sorting = $field_3;

	$sort = isset( $_GET['sorting'] ) ? $_GET['sorting'] : $atts['sort'];

	$asc_selected = '';
	$desc_selected = '';
	if ( $slug . '-asc' === $sort ) {
		$asc_selected = ' gpur-selected';
	} elseif ( $slug . '-desc' === $sort ) {
		$desc_selected = ' gpur-selected';	
	}

	echo '<span class="gpur-th-title">' . esc_attr( $label ) . '</span>';
	if ( true === $atts['user_sorting'] && true === $user_sorting ) {
		echo '<span class="gpur-sort-buttons-outer"><span class="gpur-sort-buttons-inner">';
			echo '<span class="gpur-sort-button gpur-asc' . $asc_selected . '" data-gpur-sorting="' . esc_attr( $slug ) . '-asc"></span>';
			echo '<span class="gpur-sort-button gpur-desc' . $desc_selected . '" data-gpur-sorting="' . esc_attr( $slug ) . '-desc"></span>';
		echo '</span></span>';	
	}
	
}
					
/**
 * Get image dimensions or image size name
 *
 */
if ( ! function_exists( 'gpur_image_dimensions' ) ) {
	function gpur_image_dimensions( $dimensions ) {
		$dimensions = str_replace( ' ', '', $dimensions );
		$matches = null;
		if ( preg_match( '/(\d+)x(\d+)/', $dimensions, $matches ) ) {
			return array(
				$matches[1],
				$matches[2],
			);
		} else {
			return $dimensions;
		}	
	}
}
	
/**
 * Rich snippets
 *
 */ 
if ( ! function_exists( 'gpur_rich_snippets' ) ) {
	function gpur_rich_snippets( $data, $atts ) {
	
		$defaults = array(
			'url' => '',
			'title' => '',
			'author' => '',
			'description' => '',
			'image' => '',
			'rating_value' => 0,
			'user_votes' => 0,
			'max_rating' => 5,
		);
		
		wp_parse_args( $atts, $defaults );
	
		$output = ''; 
		
		$output .= '{';
			if ( 'site-rating' === $data OR 'custom' === $data ) {
				$output .= '"@context": "http://schema.org/",
				"@type": "Review",
				"mainEntityOfPage": {
					  "@type": "WebPage",
					  "@id": "' . $atts['url'] . '"
				},
				"itemReviewed": {
					"@type": "Thing",
					"name": "' . $atts['title'] . '"
				},
				"author": {
					"@type": "Person",
					"name": "' . $atts['author'] . '"
				},
				"reviewRating": {
					"@type": "Rating",
					"ratingValue": "' . $atts['rating_value'] . '",
					"worstRating" : "0",
					"bestRating": "' . $atts['max_rating'] . '"
				}';
			} else {
				$output .= '"@context": "http://schema.org/",
				"@type": "Product",
					"mainEntityOfPage": {
						  "@type": "WebPage",
						  "@id": "' . $atts['url'] . '"
					},	
					"name": "' . $atts['title'] . '",
					"image": "' . $atts['image'] . '",
					"description": "' . $atts['description'] . '",
					"aggregateRating": {
						"@type": "AggregateRating",
						"ratingValue": "' . $atts['rating_value'] . '",
						"ratingCount": "' . $atts['user_votes'] . '",
						"bestRating": "' . $atts['max_rating'] . '",
						"worstRating": "0"
					}
				}';
			}	
		$output .= '}';
		
		return $output;
		
	}
}