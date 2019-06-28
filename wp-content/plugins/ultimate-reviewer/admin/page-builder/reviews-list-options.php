<?php if ( ! function_exists( 'gpur_wpb_reviews_list_options' ) ) {
	function gpur_wpb_reviews_list_options() { 
		
		vc_map( array( 
			'name' => esc_html__( 'Review List', 'gpur' ),
			'base' => 'gpur_reviews_list',
			'description' => '',
			'class' => 'gpur-wpb-reviews-list',
			'controls' => 'full',
			'icon' => 'gpur-icon-reviews-list',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(
			
				array( 
					'heading' => esc_html__( 'Title', 'gpur' ),
					'param_name' => 'title',
					'type' => 'textfield',
					'admin_label' => true,
					'value' => '',
				),	
				
				array( 
					'heading' => esc_html__( 'Post Types', 'gpur' ),
					'param_name' => 'post_types',
					'type' => 'posttypes',
					'std' => 'post',
				),
						
				array( 
					'heading' => esc_html__( 'Post/Page IDs', 'gpur' ),
					'description' => esc_html__( 'Enter the post/pages IDs you want to show - separate IDs with a comma e.g. 123, 456, 789', 'gpur' ),
					'param_name' => 'ids',
					'type' => 'textfield',
				),	
						
				array( 
					'heading' => esc_html__( 'Categories', 'gpur' ),
					'description' => esc_html__( 'Enter the category slugs you want to display posts from - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ),
					'param_name' => 'cats',
					'type' => 'textfield',
				),
					
				array( 
					'heading' => esc_html__( 'Tags', 'gpur' ),
					'description' => esc_html__( 'Enter the tag slugs you want to display posts from - separate slugs with a comma e.g. tag-1, tag-2, tag-3', 'gpur' ),
					'param_name' => 'tags',
					'type' => 'textfield',
				),							
					
				array( 
					'heading' => esc_html__( 'Current Taxonomy', 'gpur' ),
					'description' => esc_html__( 'Only show posts from the current category/tag.', 'gpur' ),
					'param_name' => 'current_tax',
					'type' => 'checkbox',
				),	
							
				array( 
					'heading' => esc_html__( 'Sort', 'gpur' ),
					'param_name' => 'sort',
					'value' => array(
						esc_html__( 'Most Recent', 'gpur' ) => 'post-date-desc',
						esc_html__( 'Alphabetical', 'gpur' ) => 'post-title-desc',
						esc_html__( 'Highest Site Rated', 'gpur' ) => 'site-rating-desc',
						esc_html__( 'Lowest Site Rated', 'gpur' ) => 'site-rating-asc',
						esc_html__( 'Highest User Rated', 'gpur' ) => 'user-rating-desc',
						esc_html__( 'Lowest User Rated', 'gpur' ) => 'user-rating-asc',
						esc_html__( 'Most User Votes', 'gpur' ) => 'user-votes-desc',
						esc_html__( 'Most Likes', 'gpur' ) => 'likes-desc',
						esc_html__( 'Random', 'gpur' ) => 'random',
						esc_html__( 'Post/Page Order', 'gpur' ) => 'post-page-order',	
					),
					'type' => 'dropdown',
				),	
				
				array( 
					'heading' => esc_html__( 'Number', 'gpur' ),
					'param_name' => 'number',
					'type' => 'textfield',
					'value' => '5',
				),						
					
				array( 
					'heading' => esc_html__( 'Exclude Current Item', 'gpur' ),
					'description' => esc_html__( 'Exclude the current post/page from showing in the review list.', 'gpur' ),
					'param_name' => 'exclude_current_item',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Yes', 'gpur' ) => 1 ),
					'std' => '',
				),	

				array( 
					'heading' => esc_html__( 'Format', 'gpur' ),
					'param_name' => 'post_format',
					'value' => array(
						esc_html__( 'List', 'gpur' ) => 'gpur-format-list',
						esc_html__( '2 Columns', 'gpur' ) => 'gpur-format-columns-2', 
						esc_html__( '3 Columns', 'gpur' ) => 'gpur-format-columns-3', 
						esc_html__( '4 Columns', 'gpur' ) => 'gpur-format-columns-4',
					),
					'type' => 'dropdown',
				),
								
				array( 
					'param_name' => 'header_show',
					'heading' => esc_html__( 'Show', 'gpur' ),
					'type' => 'gpur_header',
				),
					array( 
						'param_name' => 'show_ranking',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Ranking', 'gpur' ) => 1 ),
						'std' => '',
					),					
					array( 
						'param_name' => 'show_image',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Image', 'gpur' ) => 1 ),
						'std' => 1,
					),	
					array( 
						'param_name' => 'show_title',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Title', 'gpur' ) => 1 ),
						'std' => 1,
					),						
					array(
						'param_name' => 'show_name',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Name', 'gpur' ) => 1 ),
						'std' => 1,
					),	
					array( 
						'param_name' => 'show_date',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Date', 'gpur' ) => 1 ),
						'std' => 1,
					),	
					array( 
						'param_name' => 'show_comments',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Comments', 'gpur' ) => 1 ),
						'std' => '',
					),	
					array( 
						'param_name' => 'show_likes',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Likes', 'gpur' ) => 1 ),
						'std' => '',
					),	
					array(
						'param_name' => 'show_site_rating',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Site Rating', 'gpur' ) => 1 ),
						'std' => 1,
					),	
					array( 
						'param_name' => 'show_user_rating',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'User Rating', 'gpur' ) => 1 ),
						'std' => 1,
					),	
					array( 
						'param_name' => 'show_excerpt',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Excerpt', 'gpur' ) => 1 ),
						'std' => 1,
					),	
					array( 
						'param_name' => 'show_view_link',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'View Link', 'gpur' ) => 1 ),
						'std' => '',
					),
				
				array( 
					'heading' => esc_html__( 'Image Source', 'gpur' ),
					'param_name' => 'image_source',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Review Image 1', 'gpur' ) => 'review-image-1',
						esc_html__( 'Review Image 2', 'gpur' ) => 'review-image-2',
						esc_html__( 'Featured Image', 'gpur' ) => 'featured-image',
					),
					'std' => 'featured-image',
				),	
								
				array(
					'heading' => esc_html__( 'Image Size', 'gpur' ),
					'param_name' => 'image_size',
					'type' => 'textfield',
					'value' => '160 x 160',
				),								
				
				array( 
					'heading' => esc_html__( 'Title Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the title. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'title_length',
					'type' => 'textfield',
					'value' => '',
				),								
				
				array( 
					'heading' => esc_html__( 'Excerpt Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the excerpt. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'excerpt_length',
					'type' => 'textfield',
					'value' => 200,
				),		

				array( 
					'param_name' => 'ratings_position',
					'heading' => esc_html__( 'Ratings Position', 'gpur' ),			
					'description' => esc_html__( 'Choose whether to show the ratings below or to the right of the post content.', 'gpur' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Below', 'gpur' ) => 'gpur-ratings-below',
						esc_html__( 'To Right', 'gpur' ) => 'gpur-ratings-to-right',
						esc_html__( 'Over Image', 'gpur' ) => 'gpur-ratings-over-image',
					),
					'std' => 'gpur-ratings-below',
				),
					
					
				/*--------------------------------------------------------------
				List styling tab
				--------------------------------------------------------------*/					
				
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'posts_border_color',
					'type' => 'colorpicker',
					'dependency' => array( 
						'element' => 'post_format', 
						'value' => 'gpur-format-list' ,
					),
					//'edit_field_class' => 'vc_col-xs-3',
					'group' => esc_html__( 'Posts', 'gpur' ),
				),			
													
				/*--------------------------------------------------------------
				Rating styling tab
				--------------------------------------------------------------*/					
				
				array( 
					'heading' => esc_html__( 'Site Rating Criteria', 'gpur' ),					
					'description' => esc_html__( 'Enter each criterion on a new line or leave empty to display the average rating.', 'gpur' ),
					'param_name' => 'site_criteria',
					'type' => 'exploded_textarea',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),	

				array( 
					'heading' => esc_html__( 'Site Maximum Rating', 'gpur' ),
					'param_name' => 'site_max_rating',
					'type' => 'textfield',
					'value' => 5,
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
											
				array( 
					'heading' => esc_html__( 'User Rating Criteria', 'gpur' ),					
					'description' => esc_html__( 'Enter each criterion on a new line or leave empty to display the average rating.', 'gpur' ),
					'param_name' => 'user_criteria',
					'type' => 'exploded_textarea',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),

				array( 
					'heading' => esc_html__( 'User Maximum Rating', 'gpur' ),
					'param_name' => 'user_max_rating',
					'type' => 'textfield',
					'value' => 5,
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),

				array( 
					'heading' => esc_html__( 'Format', 'gpur' ),
					'param_name' => 'format',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Column', 'gpur' ) => 'format-column',
						esc_html__( 'Rows', 'gpur' ) => 'format-rows',
					),
					'std' => 'format-rows',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),			
								
				array( 
					'heading' => esc_html__( 'Style', 'gpur' ),
					'param_name' => 'style',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Plain (Singular)', 'gpur' ) => 'style-plain-singular',
						esc_html__( 'Squares (Singular)', 'gpur' ) => 'style-squares-singular',
						esc_html__( 'Circles (Singular)', 'gpur' ) => 'style-circles-singular',
						esc_html__( 'Gauge Circles (Singular)', 'gpur' ) => 'style-gauge-circles-singular',
						esc_html__( 'Stars', 'gpur' ) => 'style-stars',
						esc_html__( 'Hearts', 'gpur' ) => 'style-hearts',
						esc_html__( 'Squares', 'gpur' ) => 'style-squares',
						esc_html__( 'Circles', 'gpur' ) => 'style-circles',
						esc_html__( 'Bars', 'gpur' ) => 'style-bars',
						esc_html__( 'Custom Icon', 'gpur' ) => 'style-icon',
						esc_html__( 'Custom Image', 'gpur' ) => 'style-image',
					),
					'std' => 'style-stars',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),

				array( 
					'heading' => esc_html__( 'Position', 'gpur' ),
					'param_name' => 'position',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'gpur' ) => 'position-left',
						esc_html__( 'Center', 'gpur' ) => 'position-center',
						esc_html__( 'Right', 'gpur' ) => 'position-right',
					),
					'std' => 'position-left',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),		

				array( 
					'param_name' => 'text_position',
					'heading' => esc_html__( 'Rating Text Position', 'gpur' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Top', 'gpur' ) => 'position-text-top', 
						esc_html__( 'Bottom', 'gpur' ) => 'position-text-bottom', 
						esc_html__( 'Left', 'gpur' ) => 'position-text-left', 
						esc_html__( 'Right', 'gpur' ) => 'position-text-right', 
					),
					'std' => 'position-text-bottom',					
					'dependency' => array(
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
																	
				array( 
					'param_name' => 'header_show',
					'heading' => esc_html__( 'Show', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
					array(	
						'param_name' => 'show_avg_user_rating_text',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Average User Rating Text', 'gpur' ) => 1 ),
						'std' => '',
						'dependency' => array( 
							'element' => 'data', 
							'value' => 'user-rating' 
						),
						'group' => esc_html__( 'Ratings', 'gpur' ),
					),				
					array( 
						'param_name' => 'show_your_user_rating_text',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Your User Rating Text', 'gpur' ) => 1 ),
						'std' => '',					
						'dependency' => array(
							'element' => 'style', 
							'value' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
						),
						'group' => esc_html__( 'Ratings', 'gpur' ),
					),	
					array(
						'param_name' => 'show_maximum_rating_text',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Maximum Rating Text', 'gpur' ) => 1 ),
						'std' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
						'dependency' => array( 
							'element' => 'style', 
							'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ),
						),
					),				
					array(
						'param_name' => 'show_user_votes_text',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'User Votes Text ', 'gpur' ) => 1 ),
						'std' => '',
						'dependency' => array( 
							'element' => 'data', 
							'value' => 'user-rating' 
						),
						'group' => esc_html__( 'Ratings', 'gpur' ),
					),
					array(
						'param_name' => 'show_ranges_text',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Ranges Text', 'gpur' ) => 1 ),
						'std' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
					),
					array(
						'param_name' => 'show_zero_rating',
						'type' => 'checkbox',
						'value' => array( esc_html__( 'Zero Ratings', 'gpur' ) => 1 ),
						'std' => 1,
						'group' => esc_html__( 'Ratings', 'gpur' ),
					),

				array( 
					'heading' => esc_html__( 'Custom Image', 'gpur' ),
					'description' => esc_html__( 'Your image should include the filled and empty icons. For an example see the', 'gpur' ) . ' <a href="' . GPUR_URL . 'public/images/default-rating-image.png" target="_blank">' . esc_html__( 'default image', 'gpur' ) . '</a>.',
					'param_name' => 'rating_image',
					'type' => 'attach_image',
					'value' => '',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-image' 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
								
				array( 
					'param_name' => 'rating_icons_header',
					'heading' => esc_html__( 'Icons', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
					),
				),			
				array( 
					'heading' => esc_html__( 'Empty Icon', 'gpur' ),
					'param_name' => 'empty_icon',
					'type' => 'iconpicker',
					'value' => 'fa fa-star',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-icon' ,
					),
					'edit_field_class' => 'vc_col-xs-3',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),								
				array( 
					'heading' => esc_html__( 'Empty Icon Color', 'gpur' ),
					'param_name' => 'empty_icon_color',
					'type' => 'colorpicker',
					'value' => 'fa fa-star',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
					),
				),		
				array( 
					'heading' => esc_html__( 'Filled Icon', 'gpur' ),
					'param_name' => 'filled_icon',
					'type' => 'iconpicker',
					'value' => 'fa fa-star',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-icon',
					),
					'edit_field_class' => 'vc_col-xs-3',
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),		
				array( 
					'heading' => esc_html__( 'Filled Icon Color', 'gpur' ),
					'param_name' => 'filled_icon_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon' ), 
					),
				),							
				array( 
					'heading' => esc_html__( 'Width (px)', 'gpur' ),
					'description' => '',
					'param_name' => 'icon_width',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
					),
				),
				array( 
					'heading' => esc_html__( 'Height (px)', 'gpur' ),
					'description' => '',
					'param_name' => 'icon_height',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
					),
				),

				array( 
					'param_name' => 'rating_container_header',
					'heading' => esc_html__( 'Rating Container', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
				),
				array( 
					'heading' => esc_html__( 'Width (px)', 'gpur' ),
					'description' => '',
					'param_name' => 'rating_width',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
				),
				array( 
					'heading' => esc_html__( 'Height (px)', 'gpur' ),
					'description' => '',
					'param_name' => 'rating_height',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
				),
				array( 
					'heading' => esc_html__( 'Text Size (px)', 'gpur' ),	
					'param_name' => 'rating_text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',					
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
				),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),	
					'param_name' => 'rating_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',					
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
				),						
				array( 
					'heading' => esc_html__( 'Background Color', 'gpur' ),
					'param_name' => 'rating_background_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',					
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),			
				array( 
					'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
					'param_name' => 'rating_border_width',
					'type' => 'textfield',
					'value' => '',		
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',			
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'rating_border_color',
					'type' => 'colorpicker',
					'value' => '',	
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',				
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),		
				array( 
					'heading' => esc_html__( 'Container Extra CSS', 'gpur' ),
					'param_name' => 'rating_container_extra_css',
					'type' => 'textfield',
					'value' => '',		
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',			
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Text Extra CSS', 'gpur' ),
					'param_name' => 'rating_text_extra_css',
					'type' => 'textfield',
					'value' => '',		
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',			
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-plain-singular', 'style-squares-singular', 'style-circles-singular', 'style-gauge-circles-singular' ), 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),

				array( 
					'param_name' => 'gauge_header',
					'heading' => esc_html__( 'Gauge', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-gauge-circles-singular' 
					),
				),
				array( 
					'heading' => esc_html__( 'Width (px)', 'gpur' ),
					'param_name' => 'gauge_width',
					'type' => 'textfield',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-gauge-circles-singular' 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Filled Color 1', 'gpur' ),
					'param_name' => 'gauge_filled_color_1',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-gauge-circles-singular' 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
		
				array( 
					'heading' => esc_html__( 'Filled Color 2', 'gpur' ),
					'param_name' => 'gauge_filled_color_2',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-gauge-circles-singular' 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
		
				array( 
					'heading' => esc_html__( 'Empty Color', 'gpur' ),
					'param_name' => 'gauge_empty_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => 'style-gauge-circles-singular' 
					),
					'group' => esc_html__( 'Ratings', 'gpur' ),
				),
								
				array( 
					'param_name' => 'criteria_title_header',
					'heading' => esc_html__( 'Criteria Title', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'criteria', 
						'not_empty' => true,
					),
				),				
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'criteria_title_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'criteria', 
						'not_empty' => true,
					),
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'criteria_title_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'criteria', 
						'not_empty' => true,
					),
				),			
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'criteria_title_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'criteria', 
						'not_empty' => true,
					),
				),
				
				array( 
					'param_name' => 'maximum_rating_text_header',
					'heading' => esc_html__( 'Maximum Rating Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_maximum_rating_text', 
						'value' => 1 
					),
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'maximum_rating_text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_maximum_rating_text', 
						'value' => 1 
					),
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),	
					'param_name' => 'maximum_rating_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_maximum_rating_text', 
						'value' => 1 
					),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'maximum_rating_text_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_maximum_rating_text', 
						'value' => 1 
					),
				),
		
				array( 
					'param_name' => 'user_votes_text_header',
					'heading' => esc_html__( 'User Votes Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'value' => 1 
					),
				),
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'user_votes_text_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
						'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
						'dependency' => array( 
							'element' => 'show_user_votes_text', 
							'value' => 1 
						),
					),
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),	
						'param_name' => 'user_votes_text_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
						'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
						'dependency' => array( 
							'element' => 'show_user_votes_text', 
							'value' => 1  
						),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'user_votes_text_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
						'dependency' => array( 
							'element' => 'show_user_votes_text', 
							'value' => 1  
						),
					),
			
				array( 
					'param_name' => 'ranges_text_header',
					'heading' => esc_html__( 'Ranges Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Ratings', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_ranges_text', 
						'value' => 1  
					),
				),
					array( 
						'heading' => esc_html__( 'Size (px)', 'gpur' ),	
						'param_name' => 'ranges_text_size',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
						'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
						'dependency' => array( 
							'element' => 'show_ranges_text', 
							'value' => 1  
						),
					),
					array( 
						'heading' => esc_html__( 'Color', 'gpur' ),	
						'param_name' => 'ranges_text_color',
						'type' => 'colorpicker',
						'value' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
						'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
						'dependency' => array( 
							'element' => 'show_ranges_text', 
							'value' => 1  
						),
					),
					array( 
						'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
						'param_name' => 'ranges_text_extra_css',
						'type' => 'textfield',
						'value' => '',
						'group' => esc_html__( 'Ratings', 'gpur' ),
						'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
						'dependency' => array( 
							'element' => 'show_ranges_text', 
							'value' => 1  
						),
					),
				
				/*--------------------------------------------------------------
				Labels tab
				--------------------------------------------------------------*/
			
				array( 
					'heading' => esc_html__( 'Average User Rating Label', 'gpur' ),
					'param_name' => 'avg_user_rating_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Average User Rating:', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'value' => 1  
					),
				),	

				array( 
					'heading' => esc_html__( 'Your User Rating Label', 'gpur' ),
					'param_name' => 'your_user_rating_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Site Rating:', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_your_user_rating_text', 
						'value' => 1  
					),
				),	
											
				array( 
					'heading' => esc_html__( 'User Votes Label (Singular)', 'gpur' ),
					'param_name' => 'singular_vote_label',
					'type' => 'textfield',
					'value' => esc_html__( 'vote', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'value' => 1  
					),
				),
							
				array( 
					'heading' => esc_html__( 'User Votes Label (Plural)', 'gpur' ),
					'param_name' => 'plural_vote_label',
					'type' => 'textfield',
					'value' => esc_html__( 'votes', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'value' => 1  
					),
				),
					
				/*--------------------------------------------------------------
				Design options tab
				--------------------------------------------------------------*/
		
				array(
					'heading' => esc_html__( 'CSS', 'gpur' ),
					'type' => 'css_editor',
					'param_name' => 'css',
					'group' => esc_html__( 'Design Options', 'gpur' ),
				),
						
			),
			
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_reviews_list_options' );