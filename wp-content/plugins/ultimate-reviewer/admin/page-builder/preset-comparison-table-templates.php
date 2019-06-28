<?php if ( ! function_exists( 'gpur_wpb_comparison_table_templates' ) ) {
	function gpur_wpb_comparison_table_templates() {

		// Comparison table 1
		$data = array();
		$data['name'] = esc_html__( 'Comparison Table Template 1', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-comparison-table-template-1';
		$data['content'] = <<<CONTENT
[gpur_comparison_table fields="RANKING_NUMBERS,REVIEW_IMAGE_1,POST_TITLE,SITE_RATING,USER_RATING,SUMMARY" summary_length="100" heading_bg_color="#333333" heading_border_color="#333333" heading_text_color="#ffffff" cell_bg_color_1="#ffffff" cell_border_color="#eeeeee" empty_icon_color="" button_color="#000000" button_hover_color="#333333" button_text_color="#ffffff" button_text_hover_color="#ffffff" button_icon_color="#ffffff" button_icon_hover_color="#ffffff" criteria="Criterion 1,Criterion 2,Criterion 3" bb_tab_container=""]
CONTENT;
		vc_add_default_templates( $data );
					
		// Comparison table 2
		$data = array();
		$data['name'] = esc_html__( 'Comparison Table Template 2', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-comparison-table-template-2';
		$data['content'] = <<<CONTENT
[gpur_comparison_table table_format="format-horizontal-grid" fields="REVIEW_IMAGE_1,POST_TITLE,SITE_RATING,USER_RATING,USER_VOTES,LIKES,BUTTON" number="5" summary_length="100" heading_bg_color="#fff3df" heading_border_color="#ffe9c4" heading_text_color="#000000" cell_bg_color_1="#ffffff" cell_bg_color_2="#fff3df" remove_vertical_borders="" cell_border_color="#ffe9c4" cell_link_color="#000000" cell_link_hover_color="#ff5722" empty_icon_color="" button_text="Buy" button_color="#ff5722" button_hover_color="#333333" button_text_size="16px" button_text_color="#ffffff" button_text_hover_color="#ffffff" button_border_radius="5px" button_icon_color="#ffffff" button_icon_hover_color="#ffffff"]
CONTENT;
		vc_add_default_templates( $data );

		// Comparison table 3
		$data = array();
		$data['name'] = esc_html__( 'Comparison Table Template 3', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-comparison-table-template-3';
		$data['content'] = <<<CONTENT
[gpur_comparison_table fields="REVIEW_IMAGE_1,POST_TITLE,GOOD_POINTS,BAD_POINTS,SITE_RATING,USER_RATING,BUTTON" sort="site-rating-desc" user_sorting="" summary_length="100" heading_bg_color="#ffda23" heading_border_color="#ffda23" heading_text_color="#000000" cell_bg_color_1="#ffffff" cell_bg_color_2="#ffffff" cell_border_color="#eeeeee" cell_link_color="#000000" cell_link_hover_color="#1e73be" style="style-gauge-circles-singular" rating_width="100" rating_height="100" rating_text_size="30" button_text="Buy" button_color="#ffffff" button_hover_color="#ffda23" button_text_size="16px" button_text_color="#1e73be" button_text_hover_color="#1e73be" button_border_width="2px" button_border_radius="5px" button_border_color="#1e73be" button_border_hover_color="#ffda23" button_icon_color="#ffffff" button_icon_hover_color="#ffffff" good_icon="fa fa-check" good_icon_size="14px" good_icon_color="#1e73be" good_text_size="14px" good_text_extra_css="line-height: 22px;" bad_icon="fa fa-times" bad_icon_size="14px" bad_icon_color="#1e73be" bad_text_size="14px" bad_text_extra_css="line-height: 22px;" button_label="Buy"]
CONTENT;
		vc_add_default_templates( $data );

		// Comparison table 4
		$data = array();
		$data['name'] = esc_html__( 'Comparison Table Template 4', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-comparison-table-template-4';
		$data['content'] = <<<CONTENT
[gpur_comparison_table fields="POST_TITLE,POST_DATE,LIKES,DISLIKES,SITE_RATING" heading_bg_color="#ffffff" heading_border_color="#eeeeee" heading_text_color="#000000" cell_bg_color_1="#ffffff" remove_vertical_borders="" cell_border_color="#eeeeee" cell_link_color="#1e73be" cell_link_hover_color="#000000" style="style-hearts" empty_icon_color="" button_text="Buy" button_color="#ffffff" button_hover_color="#ffda23" button_text_size="16px" button_text_color="#1e73be" button_text_hover_color="#1e73be" button_border_width="2px" button_border_radius="5px" button_border_color="#1e73be" button_border_hover_color="#ffda23" button_icon_color="#ffffff" button_icon_hover_color="#ffffff" good_icon="" bad_icon="" button_label="Buy"]
CONTENT;
		vc_add_default_templates( $data );
											
	}
}	
add_action( 'vc_load_default_templates_action', 'gpur_wpb_comparison_table_templates' );