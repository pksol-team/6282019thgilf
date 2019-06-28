<?php if ( ! class_exists( 'GPUR_Up_Down_Voting' ) ) {
	class GPUR_Up_Down_Voting {

		public function __construct() {		
			add_action( 'wp_ajax_gpur_up_down_voting_callback', array( $this, 'gpur_up_down_voting_callback' ) );
			add_action( 'wp_ajax_nopriv_gpur_up_down_voting_callback', array( $this, 'gpur_up_down_voting_callback' ) );
		}
		
		/**
		 * Generate up/down section
		 *
		 */	
		public static function gpur_up_down_voting( $post_id, $meta, $args ) {
		
			$defaults = array(
				'title' => '',
				'permissions' => 'all-users',
				'permission_roles' => '',
				'rich_snippets' => '',
				'style' => 'style-plain',
				'counter_position' => 'position-left-right',
				'title_size' => '',
				'title_color' => '',
				'title_extra_css' => '',
				'up_show' => 1,
				'up_icon' => 'fa fa-thumbs-o-up',
				'up_text' => '',
				'up_icon_size' => '',
				'up_icon_color' => '',
				'up_icon_color_voted' => '',
				'up_button_size' => '',
				'up_button_color' => '',
				'up_button_color_voted' => '',
				'up_counter_size' => '',
				'up_counter_color' => '',
				'down_show' => 1,
				'down_icon' => 'fa fa-thumbs-o-down',
				'down_text' => '',
				'down_icon_size' => '',
				'down_icon_color' => '',
				'down_icon_color_voted' => '',
				'down_button_size' => '',
				'down_button_color' => '',
				'down_button_color_voted' => '',
				'down_counter_size' => '',
				'down_counter_color' => '',
				'already_voted_text_size' => '',
				'already_voted_text_color' => '',
				'already_voted_text_extra_css' => '',
				'already_voted_label' => esc_html__( 'You have already voted.', 'gpur' ),
				'css' => '',
			);		
						
			$args = wp_parse_args( $args, $defaults );
				
			extract( $args );

			// Unique ID
			$unique_id = 'gpur_' . uniqid();
			
			// Get correct meta keys
			$up_votes_meta_key = gpur_get_up_votes( $post_id );
			$down_votes_meta_key = gpur_get_down_votes( $post_id );
			$summary_meta_key = gpur_get_summary( $post_id );
			$excerpt_meta_key = gpur_get_excerpt( $post_id );
						
			if ( 'comment' === $meta ) {
			
				$up_count = get_comment_meta( $post_id, 'gpur_up_votes', true ) != '' ? get_comment_meta( $post_id, 'gpur_up_votes', true ) : 0;

				$down_count = get_comment_meta( $post_id, 'gpur_down_votes', true ) != '' ? get_comment_meta( $post_id, 'gpur_down_votes', true ) : 0;
			
			} else {
			
				$up_count = get_post_meta( $post_id, $up_votes_meta_key, true ) != '' ? get_post_meta( $post_id, $up_votes_meta_key, true ) : 0;

				$down_count = get_post_meta( $post_id, $down_votes_meta_key, true ) != '' ? get_post_meta( $post_id, $down_votes_meta_key, true ) : 0;
			
			}

			// Inline CSS
			$inline_css = '';

			// Title
			if ( $title_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {font-size: ' . ghostpool_add_units( $title_size ) . ';}';
			} 
			if ( $title_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {color: ' . esc_attr( $title_color ) . ';}';
			} 
			if ( $title_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {' . esc_attr( $title_extra_css ) . '}';
			} 
		
			// Up icon
			if ( $up_icon_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-up-vote .gpur-vote-icon:before {font-size: ' . ghostpool_add_units( $up_icon_size ) . ';}';
			}
			if ( $up_icon_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-up-vote .gpur-vote-icon:before {color: ' . esc_attr( $up_icon_color ) . ';}';
			}
			if ( $up_icon_color_voted ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-up-vote.gpur-voted .gpur-vote-icon:before, #' . esc_attr( $unique_id ) . ' .gpur-up-vote .gpur-vote-icon:hover:before {color: ' . esc_attr( $up_icon_color_voted ) . ';}';
			}
			if ( $up_button_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-up-vote .gpur-vote-icon, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-up-vote.gpur-vote-button {width: ' . ghostpool_add_units( $up_button_size ) . '; height: ' . ghostpool_add_units( $up_button_size ) . ';}';
			}
			if ( $up_button_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-up-vote .gpur-vote-icon, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-up-vote.gpur-vote-button {background-color: ' . esc_attr( $up_button_color ) . ';}';
			}
			if ( $up_button_color_voted ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-up-vote.gpur-voted .gpur-vote-icon, #' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-up-vote .gpur-vote-icon:hover, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-voting-container:not(.gpur-voted) .gpur-up-vote.gpur-vote-button:hover, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-up-vote.gpur-vote-button.gpur-voted {background-color: ' . esc_attr( $up_button_color_voted ) . ';}';
			}
			if ( $up_counter_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-up-vote .gpur-vote-count {font-size: ' . ghostpool_add_units( $up_counter_size ) . ';}';
			}
			if ( $up_counter_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-up-vote .gpur-vote-count {color: ' . esc_attr( $up_counter_color ) . ';}';
			}

			// Down icon
			if ( $down_icon_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-down-vote .gpur-vote-icon:before {font-size: ' . ghostpool_add_units( $down_icon_size ) . ';}';
			}
			if ( $down_icon_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-down-vote .gpur-vote-icon:before {color: ' . esc_attr( $down_icon_color ) . ';}';
			}
			if ( $down_icon_color_voted ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-down-vote.gpur-voted .gpur-vote-icon:before, #' . esc_attr( $unique_id ) . ' .gpur-down-vote .gpur-vote-icon:hover:before {color: ' . esc_attr( $down_icon_color_voted ) . ';}';
			}			
			if ( $down_button_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-down-vote .gpur-vote-icon, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-down-vote.gpur-vote-button {width: ' . ghostpool_add_units( $down_button_size ) . '; height: ' . ghostpool_add_units( $down_button_size ) . ';}';
			}
			if ( $down_button_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-down-vote .gpur-vote-icon, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-down-vote.gpur-vote-button {background-color: ' . esc_attr( $down_button_color ) . ';}';
			}
			if ( $down_button_color_voted ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-down-vote.gpur-voted .gpur-vote-icon, #' . esc_attr( $unique_id ) . '.gpur-style-round-buttons .gpur-down-vote .gpur-vote-icon:hover, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-voting-container:not(.gpur-voted) .gpur-down-vote.gpur-vote-button:hover, #' . esc_attr( $unique_id ) . '.gpur-style-rounded-buttons .gpur-down-vote.gpur-vote-button.gpur-voted {background-color: ' . esc_attr( $down_button_color_voted ) . ';}';
			}
			if ( $down_counter_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-down-vote .gpur-vote-count {font-size: ' . ghostpool_add_units( $down_counter_size ) . ';}';
			}
			if ( $down_counter_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-down-vote .gpur-vote-count {color: ' . esc_attr( $down_counter_color ) . ';}';
			}

			// Already voted text
			if ( $already_voted_text_size ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-error {font-size: ' . esc_attr( $already_voted_text_size ) . ';}';
			} 
			if ( $already_voted_text_color ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-error {color: ' . esc_attr( $already_voted_text_color ) . ';}';
			} 
			if ( $already_voted_text_extra_css ) {
				$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-error {' . esc_attr( $already_voted_text_extra_css ) . '}';
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
			
				$rich_snippets_js = gpur_rich_snippets( 'user-rating', array(
					'url' => esc_url( get_permalink( $post_id ) ),
					'title' => the_title_attribute( array( 'post' => $post_id, 'echo' => false ) ),
					'author' => get_the_author_meta( 'display_name' ),
					'description' => $excerpt,
					'image' => esc_url( get_the_post_thumbnail_url( 'thumbnail' ) ),
					'rating_value' => $up_count,
					'user_votes' => $up_count + $down_count,
					'max_rating' => $up_count + $down_count,
				 ) );
				 
				add_action( 'wp_footer', function() use ( $rich_snippets_js ) { //
					echo '<script type="application/ld+json">' . wp_kses_post( $rich_snippets_js ) .'</script>';
				});
				
			}
								
			// Classes
			$css_classes = array(
				'gpur-element-wrapper',
				'gpur-voting-wrapper',
				'gpur-' . $style,
				'gpur-' . $counter_position,
			);
			$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
			$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $args );
			
			ob_start();
			
			if ( 'allowed' === gpur_permissions( $permissions, $permission_roles ) ) {
				
				echo '<div id="' . esc_attr( $unique_id ) . '" class="' . esc_attr( $css_classes ) . '">';
			
					if ( $title ) {
						echo '<h2 class="gpur-element-title">' . esc_html( $title ) . '</h2>';
					}
					
					if ( $up_text ) {
						$up_text = '<div class="gpur-vote-text">' . esc_html( $up_text ) . '</div>';
					}
				
					if ( $down_text ) {
						$down_text = '<div class="gpur-vote-text">' . esc_html( $down_text ) . '</div>';
					}
				
					echo 
					'<div class="gpur-voting-container" data-content-id="' . esc_attr( $post_id ) . '" data-nonce="' . wp_create_nonce( 'gpur_up_down_voting_nonce' ) . '" data-meta="' . esc_attr( $meta ) . '">
						<div class="gpur-voting-buttons">';
			
							if ( 1 == $up_show ) {
								echo '<div class="gpur-up-vote gpur-vote-button" data-type="up">
									<div class="gpur-vote-data">
										<i class="gpur-vote-icon ' . esc_attr( $up_icon ) . '"></i>' . 
										$up_text . 
									'</div>
									<div class="gpur-vote-count">' . esc_attr( $up_count ) . '</div>
								</div>';
							}	
								
							if ( 1 == $down_show ) {		
								echo '<div class="gpur-down-vote gpur-vote-button" data-type="down">
									<div class="gpur-vote-data">
										<i class="gpur-vote-icon ' . esc_attr( $down_icon ) . '"></i>' . 
										$down_text . 
									'</div>
									<div class="gpur-vote-count">' . esc_attr( $down_count ) . '</div>
								</div>';
							}	
									
						echo '</div>
						<div class="gpur-error">' . esc_html( $already_voted_label ) . '</div>
					</div>';
				
				echo '</div>';
								
			}	
		
			$output = ob_get_contents();
			ob_end_clean();
			return $output;

		}

		/**
		 * Handle ajax request for up and down votes
		 *
		 */
		public function gpur_up_down_voting_callback() {

			// Check the nonce
			check_ajax_referer( 'gpur_up_down_voting_nonce', 'nonce' );

			// Get the POST values
			$post_id = absint( $_POST['postID'] );
			$type = sanitize_text_field( $_POST['type'] );
			$meta = sanitize_text_field( $_POST['meta'] );

			// Check the vote type
			if ( 'up' === $type ) {
				$meta_name = 'gpur_up_votes';
			} elseif ( 'down' === $type ) {
				$meta_name = 'gpur_down_votes';
			}

			// Get vote count if it already exists
			if ( 'comment' === $meta ) {
				$votes = get_comment_meta( $post_id, $meta_name, true ) != '' ? get_comment_meta( $post_id, $meta_name, true ) : 0;
			} else {
				$votes = get_post_meta( $post_id, $meta_name, true ) != '' ? get_post_meta( $post_id, $meta_name, true ) : 0;			
			}	
			
			// Add 1 to vote count
			$votes = $votes + 1;

			// Update vote count
			if ( 'comment' === $meta ) {
				update_comment_meta( $post_id, $meta_name, $votes );
			} else {
				update_post_meta( $post_id, $meta_name, $votes );
			}
			
			$results = gpur_up_down_voting( $post_id, $type );

			die( $results );

		}

	}	
} 
new GPUR_Up_Down_Voting();