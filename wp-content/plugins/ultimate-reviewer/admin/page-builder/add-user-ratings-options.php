<?php if ( ! function_exists( 'gpur_wpb_add_user_rating_options' ) ) {
	function gpur_wpb_add_user_rating_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Add User Rating', 'gpur' ),
			'base' => 'gpur_add_user_ratings',
			'description' => '',
			'class' => 'gpur-wpb-add-user-ratings',
			'controls' => 'full',
			'icon' => 'gpur-icon-add-user-ratings',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(		
				
				array( 
					'heading' => esc_html__( 'Title', 'gpur' ),
					'param_name' => 'title',
					'type' => 'textfield',
					'admin_label' => true,
					'value' => esc_html__( 'Add Rating', 'gpur' ),
				),
				
				array(  
					'param_name' => 'permissions',
					'heading' => esc_html__( 'Permissions', 'gpur' ),
					'description' => esc_html__( 'Choose which users or roles can submit user reviews.', 'gpur' ),
					'type' => 'dropdown',	
					'value' => array(
						esc_html__( 'All users', 'gpur' ) => 'all-users',
						esc_html__( 'Logged in users only', 'gpur' ) => 'logged-in-users',
						esc_html__( 'Specific roles only', 'gpur' ) => 'specific-roles',
					),
					'std' => 'all-users',
				),
				
				array(  
					'param_name' => 'permission_roles',
					'heading' => esc_html__( 'Roles', 'gpur' ),
					'type' => 'checkbox',
					'value' => gpur_permissions_role_checkbox_values(),
					'dependency' => array(
						'element' => 'permissions', 
						'value' => array( 'specific-roles' ),
					),
				),
				
				array( 
					'heading' => esc_html__( 'Criteria & Weights', 'gpur' ),
					'description' => esc_html__( 'Enter each criterion on a new line. To add weights add a colon and then the weight e.g.', 'gpur' ) . '<br/><code>' . esc_html__( 'Criterion 1:0.5', 'gpur' ) . '</code><br/><code>' . esc_html__( 'Criterion 2:0.75', 'gpur' ) . '</code>',
					'param_name' => 'criteria',
					'type' => 'exploded_textarea',
					'value' => '',
				),
								
				array( 
					'heading' => esc_html__( 'Minimum Rating', 'gpur' ),
					'param_name' => 'min_rating',
					'type' => 'textfield',
					'value' => 0,
					'edit_field_class' => 'vc_col-xs-6',
				),				
				
				array( 
					'heading' => esc_html__( 'Maximum Rating', 'gpur' ),
					'param_name' => 'max_rating',
					'type' => 'textfield',
					'value' => 5,
					'edit_field_class' => 'vc_col-xs-6',
				),				
				
				array( 
					'param_name' => 'step',
					'heading' => esc_html__( 'Rating Step', 'gpur' ),
					'description' => esc_html__( 'The increments you can rate between the minimum and maximum rating.', 'gpur' ),
					'type' => 'textfield',
					'value' => 1,
					'edit_field_class' => 'vc_col-xs-6',
				),
				
				array( 
					'param_name' => 'fractions',
					'heading' => esc_html__( 'Rating Fractions', 'gpur' ),
					'description' => esc_html__( 'Indicates the number of equal parts that make up a whole symbol.', 'gpur' ),
					'type' => 'textfield',
					'value' => 1,
					'edit_field_class' => 'vc_col-xs-6',
				),
				
				/*--------------------------------------------------------------
				Styling tab
				--------------------------------------------------------------*/
				
				array( 
					'heading' => esc_html__( 'Format', 'gpur' ),
					'param_name' => 'format',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Column', 'gpur' ) => 'format-column',
						esc_html__( 'Rows', 'gpur' ) => 'format-rows',
					),
					'dependency' => array( 
						'element' => 'criteria', 
						'not_empty' => true,
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
												
				array( 
					'heading' => esc_html__( 'Style', 'gpur' ),
					'param_name' => 'style',
					'type' => 'dropdown',
					'admin_label' => true,
					'value' => array(
						esc_html__( 'Stars', 'gpur' ) => 'style-stars',
						esc_html__( 'Hearts', 'gpur' ) => 'style-hearts',
						esc_html__( 'Squares', 'gpur' ) => 'style-squares',
						esc_html__( 'Circles', 'gpur' ) => 'style-circles',
						esc_html__( 'Bars', 'gpur' ) => 'style-bars',
						esc_html__( 'Custom Icon', 'gpur' ) => 'style-icon',
						esc_html__( 'Custom Image', 'gpur' ) => 'style-image',
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),	
				
				array(	
					'param_name' => 'criterion_boxes',
					'heading' => esc_html__( 'Criterion Boxes', 'gpur' ),
					'description' => esc_html__( 'Add a full width box around each criterion rating.', 'gpur' ),
					'type' => 'checkbox',
					'value' => array( '' => 1 ),
					'std' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
				),		

				array( 
					'param_name' => 'text_position',
					'heading' => esc_html__( 'Rating Text Position', 'gpur' ),
					'description' => '',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Top', 'gpur' ) => 'position-text-top', 
						esc_html__( 'Bottom', 'gpur' ) => 'position-text-bottom', 
						esc_html__( 'Left', 'gpur' ) => 'position-text-left', 
						esc_html__( 'Right', 'gpur' ) => 'position-text-right', 
					),
					'std' => 'position-text-bottom',
					'group' => esc_html__( 'Styling', 'gpur' ),
				),		
																				
				array( 
					'param_name' => 'header_show',
					'heading' => esc_html__( 'Show', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array(
					'param_name' => 'show_avg_user_rating_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Average User Rating Text', 'gpur' ) => 1 ),
					'std' => 1,
					'group' => esc_html__( 'Styling', 'gpur' ),
				),	
				array( 
					'param_name' => 'show_your_user_rating_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Your User Rating Text', 'gpur' ) => 1 ),
					'std' => 1,
					'group' => esc_html__( 'Styling', 'gpur' ),
				),												
				array( 
					'param_name' => 'show_maximum_rating_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Maximum Rating Text', 'gpur' ) => 1 ),
					'std' => 1,
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array(
					'param_name' => 'show_user_votes_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'User Votes Text ', 'gpur' ) => 1 ),
					'std' => 1,
					'dependency' => array( 
						'element' => 'rating_data', 
						'value' => 'user-rating' 
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array(
					'param_name' => 'show_submit_button',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Submit Button', 'gpur' ) => 1 ),
					'std' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
				),

				array( 
					'param_name' => 'rating_icons_header',
					'heading' => esc_html__( 'Icons', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
				),				
				array( 
					'heading' => esc_html__( 'Empty Icon Color', 'gpur' ),
					'param_name' => 'empty_icon_color',
					'type' => 'colorpicker',
					'value' => 'fa fa-star',
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
				),		
				array( 
					'heading' => esc_html__( 'Filled Icon Color', 'gpur' ),
					'param_name' => 'filled_icon_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-icon' ), 
					),
				),
				array( 
					'heading' => esc_html__( 'Height (px)', 'gpur' ),
					'description' => '',
					'param_name' => 'icon_height',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'style', 
						'value' => array( 'style-squares', 'style-circles', 'style-bars', 'style-image' ), 
					),
				),
				
				array( 
					'param_name' => 'criterion_boxes_header',
					'heading' => esc_html__( 'Criterion Boxes', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'criterion_boxes', 
						'value' => 1,
					),
				),
				array( 
					'heading' => esc_html__( 'Padding (px)', 'gpur' ),
					'param_name' => 'criterion_boxes_padding',
					'type' => 'textfield',
					'value' => '',		
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',			
					'dependency' => array( 
						'element' => 'criterion_boxes', 
						'value' => 1,
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array( 
					'heading' => esc_html__( 'Background Color 1', 'gpur' ),
					'param_name' => 'criterion_boxes_bg_color_1',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',			
					'dependency' => array( 
						'element' => 'criterion_boxes', 
						'value' => 1,
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Background Color 2', 'gpur' ),
					'param_name' => 'criterion_boxes_bg_color_2',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',				
					'dependency' => array( 
						'element' => 'criterion_boxes', 
						'value' => 1,
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),		
				array( 
					'heading' => esc_html__( 'Border Width (px)', 'gpur' ),
					'param_name' => 'criterion_boxes_border_width',
					'type' => 'textfield',
					'value' => '',		
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',			
					'dependency' => array( 
						'element' => 'criterion_boxes', 
						'value' => 1,
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),	
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'criterion_boxes_border_color',
					'type' => 'colorpicker',
					'value' => '',	
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',				
					'dependency' => array( 
						'element' => 'criterion_boxes', 
						'value' => 1,
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),		
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'criterion_boxes_extra_css',
					'type' => 'textfield',
					'value' => '',		
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',			
					'dependency' => array( 
						'element' => 'criterion_boxes', 
						'value' => 1,
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				
				array( 
					'param_name' => 'title_header',
					'heading' => esc_html__( 'Element Title', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'title', 
						'not_empty' => true,
					),
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'title_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'title', 
						'not_empty' => true,
					),
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'title_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'title', 
						'not_empty' => true,
					),
				),													
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'title_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'title', 
						'not_empty' => true,
					),
				),

				array( 
					'param_name' => 'criteria_title_header',
					'heading' => esc_html__( 'Criteria Title', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'criteria', 
						'not_empty' => true,
					),
				),

				array( 
					'param_name' => 'avg_user_rating_text_header',
					'heading' => esc_html__( 'Average User Rating Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'value' => 1 
					),
				),	
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),	
					'param_name' => 'avg_user_rating_text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'value' => 1 
					),
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),	
					'param_name' => 'avg_user_rating_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'value' => 1 
					),
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'avg_user_rating_text_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_avg_user_rating_text', 
						'value' => 1 
					),
				),

				array( 
					'param_name' => 'your_user_rating_text_header',
					'heading' => esc_html__( 'Your User Rating Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
					'dependency' => array( 
						'element' => 'show_your_user_rating_text', 
						'value' => 1 
					),
				),		
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'your_user_rating_text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_your_user_rating_text', 
						'value' => 1 
					),
				),	
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),	
					'param_name' => 'your_user_rating_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_your_user_rating_text', 
						'value' => 1 
					),
				),	
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),	
					'param_name' => 'your_user_rating_text_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_your_user_rating_text', 
						'value' => 1 
					),
				),

				array( 
					'param_name' => 'user_votes_text_header',
					'heading' => esc_html__( 'User Votes Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
					'dependency' => array( 
						'element' => 'show_user_votes_text', 
						'value' => 1 
					),
				),

				array( 
					'param_name' => 'submit_button_header',
					'heading' => esc_html__( 'Submit Button', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Text Color', 'gpur' ),
					'param_name' => 'submit_button_text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),				
				array( 
					'heading' => esc_html__( 'Text Hover Color', 'gpur' ),
					'param_name' => 'submit_button_text_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Border Color', 'gpur' ),
					'param_name' => 'submit_button_border_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Border Hover Color', 'gpur' ),
					'param_name' => 'submit_button_border_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Background Color', 'gpur' ),
					'param_name' => 'submit_button_bg_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Background Hover Color', 'gpur' ),
					'param_name' => 'submit_button_bg_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'submit_button_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
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
					'value' => esc_html__( 'Your Rating:', 'gpur' ),
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
								
				array( 
					'heading' => esc_html__( 'Submit Button Label', 'gpur' ),
					'param_name' => 'submit_button_label',
					'type' => 'textfield',
					'value' => esc_html__( 'Submit Rating', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	

				array( 
					'heading' => esc_html__( 'Logged In To Vote Label', 'gpur' ),
					'param_name' => 'logged_in_to_vote_label',
					'type' => 'textfield',
					'value' => esc_html__( 'You must be logged in to vote.', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
												
				array( 
					'heading' => esc_html__( 'Success Message (Single Rating)', 'gpur' ),
					'param_name' => 'single_success_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Thanks for submitting your rating!', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),	
								
				array( 
					'heading' => esc_html__( 'Error Message (Single Rating)', 'gpur' ),
					'param_name' => 'single_error_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Please give a rating.', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
								
				array( 
					'heading' => esc_html__( 'Success Message (Multi Rating)', 'gpur' ),
					'param_name' => 'multi_success_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Thanks for submitting your ratings!', 'gpur' ),
					'group' => esc_html__( 'Labels', 'gpur' ),
				),
								
				array( 
					'heading' => esc_html__( 'Error Message (Multi Rating)', 'gpur' ),
					'description' => '',
					'param_name' => 'multi_error_message',
					'type' => 'textfield',
					'value' => esc_html__( 'Please give a rating for each criterion.', 'gpur' ),
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
add_action( 'vc_before_init', 'gpur_wpb_add_user_rating_options' );