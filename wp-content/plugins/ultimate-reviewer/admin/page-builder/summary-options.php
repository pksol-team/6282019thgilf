<?php if ( ! function_exists( 'gpur_wpb_summary_options' ) ) {
	function gpur_wpb_summary_options() { 
	
		vc_map( array( 
			'name' => esc_html__( 'Summary', 'gpur' ),
			'base' => 'gpur_summary',
			'description' => '',
			'class' => 'gpur-wpb-summary',
			'controls' => 'full',
			'icon' => 'gpur-icon-summary',
			'category' => esc_html__( 'Review', 'gpur' ),
			'params' => array(	
				
				array( 
					'heading' => esc_html__( 'Title', 'gpur' ),
					'param_name' => 'title',
					'type' => 'textfield',
					'admin_label' => true,
					'value' => esc_html__( 'Summary', 'gpur' ),
				),		
				
				array( 
					'param_name' => 'title_header',
					'heading' => esc_html__( 'Title', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'title_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'title_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'title_extra_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
				),
				
				array( 
					'param_name' => 'text_header',
					'heading' => esc_html__( 'Text', 'gpur' ),
					'type' => 'gpur_header',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field-border',
				),
				array( 
					'heading' => esc_html__( 'Size (px)', 'gpur' ),
					'param_name' => 'text_size',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Color', 'gpur' ),
					'param_name' => 'text_color',
					'type' => 'colorpicker',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-3 gpur-wpb-field',
				),
				array( 
					'heading' => esc_html__( 'Extra CSS', 'gpur' ),
					'param_name' => 'text_css',
					'type' => 'textfield',
					'value' => '',
					'group' => esc_html__( 'Styling', 'gpur' ),
					'edit_field_class' => 'vc_col-xs-12 gpur-wpb-field',
				),	
					
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
add_action( 'vc_before_init', 'gpur_wpb_summary_options' );