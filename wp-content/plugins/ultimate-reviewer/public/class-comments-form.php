<?php if ( ! class_exists( 'GPUR_Comments_Form' ) ) {
	class GPUR_Comments_Form {

		public function __construct() {
			if ( 'enabled' === gpur_option( 'comment_form_review_support' ) ) {
				add_filter( 'comments_template', array( $this, 'comments_template' ) );
				add_action( 'comment_form_logged_in_after', array( $this, 'additional_comment_fields' ) );
				add_action( 'comment_form_before_fields', array( $this, 'additional_comment_fields' ) );
				add_filter( 'comment_form_fields', array( $this, 'move_textarea_to_bottom' ) );
				add_filter( 'comment_form_defaults', array( $this, 'modify_comment_textarea' ) );
				add_filter( 'comment_text', array( $this, 'modify_comment_text' ), 10, 2 );				
				add_filter( 'get_avatar_comment_types', array( $this, 'avatar_comment_types' ) );
			}
			add_action( 'comment_form_before', array( $this, 'comment_form_before' ) );
			add_action( 'comment_form_after', array( $this, 'comment_form_after' ) );
		}

		/**
		 * Override theme's comments.php file
		 *
		 */
		public function comments_template( $template ) {
			
			if ( defined( 'AARDVARK_THEME_VERSION' ) ) {
				$template_name = 'aardvark';
			} else {
				$template_name = 'default';
			}
			
			return plugin_dir_path( __FILE__ ) . '/templates/' . esc_attr( $template_name ) . '/comments-template.php';
		}
					
		/**
		 * Add custom comment review fields
		 *
		 */		
		public function additional_comment_fields() {

    		if ( 'enabled' === gpur_option( 'comment_form_review_title' ) ) {
		
				// Max length
				$max_length = '';
				if ( '' !== gpur_option( 'comment_form_title_length' ) ) {
					$max_length = gpur_option( 'comment_form_title_length' );
				}

				// Character limit
				$character_limit_message = '';
				if ( $max_length != '' ) {
					$character_limit_message = '<span class="gpur-character-limit-message">' . str_replace( '%NUMBER%', '<span class="gpur-characters-remaining">' . $max_length . '</span>', gpur_option( 'comment_form_character_limit_label' ) ) . '</span>';
				}
				
    			echo '<p class="gpur-comment-form-title"><label for="title">' . esc_html__( gpur_option( 'comment_form_review_title_field_label' ) ) . '</label><input id="gpur-comment-form-title" name="gpur_title" type="text" size="30" maxlength="' . esc_attr( $max_length ) . '" tabindex="5" required />' . wp_kses_post( $character_limit_message ) . '</p>';
		
			}

			// Comment/rating limit
			if ( 'one-rating-multi-comments' === gpur_option( 'comment_form_comment_rating_limit' ) ) {
				if ( ( isset( $_COOKIE['gpur_user_rating_' . get_the_ID()] ) && ! is_user_logged_in() ) OR get_user_meta( get_current_user_id(), gpur_get_ind_user_rating( get_the_ID() ), true ) ) {
					$show = 'no';
				} else {
					$show = 'yes';
				}
			} else {
				$show = 'yes';
			}

			if ( 'yes' === $show ) {
			
				echo GPUR_Add_User_Ratings::gpur_add_user_ratings( 
					'', 
					'comment',
					array(
						'title' => gpur_option( 'comment_form_rating_field_label' ),
						'permissions' => gpur_option( 'comment_form_rating_permissions' ), 
						'permission_roles' => gpur_option( 'comment_form_rating_permission_roles' ),
						'criteria' => gpur_option( 'comment_form_criteria' ), 
						'min_rating' => gpur_option( 'comment_form_min_rating' ), 
						'max_rating' => gpur_option( 'comment_form_max_rating' ), 
						'step' => gpur_option( 'comment_form_step' ), 
						'fractions' => gpur_option( 'comment_form_fractions' ), 
						'format' => gpur_option( 'comment_form_format' ), 
						'style' => gpur_option( 'comment_form_style' ),
						'show_avg_user_rating_text' => 0,
						'show_your_user_rating_text' => gpur_option( 'comment_form_show', 'your_user_rating_text' ), 
						'show_maximum_rating_text' => gpur_option( 'comment_form_show', 'maximum_rating_text' ),
						'show_user_votes_text' => 0,
						'text_position' => gpur_option( 'comment_form_text_position' ),
						'rating_image' => gpur_option( 'comment_form_rating_image' ),			
						'empty_icon' => gpur_option( 'comment_form_icons', 'empty_icon' ), 
						'empty_icon_color' => gpur_option( 'comment_form_icon_styling', 'empty_icon_color' ),
						'filled_icon' => gpur_option( 'comment_form_icons', 'empty_filled' ),
						'filled_icon_color' => gpur_option( 'comment_form_icon_styling', 'filled_icon_color' ),
						'icon_width' => gpur_option( 'comment_form_icon_styling', 'icon_width' ),
						'icon_height' => gpur_option( 'comment_form_icon_styling', 'icon_height' ),
						'criteria_title_size' => gpur_option( 'comment_form_criteria_title', 'size' ),
						'criteria_title_color' => gpur_option( 'comment_form_criteria_title', 'color' ),
						'criteria_title_extra_css' => gpur_option( 'comment_form_criteria_title', 'extra_css' ),
						'your_user_rating_text_size' => gpur_option( 'comment_form_your_user_rating_text', 'size' ),
						'your_user_rating_text_color' => gpur_option( 'comment_form_your_user_rating_text', 'color' ),
						'your_user_rating_text_extra_css' => gpur_option( 'comment_form_your_user_rating_text', 'extra_css' ),
						'your_user_rating_label' => gpur_option( 'comment_form_your_user_rating_label' ),
						'logged_in_to_vote_label' => gpur_option( 'comment_form_logged_in_to_vote_label' ),
						'single_success_message' => gpur_option( 'comment_form_single_success_message' ),
						'single_error_message' => gpur_option( 'comment_form_single_error_message' ),
						'multi_success_message' => gpur_option( 'comment_form_multi_success_message' ),
						'multi_error_message' => gpur_option( 'comment_form_multi_error_message' ),
					) 
				);
				
			}		

		}

		/**
		 * Move comment textarea below other fields
		 *
		 */	
		public function move_textarea_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;
			return $fields;
		} 

		/**
		 * Modify comment textarea field
		 *
		 */		
		public function modify_comment_textarea( $field ) {

			// Max length
			$max_length = '';
			if ( gpur_option( 'comment_form_text_length' ) != '' ) {
				$max_length = gpur_option( 'comment_form_text_length' );
			}

			// Character limit
			$character_limit_message = '';
			if ( $max_length != '' ) {
				$character_limit_message = '<span class="gpur-character-limit-message">' . str_replace( '%NUMBER%', '<span class="gpur-characters-remaining">' . esc_attr( $max_length ) . '</span>', esc_html__( gpur_option( 'comment_form_character_limit_label' ) ) ) . '</span>';
			}
		
			$field['comment_field'] = '<p class="comment-form-comment"><label for="comment">Comment' . esc_html__( gpur_option( 'comment_form_review_text_field_label' ) ) . '</label><textarea id="comment" name="comment" cols="45" rows="5" maxlength="' . esc_attr( $max_length ) . '" aria-required="true"></textarea>' . wp_kses_post( $character_limit_message ) . '</p>';
	
			return $field;
		}

		/**
		 * Add content before the comment form
		 *
		 */				
		public function comment_form_before() {			

			if ( ( 'disallowed' === gpur_permissions( gpur_option( 'comment_form_permissions' ), gpur_option( 'comment_form_permission_roles' ) ) ) OR ( 'enabled' === gpur_option( 'comment_form_review_support' ) && ( 'one-rating-one-comment' === gpur_option( 'comment_form_comment_rating_limit' ) && ( ( isset( $_COOKIE['gpur_user_rating_' . get_the_ID()] ) && ! is_user_logged_in() ) OR get_user_meta( get_current_user_id(), gpur_get_ind_user_rating( get_the_ID() ), true ) ) ) ) ) {
				echo '<div class="gpur-hide">';
			}
				
		}
		
		/**
		 * Add content after the comment form
		 *
		 */		
		public function comment_form_after() {

			// Get correct meta keys
			$ind_user_rating_meta_key = gpur_get_ind_user_rating( get_the_ID() );
		
			// Closing div tag to hide comment form
			if ( ( 'disallowed' === gpur_permissions( gpur_option( 'comment_form_permissions' ), gpur_option( 'comment_form_permission_roles' ) ) ) OR ( 'enabled' === gpur_option( 'comment_form_review_support' ) && ( 'one-rating-one-comment' === gpur_option( 'comment_form_comment_rating_limit' ) && ( ( isset( $_COOKIE['gpur_user_rating_' . get_the_ID()] ) && ! is_user_logged_in() ) OR get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) ) ) ) {
				echo '</div>';
			}

			// Success/error messages
			echo '<span class="gpur-success">' . gpur_option( 'comment_form_single_success_message' ) . '</span>';
			echo '<span class="gpur-error"></span>';
	
			// Can't comment again messages
			
			if ( 'enabled' === gpur_option( 'comment_form_review_support' ) && ( 'one-rating-one-comment' === gpur_option( 'comment_form_comment_rating_limit' ) && ( ( isset( $_COOKIE['gpur_user_rating_' . get_the_ID()] ) && ! is_user_logged_in() ) OR get_user_meta( get_current_user_id(), $ind_user_rating_meta_key, true ) ) ) ) {
			
				echo '<div class="gpur-already-voted">' . esc_attr( gpur_option( 'comment_form_already_voted_label' ) ) . '</div>';
	
			} elseif ( 'disallowed' === gpur_permissions( gpur_option( 'comment_form_permissions' ), gpur_option( 'comment_form_permission_roles' ) ) ) {

				echo '<div class="gpur-already-voted">' . esc_attr( gpur_option( 'comment_form_logged_in_to_vote_label' ) ) . '</div>';
		
			}
			
		}

		/**
		 * Add avatars on review comment type
		 *
		 */
		public function avatar_comment_types( $types ) {
			$types[] = 'review';
			return $types;
		}
		
		/**
		 * Display summary of each rating score
		 *
		 */
		public static function gpur_display_rating_summary( $post_id ) {

			$output = '<div class="gpur-rating-summary">';
		
				// Average rating
				$output .= GPUR_Show_Rating::gpur_show_rating( 
					$post_id, 
					'post',
					array(
						'data' => 'user-rating',
						'max_rating' => gpur_option( 'comment_form_max_rating' ),
						'rich_snippets' => gpur_option( 'comment_summary_avg_rich_snippets' ),
						'style' => gpur_option( 'comment_summary_avg_style' ),
						'show_avg_user_rating_text' => gpur_option( 'comment_summary_avg_show', 'average_user_rating_text' ),
						'show_your_user_rating_text' => 0,
						'show_maximum_rating_text' => gpur_option( 'comment_summary_avg_show', 'maximum_rating_text' ),
						'show_user_votes_text' => gpur_option( 'comment_summary_avg_show', 'user_votes_text' ),		
						'show_ranges_text' => 0,
						'show_zero_rating' => gpur_option( 'comment_summary_avg_show', 'zero_ratings' ),
						'rating_image' => gpur_option( 'comment_summary_avg_rating_image' ),
						'empty_icon' => gpur_option( 'comment_summary_avg_icons', 'empty-icon' ),
						'empty_icon_color' => gpur_option( 'comment_summary_avg_icon_styling', 'empty_icon_color' ),
						'filled_icon' => gpur_option( 'comment_summary_avg_icons', 'filled_icon' ),
						'filled_icon_color' => gpur_option( 'comment_summary_avg_icon_styling', 'filled_icon_color' ),
						'icon_width' => gpur_option( 'comment_summary_avg_icon_styling', 'icon_width' ),
						'icon_height' => gpur_option( 'comment_summary_avg_icon_styling', 'icon_height' ),
						'rating_width' => gpur_option( 'comment_summary_avg_rating_container', 'width' ),
						'rating_height' => gpur_option( 'comment_summary_avg_rating_container', 'height' ),
						'rating_text_size' => gpur_option( 'comment_summary_avg_rating_container', 'text_size' ),
						'rating_text_color' => gpur_option( 'comment_summary_avg_rating_container', 'text_color' ),
						'rating_background_color' => gpur_option( 'comment_summary_avg_rating_container', 'background_color' ),
						'rating_border_width' => gpur_option( 'comment_summary_avg_rating_container', 'border_width' ),
						'rating_border_color' => gpur_option( 'comment_summary_avg_rating_container', 'border_color' ),
						'rating_extra_css' => gpur_option( 'comment_summary_avg_rating_container', 'extra_css' ),
						'gauge_width' => gpur_option( 'comment_summary_avg_gauge', 'width' ),
						'gauge_filled_color_1' => gpur_option( 'comment_summary_avg_gauge', 'filled_color_1' ),
						'gauge_filled_color_2' => gpur_option( 'comment_summary_avg_gauge', 'filled_color_2' ),
						'gauge_empty_color' => gpur_option( 'comment_summary_avg_gauge', 'empty_color' ),
						'avg_user_rating_text_size' => gpur_option( 'comment_summary_avg_average_user_rating_text', 'size' ),
						'avg_user_rating_text_color' => gpur_option( 'comment_summary_avg_average_user_rating_text', 'color' ),
						'avg_user_rating_text_extra_css' => gpur_option( 'comment_summary_avg_average_user_rating_text', 'extra_css' ),
						'maximum_rating_text_size' => gpur_option( 'comment_summary_avg_maximum_rating_text', 'size' ),
						'maximum_rating_text_color' => gpur_option( 'comment_summary_avg_maximum_rating_text', 'color' ),
						'maximum_rating_text_extra_css' => gpur_option( 'comment_summary_avg_maximum_rating_text', 'extra_css' ),
						'user_votes_text_size' => gpur_option( 'comment_summary_avg_user_votes_text', 'size' ),
						'user_votes_text_color' => gpur_option( 'comment_summary_avg_user_votes_text', 'color' ),
						'user_votes_text_extra_css' => gpur_option( 'comment_summary_avg_user_votes_text', 'extra_css' ),
						'avg_user_rating_label' => gpur_option( 'comment_summary_avg_avg_user_rating_label' ),
						'singular_vote_label' => gpur_option( 'comment_summary_avg_singular_vote_label' ),
						'plural_vote_label' => gpur_option( 'comment_summary_avg_plural_vote_label' ),
					) 
				);

				// Ratings breakdown
				$fractions = ( 1 / gpur_option( 'comment_form_fractions' ) );

				// Get total number of comment ratings (user votes excluding review template votes)
				$args = array(
					'post_id' => $post_id,
					'type' => 'review',
					'meta_key' => 'gpur_avg_rating',
					'meta_query' => array(
						'key' => 'gpur_avg_rating',
						'compare' => '=',
						'type' => 'NUMERIC',
					),
					'status' => 'approve',
					'count' => true,
				);
				$user_votes = get_comments( $args );
			
				for( $i = gpur_option( 'comment_form_max_rating' ); $i >= gpur_option( 'comment_form_min_rating' ); $i -= $fractions ) {
					
					// Count number of comments with current rating
					$args = array(
						'post_id' => $post_id,
						'type' => 'review',
						'meta_key' => 'gpur_avg_rating',
						'meta_query' => array(
							'key' => 'gpur_avg_rating',
							'value' => $i,
							'compare' => '=',
							'type' => 'NUMERIC',
						),
						'status' => 'approve',
						'count' => true,
					);
					$current_rating = get_comments( $args );
					
					// Get correct meta keys
					//REMOVE$user_votes_meta_key = gpur_get_user_votes( $post_id );
					//REMOVE$user_votes = get_post_meta( $post_id, $user_votes_meta_key, true );						

					if ( $current_rating > 0 && $user_votes > 0 ) {
						$percentage = round( ( $current_rating / $user_votes ) * 100 );	
					} else {
						$percentage = 0;
					}
					
					$output .= '<div class="gpur-summary-entry">';
					
						$output .= '<div class="gpur-rating-summary-score">' . floatval( $i ) . '</div>';
						
						$output .= GPUR_Show_Rating::gpur_show_rating( 
							$post_id, 
							'comment',
							array(
								'data' => 'custom',
								'value' => ( $current_rating > 0 && $user_votes > 0 ) ? ( $current_rating / $user_votes ) * gpur_option( 'comment_form_max_rating' ) : 0,
								'max_rating' => gpur_option( 'comment_form_max_rating' ),
								'style' => gpur_option( 'comment_summary_breakdown_style' ),
								'text_position' => 'position-text-left',
								'show_avg_user_rating_text' => 0,
								'show_your_user_rating_text' => 0,
								'show_maximum_rating_text' => 0,
								'show_user_votes_text' => 0,		
								'show_ranges_text' =>0,
								'show_zero_rating' => 1,
								'rating_image' => gpur_option( 'comment_summary_breakdown_image' ),
								'empty_icon' => gpur_option( 'comment_summary_breakdown_icons', 'empty_icon' ),
								'empty_icon_color' => gpur_option( 'comment_summary_breakdown_icon_styling', 'empty_icon_color' ),
								'filled_icon' => gpur_option( 'comment_summary_breakdown_icons', 'filled_icon' ),
								'filled_icon_color' => gpur_option( 'comment_summary_breakdown_icon_styling', 'filled_icon_color' ),
								'icon_width' => gpur_option( 'comment_summary_breakdown_icon_styling', 'icon_width' ),
								'icon_height' => gpur_option( 'comment_summary_breakdown_icon_styling', 'icon_height' ),
							) 
						);

						$output .= '<div class="gpur-rating-summary-percentage">' . esc_attr( $percentage ) . '%</div>';

					$output .= '</div>';
					
					$output .= '<div class="gpur-clear"></div>';
		
				}	
		
			$output .= '</div>';
		
			return $output;
		
		}
	
		/**
		 * Modify comment entries
		 *
		 */			
		public static function modify_comment_text( $text, $comment ) {
	
			$output = '<div class="gpur-comment">';
	
				if ( get_comment_meta( $comment->comment_ID, 'gpur_avg_rating', true ) ) {
				
					// Get rating
					$output .= GPUR_Show_Rating::gpur_show_rating( 
						$comment->comment_ID, 
						'comment',
						array(
							'data' => 'comment-rating',
							'criteria' => gpur_option( 'comment_form_criteria' ),
							'max_rating' => gpur_option( 'comment_form_max_rating' ),
							'format' => gpur_option( 'comment_rating_format' ),
							'style' => gpur_option( 'comment_rating_style' ),
							'show_avg_user_rating_text' => 0,
							'show_your_user_rating_text' => gpur_option( 'comment_rating_show', 'your_user_rating_text' ),
							'show_maximum_rating_text' => gpur_option( 'comment_rating_show', 'maximum_rating_text' ),
							'show_user_votes_text' => 0,
							'show_ranges_text' => 0,			
							'show_zero_rating' => gpur_option( 'comment_rating_show', 'zero_ratings' ),
							'text_position' => gpur_option( 'comment_rating_text_position' ),
							'rating_image' => gpur_option( 'comment_rating_rating_image' ),
							'empty_icon' => gpur_option( 'comment_rating_icons', 'empty_icon' ),
							'empty_icon_color' => gpur_option( 'comment_rating_icon_styling', 'empty_icon_color' ),
							'filled_icon' => gpur_option( 'comment_rating_icons', 'filled_icon' ),
							'filled_icon_color' => gpur_option( 'comment_rating_icon_styling', 'filled_icon_color' ),
							'icon_width' => gpur_option( 'comment_rating_icon_styling', 'icon_width' ),
							'icon_height' => gpur_option( 'comment_rating_icon_styling', 'icon_height' ),
							'rating_width' => gpur_option( 'comment_rating_rating', 'width' ),
							'rating_height' => gpur_option( 'comment_rating_rating', 'height' ),
							'rating_text_color' => gpur_option( 'comment_rating_rating', 'text_size' ),
							'rating_text_color' => gpur_option( 'comment_rating_rating', 'text_color' ),	
							'rating_background_color' => gpur_option( 'comment_rating_rating_container', 'background_color' ),
							'rating_border_width' => gpur_option( 'comment_rating_rating_container', 'border_width' ),
							'rating_border_color' => gpur_option( 'comment_rating_rating_container', 'border_color' ),
							'rating_extra_css' => gpur_option( 'comment_rating_rating_container', 'extra_css' ),
							'gauge_width' => gpur_option( 'comment_rating_gauge', 'width' ),
							'gauge_filled_color_1' => gpur_option( 'comment_rating_gauge', 'filled_color_1' ),
							'gauge_filled_color_2' => gpur_option( 'comment_rating_gauge', 'filled_color_2' ),
							'gauge_empty_color' => gpur_option( 'comment_rating_gauge', 'empty_color' ),
							'criteria_title_size' => gpur_option( 'comment_rating_criteria_title', 'size' ),
							'criteria_title_color' => gpur_option( 'comment_rating_criteria_title', 'color' ),
							'criteria_title_extra_css' => gpur_option( 'comment_rating_criteria_title', 'extra_css' ),
							'your_user_rating_text_size' => gpur_option( 'comment_rating_your_user_rating_text', 'size' ),
							'your_user_rating_text_color' => gpur_option( 'comment_rating_your_user_rating_text', 'color' ),
							'your_user_rating_extra_css' => gpur_option( 'comment_rating_your_user_rating_text', 'extra_css' ),
							'maximum_rating_text_size' => gpur_option( 'comment_rating_maximum_rating_text', 'size' ),
							'maximum_rating_text_color' => gpur_option( 'comment_rating_maximum_rating_text', 'color' ),
							'maximum_rating_text_extra_css' => gpur_option( 'comment_rating_maximum_rating_text', 'extra_css' ),
							'your_user_rating_label' => gpur_option( 'comment_rating_your_user_rating_label' ),
						) 
					);
				
				}
								
				$ellipses = apply_filters( 'gpur_ellipses', '...' );
					
				// Get review title
				if ( 'enabled' === gpur_option( 'comment_form_review_title' ) ) {
					if ( $title = get_comment_meta( $comment->comment_ID, 'gpur_title', true ) ) {		
						if ( $length = gpur_option( 'comment_form_title_length' ) != '' ) {
							if ( mb_strlen( $title ) > $length ) {
								$title = mb_substr( $title, 0, $length ) . $ellipses;
							}
						}
						$output .= '<div class="gpur-comment-review-title">' . esc_attr( $title ) . '</div>';
					}
				}
					
				// Get review text
				if ( $text ) {
					$length = gpur_option( 'comment_form_text_length' );
					if ( '' !== $length ) {	
						if ( mb_strlen( $text ) > $length ) {	
							$text = mb_substr( $text, 0, $length ) . $ellipses;
						}
					}	
					$output .= '<div class="gpur-comment-review-text">' . esc_attr( $text ) . '</div>';
				}

				// Get up/down voting
				$output .= GPUR_Up_Down_Voting::gpur_up_down_voting( 
					$comment->comment_ID, 
					'comment',
					array(
						'permissions' => gpur_option( 'comment_udv_permissions' ),
						'permission_roles' =>gpur_option( 'comment_udv_permission_roles' ),
						'style' => gpur_option( 'comment_udv_style' ),	
						'counter_position' => gpur_option( 'comment_udv_counter_position' ),
						'up_icon' => gpur_option( 'comment_udv_up_icon', 'icon' ),
						'up_icon_size' => gpur_option( 'comment_udv_up_icon', 'icon_size' ),
						'up_icon_color' => gpur_option( 'comment_udv_up_icon', 'icon_color' ),
						'up_icon_color_voted' => gpur_option( 'comment_udv_up_icon', 'icon_color_voted' ),
						'up_button_size' => gpur_option( 'comment_udv_up_icon', 'button_size' ),
						'up_button_color' => gpur_option( 'comment_udv_up_icon', 'button_color' ),
						'up_button_color_voted' => gpur_option( 'comment_udv_up_icon', 'button_color_voted' ),
						'up_counter_size' => gpur_option( 'comment_udv_up_icon', 'counter_size' ),
						'up_counter_color' => gpur_option( 'comment_udv_up_icon', 'counter_color' ),			
						'down_icon' => gpur_option( 'comment_udv_down_icon', 'icon' ),
						'down_icon_size' => gpur_option( 'comment_udv_down_icon', 'icon_size' ),
						'down_icon_color' => gpur_option( 'comment_udv_down_icon', 'icon_color' ),
						'down_icon_color_voted' => gpur_option( 'comment_udv_down_icon', 'icon_color_voted' ),
						'down_button_size' => gpur_option( 'comment_udv_down_icon', 'button_size' ),
						'down_button_color' => gpur_option( 'comment_udv_down_icon', 'button_color' ),
						'down_button_color_voted' => gpur_option( 'comment_udv_down_icon', 'button_color_voted' ),
						'down_counter_size' => gpur_option( 'comment_udv_down_icon', 'counter_size' ),
						'down_counter_color' => gpur_option( 'comment_udv_down_icon', 'counter_color' ),
						'already_voted_text_size' => gpur_option( 'comment_udv_already_voted_text', 'color' ),
						'already_voted_text_color' => gpur_option( 'comment_udv_already_voted_tex', 'size' ),
						'already_voted_text_extra_css' => gpur_option( 'comment_udv_already_voted_text', 'extra_css' ),
						'already_voted_label' => gpur_option( 'comment_udv_already_voted_label' ),
					) );
				
				$output .= '<div class="gpur-clear"></div>';
			
			$output .= '</div>';
					
			return $output;
 
		}
	
	}
}
new GPUR_Comments_Form();	