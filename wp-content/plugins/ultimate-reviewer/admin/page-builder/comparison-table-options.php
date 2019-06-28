<?php if ( ! function_exists( 'gpur_wpb_comparison_table_options' ) ) {
	function gpur_wpb_comparison_table_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Comparison Table', 'gpur' ),
			'base' => 'gpur_comparison_table',
			'description' => '',
			'class' => 'gpur-wpb-comparison-table',
			'controls' => 'full',
			'icon' => 'gpur-icon-comparison-table',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(
			
				
				/*--------------------------------------------------------------
				General tab
				--------------------------------------------------------------*/
																
				array( 
					'param_name' => 'table_format',
					'heading' => esc_html__( 'Format', 'gpur' ),
					'type' => 'dropdown',
					'admin_label' => true,
					'value' => array(
						esc_html__( 'Vertical Grid', 'gpur' ) => 'format-vertical-grid',
						esc_html__( 'Horizontal Grid', 'gpur' ) => 'format-horizontal-grid',
					),
					'std' => 'format-vertical-grid',
				),	
								
				array( 
					'param_name' => 'post_types',
					'heading' => esc_html__( 'Post Types', 'gpur' ),
					'type' => 'posttypes',
					'std' => 'post',
				),	
				
				array( 
					'param_name' => 'ids',
					'heading' => esc_html__( 'Post/Page IDs', 'gpur' ),
					'description' => esc_html__( 'Enter the post/pages IDs you want to show - separate IDs with a comma e.g. 123, 456, 789', 'gpur' ),
					'type' => 'textfield',
				),	
								
				array( 
					'param_name' => 'cats',
					'heading' => esc_html__( 'Categories', 'gpur' ),
					'description' => esc_html__( 'Enter the category slugs you want to display posts from - separate slugs with a comma e.g. category-1, category-2, category-3', 'gpur' ),
					'type' => 'textfield',
				),		

				array( 
					'param_name' => 'tags',
					'heading' => esc_html__( 'Tags', 'gpur' ),
					'description' => esc_html__( 'Enter the tag slugs you want to display posts from - separate slugs with a comma e.g. tag-1, tag-2, tag-3', 'gpur' ),
					'type' => 'textfield',
				),	
				
				array( 
					'param_name' => 'fields',
					'heading' => esc_html__( 'Fields', 'gpur' ),
					'description' => esc_html__( 'Enter each field on a new line. Available fields:', 'gpur' ) . ' <code>RANKING_NUMBERS</code> <code>REVIEW_IMAGE_1</code> <code>REVIEW_IMAGE_2</code> <code>FEATURED_IMAGE</code> <code>POST_TITLE</code> <code>POST_DATE</code> <code>POST_CATS</code> <code>POST_TAGS</code> <code>SITE_RATING</code> <code>USER_RATING</code> <code>USER_VOTES</code> <code>LIKES</code> <code>DISLIKES</code> <code>SUMMARY</code> <code>EXCERPT</code> <code>GOOD_POINTS</code> <code>BAD_POINTS</code> <code>BUTTON</code> <code>CUSTOM_FIELD_*</code>',
					'type' => 'exploded_textarea',
					'value' => <<<CONTENT
REVIEW_IMAGE_1
POST_TITLE
SITE_RATING
USER_RATING
SUMMARY
CONTENT
				),

				array( 
					'heading' => esc_html__( 'Sort', 'gpur' ),
					'param_name' => 'sort',
					'type' => 'dropdown',
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
				),	

				array( 
					'param_name' => 'user_sorting',	
					'heading' => esc_html__( 'User Sorting', 'gpur' ),
					'description' => esc_html__( 'Allow users to change the order of the table.', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => 1 ),
					'std' => 1,
				),	
								
				array( 
					'param_name' => 'number',
					'heading' => esc_html__( 'Number', 'gpur' ),
					'type' => 'textfield',
					'value' => '10',
				),			
				
				array( 
					'heading' => esc_html__( 'Summary Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the summary. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'summary_length',
					'type' => 'textfield',
					'value' => '',
				),		
				
				array( 
					'heading' => esc_html__( 'Excerpt Length', 'gpur' ),
					'description' => esc_html__( 'The number of characters in the excerpt. Leave empty to display all characters.', 'gpur' ),
					'param_name' => 'excerpt_length',
					'type' => 'textfield',
					'value' => '',
				),	
		
				array( 
					'param_name' => 'image_size',
					'heading' => esc_html__( 'Image Size', 'gpur' ),
					'description' => esc_html__( 'Enter image size e.g. "thumbnail", "medium", "large", "full" or enter size in pixels e.g. 200 x 100 (width x height).', 'gpur' ),
					'type' => 'textfield',
					'value' => 'thumbnail',
				),
								
				array( 
					'param_name' => 'heading_header',
					'heading' => esc_html__( 'Heading', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),	
				array( 
					'heading' => esc_html__( 'Background Color', 'gpur' ),
					'param_name' => 'heading_bg_color',
					'type' => 'colorpicker',
					'value' => '#333',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'heading_border_color',
					'type' => 'colorpicker',
					'value' => '#333',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),
					'param_name' => 'heading_text_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'heading_extra_css',
					'type' => 'textfield',
					'value' => '',
				),			

				array( 
					'param_name' => 'cell_header',
					'heading' => esc_html__( 'Cell', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),	
				array( 
					'heading' => esc_html__( 'Background Color 1', 'gpur' ),
					'param_name' => 'cell_bg_color_1',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Background Color 2', 'gpur' ),
					'param_name' => 'cell_bg_color_2',
					'type' => 'colorpicker',
					'value' => '#f8f8f8',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Remove Vertical Borders', 'gpur' ),
					'param_name' => 'remove_vertical_borders',
					'type' => 'checkbox',
					'value' => array( '' => 1 ),
					'std' => 1,
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'cell_border_color',
					'type' => 'colorpicker',
					'value' => '#eee',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),
					'param_name' => 'cell_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Link Color', 'gpur' ),
					'param_name' => 'cell_link_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Link Hover Color', 'gpur' ),
					'param_name' => 'cell_link_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'cell_extra_css',
					'type' => 'textfield',
					'value' => '',
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
					'param_name' => 'header_show',
					'heading' => esc_html__( 'Show', 'gpur' ),
					'type' => 'gpur_header',
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
				
				/*--------------------------------------------------------------
				Button styling tab
				--------------------------------------------------------------*/
					
				array( 
					'heading' => esc_html__( 'Button Text', 'gpur' ),	
					'param_name' => 'button_text',
					'type' => 'textfield',
					'value' => esc_html__( 'Button Text', 'gpur' ),
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				
				array( 
					'param_name' => 'button_header',
					'heading' => esc_html__( 'Button', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Padding Width (px)', 'gpur' ),
					'param_name' => 'button_padding_width',
					'type' => 'textfield',
					'value' => '15px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Padding Height (px)', 'gpur' ),
					'param_name' => 'button_padding_height',
					'type' => 'textfield',
					'value' => '10px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'button_color',
					'type' => 'colorpicker',
					'value' => '#000',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Hover Color', 'gpur' ),
					'param_name' => 'button_hover_color',
					'type' => 'colorpicker',
					'value' => '#333',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
							
				array( 
					'param_name' => 'text_header',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'button_text_size',
					'type' => 'textfield',
					'value' => '20px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'button_text_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Hover Color', 'gpur' ),
					'param_name' => 'button_text_hover_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),	
				
				array( 
					'param_name' => 'border_header',
					'heading' => esc_html__( 'Border', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Width (px)', 'gpur' ),
					'param_name' => 'button_border_width',
					'type' => 'textfield',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Radius (px)', 'gpur' ),
					'param_name' => 'button_border_radius',
					'type' => 'textfield',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'button_border_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Hover Color', 'gpur' ),
					'param_name' => 'button_border_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
						
				array( 
					'param_name' => 'button_header',
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'button_icon',
					'type' => 'iconpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Icon Size', 'gpur' ),
					'param_name' => 'button_icon_size',
					'type' => 'textfield',
					'value' => '20px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Icon Color', 'gpur' ),
					'param_name' => 'button_icon_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Icon Hover Color', 'gpur' ),
					'param_name' => 'button_icon_hover_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Alignment', 'gpur' ),
					'param_name' => 'button_icon_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'gpur' ) => 'icon-left',
						esc_html__( 'Right', 'gpur' ) => 'icon-right',
					),
					'std' => 'icon-left',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'group' => esc_html__( 'Buttons', 'gpur' ),
				),
				
				/*--------------------------------------------------------------
				Good/bad points styling tab
				--------------------------------------------------------------*/
				
				array( 
					'param_name' => 'good_list_icon_header',
					'heading' => esc_html__( 'Good List Icon', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'good_icon',
					'type' => 'iconpicker',
					'value' => 'fa fa-angle-right',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'good_icon_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'good_icon_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'good_icon_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
				),
				array( 
					'param_name' => 'good_list_text_header',
					'heading' => esc_html__( 'Good List Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'good_text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'good_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'good_text_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
				),	
				
				
				array( 
					'param_name' => 'bad_list_icon_header',
					'heading' => esc_html__( 'Bad List Icon', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'bad_icon',
					'type' => 'iconpicker',
					'value' => 'fa fa-angle-right',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'bad_icon_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'bad_icon_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'bad_icon_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
				),
				array( 
					'param_name' => 'bad_list_text_header',
					'heading' => esc_html__( 'Bad List Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'bad_text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'bad_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'bad_text_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Good/Bad Points', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
				),	
											
				/*--------------------------------------------------------------
				Labels tab
				--------------------------------------------------------------*/

				array( 
					'heading' => esc_html__( 'Ranking Numbers Label', 'gpur' ),
					'param_name' => 'ranking_numbers_label',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
								
				array( 
					'heading' => esc_html__( 'Review Image Label', 'gpur' ),
					'param_name' => 'review_image_label',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
								
				array( 
					'heading' => esc_html__( 'Post Title Label', 'gpur' ),
					'param_name' => 'post_title_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Title', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
							
				array( 
					'heading' => esc_html__( 'Post Categories Label', 'gpur' ),
					'param_name' => 'post_cats_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Categories', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
							
				array( 
					'heading' => esc_html__( 'Post Tags Label', 'gpur' ),
					'param_name' => 'post_tags_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Tags', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
							
				array( 
					'heading' => esc_html__( 'Site Rating Label', 'gpur' ),
					'param_name' => 'site_rating_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Site Rating', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
							
				array( 
					'heading' => esc_html__( 'User Rating Label', 'gpur' ),
					'param_name' => 'user_rating_label',
					'type' => 'textfield',
					'value' => esc_html__( 'User Rating', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
							
				array( 
					'heading' => esc_html__( 'User Votes Label', 'gpur' ),
					'param_name' => 'user_votes_label',
					'type' => 'textfield',
					'value' => esc_html__( 'User Votes', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Likes Label', 'gpur' ),
					'param_name' => 'likes_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Likes', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Dislikes Label', 'gpur' ),
					'param_name' => 'dislikes_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Dislikes', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Summary Label', 'gpur' ),
					'param_name' => 'summary_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Summary', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Excerpt Label', 'gpur' ),
					'param_name' => 'excerpt_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Excerpt', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Good Points Label', 'gpur' ),
					'param_name' => 'good_points_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Good Points', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Bad Points Label', 'gpur' ),
					'param_name' => 'bad_points_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Bad Points', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
							
				array( 
					'heading' => esc_html__( 'Button Label', 'gpur' ),
					'param_name' => 'button_label',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Labels', 'gpur' ),
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
																																													
			 )
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_comparison_table_options' );