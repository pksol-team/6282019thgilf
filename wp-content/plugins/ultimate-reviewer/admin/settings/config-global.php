<?php if ( ! function_exists( 'gpur_global_setting_sections' ) ) {
	function gpur_global_setting_sections( $theme_slug = '' ) {	 

		$sections = array(
		
			$theme_slug . '_general' => array(
				'id' => $theme_slug . '_general',
				'title' => esc_html__( 'General', 'gpur' ),
				'subsections' => array(				
					$theme_slug . '_general' => array(
						'title' => esc_html__( 'General', 'gpur' ),
					),
				),	
			),	
			
			$theme_slug . '_comment_form' => array(
				'id' => $theme_slug . '_comment_form',
				'title' => esc_html__( 'Comments', 'gpur' ),
				'subsections' => array(				
					$theme_slug . '_comment_form' => array(
						'title' => esc_html__( 'Comment Form', 'gpur' ),
					),
					$theme_slug . '_comment_list' => array(
						'title' => esc_html__( 'Comment List', 'gpur' ),
					),
					$theme_slug . '_comment_summary' => array(
						'title' => esc_html__( 'Comment Summary', 'gpur' ),
					),
					$theme_slug . '_comment_ratings' => array(
						'title' => esc_html__( 'Comment Ratings', 'gpur' ),
					),
					$theme_slug . '_comment_udv' => array(
						'title' => esc_html__( 'Comment Up/Down Voting', 'gpur' ),
					),
				),
			),		

			$theme_slug . '_advanced' => array(
				'id' => $theme_slug . '_advanced',
				'title' => esc_html__( 'Advanced', 'gpur' ),
				'subsections' => array(
					$theme_slug . '_advanced' => array(
						'title' => esc_html__( 'Advanced', 'gpur' ),						
						'desc' => esc_html__( 'Advanced settings for the plugin.', 'gpur' ),
					),
				),
			),	
						
		);
				
		$sections = apply_filters( 'gpur_global_setting_sections', $sections, $theme_slug );
		
		return $sections;
				
	}
}		
		
