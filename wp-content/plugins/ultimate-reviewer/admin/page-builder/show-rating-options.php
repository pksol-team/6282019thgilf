<?php if ( ! function_exists( 'gpur_wpb_show_rating_options' ) ) {
	function gpur_wpb_show_rating_options() { 

		global $gpur_show_rating_params;
		$gpur_show_rating_params = apply_filters( 'gpur_show_rating_params', array(
			
			array( 
				'heading' => esc_html__( 'Title', 'gpur' ),
				'param_name' => 'title',
				'type' => 'textfield',
				'admin_label' => true,
				'value' => '',
			),	

			array( 
				'heading' => esc_html__( 'Rating Data', 'gpur' ),
				'param_name' => 'data',
				'type' => 'dropdown',
				'admin_label' => true,
				'value' => array(
					esc_html__( 'Site Rating', 'gpur' ) => 'site-rating',
					esc_html__( 'User Rating', 'gpur' ) => 'user-rating',
					esc_html__( 'Custom', 'gpur' ) => 'custom',
				),
			),	
									
			array( 
				'heading' => esc_html__( 'Value', 'gpur' ),
				'description' => esc_html__( 'Add your own custom ratings that will overwrite ratings on posts/pages. To add multiple ratings separate each rating with a comma e.g. 5,8,10', 'gpur' ),
				'param_name' => 'value',
				'type' => 'textfield',
				'value' => '',
				'dependency' => array( 
					'element' => 'data', 
					'value' => 'custom' 
				),
			),
			
			array( 
				'heading' => esc_html__( 'Criteria', 'gpur' ),					
				'description' => esc_html__( 'Enter each criterion on a new line.', 'gpur' ),
				'param_name' => 'criteria',
				'type' => 'exploded_textarea',
				'value' => '',
				'dependency' => array( 
					'element' => 'data', 
					'value' => array( 'site-rating', 'custom' ), 
				),
			),
									
			array( 
				'heading' => esc_html__( 'Maximum Rating', 'gpur' ),
				'param_name' => 'max_rating',
				'type' => 'textfield',
				'value' => 5,
			),
					
			array( 
				'param_name' => 'step',
				'heading' => esc_html__( 'Rating Step', 'gpur' ),
				'description' => esc_html__( 'The increments you can rate between the minimum and maximum rating.', 'gpur' ),
				'type' => 'textfield',
				'value' => 1 ,
			),
											
			array(
				'heading' => esc_html__( 'Rating Ranges', 'gpur' ),
				'description' => esc_html__( 'Set up your rating ranges in the follow way', 'gpur' ) . ' <code>' . esc_html__( 'Score 1-Score 2:Rating Text, Score 3-Score 4:Rating Text', 'gpur' ) . '</code>' . esc_html__( 'e.g.', 'gpur' ) . '<code>' . esc_html__( '0-2:Awful, 2.5-4:Bad, 4.5-6:Average, 6.5-8:Good, 8.5-10:Amazing', 'gpur' ) . '</code>',
				'param_name' => 'rating_ranges',
				'type' => 'textfield',
				'value' => '0-1.9:Awful, 2-2.9:Bad, 3-3.9:Average, 4-4.9:Good, 5-5:Amazing',
				'dependency' => array( 
					'element' => 'show_ranges_text', 
					'value' => 1  
				),
			),
			
			array(	
				'param_name' => 'rich_snippets',
				'heading' => esc_html__( 'Rich Snippets', 'gpur' ),
				'description' => esc_html__( 'Allows search engines to read your rating data to display ratings in search results.', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => 1 ),
				'std' => '',
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
				'std' => 'format-rows',
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
				'group' => esc_html__( 'Styling', 'gpur' ),
			),	
			
			array(	
				'param_name' => 'criterion_boxes',
				'heading' => esc_html__( 'Criterion Boxes', 'gpur' ),
				'description' => esc_html__( 'Add a full width box around each criterion rating.', 'gpur' ),
				'type' => 'checkbox',
				'value' => array( '' => 1 ),
				'std' => '',
				'dependency' => array( 
					'element' => 'style', 
					'value' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
				),
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
					'dependency' => array( 
						'element' => 'data', 
						'value' => 'user-rating' 
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array( 
					'param_name' => 'show_your_user_rating_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Your User Rating Text', 'gpur' ) => 1 ),
					'std' => 1,					
					'dependency' => array(
						'element' => 'style', 
						'value' => array( 'style-stars', 'style-squares', 'style-circles', 'style-hearts', 'style-bars', 'style-icon', 'style-image' ),
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),			
				array(
					'param_name' => 'show_maximum_rating_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Maximum Rating Text', 'gpur' ) => 1 ),
					'std' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array(
					'param_name' => 'show_user_votes_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'User Votes Text ', 'gpur' ) => 1 ),
					'std' => 1,
					'dependency' => array( 
						'element' => 'data', 
						'value' => 'user-rating' 
					),
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array(
					'param_name' => 'show_ranges_text',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Ranges Text', 'gpur' ) => 1 ),
					'std' => 1,
					'group' => esc_html__( 'Styling', 'gpur' ),
				),
				array(
					'param_name' => 'show_zero_rating',
					'type' => 'checkbox',
					'value' => array( esc_html__( 'Zero Ratings', 'gpur' ) => 1 ),
					'std' => 1,
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
					'value' => array( 'style-stars', 'style-hearts', 'style-squares', 'style-circles', 'style-bars', 'style-icon', 'style-image' ), 
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
				'param_name' => 'rating_container_header',
				'heading' => esc_html__( 'Rating Container', 'gpur' ),
				'type' => 'gpur_header',
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
			),

			array( 
				'param_name' => 'gauge_header',
				'heading' => esc_html__( 'Gauge', 'gpur' ),
				'type' => 'gpur_header',
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'param_name' => 'maximum_rating_text_header',
				'heading' => esc_html__( 'Maximum Rating Text', 'gpur' ),
				'type' => 'gpur_header',
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'group' => esc_html__( 'Styling', 'gpur' ),
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
				'param_name' => 'ranges_text_header',
				'heading' => esc_html__( 'Ranges Text', 'gpur' ),
				'type' => 'gpur_header',
				'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
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
					'group' => esc_html__( 'Styling', 'gpur' ),
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
				
		) );	
					
		vc_map( array( 
			'name' => esc_html__( 'Show Rating', 'gpur' ),
			'base' => 'gpur_show_rating',
			'description' => '',
			'class' => 'gpur-wpb-show-rating',
			'controls' => 'full',
			'icon' => 'gpur-icon-show-rating',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => $gpur_show_rating_params,
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_show_rating_options' );