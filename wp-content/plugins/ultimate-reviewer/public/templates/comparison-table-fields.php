<?php if ( ! function_exists( 'gpur_comparison_table_fields' ) ) {	
	function gpur_comparison_table_fields( $field_name, $atts ) {

		extract( $atts );

		// Get correct meta keys
		$avg_user_rating_meta_key = gpur_get_avg_user_rating( get_the_ID() );
		$user_votes_meta_key = gpur_get_user_votes( get_the_ID() );
		$user_sum_meta_key = gpur_get_user_sum( get_the_ID() );
		$summary_meta_key = gpur_get_summary( get_the_ID() );
		$excerpt_meta_key = gpur_get_excerpt( get_the_ID() );
		$up_votes_meta_key = gpur_get_up_votes( get_the_ID() );
		$down_votes_meta_key = gpur_get_down_votes( get_the_ID() );
		
		if ( 'ranking-numbers' === $field_name ) {
		
			static $ranking_number = 1;
			echo $ranking_number;
			$ranking_number++;
		
		} elseif ( 'review-image-1' === $field_name ) {

			$review_image = get_post_meta( get_the_ID(), 'gpur_review_image_1', true );
			if ( $review_image ) {
				echo wp_get_attachment_image( $review_image, gpur_image_dimensions( $image_size ) );
			}
		
		} elseif ( 'review-image-2' === $field_name ) {

			$review_image = get_post_meta( get_the_ID(), 'gpur_review_image_2', true );
			if ( $review_image ) {
				echo wp_get_attachment_image( $review_image, gpur_image_dimensions( $image_size ) );
			}

		} elseif ( 'featured-image' === $field_name ) {

			echo get_the_post_thumbnail( get_the_ID(), gpur_image_dimensions( $image_size ) );
						
		} elseif ( 'post-title' === $field_name ) {
		
			echo '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '</a>';
		
		} elseif ( 'post-date' === $field_name ) {
		
			echo the_time( get_option( 'date_format' ) );
		
		} elseif ( 'post-cats' === $field_name ) {

			$categories = get_the_category();
			$separator = ', ';
			$output = '';
			if ( ! empty( $categories ) ) {
				foreach( $categories as $category ) {
					$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'gpur' ), $category->name ) ) . '">' . esc_attr( $category->name ) . '</a>' . $separator;
				}
				echo trim( $output, $separator );
			}
			
		} elseif ( 'post-tags' === $field_name ) {
		
			$tags = get_the_tags();
			$separator = ', ';
			$output = '';
			if ( ! empty( $tags ) ) {
				foreach( $tags as $tag ) {
					$output .= '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'gpur' ), $tag->name ) ) . '">' . esc_attr( $tag->name ) . '</a>' . $separator;
				}
				echo trim( $output, $separator );
			}
		
		} elseif ( 'site-rating' === $field_name ) {
				
			if ( 'style-plain-singular' === $style OR 'style-squares-singular' === $style OR 'style-circles-singular' === $style OR 'style-gauge-circles-singular' === $style ) {
				$show_your_user_rating_text = 1;
			} else {
				$show_your_user_rating_text = 0;
			}
				
			echo GPUR_Show_Rating::gpur_show_rating( get_the_ID(), 'post', 
				array(
					'data' => 'site-rating',
					'criteria' => $site_criteria,
					'max_rating' => $site_max_rating,
					'format' => 'format-column',
					'style' => $style,
					'position' => 'position-center',
					'show_avg_user_rating_text' => 0,
					'show_your_user_rating_text' => $show_your_user_rating_text,
					'show_maximum_rating_text' => $show_maximum_rating_text,
					'show_user_votes_text' => 0,		
					'show_ranges_text' => 0,
					'show_zero_rating' => $show_zero_rating,
					'rating_image' => $rating_image,
					'empty_icon' => $empty_icon,
					'empty_icon_color' => $empty_icon_color,
					'filled_icon' => $filled_icon,
					'filled_icon_color' => $filled_icon_color,
					'icon_width' => $icon_width,
					'icon_height' => $icon_height,
					'rating_width' => $rating_width,
					'rating_height' => $rating_height,
					'rating_text_size' => $rating_text_size,
					'rating_text_color' => $rating_text_color,
					'rating_background_color' => $rating_background_color,
					'rating_border_width' => $rating_border_width,
					'rating_border_color' => $rating_border_color,
					'rating_extra_css' => $rating_extra_css,
					'gauge_width' => $gauge_width,
					'gauge_filled_color_1' => $gauge_filled_color_1,
					'gauge_filled_color_2' => $gauge_filled_color_2,
					'gauge_empty_color' => $gauge_empty_color,
					'criteria_title_size' => $criteria_title_size,						
					'criteria_title_color' => $criteria_title_color,						
					'criteria_title_extra_css' => $criteria_title_extra_css,
					'maximum_rating_text_size' => $maximum_rating_text_size,
					'maximum_rating_text_color' => $maximum_rating_text_color,
					'maximum_rating_text_extra_css' => $maximum_rating_text_extra_css,
				) 
			);
		
		} elseif ( 'user-rating' === $field_name ) {
				
			if ( 'style-plain-singular' === $style OR 'style-squares-singular' === $style OR 'style-circles-singular' === $style OR 'style-gauge-circles-singular' === $style ) {
				$show_your_user_rating_text = 1;
			} else {
				$show_your_user_rating_text = 0;
			}
	
			echo GPUR_Show_Rating::gpur_show_rating( get_the_ID(), 'post', 
				array(
					'data' => 'user-rating',
					'criteria' => $user_criteria,
					'max_rating' => $user_max_rating,
					'format' => 'format-column',
					'style' => $style,
					'position' => 'position-center',
					'show_avg_user_rating_text' => 0,
					'show_your_user_rating_text' => $show_your_user_rating_text,
					'show_maximum_rating_text' => $show_maximum_rating_text,
					'show_user_votes_text' => 0,		
					'show_ranges_text' => 0,
					'show_zero_rating' => $show_zero_rating,
					'rating_image' => $rating_image,
					'empty_icon' => $empty_icon,
					'empty_icon_color' => $empty_icon_color,
					'filled_icon' => $filled_icon,
					'filled_icon_color' => $filled_icon_color,
					'icon_width' => $icon_width,
					'icon_height' => $icon_height,
					'rating_width' => $rating_width,
					'rating_height' => $rating_height,
					'rating_text_size' => $rating_text_size,
					'rating_text_color' => $rating_text_color,
					'rating_background_color' => $rating_background_color,
					'rating_border_width' => $rating_border_width,
					'rating_border_color' => $rating_border_color,
					'rating_extra_css' => $rating_extra_css,
					'gauge_width' => $gauge_width,
					'gauge_filled_color_1' => $gauge_filled_color_1,
					'gauge_filled_color_2' => $gauge_filled_color_2,
					'gauge_empty_color' => $gauge_empty_color,
					'criteria_title_size' => $criteria_title_size,						
					'criteria_title_color' => $criteria_title_color,						
					'criteria_title_extra_css' => $criteria_title_extra_css,
					'maximum_rating_text_size' => $maximum_rating_text_size,
					'maximum_rating_text_color' => $maximum_rating_text_color,
					'maximum_rating_text_extra_css' => $maximum_rating_text_extra_css,
				) 
			);			
		
		} elseif ( 'user-votes' === $field_name ) {
		
			echo absint( get_post_meta( get_the_ID(), $user_votes_meta_key, true ) );	

		} elseif ( 'likes' === $field_name ) {

			echo absint( apply_filters( 'gpur_up_votes', get_post_meta( get_the_ID(), $up_votes_meta_key, true ) ) );
			
		} elseif ( 'dislikes' === $field_name ) {

			echo absint( apply_filters( 'gpur_down_votes', get_post_meta( get_the_ID(), $down_votes_meta_key, true ) ) );
			
		} elseif ( 'summary' === $field_name ) {
		
			if ( $summary = get_post_meta( get_the_ID(), $summary_meta_key, true ) ) {		
				$ellipses = apply_filters( 'gpur_ellipses', '...' );
				if ( $summary_length != '' ) {
					if ( mb_strlen( $summary ) > $summary_length ) {
						$summary = mb_substr( $summary, 0, $summary_length ) . $ellipses;
					}
				}
				echo wp_kses_post( $summary );
			}
			
		} elseif ( 'excerpt' === $field_name ) {

			if ( $excerpt = strip_tags( get_post_meta( get_the_ID(), $excerpt_meta_key, true ) ) ) {		
				$ellipses = apply_filters( 'gpur_ellipses', '...' );
				if ( $excerpt_length != '' ) {
					if ( mb_strlen( $excerpt ) > $excerpt_length ) {
						$excerpt = mb_substr( $excerpt, 0, $excerpt_length ) . $ellipses;
					}
				}
				echo wp_kses_post( $excerpt );
			}

		} elseif ( 'good-points' === $field_name ) {

			echo do_shortcode( '[gpur_good_points 
			title=""
			icon="' . $good_icon . '"
			icon_size="' . $good_icon_size . '"
			icon_color="' . $good_icon_color . '"
			icon_extra_css="' . $good_icon_extra_css . '"
			text_size="' . $good_text_size . '"
			text_color="' . $good_text_color . '"
			text_extra_css="' . $good_text_extra_css . '"
			]' ); 
				
		
		} elseif ( 'bad-points' === $field_name ) {
	
			echo do_shortcode( '[gpur_bad_points 
			title=""
			icon="' . $bad_icon . '"
			icon_size="' . $bad_icon_size . '"
			icon_color="' . $bad_icon_color . '"
			icon_extra_css="' . $bad_icon_extra_css . '"
			text_size="' . $bad_text_size . '"
			text_color="' . $bad_text_color . '"
			text_extra_css="' . $bad_text_extra_css . '"
			]' ); 
		
		} elseif ( 'button' === $field_name ) {
	
			if ( get_post_meta( get_the_ID(), 'gpur_review_button_link', true ) ) {
				if ( get_post_meta( get_the_ID(), 'gpur_review_button_text', true ) ) {
					$new_button_text = get_post_meta( get_the_ID(), 'gpur_review_button_text', true );
				} else {
					$new_button_text = $button_text;
				}
				echo do_shortcode( '[gpur_review_button 
				text="' . $new_button_text . '" 
				link="' . get_post_meta( get_the_ID(), 'gpur_review_button_link', true ) . '"			
				button_padding_width="' . $button_padding_width . '"
				button_padding_height="' . $button_padding_height . '"
				button_color="' . $button_color . '"
				button_hover_color="' . $button_hover_color . '"
				text_size="' . $button_text_size . '"
				text_color="' . $button_text_color . '"
				text_hover_color="' . $button_text_hover_color . '"
				border_width="' . $button_border_width . '"
				border_radius="' . $button_border_radius . '"
				border_color="' . $button_border_color . '"
				border_hover_color="' . $button_border_hover_color . '"
				button_alignment="button-center"
				icon="' . $button_icon . '"
				icon_size="' . $button_icon_size . '"
				icon_color="' . $button_icon_color . '"
				icon_hover_color="' . $button_icon_hover_color . '"
				icon_alignment="' . $button_icon_alignment . '"
				]' ); 
			}	
				
		} elseif ( 'custom-field' === $field_name ) {
				
			if ( isset( $meta_key ) && ! is_array( $meta_key ) ) {
				$meta_value = get_post_meta( get_the_ID(), $meta_key, true );
				echo apply_filters( 'gpur_comparison_table_custom_field_' . $meta_key, $meta_value, $meta_key );
			}
						
		}
		
	}
	
}			