if ( ! function_exists( 'gpur_global_settings' ) ) {
	function gpur_global_settings( $theme_slug = '' ) {

		$settings = array(

			/**
			 * General tab
			 *
			 */
			array(
				'id' => 'review_post_types',
				'title' => esc_html__( 'Review Post Types', 'gpur' ),
				'section' => $theme_slug . '_general',
				'desc' => esc_html__( 'Choose which post types can have reviews.', 'gpur' ),
				'type' => 'checkbox',
				'data' => 'post_types',
				'default' => array( 'post', 'page' ),
				//'class' => 'gp-setting',
			),

			array(
				'id' => 'review_management',
				'title' => esc_html__( 'Review Management', 'gpur' ),
				'section' => $theme_slug . '_general',
				'desc' => esc_html__( 'Choose which roles can add review data e.g. site ratings, summaries, good and bad points etc.', 'gpur' ),
				'type' => 'checkbox',
				'data' => 'roles',
				'default' => array( 'administrator' ),
				//'class' => 'gp-setting',
			),

			/**
			 * Comment form
			 *
			 */
			array(
				'id' => 'comment_form_permissions',
				'title' => esc_html__( 'Comment Permissions', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'select',
				'desc' => esc_html__( 'Choose which users or roles can submit comments.', 'gpur' ),
				'options' => array(
					'all-users' => esc_html__( 'All users', 'gpur' ),
					'logged-in-users' => esc_html__( 'Logged in users only', 'gpur' ),
					'specific-roles' => esc_html__( 'Specific roles only', 'gpur' ),
				),
				'default' => 'all-users',
				//'class' => 'gp-setting',
			),

			array(
				'id' => 'comment_form_permission_roles',
				'title' => esc_html__( 'Roles', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'checkbox',
				'data' => 'roles',
				'default' => array( 'administrator' ),
				//'class' => 'gp-setting gp-setting-comment_form_permissions gp-value-specific-roles gp-equal gp-hide',
			),
			
			array(
				'id' => 'comment_form_review_support',
				'title' => esc_html__( 'Review Support', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'radio',
					'desc' => esc_html__( 'Choose to add review features to your theme comments.', 'gpur' ),
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),
					'default' => 'enabled',
					//'class' => 'gp-setting',
			),

			array(
				'id' => 'comment_form_rating_permissions',
				'title' => esc_html__( 'Rating Permissions', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'select',
					'desc' => esc_html__( 'Choose which users or roles can submit ratings within comments.', 'gpur' ),
					'options' => array(
						'all-users' => esc_html__( 'All users', 'gpur' ),
						'logged-in-users' => esc_html__( 'Logged in users only', 'gpur' ),
						'specific-roles' => esc_html__( 'Specific roles only', 'gpur' ),
					),
					'default' => 'all-users',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',
			),

			array(
				'id' => 'comment_form_rating_permission_roles',
				'title' => esc_html__( 'Roles', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'checkbox',
					'data' => 'roles',
					'default' => array( 'administrator' ),
					//'class' => 'gp-setting gp-setting-comment_form_rating_permissions gp-value-specific-roles gp-equal gp-hide',
			
			),

			array(
				'id' => 'comment_form_comment_rating_limit',
				'title' => esc_html__( 'Comment/Rating Limit', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'select',
					'desc' => esc_html__( 'Choose whether uses can rate and comment multiple times.', 'gpur' ),
					'options' => array(
						'one-rating-one-comment' => esc_html__( 'One rating / One comment', 'gpur' ),
						'one-rating-multi-comments' => esc_html__( 'One rating / Multiple comments', 'gpur' ),
						'multi-ratings-multi-comments' => esc_html__( 'Multiple ratings / Multiple comments', 'gpur' ),
					),
					'default' => 'one-rating-one-comment',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',
				
			),

			array(
				'id' => 'comment_form_review_title',
				'title' => esc_html__( 'Review Title', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'radio',
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),
					'default' => 'enabled',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',
				
			),

			array(
				'id' => 'comment_form_title_length',
				'title' => esc_html__( 'Review Title Length', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'desc' => esc_html__( 'The number of characters allowed. Leave empty to display all characters.', 'gpur' ),
					'default' => '',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-setting-comment_form_review_title gp-value-enabled gp-equal gp-hide',
						),

			array(
				'id' => 'comment_form_text_length',
				'title' => esc_html__( 'Review Text Length', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'desc' => esc_html__( 'The number of characters allowed. Leave empty to display all characters.', 'gpur' ),
					'default' => '',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	
		
			array(
				'id' => 'comment_form_criteria',
				'title' => esc_html__( 'Criteria & Weights', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'textarea',
				'desc' => esc_html__( 'Enter each criterion on a new line. To add weights add a colon and then the weight e.g.', 'gpur' ) . '<br/><code>' . esc_html__( 'Criterion 1:0.5', 'gpur' ) . '</code><br/><code>' . esc_html__( 'Criterion 2:0.75', 'gpur' ) . '</code>',
				//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',
			),
			
			array(
				'id' => 'comment_form_format',
				'title' => esc_html__( 'Rating Format', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'select',
					'options' => array(
						'format-column' => esc_html__( 'Column', 'gpur' ),
						'format-rows' => esc_html__( 'Rows', 'gpur' ),
					),
					'default' => 'format-rows',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',
				
			),
			
			array(
				'id' => 'comment_form_style',
				'title' => esc_html__( 'Style', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'select',
					'options' => array(
						'style-stars' => esc_html__( 'Stars', 'gpur' ), 
						'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
						'style-squares' => esc_html__( 'Squares', 'gpur' ),
						'style-circles' => esc_html__( 'Circles', 'gpur' ),
						'style-bars' => esc_html__( 'Bars', 'gpur' ),
						'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
						'style-image' => esc_html__( 'Custom Image', 'gpur' ),
					),
					'default' => 'style-stars',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),			
			
			array(
				'id' => 'comment_form_min_rating',
				'title' => esc_html__( 'Minimum Rating', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => 0,
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),				

			array(
				'id' => 'comment_form_max_rating',
				'title' => esc_html__( 'Maximum Rating', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => 5,
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),			

			array(
				'id' => 'comment_form_step',
				'title' => esc_html__( 'Rating Step', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'desc' => esc_html__( 'The increments you can rate between the minimum and maximum rating.', 'gpur' ),
					'default' => 1,
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	

			array(
				'id' => 'comment_form_fractions',
				'title' => esc_html__( 'Rating Fractions', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'desc' => esc_html__( 'Indicates the number of equal parts that make up a whole symbol.', 'gpur' ),
					'default' => 1,
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	
	
			array(
				'id' => 'comment_form_text_position',
				'title' => esc_html__( 'Rating Text Position', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'select',
					'options' => array(
						'position-text-top' => esc_html__( 'Top', 'gpur' ), 
						'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
						'position-text-left' => esc_html__( 'Left', 'gpur' ),
						'position-text-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'position-text-bottom',
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	

			array(
				'id' => 'comment_form_show',
				'title' => esc_html__( 'Show', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'checkbox',
					'options' => array(
						'your_user_rating_text' => esc_html__( 'Your User Rating Text', 'gpur' ),
						'maximum_rating_text' => esc_html__( 'Maximum Rating Text', 'gpur' )
					),
					'default' => array( 
						'your_user_rating_text' => 0,
						'maximum_rating_text' => 0,
					),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),
		
			array(
				'id' => 'comment_form_rating_image',
				'title' => esc_html__( 'Custom Image', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'media',
					'format' => 'image',
					'desc' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
					//'class' => 'gp-setting gp-setting-comment_form_style gp-value-style-image gp-equal gp-hide',

			),	

			array(
				'id' => 'comment_form_icons',
				'title' => esc_html__( 'Icons', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Empty Icon', 'gpur' ) => 'icon',
						esc_html__( 'Filled Icon', 'gpur' ) => 'icon',
					),
					'default' => array(
						'empty_icon' => 'fa fa-star',
						'filled_icon' => 'fa fa-star',
					),
					//'class' => 'gp-setting gp-setting-comment_form_style gp-value-style-icon gp-equal gp-hide',
				
			),
	
			array(
				'id' => 'comment_form_icon_styling',
				'title' => esc_html__( 'Icon Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Icon Width', 'gpur' ) => 'dimensions',
						esc_html__( 'Icon Height', 'gpur' ) => 'dimensions',
						esc_html__( 'Empty Icon Color', 'gpur' ) => 'color',
						esc_html__( 'Filled Icon Color', 'gpur' ) => 'color',
					),	
					'default' => array(
						'icon_width' => '',
						'icon_height' => '',
						'empty_icon_color' => '',
						'filled_icon_color' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_form_style gp-value-style-stars gp-value-style-hearts gp-value-style-circles gp-value-style-squares gp-value-style-bars gp-value-style-icon gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',
				
			),

			array(
				'id' => 'comment_form_criteria_title',
				'title' => esc_html__( 'Criteria Title', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Color', 'gpur' ) => 'color', 
						esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
					),
					'default' => array(
						'size' => '',
						'color' => '',	
						'extra_css' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_form_criteria gp-not-empty gp-hide',

			),		

			array(
				'id' => 'comment_form_your_user_rating_text',
				'title' => esc_html__( 'Your User Rating Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'styling',
					'styling' => array( 
						esc_html__( 'Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Color', 'gpur' ) => 'color', 
						esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
					),
					'default' => array(
						'size' => '',
						'color' => '',	
						'extra_css' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_form_show_your_user_rating_text gp-value-true gp-equal gp-hide gp-setting-comment_form_review_support gp-value-enabled gp-equal',

			),							

			array(
				'id' => 'comment_form_maximum_rating_text',
				'title' => esc_html__( 'Maximum Rating Text Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Color', 'gpur' ) => 'color',
						esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
					),
					'default' => array(
						'size' => '',
						'color' => '',	
						'extra_css' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_form_show_maximum_rating_text gp-value-true gp-equal gp-hide gp-setting-comment_form_review_support gp-value-enabled gp-equal',	
				
			),

			array(
				'id' => 'comment_form_review_title_field_label',
				'title' => esc_html__( 'Review Title Field Label', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'Review Title', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_title gp-enabled gp-equal gp-hide',

			),			

			array(
				'id' => 'comment_form_rating_field_label',
				'title' => esc_html__( 'Rating Field Label', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'Your Review', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),																	

			array(
				'id' => 'comment_form_character_limit_label',
				'title' => esc_html__( 'Character Limit Label', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'desc' => '<code>%NUMBER%</code>' . esc_html__( 'represents the character limit set above.', 'gpur' ),
					'default' => esc_html__( '%NUMBER% characters remaining.', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	

			array(
				'id' => 'comment_form_your_user_rating_label',
				'title' => esc_html__( 'Your User Rating Label', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'Your Rating:', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_show_your_user_rating_text gp-value-true gp-equal gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),			

			array(
				'id' => 'comment_form_already_voted_label',
				'title' => esc_html__( 'Already Commented/Voted Label', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'You have already reviewed this post.', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),		

			array(
				'id' => 'comment_form_logged_in_to_vote_label',
				'title' => esc_html__( 'Logged In To Vote Label', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'You must be logged in to vote.', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	

			array(
				'id' => 'comment_form_single_success_message',
				'title' => esc_html__( 'Success Message', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'Thanks for submitting your comment!', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	

			array(
				'id' => 'comment_form_single_error_message',
				'title' => esc_html__( 'Error Message', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'These fields are required.', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',

			),	

			array(
				'id' => 'comment_form_single_duplicate_comments',
				'title' => esc_html__( 'Duplicate Comments Error Message', 'gpur' ),
				'section' => $theme_slug . '_comment_form',
				'type' => 'text',
					'default' => esc_html__( 'You cannot post duplicate comments.', 'gpur' ),
					//'class' => 'gp-setting gp-setting-comment_form_review_support gp-value-enabled gp-equal gp-hide',
				
			),
																			
			/**
			 * Comment list
			 *
			 */
			array(
				'id' => 'comment_list_title',
				'title' => esc_html__( 'Title', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'text',
					'default' => esc_html__( 'Customer Reviews', 'gpur' ),
					//'class' => 'gp-setting',
				
			),

			array(
				'id' => 'comment_list_order_dropdown',
				'title' => esc_html__( 'Order Dropdown Menu', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'radio',
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),	
					'default' => 'enabled',
					//'class' => 'gp-setting',
				
			),

			array(
				'id' => 'comment_list_rating_dropdown',
				'title' => esc_html__( 'Rating Dropdown Menu', 'gpur' ),
				'section' => $theme_slug . '_comment_list',
				'type' => 'radio',
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),	
					'default' => 'enabled',
					//'class' => 'gp-setting',
				
			),
																			
			/**
			 * Comment Summary
			 *
			 */

			// General
			array(
				'id' => 'comment_summary_general_section',
				'title' => esc_html__( 'General', 'gpur' ),
				'section' => $theme_slug . '_comment_summary',
				'type' => 'title',
				'class' => 'gp-setting gp-setting-begin',
			),	
			
				array(
					'id' => 'comment_summary',
					'title' => esc_html__( 'Summary', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'radio',
						'desc' => esc_html__( 'Displays a summary of the percentage of each rating e.g. the number of 5, 4, 3, 2 and 1 star ratings.', 'gpur' ),
						'options' => array(
							'enabled' => esc_html__( 'Enabled', 'gpur' ),
							'disabled' => esc_html__( 'Disabled', 'gpur' ),
						),	
						'default' => 'enabled',
						//'class' => 'gp-setting'
				),

			// Summary average
			array(
				'id' => 'comment_summary_average_section',
				'title' => esc_html__( 'Average Rating', 'gpur' ),
				'section' => $theme_slug . '_comment_summary',
				'type' => 'title',
				'class' => 'gp-setting gp-setting-begin',
			),
		
				array(
					'id' => 'comment_summary_avg_rich_snippets',
					'title' => esc_html__( 'Rich Snippets', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'checkbox',
					'desc' => esc_html__( 'Allows search engines to read your rating data to display ratings in search results.', 'gpur' ),
					'default' => 1,
					//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_style',
					'title' => esc_html__( 'Style', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'select',
						'options' => array(
							'style-plain-singular' => esc_html__( 'Plain (Singular)', 'gpur' ),
							'style-squares-singular' => esc_html__( 'Squares (Singular)', 'gpur' ),
							'style-circles-singular' => esc_html__( 'Circles (Singular)', 'gpur' ),
							'style-gauge-circles-singular' => esc_html__( 'Gauge Circles (Singular)', 'gpur' ),
							'style-stars' => esc_html__( 'Stars', 'gpur' ), 
							'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
							'style-squares' => esc_html__( 'Squares', 'gpur' ),
							'style-circles' => esc_html__( 'Circles', 'gpur' ),
							'style-bars' => esc_html__( 'Bars', 'gpur' ),
							'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
							'style-image' => esc_html__( 'Custom Image', 'gpur' ),
						),
						'default' => 'style-stars',
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_show',
					'title' => esc_html__( 'Show', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'checkbox',
						'options' => array(
							'average_user_rating_text' =>esc_html__( 'Average User Rating Text', 'gpur' ),
							'maximum_rating_text' =>esc_html__( 'Maximum Rating Text', 'gpur' ),
							'user_votes_text' =>esc_html__( 'User Votes Text', 'gpur' ),
							'zero_ratings' =>esc_html__( 'Zero Ratings', 'gpur' ),
						),
						'default' => array(
							'average_user_rating_text' => 0,
							'maximum_rating_text' => 0,
							'user_votes_text' => 0,
							'zero_ratings' => 0,
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_image',
					'title' => esc_html__( 'Custom Image', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'media',
						'format' => 'image',
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_style gp-value-style-image gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_icons',
					'title' => esc_html__( 'Icons', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Empty Icon', 'gpur' ) => 'icon',
							esc_html__( 'Filled Icon', 'gpur' ) => 'icon',
						),		
						'default' => array(
							'empty_icon' => 'fa fa-star',
							'filled_icon' => 'fa fa-star',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_style gp-value-style-icon gp-equal gp-hide'
				),
		
				array(
					'id' => 'comment_summary_avg_icon_styling',
					'title' => esc_html__( 'Icon Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Icon Width', 'gpur' ) => 'dimensions',
							esc_html__( 'Icon Height', 'gpur' ) => 'dimensions',
							esc_html__( 'Empty Icon Color', 'gpur' ) => 'color',
							esc_html__( 'Filled Icon Color', 'gpur' ) => 'color',
						),
						'default' => array(
							'icon_width' => '',
							'icon_height' => '',
							'empty_icon_color' => '',
							'filled_icon_color' => '',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_style gp-value-style-stars gp-value-style-hearts gp-value-style-squares gp-value-style-circles gp-value-style-bars gp-value-style-icon gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_rating_container',
					'title' => esc_html__( 'Rating Container Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Width', 'gpur' ) => 'dimensions',
							esc_html__( 'Height', 'gpur' ) => 'dimensions',
							esc_html__( 'Text Size', 'gpur' ) => 'dimensions',
							esc_html__( 'Text Color', 'gpur' ) => 'color',
							esc_html__( 'Background Color', 'gpur' ) => 'color',
							esc_html__( 'Border Width', 'gpur' ) => 'dimensions',
							esc_html__( 'Border Color', 'gpur' ) => 'color',
							esc_html__( 'Container Extra CSS', 'gpur' ) => 'extra_css',
							esc_html__( 'Text Extra CSS', 'gpur' ) => 'extra_css',
						),
						'default' => array(
							'width' => '',
							'height' => '',
							'text_size' => '',
							'text_color' => '',
							'background_color' => '',
							'border_width' => '',
							'border_color' => '',
							'container_extra_css' => '',
							'text-extra_css' => '',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_style gp-value-style-plain-singular gp-value-style-squares-singular gp-value-style-circles-singular gp-value-style-gauge-circles-singular gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_gauge',
					'title' => esc_html__( 'Gauge Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Width', 'gpur' ) => 'dimensions',
							esc_html__( 'Filled Color 1', 'gpur' ) => 'color',
							esc_html__( 'Filled Color 2', 'gpur' ) => 'color',
							esc_html__( 'Empty Color', 'gpur' ) => 'color',
						),
						'default' => array(
							'width' => '',
							'filled_color_1' => '',
							'filled_color_2' => '',
							'empty_color' => '',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_style gp-value-style-gauge-circles-singular gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_average_user_rating_text',
					'title' => esc_html__( 'Average User Rating Text Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Size', 'gpur' ) => 'dimensions',
							esc_html__( 'Color', 'gpur' ) => 'color',
							esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
						),
						'default' => array(
							'size' => '',
							'color' => '',
							'extra_css' => '',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_show_average_user_rating_text gp-value-true gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_maximum_rating_text',
					'title' => esc_html__( 'Maximum Rating Text Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Size', 'gpur' ) => 'dimensions',
							esc_html__( 'Color', 'gpur' ) => 'color',
							esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
						),
						'default' => array(
							'size' => '',
							'color' => '',
							'extra_css' => '',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_show_maximum_rating_text gp-value-true gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_user_votes_text',
					'title' => esc_html__( 'User Votes Text Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Size', 'gpur' ) => 'dimensions',
							esc_html__( 'Color', 'gpur' ) => 'color',
							esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
						),
						'default' => array(
							'size' => '',
							'color' => '',
							'extra_css' => '',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_show_user_votes_text gp-value-true gp-equal gp-hide'
				),
	
				array(
					'id' => 'comment_summary_avg_avg_user_rating_label',
					'title' => esc_html__( 'Average User Rating Label', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'text',
						'default' => esc_html__( 'Average User Rating:', 'gpur' ),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_show_average_user_rating_text gp-value-true gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_singular_vote_label',
					'title' => esc_html__( 'User Votes Label (Singular)', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'text',
						'default' => esc_html__( 'vote', 'gpur' ),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_show_user_votes_text gp-value-true gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_avg_plural_vote_label',
					'title' => esc_html__( 'User Votes Label (Plural)', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
					'type' => 'text',
					'default' => esc_html__( 'votes', 'gpur' ),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_avg_show_user_votes_text gp-value-true gp-equal gp-hide'
				),
	
			// Comment summary breakdown
			array(
				'id' => 'comment_summary_breakdown_section',
				'title' => esc_html__( 'Rating Breakdown', 'gpur' ),
				'section' => $theme_slug . '_comment_summary',
				'type' => 'title',
				'class' => 'gp-setting gp-setting-begin',
			),

				array(
					'id' => 'comment_summary_breakdown_style',
					'title' => esc_html__( 'Summary Style', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'select',
						'options' => array(
							'style-stars' => esc_html__( 'Stars', 'gpur' ), 
							'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
							'style-squares' => esc_html__( 'Squares', 'gpur' ),
							'style-circles' => esc_html__( 'Circles', 'gpur' ),
							'style-bars' => esc_html__( 'Bars', 'gpur' ),
							'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
							'style-image' => esc_html__( 'Custom Image', 'gpur' ),
						),
						'default' => 'style-bars',			
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-equal gp-hide'
				),	

				array(
					'id' => 'comment_summary_breakdown_image',
					'title' => esc_html__( 'Custom Image', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'media',
						'format' => 'image',
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_breakdown_style gp-value-style-image gp-equal gp-hide'
				),

				array(
					'id' => 'comment_summary_breakdown_icons',
					'title' => esc_html__( 'Icons', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Empty Icon', 'gpur' ) => 'icon',
							esc_html__( 'Filled Icon', 'gpur' ) => 'icon',
						),			
						'default' => array(
							'empty_icon' => 'fa fa-star',
							'filled_icon' => 'fa fa-star',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_breakdown_style gp-value-style-icon gp-equal gp-hide',
					
				),
	
				array(
					'id' => 'comment_summary_breakdown_icon_styling',
					'title' => esc_html__( 'Icon Styling', 'gpur' ),
					'section' => $theme_slug . '_comment_summary',
						'type' => 'styling',
						'styling' => array(
							esc_html__( 'Icon Width', 'gpur' ) => 'dimensions',
							esc_html__( 'Icon Height', 'gpur' ) => 'dimensions',
							esc_html__( 'Empty Icon Color', 'gpur' ) => 'color',
							esc_html__( 'Filled Icon Color', 'gpur' ) => 'color',
						),
						'default' => array(
							'icon_width' => '',
							'icon_height' => '',
							'empty_icon_color' => '',
							'filled_icon_color' => '',
						),
						//'class' => 'gp-setting gp-setting-comment_summary gp-value-enabled gp-setting-comment_summary_breakdown_style gp-value-style-stars gp-value-style-hearts gp-value-style-squares gp-value-style-circles gp-value-style-bars gp-value-style-icon gp-equal gp-hide',
					
				),

			/**
			 * Comment ratings
			 *
			 */
			array(
				'id' => 'comment_rating_format',
				'title' => esc_html__( 'Format', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'select',
					'options' => array(
						'format-column' => esc_html__( 'Column', 'gpur' ),
						'format-rows' => esc_html__( 'Rows', 'gpur' ),
					),
					'default' => 'format-rows',
					//'class' => 'gp-setting gp-setting-comment_form_criteria gp-not-empty gp-hide',
				
			),

			array(
				'id' => 'comment_rating_style',
				'title' => esc_html__( 'Style', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'select',
					'options' => array(
						'style-plain-singular' => esc_html__( 'Plain (Singular)', 'gpur' ),
						'style-squares-singular' => esc_html__( 'Squares (Singular)', 'gpur' ),
						'style-circles-singular' => esc_html__( 'Circles (Singular)', 'gpur' ),
						'style-gauge-circles-singular' => esc_html__( 'Gauge Circles (Singular)', 'gpur' ),
						'style-stars' => esc_html__( 'Stars', 'gpur' ), 
						'style-hearts' => esc_html__( 'Hearts', 'gpur' ),
						'style-squares' => esc_html__( 'Squares', 'gpur' ),
						'style-circles' => esc_html__( 'Circles', 'gpur' ),
						'style-bars' => esc_html__( 'Bars', 'gpur' ),
						'style-icon' => esc_html__( 'Custom Icon', 'gpur' ),
						'style-image' => esc_html__( 'Custom Image', 'gpur' ),
					),
					'default' => 'style-stars',	
					//'class' => 'gp-setting',
				
			),

			array(
				'id' => 'comment_rating_text_position',
				'title' => esc_html__( 'Rating Text Position', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'select',
					'options' => array(
						'position-text-top' => esc_html__( 'Top', 'gpur' ), 
						'position-text-bottom' => esc_html__( 'Bottom', 'gpur' ),
						'position-text-left' => esc_html__( 'Left', 'gpur' ),
						'position-text-right' => esc_html__( 'Right', 'gpur' ),
					),
					'default' => 'position-text-bottom',
					//'class' => 'gp-setting',
				
			),

			array(
				'id' => 'comment_rating_show',
				'title' => esc_html__( 'Show', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'checkbox',
					'options' => array(
						'your_user_rating_text' => esc_html__( 'Your User Rating Text', 'gpur' ),
						'maximum_rating_text' => esc_html__( 'Maximum Rating Text', 'gpur' ),
						'zero_ratings' => esc_html__( 'Zero Ratings', 'gpur' ),
					),
					'default' => array(
						'your_user_rating_text' => 0,
						'maximum_rating_text' => 0,
						'zero_ratings' => 0,
					),	
					//'class' => 'gp-setting',

			),

			array(
				'id' => 'comment_rating_image',
				'title' => esc_html__( 'Custom Image', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'media',
					'format' => 'image',
					//'class' => 'gp-setting gp-setting-comment_rating_style gp-value-style-image gp-equal gp-hide',

			),

			array(
				'id' => 'comment_rating_icons',
				'title' => esc_html__( 'Icond', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Empty Icon', 'gpur' ) => 'icon',
						esc_html__( 'Filled Icon', 'gpur' ) => 'icon',
					),		
					'default' => array(
						'empty_icon' => 'fa fa-star',
						'filled_icon' => 'fa fa-star',
					),
					//'class' => 'gp-setting gp-setting-comment_rating_style gp-value-style-icon gp-equal gp-hide',	
			),

			array(
				'id' => 'comment_rating_icon_styling',
				'title' => esc_html__( 'Icon Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Icon Width', 'gpur' ) => 'dimensions',
						esc_html__( 'Icon Height', 'gpur' ) => 'dimensions',
						esc_html__( 'Empty Icon Color', 'gpur' ) => 'color',
						esc_html__( 'Filled Icon Color', 'gpur' ) => 'color',
					),	
					'default' => array(
						'icon_width' => '',
						'icon_height' => '',
						'empty_icon_color' => '',
						'filled_icon_color' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_rating_style gp-value-style-stars gp-value-style-hearts gp-value-style-squares gp-value-style-circles gp-value-style-bars gp-value-style-icon gp-equal gp-hide',	
			),

			array(
				'id' => 'comment_rating_criteria_title',
				'title' => esc_html__( 'Criteria Title', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Color', 'gpur' ) => 'color', 
						esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
					),
					'default' => array(
						'size' => '',
						'color' => '',
						'extra_css' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_form_criteria gp-not-empty gp-hide',	
			),	

			array(
				'id' => 'comment_rating_rating_container',
				'title' => esc_html__( 'Rating Container Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Width', 'gpur' ) => 'dimensions',
						esc_html__( 'Height', 'gpur' ) => 'dimensions',
						esc_html__( 'Text Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Text Color', 'gpur' ) => 'color',
						esc_html__( 'Background Color', 'gpur' ) => 'color',
						esc_html__( 'Border Width', 'gpur' ) => 'dimensions',
						esc_html__( 'Border Color', 'gpur' ) => 'color',
						esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
					),
					'default' => array(
						'width' => '',
						'height' => '',
						'text_size' => '',
						'text_color' => '',
						'background_color' => '',
						'border_width' => '',
						'border_color' => '',
						'extra_css' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_rating_style gp-value-style-plain-singular gp-value-style-squares-singular gp-value-style-circles-singular gp-value-style-gauge-circles-singular gp-equal gp-hide',	
			),

			array(
				'id' => 'comment_rating_comment_divider',
				'title' => esc_html__( 'Comment Divider', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'color',
					'styling' => array(
						esc_html__( 'Color', 'gpur' ) => 'color',
					),
					'default' => array(
						'color' => 'width',
					),
			),
		
			array(
				'id' => 'comment_rating_your_user_rating_text',
				'title' => esc_html__( 'Your User Rating Text Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Color', 'gpur' ) => 'color',
						esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
					),
					'default' => array(
						'size' => '',
						'color' => '',
						'extra_css' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_rating_show_your_user_rating_text gp-value-true gp-equal gp-hide',
			),
		
			array(
				'id' => 'comment_rating_your_user_rating_text',
				'title' => esc_html__( 'Your User Rating Text Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Color', 'gpur' ) => 'color',
						esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
					),
					'default' => array(
						'size' => '',
						'color' => '',
						'extra_css' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_rating_show_your_user_rating_text gp-value-true gp-equal gp-hide',
			),

			array(
				'id' => 'comment_rating_maximum_rating_text',
				'title' => esc_html__( 'Maximum Rating Text Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'styling',
				'styling' => array(
					esc_html__( 'Size', 'gpur' ) => 'dimensions',
					esc_html__( 'Color', 'gpur' ) => 'color',
					esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
				),
				'default' => array(
					'size' => '',
					'color' => '',
					'extra_css' => '',
				),
				//'class' => 'gp-setting gp-setting-comment_rating_show_maximum_rating_text gp-value-true gp-equal gp-hide',
			),
	
			array(
				'id' => 'comment_rating_your_user_rating_label',
				'title' => esc_html__( 'Your User Rating Label', 'gpur' ),
				'section' => $theme_slug . '_comment_ratings',
				'type' => 'text',
				'default' => esc_html__( 'Your Rating:', 'gpur' ),
				//'class' => 'gp-setting gp-setting-comment_rating_show_your_user_rating_text gp-value-true gp-equal gp-hide',	
				
			),

			/**
			 * Comment up/down rating
			 *
			 */
			array(
				'id' => 'comment_udv_support',
				'title' => esc_html__( 'Support', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'radio',
					'desc' => esc_html__( 'Choose to add up/down voting to your theme comments.', 'gpur' ),
					'options' => array(
						'enabled' => esc_html__( 'Enabled', 'gpur' ),
						'disabled' => esc_html__( 'Disabled', 'gpur' ),
					),	
					'default' => 'enabled',
					//'class' => 'gp-setting',
				
			),

			array(
				'id' => 'comment_udv_permissions',
				'title' => esc_html__( 'Permissions', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'select',
					'desc' => esc_html__( 'Choose which users or roles can up/down vote comments.', 'gpur' ),
					'options' => array(
						'all-users' => esc_html__( 'All users', 'gpur' ),
						'logged-in-users' => esc_html__( 'Logged in users only', 'gpur' ),
						'specific-roles' => esc_html__( 'Specific roles only', 'gpur' ),
					),
					'default' => 'all-users',
					//'class' => 'gp-setting gp-setting-comment_udv_support gp-value-enabled gp-equal gp-hide',	
				
			),

			array(
				'id' => 'comment_udv_permission_roles',
				'title' => esc_html__( 'Roles', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'checkbox',
					'data' => 'roles',
					'default' => array( 'administrator' ),
					//'class' => 'gp-setting gp-setting-comment_udv_permissions gp-setting-comment_udv_support gp-value-specific-roles gp-value-enabled gp-equal gp-hide',	
				
			),

			array(
				'id' => 'comment_udv_style',
				'title' => esc_html__( 'Style', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'select',
					'options' => array(
						'style-plain' => esc_html__( 'Plain', 'gpur' ), 
						'style-round-buttons' => esc_html__( 'Round Buttons', 'gpur' ),
						'style-rounded-buttons' => esc_html__( 'Rounded Buttons', 'gpur' ),
					),
					'default' => 'style-plain',
					//'class' => 'gp-setting gp-setting-comment_udv_support gp-value-enabled gp-equal gp-hide',	
				
			),

			array(
				'id' => 'comment_udv_counter_position',
				'title' => esc_html__( 'Counter Position', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'select',
					'options' => array(
						'position-top' => esc_html__( 'Top', 'gpur' ),
						'position-bottom' => esc_html__( 'Bottom', 'gpur' ),
						'position-left' => esc_html__( 'Left', 'gpur' ),
						'position-right' => esc_html__( 'Right', 'gpur' ),
						'position-left-right' => esc_html__( 'Left And Right', 'gpur' ),
					),
					'default' => 'position-left-right',
					//'class' => 'gp-setting gp-setting-comment_udv_support gp-value-enabled gp-equal gp-hide',	
				
			),

			array(
				'id' => 'comment_udv_up_icon',
				'title' => esc_html__( 'Up Icon Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'styling',
					'styling' => array(
						esc_html__( 'Icon', 'gpur' ) => 'icon',
						esc_html__( 'Icon Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Icon Color', 'gpur' ) => 'color',
						esc_html__( 'Icon Color (Voted)', 'gpur' ) => 'color',
						esc_html__( 'Background Color', 'gpur' ) => 'color',
						esc_html__( 'Background Color (Voted)', 'gpur' ) => 'color',
						esc_html__( 'Counter Size', 'gpur' ) => 'dimensions',
						esc_html__( 'Counter Color', 'gpur' ) => 'color',
					),
					'default' => array(
						'icon' => 'fa fa-thumbs-o-up',
						'icon_size' => '',
						'icon_color' => '',
						'icon_color_voted' => '',
						'background_color' => '',
						'background_color_voted' => '',
						'counter_size' => '',
						'counter_color' => '',
					),
					//'class' => 'gp-setting gp-setting-comment_udv_support gp-value-enabled gp-equal gp-hide',	
				
			),

			array(
				'id' => 'comment_udv_down_icon',
				'title' => esc_html__( 'Down Icon Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'styling',
				'styling' => array(
					esc_html__( 'Icon', 'gpur' ) => 'icon',
					esc_html__( 'Icon Size', 'gpur' ) => 'dimensions',
					esc_html__( 'Icon Color', 'gpur' ) => 'color',
					esc_html__( 'Icon Color (Voted)', 'gpur' ) => 'color',
					esc_html__( 'Background Color', 'gpur' ) => 'color',
					esc_html__( 'Background Color (Voted)', 'gpur' ) => 'color',
					esc_html__( 'Counter Size', 'gpur' ) => 'dimensions',
					esc_html__( 'Counter Color', 'gpur' ) => 'color',
				),	
				'default' => array(
					'icon' => 'fa fa-thumbs-o-down',
					'icon' => '',
					'icon_size' => '',
					'icon_color' => '',
					'icon_color_voted' => '',
					'background_color' => '',
					'background_color_voted' => '',
					'counter_size' => '',
					'counter_color' => '',
				),
				//'class' => 'gp-setting gp-setting-comment_udv_support gp-value-enabled gp-equal gp-hide',	
			),

			array(
				'id' => 'comment_udv_already_voted_text',
				'title' => esc_html__( 'Already Voted Text Styling', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'styling',
				'styling' => array(
					esc_html__( 'Size', 'gpur' ) => 'dimensions',
					esc_html__( 'Color', 'gpur' ) => 'color',
					esc_html__( 'Extra CSS', 'gpur' ) => 'extra_css',
				),		
				'default' => array(
					'size' => '',
					'color' => '',
					'extra_css' => '',
				),
				//'class' => 'gp-setting gp-setting-comment_udv_support gp-value-enabled gp-equal gp-hide',	
			),

			array(
				'id' => 'comment_udv_already_voted_label',
				'title' => esc_html__( 'Already Voted Label', 'gpur' ),
				'section' => $theme_slug . '_comment_udv',
				'type' => 'text',
				'default' => esc_html__( 'You have already voted!', 'gpur' ),		
				//'class' => 'gp-setting gp-setting-comment_udv_support gp-value-enabled gp-equal gp-hide',	
			),

			// Import/Export
			array(
				'id' => 'import_export_section',
				'title' => esc_html__( 'Import/Export', 'gpur' ),
				'section' => $theme_slug . '_advanced',
				'label_for' => 'gp-setting-title',	
				'type' => 'title',
				'class' => 'gp-setting gp-setting-begin',
			),	
			
				array(
					'id' => 'import_settings',
					'title' => esc_html__( 'Import', 'gpur' ),
					'section' => $theme_slug . '_advanced',
					'desc' => esc_html__( 'Upload your plugin settings file with a .txt extension.', 'gpur' ),
					'type' => 'import',
				),
				
				array(
					'id' => 'export_settings',
					'title' => esc_html__( 'Export', 'gpur' ),
					'section' => $theme_slug . '_advanced',
					'desc' => esc_html__( 'Downloads a .txt file that contains all your plugin settings data.', 'gpur' ),
					'type' => 'export',
				),	
				
		);
	
		$settings = apply_filters( 'gpur_global_settings', $settings, $theme_slug );

		return $settings;
		
	}
}	