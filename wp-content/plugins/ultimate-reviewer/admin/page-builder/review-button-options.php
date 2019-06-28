<?php if ( ! function_exists( 'gpur_wpb_review_button_options' ) ) {
	function gpur_wpb_review_button_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Review Button', 'gpur' ),
			'base' => 'gpur_review_button',
			'description' => '',
			'class' => 'gpur-wpb-review-button',
			'controls' => 'full',
			'icon' => 'gpur-icon-review-button',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(	
				
				array( 
					'param_name' => 'text',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'textfield',
					'admin_label' => true,
					'value' => esc_html__( 'Button Text', 'gpur' ),
				),
											
				array(
					'param_name' => 'link',
					'heading' => esc_html__( 'Link', 'gpur' ),
					'type' => 'textfield',
				),
				
				array( 
					'param_name' => 'button_header',
					'heading' => esc_html__( 'Button', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Padding Width (px)', 'gpur' ),
					'param_name' => 'button_padding_width',
					'type' => 'textfield',
					'value' => '15px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Padding Height (px)', 'gpur' ),
					'param_name' => 'button_padding_height',
					'type' => 'textfield',
					'value' => '10px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'button_color',
					'type' => 'colorpicker',
					'value' => '#000',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Hover Color', 'gpur' ),
					'param_name' => 'button_hover_color',
					'type' => 'colorpicker',
					'value' => '#333',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),		
				array( 
					'heading' => esc_html__( 'Alignment', 'gpur' ),
					'param_name' => 'button_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'gpur' ) => 'button-left',
						esc_html__( 'Center', 'gpur' ) => 'button-center',
						esc_html__( 'Right', 'gpur' ) => 'button-right',
					),
					'std' => 'button-left',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
							
				array( 
					'param_name' => 'text_header',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'text_size',
					'type' => 'textfield',
					'value' => '20px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'text_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),	
				array( 
					'heading' => esc_html__( 'Hover Color', 'gpur' ),
					'param_name' => 'text_hover_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),	
				
				array( 
					'param_name' => 'border_header',
					'heading' => esc_html__( 'Border', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Width (px)', 'gpur' ),
					'param_name' => 'border_width',
					'type' => 'textfield',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Radius (px)', 'gpur' ),
					'param_name' => 'border_radius',
					'type' => 'textfield',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),	
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'border_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),	
				array( 
					'heading' => esc_html__( 'Hover Color', 'gpur' ),
					'param_name' => 'border_hover_color',
					'type' => 'colorpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
							
				array( 
					'param_name' => 'icon_header',
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'type' => 'gpur_header',
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Icon', 'gpur' ),
					'param_name' => 'icon',
					'type' => 'iconpicker',
					'value' => '',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Icon Size', 'gpur' ),
					'param_name' => 'icon_size',
					'type' => 'textfield',
					'value' => '20px',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Icon Color', 'gpur' ),
					'param_name' => 'icon_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),	
				array( 
					'heading' => esc_html__( 'Icon Hover Color', 'gpur' ),
					'param_name' => 'icon_hover_color',
					'type' => 'colorpicker',
					'value' => '#fff',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),	
				array( 
					'heading' => esc_html__( 'Alignment', 'gpur' ),
					'param_name' => 'icon_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'gpur' ) => 'icon-left',
						esc_html__( 'Right', 'gpur' ) => 'icon-right',
					),
					'std' => 'icon-left',
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),

			 )
		) );
		
	}		
} 
add_action( 'vc_before_init', 'gpur_wpb_review_button_options' );