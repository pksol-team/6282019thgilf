<?php if ( ! class_exists( 'GPUR_Reviews_List' ) ) {
	class GPUR_Reviews_List {

		public function __construct() {}

		public static function gpur_reviews_list( $post_id, $meta, $args ) {

			$defaults = array( 
				'title' => '',
				'post_types' => 'post',
				'ids' => '',
				'cats' => '',
				'tags' => '',
				'current_tax' => '',
				'sort' => 'post-date-desc',
				'number' => 5,
				'exclude_current_item' => '',
				'post_format' => 'gpur-format-list',
				'show_ranking' => '',
				'show_image' => 1,
				'show_title' => 1,
				'show_name' => 1,
				'show_date' => 1,
				'show_comments' => '',
				'show_likes' => '',
				'show_site_rating' => 1,
				'show_user_rating' => 1,
				'show_excerpt' => 1,
				'show_view_link' => '',
				'image_source' => 'featured-image',
				'image_size' => '75 x 75',
				'title_length' => '',
				'excerpt_length' => 200,
				'ratings_position' => 'gpur-ratings-below',
				'posts_border_color' => '',
				'site_criteria' => '',
				'site_max_rating' => '',
				'user_criteria' => '',
				'user_max_rating' => '',
				'format' => 'format-rows',
				'style' => 'style-stars',
				'position' => 'position-left',
				'text_position' => 'position-text-bottom',
				'show_avg_user_rating_text' => '',
				'show_your_user_rating_text' => '',
				'show_maximum_rating_text' => '',				
				'show_user_votes_text' => '',
				'show_ranges_text' => '',
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
				'css' => '',
			);
			
			$args = wp_parse_args( $args, $defaults );
			
			extract( $args );

			// Unique ID
			$unique_id = 'gpur_' . uniqid();

			// Get correct meta keys
			$avg_user_rating_meta_key = gpur_get_avg_user_rating( get_the_ID() );
			$user_votes_meta_key = gpur_get_user_votes( get_the_ID() );
			$user_sum_meta_key = gpur_get_user_sum( get_the_ID() );
			$summary_meta_key = gpur_get_summary( get_the_ID() );
			$excerpt_meta_key = gpur_get_excerpt( get_the_ID() );
			$up_votes_meta_key = gpur_get_up_votes( get_the_ID() );
			$down_votes_meta_key = gpur_get_down_votes( get_the_ID() );			
				
			// Post types
			if ( ! is_array( $post_types ) && $post_types ) {
				$post_types = explode( ',', $post_types );
			}			

			// Post/page IDs
			if ( $ids ) {
				$ids = explode( ',', $ids );
			}
		
			// Sorting values
			$sorting = gpur_sorting( $sort );
					
			// Exclude current item
			$excluded_post_id = null;
			if ( 1 == $exclude_current_item ) {
				if ( is_singular() ) {
					$excluded_post_id = array( get_the_ID() );
				}
			}
			
			// Show current category/tag posts only
			if ( 1 == $current_tax ) {
			
				if ( is_singular() ) {
					$categories = get_the_category();
					if ( $categories ) {
						foreach ( $categories as $category ) {
							$cat_id[] = $category->cat_ID;	
						}					
						$cats = $cat_id;
					}	
				} elseif ( is_category() ) {
					$category = get_queried_object();
					if ( $category ) {
						$cat_id = $category->slug;
						$cats = $cat_id;
					}	
				} elseif ( is_tag() ) {
					$tags = get_queried_object();
					if ( $tags ) {
						$tag_id = $tag->slug;
						$tags = $tag_id;
					}	
				}
				
			}
			
			// Query						
			$query_args = array(
				'post_status'		=> 'publish',
				'post_type' 		=> $post_types,
				'post__in'	    	=> $ids,
				'post__not_in'      => $excluded_post_id,
				'category_name' 	=> $cats,
				'tag'			    => $tags,
				'orderby' 			=> $sorting['order_by'],
				'order' 	    	=> $sorting['order'],
				'meta_key' 			=> $sorting['meta_key'],
				'posts_per_page'	=> $number,
				'no_found_rows'     => true,
			);						
			$query = new WP_Query( apply_filters( 'gpur_reviews_list_query', $query_args, $args ) );
			
			// Inline CSS
			$inline_css = '';

			// Border color
			if ( $posts_border_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-format-list .gpur-reviews-list-item{border-color: ' . $posts_border_color . ';}';
			}
			
			wp_register_style( 'gpur-shortcodes', false );
			wp_enqueue_style( 'gpur-shortcodes' );
			wp_add_inline_style( 'gpur-shortcodes', $inline_css );
													
			// Classes
			$css_classes = array(
				'gpur-element-wrapper',
				'gpur-reviews-list-wrapper',
				$post_format,
			);
			$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
			$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $args );

			ob_start();
			
			echo '<div id="' . esc_attr( $unique_id ) . '" class="' . esc_attr( $css_classes ) . '">';
			
				if ( $title ) {
					echo '<h2 class="gpur-element-title">' . esc_attr( $title ) . '</h2>';
				}	
							
				if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
	
					include( plugin_dir_path( __FILE__ ) . '/templates/review-item.php' );
							
				endwhile;
				endif;
				wp_reset_postdata();
				
			echo '<div class="gpur-clear"></div></div>';
			
			$output = ob_get_contents();
			ob_end_clean();
			return $output;

		}

	}		
} 
new GPUR_Reviews_List();