<?php if ( ! function_exists( 'gpur_comparison_table' ) ) {
	function gpur_comparison_table( $atts, $content = null ) {
		
		$defaults = array(
			'table_format' => 'format-vertical-grid',
			'post_types' => 'post',
			'ids' => '',
			'cats' => '',
			'tags' => '',
			'fields' => <<<CONTENT
REVIEW_IMAGE_1
POST_TITLE
SITE_RATING
USER_RATING
SUMMARY
CONTENT
,			
			'sort' => 'post-date-desc',
			'user_sorting' => 1,
			'number' => 10,
			'summary_length' => '',
			'excerpt_length' => '',
			'image_size' => 'thumbnail',
			'heading_bg_color' => '#333',
			'heading_border_color' => '#333',
			'heading_text_color' => '#fff',
			'heading_extra_css' => '',
			'cell_bg_color_1' => '',
			'cell_bg_color_2' => '#f8f8f8',
			'remove_vertical_borders' => 1,
			'cell_border_color' => '#eee',
			'cell_text_color' => '',
			'cell_link_color' => '',
			'cell_link_hover_color' => '',
			'cell_extra_css' => '',
			'site_criteria' => '',
			'site_max_rating' => '',
			'user_criteria' => '',
			'user_max_rating' => '',
			'style' => 'style-stars',
			'show_maximum_rating_text' => '',
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
			'rating_extra_css' => '',
			'gauge_width' => '',
			'gauge_filled_color_1' => '',
			'gauge_filled_color_2' => '',
			'gauge_empty_color' => '',
			'criteria_title_size' => '',
			'criteria_title_color' => '',
			'criteria_title_extra_css' => '',
			'maximum_rating_text_size' => '',
			'maximum_rating_text_color' => '',
			'maximum_rating_text_extra_css' => '',
			'button_text' => esc_html__( 'Button Text', 'gpur' ),
			'button_padding_width' =>'15px',
			'button_padding_height' =>'10px',
			'button_color' => '#000',
			'button_hover_color' => '#333',
			'button_text_size' => '20px',
			'button_text_color' => '#fff',
			'button_text_hover_color' => '#fff',
			'button_border_width' => '',
			'button_border_radius' => '',
			'button_border_color' => '',
			'button_border_hover_color' => '',
			'button_icon' => '',
			'button_icon_size' => '20px',
			'button_icon_color' => '#fff',
			'button_icon_hover_color' => '#fff',
			'button_icon_alignment' => 'icon-left',
			'good_icon' => 'fa fa-angle-right',
			'good_icon_size' => '',
			'good_icon_color' => '',
			'good_icon_extra_css' => '',
			'good_text_size' => '',
			'good_text_color' => '',
			'good_text_extra_css' => '',			
			'bad_icon' => 'fa fa-angle-right',
			'bad_icon_size' => '',
			'bad_icon_color' => '',
			'bad_icon_extra_css' => '',
			'bad_text_size' => '',
			'bad_text_color' => '',
			'bad_text_extra_css' => '',
			'ranking_numbers_label' => '',
			'review_image_label' => '',
			'post_title_label' => esc_html( 'Title', 'gpur' ),
			'post_date_label' => esc_html( 'Date', 'gpur' ),
			'post_cats_label' => esc_html( 'Categories', 'gpur' ),
			'post_tags_label' => esc_html( 'Tags', 'gpur' ),
			'site_rating_label' => esc_html( 'Site Rating', 'gpur' ),
			'user_rating_label' => esc_html( 'User Rating', 'gpur' ),
			'user_votes_label' => esc_html( 'User Votes', 'gpur' ),
			'likes_label' => esc_html( 'Likes', 'gpur' ),
			'dislikes_label' => esc_html( 'Dislikes', 'gpur' ),
			'summary_label' => esc_html( 'Summary', 'gpur' ),
			'excerpt_label' => esc_html( 'Excerpt', 'gpur' ),
			'good_points_label' => esc_html( 'Good Points', 'gpur' ),
			'bad_points_label' => esc_html( 'Bad Points', 'gpur' ),
			'button_label' => '',
			'css' => '',
		);		
		
		$atts = wp_parse_args( $atts, $defaults );
		
		extract( $atts );

		// Unique ID
		$unique_id = 'gpur_' . uniqid();
		
		// Post types
		if ( ! is_array( $post_types ) && $post_types ) {
			$post_types = explode( ',', $post_types );
		}
				
		// Post/page IDs		
		if ( $ids ) {
			$ids = explode( ',', $ids );
		}
		
		// Fields
		if ( $fields ) {
			$fields = explode( ',', $fields );
		}
						
		// Sorting values
		$sorting = gpur_sorting( $sort );
		
		// Inline CSS
		$inline_css = '';
		
		// Heading background color
		if ( $heading_bg_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-th, #' . esc_attr( $unique_id ) . ' .gpur-th-inner {background-color: ' . esc_attr( $heading_bg_color ) . ';}';
		}	
				
		// Heading border color
		if ( $heading_border_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-th, #' . esc_attr( $unique_id ) . ' .gpur-th-inner, #' . esc_attr( $unique_id ) . ' .gpur-tr:last-child .gpur-th, #' . esc_attr( $unique_id ) . ' .gpur-tr:last-child .gpur-th-inner {border-color: ' . esc_attr( $heading_border_color ) . ';}';
		}	
				
		// Heading text color
		if ( $heading_text_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-th, #' . esc_attr( $unique_id ) . ' .gpur-th-inner, #' . esc_attr( $unique_id ) . ' .gpur-sort-button {color: ' . esc_attr( $heading_text_color ) . ';}';
		}	
				
		// Heading extra css
		if ( $heading_extra_css ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-th, #' . esc_attr( $unique_id ) . ' .gpur-th-inner {' . esc_attr( $heading_extra_css ) . '}';
		}	
				
		// Cell background color 1
		if ( $cell_bg_color_1 ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(even) .gpur-td, #' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(even) .gpur-td-inner, #' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td:nth-child(even), #' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td-inner:nth-child(even) {background-color: ' . esc_attr( $cell_bg_color_1 ) . ';}';
		}		

		// Cell background color 2
		if ( $cell_bg_color_2 ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(odd) .gpur-td, #' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-tr:nth-child(odd) .gpur-td-inner, #' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td:nth-child(odd), #' . esc_attr( $unique_id ) . '.gpur-format-horizontal-grid .gpur-tr .gpur-td-inner:nth-child(odd) {background-color: ' . esc_attr( $cell_bg_color_2 ) . ';}';
		}	
							
		// Cell border color
		if ( $cell_border_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-td, #' . esc_attr( $unique_id ) . ' .gpur-td-inner, #' . esc_attr( $unique_id ) . ' .gpur-tr:last-child .gpur-td, #' . esc_attr( $unique_id ) . ' .gpur-td:last-child .gpur-td-inner {border-color: ' . esc_attr( $cell_border_color ) . ';}';
		}		
					
		// Cell text color
		if ( $cell_text_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-td, #' . esc_attr( $unique_id ) . ' .gpur-td-inner {color: ' . esc_attr( $cell_text_color ) . ';}';
		}	
					
		// Cell link color
		if ( $cell_link_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-td a, #' . esc_attr( $unique_id ) . ' .gpur-td-inner a {color: ' . esc_attr( $cell_link_color ) . ';}';
		}	
					
		// Cell link hover color
		if ( $cell_link_hover_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-td a:hover, #' . esc_attr( $unique_id ) . ' .gpur-td-inner a:hover {color: ' . esc_attr( $cell_link_hover_color ) . ';}';
		}			
					
		// Cell extra css
		if ( $cell_extra_css ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-td, #' . esc_attr( $unique_id ) . ' .gpur-td-inner {' . esc_attr( $cell_extra_css ) . '}';
		}		
		
		// Review image cell width
		if ( $image_size ) {
		
			if ( is_array( gpur_image_dimensions( $image_size ) ) ) {
				$width = gpur_image_dimensions( $image_size );
				$width = $width[0];
			} else {
				if ( in_array( $image_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
					$width = get_option( "{$image_size}_size_w" );
				} else {
					global $_wp_additional_image_sizes;
					$width = $_wp_additional_image_sizes[ $_size ]['width'];
				}
			}	
			
			$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-review-image-1, #' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-review-image-2, #' . esc_attr( $unique_id ) . '.gpur-format-vertical-grid .gpur-comparison-table-featured-image {max-width: ' . ghostpool_add_units( $width ) . ';min-width: ' . ghostpool_add_units( $width ) . ';}';
		}	
			
		wp_register_style( 'gpur-shortcodes', false );
		wp_enqueue_style( 'gpur-shortcodes' );
		wp_add_inline_style( 'gpur-shortcodes', $inline_css );
		
		// Query
		$args = array(
			'post_status' 	      => 'publish',
			'post_type'           => $post_types,
			'post__in' 			  => $ids,
			'category_name' 	  => $cats,
			'tag'			      => $tags,
			'orderby'             => $sorting['order_by'],
			'order'               => $sorting['order'],
			'meta_key' 			  => $sorting['meta_key'],
			'posts_per_page'      => $number,
		);
		$query = new WP_Query( $args );	
		
		// Get string of all shortcode attributes
		if ( $atts ) {	
			$shortcode_atts = '';
			foreach( $atts as $name => $value ) {
				$shortcode_atts .= '"' . $name . '":"' . $value . '", ';
			}
			$shortcode_atts = rtrim( $shortcode_atts, ', ' );
		}
			
		// Classes
		$css_classes = array(
			'gpur-element-wrapper',
			'gpur-comparison-table-wrapper',
			'gpur-' . $table_format,
			true === $remove_vertical_borders ? 'gpur-remove-vertical-borders' : '',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
		$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $atts );
							
		ob_start();
		
		if ( $query->have_posts() ) {
		
			include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/comparison-table-fields.php' );
			
			echo '<div id="' . esc_attr( $unique_id ) . '" class="' . esc_attr( $css_classes ) . '">';
				
				echo '<div class="gpur-comparison-table gpur-default-sort-' . esc_attr( $sort ) . '" data-gpur-sorting-query="{' . esc_attr( $shortcode_atts ) . '}" data-gpur-nonce="' . wp_create_nonce( 'gpur_comparison_table_sorting_nonce' ) . '">';
			
					$all_fields = array(
						'RANKING_NUMBERS' => array( 'RANKING_NUMBERS', 'ranking-numbers', $ranking_numbers_label, false ),
						'REVIEW_IMAGE_1' => array( 'REVIEW_IMAGE_1', 'review-image-1', $review_image_label, false ),
						'REVIEW_IMAGE_2' => array( 'REVIEW_IMAGE_2', 'review-image-2', $review_image_label, false ),
						'FEATURED_IMAGE' => array( 'FEATURED_IMAGE', 'featured-image', $review_image_label, false ),
						'POST_TITLE' => array( 'POST_TITLE', 'post-title', $post_title_label, true ),
						'POST_DATE' => array( 'POST_DATE', 'post-date', $post_date_label, true ),
						'POST_CATS' => array( 'POST_CATS', 'post-cats', $post_cats_label, false ),
						'POST_TAGS' => array( 'POST_TAGS', 'post-tags', $post_tags_label, false ),
						'SITE_RATING' => array( 'SITE_RATING', 'site-rating', $site_rating_label, true ),
						'USER_RATING' => array( 'USER_RATING', 'user-rating', $user_rating_label, true ),
						'USER_VOTES' => array( 'USER_VOTES', 'user-votes', $user_votes_label, true ),
						'LIKES' => array( 'LIKES', 'likes', $likes_label, true ),
						'DISLIKES' => array( 'DISLIKES', 'dislikes', $dislikes_label, true ),
						'SUMMARY' => array( 'SUMMARY', 'summary', $summary_label, false ),
						'EXCERPT' => array( 'EXCERPT', 'excerpt', $excerpt_label, false ),
						'GOOD_POINTS' => array( 'GOOD_POINTS', 'good-points', $good_points_label, false ),
						'BAD_POINTS' => array( 'BAD_POINTS', 'bad-points', $bad_points_label, false ),
						'BUTTON' => array( 'BUTTON', 'button', $button_label, false ),
						'CUSTOM_FIELD' => array( 'CUSTOM_FIELD', 'custom-field', '', false ),
					);

					if ( 'format-vertical-grid' === $table_format ) {
						include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/vertical-grid.php' );
					} elseif ( 'format-horizontal-grid' === $table_format ) {
						echo '<div class="gpur-desktop-table">';
							include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/horizontal-grid.php' );
						echo '</div>';
						echo '<div class="gpur-mobile-table">';
							include( dirname( plugin_dir_path( __FILE__ ) ) . '/templates/vertical-grid.php' );
						echo '</div>';	
					}

				echo '</div>';	

			echo '</div>';	
		}	
	
		wp_reset_postdata();
			
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
}
add_shortcode( 'gpur_comparison_table', 'gpur_comparison_table' );